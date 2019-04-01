<?php

require_once('./modele/classes/Projet.class.php');
	require_once('./modele/classes/InvitationEnvoye.class.php');
	require_once('./modele/classes/listeInvitEnv.class.php');
	require_once('./modele/InvitEnvDAO.class.php');
	require_once('./modele/ProjetDAO.class.php');
	
	
	$courriel =  $_SESSION['connected'];
?>
<section class="lastProjects mt-3 pt-3">
<div class="row">
	<div class="col-6">
	<div class="sectionTitle col-12 mb-3" >Invitations reçues</div>

	<!-- START ROW 1 -->
	<div class="row">
	
	<?php
	$daoEnv = new InvitEnvDAO();
	$ie = $daoEnv->findMyInvitEnv($courriel);
		 $liste = $daoEnv->findMyInvitEnv($courriel);
		 
		 $daoP = new ProjetDAO();
		 
		 
		 while ($liste->next())
		{ 
			$ie = $liste->getCurrent(); 
			if ($ie!=null && $ie->getEtat() == "en_attente")
			{
				$p = $daoP->find($ie->getNumProjet());
				
				echo '
				<div class="col-sm-12 col-md-12 col-lg-6">
					<div class="card border-dark mb-3">
						<div class="card-header bg-dark pb-0">
							<h5 class="card-title text-light" >INVITATION reçue #'.$ie->getNumInvEnv().'</h5>
						</div>
						<div class="card-body ">
						<form  method="post" action="?action=projet">										
									<input type="hidden" name="numeroProjet" value="'.$p->getNumProjet().'">
							<p class="card-text text-dark">
									Projet :	<strong><input  type="submit" value="'.$p->getNomProjet().'" 
										class="btn btn-light border-dark btn-sm" style="padding: 0px 7px; " ></strong><br/>	
								
								Membre : <strong>'.$ie->getCourriel().'</strong><br/>
								Gestionnaire : <strong>'.$p->getCourriel().'</strong> VOUS INVITE</br>
								Etat : <strong>'.$ie->getEtat().'</strong>
								
							</p>
							</form>
							<div class="d-flex justify-content-center">
								<form method="post" action="?action=accepterInvitation" style="margin: 0 5px;" >
									<input type="hidden" name="typeInv" value="">
									<input type="hidden" name="numeroProjet" value="'.$ie->getNumProjet().'">
									<input type="hidden" name="numeroInv" value="'.$ie->getNumInvEnv().'">
									<input  type="submit" value="&nbsp Accepter &nbsp" 
										class="col col-sm-12 col-lg-12 btn btn-info btn-sm rounded" >
					
								</form>
								<form method="post" action="?action=refuserInvitation" style="margin: 0 5px;" >
									<input type="hidden" name="typeInv" value="">
									<input type="hidden" name="numeroProjet" value="'.$ie->getNumProjet().'">
									<input type="hidden" name="numeroInv" value="'.$ie->getNumInvEnv().'">
									<input type="hidden" name="courrielAInviter" value="'.$ie->getCourriel().'">
									<input  type="submit" value="&nbsp Refuser &nbsp" 
										class="col col-sm-12 col-lg-12 btn btn-danger btn-sm rounded" >

								</form>
							</div>
						</div>
					</div>
				</div>';
			} 
		}


		
		$daoRecGes = new InvitRecDAO();
		$ieRecGes = $daoRecGes->findMyInvitRecGes($courriel);
		$liste = $daoRecGes->findMyInvitRecGes($courriel);
		
		 while ($liste->next())
		{ 
			$ieRecGes = $liste->getCurrent();
				
			
			if ($ieRecGes != null && $ieRecGes->getEtat() == "en_attente" )
			{
				$daoP = new ProjetDAO();
				$pr = $daoP->find($ieRecGes->getNumProjet());
				
				
				echo '
				<div class="col-sm-12 col-md-12 col-lg-6">
					<div class="card border-dark mb-3">
						<div class="card-header bg-success pb-0">
							
							<h5 class="card-title text-light" >DEMANDE de PARTICIPATION reçue #'.$ieRecGes->getNumInvRec().'</h5>
						</div>
						<div class="card-body">
						<form  method="post" action="?action=projet">										
									<input type="hidden" name="numeroProjet" value="'.$pr->getNumProjet().'">
							<p class="card-text   text-dark">
									Projet :	<strong><input  type="submit" value="'.$pr->getNomProjet().'" 
										class="btn btn-light border-dark btn-sm " style="padding: 0px 7px; " ></strong><br/>	
								
								Membre : <strong>'.$ieRecGes->getCourriel().'</strong> veut participer dans votre projet '.$pr->getNomProjet().'<br/>
								Gestionnaire : <strong>'.$pr->getCourriel().'</strong><br/>
								Etat : <strong>'.$ieRecGes->getEtat().'</strong>
								
							</p>
							</form>
							<div class="d-flex justify-content-center">
								<form method="post" action="?action=accepterInvitation" style="margin: 0 5px;" >
									<input type="hidden" name="typeInv" value="RecuGes">
									<input type="hidden" name="numeroProjet" value="'.$ieRecGes->getNumProjet().'">
									<input type="hidden" name="numeroInv" value="'.$ieRecGes->getNumInvRec().'">
									<input type="hidden" name="courrielAInviter" value="'.$ieRecGes->getCourriel().'">
									<input  type="submit" value="&nbsp Accepter &nbsp" 
										class="col col-sm-12 col-lg-12 btn btn-info btn-sm rounded" >

								</form>
								<form method="post" action="?action=refuserInvitation" style="margin: 0 5px;" >
									<input type="hidden" name="typeInv" value="RecuGes">
									<input type="hidden" name="numeroProjet" value="'.$ieRecGes->getNumProjet().'">
									<input type="hidden" name="numeroInv" value="'.$ieRecGes->getNumInvRec().'">
									<input type="hidden" name="courrielAInviter" value="'.$ieRecGes->getCourriel().'">
									<input  type="submit" value="&nbsp Refuser &nbsp" 
										class="col col-sm-12 col-lg-12 btn btn-danger btn-sm rounded" >

								</form>
								
							</div>
						</div>
					</div>
				</div>';
			} 
		}
		
	?>
	</div> <!-- END ROW 1 -->
