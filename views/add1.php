<?php
  if(isset($_POST['submit2'])){
	$newPrestation2 = new LocationController();
	$newPrestation2->add1Prestation();
}
if (empty($_POST['navire'])){header('location: home');}
?>  
<div class="container">
	<div class="row my-4">
		<div class="col-md-8 mx-auto">
			<div class="card">
				<div class="card-header">Ajouter une Prestation Location Remorque</div>
				<div class="card-body bg-light">
					<a href="<?php echo BASE_URL;?>home" class="btn btn-sm btn-secondary mr-2 mb-2">
						<i class="fas fa-home"></i>
					</a>
                    <form method="post"><br>
					<div class="form-group">
                        <label style="margin-bottom : 8px;" for="code">Code Escale</label>
                        <input type="text" name="code_esc" class="form-control" value="<?php echo $_POST['navire'];?>" readonly >
                    </div><br>
                    <div class="form-group">
                        <label style="margin-bottom : 8px;" for="code">Commande</label>
                        <input type="text" name="commande" class="form-control" placeholder="Commande">
                    </div><br>
                    <div class="form-group">
							<label style="margin-bottom : 8px;" for="date">Date debut</label>
							<input type="date" name="date" class="form-control" placeholder="Date">
					</div><br>
                    <div class="form-group">
							<label style="margin-bottom : 8px;" for="time">Temps entrée</label>
							<input type="time" name="time_entr" class="form-control" placeholder="Temps entrée">
					</div><br>
					<div class="form-group">
							<label style="margin-bottom : 8px;" for="time">Temps sortie</label>
							<input type="time" name="time_sort" class="form-control" placeholder="Temps sortie">
					</div>
                    <br>
					<div class="form-group">
							<label style="margin-bottom : 8px;" for="nombre">Nombre Remorque</label>
							<input type="text" name="nombre_remorque" class="form-control" placeholder="Nombre Remorque">
					</div></br></br>
                    <div class="form-group">
							<button type="submit2" class="btn btn-primary" name="submit2">Valider</button>
							<button class="btn btn-outline-dark" formaction= 'home0'><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
					</div>
                </div>
            </div>
			</form>
        </div>
    </div>
</div>
                    