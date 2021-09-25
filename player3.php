<?php
require('config/config.inc.php');
$hari_ini = date("Y-m-d H:i:s");
require(MYSQL);
$nama_file = 'player.php';

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
  $solat_subuh = $row['solat_subuh'];
  $solat_zohor = $row['solat_zohor'];
  $solat_asar = $row['solat_asar'];
  $solat_maghrib = $row['solat_maghrib'];
  $solat_isyak = $row['solat_isyak'];
  $saiz = $row['saiz'];
  $negeri =  strtoupper($row['negeri']);   
  $lokasiID = $row['lokasiID'];
    
    $content = file_get_contents("admin/zone.json");
    $kandungan = json_decode($content, true);
    
    $latitut = $kandungan["$negeri"]["$lokasiID"]["latitut"];
    $longitud = $kandungan["$negeri"]["$lokasiID"]["longitud"];
}

?>

<!DOCTYPE html>
<html lang="ms">

<head>
  <meta http-equiv="Cache-control" content="public">
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

  body{
    overflow: hidden;
    font-size: <?php echo $saiz; ?>px;
  }
  /* Style the video: 100% width and height to cover the entire window */
  #slider{
    height: 90vh;
  }

  .fix-size {
    height: 90vh;
    /* Center and scale the image nicely */
    background: 100% 100% no-repeat center center fixed;
    background-size:100% 100%;
    -webkit-background-size: 100% 100%;
    -moz-background-size: 100% 100%;
    -o-background-size: 100% 100%;
  }

  .myVideo {
    width: 100%;
    height: 90vh;
  }

  .marquee {
    position: fixed;
    bottom: 0;
    width: 100%; /* the plugin works for responsive layouts so width is not necessary */
    height: 10vh;
    font-size:3.0em;
    text-align: center;
    background-color: black;
    color: yellow;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    overflow: hidden;
  }

  /* Add some content at the bottom of the video/page */
  .tarikh-masihi {
    position: fixed;
    bottom: 10vh;
    border-bottom: 10vh solid black;
    border-right: 5vh solid transparent;
    border-left: 0 solid transparent;
    height: 10vh;
    color: #f1f1f1;
    width: 25%;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    font-weight: bold;
  }

  #tarikh-masihi{
    color: yellow;
    font-size:2.8em;
  }

  #hari-masihi{
    font-size:1.6em;
  }

  #bulan-tahun-masihi{
    color: rgb(0, 191, 255);
    font-size:1.6em;
  }

  .tarikh-hijrah {
    position: fixed;
    bottom: 10vh;
    right: 0;
    text-align: right;
    border-bottom: 10vh solid black;
    border-left: 5vh solid transparent;
    border-right: 0 solid transparent;
    height: 10vh;
    color: #f1f1f1;
    width: 25%;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    font-weight: bold;
  }

  #tarikh-hijrah{
    color: yellow;
    font-size:2.8em;
  }

  #bulan-hijrah{
    text-align: right;
    font-size:1.6em;
  }

  #tahun-hijrah{
    text-align: right;
    color: rgb(0, 191, 255);
    font-size:1.6em;
  }


  /* Add some content at the bottom of the video/page */
  .content {
    position: fixed;
    top: 0;
    color: #f1f1f1;
    width: 100%;
    font-size:1.2em;
  }

  .nama-solat{
    border-radius: 10px;
    -webkit-border-radius: 10px 10px 0 0;
    text-align: center;
    background-color: rgba(0, 0, 139, 0.5);
    font-weight: bold;
  }

  .nama-jam{
    position: fixed;
    top: 0;
    right: 1px;
    width: 25%;
    border: 2px solid white;
    border-radius: 10px;
    padding: 1px;
    text-align: center;
    background-color: rgba(0, 0, 0, 0.5);
    font-size:3.5em;
    color: yellow;
    font-weight: bold;
  }

  .waktu-solat{
    border-radius: 10px;
    -webkit-border-radius: 0 0 10px 10px ;
    text-align: center;
    background-color: rgba(169, 169, 169, 0.8);
    font-weight: bold;
    color: black;
    font-size:1.2em;
  }

  .col-solat{
    border: 2px solid white;
    border-radius: 10px;
    -webkit-border-radius: 10px;
    display: inline-block;
    width: 10%;
    margin: 1px;
  }

  .solat{
    background-color:red;
  }

  .blink {
    -webkit-animation-name: example; /* Safari 4.0 - 8.0 */
    -webkit-animation-duration: 2s; /* Safari 4.0 - 8.0 */
    -webkit-animation-iteration-count: infinite; /* Safari 4.0 - 8.0 */
    animation-name: example;
    animation-duration: 2s;
    animation-iteration-count: infinite;
  }
  /* Safari 4.0 - 8.0 */
  @-webkit-keyframes example {
    0%   {background-color:red;}
    25%  {background-color:red;}
    50%  {background-color:#660033;}
    75%  {background-color:#660033;}
    100% {background-color:red;}
  }
  /* Standard syntax */
  @keyframes example {
    0%   {background-color:red;}
    25%  {background-color:red;}
    50%  {background-color:#660033;}
    75%  {background-color:#660033;}
    100% {background-color:red;}
  }
      
   .counter-solat {
    position: fixed;
    border: 2px solid white;
    border-radius: 10px;
    -webkit-border-radius: 10px;
    bottom: 12vh;
    right: 40%;
    width: 20%; /* the plugin works for responsive layouts so width is not necessary */
    /*height: 10vh;*/
    font-size:1.8em;
    text-align: center;
    color: yellow;
    background: rgba(0, 0, 128, 0.5);
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    overflow: hidden;
  }

  .countdown {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    width: 75%;
    max-width: 20rem;
    margin: 0 auto;
  }

  .countdown__item {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-flex: 0;
    -ms-flex: 0 1 auto;
    flex: 0 1 auto;
    min-width: 31%;
    margin-bottom: 1rem;
  }

  .countdown__item--large {
    -webkit-box-flex: 1;
    -ms-flex: auto;
    flex: auto;
    width: 100%;
    font-size: 2.75em;
  }

  .countdown__timer {
    padding: .15em;
    border: 2px solid white;
    -webkit-border-radius: 10px 10px 10px 10px ;
    background-color: rgba(0, 0, 139, 0.3);
    color: white;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    font-weight: bold;
    font-size: 1.6em;
  }

  .countdown__label {
    font-size: 1em;
    padding-top: .40em;
  }
  .countdown__item--large .countdown__label:before, .countdown__item--large .countdown__label:after {
    content: '';
    display: block;
    height: 1px;
    background-image: -webkit-linear-gradient(left, transparent, rgba(0, 0, 0, 0.4), transparent);
    background-image: linear-gradient(left, transparent, rgba(0, 0, 0, 0.4), transparent);
  }

  .tajuk-event{
    margin: auto;
    margin-top: 13vh;
    margin-bottom: 1%;
    width: 80%;
    border: 2px solid white;
    -webkit-border-radius: 10px 10px 10px 10px ;
    background-color: rgba(0, 0, 139, 0.3);
    color: white;
    font-weight: bold;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    font-size: 3em;
  }

  .slide-utama{
    margin:auto;
    margin-top:10%;
    font-size: 4.0em;
    font-weight: bold;
    color: yellow;
    text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -2px black;
    width:80%;
  }
  .alamat{
    font-size: 0.5em;
  }
  </style>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery-1.11.2.min.js"></script>
  <script src='vendor/momentjs/moment.js'></script>
  <script src='vendor/adhan/Adhan.js'></script>
  <script type="text/javascript" src="vendor/sudoSlider/jquery.sudoSlider.min.js"></script>
  <script type="text/javascript" src="vendor/marquee/jquery.marquee.min.js"></script>
  <script>
  function getRemainingTime(endtime) {
    var milliseconds = Date.parse(endtime) - Date.parse(new Date());
    var seconds = Math.floor(milliseconds / 1000 % 60);
    var minutes = Math.floor(milliseconds / 1000 / 60 % 60);
    var hours = Math.floor(milliseconds / (1000 * 60 * 60) % 24);
    var days = Math.floor(milliseconds / (1000 * 60 * 60 * 24));

    return {
      'total': milliseconds,
      'seconds': seconds,
      'minutes': minutes,
      'hours': hours,
      'days': days
    };
  }

  function initClock(id, endtime) {
    var counter = document.getElementById(id);
    var daysItem = counter.querySelector('.js-countdown-days');
    var hoursItem = counter.querySelector('.js-countdown-hours');
    var minutesItem = counter.querySelector('.js-countdown-minutes');
    var secondsItem = counter.querySelector('.js-countdown-seconds');

    function updateClock() {
      var time = getRemainingTime(endtime);

      daysItem.innerHTML = time.days;
      hoursItem.innerHTML = ('0' + time.hours).slice(-2);
      minutesItem.innerHTML = ('0' + time.minutes).slice(-2);
      secondsItem.innerHTML = ('0' + time.seconds).slice(-2);

      if (time.total <= 0) {
        clearInterval(timeinterval);
      }
    }

    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
  }
  </script>

</head>
<body>
  <input id="id-last-update" type="hidden" name="last-update" value="<?php echo $last_update; ?>">

  <div id="slider">
    <div class="fix-size" style="background-image: url('images/<?php echo $slide_utama;?>')">
      <div class="slide-utama text-center">
        <div class="nama-tempat"><?php echo $nama_tempat; ?> </div>
        <div class="alamat"><?php echo $alamat; ?> </div>
      </div>
    </div>
    <?php
    $no_video = 1;
    $no_event = 1;
    $sql = "SELECT * FROM " . database_prefix ."_slider WHERE `paparkan`='1' AND '$hari_ini'>`mula` AND '$hari_ini'<`tamat` ORDER BY giliran ASC";
    $result = mysqli_query($dbc, $sql);
    if (mysqli_num_rows($result) > 0) { //ada rekod

      while($row = mysqli_fetch_assoc($result)) {
        if($row['jenis']==='gambar'){
          ?><div <?php if($row['slide_duration'] != '0'){echo 'data-pause="'.$row['slide_duration']*1000 .'"';} ?> class="fix-size" style="background-image: url('images/<?php echo $row['url']; ?>')"></div>
            <?php

          }else if($row['jenis']==='video'){
            ?>
            <div class="video video<?php echo $no_video; ?>">
              <video muted class="myVideo" id="video_<?php echo $no_video; ?>">
                <source src="video/<?php echo $row['url']; ?>" type="video/mp4">
                  Your browser does not support HTML5 video.
                </video>
              </div><?php
              $no_video++;

            }else if($row['jenis']==='template'){
              ?>
              <div <?php if($row['slide_duration'] != '0'){echo 'data-pause="'.$row['slide_duration']*1000 .'"';} ?> class="fix-size" style="background-image: url('background/<?php echo $row['url']; ?>')">
                <div class="container">
                  <h1><?php echo $row['kandungan']; ?></h1>
                </div>
              </div><?php
            }else if($row['jenis']==='event'){
              ?>
              <div <?php if($row['slide_duration'] != '0'){echo 'data-pause="'.$row['slide_duration']*1000 .'"';} ?> class="fix-size text-center" style="background-image: url('background/<?php echo $row['url']; ?>')">

                <div class="tajuk-event text-center"><?php echo $row['tajuk']; ?></div>
                <div class="countdown" id="js-countdown-<?php echo $row['slider_id']; ?>">
                  <div class="countdown__item countdown__item--large">
                    <div class="countdown__timer js-countdown-days" aria-labelledby="day-countdown">

                    </div>

                    <div class="countdown__label" id="day-countdown">Hari</div>
                  </div>

                  <div class="countdown__item">
                    <div class="countdown__timer js-countdown-hours" aria-labelledby="hour-countdown">

                    </div>

                    <div class="countdown__label" id="hour-countdown">Jam</div>
                  </div>

                  <div class="countdown__item">
                    <div class="countdown__timer js-countdown-minutes" aria-labelledby="minute-countdown">

                    </div>

                    <div class="countdown__label" id="minute-countdown">Minit</div>
                  </div>

                  <div class="countdown__item">
                    <div class="countdown__timer js-countdown-seconds" aria-labelledby="second-countdown">

                    </div>

                    <div class="countdown__label" id="second-countdown">Saat</div>
                  </div>
                </div>
                <script>
                var countdown = new Date("<?php echo $row['tamat']; ?>");
                initClock('js-countdown-<?php echo $row['slider_id']; ?>', countdown);
                </script>

              </div>
              <?php
            }
          }
        }
        ?>

      </div>

      <div class="marquee" id="scrollku">
        <?php
        $text = '';
        $sql = "SELECT `text` FROM `" . database_prefix ."_scroll` WHERE `paparkan`='1' ORDER BY giliran ASC";
        $result = mysqli_query($dbc, $sql);
        if (mysqli_num_rows($result) > 0) { //pernah memohon kursus. ada rekod

          while($row = mysqli_fetch_assoc($result)) {
            //  for ($x = 0; $x <= 15; $x++) {
            //    $text .= '&nbsp;';
            //  }
            $text .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            $text .= $row['text'];

          }
        }
        echo $text;
        ?>
      </div>
    
    <div class="counter-solat" id="counter-azan-solat">
          <div class="nama-solat" id="counter-azan-nama">Azan Zohor</div>
          <div class="waktu-solat" id="counter-azan-minit-saat">0:00</div>
      </div>

      <div class="tarikh-masihi">
        <div class="row no-gutters">
          <div class="col-3 bulat text-center">
            <div  id="tarikh-masihi">00</div>
          </div>
          <div class="col-9">
            <div align="left" id="hari-masihi">XXXXX</div>
            <div align="left" id="bulan-tahun-masihi"><span id="bulan-masihi">XXXXXXXX</span> <span id="tahun-masihi">0000</span></div>
          </div>
        </div>
      </div>

      <div class="tarikh-hijrah">
        <div class="row no-gutters">
          <div class="col-9">
            <div align="left" id="bulan-hijrah">JAMADIL AKHIR</div>
            <div align="left" id="tahun-hijrah">0000</div>
          </div>
          <div class="col-3 bulat text-center">
            <div id="tarikh-hijrah">00</div>
          </div>
        </div>
      </div>

      <!-- Optional: some overlay text to describe the video -->
      <div class="content">
        <div class="col-solat" id="solat-imsak">
          <div class="nama-solat">IMSAK</div>
          <div class="waktu-solat" id="imsak">0:00</div>
        </div>
        <div class="col-solat" id="solat-subuh">
          <div class="nama-solat">SUBUH</div>
          <div class="waktu-solat" id="subuh">0:00</div>
        </div>
        <div class="col-solat" id="solat-syuruk">
          <div class="nama-solat">SYURUK</div>
          <div class="waktu-solat" id="syuruk">0:00</div>
        </div>
        <div class="col-solat" id="solat-zohor">
          <div class="nama-solat">ZOHOR</div>
          <div class="waktu-solat" id="zohor">0:00</div>
        </div>
        <div class="col-solat" id="solat-asar">
          <div class="nama-solat">ASAR</div>
          <div class="waktu-solat" id="asar">0:00</div>
        </div>
        <div class="col-solat" id="solat-maghrib">
          <div class="nama-solat">MAGHRIB</div>
          <div class="waktu-solat" id="maghrib">0:00</div>
        </div>
        <div class="col-solat" id="solat-isyak">
          <div class="nama-solat">ISYAK</div>
          <div class="waktu-solat" id="isyak">0:00</div>
        </div>
      </div>
      <div class="nama-jam" id="clock">12.48 PM</div>

      <?php include('script.php') ?>

  </body>
  </html>
