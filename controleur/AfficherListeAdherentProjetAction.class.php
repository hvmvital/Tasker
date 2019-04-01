<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/classes/Adhesion.class.php');
require_once('./modele/AdhesionDAO.class.php');

class AfficherListeAdherentProjetAction implements Action {
	public function execute(){
		if (!ISSET($_SESSION)) session_start();
		
		return "adherentProjet";
	}
}
?>