<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/InvitEnvDAO.class.php');
require_once('./modele/classes/InvitationEnvoye.class.php');

require_once('./modele/InvitRecDAO.class.php');
require_once('./modele/classes/InvitationRecu.class.php');

require_once('/controleur/RequirePRGAction.interface.php');

class AccepterInvAction implements Action, RequirePRGAction {
	

	public function execute(){
		
		session_start();
		
		$numeroProjet = $_REQUEST['numeroProjet'];
		$numeroInv = $_REQUEST['numeroInv'];	
		$_SESSION['numeroProjet']= $numeroProjet;
		//$_SESSION['numeroInv']= $numeroInv;
		
		$_SESSION['courrielAInviter'] = $_REQUEST['courrielAInviter'];
		$_SESSION['typeInv'] = $_REQUEST['typeInv'];
		
		if ($_REQUEST["typeInv"] == "RecuGes")
		{
			
			
			if ($_REQUEST["numeroInv"] != "")
			{
				$dao = new InvitRecDAO();
				$ir = new InvitationRecu();
				$ir->setNumInvRec($numeroInv);
				$ir->setNumProjet($numeroProjet);
				$dao->accepterInv($ir);
			} 
		} else {
			if ($_REQUEST["numeroInv"] != "")
			{
				$dao = new InvitEnvDAO();
				$x = new InvitationEnvoye();
				$x->setNumInvEnv($numeroInv);
				$x->setNumProjet($numeroProjet);
				$dao->accepterInv($x);
			}		
		}
		return "ajouterAdhesion";
	}
	
}
?>

