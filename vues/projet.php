
<?php
	require_once('./modele/classes/Projet.class.php');
	require_once('./modele/classes/ListeProjets.class.php');
	require_once('./modele/ProjetDAO.class.php');
	
	require_once('./modele/classes/Taches.class.php');
	require_once('./modele/classes/ListeTaches.class.php');
	require_once('./modele/TacheDAO.class.php');
	
	require_once('./modele/classes/Adhesion.class.php');
	require_once('./modele/classes/ListeAdherentProjet.class.php');
	require_once('./modele/AdhesionDAO.class.php');
	

	
	
	if (ISSET($_REQUEST['numeroProjet'])){
		
		$numProjet = $_REQUEST['numeroProjet'];	
	}
	 else {
		$numProjet = $_SESSION['numeroProjet'];
	 }
	
	$daoAd = new AdhesionDAO();
	$a = $daoAd->findMyAdherent($numProjet);
	
	
	$courrielConnected = $_SESSION['connected'];

	$dao = new ProjetDAO();
	$p = $dao->find($numProjet);
		////////////////////////////    CARD PROJET    ////////////////////////////////////////////////
		echo '<div class="sectionTitle mb-3">Projet  "'.$p->getNomProjet().'"</div>';
		echo '<div class="lead d-flex justify-content-center mb-2" style="margin-left: 20%; margin-right: 20%;" >'.$p->getDescription().'</div>
				
				<div class="d-flex justify-content-end mb-0">
					';
					/* ---------------------------------------  BUTTON JOIN   --------------------------------------- */
					if ($courrielConnected != $p->getCourriel() && $daoAd->ifFindMyAdherent($numProjet, $courrielConnected) != true)
						{  echo '
						
						
						<div class="pt-2 pb-2 ml-2 mr-2">
							<form  method="post" action="?action=creerInvitationRec">										<!-- BTN JOINDRE-->
								<input type="hidden" name="numeroProjet" value="'.$p->getNumProjet().'">
								<input type="hidden" name="membreAInviter" value="'.$courrielConnected.'">
								
								<input  type="submit" value="Joindre" 
									class="btn btn-success btn-sm rounded" style="padding: 5px 15px; " >
							</form>
							
	
						</div>
						
					';}
						/* ---------------------------------------  BUTTON QUITTER   --------------------------------------- */
					if ($courrielConnected != $p->getCourriel() && $daoAd->ifFindMyAdherent($numProjet, $courrielConnected) == true )
						{

						$listeAdh = $daoAd->findMyAdherentByCourriel($numProjet, $courrielConnected);						
						$listeAdh->next();		
						$adh = $listeAdh->getCurrent(); 
						$numAdhesionASupp = $adh->getNumAdhesion() ;
						
						 
						
					
						
						
					
					echo  '
						
						<div class="pt-2 pb-2">
							<form class="col" method="post" action="?action=suppAdherent">							<!-- BTN ABBANDONER-->

								<input type="hidden" name="numAdhesion" value="'.$numAdhesionASupp.'">
								
								<input  type="hidden" name="numeroProjet" value="'.$numProjet.'">
								<input type="hidden" name="courrielAd" value="'.$courrielConnected.'">
								<input  type="submit" value="Quitter Projet" 
									class="btn btn-danger btn-sm rounded" style="padding: 5px 15px; "> 			
							</form>
						</div>
								
						';}
						/* ---------------------------------------  BUTTON ADD TASK  --------------------------------------- */
					if ($courrielConnected == $p->getCourriel() )
						{  echo '
						<div class="pt-2 pb-2 ml-2 mr-2">
							<input  
								data-target="#addTask" 
								data-toggle="modal"
								type="submit" 
								value="Ajouter Tàche"
								class="btn btn-info btn-sm rounded " style="padding: 5px 15px; ">
						</div>
						<div class="modal fade"	id="addTask" 
												tabindex="-1" role="dialog"	aria-labelledby="updateTache" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<form method="post" action="?action=ajouterTache" style="margin-bottom: 5px;">
										<div class="modal-header">
											<p class="card-title mb-0" id="updateTache" >Ajouter tàche</p>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											
												<p class="card-title text-dark mb-1">Nom</p>
												<input  type="hidden" name="numeroProjet" value="'.$numProjet.'">
												<textarea  name="nom" class="form-control" rows="2"></textarea>
										
												

											
										</div>
										<div class="modal-footer">
										<input  type="submit" value=" &nbsp Ajouter tàche &nbsp" class="btn btn-primary btn-md rounded"	>
										<button type="button" class="btn btn-danger rounded" data-dismiss="modal">&nbsp Annuler &nbsp</button>
										
										</div>
									</form>
								</div>
							</div>
						</div>					
						<!-- ---------------------------------------  END ADD TASK   --------------------------------------- -->
						
						
						
				
				<!-- ---------------------------------------      BUTTON INVITER MEMBRE          ---------------------------------------	 -->	
				<div class="pt-2 pb-2 ml-2 mr-2">
					<input  
						data-target="#inviterMembre" 
						data-toggle="modal"
						type="submit" 
						value="Inviter Membre"
						class="btn btn-warning btn-sm rounded " style="padding: 5px 15px; ">
				</div>
				
				<div class="modal fade"	id="inviterMembre" tabindex="-1" role="dialog"	aria-labelledby="inviterMembre" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form method="post" action="?action=creerInvitationEnv" style="margin-bottom: 5px;" >
								<div class="modal-header">
									<p class="card-title mb-0" id="inviterMembre" >Inviter Membre</p>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<input type="hidden" name="numeroProjet" value="'.$numProjet.'">
									<input type="hidden" name="gestionnaire" value="'.$p->getCourriel().'">
									
									<select name="membreAInviter" class="form-control">
									';
									
									$daoInvEnv = new InvitEnvDAO();
									$daoInvRec = new InvitRecDAO();
									$daoMembre = new MembreDAO();

									$mem = $daoMembre->findAll();
									$listeMembres = $daoMembre->findAll();
													
									 while ($listeMembres->next())
									{ 
										$mem = $listeMembres->getCurrent(); 
										if ($mem != null 																// On verifie si au moins un Membre existe 
											&& $mem->getCourriel() != $courrielConnected 								// On verifie si Membre n'est pas le GESTIONNAIRE
											&& $daoAd->ifFindMyAdherent($numProjet, $mem->getCourriel()) != true 		// On verifie si Membre est déja dans l'Équipe
											&& (($daoInvEnv->ifInvDejaEnvoyee($numProjet, $mem->getCourriel()) != true) // On verifie si Membre est déja invité par le GESTIONNAIRE
											|| ($daoInvRec->ifInvDejaRecue($numProjet, $mem->getCourriel()) != true)	// On verifie si Membre est déja envoyé la Demande	
											))
										{
											echo '<option value="'.$mem->getCourriel().'">'.$mem->getPrenom().' '.$mem->getNom().'</option> ' ;
										}
									}
									echo '
									 </select>

									 
								</div>
								<div class="modal-footer">
									<input  type="submit" value=" &nbsp INVITER &nbsp" class="btn btn-primary btn-md rounded"	>
									<button type="button" class="btn btn-danger rounded" data-dismiss="modal">&nbsp Annuler &nbsp</button>									
								</div>
							</form>
						</div>
					</div>
				</div>
					<!-- ---------------------------------------      END INVITER MEMBRE          --------------------------------------- -->	
					
					
					<!-- ---------------------------------------  BUTTON MODIFY PROJECT   --------------------------------------- -->
						<div class="pt-2 pb-2 ml-2 mr-2">
							<input  
								data-target="#modifyProjet" 
								data-toggle="modal"
								type="submit" 
								value="Modifier Projet"
								class="btn btn-secondary btn-sm rounded " style="padding: 5px 15px; ">
						</div>
						<div class="modal fade"	id="modifyProjet" 
												tabindex="-1" role="dialog"	aria-labelledby="modifyProjet" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<form method="post" action="?action=updateProjet" style="margin-bottom: 5px;" >
										<div class="modal-header">
											<p class="card-title mb-0" id="modifyProjet" >Modifier Projet</p>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<input  type="hidden" name="numeroProjet" value="'.$numProjet.'">
											<h6 class="card-title text-dark">Nom du projet</h6>
											<textarea name="nomProjet" class="form-control"  rows="1">'.$p->getNomProjet().'</textarea>
											<br/>
											<h6 class="card-title">Description</h6></label>
											<textarea name="description" class="form-control"  rows="3">'.$p->getDescription().'</textarea>
											
										</div>
										<div class="modal-footer">
										<input  type="submit" value=" &nbsp METTRE À JOUR &nbsp" class="btn btn-primary btn-md rounded"	>
										<button type="button" class="btn btn-danger rounded" data-dismiss="modal">&nbsp Annuler &nbsp</button>
										
										</div>
									</form>
								</div>
							</div>
						</div>
						
						
						
						
				<!-- ---------------------------------------  END  MODIFY PROJECT   --------------------------------------- -->
				
					
					
					<!-- ---------------------------------------      BUTTON AJOUTER PROJET          --------------------------------------- -->
					  <div class="pt-2 pb-2 ml-2 mr-2">
							<input  
								data-target="#createProjet" 
								data-toggle="modal"
								type="submit" 
								value="Ajouter Projet"
								class="btn btn-secondary btn-sm rounded " style="padding: 5px 15px; ">
						</div>
						<div class="modal fade"	id="createProjet" 
												tabindex="-1" role="dialog"	aria-labelledby="createProjet" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<form method="post" action="?action=creerProjet" style="margin-bottom: 5px;" >
										<div class="modal-header">
											<p class="card-title mb-0" id="createProjet" >Ajouter Projet</p>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<input  type="hidden" name="numeroProjet" value="'.$numProjet.'">
											<h6 class="card-title text-dark">Nom du Projet</h6>
											<textarea name="nom" class="form-control" rows="1"></textarea>	
												<br/>
											<h6 class="card-title text-dark">Description</h6>
											<textarea name="description" class="form-control" rows="3"></textarea>	
											
											
										</div>
										<div class="modal-footer">
										<input  type="submit" value=" &nbsp AJOUTER PROJET &nbsp" class="btn btn-primary btn-md rounded"	>
										<button type="button" class="btn btn-danger rounded" data-dismiss="modal">&nbsp Annuler &nbsp</button>
										
										</div>
									</form>
								</div>
							</div>
						</div>

					
					
					';}
					echo '
					
					
					<!-- ---------------------------------------  GESTIONNAIRE   --------------------------------------- -->
					<div class="p-0  ml-1">
						<strong>Gestionnaire</strong><br/>
						'.$p->getCourriel().'
						
					</div>
					<!-- ---------------------------------------  END GESTIONNAIRE   --------------------------------------- -->
					
					';
					echo '
					
					
										
				</div> 	<!-- END FLEX BUTTONS GES -->	

	
	
		<div class="row"> 
';	

		
echo ////////////////////////////    CARD LISTE DES TACHES  /////////////////////////////////////////////////  
	 '
	<div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-8">
		<div class="card mb-3">
			<div class="card-header bg-info pb-1" >
				<h4 class="card-title  ">Liste des tâches</h4>	
			</div>
			<div id="tacheCardBody" class="card-body">
				<table id="tableTache">
					<thead>
						<tr>
						<center>
						  <th>#</th>
						  <th>Tâche</th>
						  <th>État</th>
						  <th>Donneur</th>
						  <th>Responsable</th>
						  <th><img style="height: 40px;" 
									  src=\'./img/icons8-finish-flag-filled-64.png\' 
									  onmouseover="this.src=\'./img/icons8-finish-flag-64.png\'" 
									  onmouseout="this.src=\'./img/icons8-finish-flag-filled-64.png\'">
							</th>
						  <th>
							<img style="width: 36px;" 
									  src=\'./img/icons8-helping-hand-filled-64.png\' 
									  onmouseover="this.src=\'./img/icons8-helping-hand-64.png\'" 
									  onmouseout="this.src=\'./img/icons8-helping-hand-filled-64.png\'">
						  </th>
						  <th>
							<img style="width: 36px;" 
									  src=\'./img/icons8-pencil-filled-64.png\' 
									  onmouseover="this.src=\'./img/icons8-pencil-64.png\'" 
									  onmouseout="this.src=\'./img/icons8-pencil-filled-64.png\'">
						  </th>
						  <th>
							<img style="width: 36px;" 
									  src=\'./img/icons8-remove-filled-64.png\' 
									  onmouseover="this.src=\'./img/icons8-remove-64.png\'" 
									  onmouseout="this.src=\'./img/icons8-remove-filled-64.png\'">
						  </th>
						</center>
						</tr>
					</thead>
					';


		$dao = new TacheDAO();
		$t = $dao->findMyTaches($numProjet);
			 $liste = $dao->findMyTaches($numProjet);
			 while ($liste->next())
			{ 
				$t = $liste->getCurrent(); 
				if ($t!=null)
				{	
					echo '
						<tr align="center" >
							<td class="pt-0 mt-0">'.$t->getNumTaches().'</td>
							<td align="left" style="padding-left: 3%; " class="pt-0 mt-0">
								<strong>'.$t->getNomTaches().'</strong>
							</td>
							
							<td class="pt-0 mt-0">'
							; 
							if ($t->getEtat() == "terminee") 
							{  echo '
							
								  <img style="width: 50px;" title="Tâche terminée"
								  src=\'./img/icons8-finish-flag-filled-64.png\' 
								  onmouseover="this.src=\'./img/icons8-finish-flag-64.png\'" 
								  onmouseout="this.src=\'./img/icons8-finish-flag-filled-64.png\'">
							
							';} 
							if ($t->getEtat() == "en cours" ) 
							{  echo '
							
								  <img style="width: 36px;" title="Tâche en cours" 
								  src=\'./img/icons8-process-64.png\' 
								  onmouseover="this.src=\'./img/icons8-process-filled-64.png\'" 
								  onmouseout="this.src=\'./img/icons8-process-64.png\'">
						
							';} 
							if ($t->getEtat() == "non demarree") 
							{  echo '
							
								  <img style="width: 36px;" title="Tâche non demarrée"
								  src=\'./img/icons8-sleep-64.png\' 
								  onmouseover="this.src=\'./img/icons8-sleep-filled-64.png\'" 
								  onmouseout="this.src=\'./img/icons8-sleep-64.png\'">
							
							';}  echo'
							</td>
							<td>
							';
								$daoMembre = new MembreDAO();
								if ($daoMembre->find($t->getCourriel())){
								$memT = $daoMembre->find($t->getCourriel());
							echo ' <p class="text-secondary"><span class="text-dark">
										<strong>'.$memT->getPrenom().' '.$memT->getNom().'</strong></span><br/> '.$t->getCourriel().'
									<p>' ;
										
								} echo '
							
							</td>
								<td>
							';
								$daoMembre = new MembreDAO();
								if ($daoMembre->find($t->getCourriel())){
								$memT = $daoMembre->find($t->getCourriel());
							echo ' <p class="text-secondary"><span class="text-dark">
										<strong>'.$memT->getPrenom().' '.$memT->getNom().'</strong></span><br/> '.$t->getCourriel().'
									<p>' ;
										
								} echo '
							
							</td>
							

							<td>
								'; 
								if (($t->getCourriel() == $courrielConnected || $daoAd->ifFindMyAdherent($numProjet, $courrielConnected) == true)
									&& $t->getEtat() != "terminee") 
								
							{  
							echo '
							
							<form method="post" action="?action=terminerTache">
								<input type="hidden" name="numeroTache" value="'.$t->getNumTaches().'">
								<input type="hidden" name="courrielConnected" value="'.$courrielConnected.'">		
								<input type="hidden" name="numeroProjet" value="'.$p->getNumProjet().'">
								
								<input  type="image" width="50" title="Terminer Tâche"
								  src=\'./img/icons8-finish-flag-64.png\' 
								  onmouseover="this.src=\'./img/icons8-finish-flag-filled-64.png\'" 
								  onmouseout="this.src=\'./img/icons8-finish-flag-64.png\'">
							</form>
							';} echo'
							<td>'
							; 
							////////////////////////////    S'ATTRIBUER TÂCHE  /////////////////////////////////////////////////
							if ($t->getCourriel() == null && 
								(
								($daoAd->ifFindMyAdherent($numProjet, $courrielConnected) == true) 
								|| ($courrielConnected == $p->getCourriel()))) 
							{  echo '
							
							<form method="post" action="?action=sattribuerTache">
								<input type="hidden" name="numeroTache" value="'.$t->getNumTaches().'">
								<input type="hidden" name="courrielConnected" value="'.$courrielConnected.'">		
								<input type="hidden" name="numeroProjet" value="'.$p->getNumProjet().'">
								
								<input  type="image" width="36" title="S\'attribuer Tâche"
								  src=\'./img/icons8-helping-hand-64.png\' 
								  onmouseover="this.src=\'./img/icons8-helping-hand-filled-64.png\'" 
								  onmouseout="this.src=\'./img/icons8-helping-hand-64.png\'">
							</form>
							';}
							////////////////////////////    LAISSER TÂCHE  /////////////////////////////////////////////////
							if (($courrielConnected == $t->getCourriel() && $t->getEtat() != "terminee" ) 
								||  ($courrielConnected == $p->getCourriel() && $t->getEtat() == "en cours"))
							{  echo '
														  
								<form method="post" action="?action=laisserTache">
									<input type="hidden" name="numeroTache" value="'.$t->getNumTaches().'">				
									<input type="hidden" name="numeroProjet" value="'.$p->getNumProjet().'">
									
									<input  type="image" width="36" title="Laisser Tâche"
									  src=\'./img/icons8-disclaimer-64.png\' 
									  onmouseover="this.src=\'./img/icons8-disclaimer-filled-64.png\'" 
									  onmouseout="this.src=\'./img/icons8-disclaimer-64.png\'">
								</form> 
								  
							';} echo'
							</td>
							<td>
							
								'; 
								if ($courrielConnected == $p->getCourriel()) 
								{ 
								////////////////////////////    MODIFIER TÂCHE  ///////////////////////////////////////////////// 						
								echo '	
								
			
								
									<input  
										data-target="#updateTache'.$t->getNumTaches().'" 
										data-toggle="modal"
										type="image" width="36" title="Modifier"
										src=\'./img/icons8-pencil-64.png\' 
										onmouseover="this.src=\'./img/icons8-pencil-filled-64.png\'" 
										onmouseout="this.src=\'./img/icons8-pencil-64.png\'">
										

									
									
								 <form method="post" action="?action=updateTache">		
									<div class="modal fade"	id="updateTache'.$t->getNumTaches().'" 
											tabindex="-1" role="dialog"	aria-labelledby="updateTache" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
												<h5 class="modal-title" id="updateTache" >Modifier Tâche</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												  <span aria-hidden="true">&times;</span>
												</button>
											    </div>
											    <div class="modal-body">
											 
													<input  type="hidden" name="numeroProjet" value="'.$numProjet.'">
													<input  type="hidden" name="numeroTacheUpdate" value="'.$t->getNumTaches().'">
													<br/>
													<label  style="float: left; margin-bottom: 0px;" for="nomTacheUpdate"><h6>Nom de la Tâche</h6></label>
													<textarea  name="nomTacheUpdate" class="form-control" rows="1">'.$t->getNomTaches().'</textarea>
													<br/><br/>
													<label style="float: left; margin-bottom: 0px;" for="courrielUpdate"><h6>Responsable</h6></label>
													
													<select name="courrielUpdate" class="form-control">
														';
														

														$listeAdh = $daoAd->findMyAdherent($numProjet);
								
															 while ($listeAdh->next())
															{ 
																$a = $listeAdh->getCurrent(); 
																if ($a!=null)
																{
																	echo '<option value="'.$a->getCourriel().'">'.$a->getCourriel().' </option> ' ;
															
																} 
															}
															echo


														'
													</select>
													
													<!--<textarea  name="courrielUpdate" class="form-control" rows="1">'.$t->getCourriel().'</textarea>-->
													
											    </div>
											    <div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
												<input  
													type="submit" 
													value=" &nbsp Mettre à jour Tâche &nbsp" 
													class="btn btn-primary btn-sm" 
													style="padding: 7px 15px; margin: 10px 0; " >
												</form>
											    </div>
											</div>
										</div>
									</div>	
								
																		

							
								
							';} echo'
							
							
							</td>
							<td>
							
							'; 
							////////////////////////////    DELETE TÂCHE  /////////////////////////////////////////////////
							if ($courrielConnected == $p->getCourriel())  
							{  echo '
							
								<form method="post" action="?action=suppTache">
									<input type="hidden" name="numeroTache" value="'.$t->getNumTaches().'">				
									<input type="hidden" name="numeroProjet" value="'.$p->getNumProjet().'">
									
									<input  type="image" width="36" title="Supprimer"
									  src=\'./img/icons8-remove-64.png\' 
									  onmouseover="this.src=\'./img/icons8-remove-filled-64.png\'" 
									  onmouseout="this.src=\'./img/icons8-remove-64.png\'">
								</form>
							
							';}	echo'
						
							</td>
							
						</tr>
						';
				} 
			}
			echo '

			</table>
			</div> <!-- END class CARD BODY -->
		</div> <!-- END class CARD LISTE -->
	</div> <!-- END class COL LISTE -->
			
			 '; 
//////////////////////////////////////////////////////////////////////////////////////////////////////////
			 
			 echo 
////////////////////////////    CARD Liste des ADHERENTS    //////////////////////////////////////////////// 
'
	<div class="col-12 col-sm-12 col-md-12 col-lg-5  col-xl-4">
		<div class="card mb-3">
			<div class="card-header bg-warning pb-1" >
				<h4 class="card-title">Équipe</h4>
			</div>
			
			<div class="card-body">
				<table id="tableTache">
					<thead>
						<tr>
							<center>
							  <th>#</th>
							  <th>Projet</th>
							  <th>Adherent</th>
							  <th>
							  </th>
							</center>
						</tr>
					</thead>
					';


			
			
			$listeAdh = $daoAd->findMyAdherent($numProjet);				
						
	while ($listeAdh->next())
		{ 
			$a = $listeAdh->getCurrent(); 
			if ($a!=null)
			{			
					////////////////////////////    AFFICHE MEMBRE ADHERENT  /////////////////////////////////////////////////
				echo '
					<tr align="center">
						<td class="pt-0 mt-0">'.$a->getNumAdhesion().'</td>
						<td class="pt-0 mt-0">'.$a->getNumProjet().'</td>
						<td align="center" class="pl-3 pb-0">
							
							';
							$daoMembre = new MembreDAO();
							$memAd = $daoMembre->find($a->getCourriel());
							echo ' 	<p class="text-secondary"><span class="text-dark">
										<strong>'.$memAd->getPrenom().' '.$memAd->getNom().'</strong></span><br/> '.$a->getCourriel().'
									<p>' ;
										
									echo '
						</td>
					
					<td>
					';
					
					
					////////////////////////////    DELETE MEMBRE ADHERENT  /////////////////////////////////////////////////
					if ($courrielConnected == $p->getCourriel())  
							{  echo '
							
								<form method="post" action="?action=suppAdherent">
									<input type="hidden" name="numAdhesion" value="'.$a->getNumAdhesion().'">				
									<input  type="hidden" name="numeroProjet" value="'.$numProjet.'">
									<input type="hidden" name="courrielAd" value="'.$a->getCourriel().'">
									
									
									<input  type="image" width="25" title="Supprimer" 
									  src=\'./img/icons8-delete-100.png\' 
									  onmouseover="this.src=\'./img/icons8-delete-filled-100.png\'" 
									  onmouseout="this.src=\'./img/icons8-delete-100.png\'">
								</form>
							
							';} 	
						echo'
						
							</td>	
							</tr>
						';
					
			} //end if
		} //end while

				echo '
				</table>
				</div> <!-- END class CARD BODY -->
			</div> <!-- END class CARD LISTE -->
		</div> <!-- END class COL LISTE -->
	
</div> <!-- END class ROW -->

';
	
					
?>