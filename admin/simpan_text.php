<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
require(MYSQL);
if(isset($_POST['id'])){
  $id = $_POST['id'];
	$text = $_POST['text'];
simpan_dlm_databse($dbc,$id,$text);
}

function simpan_dlm_databse($dbc,$id,$text){
	$sql = "UPDATE " . database_prefix ."_scroll SET `text`='$text' WHERE scroll_id=$id";
	//INSERT INTO " . database_prefix ."_scroll (`text`, `paparkan`, `giliran`)VALUES (' ', '0', '0');
	$result = mysqli_query($dbc, $sql);
	if(mysqli_affected_rows($dbc) > 0) echo '1';
	else echo '0';
}
?>
