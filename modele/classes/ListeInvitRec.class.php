<?php
require_once('./modele/classes/Navigable.interface.php');

class ListeInvitRec implements Navigable {
	private $invitRec;
	private $current = -1;

	public function __construct()	//Constructeur
	{
		$this->invitRec = array();
	}	
	
	public function add($invitRec)
	{
			array_push($this->invitRec,$invitRec);
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
		if ($this->current<count($this->invitRec)) 
		{
			$this->current++;
			return true;
		}
		return false;
	}
        
	public function printCurrent()
	{
			if (isset($this->invitRec[$this->current]))
				echo $this->invitRec[$this->current];
	}
	public function getCurrent()
	{
		if (isset($this->invitRec[$this->current]))
			return $this->invitRec[$this->current];
		return null;	
	}	
	public function size()
	{
		return count($this->invitRec);
	}
}
?>