</div>









	

	<div class="col-6">
	<div class="sectionTitle col-12  mb-3" >Invitations envoyées</div>
	<div class="row"> <!-- START ROW 2 -->
	<?php
		$daoP = new ProjetDAO();
		
		$daoEnvGes = new InvitEnvDAO();
		$ieG = $daoEnvGes->findMyInvitEnvGes($courriel);
		$liste = $daoEnvGes->findMyInvitEnvGes($courriel);
		
		 while ($liste->next())
		{ 
			$ieG = $liste->getCurrent();
				
			
			if ($ieG != null && $ieG->getEtat() == "en_attente" )
			{
				$daoP = new ProjetDAO();
				$pr = $daoP->find($ieG->getNumProjet());
				
				
				echo '
				<div class="col-sm-12 col-md-12 col-lg-6">
					<div class="card border-dark mb-3">
						<div class="card-header bg-info pb-0">
							
							<h5 class="card-title text-light" >Invitation envoyée #'.$ieG->getNumInvEnv().'</h5>
						</div>
						<div class="card-body">
						<form  method="post" action="?action=projet">										
									<input type="hidden" name="numeroProjet" value="'.$pr->getNumProjet().'">
							<p class="card-text   text-dark">
									Projet :	<strong><input  type="submit" value="'.$pr->getNomProjet().'" 
										class="btn btn-light border-dark btn-sm " style="padding: 0px 7px; " ></strong><br/>	
								
								Membre : <strong>'.$ieG->getCourriel().'</strong><br/>
								Gestionnaire : <strong>'.$pr->getCourriel().'</strong><br/>
								Etat : <strong>'.$ieG->getEtat().'</strong>
								
							</p>
							</form>
							<div class="d-flex justify-content-center">
								
								<form method="post" action="?action=suppInvitation" style="margin: 0 5px;" >
									<input type="hidden" name="numeroInv" value="'.$ieG->getNumInvEnv().'">
									<input type="hidden" name="typeInv" value="RecuEnv">
									<input  type="submit" value="&nbsp Annuler &nbsp" 
										class="col col-sm-12 col-lg-12 btn btn-danger btn-sm rounded" >

								</form>
							</div>
						</div>
					</div>
				</div>';
			} 
		}

		
		
		$daoEnvMem = new InvitRecDAO();
		$ieM = $daoEnvMem->findMyInvitEnv($courriel);
		$liste = $daoEnvMem->findMyInvitEnv($courriel);
		
		 while ($liste->next())
		{ 
			$ieM = $liste->getCurrent();
				
			
			if ($ieM != null && $ieM->getEtat() == "en_attente" )
			{
				$daoP = new ProjetDAO();
				$pr = $daoP->find($ieM->getNumProjet());
				
				
				echo '
				<div class="col-sm-12 col-md-12 col-lg-6">
					<div class="card border-dark mb-3">
						<div class="card-header bg-success pb-0">
							
							<h5 class="card-title text-light" >DEMANDE de PARTICIPATION envoyée #'.$ieM->getNumInvRec().'</h5>
						</div>
						<div class="card-body">
						<form  method="post" action="?action=projet">										
									<input type="hidden" name="numeroProjet" value="'.$pr->getNumProjet().'">
							<p class="card-text   text-dark">
									Projet :	<strong><input  type="submit" value="'.$pr->getNomProjet().'" 
										class="btn btn-light border-dark btn-sm " style="padding: 0px 7px; " ></strong><br/>	
								
								Membre : <strong>'.$ieM->getCourriel().'</strong><br/>
								Gestionnaire : <strong>'.$pr->getCourriel().'</strong><br/>
								Etat : <strong>'.$ieM->getEtat().'</strong>
								
							</p>
							</form>
							<div class="d-flex justify-content-center">
								
								<form method="post" action="?action=suppInvitation" style="margin: 0 5px;" >
									<input type="hidden" name="numeroInv" value="'.$ieM->getNumInvRec().'">
									<input type="hidden" name="typeInv" value="RecuGes">
									<input  type="submit" value="&nbsp Annuler &nbsp" 
										class="col col-sm-12 col-lg-12 btn btn-danger btn-sm rounded" >

								</form>
							</div>
						</div>
					</div>
				</div>';
			} 
		}

	?>

	</div> <!-- END ROW 2 -->
</div> <!-- END MAIN ROW  -->
</section>



