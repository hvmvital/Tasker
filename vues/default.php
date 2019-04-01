<?php
	require_once('./modele/classes/Projet.class.php');
	require_once('./modele/ProjetDAO.class.php');
	
	require_once('./modele/classes/Taches.class.php');
	require_once('./modele/TacheDAO.class.php');
	
	require_once('./modele/classes/Membre.class.php');
	require_once('./modele/MembreDAO.class.php');
	
	$daoP = new ProjetDAO();
	$daoT = new TacheDAO();
	$daoM = new MembreDAO();
	
	$nbrM = $daoM->getNbrMembres();
	$nbrP = $daoP->getNbrProjects();
	$nbrT = $daoT->getNbrTaches();
	$sM= "";
	$sP= "";
	$sT= "";
	
	if ($nbrM > 1 || $nbrM == 0)
	{
		$sM= "S";
	}
	if ($nbrP > 1 || $nbrP == 0)
	{
		$sP= "S";
	}
	if ($nbrT > 1 || $nbrT == 0)
	{
		$sT= "S";
	}
	
?>
	<section class="accueilInfo">
		<div class="row" >
			<div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-8">
				<h1 class="display-4">TASKER - gestion de projets</h1>
				<p class="lead">Projet de session</p>
				<hr class="my-6">
				<p>Notre projet qui s’intitule “Gestion de tâches par équipes” consiste à  gérer des travaux ou projets d’équipes. Chaque projet a son propre gestionnaire et qui est en même temps le propriétaire.
Un projet peut avoir plusieurs tâches et plusieurs membres, ces tâches seront réparties entre les membres adhérents.</p>

				<p class="lead">
					<a  href="?action=listeProjets" class="btn btn-outline-danger btn-more btn-lg " role="button">VOIR LES PROJETS</a>
				</p>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-4">
			<img class="img-mainImg " src="./img/mainImg.png" >
			</div>
			
		</div>
	</section>
	
	
	<section class="mt-5">
		<div class="sectionTitle" >Statistique</div>
		<div class="stats d-flex mb-3 justify-content-center">
			<div><span><?php echo $nbrM ?></span><br/>MEMBRE<?php echo $sM ?><br/><img src="./img/icons8-user-male-filled-100.png"></div>
			<div><span><?php echo $nbrP ?></span><br/>PROJET<?php echo $sP ?><br/><img src="./img/icons8-goal1-filled-100.png"></div>
			<div><span><?php echo $nbrT ?></span><br/>TÀCHE<?php echo $sT ?><br/><img src="./img/icons8-list1-filled-100.png"></div>
		</div>
	</section>


