<?php
Class Navire {

    static public function getNavire($data){
		$id = $data['code_escale'];
		try{
			$query = 'SELECT * FROM navire WHERE code_escale=:code_escale';
			$stmt = DB::connect()->prepare($query);
			$stmt->execute(array(":code_escale" => $id));
			$navire = $stmt->fetch(PDO::FETCH_OBJ);
			return $navire;
		}catch(PDOException $ex){
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function getAll(){
        $stmt = DB::connect()->prepare('SELECT * FROM navire');
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
}

?>