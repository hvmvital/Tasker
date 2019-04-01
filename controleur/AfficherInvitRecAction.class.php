<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/classes/InvitationRecu.class.php');
require_once('./modele/classes/ListeInvitRec.class.php');
require_once('./modele/InvitRecDAO.class.php');
	

class AfficherInvitRecAction implements Action {
	public function execute(){
		if (!ISSET($_SESSION)) session_start();
		
		return "InvitationsEnvoyees";
	}
}
?>