<?php

class Pilotage
{

    static public function getAll()
    {
        $stmt = DB::connect()->prepare('SELECT * FROM pilotage');
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function getPilotage($data)
    {
        $id = $data['id'];
        try {
            $query = 'SELECT * FROM pilotage WHERE id=:id';
            $stmt = DB::connect()->prepare($query);
            $stmt->execute(array(":id" => $id));
            $pilotage = $stmt->fetch(PDO::FETCH_OBJ);
            return $pilotage;
        } catch (PDOException $ex) {
            echo 'erreur' . $ex->getMessage();
        }
    }
    static public function getPilotageByEscale($data)
    {
        $id = $data['code_escale'];
        try {
            $query = 'SELECT * FROM pilotage WHERE code_escale=:code_escale';
            $stmt = DB::connect()->prepare($query);
            $stmt->execute(array(":code_escale" => $id));
            $pilotage = $stmt->fetch(PDO::FETCH_OBJ);
            return $pilotage;
        } catch (PDOException $ex) {
            echo 'erreur' . $ex->getMessage();
        }
    }


    static public function add($data)
    {


        // CALC J / N
        $date = $data['date_debut'];
        $ent =  strval($data['temps_entrée']);
        $sort = strval($data['temps_sortie']);
        $entree = str_replace(":", ".", $ent);
        $sortie = str_replace(":", ".", $sort);
        $final = null;
        function HoursToMinutes($hours)
        {
            $minutes = 0;
            if (strpos($hours, ':') !== false) {
                list($hours, $minutes) = explode(':', $hours);
            }
            return $hours * 60 + $minutes;
        }



        $dayOfWeek = date("l", strtotime($date));
        if ($sort < $ent) {
            $calc = (HoursToMinutes($sort) + 1450 - HoursToMinutes($ent) - 10) / 30;
        } else {
            $calc = (HoursToMinutes($sort) + 10 - HoursToMinutes($ent) - 10) / 30;
        }
        if (is_float($calc)) {
            ($calc = $calc + 1);
        }
        if ($dayOfWeek === 'Sunday') {
            $final .= (int)$calc . 'F';
        } else {

            if ($entree >= 7 && $entree <= 19 && $sortie >= 7 && $sortie <= 19) {
                //Jour

                $final .= (int)$calc . 'J';
            } else {
                //Nuit

                $final .= (int)$calc . 'N';
            }
        }



        $id = rand(1, 99999);
        $query = "INSERT INTO pilotage SET id =?, code_escale=?,  date_debut=?, date_fin=?, temps_entrée=?, temps_sortie=?, quantité_unité=?, poste=?";
        $stmt = DB::connect()->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->bindParam(2, $data['code_escale'], PDO::PARAM_STR);
        $stmt->bindParam(3, $data['date_debut'], PDO::PARAM_STR);
        $stmt->bindParam(4, $data['date_fin'], PDO::PARAM_STR);
        $stmt->bindParam(5, $data['temps_entrée'], PDO::PARAM_STR);
        $stmt->bindParam(6, $data['temps_sortie'], PDO::PARAM_STR);
        $stmt->bindParam(7, $final, PDO::PARAM_STR);
        $stmt->bindParam(8, $data['poste'], PDO::PARAM_STR);

        // INSERT Dossier Prestation
        $type = 'Pilotage';
        $query2 = "INSERT INTO  dossier_prestation SET  idp=?, code_escale=?, type_prestation=?, date_debut=?, date_fin=?, temps_entrée=?, temps_sortie=?, quantité_unité=?";
        $stmt2 = DB::connect()->prepare($query2);
        $stmt2->bindParam(1, $id, PDO::PARAM_STR);
        $stmt2->bindParam(2, $data['code_escale'], PDO::PARAM_STR);
        $stmt2->bindParam(3, $type, PDO::PARAM_STR);
        $stmt2->bindParam(4, $data['date_debut'], PDO::PARAM_STR);
        $stmt2->bindParam(5, $data['date_fin'], PDO::PARAM_STR);
        $stmt2->bindParam(6, $data['temps_entrée'], PDO::PARAM_STR);
        $stmt2->bindParam(7, $data['temps_sortie'], PDO::PARAM_STR);
        $stmt2->bindParam(8, $final, PDO::PARAM_STR);

        if ($stmt->execute() and $stmt2->execute()) {

        // INSERT Details Prestation
        $exitNavire = new NavireController();
        $navire = $exitNavire->getOneNavireInFunction($data['code_escale']);
        $Prestations = [20501, 20503, 20104, 20502, 20501, 20107, 20502];
        $Operations = ['Pilotage', 'Mise a quai', 'Envoi d\'amarres sur ouvrage fixe', 'Location de Vedettes', 'Pilotage', 'Balayage Navire','Location de Vedettes'];
        $Movements = ['Entrée', 'Entrée', 'Entrée', 'Entrée', 'Sortie', 'Sortie', 'Sortie'];
        if ($data['poste'] === '16' OR $data['poste'] === '16 bis' OR $data['poste'] === '15'){}else{
            array_push($Prestations, 20101);
            array_push($Operations,'Operation Lamanage');
            array_push($Movements,'Entrée');
        }
        if (strpos($final, 'J')) {
            $jr = 'Jour';
        }
        if (strpos($final, 'N')) {
            $jr = 'Nuit';
        }
        if (strpos($final, 'F')) {
            $jr = 'Fériés ';
        }
        $multi = new MultipleIterator();
        $multi->attachIterator(new ArrayIterator($Prestations));
        $multi->attachIterator(new ArrayIterator($Operations));
        $multi->attachIterator(new ArrayIterator($Movements));
        foreach ($multi as $value) {
            list($Prestation, $Operation, $Movement) = $value;
            if ($Operation ==='Location de Vedettes' and  $data['poste'] === 'QP') {
                $qty = '6';
            } elseif ($Operation ==='Location de Vedettes') {
                $qty = preg_replace('/[^0-9]/', '', $final);
            } else{$qty= '1';}
                
            $query3 = "INSERT INTO  detail_prestation SET  idp=?, code_escale=?, type_operation=?, type_mouvement=?, code_prestation=?, type_vacation=?, date_debut=?, date_fin=?, quantité_unité=?, nom_bateau=?, Nationalité=?, type_navire=?, jauge=?, poste=?";
            $stmt3 = DB::connect()->prepare($query3);
            $stmt3->bindParam(1, $id, PDO::PARAM_STR);
            $stmt3->bindParam(2, $data['code_escale'], PDO::PARAM_STR);
            $stmt3->bindParam(3, $Operation, PDO::PARAM_STR);
            $stmt3->bindParam(4, $Movement, PDO::PARAM_STR);
            $stmt3->bindParam(5, $Prestation, PDO::PARAM_STR);
            $stmt3->bindParam(6, $jr, PDO::PARAM_STR);
            $stmt3->bindParam(7, $data['date_debut'], PDO::PARAM_STR);
            $stmt3->bindParam(8, $data['date_fin'], PDO::PARAM_STR);
            $stmt3->bindParam(9, $qty, PDO::PARAM_STR);
            $stmt3->bindParam(10, $navire->nom_bateau, PDO::PARAM_STR);
            $stmt3->bindParam(11, $navire->Nationalité, PDO::PARAM_STR);
            $stmt3->bindParam(12, $navire->type_navire, PDO::PARAM_STR);
            $stmt3->bindParam(13, $navire->jauge, PDO::PARAM_STR);
            $stmt3->bindParam(14, $data['poste'], PDO::PARAM_STR);
            $stmt3->execute();
        }
        $query5 = "INSERT INTO  detail_prestation SET  idp=?";
        $stmt5 = DB::connect()->prepare($query5);
        $stmt5->bindParam(1, $id, PDO::PARAM_STR);
        $stmt5->execute();

            return 'ok';
        } else {
            return 'error';
        }
        $stmt->close();
        $stmt2->close();
        $stmt = null;
        $stmt2 = null;

        
    
    
    }
    static public function update($data)
    {


        // CALC J / N
        $date = $data['date_debut'];
        $ent =  strval($data['temps_entrée']);
        $sort = strval($data['temps_sortie']);
        $entree = str_replace(":", ".", $ent);
        $sortie = str_replace(":", ".", $sort);
        $final = null;
        function HoursToMinutes($hours)
        {
            $minutes = 0;
            if (strpos($hours, ':') !== false) {
                list($hours, $minutes) = explode(':', $hours);
            }
            return $hours * 60 + $minutes;
        }



        $dayOfWeek = date("l", strtotime($date));
        if ($sort < $ent) {
            $calc = (HoursToMinutes($sort) + 1450 - HoursToMinutes($ent) - 10) / 30;
        } else {
            $calc = (HoursToMinutes($sort) + 10 - HoursToMinutes($ent) - 10) / 30;
        }
        if (is_float($calc)) {
            ($calc = $calc + 1);
        }
        if ($dayOfWeek === 'Sunday') {
            $final .= (int)$calc . 'F';
        } else {

            if ($entree >= 7 && $entree <= 19 && $sortie >= 7 && $sortie <= 19) {
                //Jour
                //echo 'Jour <br>';
                $final .= (int)$calc . 'J';
            } else {
                //Nuit
                //echo 'Nuit <br>';
                $final .= (int)$calc . 'N';
            }
        }




        $query = "UPDATE pilotage SET  code_escale=?,  date_debut=?, date_fin=?, temps_entrée=?, temps_sortie=?, quantité_unité=?, poste=? WHERE id=?";
        $stmt = DB::connect()->prepare($query);
        $stmt->bindParam(1, $data['code_escale'], PDO::PARAM_STR);
        $stmt->bindParam(2, $data['date_debut'], PDO::PARAM_STR);
        $stmt->bindParam(3, $data['date_fin'], PDO::PARAM_STR);
        $stmt->bindParam(4, $data['temps_entrée'], PDO::PARAM_STR);
        $stmt->bindParam(5, $data['temps_sortie'], PDO::PARAM_STR);
        $stmt->bindParam(6, $final, PDO::PARAM_STR);
        $stmt->bindParam(7, $data['poste'], PDO::PARAM_STR);
        $stmt->bindParam(8, $data['id'], PDO::PARAM_STR);

        // Update  Dossier Prestation
        $query2 = "UPDATE dossier_prestation SET  code_escale=?,  date_debut=?, date_fin=?, temps_entrée=?, temps_sortie=?, quantité_unité=?  WHERE idp=?";
        $stmt2 = DB::connect()->prepare($query2);
        $stmt2->bindParam(1, $data['code_escale'], PDO::PARAM_STR);
        $stmt2->bindParam(2, $data['date_debut'], PDO::PARAM_STR);
        $stmt2->bindParam(3, $data['date_fin'], PDO::PARAM_STR);
        $stmt2->bindParam(4, $data['temps_entrée'], PDO::PARAM_STR);
        $stmt2->bindParam(5, $data['temps_sortie'], PDO::PARAM_STR);
        $stmt2->bindParam(6, $final, PDO::PARAM_STR);
        $stmt2->bindParam(7, $data['id'], PDO::PARAM_STR);
        
        // Update Details Prestation
        if ($stmt->execute() and $stmt2->execute()) {

        // Delete old
            $delete = 'DELETE FROM detail_prestation WHERE idp=:id';
            $stmtd = DB::connect()->prepare($delete);
            $stmtd->execute(array(":id" => $data['id']));
            $stmtd->execute();
            $exitNavire = new NavireController();
            $navire = $exitNavire->getOneNavireInFunction($data['code_escale']);
            $Prestations = [20501, 20503, 20104, 20502, 20501, 20107, 20502];
            $Operations = ['Pilotage', 'Mise a quai', 'Envoi d\'amarres sur ouvrage fixe', 'Location de Vedettes', 'Pilotage', 'Balayage Navire','Location de Vedettes'];
            $Movements = ['Entrée', 'Entrée', 'Entrée', 'Entrée', 'Sortie', 'Sortie', 'Sortie'];
            if ($data['poste'] === '16' OR $data['poste'] === '16 bis' OR $data['poste'] === '15'){}else{
                array_push($Prestations, 20101);
                array_push($Operations,'Operation Lamanage');
                array_push($Movements,'Entrée');
            }
            if (strpos($final, 'J')) {
                $jr = 'Jour';
            }
            if (strpos($final, 'N')) {
                $jr = 'Nuit';
            }
            if (strpos($final, 'F')) {
                $jr = 'Fériés ';
            }
            $multi = new MultipleIterator();
            $multi->attachIterator(new ArrayIterator($Prestations));
            $multi->attachIterator(new ArrayIterator($Operations));
            $multi->attachIterator(new ArrayIterator($Movements));
            foreach ($multi as $value) {
                list($Prestation, $Operation, $Movement) = $value;
                if ($Operation ==='Location de Vedettes' and  $data['poste'] === 'QP') {
                    $qty = '6';
                } elseif ($Operation ==='Location de Vedettes') {
                    $qty = preg_replace('/[^0-9]/', '', $final);
                } else{$qty = '1';}
                    


                // Insert Update
                $query3 = "INSERT INTO  detail_prestation SET  idp=?, code_escale=?, type_operation=?, type_mouvement=?, code_prestation=?, type_vacation=?, date_debut=?, date_fin=?, quantité_unité=?, nom_bateau=?, Nationalité=?, type_navire=?, jauge=?, poste=?";
                $stmt3 = DB::connect()->prepare($query3);
                $stmt3->bindParam(1, $data['id'], PDO::PARAM_STR);
                $stmt3->bindParam(2, $data['code_escale'], PDO::PARAM_STR);
                $stmt3->bindParam(3, $Operation, PDO::PARAM_STR);
                $stmt3->bindParam(4, $Movement, PDO::PARAM_STR);
                $stmt3->bindParam(5, $Prestation, PDO::PARAM_STR);
                $stmt3->bindParam(6, $jr, PDO::PARAM_STR);
                $stmt3->bindParam(7, $data['date_debut'], PDO::PARAM_STR);
                $stmt3->bindParam(8, $data['date_fin'], PDO::PARAM_STR);
                $stmt3->bindParam(9, $qty, PDO::PARAM_STR);
                $stmt3->bindParam(10, $navire->nom_bateau, PDO::PARAM_STR);
                $stmt3->bindParam(11, $navire->Nationalité, PDO::PARAM_STR);
                $stmt3->bindParam(12, $navire->type_navire, PDO::PARAM_STR);
                $stmt3->bindParam(13, $navire->jauge, PDO::PARAM_STR);
                $stmt3->bindParam(14, $data['poste'], PDO::PARAM_STR);
                $stmt3->execute();
            }
            $query5 = "INSERT INTO  detail_prestation SET  idp=?";
            $stmt5 = DB::connect()->prepare($query5);
            $stmt5->bindParam(1, $data['id'], PDO::PARAM_STR);
            $stmt5->execute();
    
                return 'ok';
            } else {
                return 'error';
            }
            $stmt->close();
            $stmt2->close();
            $stmt = null;
            $stmt2 = null;
    }

    static public function delete($data)
    {
        $id = $data['id'];
        try {
            $query2 = 'DELETE FROM dossier_prestation WHERE idp=:id';
            $stmt2 = DB::connect()->prepare($query2);
            $query3 = 'DELETE FROM detail_prestation WHERE idp=:id';
            $stmt3 = DB::connect()->prepare($query3);
            $query = 'DELETE FROM pilotage WHERE id=:id';
            $stmt = DB::connect()->prepare($query);
            $stmt2->execute(array(":id" => $id));
            $stmt3->execute(array(":id" => $id));
            $stmt->execute(array(":id" => $id));
            if ($stmt2->execute() and $stmt->execute()) {
                return 'ok';
            }
        } catch (PDOException $ex) {
            echo 'erreur' . $ex->getMessage();
        }
    }
}
