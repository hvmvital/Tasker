<?php
include_once('./modele/classes/Database.class.php'); 
include_once('./modele/classes/Projet.class.php'); 
include_once('./modele/classes/ListeProjets.class.php'); 

class ProjetDAO
{	
	public function create($x) {
		$request = "INSERT INTO projet ".
				" VALUES (
				'',
				'".$x->getNomProjet()."',
				'".$x->getDescription()."',
				'".$x->getCourriel()."'
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
			$liste = new ListeProjets();
		
			$requete = 'SELECT * FROM projet ORDER BY NUM_PROJET DESC;';
			$cnx = Database::getInstance();
			
			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$p = new Projet();
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
	
	public static function getNbrProjects()
	{
		try {
			$nbr = 0;
		
			$requete = 'SELECT * FROM projet;';
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
	
	public static function findMyProjects($courriel)
	{
		try{
			$liste = new ListeProjets();
				$db = Database::getInstance();

				$pstmt = $db->prepare("SELECT * FROM projet WHERE COURRIEL = :x ORDER BY NUM_PROJET DESC;");//requête paramétrée par un paramètre x.
				$pstmt->execute(array(':x' => $courriel));
				

				while ($result = $pstmt->fetch(PDO::FETCH_OBJ)){
					$p = new Projet();
					if ($result)
					{
						$p->setNumProjet($result->NUM_PROJET);
						$p->setNomProjet($result->NOM_PROJET);
						$p->setDescription($result->DESCRIPTION);
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
	
	public static function find($numProjet)
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM projet WHERE NUM_PROJET = :x");//requête paramétrée par un paramètre x.
		$pstmt->execute(array(':x' => $numProjet));
		
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		$p = new Projet();

		if ($result)
		{
			$p->setNumProjet($result->NUM_PROJET);
			$p->setNomProjet($result->NOM_PROJET);
			$p->setDescription($result->DESCRIPTION);
			$p->setCourriel($result->COURRIEL);
			$pstmt->closeCursor();
			return $p;
		}
		$pstmt->closeCursor();
		return null;
	}

	
	public function update($x) {
		$request = "
		UPDATE projet 
		SET
		
		NOM_PROJET = '".$x->getNomProjet()."',		
		DESCRIPTION = '".$x->getDescription()."'".
		" WHERE NUM_PROJET = '".$x->getNumProjet()."'";
		
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
	
	


	public function delete($x) {
		$request = "DELETE FROM produit WHERE NUM_PROJET = '".$x->getNum()."'";
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