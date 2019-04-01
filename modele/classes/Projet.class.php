<?php
class Projet{
	private $numProjet;
	private $nomProjet ;
	private $description;
	private $courriel;
	
	public function __construct($n="111")
	{
		$this->numProjet = $n;
	}
	
	public function getNumProjet()
	{
			return $this->numProjet;
	}
	
	public function setNumProjet($value)
	{
			$this->numProjet = $value;
	}

	public function getNomProjet()
	{
			return $this->nomProjet;
	}
	
	public function setNomProjet($value)
	{
			$this->nomProjet = $value;
	}
	
	public function getDescription()
	{
			return $this->description;
	}
	
	public function setDescription($value)
	{
			$this->description = $value;
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
		return "Projet[".$this->numProjet.",".$this->nomProjet.",".$this->description."],".$this->courriel."]";
	}
	public function affiche()
	{
		echo $this->__toString();
	}
	public function loadFromRecord($ligne)
	{
		$this->numProjet = $ligne["NUM_PROJET"];
		$this->nomProjet = $ligne["NOM_PROJET"];
		$this->description = $ligne["DESCRIPTION"];
		$this->courriel = $ligne["COURRIEL"];
	}
}
?>