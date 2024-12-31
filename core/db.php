<?php


namespace Core;

use Exception,PDO;

abstract class DB {
	private string $hostname = "localhost";
	private string $username = "root";
	private string $password = "";
	private string $dbname = "telegram";
	protected object $connection;
	public function __construct() {
		try {
			$this->connection = new PDO ("mysql:host=$this->hostname;dbname=$this->dbname",$this->username, $this->password);
		} catch(Exception $e) {
			echo $e->getMessage();
		}

		
	}
	abstract public function insert(array $values);
	abstract public function select();

}

