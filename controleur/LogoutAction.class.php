<?php
require_once('./controleur/Action.interface.php');
class LogoutAction implements Action {
	public function execute(){
		if (!ISSET($_SESSION)) session_start();
		UNSET($_SESSION["connected"]);
		session_destroy();
		return "default";
	} 
}
?>