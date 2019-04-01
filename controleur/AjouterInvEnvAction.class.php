<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/InvitEnvDAO.class.php');
require_once('./modele/classes/InvitationEnvoye.class.php');
require_once('/controleur/RequirePRGAction.interface.php');

class AjouterInvEnvAction implements Action, RequirePRGAction {
	
	
	public function execute(){

	 	$courriel = $_REQUEST['membreAInviter'];
		$numeroProjet = $_POST['numeroProjet'];	
		
		
		
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connected"]))
			return "login";
		
		$_SESSION['numeroProjet'] = $numeroProjet;
		
		//$courrielConnected = $_SESSION['connected'];


		if (($_REQUEST["membreAInviter"]) != "")
		{
			$dao = new InvitEnvDAO();
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

