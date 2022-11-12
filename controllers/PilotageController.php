<?php
class PilotageController{

public function getAllPrestation(){
    $pilotage = Pilotage::getAll();
    return $pilotage;
}


public function getOnePilotage(){
    if(isset($_POST['id'])){
        $data = array(
            'id' => $_POST['id']
        );
        $pilotage = pilotage::getPilotage($data);
        return $pilotage;
    }
}
public function getOnePilotageByEscale(){
    if(isset($_POST['code_escale'])){
        $data = array(
            'code_escale' => $_POST['code_escale']
        );
        $pilotage = pilotage::getPilotageByEscale($data);
        return $pilotage;
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

public function addPrestation(){
    if(isset($_POST['submit'])){
        $data = array(
            'code_escale' => $_POST['code_esc'],
            'date_debut' => $_POST['date'],
            'date_fin' => $_POST['date_fin'],
            'temps_entrée' => $_POST['time_entr'],
            'temps_sortie' => $_POST['time_sort'],
            'poste' => $_POST['poste'],

        );
        $result = Pilotage::add($data);
        if($result === 'ok'){
            Redirect::to('home');
        }else{
            echo $result;
        }
    }
}

public function updatePrestation(){
    if(isset($_POST['submit'])){
        $data = array(
            'id' => $_POST['id'],
            'code_escale' => $_POST['code_esc'],
            'date_debut' => $_POST['date'],
            'date_fin' => $_POST['date_fin'],
            'temps_entrée' => $_POST['time_entr'],
            'temps_sortie' => $_POST['time_sort'],
            'poste' => $_POST['poste'],
        );
        $result = Pilotage::update($data);
        if($result === 'ok'){
            Redirect::to('home');
        }else{
            echo $result;
            }
        }
    }


public function deletePrestation(){
    if(isset($_POST['id'])){
        $data['id'] = $_POST['id'];
        $result = Pilotage::delete($data);
        if($result === 'ok'){
            Redirect::to('home');
        }else{
            echo $result;
        }
    }
}

}


?>