<?php
class Taches{
	private $numTaches;
	private $nomTaches;
	private $numProjet;
	private $etat;
	private $courriel;
	private $donneur;
	
	public function __construct($n="111")
	{
		$this->numTaches = $n;
	}
	
	public function getNumTaches()
	{
			return $this->numTaches;
	}
	
	public function setNumTaches($value)
	{
			$this->numTaches = $value;
	}

	public function getNomTaches()
	{
			return $this->nomTaches;
	}
	
	public function setNomTaches($value)
	{
			$this->nomTaches = $value;
	}
	
	public function getEtat()
	{
			return $this->etat;
	}
	
	public function setEtat($value)
	{
			$this->etat = $value;
	}
	
	public function getCourriel()
	{
			return $this->courriel;
	}
	
	public function setCourriel($value)
	{
			$this->courriel = $value;
	}
	
	public function getNumProjet()
	{
			return $this->numProjet;
	}
	
	public function setNumProjet($value)
	{
			$this->numProjet = $value;
	}
	
	public function getDonneur()
	{
			return $this->donneur;
	}
	
	public function setDonneur($value)
	{
			$this->donneur = $value;
	}
	
	public function __toString()
	{
		return "Taches[".$this->numTaches.",".$this->nomTaches.",".$this->etat."],".$this->courriel.",".$this->numProjet.",".$this->donneur."]";
	}
	public function affiche()
	{
		echo $this->__toString();
	}
	public function loadFromRecord($ligne)
	{
		$this->numTaches = $ligne["NUM_TACHES"];
		$this->nomTaches = $ligne["NOM_TACHES"];
		$this->etat = $ligne["ETAT"];
		$this->courriel = $ligne["COURRIEL"];
		$this->numProjet = $ligne["NUM_PROJET"];		
		$this->donneur = $ligne["DONNEUR"];
	}
}
?>