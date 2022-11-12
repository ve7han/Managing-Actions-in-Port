<?php
    $data=new PilotageController();
    $pilotages=$data->getAllPrestation();

?>      
<div class="container">
    <div class="row my-4">
        <div class="col-md-10 mx-auto">
            <div class="card">
			<div class="card-body bg-light">
				<div class="header">
                    <h4>Pilotage</h4>
                </div>
					<a class="btn btn-outline-secondary" href="<?php echo BASE_URL;?>home0"><i class="fa fa-home" aria-hidden="true"></i></a>
						<table class="table table-hover">
							<thead>
								<tr>
								<th scope="col">Code Escale</th>
								<th scope="col">Date debut</th>
								<th scope="col">Date fin</th>
								<th scope="col">Temps entrée</th>
								<th scope="col">Temps sortie</th>
								<th scope="col">Quantité unité</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($pilotages as $pilotage):?>
									<tr>
									<th scope="row"><?php echo $pilotage['code_escale'].' ' ?></th>
									<td><?php echo $pilotage['date_debut'];?></td>
									<td><?php echo $pilotage['date_fin'];?></td>
									<td><?php echo $pilotage['temps_entrée'];?></td>
									<td><?php echo $pilotage['temps_sortie'];?></td>
									<td><?php echo $pilotage['quantité_unité'];?></td>
									<td class="d-flex flex-row">
										<p>
										<form method="post" class="mr-1" action="viewPilotage">
											<input type="hidden" name="code_escale" value="<?php echo $pilotage['code_escale'];?>">
											<input type="hidden" name="id" value="<?php echo $pilotage['id'];?>">
											<button class="btn btn-sm btn-success"><i class="fa fa-book"></i></button>
										</form>
										</p>
										<p>
										<form method="post" class="mr-1" action="updatePilotage">
											<input type="hidden" name="id" value="<?php echo $pilotage['id'];?>">
											<button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
										</form>
										</p>
										<p>
										<form method="post" class="mr-1" action="deletePilotage">
											<input type="hidden" name="id" value="<?php echo $pilotage['id'];?>">
											<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
										</form>
										</p>
									</td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
						
				</div>
            </div>
        </div>
	</div>
</div>

<?php
    $data1=new RemorquageController();
    $remorquages=$data1->getAllPrestation();
?>     
<div class="container">
    <div class="row my-4">
        <div class="col-md-10 mx-auto">
            <div class="card">
			<div class="card-body bg-light">
				<div class="header">
                    <h4>Remorquage</h4>
                </div>
					<a class="btn btn-outline-secondary" href="<?php echo BASE_URL;?>home0"><i class="fa fa-home" aria-hidden="true"></i></a>
						<table class="table table-hover">
							<thead>
								<tr>
								<th scope="col">Code Escale</th>
								<th scope="col">Date debut</th>
								<th scope="col">Date fin</th>
								<th scope="col">Temps entrée</th>
								<th scope="col">Temps sortie</th>
								<th scope="col">Nombre de remorque</th>
								<th scope="col">Quantité unité</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($remorquages as $remorquage):?>
									<tr>
									<th scope="row"><?php echo $remorquage['code_escale'].' ' ?></th>
									<td><?php echo $remorquage['date_debut'];?></td>
									<td><?php echo $remorquage['date_fin'];?></td>
									<td><?php echo $remorquage['temps_entrée'];?></td>
									<td><?php echo $remorquage['temps_sortie'];?></td>
									<td><?php echo $remorquage['nombre_remorque'];?></td>
									<td><?php echo $remorquage['quantité_unité'];?></td>
									<td class="d-flex flex-row">
										<form method="post" class="mr-1" action="viewRemorquage">
											<input type="hidden" name="code_escale" value="<?php echo $remorquage['code_escale'];?>">
											<input type="hidden" name="id" value="<?php echo $remorquage['id'];?>">
											<button class="btn btn-sm btn-success"><i class="fa fa-book"></i></button>
										</form>
										<form method="post" class="mr-1" action="updateRemorquage">
											<input type="hidden" name="id" value="<?php echo $remorquage['id'];?>">
											<button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
										</form>
										<form method="post" class="mr-1" action="deleteRemorquage">
											<input type="hidden" name="id" value="<?php echo $remorquage['id'];?>">
											<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
										</form>
									</td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
				</div>
            </div>
        </div>
	</div>
</div>

<?php
    $data2=new LocationController();
    $locations=$data2->getAllPrestation();
?>     
<div class="container">
    <div class="row my-4">
        <div class="col-md-10 mx-auto">
            <div class="card">
			<div class="card-body bg-light">
				<div class="header">
                    <h4>Location Remorque</h4>
                </div>
					<a class="btn btn-outline-secondary" href="<?php echo BASE_URL;?>home0"><i class="fa fa-home" aria-hidden="true"></i></a>
						<table class="table table-hover">
							<thead>
								<tr>
								<th scope="col">Code Escale</th>
								<th scope="col">Commande</th>
								<th scope="col">Date debut</th>
								<th scope="col">Temps entrée</th>
								<th scope="col">Temps sortie</th>
								<th scope="col">Nombre de remorque</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($locations as $location):?>
									<tr>
									<th scope="row"><?php echo $location['code_escale'].' ' ?></th>
									<td><?php echo $location['commande'];?></td>
									<td><?php echo $location['date_debut'];?></td>
									<td><?php echo $location['temps_entrée'];?></td>
									<td><?php echo $location['temps_sortie'];?></td>
									<td><?php echo $location['nombre_remorque'];?></td>
									<td class="d-flex flex-row">
										<form method="post" class="mr-1" action="viewLocations">
											<input type="hidden" name="code_escale" value="<?php echo $location['code_escale'];?>">
											<input type="hidden" name="id" value="<?php echo $location['id'];?>">
											<button class="btn btn-sm btn-success"><i class="fa fa-book"></i></button>
										</form>
										<form method="post" class="mr-1" action="updateLocation">
											<input type="hidden" name="id" value="<?php echo $location['id'];?>">
											<button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
										</form>
										<form method="post" class="mr-1" action="deleteLocation">
											<input type="hidden" name="id" value="<?php echo $location['id'];?>">
											<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
										</form>
									</td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>	
				</div>
            </div>
        </div>
	</div>
</div>
		