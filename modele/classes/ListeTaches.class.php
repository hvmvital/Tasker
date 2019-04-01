<?php
require_once('./modele/classes/Navigable.interface.php');

class ListeTaches implements Navigable {
	private $tache;
	private $current = -1;

	public function __construct()	//Constructeur
	{
		$this->tache = array();
	}	
	
	public function add($tache)
	{
			array_push($this->tache,$tache);
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
		if ($this->current<count($this->tache)) 
		{
			$this->current++;
			return true;
		}
		return false;
	}
        
	public function printCurrent()
	{
			if (isset($this->tache[$this->current]))
				echo $this->tache[$this->current];
	}
	public function getCurrent()
	{
		if (isset($this->tache[$this->current]))
			return $this->tache[$this->current];
		return null;	
	}	
	public function size()
	{
		return count($this->tache);
	}
}
?>