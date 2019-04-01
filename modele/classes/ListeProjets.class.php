<?php
require_once('./modele/classes/Navigable.interface.php');

class ListeProjets implements Navigable {
	private $projet;
	private $current = -1;

	public function __construct()	//Constructeur
	{
		$this->projet = array();
	}	
	
	public function add($projet)
	{
			array_push($this->projet,$projet);
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
		if ($this->current<count($this->projet)) 
		{
			$this->current++;
			return true;
		}
		return false;
	}
        
	public function printCurrent()
	{
			if (isset($this->projet[$this->current]))
				echo $this->projet[$this->current];
	}
	public function getCurrent()
	{
		if (isset($this->projet[$this->current]))
			return $this->projet[$this->current];
		return null;	
	}	
	public function size()
	{
		return count($this->projet);
	}
}
?>