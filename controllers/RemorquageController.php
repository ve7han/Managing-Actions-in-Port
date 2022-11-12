
<?php

class RemorquageController{

public function getAllPrestation(){
    $remorquage = Remorquage::getAll();
    return $remorquage;
}

public function getOneRemorquage(){
    if(isset($_POST['id'])){
        $data = array(
            'id' => $_POST['id']
        );
        $remorquage = remorquage::getRemorquage($data);
        return $remorquage;
    }
}
/*
public function findPrestations(){
    if(isset($_POST['search'])){
        $data = array('search' => $_POST['search']);
    }
    $Prestations = Prestation::searchPrestation($data);
    return $Prestations;
} 
*/

public function add0Prestation(){
    if(isset($_POST['submit1'])){
        $data = array(
            'code_escale' => $_POST['code_esc'],
            'date_debut' => $_POST['date'],
            'date_fin' => $_POST['date_fin'],
            'temps_entrée' => $_POST['time_entr'],
            'temps_sortie' => $_POST['time_sort'],
            'nombre_remorque' => $_POST['nombre_remorque'],
            //'quantité_unité' => $_POST['quantity'],
        );
        $result = Remorquage::add0($data);
        if($result === 'ok'){
            Redirect::to('home');
        }else{
            echo $result;
        }
    }
}

public function update0Prestation(){
    if(isset($_POST['submit2'])){
        $data = array(
            'id' => $_POST['id'],
            'code_escale' => $_POST['code_esc'],
            'date_debut' => $_POST['date'],
            'date_fin' => $_POST['date_fin'],
            'temps_entrée' => $_POST['time_entr'],
            'temps_sortie' => $_POST['time_sort'],
            'nombre_remorque' => $_POST['nombre_remorque'],

            
        );
        $result = Remorquage::update0($data);
        if($result === 'ok'){
            Redirect::to('home');
        }else{
            echo $result;
            }
        }
    }


public function delete0Prestation(){
    if(isset($_POST['id'])){
        $data['id'] = $_POST['id'];
        $result = Remorquage::delete0($data);
        if($result === 'ok'){
            Redirect::to('home');
        }else{
            echo $result;
        }
    }
}



}



?>