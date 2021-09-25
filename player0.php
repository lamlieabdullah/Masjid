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

  $no_video = 1;
  $no_event = 1;
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
    background: black;  /* fallback for old browsers */
  }

  #slider {
    position: fixed;
    right:0;
    top: 0vh;
    width: 70%; /* the plugin works for responsive layouts so width is not necessary */
    height: 89vh;
    border: 0.5vh solid white;
    overflow: hidden;
  }

  .fix-size {
    height: 89vh;
    /* Center and scale the image nicely */
    background: 100% 100% no-repeat center center fixed;
    background-size:100% 100%;
    -webkit-background-size: 100% 100%;
    -moz-background-size: 100% 100%;
    -o-background-size: 100% 100%;
  }

  .content {
  position: fixed;
  bottom: 11vh;
  left: 0;
  height: 89vh;
  background: white;
  color: black;
  width: 30%;
  font-size:1.3em;
  border: 0.5vh solid white;
}

#nama-masjid{
  font-size:2.0em;
  font-weight: bold;
  height: 10vh;
  vertical-align: middle;
  line-height: 10vh;       /* the same as your div height */
  overflow: hidden;
}

#image-waktu-solat {
  background-image: url("background/masjid_13a.jpg");
  background: 100% 100% no-repeat center center fixed;
  background-size:100% 100%;
  -webkit-background-size: 100% 100%;
  -moz-background-size: 100% 100%;
  -o-background-size: 100% 100%;
  position: fixed;
  left:0;
  top: 10vh;
  width: 30%; /* the plugin works for responsive layouts so width is not necessary */
  height: 19vh;
  border: 0.5vh solid white;
}

#waktu-solat{
  position: fixed;
  left:0;
  top: 29vh;
  width: 30%; /* the plugin works for responsive layouts so width is not necessary */
  height: 19vh;
  font-size:1.4em;
  font-weight: bold;
}

.col-waktu{
  height: 6vh;
  vertical-align: middle;
  line-height: 6vh;       /* the same as your div height */
  background-color: #b3ffb3;
  width: 100%;
}

.table{
  font-size:1.1em;
  text-align: center;
  border: 1vh solid white;
}

.ganjil{
background-color: #29a329;
}

