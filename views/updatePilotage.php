<?php 
	if(isset($_POST['id'])){
		$exitNavire = new NavireController();
		$navire = $exitNavire->getAllNavire();
		$exitPilotage = new PilotageController();
		$pilotage = $exitPilotage->getOnePilotage();

	}
	if(isset($_POST['submit'])){
		$exitPilotage = new PilotageController();
		$exitPilotage->updatePrestation();
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
                        <option selected="selected" value="<?php echo $pilotage->code_escale;?>"><?php echo $pilotage->code_escale;?></option>
					</select>	
					<input type="hidden" name="id" value="<?php echo $pilotage->id;?>">

				</div><br>
					<div class="form-group">
							<label style="margin-bottom : 8px;" for="poste">Poste</label>
							<select class="form-control" name="poste">
								<option value="">Sélectionner</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="16 bis">16 bis</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="QP">QP</option>
								<option value="RoRo">RoRo</option>
								<option selected="selected" value="<?php echo $pilotage->poste;?>"><?php echo $pilotage->poste;?></option>
							</select>
					</div><br>
                    <div class="form-group">
							<label style="margin-bottom : 8px;" for="date">Date debut</label>
							<input type="date" name="date" class="form-control" placeholder="Date debut"
                            value="<?php echo $pilotage->date_debut; ?>">
					</div><br>
					<div class="form-group">
							<label style="margin-bottom : 8px;" for="date">Date fin</label>
							<input type="date" name="date_fin" class="form-control" placeholder="Date fin"
                            value="<?php echo $pilotage->date_fin; ?>">
					</div><br>
                    <div class="form-group">
							<label style="margin-bottom : 8px;" for="time">Temps entrée</label>
							<input type="time" name="time_entr" class="form-control" placeholder="Temps entrée"
                            value="<?php echo $pilotage->temps_entrée; ?>">
					</div><br>
					<div class="form-group">
							<label style="margin-bottom : 8px;" for="time">Temps sortie</label>
							<input type="time" name="time_sort" class="form-control" placeholder="Temps sortie"
                            value="<?php echo $pilotage->temps_sortie; ?>">
					</div>
                    <br></br>
                    <div class="form-group">
							<button type="submit" class="btn btn-primary" name="submit">Valider</button>
					</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>