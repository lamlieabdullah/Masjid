<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
require(MYSQL);

if(isset($_POST['id'])){
	$id = $_POST['id'];
	$sql = "SELECT `jenis`,`url` FROM " . database_prefix ."_slider WHERE slider_id='$id'";
	$result = mysqli_query($dbc, $sql);
	if (mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_assoc($result);
		$jenis = $row['jenis'];
		$url = $row['url'];
		if($jenis==='video'){
			$file = "../video/$url";
			if (!unlink($file))
			{
				//tidak berjaya delete file
				delete_dlm_databse($dbc, $id);
			}
			else
			{
				//berjaya delete file
				delete_dlm_databse($dbc, $id);
			}
		} // jenis === video
		else if($jenis==='gambar'){
			$file = "../images/$url";
			if (!unlink($file))
			{
				//tidak berjaya delete file
				delete_dlm_databse($dbc, $id);
			}
			else
			{
				//berjaya delete file
				delete_dlm_databse($dbc, $id);
			}
		}//jenis === gambar
		else delete_dlm_databse($dbc, $id); //delete dlm database sahaja
	}


}

function delete_dlm_databse($dbc, $id){
	$sql = "DELETE FROM " . database_prefix ."_slider WHERE slider_id='$id'";
	$result = mysqli_query($dbc, $sql);
	if(mysqli_affected_rows($dbc) > 0) echo '1';
	else echo '0';
}
?>
