<?php
require_once('./modele/classes/Navigable.interface.php');

class ListeAdherentProjet implements Navigable {
	private $adherentProjet;
	private $current = -1;

	public function __construct()	//Constructeur
	{
		$this->adherentProjet = array();
	}	
	
	public function add($adherentProjet)
	{
			array_push($this->adherentProjet,$adherentProjet);
	}
	
	public function previous()
	{
		if ($this->current>0)
		{
			$this->current--;
			return true;
		}
		return false;
	}
	public function next()
	{
		if ($this->current<count($this->adherentProjet)) 
		{
			$this->current++;
			return true;
		}
		return false;
	}
        
	public function printCurrent()
	{
			if (isset($this->adherentProjet[$this->current]))
				echo $this->adherentProjet[$this->current];
	}
	public function getCurrent()
	{
		if (isset($this->adherentProjet[$this->current]))
			return $this->adherentProjet[$this->current];
		return null;	
	}	
	public function size()
	{
		return count($this->adherentProjet);
	}
}
?>