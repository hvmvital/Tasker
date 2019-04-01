<?php
require_once('./controleur/DefaultAction.class.php');
require_once('./controleur/AfficherProjetAction.class.php');
require_once('./controleur/AfficherListeProjetsAction.class.php');
require_once('./controleur/AfficherMesProjetsAction.class.php');
//require_once('./controleur/AfficherListeInvitEnvAction.class.php');

require_once('./controleur/AfficherInvitEnvAction.class.php');
//require_once('./controleur/AfficherInvitRecAction.class.php');
require_once('./controleur/CreerProjetAction.class.php');

require_once('./controleur/AccepterInvAction.class.php');
require_once('./controleur/RefuserInvAction.class.php');


require_once('./controleur/AjouterTacheAction.class.php');
require_once('./controleur/AjouterInvEnvAction.class.php');
require_once('./controleur/AjouterInvRecAction.class.php');
require_once('./controleur/AjouterAdhesionAction.class.php');


require_once('./controleur/SattribuerTacheAction.class.php');
require_once('./controleur/LaisserTacheAction.class.php');
require_once('./controleur/UpdateProjetAction.class.php');
require_once('./controleur/UpdateTacheAction.class.php');
require_once('./controleur/TerminerTacheAction.class.php');


require_once('./controleur/SupprimerInvitationEnvAction.class.php');
require_once('./controleur/SupprimerTacheAction.class.php');
require_once('./controleur/SupprimerAdhesionAction.class.php');

require_once('./controleur/LoginAction.class.php');
require_once('./controleur/LogoutAction.class.php');
require_once('./controleur/InscriptionAction.class.php');
class ActionBuilder{
	public static function getAction($nom){
		switch ($nom)
		{
			case "connecter" :
				return new LoginAction();
			break; 
			case "inscrire" :
				return new InscriptionAction();
			break; 
			case "projet" :
				return new AfficherProjetAction();
			break;	
			case "mesProjets" :
				return new AfficherMesProjetsAction();
			break;
			case "creerProjet" :
				return new CreerProjetAction();
			break;
			case "ajouterTache" :
				return new AjouterTacheAction();
			break;
			case "ajouterAdhesion" :
				return new AjouterAdhesionAction();
			break;


			case "listeProjets" :
				return new AfficherListeProjetsAction();
			break;						
			case "deconnecter" :
				return new LogoutAction();
			break; 
			
			/* case "listeInvitEnv" :
				return new AfficherListeInvitEnvAction();
			break; */
			
			/* Invitations */
			case "creerInvitationEnv" :
				return new AjouterInvEnvAction();
			break;
			case "accepterInvitation" :
				return new AccepterInvAction();
			break;
			case "refuserInvitation" :
				return new RefuserInvAction();
			break;
			
			case "invitationsEnvoyees" :
				return new AfficherInvitEnvAction();
			break;
			
			case "creerInvitationRec" :
			return new AjouterInvRecAction();
			break;
			
			
			
			
			/* Taches */
			case "laisserTache" :
				return new LaisserTacheAction();
			break;
			case "sattribuerTache" :
				return new SattribuerTacheAction();
			break;
			case "terminerTache" :
				return new TerminerTacheAction();
			break;
			
			case "suppAdherent" :
				return new SupprimerAdhesionAction();
			break;
			case "suppTache" :
				return new SupprimerTacheAction();
			break; 
			case "suppInvitation" :
				return new SupprimerInvitationEnvAction();
			break;
			case "updateProjet" :
				return new UpdateProjetAction();
			break;
			
			case "updateTache" :
				return new UpdateTacheAction();
			break;
		

			default :
				return new DefaultAction();
		}
	}
}
?>
