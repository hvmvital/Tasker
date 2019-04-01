<link rel="shortcut icon" type="image/png" href="/favicon.png"/>
<?php
// -- Controleur frontal --

require_once('./controleur/ActionBuilder.class.php');
require_once('./controleur/RequirePRGAction.interface.php');

$action = NULL;
$vue = NULL;

if (ISSET($_REQUEST["action"]))
	{
		$action = ActionBuilder::getAction($_REQUEST["action"]);
		$vue = $action->execute();
		
	}
else	
	{
		$action = ActionBuilder::getAction("");
		$vue = $action->execute();
	}
	
if ($action instanceof RequirePRGAction) 
	{
	//La méthode execute() d'une RequirePRGAction doit retourner le nom de l'action
	//qu'on doit fournir dans le redirect.
	header("Location: ?action=".$vue);
}	
else 
	{	
	// On affiche la page (vue)
	
	include "vues/main.php";


	}
?>

