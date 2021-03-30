<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
require(MYSQL);

if(isset($_GET["sort_order"])) {
$id_ary = explode(",",$_GET["sort_order"]);
for($i=0;$i < count($id_ary);$i++) {
$sql = "UPDATE `" . database_prefix ."_slider` SET giliran='" . $i . "' WHERE slider_id=". $id_ary[$i];
mysqli_query($dbc, $sql) or die("database error:". mysqli_error($conn));
}
}

// Close MySQL connection
?>
