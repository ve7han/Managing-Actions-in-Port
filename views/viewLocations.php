<?php
	if(isset($_POST['id'])){
		$exitLocations = new LocationController();
		$Locations = $exitLocations->getOneLocation();
		$exitNavire = new NavireController();
		$navire = $exitNavire->getOneNavire();
	}else{
		Redirect::to('home');
	}
?>      
<div class="container">
    <div class="row my-4">
        <div class="col-md-10 mx-auto">
            <div class="card">
			<div class="card-body bg-light">
				<div class="header">
                    <h4> View Location Remorque</h4><br>
					<?php if (!empty($navire)) {?>
					<p>Code Escale: <?php echo $navire->code_escale;?></p>
					<p>Nom Bateau: <?php echo $navire->nom_bateau;?></p>
					<p>Nationalité: <?php echo $navire->Nationalité;?></p>
					<p>Type Navire: <?php echo $navire->type_navire;?></p>
					<p>Jauge: <?php echo $navire->jauge;}?></p>
                </div>
					<a class="btn btn-outline-secondary" href="<?php echo BASE_URL;?>home0"><i class="fa fa-home" aria-hidden="true"></i></a>

						<table class="table table-hover">
							<thead>
								<tr>
								<th scope="col">Command</th>
								<th scope="col">Date</th>
                                <th scope="col">Code Prestation</th>
								<th scope="col">Type Operation</th>
								<th scope="col">Nombre Remorque</th>
								</tr>
							</thead>
							<tbody>
									<tr> 
									<th scope="row"><?php echo $Locations->commande;?></th>
									<td><?php echo $Locations->date_debut;?></td>
									<td><?php echo '20304';?></td>
									<td><?php echo  'Loc. Remorqueur A L\'Heure Au Port JO';?></td>
									<td><?php echo $Locations->nombre_remorque;?></td>
									<td class="d-flex flex-row">
									</tbody>
						</table>	
				</div>
            </div>
        </div>
	</div>
</div>