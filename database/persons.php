<?php


namespace DB;
use Core\DB;
use PDO;

class Persons extends DB {

	public function __construct() {
		parent::__construct();
	}
	public function insert(array $values){
		
		$sql = $this->connection->prepare("INSERT INTO Persons(firstname, lastname,Age) values(?,?,?)");
		$sql->bindValue(1,$values[0]);
		$sql->bindValue(2,$values[1]);
		$sql->bindValue(3,$values[2]);
		$sql->execute();


	}
	public function select() {
		$sql = $this->connection->prepare("SELECT * FROM Persons");
		$sql->execute();

		return $sql->fetchAll(PDO::FETCH_ASSOC);

	}
	
}
