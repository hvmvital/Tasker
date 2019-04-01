<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/InvitRecDAO.class.php');
require_once('./modele/classes/InvitationRecu.class.php');
require_once('/controleur/RequirePRGAction.interface.php');

class AjouterInvRecAction implements Action, RequirePRGAction {
	
	
	public function execute(){

	 	$courriel = $_REQUEST['membreAInviter'];
		$numeroProjet = $_POST['numeroProjet'];	
		
		
		
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connected"]))
			return "login";
		
		$_SESSION['numeroProjet'] = $numeroProjet;
		$_SESSION["membreAInviter"] = $courriel;
		//$courrielConnected = $_SESSION['connected'];


		if (($_REQUEST["membreAInviter"]) != "")
		{
			$dao = new InvitRecDAO();
			$x = new InvitationEnvoye();		
			$x->setNumProjet($numeroProjet);
			$x->setCourriel($courriel);
			$x->setEtat('en_attente');
			
			$dao->create($x);
			
		
			
		}
		return "projet";
			
	}
}
?>

