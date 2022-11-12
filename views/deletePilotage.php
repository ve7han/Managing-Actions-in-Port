<?php 
	if(isset($_POST['id'])){
		$exitPilotage = new PilotageController();
		$exitPilotage->deletePrestation();
	}
?>