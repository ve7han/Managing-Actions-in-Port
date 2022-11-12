<?php 
	if(isset($_POST['id'])){
		$exitLocation = new LocationController();
		$exitLocation->delete1Prestation();
	}
?>