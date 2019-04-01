<?php
include_once('./modele/classes/Database.class.php'); 
include_once('./modele/classes/Taches.class.php'); 
include_once('./modele/classes/ListeTaches.class.php'); 

class TacheDAO
{	
	public function create($x) {
		$request = "INSERT INTO taches".
				" VALUES (
				'',
				'".$x->getNumProjet()."',
				'".$x->getNomTaches()."',
				'".$x->getEtat()."',
				'".$x->getCourriel()."',
				'".$x->getDonneur()."')";
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
			$liste = new ListeTaches();
		
			$requete = 'SELECT * FROM taches';
			$cnx = Database::getInstance();
			
			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$p = new Taches();
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

	public static function getNbrTaches()
	{
		try {
			$nbr = 0;
		
			$requete = 'SELECT * FROM taches;';
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
	
	public static function getNbrTachesByProjet($numProjet)
	{
		
		$nbr = 0;
		
		try{
			$liste = new ListeTaches();
				$db = Database::getInstance();

				$pstmt = $db->prepare("SELECT * FROM taches WHERE NUM_PROJET = :x");//requête paramétrée par un paramètre x.
				$pstmt->execute(array(':x' => $numProjet));
				

				while ($result = $pstmt->fetch(PDO::FETCH_OBJ)){
					$p = new Taches();
					if ($result)
					{
						
						$nbr +=1;
						
					} 
				}
				$pstmt->closeCursor();
				$db = null;
				return $nbr;
				
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    return $nbr;
		}
	}
	
/*
	public static function getPage($numPage, $taillePage)
	{
		try {
			$liste = new ListeTaches();
		    
			$debut = ($numPage - 1)*$taillePage;
		
			$requete = 'SELECT * FROM taches LIMIT '.$debut.', '.$taillePage;
			$cnx = Database::getInstance();
			
			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$p = new Taches();
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
	*/
	public static function findMyTaches($numProjet)
	{
		try{
			$liste = new ListeTaches();
				$db = Database::getInstance();

				$pstmt = $db->prepare("SELECT * FROM taches WHERE NUM_PROJET = :x");//requête paramétrée par un paramètre x.
				$pstmt->execute(array(':x' => $numProjet));
				

				while ($result = $pstmt->fetch(PDO::FETCH_OBJ)){
					$p = new Taches();
					if ($result)
					{
						
						$p->setNumTaches($result->NUM_TACHES);
						$p->setNomTaches($result->NOM_TACHES);
						$p->setNumProjet($result->NUM_PROJET);
						$p->setEtat($result->ETAT);
						$p->setCourriel($result->COURRIEL);
						$p->setDonneur($result->DONNEUR);
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
	
	
	
	public static function find($numTache)
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM taches WHERE NUM_TACHES = :x");//requête paramétrée par un paramètre x.
		$pstmt->execute(array(':x' => $numTache));
		
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		$t = new Projet();

		if ($result)
		{
			$t->setNumTaches($result->NUM_TACHES);
			$t->setNomTaches($result->NOM_TACHES);
			$t->setNumProjet($result->NUM_PROJET);
			$t->setEtat($result->ETAT);
			$t->setCourriel($result->COURRIEL);
			$t->setDonneur($result->DONNEUR);
			$pstmt->closeCursor();
			return $t;
		}
		$pstmt->closeCursor();
		return null;
	}
	
	public function updateTache($t) {
		$enCours = "en cours";
		
		$request = "
		UPDATE taches 
		SET 
		NOM_TACHES = '".$t->getNomTaches()."',
		ETAT = '".$enCours."',
		DONNEUR = '".$t->getDonneur()."',
		COURRIEL = '".$t->getCourriel()."' 
		"." WHERE NUM_TACHES = '".$t->getNumTaches()."'";
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
	
	public function update($t) {
		$request = "
		UPDATE taches 
		SET 
		NUM_TACHES = '".$t->getNumTaches()."', 
		NOM_TACHES = '".$t->getNomTaches()."',
		NUM_PROJET = '".$t->getNumProjet()."', 
		ETAT = '".$t->getEtat()."',
		COURRIEL = '".$t->getCourriel()."', 
		DONNEUR = '".$t->getDonneur()."'
		"." WHERE NUM_TACHES = '".$t->getNumTaches()."'";
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


	public function delete($t) {
		$request = "DELETE FROM taches WHERE NUM_TACHES = '".$t->getNumTaches()."'";
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
	public function laisser($t) {
		$nonDemaree = "non demarree";
		$terminee = "terminee";

		$request = "
		UPDATE taches 
		SET
		ETAT = '".$nonDemaree."',
		COURRIEL = null, 
		DONNEUR = null
		"." WHERE NUM_TACHES = '".$t->getNumTaches()."'";

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
	
	public function laisserMesTachesAll($numProjet, $courriel) {
		$nonDemaree = "non demarree";
		$terminee = "terminee";

		$request = "
		UPDATE taches 
		SET
		ETAT = '".$nonDemaree."',
		COURRIEL = null, 
		DONNEUR = null
		"." WHERE COURRIEL = '".$courriel."' and NUM_PROJET = '".$numProjet."'
		
		";

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
	
	
	
	
	public function sattribuer($t,$m) {
		$enCours = "en cours";
		
		$request = "
		UPDATE taches 
		SET
		ETAT = '".$enCours."',
		COURRIEL = '".$m."', 
		DONNEUR = '".$m."'
		"." WHERE NUM_TACHES = '".$t->getNumTaches()."'";

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
	
	public function terminer($t,$m) {
		
		$terminee = "terminee";
		
		$request = "
		UPDATE taches 
		SET
		ETAT = '".$terminee."'
		
		"." WHERE NUM_TACHES = '".$t->getNumTaches()."'";

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












