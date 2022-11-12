<?php
class LocationController{

public function getAllPrestation(){
    $location = Location::getAll();
    return $location;
}


public function getOneLocation(){
    if(isset($_POST['id'])){
        $data = array(
            'id' => $_POST['id']
        );
        $location = Location::getLocation($data);
        return $location;
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

public function add1Prestation(){
    if(isset($_POST['submit2'])){
        $data = array(
            'commande' => $_POST['commande'],
            'code_escale' => $_POST['code_esc'],
            'date_debut' => $_POST['date'],
            'temps_entrée' => $_POST['time_entr'],
            'temps_sortie' => $_POST['time_sort'],
            'nombre_remorque' => $_POST['nombre_remorque']

        );
        $result = Location::add1($data);
        if($result === 'ok'){
            Redirect::to('home');
        }else{
            echo $result;
        }
    }
}

public function update1Prestation(){
    if(isset($_POST['submit2'])){
        $data = array(
            'id' => $_POST['id'],
            'commande' => $_POST['commande'],
            'code_escale' => $_POST['code_esc'],
            'date_debut' => $_POST['date'],
            'temps_entrée' => $_POST['time_entr'],
            'temps_sortie' => $_POST['time_sort'],
            'nombre_remorque' => $_POST['nombre_remorque']
        );
        $result = Location::update1($data);
        if($result === 'ok'){
            Redirect::to('home');
        }else{
            echo $result;
            }
        }
    }


public function delete1Prestation(){
    if(isset($_POST['id'])){
        $data['id'] = $_POST['id'];
        $result = Location::delete($data);
        if($result === 'ok'){
            Redirect::to('home');
        }else{
            echo $result;
        }
    }
}



}

?>