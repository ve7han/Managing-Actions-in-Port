<?php
	if(isset($_POST['code_escale'])){
		$exitPilotage = new PilotageController();
		$pilotage = $exitPilotage->getOnePilotageByEscale();
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
                    <h4> View Pilotage</h4><br>
					<?php if (!empty($navire)) {?>
					<p>Code Escale: <?php echo $navire->code_escale;?></p>
					<p>Nom Bateau: <?php echo $navire->nom_bateau;?></p>
					<p>Nationalité: <?php echo $navire->Nationalité;?></p>
					<p>Type Navire: <?php echo $navire->type_navire;?></p>
					<p>Jauge: <?php echo $navire->jauge;?></p>
					<p>Poste: <?php echo $pilotage->poste;}?></p>

                </div>
					<a class="btn btn-outline-secondary" href="<?php echo BASE_URL;?>home0"><i class="fa fa-home" aria-hidden="true"></i></a>

						<table class="table table-hover">
							<thead>
								<tr>
								<th scope="col">Date Debut</th>
								<th scope="col">Date fin</th>
								<th scope="col">Code Prestation</th>
                                <th scope="col">Type Opération</th>
								<th scope="col">Type Mouvement</th>
								<th scope="col">Jour/Nuit/Férié</th>
								<th scope="col">Quantité unité</th>
								</tr>
							</thead>
							<tbody>
									<tr> 
									<?php if (!empty($pilotage)) {?>
									<th scope="row"><?php echo $pilotage->date_debut.' ' ?></th>
									<th scope="row"><?php echo $pilotage->date_fin.' ' ?></th>
									<td><?php echo '20501';?></td>
									<td><?php echo  'Pilotage';?></td>
									<td><?php echo 'Entrée';?></td>
									<td><?php if (strpos($pilotage->quantité_unité ,'J')){echo 'Jour' ;} if (strpos($pilotage->quantité_unité ,'N')){echo 'Nuit' ;} if (strpos($pilotage->quantité_unité ,'F')){echo 'Fériés ' ;} ?></td>
									<td><?php echo '1';?></td>
									<td class="d-flex flex-row">
									</tbody>
									<tbody>
									<tr> 
									<th scope="row"><?php echo $pilotage->date_debut.' ' ?></th>
									<th scope="row"><?php echo $pilotage->date_fin.' ' ?></th>
									<td><?php echo '20503';?></td>
									<td><?php echo  'Mise a quai';?></td>
									<td><?php echo 'Entrée';?></td>
									<td><?php if (strpos($pilotage->quantité_unité ,'J')){echo 'Jour' ;} if (strpos($pilotage->quantité_unité ,'N')){echo 'Nuit' ;} if (strpos($pilotage->quantité_unité ,'F')){echo 'Fériés ' ;} ?></td>
									<td><?php echo '1';?></td>
									<td class="d-flex flex-row">
									</tbody>
									<tbody>
									<tr> 
									<th scope="row"><?php echo $pilotage->date_debut.' ' ?></th>
									<th scope="row"><?php echo $pilotage->date_fin.' ' ?></th>
									<td><?php echo '20104';?></td>
									<td><?php echo  'Envoi d\'amarres sur ouvrage fixe';?></td>
									<td><?php echo 'Entrée';?></td>
									<td><?php if (strpos($pilotage->quantité_unité ,'J')){echo 'Jour' ;} if (strpos($pilotage->quantité_unité ,'N')){echo 'Nuit' ;} if (strpos($pilotage->quantité_unité ,'F')){echo 'Fériés ' ;} ?></td>
									<td><?php echo '1';?></td>
									<td class="d-flex flex-row">
									</tbody>
									<tbody>
									<tr> 
									<th scope="row"><?php echo $pilotage->date_debut.' ' ?></th>
									<th scope="row"><?php echo $pilotage->date_fin.' ' ?></th>
									<td><?php echo '20502';?></td>
									<td><?php echo  'Location de vedettes';?></td>
									<td><?php echo 'Entrée';?></td>
									<td><?php if (strpos($pilotage->quantité_unité ,'J')){echo 'Jour' ;} if (strpos($pilotage->quantité_unité ,'N')){echo 'Nuit' ;} if (strpos($pilotage->quantité_unité ,'F')){echo 'Fériés ' ;} ?></td>
									<td><?php if ($pilotage->poste === 'QP'){echo '6';}else{ echo preg_replace('/[^0-9]/', '', $pilotage->quantité_unité);} ?></td>
									<td class="d-flex flex-row">
									</tbody>
									<tbody>
									<tr> 
									<th scope="row"><?php echo $pilotage->date_debut.' ' ?></th>
									<th scope="row"><?php echo $pilotage->date_fin.' ' ?></th>
									<td><?php echo '20501';?></td>
									<td><?php echo  'Pilotage';?></td>
									<td><?php echo 'Sortie';?></td>
									<td><?php if (strpos($pilotage->quantité_unité ,'J')){echo 'Jour' ;} if (strpos($pilotage->quantité_unité ,'N')){echo 'Nuit' ;} if (strpos($pilotage->quantité_unité ,'F')){echo 'Fériés ' ;} ?></td>
									<td><?php echo '1';?></td>
									<td class="d-flex flex-row">
									</tbody>
									<tbody>
									<tr> 
									<th scope="row"><?php echo $pilotage->date_debut.' ' ?></th>
									<th scope="row"><?php echo $pilotage->date_fin.' ' ?></th>
									<td><?php echo '20107';?></td>
									<td><?php echo  'Balayage Navire'?></td>
									<td><?php echo 'Sortie';?></td>
									<td><?php if (strpos($pilotage->quantité_unité ,'J')){echo 'Jour' ;} if (strpos($pilotage->quantité_unité ,'N')){echo 'Nuit' ;} if (strpos($pilotage->quantité_unité ,'F')){echo 'Fériés ' ;} ?></td>
									<td><?php echo '1';?></td>
									<td class="d-flex flex-row">
									</tbody>
									<tbody>
									<tr> 
									<th scope="row"><?php echo $pilotage->date_debut.' ' ?></th>
									<th scope="row"><?php echo $pilotage->date_fin.' ' ?></th>
									<td><?php echo '20502';?></td>
									<td><?php echo  'Location de Vedettes';?></td>
									<td><?php echo 'Sortie';?></td>
									<td><?php if (strpos($pilotage->quantité_unité ,'J')){echo 'Jour' ;} if (strpos($pilotage->quantité_unité ,'N')){echo 'Nuit' ;} if (strpos($pilotage->quantité_unité ,'F')){echo 'Fériés ' ;} ?></td>
									<td><?php if ($pilotage->poste === 'QP'){echo '6';}else{ echo preg_replace('/[^0-9]/', '', $pilotage->quantité_unité);} }?></td>
									<td class="d-flex flex-row">
									</tbody>
									<?php if ($pilotage->poste === '16' OR $pilotage->poste === '16 bis' OR $pilotage->poste === '15'){}else{ ?>
									<tbody>
									<tr> 
									<th scope="row"><?php echo $pilotage->date_debut.' ' ?></th>
									<th scope="row"><?php echo $pilotage->date_fin.' ' ?></th>
									<td><?php echo '20101';?></td>
									<td><?php echo  'Operation Lamanage';?></td>
									<td><?php echo 'Entrée';?></td>
									<td><?php if (strpos($pilotage->quantité_unité ,'J')){echo 'Jour' ;} if (strpos($pilotage->quantité_unité ,'N')){echo 'Nuit' ;} if (strpos($pilotage->quantité_unité ,'F')){echo 'Fériés ' ;} ?></td>
									<td><?php echo '1';?></td>
									<td class="d-flex flex-row">
									</tbody>
									<?php } ?>
						</table>	
				</div>
            </div>
        </div>
	</div>
</div>
		