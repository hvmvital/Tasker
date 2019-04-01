<?php
require_once('./modele/configs/config.php');
class Database
{
	private static $instance = null;
	private function __construct() {}
	public static function getInstance()
	{
		if(self::$instance == null)
			self::$instance = new PDO(
				"mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME."",
				Config::DB_USER,
				Config::DB_PWD);
		return self::$instance;
	}
}
