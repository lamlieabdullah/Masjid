<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
require(MYSQL);

if(isset($_POST['id'])){
  $id = $_POST['id'];

  $sql = "UPDATE " . database_prefix ."_scroll SET paparkan='0' WHERE scroll_id=$id";
  $result = mysqli_query($dbc, $sql);
  if(mysqli_affected_rows($dbc) > 0) echo '1';
  else echo '0';
}
 ?>
