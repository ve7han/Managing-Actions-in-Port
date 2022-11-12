<?php 

class Remorquage {

    static public function getAll(){
        $stmt = DB::connect()->prepare('SELECT * FROM remorquage');
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function getRemorquage($data){
		$id = $data['id'];
		try{
			$query = 'SELECT * FROM remorquage WHERE id=:id';
			$stmt = DB::connect()->prepare($query);
			$stmt->execute(array(":id" => $id));
			$remorquage = $stmt->fetch(PDO::FETCH_OBJ);
			return $remorquage;
		}catch(PDOException $ex){
			echo 'erreur' . $ex->getMessage();
		}
	}


    static public function add0($data){


        // CALC J / N
        $date = $data['date_debut'];
        $ent =  strval($data['temps_entrée']);
        $sort = strval($data['temps_sortie']);
        $entree = str_replace(":",".",$ent);
        $sortie = str_replace(":",".",$sort);
        $final = null;
        function HoursToMinutes($hours) 
        { 
            $minutes = 0; 
            if (strpos($hours, ':') !== false) 
            { 
                list($hours, $minutes) = explode(':', $hours); 
            } 
            return $hours * 60 + $minutes; 
        }   
        
        
        
            $dayOfWeek = date("l", strtotime($date));
            if ($sort<$ent ){ 
                $calc = (HoursToMinutes($sort)+1440 - HoursToMinutes($ent))/60; 
            }else{
                $calc = (HoursToMinutes($sort) - HoursToMinutes($ent))/60; 
                }
            if (is_float($calc) && $calc <1){
                ($calc = (int)$calc + 1) ;
            }
            if ($dayOfWeek === 'Sunday'){
                $final .= (int)$calc.'F';
            }else{

                if ($entree >= 6 && $entree <= 20 && $sortie >= 6 && $sortie <= 20) {
                    //Jour
                   
                    $final .= (int)$calc.'J';

                }
                else {
                    //Nuit
                    
                    $final .= (int)$calc.'N';
                }
            }
            if (is_float($calc) and ($calc)>1){
                ($final .= ' + supplément') ;
            }
            
            
           

         $id=rand(1,999999);
        $query = "INSERT INTO remorquage SET  id=?, code_escale=?, date_debut=?, date_fin=?, temps_entrée=?, temps_sortie=?, nombre_remorque=?, quantité_unité=?";
        $stmt = DB::connect()->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->bindParam(2, $data['code_escale'], PDO::PARAM_STR);
        $stmt->bindParam(3, $data['date_debut'], PDO::PARAM_STR);
        $stmt->bindParam(4, $data['date_fin'], PDO::PARAM_STR);
        $stmt->bindParam(5, $data['temps_entrée'], PDO::PARAM_STR);
        $stmt->bindParam(6, $data['temps_sortie'], PDO::PARAM_STR);
        $stmt->bindParam(7, $data['nombre_remorque'], PDO::PARAM_STR);
        $stmt->bindParam(8, $final, PDO::PARAM_STR);
      
    // INSERT Dossier Prestation
        $type = 'Remorquage';
        $query2 = "INSERT INTO  dossier_prestation SET idr=?, code_escale=?, type_prestation=?, date_debut=?, date_fin=?, temps_entrée=?, temps_sortie=?, nombre_remorque=?, quantité_unité=?";
        $stmt2 = DB::connect()->prepare($query2);
        $stmt2->bindParam(1, $id, PDO::PARAM_STR);
        $stmt2->bindParam(2, $data['code_escale'], PDO::PARAM_STR);
        $stmt2->bindParam(3, $type, PDO::PARAM_STR);
        $stmt2->bindParam(4, $data['date_debut'], PDO::PARAM_STR);
        $stmt2->bindParam(5, $data['date_fin'], PDO::PARAM_STR);
        $stmt2->bindParam(6, $data['temps_entrée'], PDO::PARAM_STR);
        $stmt2->bindParam(7, $data['temps_sortie'], PDO::PARAM_STR);
        $stmt2->bindParam(8, $data['nombre_remorque'], PDO::PARAM_STR);
        $stmt2->bindParam(9, $final, PDO::PARAM_STR);



        if ($stmt->execute() and $stmt2->execute()) {

    
        

// INSERT Details Prestation
            $exitNavire = new NavireController();
            $navire = $exitNavire->getOneNavireInFunction($data['code_escale']);
                // INSERT QUERY
                $query3 = "INSERT INTO  detail_prestation SET  idr=?, code_escale=?, type_operation='Remorquage', code_prestation='20302', nombre_remorque=?, date_debut=?, date_fin=?, nom_bateau=?, Nationalité=?, type_navire=?, jauge=?";
                $sup= substr($final, 0,1);
                $stmt3 = DB::connect()->prepare($query3);
                $stmt3->bindParam(1, $id, PDO::PARAM_STR);
                $stmt3->bindParam(2, $data['code_escale'], PDO::PARAM_STR);
                $stmt3->bindParam(3, $sup, PDO::PARAM_STR);
                $stmt3->bindParam(4, $data['date_debut'], PDO::PARAM_STR);
                $stmt3->bindParam(5, $data['date_fin'], PDO::PARAM_STR);
                $stmt3->bindParam(6, $navire->nom_bateau, PDO::PARAM_STR);
                $stmt3->bindParam(7, $navire->Nationalité, PDO::PARAM_STR);
                $stmt3->bindParam(8, $navire->type_navire, PDO::PARAM_STR);
                $stmt3->bindParam(9, $navire->jauge, PDO::PARAM_STR);
                
                if (strpos($final, 'supplément')){
                    $query4 = "INSERT INTO  detail_prestation SET  idr=?, code_escale=?, type_operation='Supplement Remorquage', code_prestation='20303', nombre_remorque=?, date_debut=?, date_fin=?, nom_bateau=?, Nationalité=?, type_navire=?, jauge=?";
                    $stmt4 = DB::connect()->prepare($query4);
                    $stmt4->bindParam(1, $id, PDO::PARAM_STR);
                    $stmt4->bindParam(2, $data['code_escale'], PDO::PARAM_STR);
                    $stmt4->bindParam(3, $final, PDO::PARAM_STR);
                    $stmt4->bindParam(4, $data['date_debut'], PDO::PARAM_STR);
                    $stmt4->bindParam(5, $data['date_fin'], PDO::PARAM_STR);
                    $stmt4->bindParam(6, $navire->nom_bateau, PDO::PARAM_STR);
                    $stmt4->bindParam(7, $navire->Nationalité, PDO::PARAM_STR);
                    $stmt4->bindParam(8, $navire->type_navire, PDO::PARAM_STR);
                    $stmt4->bindParam(9, $navire->jauge, PDO::PARAM_STR);
                    $stmt4->execute();
                }
               if ($stmt3->execute()){
                $query5 = "INSERT INTO  detail_prestation SET  idr=?";
                $stmt5 = DB::connect()->prepare($query5);
                $stmt5->bindParam(1, $id, PDO::PARAM_STR);
                $stmt5->execute();
                return 'ok';
            } else {
                return 'error';
            }
            $stmt->close();
            $stmt2->close();
            $stmt3->close();
    
            $stmt = null;
            $stmt2 = null;
            $stmt3 = null;
        }
    }

    static public function update0($data){


        // CALC J / N
        $date = $data['date_debut'];
        $ent =  strval($data['temps_entrée']);
        $sort = strval($data['temps_sortie']);
        $entree = str_replace(":",".",$ent);
        $sortie = str_replace(":",".",$sort);
        $final = null;
        function HoursToMinutes($hours) 
        { 
            $minutes = 0; 
            if (strpos($hours, ':') !== false) 
            { 
                list($hours, $minutes) = explode(':', $hours); 
            } 
            return $hours * 60 + $minutes; 
        }   
        
        
        
            $dayOfWeek = date("l", strtotime($date));
            if ($sort<$ent ){ 
                $calc = (HoursToMinutes($sort)+1440 - HoursToMinutes($ent))/60; 
            }else{
                $calc = (HoursToMinutes($sort) - HoursToMinutes($ent))/60; 
                }
            if (is_float($calc) && $calc <1){
                ($calc = (int)$calc + 1) ;
            }
            if ($dayOfWeek === 'Sunday'){
                $final .= (int)$calc.'F';
            }else{

                if ($entree >= 6 && $entree <= 20 && $sortie >= 6 && $sortie <= 20) {
                    //Jour
                   
                    $final .= (int)$calc.'J';

                }
                else {
                    //Nuit
                    
                    $final .= (int)$calc.'N';
                }
            }
            if (is_float($calc) and ($calc)>1){
                ($final .= ' + supplément') ;
            }
            
            
           

        
        $query = "UPDATE remorquage SET  code_escale=?, date_debut=?, date_fin=?, temps_entrée=?, temps_sortie=?, nombre_remorque=?, quantité_unité=? WHERE id=?";
        $stmt = DB::connect()->prepare($query);
        $stmt->bindParam(1, $data['code_escale'], PDO::PARAM_STR);
        $stmt->bindParam(2, $data['date_debut'], PDO::PARAM_STR);
        $stmt->bindParam(3, $data['date_fin'], PDO::PARAM_STR);
        $stmt->bindParam(4, $data['temps_entrée'], PDO::PARAM_STR);
        $stmt->bindParam(5, $data['temps_sortie'], PDO::PARAM_STR);
        $stmt->bindParam(6, $data['nombre_remorque'], PDO::PARAM_STR);
        $stmt->bindParam(7, $final, PDO::PARAM_STR);
        $stmt->bindParam(8, $data['id'], PDO::PARAM_STR);

    // Update  Dossier Prestation
        $query2 = "UPDATE dossier_prestation SET  code_escale=?, date_debut=?, date_fin=?, temps_entrée=?, temps_sortie=?, nombre_remorque=?, quantité_unité=? WHERE idr=?";
        $stmt2 = DB::connect()->prepare($query2);
        $stmt2->bindParam(1, $data['code_escale'], PDO::PARAM_STR);
        $stmt2->bindParam(2, $data['date_debut'], PDO::PARAM_STR);
        $stmt2->bindParam(3, $data['date_fin'], PDO::PARAM_STR);
        $stmt2->bindParam(4, $data['temps_entrée'], PDO::PARAM_STR);
        $stmt2->bindParam(5, $data['temps_sortie'], PDO::PARAM_STR);
        $stmt2->bindParam(6, $data['nombre_remorque'], PDO::PARAM_STR);
        $stmt2->bindParam(7, $final, PDO::PARAM_STR);
        $stmt2->bindParam(8, $data['id'], PDO::PARAM_STR);

    // Update Details Prestation
          if ($stmt->execute() and $stmt2->execute()) {

            // Delete old
            $delete = 'DELETE FROM detail_prestation WHERE idr=:id';
            $stmtd = DB::connect()->prepare($delete);
            $stmtd->execute(array(":id" => $data['id']));
            $stmtd->execute();


            $exitNavire = new NavireController();
            $navire = $exitNavire->getOneNavireInFunction($data['code_escale']);
                $sup2 = substr($final, 0,1);
                $query3 = "INSERT INTO  detail_prestation SET  idr=?, code_escale=?, type_operation='Remorquage', code_prestation='20302', nombre_remorque=?, date_debut=?, date_fin=?, nom_bateau=?, Nationalité=?, type_navire=?, jauge=?";
                $stmt3 = DB::connect()->prepare($query3);
                $stmt3->bindParam(1, $data['id'], PDO::PARAM_STR);
                $stmt3->bindParam(2, $data['code_escale'], PDO::PARAM_STR);
                $stmt3->bindParam(3, $sup2, PDO::PARAM_STR);
                $stmt3->bindParam(4, $data['date_debut'], PDO::PARAM_STR);
                $stmt3->bindParam(5, $data['date_fin'], PDO::PARAM_STR);
                $stmt3->bindParam(6, $navire->nom_bateau, PDO::PARAM_STR);
                $stmt3->bindParam(7, $navire->Nationalité, PDO::PARAM_STR);
                $stmt3->bindParam(8, $navire->type_navire, PDO::PARAM_STR);
                $stmt3->bindParam(9, $navire->jauge, PDO::PARAM_STR);
                
            if (strpos($final, 'supplément')){
                $query4 = "INSERT INTO  detail_prestation SET  idr=?, code_escale=?, type_operation='Supplement Remorquage', code_prestation='20303', nombre_remorque=?, date_debut=?, date_fin=?, nom_bateau=?, Nationalité=?, type_navire=?, jauge=?";
                $stmt4 = DB::connect()->prepare($query4);
                $stmt4->bindParam(1, $data['id'], PDO::PARAM_STR);
                $stmt4->bindParam(2, $data['code_escale'], PDO::PARAM_STR);
                $stmt4->bindParam(3, $final, PDO::PARAM_STR);
                $stmt4->bindParam(4, $data['date_debut'], PDO::PARAM_STR);
                $stmt4->bindParam(5, $data['date_fin'], PDO::PARAM_STR);
                $stmt4->bindParam(6, $navire->nom_bateau, PDO::PARAM_STR);
                $stmt4->bindParam(7, $navire->Nationalité, PDO::PARAM_STR);
                $stmt4->bindParam(8, $navire->type_navire, PDO::PARAM_STR);
                $stmt4->bindParam(9, $navire->jauge, PDO::PARAM_STR);
                $stmt4->execute();
            }  
                
                if ($stmt3->execute()){
                    $query5 = "INSERT INTO  detail_prestation SET  idr=?";
                    $stmt5 = DB::connect()->prepare($query5);
                    $stmt5->bindParam(1, $data['id'], PDO::PARAM_STR);
                    $stmt5->execute();
                return 'ok';
            } else {
                return 'error';
            }
            $stmt->close();
            $stmt2->close();
            $stmt3->close();

            $stmt = null;
            $stmt2 = null;
            $stmt3 = null;
            }
}
    static public function delete0($data){
        $id = $data['id'];
        try {
            $query2 = 'DELETE FROM dossier_prestation WHERE idr=:id';
            $stmt2 = DB::connect()->prepare($query2);
            $query3 = 'DELETE FROM detail_prestation WHERE idr=:id';
            $stmt3 = DB::connect()->prepare($query3);
            $query = 'DELETE FROM remorquage WHERE id=:id';
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
