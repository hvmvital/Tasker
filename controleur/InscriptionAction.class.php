<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/MembreDAO.class.php');
class InscriptionAction implements Action {
	public function execute(){
		if (!ISSET($_SESSION)) session_start();
		if (ISSET($_SESSION["connected"]))	//déjà connecté
			return "default";

		if (!ISSET($_REQUEST["username"]))
			return "register";
		if (!$this->valide())
			return "register";
		$dao = new MembreDAO();
		$x = new Membre();		
		$x->setCourriel($_REQUEST["username"]);
		$x->setNom($_REQUEST["name"]);
		$x->setPrenom($_REQUEST["prenom"]);
		$x->setPassword($_REQUEST["password"]);
		if(!$dao->create($x)) {
			$_REQUEST["field_messages"]["username"] = "Cet utilisateur existe d&eacute;j&agrave;";
			return "register";
		}
		return "login";
	}
	public function valide()
	{
		$result = true;
		if ($_REQUEST['username'] == "")
		{
			$_REQUEST["field_messages"]["username"] = "Donnez votre courriel";
			$result = false;
		}	
		if ($_REQUEST['name'] == "")
		{
			$_REQUEST["field_messages"]["name"] = "Donnez votre nom d'utilisateur";
			$result = false;
		}
		if ($_REQUEST['prenom'] == "")
		{
			$_REQUEST["field_messages"]["prenom"] = "Donnez votre prenom d'utilisateur";
			$result = false;
		}
		if ($_REQUEST['password'] == "")
		{
			$_REQUEST["field_messages"]["password"] = "Mot de passe obligatoire";
			$result = false;
		}
		if ($_REQUEST['password'] != $_REQUEST['password2'])
		{
			$_REQUEST["field_messages"]["password2"] = "Les 2 mots de passe doivent &ecirc;tre identiques";
			$result = false;
		}
		return $result;
	}	
}
?>