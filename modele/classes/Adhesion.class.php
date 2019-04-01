<?php

class Adhesion{
	private $numAdhesion;
	private $numProjet;
	private $courriel;
	
	
	public function __construct($n="111")
	{
		$this->numAdhesion = $n;
	}
	
	public function getNumAdhesion()
	{
			return $this->numAdhesion;
	}
	
	public function setNumAdhesion($value)
	{
			$this->numAdhesion = $value;
	}
	
	public function getNumProjet()
	{
			return $this->numProjet;
	}
	
	public function setNumProjet($value)
	{
			$this->numProjet = $value;
	}
	
	public function getCourriel()
	{
			return $this->courriel;
	}
	
	public function setCourriel($value)
	{
			$this->courriel = $value;
	}
	
	 public function __toString()
	{
		return "Membre[".$this->numAdhesion.",".$this->numProjet.",".$this->courriel."]";
	} 
	public function affiche()
	{
		echo $this->__toString();
	}
	public function loadFromRecord($ligne)
	{
		$this->numAdhesion = $ligne["NUM_ADHESION"];
		$this->numProjet = $ligne["NUM_PROJET"];
		$this->courriel = $ligne["COURRIEL"];
	}	
}
?>