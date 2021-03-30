<?php
require('config/config.inc.php');
require(MYSQL);
$nama_file = 'player.php';

$sql = "SELECT `template` FROM " . database_prefix ."_umum";
$result = mysqli_query($dbc, $sql);
if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
  $template =  $row['template'];
}
header("location:player$template.php");
