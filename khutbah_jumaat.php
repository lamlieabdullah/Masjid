<?php
require('config/config.inc.php');
require(MYSQL);

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
  $tempoh_khutbah = $row['jumaat_khutbah'];
  $tempoh_solat_jumaat = $row['jumaat_solat'];
  $saiz = $row['saiz'];
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

  <!-- Custom styles for this template -->
  <style>

  body {
    background: #d7d7d7;
    color: white;
    background-image: url("background/bg-khutbah.jpg");
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

  </style>

</head>

<body>

  <div class="maklumat-umum">
    <div class="header-kotak" id="alamat"><?php echo $nama_tempat; ?></div>
  </div>


  <div class="maklumat-masa">
    <div class="header-kotak" align="right" id="clock"></div>
  </div>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery-1.11.2.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script>
    function startTime() {
      var today = new Date();
      var hr = today.getHours();
      var min = today.getMinutes();
      var sec = today.getSeconds();
      //ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    ap = (hr < 12) ? "AM" : "PM";
        //hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
      document.getElementById("clock").innerHTML = hr + ":" + min + " " + ap;
      setTimeout(function(){ startTime() }, 1000);
    }

    

    startTime();

    setTimeout(function(){ window.location.replace("solat.php?tempoh_solat=<?php echo $tempoh_solat_jumaat; ?>")} , <?php echo $tempoh_khutbah; ?>*60*1000);

    </script>
  </body>
  </html>
