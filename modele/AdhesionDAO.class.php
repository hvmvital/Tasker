<?php
include_once('./modele/classes/Database.class.php'); 
include_once('./modele/classes/Adhesion.class.php'); 
include_once('./modele/classes/ListeAdherentProjet.class.php'); 

class AdhesionDAO
{	
	public function create($a) {
		$request = "INSERT INTO adhesion".
				" VALUES (
				'',
				'".$a->getNumProjet()."',
				'".$a->getCourriel()."'
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
	

	/* public static function findAll()
	{
		try {
			$liste = new ListeAdherentProjet();
		
			$requete = 'SELECT * FROM projet';
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
	} */
	/*
	
	
	*/
	
	public static function getNbrAdherentsByProjet($numProjet)
	{
		$nbr = 0;
		try{
			$liste = new ListeAdherentProjet();
				$db = Database::getInstance();

				$pstmt = $db->prepare("SELECT * FROM adhesion WHERE NUM_PROJET = :x");//requête paramétrée par un paramètre x.
				$pstmt->execute(array(':x' => $numProjet));
				

				while ($result = $pstmt->fetch(PDO::FETCH_OBJ)){
					$p = new Adhesion();
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
	
	public static function findMyAdherent($numProjet)
	{
		try{
			$liste = new ListeAdherentProjet();
				$db = Database::getInstance();

				$pstmt = $db->prepare("SELECT * FROM adhesion WHERE NUM_PROJET = :x");//requête paramétrée par un paramètre x.
				$pstmt->execute(array(':x' => $numProjet));
				

				while ($result = $pstmt->fetch(PDO::FETCH_OBJ)){
					$p = new Adhesion();
					if ($result)
					{
						$p->setNumAdhesion($result->NUM_ADHESION);
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
	
	public function ifFindMyAdherent($numProjet, $courriel)
	{
		$trouve = false;
		
		try{

				$db = Database::getInstance();

				$pstmt = $db->prepare("SELECT * FROM adhesion WHERE NUM_PROJET =:z and COURRIEL = :x");
				$pstmt->execute(array(
				':x' => $courriel,
				':z' => $numProjet
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
	
	public function findMyAdherentByCourriel($numProjet, $courriel)
	{
		
		try{
				$liste = new ListeAdherentProjet();
				$db = Database::getInstance();

				$pstmt = $db->prepare("SELECT * FROM adhesion WHERE NUM_PROJET =:z and COURRIEL = :x");
				$pstmt->execute(array(
				':x' => $courriel,
				':z' => $numProjet
				));
				

				while ($result = $pstmt->fetch(PDO::FETCH_OBJ)){
					$p = new Adhesion();
					if ($result)
					{
						$p->setNumAdhesion($result->NUM_ADHESION);
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
	
	public function delete($x) {
		$request = "DELETE FROM adhesion WHERE NUM_ADHESION = '".$x->getNumAdhesion()."'";
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
	

	/*
	public function update($x) {
		$request = "UPDATE produit SET DESIGN = '".$x->getDesignation()."', PRIXUNIT = '".$x->getPrixUnit()."'".
				" WHERE NUM = '".$x->getNum()."'";
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


	
	*/
}
?>