<?php
include_once('./modele/classes/Database.class.php'); 
include_once('./modele/classes/Membre.class.php'); 

class MembreDAO
{	
	public static function find($courriel)
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM membre WHERE COURRIEL = :x");
		$pstmt->execute(array(':x' => $courriel));
		
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		$mem = new Membre();

		if ($result)
		{
			$mem->setCourriel($result->COURRIEL);
			$mem->setNom($result->NOM);
			$mem->setPrenom($result->PRENOM);
			$mem->setPassword($result->MOT_DE_PASSE);
			$pstmt->closeCursor();
			return $mem;
		}
		$pstmt->closeCursor();
		return null;
	}

	public static function findAll()
	{
		try {
			$liste = new ListeProjets();
		
			$requete = 'SELECT * FROM membre ORDER BY PRENOM DESC;';
			$cnx = Database::getInstance();
			
			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$m = new Membre();
				$m->loadFromRecord($row);
				$liste->add($m);
		    }
			$res->closeCursor();
		    $cnx = null;
			return $liste;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    return $liste;
		}	
	}
		
	public static function create($membre)
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("INSERT INTO membre (COURRIEL, NOM, PRENOM, MOT_DE_PASSE) VALUES (:c,:n,:prn,:p)");
		
		$res = $pstmt->execute(array(
			':c' => $membre->getCourriel(), 
			':n' => $membre->getNom(), 
			':prn' => $membre->getPrenom(),
			':p' => $membre->getPassword()
			));
		
		$pstmt->closeCursor();
		return $res;
	}		
	
	public static function getNbrMembres()
	{
		try {
			$nbr = 0;
		
			$requete = 'SELECT * FROM membre;';
			$cnx = Database::getInstance();
			
			$res = $cnx->query($requete);
		    foreach($res as $row) {

				$nbr += 1;
		    }
			$res->closeCursor();
		    $cnx = null;
			return $nbr;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    return $nbr;
		}	
	}
}
?>