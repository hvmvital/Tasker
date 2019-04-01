

<!-- MY PROJECTS -->
<section class="lastProjects">
<div class="sectionTitle mb-3" >Mes Projets</div>
<div class="row">
<?php
require_once('./modele/classes/Projet.class.php');
require_once('./modele/classes/ListeProjets.class.php');
require_once('./modele/ProjetDAO.class.php');

	$dao = new ProjetDAO();
	$daoT = new TacheDAO();
	$daoA = new AdhesionDAO();


$courriel = $_SESSION['connected'];



echo '	
	<div class="col-sm-6 col-md-4 col-lg-3">
		<div class="card mb-3">
			<div class="card-header bg-warning text-light" style="padding-bottom: 0px;">
					<h5 class="card-title" >NOUVEAU PROJET </h5>
			</div>
			<div class="card-body ">
					<form method="post" action="?action=creerProjet" style="margin-bottom: 0;">
						<h6 class=" text-dark">Nom</h6>
						<textarea name="nom" class="form-control" rows="1"></textarea>	
							<br/>
						<h6 class=" text-dark">Description</h6>
						<textarea name="description" class="form-control" rows="3"></textarea>	
							<br/>
							
						<input  type="submit" value="Creer projet" 
							class="col col-sm-12 col-lg-12 btn btn-primary btn-sm" 
							style="margin-left:auto; margin-right:auto;" >
					</form>
			</div>
			
		</div>
	</div>

	

';		


$p = $dao->findMyProjects($courriel);
	 $liste = $dao->findMyProjects($courriel);
	 while ($liste->next())
	{ 
		$p = $liste->getCurrent(); 
		if ($p!=null)
		{
			echo '
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card bg-white mb-3">
					<div class="card-header pb-0" >
							<a href="?action=projet&&numeroProjet='.$p->getNumProjet().'"><h6 class="card-title text-dark" >'.$p->getNomProjet().'</h6></a>
					</div>
					<div class="card-body pb-0" >
						<p class="card-text">'.$p->getDescription().'</p>
						
						<div class="stats-card d-flex">
						
								<div class="ml-0" >
									
									<img 
										height="22px"
										title="'.$daoA->getNbrAdherentsByProjet($p->getNumProjet()).' adherents" 										
										src="./img/icons8-user-account-30.png">
									<span>'.$daoA->getNbrAdherentsByProjet($p->getNumProjet()).'</span>
								</div>
								<div class="mr-auto">
									<img 
										height="22px" 
										title="'.$daoT->getNbrTachesByProjet($p->getNumProjet()).' tàches" 
										src="./img/icons8-todo-list-filled-30.png">
									<span>'.$daoT->getNbrTachesByProjet($p->getNumProjet()).'</span>
								</div>
						
							<div class="p-0">
								<form   method="post" action="?action=projet" >
									<input type="hidden" name="numeroProjet" value="'.$p->getNumProjet().'">
									<input type="submit" value="Détails" class="btn btn-primary btn-sm rounded align-bottom" >	
								</form>
							</div>
						</div>
						
					</div>
				</div>
			</div>';
		} 
	} 
//////////////////////////////////////////////////////////////////////////////

?>
</div> <!-- END ROW -->
</section>

 <script> 
 $('.col-lg-3, .col-md-4').hover(
		function() {
	  		$(this).animate({
	  			marginTop: "-=0.5%",

		  	}, 200);
		},

		function() {
			$(this).animate({
	  		marginTop: "0%"
	  		}, 200);
	  	}
	);
	

</script>

