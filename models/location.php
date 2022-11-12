<?php 

class Location {

    static public function getAll(){
        $stmt = DB::connect()->prepare('SELECT * FROM `location`');
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function getLocation($data){
		$id = $data['id'];
		try{
			$query = 'SELECT * FROM `location` WHERE id=:id';
			$stmt = DB::connect()->prepare($query);
			$stmt->execute(array(":id" => $id));
			$location = $stmt->fetch(PDO::FETCH_OBJ);
			return $location;
		}catch(PDOException $ex){
			echo 'erreur' . $ex->getMessage();
		}
	}


    static public function add1($data){


        // CALC J / N
        $date = $data['date_debut'];
        $ent =  strval($data['temps_entrée']);
        $sort = strval($data['temps_sortie']);

        function HoursToMinutes($hours) 
        { 
            $minutes = 0; 
            if (strpos($hours, ':') !== false) 
            { 
                list($hours, $minutes) = explode(':', $hours); 
            } 
            return $hours * 60 + $minutes; 
        }   
        
    
        if ($sort<$ent ){ 
            $calc = (HoursToMinutes($sort)+1440 - HoursToMinutes($ent)); 
        }else{
            $calc = (HoursToMinutes($sort) - HoursToMinutes($ent)); 
        }           

         if ($calc > 60){
            $nombre = $data['nombre_remorque']*2;
         }
         else{$nombre = $data['nombre_remorque'];}


        $id=rand(1,99999);
        $query = "INSERT INTO `location` SET id=?, commande=?, code_escale=?, date_debut=?, temps_entrée=?, temps_sortie=?, nombre_remorque=?";
        $stmt = DB::connect()->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->bindParam(2, $data['commande'], PDO::PARAM_STR);
        $stmt->bindParam(3, $data['code_escale'], PDO::PARAM_STR);
        $stmt->bindParam(4, $data['date_debut'], PDO::PARAM_STR);
        $stmt->bindParam(5, $data['temps_entrée'], PDO::PARAM_STR);
        $stmt->bindParam(6, $data['temps_sortie'], PDO::PARAM_STR);
        $stmt->bindParam(7, $nombre, PDO::PARAM_STR);

        // Backup Database
        $type = 'Location';
        $query2 = "INSERT INTO `dossier_prestation`  SET idl=?, commande=?, code_escale=?, date_debut=?, temps_entrée=?, temps_sortie=?, nombre_remorque=?, type_prestation=?";
        $stmt2 = DB::connect()->prepare($query2);
        $stmt2->bindParam(1, $id, PDO::PARAM_STR);
        $stmt2->bindParam(2, $data['commande'], PDO::PARAM_STR);
        $stmt2->bindParam(3, $data['code_escale'], PDO::PARAM_STR);
        $stmt2->bindParam(4, $data['date_debut'], PDO::PARAM_STR);
        $stmt2->bindParam(5, $data['temps_entrée'], PDO::PARAM_STR);
        $stmt2->bindParam(6, $data['temps_sortie'], PDO::PARAM_STR);
        $stmt2->bindParam(7, $nombre, PDO::PARAM_STR);
        $stmt2->bindParam(8, $type, PDO::PARAM_STR);

        if ($stmt->execute() and $stmt2->execute()) {

        $exitNavire = new NavireController();
        $navire = $exitNavire->getOneNavireInFunction($data['code_escale']);
        $query3 = "INSERT INTO `detail_prestation`  SET idl=?, commande=?, code_escale=?, date_debut=?, code_prestation='20304', type_operation='Loc. Remorqueur A L\'Heure Au Port JO', nombre_remorque=?, nom_bateau=?, Nationalité=?, type_navire=?, jauge=?";
        $stmt3 = DB::connect()->prepare($query3);
        $stmt3->bindParam(1, $id, PDO::PARAM_STR);
        $stmt3->bindParam(2, $data['commande'], PDO::PARAM_STR);
        $stmt3->bindParam(3, $data['code_escale'], PDO::PARAM_STR);
        $stmt3->bindParam(4, $data['date_debut'], PDO::PARAM_STR);
        $stmt3->bindParam(5, $nombre, PDO::PARAM_STR);
        $stmt3->bindParam(6, $navire->nom_bateau, PDO::PARAM_STR);
        $stmt3->bindParam(7, $navire->Nationalité, PDO::PARAM_STR);
        $stmt3->bindParam(8, $navire->type_navire, PDO::PARAM_STR);
        $stmt3->bindParam(9, $navire->jauge, PDO::PARAM_STR);
        $stmt3->execute();
         
     
        return 'ok';
    } else {
        return 'error';
    }
    $stmt->close();
    $stmt2->close();
    $stmt = null;
    $stmt2 = null;
       
    

       
    }

    static public function update1($data){


        // CALC J / N
        $date = $data['date_debut'];
        $ent =  strval($data['temps_entrée']);
        $sort = strval($data['temps_sortie']);

        function HoursToMinutes($hours) 
        { 
            $minutes = 0; 
            if (strpos($hours, ':') !== false) 
            { 
                list($hours, $minutes) = explode(':', $hours); 
            } 
            return $hours * 60 + $minutes; 
        }   
       // echo $ent.'<br>';  // DEBUG
        //echo $sort.'<br>';  // DEBUG
        
    
        if ($sort<$ent ){ 
            $calc = (HoursToMinutes($sort)+1440 - HoursToMinutes($ent)); 
            //echo 'if'.$calc; // DEBUG
        }else{
            $calc = (HoursToMinutes($sort) - HoursToMinutes($ent)); 
           // echo 'else'.$calc;   // DEBUG
        }           

         if ($calc > 60){
            $nombre = $data['nombre_remorque']*2;
         }
         else{$nombre = $data['nombre_remorque'];}
       //  echo '<br>'.$nombre;  // DEBUG

        
        $query = "UPDATE `location` SET  commande=?, code_escale=?, date_debut=?, temps_entrée=?, temps_sortie=?, nombre_remorque=? WHERE id=?";
        $stmt = DB::connect()->prepare($query);
        $stmt->bindParam(1, $data['commande'], PDO::PARAM_STR);
        $stmt->bindParam(2, $data['code_escale'], PDO::PARAM_STR);
        $stmt->bindParam(3, $data['date_debut'], PDO::PARAM_STR);
        $stmt->bindParam(4, $data['temps_entrée'], PDO::PARAM_STR);
        $stmt->bindParam(5, $data['temps_sortie'], PDO::PARAM_STR);
        $stmt->bindParam(6, $nombre, PDO::PARAM_STR);
        $stmt->bindParam(7, $data['id'], PDO::PARAM_STR);

         // Update Backup
        $query2 = "UPDATE `dossier_prestation` SET  commande=?, code_escale=?, date_debut=?, temps_entrée=?, temps_sortie=?, nombre_remorque=? WHERE idl=?";
        $stmt2 = DB::connect()->prepare($query2);
        $stmt2->bindParam(1, $data['commande'], PDO::PARAM_STR);
        $stmt2->bindParam(2, $data['code_escale'], PDO::PARAM_STR);
        $stmt2->bindParam(3, $data['date_debut'], PDO::PARAM_STR);
        $stmt2->bindParam(4, $data['temps_entrée'], PDO::PARAM_STR);
        $stmt2->bindParam(5, $data['temps_sortie'], PDO::PARAM_STR);
        $stmt2->bindParam(6, $nombre, PDO::PARAM_STR);
        $stmt2->bindParam(7, $data['id'], PDO::PARAM_STR);
       
        if ($stmt->execute() and $stmt2->execute()) {

            $exitNavire = new NavireController();
            $navire = $exitNavire->getOneNavireInFunction($data['code_escale']);
            $query3 = "UPDATE `detail_prestation`  SET commande=?, code_escale=?, date_debut=?, nombre_remorque=?, nom_bateau=?, Nationalité=?, type_navire=?, jauge=? WHERE idl=?";
            $stmt3 = DB::connect()->prepare($query3);
            $stmt3->bindParam(1, $data['commande'], PDO::PARAM_STR);
            $stmt3->bindParam(2, $data['code_escale'], PDO::PARAM_STR);
            $stmt3->bindParam(3, $data['date_debut'], PDO::PARAM_STR);
            $stmt3->bindParam(4, $nombre, PDO::PARAM_STR);
            $stmt3->bindParam(5, $navire->nom_bateau, PDO::PARAM_STR);
            $stmt3->bindParam(6, $navire->Nationalité, PDO::PARAM_STR);
            $stmt3->bindParam(7, $navire->type_navire, PDO::PARAM_STR);
            $stmt3->bindParam(8, $navire->jauge, PDO::PARAM_STR);
            $stmt3->bindParam(9, $data['id'], PDO::PARAM_STR);

            $stmt3->execute();
             
         
            return 'ok';
        } else {
            return 'error';
        }
        $stmt->close();
        $stmt2->close();
        $stmt = null;
        $stmt2 = null;
           
    }
        
    static public function delete($data){
        $id = $data['id'];
        try {
            $query2 = 'DELETE FROM dossier_prestation WHERE idl=:id';
            $stmt2 = DB::connect()->prepare($query2);
            $query3 = 'DELETE FROM detail_prestation WHERE idl=:id';
            $stmt3 = DB::connect()->prepare($query3);
            $query = 'DELETE FROM location WHERE id=:id';
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
