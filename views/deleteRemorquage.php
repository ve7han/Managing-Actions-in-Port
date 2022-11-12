<?php 
	if(isset($_POST['id'])){
		$exitRemorquage = new RemorquageController();
		$exitRemorquage->delete0Prestation();
	}
?>