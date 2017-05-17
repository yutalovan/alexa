db_connect.php
<?php
class db_connect {
	private $conn;
	
	//method: connect to db
	public function connect(){
		require_once 'db_config.php';
		//connect
		$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
		//return db handler
		return $this->conn;
	}
}
?>