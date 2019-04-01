<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/AdhesionDAO.class.php');
require_once('./modele/classes/Adhesion.class.php');
require_once('/controleur/RequirePRGAction.interface.php');

class AjouterAdhesionAction implements Action, RequirePRGAction {
	
	
	public function execute(){

	 	//$courriel = $_SESSION["connected"];
		//$numeroProjet = $_SESSION['numeroProjet'];	
		
		
		
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connected"]))
			return "login";
		
		//$_SESSION['numeroProjet'] = $numeroProjet;
		
		
		
		
		$daoAd = new AdhesionDAO();
		
		if ($_SESSION['courrielAInviter'] != "")
		{

			
			$a = new Adhesion();		
			$a->setNumProjet($_SESSION['numeroProjet']);
			$a->setCourriel($_SESSION['courrielAInviter']);
			
			$daoAd->create($a);	
		} else {
		
			
			$a = new Adhesion();		
			$a->setNumProjet($_SESSION['numeroProjet']);
			$a->setCourriel($_SESSION['connected']);
			
			$daoAd->create($a);			
		}		
		
	
		
		return "projet";
			
	}
}
?>

