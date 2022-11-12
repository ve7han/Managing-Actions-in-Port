<?php
require_once './views/includes/header.php';
require_once './autoload.php';
require_once './controllers/HomeController.php';

$home = new HomeController();
$pages = ['home0','home','add','add0','add1','updatePilotage','updateRemorquage','updateLocation','deletePilotage','deleteRemorquage','deleteLocation','viewPilotage','viewRemorquage','viewLocations'];

if(isset($_GET['page'])){
    if(in_array($_GET['page'],$pages)){
        $page = $_GET['page'];
        $home->index($page);
    }else{
        include('views/includes/404.php');
    }
}else{
    $home->index('home0');
}

?>
<?php
require_once './views/includes/footer.php';
?>