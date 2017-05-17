login.php
<?php
require_once 'include/db_functions.php';
$db = new db_functions();

//json response
$response = array("error" => FALSE);

if(isset($_POST['user']) && isset($_POST['deviceID'])){
	$user = $_POST['user'];
	$deviceID = $_POST['deviceID'];
	//retrieve device info in db
	$device = $db->getDevice($user, $deviceID);
	if($device != false){
		//device was found, set loggedIn
		$db->setLoggedIn($user);
		$response["error"] = FALSE;
		$response["device"]["user"] = $device['user'];
		$response["device"]["deviceID"] = $device['deviceID'];
		$response["device"]["loggedIn"] = $device['loggedIn'];
		$response["device"]["lastLogin"] = $device['lastLogin'];
		echo json_encode($response);
	} else {
		//device was not found
		$response["error"] = TRUE;
		$response["errpr_msg"] = "Login credentials are incorrect.";
		echo json_encode($response);
	}
} else {
	//post parameters missing
	$response["error"] = TRUE;
	$response["error_msg"] = "Required parameters user or deviceID are missing.";
	echo json_encode($response);
}
?>
<!--
<html>
   <body>
   
      <form action = "<?php $_PHP_SELF ?>" method = "POST">
         User: <input type = "text" name = "user" />
         DeviceID: <input type = "text" name = "deviceID" />
         <input type = "submit" />
      </form>
   
   </body>
</html>
-->