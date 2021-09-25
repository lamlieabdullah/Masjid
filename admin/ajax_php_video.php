<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
require(MYSQL);

$target_dir = "../video/";
$target_file = round(microtime(true)) . basename($_FILES["fileToUpload"]["name"]);
$target_dir_file = $target_dir . $target_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST['tajuk']))$tajuk = escape_data($_POST['tajuk'], $dbc);
else $tajuk = 'Tidak diberikan';

if(isset($_POST['tempoh']))$tempoh = escape_data($_POST['tempoh'], $dbc);
else $tempoh = '0';

if(isset($_POST['mula']))$mula = escape_data($_POST['mula'], $dbc);
else $mula = '0';

if(isset($_POST['tamat']))$tamat = escape_data($_POST['tamat'], $dbc);
else $tamat = '0';

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$mime = mime_content_type($target_file);
if(strstr($mime, "video/")){

    // this code for video
		$uploadOk = 1;
}else if(strstr($mime, "image/")){
    // this code for image
		$uploadOk = 0;
}

}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Maaf, Fail tersebut telah wujud.<br>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 15000000) {
    echo "Maaf, saiz fail melebihi 15MB.<br>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "mp4" ) {
    echo "Maaf, hanya mp4 sahaja dibenarkan.<br>";
    $uploadOk = 0;
}

$sql = "SELECT `jenis` FROM `masjid_slider` WHERE `jenis`='video'";
$result = mysqli_query($dbc,$sql);
$rowcount = mysqli_num_rows($result);
if($rowcount >= 5) {
	echo "Maaf, maksimum 5 video sahaja dibenarkan. Sila delete video untuk muatnaik video baharu. ";
	$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Maaf, fail tidak berjaya di muat naik.<br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir_file)) {
			$query = "INSERT INTO " . database_prefix ."_slider (
				`url`,
				`paparkan`,
				`jenis`,
				`tajuk`,
				`mula`,
				`tamat`,
				`slide_duration`
				) VALUES (
					'$target_file',
					'0',
					'video',
					'$tajuk',
					'$mula',
					'$tamat',
					'$tempoh')";
					if(mysqli_query($dbc,$query)){
						echo 'berjaya';
			}
    } else {
        echo "Maaf, ada masalah ketika muat naik. Mungkin fail lebih dari had yang dibenarkan (50MB).<br>";
    }
}
?>
