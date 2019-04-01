<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/classes/InvitationEnvoye.class.php');
require_once('./modele/InvitEnvDAO.class.php');

class AfficherInvitEnvAction implements Action {
	public function execute(){
		if (!ISSET($_SESSION)) session_start();
		
		return "InvitationsEnvoyees";
	}
}
?>