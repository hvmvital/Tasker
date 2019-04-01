<?php

class InvitationEnvoye{
	private $numInvEnv;
	private $numProjet;
	private $courriel;
	private $etat;
	
	
	
	public function __construct($n="111")
	{
		$this->numInvEnv = $n;
	}
	
	public function getNumInvEnv()
	{
			return $this->numInvEnv;
	}
	
	public function setNumInvEnv($value)
	{
			$this->numInvEnv = $value;
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
	public function getEtat()
	{
			return $this->etat;
	}
	
	public function setEtat($value)
	{
			$this->etat = $value;
	}
	
	 public function __toString()
	{
		return "Membre[".$this->numInvEnv.",".$this->numProjet.",".$this->courriel."]";
	} 
	public function affiche()
	{
		echo $this->__toString();
	}
	public function loadFromRecord($ligne)
	{
		$this->numInvEnv = $ligne["NUM_INVITATION_ENV"];
		$this->numProjet = $ligne["NUM_PROJET"];
		$this->courriel = $ligne["COURRIEL"];
	}	
}
?>