<?php
require('config/config.inc.php');
require(MYSQL);
$nama_file = 'template1.php';

$sql = "SELECT * FROM " . database_prefix ."_umum";
$result = mysqli_query($dbc, $sql);
if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
  $nama_tempat =  $row['nama_tempat'];
  $alamat = $row['alamat'];
  $slide_utama = $row['slide_utama'];
  $jeda_slide = $row['jeda_slide'];
  $effect = $row['effect'];
  $last_update = $row['last_update'];
  $iqamah_subuh = $row['iqamah_subuh'];
  $iqamah_zohor = $row['iqamah_zohor'];
  $iqamah_asar = $row['iqamah_asar'];
  $iqamah_maghrib = $row['iqamah_maghrib'];
  $iqamah_isyak = $row['iqamah_isyak'];
  $saiz = $row['saiz'];
  $tempoh_khutbah = $row['jumaat_khutbah'];
  $tempoh_azan_jumaat = $row['jumaat_azan'];
}
?>

<!DOCTYPE html>
<html lang="ms">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Memaparkan waktu solat, info dan berbagai maklumat.  Khusus untuk kegunaan masjid">
  <meta name="author" content="Hairilfaiz @ denshie.com">
  <link rel="shortcut icon" href="setting/assets/images/islamic-symbols-icon-png-13211-128x106.png" type="image/x-icon">
  <title>Masjid Info</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="vendor/flipClock/flipclock.css">

  <!-- Custom styles for this template -->
  <style>

  body {
    background: #d7d7d7;
    color: white;
    background-image: url("background/azan-bg.jpg");
    background-color: #cccccc;
    background: 100% 100% no-repeat center center fixed;
    background-repeat: no-repeat;
    background-size:100% 100%;
    -webkit-background-size: 100% 100%;
    -moz-background-size: 100% 100%;
    -o-background-size: 100% 100%;
    background-size: 100% 100%;
    font-size: <?php echo $saiz; ?>px;
    height: 100vh;
    overflow: hidden;
  }


  #alamat{
    font-size:3.0em;
    font-weight: bold;
    color:#00ff00;
    text-align: center;
  }

  #clock{
    color:#00ff00;
    position: fixed;
    bottom: 0;
    right: 1px;
    width: 18%;
    padding: 1px;
    text-align: center;
    font-size:2.5em;
    font-weight: bold;
  }

  #iqamah{
    text-align: center;
    font-size:6.0em;
  }

  #counter{
    text-align: center;
    font-size:9.0em;
  }

  .do-splitflap{
    margin-top: 10vh;
  }

  .splitflap {
    margin: 0 auto;

    -webkit-perspective-origin: top center;
    -moz-perspective-origin: top center;
    -ms-perspective-origin: top center;
    perspective-origin: top center;

    -webkit-perspective: 900px;
    -moz-perspective: 900px;
    -ms-perspective: 900px;
    perspective: 900px;
  }

  </style>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery-1.11.2.min.js"></script>
  <script src="vendor/splitFlap/js/jquery/jquery.splitflap.js"></script>
</head>

<body>

  <div class="maklumat-umum">
    <div class="header-kotak" id="alamat"><?php echo $nama_tempat; ?></div>
  </div>


  <div class="maklumat-masa">
    <div class="header-kotak" align="right" id="clock"></div>
  </div>




  <h1 class="do-splitflap" id="flip-content">AZAN JUMAAT</h1>

  <div id="iqamah">IQAMAH</div>
  <div id="counter"></div>

  <script>
  var tempoh_iqamah = <?php echo $tempoh_azan_jumaat*60; ?>;

  $('.do-splitflap').splitFlap({
    image:          'images/chars_putih.png',
    speed:          10
  });

  function bunyi_beep(){
    //repeat audio 15 kali
    // var times = 15;
    // var loop = setInterval(repeat, 1000);

    //  function repeat() {
    //    times--;
    //    if (times === 0) {
    //      clearInterval(loop);
    //   }

    var audio = new Audio('audio/beep.mp3');
    audio.loop = false;
    audio.play();
    //  }
    //  repeat();
    //$.ajax({
    //  url: 'admin/play_audio.php',
    //  type: 'get'
   // }); // untuk play video
  }


  function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    
    function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }
    //ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    ap = (hr < 12) ? "AM" : "PM";
        //hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + ":" + min + " " + ap;

    tempoh_iqamah--;

    var minutes = Math.floor((tempoh_iqamah / 60));
    var seconds = Math.floor((tempoh_iqamah % 60));
    minutes = checkTime(minutes);
    seconds = checkTime(seconds);

    document.getElementById("counter").innerHTML =  minutes + ":" + seconds;

    if(tempoh_iqamah <= 0) countdownFinished();

    setTimeout(function(){ startTime() }, 1000);
  }


  bunyi_beep();
  startTime();

  function countdownFinished() {
    //setTimeout(function () {
      window.location.replace("khutbah_jumaat.php");
  //  }, 1000);
  }

  </script>
</body>
</html>
