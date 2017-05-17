db_functions.php
<?php
class db_functions{
	private $conn;
	
	//constructor
	function __construct(){
		require_once 'db_connect.php';
		$db = new db_connect();
		//mysqli connect
		$this->conn = $db->connect();
	}
	
	//destructor
	function __destruct(){
		
	}
	
	public function getDevice($user, $deviceID){
		$stmt = $this->conn->prepare("SELECT * FROM devices WHERE user = ?");
		$stmt->bind_param("s", $user);
		
		if($stmt->execute()){
			//get resultset from db and store into $device as array
			$device = $stmt->get_result()->fetch_assoc();
			$stmt->close();
			
			//check if $deviceID matches deviceID in db 
			$db_deviceID = $device['deviceID'];
			if($db_deviceID == $deviceID){
				return $device;
			} else {
				return NULL;
			}
		} else {
			return NULL;
		}
	}
	
	public function setLoggedIn($user){
		$stmt = $this->conn->prepare("UPDATE devices SET loggedIn = TRUE, lastLogin = now() WHERE user = ?");
		$stmt->bind_param("s", $user);
		$stmt->execute();
	}
	
	public function logout(){
		$stmt = $this->conn->prepare("UPDATE devices SET loggedIn = FALSE");
		$stmt->execute();
	}
}



?>