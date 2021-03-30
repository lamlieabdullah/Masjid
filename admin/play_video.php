<?php
require('../config/config.inc.php');

require(MYSQL);

//kill omxplayer. sebagai persediaan kalau-kalau omxplayer sedang play.
exec("sudo killall omxplayer & killall omxplayer.bin");

if(isset($_GET['id'])){ //jika ada get request
  $id = $_GET['id'];  //dapatkan nilai id
  $sql = "SELECT `url` FROM " . database_prefix ."_slider WHERE `slider_id`='$id' AND `jenis`='video'"; //query database
  $result = mysqli_query($dbc, $sql);
  if (mysqli_num_rows($result) > 0) { //ada rekod
    $row = mysqli_fetch_assoc($result);
    $url_video = $row['url']; //dapatkan url video
    exec("sudo omxplayer -n -1 /var/www/html/masjid/video/$url_video");
    //echo $url_video;  //play video guna omsplayer
  }else{ //jika tiada apa-apa exit je
  exit;
  }
}
else{ //jika tiada apa-apa exit je
exit;
}
//exec("omxplayer $sValue");
?>
