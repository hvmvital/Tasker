<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/ProjetDAO.class.php');
require_once('./modele/classes/Projet.class.php');
require_once('/controleur/RequirePRGAction.interface.php');

class CreerProjetAction implements Action, RequirePRGAction {
	
	
	public function execute(){

		$nom = $_POST['nom'];
		$description = $_POST['description'];

		
		
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connected"]))
			return "login";
		
		
		$courrielConnected = $_SESSION['connected'];


		if ($_REQUEST["nom"] != "")
		{
			$dao = new ProjetDAO();
			$x = new Projet();
			
			
			$x->setNomProjet($nom);
			$x->setDescription($description);
			$x->setCourriel($courrielConnected);
			
			$dao->create($x);
		}
		return "mesProjets";
			
	}
}
?>

