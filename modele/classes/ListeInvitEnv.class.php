<?php
require_once('./modele/classes/Navigable.interface.php');

class ListeInvitEnv implements Navigable {
	private $invitEnv;
	private $current = -1;

	public function __construct()	//Constructeur
	{
		$this->invitEnv = array();
	}	
	
	public function add($invitEnv)
	{
			array_push($this->invitEnv,$invitEnv);
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
		if ($this->current<count($this->invitEnv)) 
		{
			$this->current++;
			return true;
		}
		return false;
	}
        
	public function printCurrent()
	{
			if (isset($this->invitEnv[$this->current]))
				echo $this->invitEnv[$this->current];
	}
	public function getCurrent()
	{
		if (isset($this->invitEnv[$this->current]))
			return $this->invitEnv[$this->current];
		return null;	
	}	
	public function size()
	{
		return count($this->invitEnv);
	}
}
?>