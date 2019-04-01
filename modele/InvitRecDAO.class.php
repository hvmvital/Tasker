<?php
include_once('./modele/classes/Database.class.php'); 
include_once('./modele/classes/InvitationRecu.class.php'); 
include_once('./modele/classes/ListeInvitRec.class.php'); 

class InvitRecDAO
{	
	 public function create($x) {
		$request = "INSERT INTO invitationrecue".
				" VALUES (
				'',
				'".$x->getNumProjet()."',
				'".$x->getCourriel()."',
				'".$x->getEtat()."'
				)";
		try
		{
			$db = Database::getInstance();
			return $db->exec($request);
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	} 

	public static function findAll()
	{
		try {
			$liste = new ListeInvitRec();
		
			$requete = 'SELECT * FROM invitationrecue';
			$cnx = Database::getInstance();
			
			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$p = new InvitationRecu();
				$p->loadFromRecord($row);
				$liste->add($p);
		    }
			$res->closeCursor();
		    $cnx = null;
			return $liste;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    return $liste;
		}	
	}


	public static function findMyInvitEnv($courriel)
	{
		try{
			$liste = new ListeInvitEnv();
				$db = Database::getInstance();

				$pstmt = $db->prepare("SELECT * FROM invitationrecue WHERE COURRIEL = :x");//requête paramétrée par un paramètre x.
				$pstmt->execute(array(':x' => $courriel));
				

				while ($result = $pstmt->fetch(PDO::FETCH_OBJ)){
					$p = new InvitationRecu();
					if ($result)
					{
						
						$p->setNumInvRec($result->NUM_INVITATION_RECUE);
						$p->setNumProjet($result->NUM_PROJET);
						$p->setCourriel($result->COURRIEL);
						$p->setEtat($result->ETAT);
						$liste->add($p);
						
					} 
				}
				$pstmt->closeCursor();
				$db = null;
				return $liste;
				
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    return $liste;
		}
	}
	
	public static function findMyInvitRecGes($courrielGes)
	{		
		try{
			$liste = new ListeInvitEnv();
				$db = Database::getInstance();
				$pstmt = $db->prepare("SELECT * FROM projet INNER JOIN invitationrecue ON projet.NUM_PROJET = invitationrecue.NUM_PROJET WHERE projet.COURRIEL = :x ");
				
				
				
				
				$pstmt->execute(array(':x' => $courrielGes));
				

				while ($result = $pstmt->fetch(PDO::FETCH_OBJ)){
					$ie = new InvitationRecu();
					if ($result)
					{
						$ie->setNumInvRec($result->NUM_INVITATION_RECUE);
						$ie->setNumProjet($result->NUM_PROJET);
						$ie->setCourriel($result->COURRIEL);
						$ie->setEtat($result->ETAT);
						$liste->add($ie);	
					} 
				}
				$pstmt->closeCursor();
				$db = null;
				return $liste;
				
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    return $liste;
		}
	}
	
	public static function findMyInvitRec($courriel)
	{
		try{
			$liste = new ListeInvitRec();
				$db = Database::getInstance();

				$pstmt = $db->prepare("SELECT * FROM invitationrecue WHERE COURRIEL = :x");//requête paramétrée par un paramètre x.
				$pstmt->execute(array(':x' => $courriel));
				

				while ($result = $pstmt->fetch(PDO::FETCH_OBJ)){
					$p = new InvitationRecu();
					if ($result)
					{
						
						$p->setNumInvRec($result->NUM_INVITATION_REC);
						$p->setNumProjet($result->NUM_PROJET);
						$p->setCourriel($result->COURRIEL);
						$liste->add($p);
						
					} 
				}
				$pstmt->closeCursor();
				$db = null;
				return $liste;
				
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    return $liste;
		}
	}
	
	public function ifInvDejaRecue($numProjet, $courriel)
	{
		$trouve = false;
		$etat = "en_attente";
		try{

				$db = Database::getInstance();

				$pstmt = $db->prepare("SELECT * FROM invitationrecue WHERE NUM_PROJET =:z and COURRIEL = :x and  ETAT=:e");
				$pstmt->execute(array(
				':x' => $courriel,
				':z' => $numProjet,
				':e' => $etat
				));
				

				while ($result = $pstmt->fetch(PDO::FETCH_OBJ)){

					if ($result)
					{
						$trouve = true;	
					} 
				}
				$pstmt->closeCursor();
				$db = null;
				return $trouve;
				
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    return $trouve;
		}
	}
	
	public function accepterInv($ir) {
		$etat = "accepte";
		
		$request = "
		UPDATE invitationrecue 
		SET 
		ETAT = '".$etat."'
		"." WHERE NUM_INVITATION_RECUE = '".$ir->getNumInvRec()."'";
		try
		{
			$db = Database::getInstance();
			return $db->exec($request);
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}

	public function refuserInv($ir) {
		$etat = "refusee";
		
		$request = "
		UPDATE invitationrecue 
		SET 
		ETAT = '".$etat."'
		"." WHERE NUM_INVITATION_RECUE = '".$ir->getNumInvRec()."'";
		try
		{
			$db = Database::getInstance();
			return $db->exec($request);
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}
	

	public function delete($ir) {
		$request = "DELETE FROM invitationrecue WHERE NUM_INVITATION_RECUE = '".$ir->getNumInvRec()."'";
		try
		{
			$db = Database::getInstance();
			return $db->exec($request);
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}

}

	
	

	


?>
