<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/TacheDAO.class.php');
require_once('./modele/classes/Taches.class.php');
require_once('/controleur/RequirePRGAction.interface.php');

class AjouterTacheAction implements Action, RequirePRGAction {
	
	
	public function execute(){

		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connected"]))
			return "login";
		
		$nomTache = $_POST['nom'];
		$numeroProjet = $_POST['numeroProjet'];		
		
		$_SESSION['numeroProjet']= $numeroProjet;
		
		if ($_REQUEST["nom"] != "")
		{
			
				$dao = new TacheDAO();
				$x = new taches();
				
				$x->setNumProjet($numeroProjet);
				$x->setNomTaches($nomTache);			
				$x->setEtat("non demarree");
				$x->setCourriel("");
				$x->setDonneur("");
				
				$dao->create($x);
			
		}
		return "projet";
	}
}
?>

