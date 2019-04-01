
<?php
require_once('./controleur/Action.interface.php');


class LoginAction implements Action {
	public function execute(){
		session_cache_limiter('private, must-revalidate');
		session_cache_expire(60);
		
		if (!ISSET($_REQUEST["courriel"]))
			return "login";
		if (!$this->valide())
		{
			//$_REQUEST["global_message"] = "Le formulaire contient des erreurs. Veuillez les corriger.";	
			return "login";
		}

		require_once('./modele/MembreDAO.class.php');
		$udao = new MembreDAO();
		$user = $udao->find($_REQUEST["courriel"]);
		if ($user == null)
			{
				$_REQUEST["field_messages"]["courriel"] = "Utilisateur inexistant.";	
				return "login";
			}
		else if ($user->getPassword() != $_REQUEST["password"])
			{
				$_REQUEST["field_messages"]["password"] = "Mot de passe incorrect.";	
				return "login";
			}
		if (!ISSET($_SESSION)) session_start();
		$_SESSION["connected"] = $_REQUEST["courriel"];

		return "mesProjets";
	}
	public function valide()
	{
		$result = true;
		if ($_REQUEST['courriel'] == "")
		{
			$_REQUEST["field_messages"]["courriel"] = "Donnez votre nom d'utilisateur";
			$result = false;
		}	
		if ($_REQUEST['password'] == "")
		{
			$_REQUEST["field_messages"]["password"] = "Mot de passe obligatoire";
			$result = false;
		}	
		return $result;
	}
}
?>