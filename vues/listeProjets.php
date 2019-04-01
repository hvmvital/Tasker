 

<!-- SECTION PROJETS -->
<section class="lastProjects bg-none">
<div class="sectionTitle  mb-3" >Liste des Projets</div>
<div class="row">


 <?php
	require_once('./modele/classes/Projet.class.php');
	require_once('./modele/classes/ListeProjets.class.php');
	require_once('./modele/ProjetDAO.class.php');
	$dao = new ProjetDAO();
	$daoT = new TacheDAO();
	$daoA = new AdhesionDAO();
	
	
	
	$liste = $dao->findAll();
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
						
						
						<p class="card-text ">'.$p->getDescription().'</p>
						
						<div class="stats-card d-flex">
						
								<div class="ml-0" >
									
									<img data-toggle="tooltip"
										height="22px"
										title="'.$daoA->getNbrAdherentsByProjet($p->getNumProjet()).' adherents" 										
										src="./img/icons8-user-account-30.png">
									<span>'.$daoA->getNbrAdherentsByProjet($p->getNumProjet()).'</span>
								</div>
								<div class="mr-auto">
									<img data-toggle="tooltip"
										height="22px" 
										title="'.$daoT->getNbrTachesByProjet($p->getNumProjet()).' tàches" 
										src="./img/icons8-todo-list-filled-30.png">
									<span>'.$daoT->getNbrTachesByProjet($p->getNumProjet()).'</span>
								</div>
						
							<div class="p-0">
								<form   method="post" action="?action=projet" >
									<input type="hidden" name="numeroProjet" value="'.$p->getNumProjet().'">
									<input type="submit" value="Détails" data-toggle="tooltip"  title="Voir les détails du projet" class="btn btn-primary btn-sm rounded align-bottom" >	
								</form>
							</div>
						</div>
						
					</div>
				</div>
			</div>';

		
		}
	}
	
					

	
 ?>
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
