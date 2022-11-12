<?php
	if(isset($_POST['id'])){
		$exitRemorquage = new RemorquageController();
		$Remorquage = $exitRemorquage->getOneRemorquage();
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
                    <h4> View Remorquage</h4><br>
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
								<th scope="col">Date Debut</th>
								<th scope="col">Date fin</th>
								<th scope="col">Code Prestation</th>
                                <th scope="col">Type Opération</th>
								<th scope="col">Nombre Remorque</th>
								</tr>
							</thead>
									<tr> 
									<th scope="row"><?php echo $Remorquage->date_debut.' ' ?></th>
									<th scope="row"><?php echo $Remorquage->date_fin.' ' ?></th>
									<td><?php echo '20302';?></td>
									<td><?php echo  'Remorquage';?></td>
									<td><?php echo substr($Remorquage->quantité_unité, 0,1);?></td>
									<td class="d-flex flex-row">
									</tbody>
									<tbody>
									<tr> <?php if (strpos($Remorquage->quantité_unité, 'supplément')){ ?>
									<th scope="row"><?php echo $Remorquage->date_debut.' ' ?></th>
									<th scope="row"><?php echo $Remorquage->date_fin.' ' ?></th>
									<td><?php echo '20303';?></td>
									<td><?php echo  'Supplement Remorquage';?></td>
									<td><?php echo $Remorquage->quantité_unité;?></td>
									<td class="d-flex flex-row">
									</tbody>
									<tbody> <?php } ?>
						</table>	
				</div>
            </div>
        </div>
	</div>
</div>