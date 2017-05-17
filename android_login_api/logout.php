logout.php
<?php
require_once 'include/db_functions.php';
$db = new db_functions();

$db->logout();
echo "User has logged out.";
?>