<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/classes/Taches.class.php');
require_once('./modele/TacheDAO.class.php');

class AfficherListeTachesAction implements Action {
	public function execute(){
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connected"]))
			return "login";
		
		
		return "listeTaches";
	}
}
?>