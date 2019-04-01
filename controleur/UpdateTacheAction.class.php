<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/TacheDAO.class.php');
require_once('./modele/classes/Taches.class.php');
require_once('/controleur/RequirePRGAction.interface.php');

class UpdateTacheAction implements Action, RequirePRGAction {

	
	public function execute(){
		$numeroProjet = $_REQUEST["numeroProjet"];
		
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connected"]))
			return "login";
		
		
		$_SESSION['numeroProjet']= $numeroProjet;

		if (ISSET($_REQUEST["numeroProjet"]))
		{
			$dao = new TacheDAO();
			$t = new Taches();

			$t->setNumTaches($_REQUEST["numeroTacheUpdate"]);	
			$t->setNomTaches($_REQUEST["nomTacheUpdate"]);
			$t->setCourriel($_REQUEST["courrielUpdate"]);
			$t->setNumTaches($_REQUEST["numeroTacheUpdate"]);	
			
			
			if ($_REQUEST["courrielUpdate"] != "")
			{
				$t->setEtat("en cours");
				$t->setDonneur($_SESSION["connected"]);
			}

			$dao->updateTache($t);
		}
		return "projet";
	}
}
?>

