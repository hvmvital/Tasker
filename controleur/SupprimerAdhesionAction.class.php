<?php
require_once('./controleur/Action.interface.php');

require_once('./modele/TacheDAO.class.php');
require_once('./modele/classes/Taches.class.php');

require_once('./modele/AdhesionDAO.class.php');
require_once('./modele/classes/Adhesion.class.php');
require_once('/controleur/RequirePRGAction.interface.php');

class SupprimerAdhesionAction implements Action, RequirePRGAction {

	
	public function execute(){
		$numeroProjet = $_REQUEST["numeroProjet"];
		$courriel = $_REQUEST["courrielAd"];
		
		
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connected"]))
			return "login";

		$_SESSION['numeroProjet']= $numeroProjet;
		
		if (ISSET($_REQUEST["numAdhesion"]))
		{
			
			$daoT = new TacheDAO();
			$daoT->laisserMesTachesAll($numeroProjet, $courriel);
			
			$dao = new AdhesionDAO();
			$x = new Adhesion();
			$x->setNumAdhesion($_REQUEST["numAdhesion"]);
			$dao->delete($x);
		}
		return "projet";
	}
}
?>

