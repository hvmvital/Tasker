<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/ProjetDAO.class.php');
require_once('./modele/classes/Projet.class.php');
require_once('/controleur/RequirePRGAction.interface.php');

class UpdateProjetAction implements Action, RequirePRGAction {

	
	public function execute(){
		
		$numeroProjet = $_REQUEST["numeroProjet"];
		
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connected"]))
			return "login";


		
		$_SESSION['numeroProjet']= $numeroProjet;
		
		if (ISSET($_REQUEST["numeroProjet"]))
		{
			$dao = new ProjetDAO();
			$x = new Projet();

			$x->setNumProjet($_REQUEST["numeroProjet"]);
			
			$x->setNomProjet($_REQUEST["nomProjet"]);
			$x->setDescription($_REQUEST["description"]);
			$dao->update($x);
		}
		return "projet";
	}
}
?>