.genap{
background-color: #b3b3ff
}

  #scrollku {
    background-color: #004d00;
    position: fixed;
    bottom: 0;
    width: 80%; /* the plugin works for responsive layouts so width is not necessary */
    height: 11vh;
    font-size:2.5em;
    font-weight: bold;
    vertical-align: middle;
    line-height: 10vh;       /* the same as your div height */
    color: white;
    border: 0.5vh solid white;
    overflow: hidden;
  }

  #waktu {
    background-color: #004d00;
    position: fixed;
    right:0;
    bottom: 0;
    width: 20%; /* the plugin works for responsive layouts so width is not necessary */
    height: 11vh;
    font-size:3.4em;
    font-weight: bold;
    text-align: center;
    vertical-align: middle;
    line-height: 10vh;       /* the same as your div height */
    color: white;
    border: 0.5vh solid white;
    overflow: hidden;
  }

  .solat{
  background-color:rgba(220, 20, 60, 0.5);
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
  0%   {background-color:rgba(220, 20, 60, 0.3);}
  25%  {background-color:rgba(220, 20, 60, 0.3);}
  50%  {background-color:rgba(0, 0, 0, 0.3);}
  75%  {background-color:rgba(0, 0, 0, 0.3);}
  100% {background-color:rgba(220, 20, 60, 0.3);}
}
/* Standard syntax */
@keyframes example {
  0%   {background-color:rgba(220, 20, 60, 0.3);}
  25%  {background-color:rgba(220, 20, 60, 0.3);}
  50%  {background-color:rgba(0, 0, 0, 0.3);}
  75%  {background-color:rgba(0, 0, 0, 0.3);}
  100% {background-color:rgba(220, 20, 60, 0.3);}
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
      text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
      background-color: rgba(0, 0, 0, 0.3);
      width:80%;
  }
  .alamat{
    font-size: 0.5em;
  }

  .counter-solat {
    position: fixed;
    border: 2px solid white;
    border-radius: 10px;
    -webkit-border-radius: 10px;
    bottom: 11vh;
    right: 22%;
    width: 30%; /* the plugin works for responsive layouts so width is not necessary */
    /*height: 10vh;*/
    font-size:2.5em;
    text-align: center;
    color: yellow;
    background: rgba(0, 0, 128, 0.5);
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    overflow: hidden;
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

    $sql = "SELECT * FROM " . database_prefix ."_slider WHERE `paparkan`='1' AND '$hari_ini'>`mula` AND '$hari_ini'<`tamat` ORDER BY giliran ASC";
    $result = mysqli_query($dbc, $sql);
    if (mysqli_num_rows($result) > 0) { //ada rekod

      while($row = mysqli_fetch_assoc($result)) {
        if($row['jenis']==='gambar'){
          ?><div <?php if($row['slide_duration'] != '0'){echo 'data-pause="'.$row['slide_duration']*1000 .'"';} ?> class="fix-size" style="background-image: url('images/<?php echo $row['url']; ?>')"></div>
            <?php

          }else if($row['jenis']==='video'){
            ?>
            <div <?php if($row['slide_duration'] != '0'){echo 'data-pause="'.$row['slide_duration']*1000 .'" ';} ?>class="fix-size video video<?php echo $no_video; ?>" style="background-image: url('background/template_4.jpg')">
              <div class="slide-utama text-center">
                <div class="nama-tempat">Mainkan Video </div>
              </div>
              <input type="hidden" id="video_ID_<?php echo $no_video; ?>" value="<?php echo $row['slider_id']; ?>">
              <input type="hidden" id="video_Dur_<?php echo $no_video; ?>" value="<?php echo $row['slide_duration']; ?>">
            </div><?php
            $no_video++;

          }else if($row['jenis']==='template'){
            ?>
            <div <?php if($row['slide_duration'] != '0'){echo 'data-pause="'.$row['slide_duration']*1000 .'"';} ?> class="fix-size" style="background-image: url('background/<?php echo $row['url']; ?>')">
              <div class="container">
                <?php echo $row['kandungan']; ?>
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

    <div class="counter-solat" id="counter-azan-solat">
        <div class="nama-solat" id="counter-azan-nama">Azan Zohor</div>
        <div class="waktu-solat" id="counter-azan-minit-saat">0:00</div>
    </div>

    <div class="content">
      <div class="text-center" id="nama-masjid"><?php echo $nama_tempat; ?> </div>
      <div id="image-waktu-solat"></div>

      <div id="waktu-solat">
    <div class="col-waktu text-center"><span id="tarikh-masihi">00</span> <span id="bulan-masihi">xx</span> <span id="tahun-masihi">0000</span></div>

    <div class="col-waktu text-center"><span id="tarikh-hijrah">00</span> <span id="bulan-hijrah">xx</span> <span id="tahun-hijrah">0000</span></div>

      <table class="table table-bordered table-sm">
  <tbody>
    <tr id="solat-imsak" class="ganjil">
      <td>IMSAK</td>
      <td id="imsak">0:00</td>
    </tr>
    <tr id="solat-subuh" class="genap">
      <td>SUBUH</td>
      <td id="subuh">0:00</td>
    </tr>
    <tr id="solat-syuruk" class="ganjil">
      <td>SYURUK</td>
      <td id="syuruk">0:00</td>
    </tr>
    <tr id="solat-zohor" class="genap">
      <td>ZOHOR</td>
      <td id="zohor">0:00</td>
    </tr>
    <tr id="solat-asar" class="ganjil">
      <td>ASAR</td>
      <td id="asar">0:00</td>
    </tr>
    <tr id="solat-maghrib" class="genap">
      <td>MAGHRIB</td>
      <td id="maghrib">0:00</td>
    </tr>
    <tr id="solat-isyak" class="ganjil">
      <td>ISYAK</td>
      <td id="isyak">0:00</td>
    </tr>
  </tbody>
</table>

    </div>
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

    <div id="waktu"><span id="clock">12.48 PM </span></div>
    <div id="hari-masihi">XXXXX</div>


    <?php include('script.php') ?>
    <script>
    $("#solat-imsak").hide();
    </script>
  </body>
  </html>
