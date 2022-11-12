<?php 
	if(isset($_POST['id'])){
		$exitNavire = new NavireController();
		$navire = $exitNavire->getAllNavire();
		$exitRemorquage = new RemorquageController();
		$remorquage = $exitRemorquage->getOneRemorquage();
	}
	if(isset($_POST['submit2'])){
		$exitRemorquage = new RemorquageController();
		$exitRemorquage->update0Prestation();
	}
?>
<div class="container">
	<div class="row my-4">
		<div class="col-md-8 mx-auto">
			<div class="card">
				<div class="card-header">Modifier Prestation Pilotage</div>
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
                        <option selected="selected" value="<?php echo $remorquage->code_escale;?>"><?php echo $remorquage->code_escale;?></option>
					</select>
					<input type="hidden" name="id" value="<?php echo $remorquage->id;?>">
                    </div><br>
                    <div class="form-group">
							<label style="margin-bottom : 8px;" for="date">Date debut</label>
							<input type="date" name="date" class="form-control" placeholder="Date debut"
                            value="<?php echo $remorquage->date_debut; ?>">
					</div><br>
					<div class="form-group">
							<label style="margin-bottom : 8px;" for="date">Date debut</label>
							<input type="date" name="date_fin" class="form-control" placeholder="Date fin"
                            value="<?php echo $remorquage->date_fin; ?>">
					</div><br>
                    <div class="form-group">
							<label style="margin-bottom : 8px;" for="time">Temps entrée</label>
							<input type="time" name="time_entr" class="form-control" placeholder="Temps entrée"
                            value="<?php echo $remorquage->temps_entrée; ?>">
					</div><br>
					<div class="form-group">
							<label style="margin-bottom : 8px;" for="time">Temps sortie</label>
							<input type="time" name="time_sort" class="form-control" placeholder="Temps sortie"
                            value="<?php echo $remorquage->temps_sortie; ?>">
					</div><br>
					<div class="form-group">
							<label style="margin-bottom : 8px;" for="nombre">Nombre de remorque</label>
							<input type="number" name="nombre_remorque" class="form-control" placeholder="Nombre de remorque"
							value="<?php echo $remorquage->nombre_remorque; ?>">
					</div>
                    <br></br>
                    <div class="form-group">
							<button type="submit" class="btn btn-primary" name="submit2">Valider</button>
					</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>