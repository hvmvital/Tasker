<?php

class InvitationRecu{
	private $numInvRec = "";
	private $numProjet = "";
	private $courriel = "";
	
	
	public function __construct($n="IE00")
	{
		$this->numInvRec = $n;
	}
	
	public function getNumInvRec()
	{
			return $this->numInvRec;
	}
	
	public function setNumInvRec($value)
	{
			$this->numInvRec = $value;
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
		return "Membre[".$this->numInvRec.",".$this->numProjet.",".$this->courriel."]";
	} 
	public function affiche()
	{
		echo $this->__toString();
	}
	public function loadFromRecord($ligne)
	{
		$this->numInvRec = $ligne["NUM_INVITATION_REC"];
		$this->numProjet = $ligne["NUM_PROJET"];
		$this->courriel = $ligne["COURRIEL"];
	}	
}
?>