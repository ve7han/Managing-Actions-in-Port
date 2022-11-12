<?php 
	if(isset($_POST['id'])){
		$exitNavire = new NavireController();
		$navire = $exitNavire->getAllNavire();
		$exitLocation = new LocationController();
		$location = $exitLocation->getOneLocation();
	}
	if(isset($_POST['submit2'])){
		$exitLocation = new LocationController();
		$exitLocation->update1Prestation();
}
?>
<div class="container">
	<div class="row my-4">
		<div class="col-md-8 mx-auto">
			<div class="card">
				<div class="card-header">Modifier Prestation Location remorque</div>
				<div class="card-body bg-light">
					<a href="<?php echo BASE_URL;?>home" class="btn btn-sm btn-secondary mr-2 mb-2">
						<i class="fas fa-home"></i>
					</a>
					<form method="post"><br>
					<div class="form-group">
					<label style="margin-bottom : 8px;" for="date">Code Escale</label>
					<select name="code_esc" class="form-control">                   
                        <?php foreach ($navire as $newrow) {
                            echo '<option  value="' . $newrow["code_escale"] . '">' . $newrow["code_escale"] . '</option>';} ?>
                        <option selected="selected" value="<?php echo $location->code_escale;?>"><?php echo $location->code_escale;?></option>
					</select>
					<input type="hidden" name="id" value="<?php echo $location->id;?>">	
                    </div><br>
                    <div class="form-group">
							<label style="margin-bottom : 8px;" for="date">Date debut</label>
							<input type="date" name="date" class="form-control" placeholder="Date"
                            value="<?php echo $location->date_debut; ?>">
					</div><br>
                    <div class="form-group">
							<label style="margin-bottom : 8px;" for="time">Temps entrée</label>
							<input type="time" name="time_entr" class="form-control" placeholder="Temps entrée"
                            value="<?php echo $location->temps_entrée; ?>">
					</div><br>
					<div class="form-group">
							<label style="margin-bottom : 8px;" for="time">Temps sortie</label>
							<input type="time" name="time_sort" class="form-control" placeholder="Temps sortie"
                            value="<?php echo $location->temps_sortie; ?>">
					</div>
					<br></br>
					<div class="form-group">
							<label style="margin-bottom : 8px;" for="time">Nombre Remorque</label>
							<input type="text" name="nombre_remorque" class="form-control" placeholder="Nombre Remorque"
                            value="<?php echo $location->nombre_remorque; ?>">
					</div>
                    <br></br>
					<div class="form-group">
							<label style="margin-bottom : 8px;" for="nombre">Commande</label>
							<input type="text" name="commande" class="form-control" placeholder="Commande"
							value="<?php echo $location->commande; ?>">
					</div>
                    <br></br>
                    <div class="form-group">
							<button type="submit2" class="btn btn-primary" name="submit2">Valider</button>
					</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>