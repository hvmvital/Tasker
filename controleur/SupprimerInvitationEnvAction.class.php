<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/InvitEnvDAO.class.php');
require_once('./modele/classes/InvitationEnvoye.class.php');
require_once('/controleur/RequirePRGAction.interface.php');

class SupprimerInvitationEnvAction implements Action, RequirePRGAction {

	
	
	public function execute(){
		
		$numeroInv = $_REQUEST['numeroInv'];	
		
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connected"]))
			return "login";

		if ($_REQUEST["typeInv"] == "RecuGes")
		{
			
			if ($_REQUEST["numeroInv"] != "")
			{
				$dao = new InvitRecDAO();
				$ir = new InvitationRecu();
				$ir->setNumInvRec($numeroInv);
				$dao->delete($ir);
			} 
		} else {
			if ($_REQUEST["numeroInv"] != "")
			{
				$dao = new InvitEnvDAO();
				$x = new InvitationEnvoye();
				$x->setNumInvEnv($numeroInv);
				$dao->delete($x);
			}		
		}
		
		
		return "invitationsEnvoyees";
	}
}
?>

