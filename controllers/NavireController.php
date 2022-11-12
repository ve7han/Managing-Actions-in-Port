<?php



Class NavireController{

    public function getOneNavire(){
        if(isset($_POST['code_escale'])){
            $data = array(
                'code_escale' => $_POST['code_escale']
            );
            $navire = Navire::getNavire($data);
            return $navire;
        }
    }
    public function getOneNavireInFunction($escale){
       
            $data = array(
                'code_escale' => $escale
            );
            $navire = Navire::getNavire($data);
            return $navire;
        
    }

    public function getAllNavire(){
        $navire = Navire::getAll();
        return $navire;
    }

}
?>