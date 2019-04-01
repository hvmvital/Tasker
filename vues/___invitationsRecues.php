

<!-- MY PROJECTS -->
<section class="lastProjects">
<div class="sectionTitle" >Invitations reçues</div>
<div class="row">
<?php
	require_once('./modele/classes/InvitationRecu.class.php');
	require_once('./modele/classes/ListeInvitRec.class.php');
	require_once('./modele/InvitRecDAO.class.php');
	$daoRec = new InvitRecDAO();
	
	
$courriel =  $_SESSION['connected'];
$ir = $daoRec->findMyInvitRec($courriel);
	 $liste = $daoRec->findMyInvitRec($courriel);
	 while ($liste->next())
	{ 
		$ir = $liste->getCurrent(); 
		if ($ir!=null)
		{
			echo '
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="card border-warning mb-3">
					<div class="card-header bg-warning" style="padding-bottom: 0px;">
						<h5 class="card-title" >'.$ir->getNumInvRec().'</h5>
					</div>
					<div class="card-body ">
						<p class="card-text text-dark">Projet: '.$ir->getNumProjet().'<br/>
						Membre: '.$ir->getCourriel().'</p>
						<div class="d-flex justify-content-center">
							<form method="post" action="?action=accepterInvitation" style="margin: 0 5px;">
								<input type="hidden" name="numeroProjet" value="'.$ir->getNumProjet().'">
								<input  type="submit" value="&nbsp Accepter &nbsp" 
									class="col col-sm-12 col-lg-12 btn btn-primary btn-sm"  >
							</form>
							<form method="post" action="?action=refuserInvitation" style="margin: 0 5px;" >
								<input type="hidden" name="numeroProjet" value="'.$ir->getNumProjet().'">
								<input  type="submit" value="&nbsp &nbsp Refuser &nbsp &nbsp" 
									class="col col-sm-12 col-lg-12 btn btn-danger btn-sm" >
							</form>
						</div>
					</div>
				</div>
			</div>';
		} /*else{
		echo "Gestionnaire: ".$courriel;
		}*/
	}
	
	
	
	require_once('./modele/classes/Projet.class.php');
	require_once('./modele/classes/InvitationEnvoye.class.php');
	require_once('./modele/classes/listeInvitEnv.class.php');
	require_once('./modele/InvitEnvDAO.class.php');
	require_once('./modele/ProjetDAO.class.php');
	$daoEnv = new InvitEnvDAO();

?>
<div class="sectionTitle" >Invitations envoyées</div>
<?php

$courriel =  $_SESSION['connected'];
$ie = $daoEnv->findMyInvitEnv($courriel);
	 $liste = $daoEnv->findMyInvitEnv($courriel);
	 while ($liste->next())
	{ 
		$ie = $liste->getCurrent(); 
		if ($ie!=null)
		{
			echo '
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="card border-dark mb-3">
					<div class="card-header bg-dark" style="padding-bottom: 0px;">
						<h5 class="card-title text-light" >'.$ie->getNumInvEnv().'</h5>
					</div>
					<div class="card-body ">
						<p class="card-text text-dark">Projet: '.$ie->getNumProjet().'<br/>
						Membre: '.$ie->getCourriel().'</p>
						
						<div class="d-flex justify-content-center">
							<form method="post" action="?action=annulerInvitation" style="margin: 0 5px;" >
								<input type="hidden" name="numeroProjet" value="'.$ie->getNumProjet().'">
								<input  type="submit" value="&nbsp Annuler &nbsp" 
									class="col col-sm-12 col-lg-12 btn btn-danger btn-sm" >
							</form>
						</div>
					</div>
				</div>
			</div>';
		} /*else{
		echo "Gestionnaire: ".$courriel;
		}*/
	}
?>

</div>
</section>



