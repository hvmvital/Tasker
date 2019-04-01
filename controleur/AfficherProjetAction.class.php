<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/classes/Projet.class.php');
require_once('./modele/ProjetDAO.class.php');

class AfficherProjetAction implements Action {
	public function execute(){
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connected"]))
			return "login";
		
		// $numeroProjet = $_REQUEST["numeroProjet"];
		// $_SESSION['numeroProjet']= $numeroProjet;
		
		return "projet";
	}
}
?>