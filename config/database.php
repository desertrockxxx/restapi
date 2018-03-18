<?php
class Database{
	// database credentials
	private $host = "localhost";
	private $db_name = "api_db";
	private $username = "testuser";
	private $password = ""; 

	public $conn;

	// get the database connection
	public function getConnection(){
		$this->conn = null;

		try{

			$this->conn = new PDO(
				"mysql:host=" . $this->host .
				";dbname=" . $this->db_name,
				$this->username,
				$this->password);

			$this->conn->exec("set names utf8");
		}
		catch(PDOException $e){
			echo "Connection error: " . $e->getMessage();
		}
		
		return $this->conn;
	}
	
}

?>