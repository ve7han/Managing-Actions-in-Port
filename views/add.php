<?php
  if(isset($_POST['submit'])){
	$newPrestation = new PilotageController();
	$newPrestation->addPrestation();

if (empty($_POST['navire'])){header('location: home');}
?>  
<div class="container">
	<div class="row my-4">
		<div class="col-md-8 mx-auto">
			<div class="card">
				<div class="card-header">Ajouter une Prestation Pilotage</div>
				<div class="card-body bg-light">
					<a href="<?php echo BASE_URL;?>home" class="btn btn-sm btn-secondary mr-2 mb-2">
						<i class="fas fa-home"></i>
					</a>
                    <form method="post"><br>
					<div class="form-group">
                        <label style="margin-bottom : 8px;" for="code">Code Escale</label>
                        <input type="text"  name="code_esc"  class="form-control" value="<?php echo $_POST['navire'];?>" readonly >
                    </div><br>
					<div class="form-group">
							<label style="margin-bottom : 8px;" for="date">Poste</label>
							<select class="form-control" name="poste"  required>
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
							</select>
					</div><br>
                    <div class="form-group">
							<label style="margin-bottom : 8px;" for="date">Date debut</label>
							<input type="date" name="date" class="form-control" placeholder="Date debut">
					</div><br>
					<div class="form-group">
							<label style="margin-bottom : 8px;" for="date">Date fin</label>
							<input type="date" name="date_fin" class="form-control" placeholder="Date fin">
					</div><br>
                    <div class="form-group">
							<label style="margin-bottom : 8px;" for="time">Temps entrée</label>
							<input type="time" name="time_entr" class="form-control" placeholder="Temps entrée">
					</div><br>
					<div class="form-group">
							<label style="margin-bottom : 8px;" for="time">Temps sortie</label>
							<input type="time" name="time_sort" class="form-control" placeholder="Temps sortie">
					</div>
                    <br></br>
                    <div class="form-group">
							<button type="submit" class="btn btn-primary" name="submit">Valider</button>
							<button class="btn btn-outline-dark" formaction= 'home0'><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
					</div>
                </div>
            </div>
			</form>
        </div>
    </div>
</div>
                    