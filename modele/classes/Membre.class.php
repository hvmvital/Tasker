<?php

class Membre{
	private $courriel = "";
	private $nom = "";
	private $prenom = "";
	private $password = "";
	
	public function __construct($n="XXX000")
	{
		$this->courriel = $n;
	}
	
	public function getCourriel()
	{
			return $this->courriel;
	}
	
	public function setCourriel($value)
	{
			$this->courriel = $value;
	}
	
	public function getNom()
	{
			return $this->nom;
	}
	
	public function setNom($value)
	{
			$this->nom = $value;
	}
	
	public function getPrenom()
	{
			return $this->prenom;
	}
	
	public function setPrenom($value)
	{
			$this->prenom = $value;
	}
        
	public function getPassword()
	{
			return $this->password;
	}
	
	public function setPassword($value)
	{
			$this->password = $value;
	}

	 public function __toString()
	{
		return "Membre[".$this->courriel.",".$this->nom.",".$this->prenom.",".$this->password."]";
	} 
	public function affiche()
	{
		echo $this->__toString();
	}
	public function loadFromRecord($ligne)
	{
		$this->courriel = $ligne["COURRIEL"];
		$this->nom = $ligne["NOM"];
		$this->prenom = $ligne["PRENOM"];
		$this->password = $ligne["MOT_DE_PASSE"];
	}	
}
?>