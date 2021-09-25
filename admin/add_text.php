<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
require(MYSQL);
add_dlm_databse($dbc);

function add_dlm_databse($dbc){
	$sql = "INSERT INTO " . database_prefix ."_scroll (`text`, `paparkan`, `giliran`)VALUES (' ', '0', '0')";
	//INSERT INTO " . database_prefix ."_scroll (`text`, `paparkan`, `giliran`)VALUES (' ', '0', '0');
	$result = mysqli_query($dbc, $sql);
	if(mysqli_affected_rows($dbc) > 0) echo '1';
	else echo '0';
}
?>
