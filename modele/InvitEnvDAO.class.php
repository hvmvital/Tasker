<?php
include_once('./modele/classes/Database.class.php'); 
include_once('./modele/classes/InvitationEnvoye.class.php'); 
include_once('./modele/classes/ListeInvitEnv.class.php'); 

class InvitEnvDAO
{	
	 public function create($x) {
		$request = "INSERT INTO invitationenvoyee".
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
			$liste = new ListeInvitEnv();
		
			$requete = 'SELECT * FROM invitationenvoyee';
			$cnx = Database::getInstance();
			
			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$p = new InvitationEnvoye();
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

				$pstmt = $db->prepare("SELECT * FROM invitationenvoyee WHERE COURRIEL = :x");//requête paramétrée par un paramètre x.
				$pstmt->execute(array(':x' => $courriel));
				

				while ($result = $pstmt->fetch(PDO::FETCH_OBJ)){
					$p = new InvitationEnvoye();
					if ($result)
					{
						
						$p->setNumInvEnv($result->NUM_INVITATION_ENVOYEE);
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
	
	public static function findMyInvitEnvGes($courrielGes)
	{		
		try{
			$liste = new ListeInvitEnv();
				$db = Database::getInstance();
				$pstmt = $db->prepare("SELECT * FROM projet 
										INNER JOIN invitationenvoyee ON projet.NUM_PROJET = invitationenvoyee.NUM_PROJET 
										WHERE projet.COURRIEL = :x ");
			
				
				$pstmt->execute(array(':x' => $courrielGes));
				

				while ($result = $pstmt->fetch(PDO::FETCH_OBJ)){
					$ie = new InvitationEnvoye();
					if ($result)
					{
						$ie->setNumInvEnv($result->NUM_INVITATION_ENVOYEE);
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
	
	public function ifInvDejaEnvoyee($numProjet, $courriel)
	{
		$trouve = false;
		$etat = "en_attente";
		try{

				$db = Database::getInstance();

				$pstmt = $db->prepare("SELECT * FROM invitationenvoyee WHERE NUM_PROJET =:z and COURRIEL = :x and ETAT=:e");
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
	
	
	
	public function accepterInv($ie) {
		$etat = "accepte";
		
		$request = "
		UPDATE invitationenvoyee 
		SET 
		ETAT = '".$etat."'
		"." WHERE NUM_INVITATION_ENVOYEE = '".$ie->getNumInvEnv()."'";
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
		UPDATE invitationenvoyee 
		SET 
		ETAT = '".$etat."'
		"." WHERE NUM_INVITATION_ENVOYEE = '".$ir->getNumInvEnv()."'";
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

	public function delete($ie) {
		$request = "DELETE FROM invitationenvoyee WHERE NUM_INVITATION_ENVOYEE = '".$ie->getNumInvEnv()."'";
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