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
  $lokasiID = $row['lokasiID'];
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
    background-color: #006600;
    color: yellow;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    overflow: hidden;
  }

  /* Add some content at the bottom of the video/page */
  .tarikh-masihi {
    position: fixed;
    top: 0;
    left: 10px;
    background: rgba(0, 0, 0, 0.3);
    color: #f1f1f1;
    width: 22%;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    font-weight: bold;
  }

  #tarikh-masihi{
    color: black;
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
    top: 0;
    right: 10px;
    text-align: right;
    background: rgba(0, 0, 0, 0.3);
    color: #f1f1f1;
    width: 22%;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    font-weight: bold;
  }

  #tarikh-hijrah{
    color: black;
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
  
  .bulat {
    border-radius: 50%;
    background-color: yellow;
}

  /* Add some content at the bottom of the video/page */
  .content {
    position: fixed;
    bottom: 10vh;
    background: rgba(0, 0, 0, 0.3);
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
    display: inline-block;
    width: 25%;
    border: 2px solid white;
    border-radius: 10px;
    padding: 1px;
    text-align: center;
    background-color: rgba(0, 0, 0, 0.5);
    font-size:3.0em;
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

  <div class="tarikh-masihi">
    <div class="row no-gutters">
      <div class="col-3 bulat text-center">
        <div  id="tarikh-masihi">00</div>
      </div>
      <div class="col-9">
        <div align="left" id="hari-masihi">XXXXX</div>
        <div align="left" id="bulan-tahun-masihi">XXXXXXXX 0000</div>
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

    <div class="nama-jam" id="clock">12.48 PM</div>
  </div>

  <script type="text/javascript">

  var sudoSlider = $("#slider").sudoSlider({
    responsive: true,
    prevNext: false,
    effect: "random",
    pause: <?php echo $jeda_slide; ?>000,
    auto:true,
    continuous: true,

    beforeAnimation: function(slide){

    },

    afterAnimation: function(slide){
      //  $('div.descrip-text #slidenumber').text(slide);
      var text = $(this).attr('class');
      //  $('div.descrip-text #slidehtml').text(text);
      if( text.indexOf('video1') >= 0){
        // Found word
        sudoSlider.stopAuto();
        video_1.play();
        video_1.onended = function(){
          sudoSlider.startAuto();
        }
      }
    },
    initCallback: function() {
      var slide = this.getValue("currentSlide");
      var text = this.getSlide(slide).attr('class');
      $('div.descrip-text #slidehtml').text(text);
    }
  });

  function get_tarikh_masihi(){
     var today = new Date();
      var months = ['Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember'];
    var days = ['Ahad', 'Isnin', 'Selasa', 'Rabu', 'Khamis', 'Jumaat', 'Sabtu'];
    var curWeekDay = days[today.getDay()];
    var curDay = today.getDate();
    var curMonth = months[today.getMonth()];
    var curYear = today.getFullYear();
    document.getElementById("hari-masihi").innerHTML = curWeekDay.toUpperCase();
    document.getElementById("tarikh-masihi").innerHTML = curDay;
    document.getElementById("bulan-tahun-masihi").innerHTML = curMonth.toUpperCase() + " " + curYear;
  }
  function startTime() {

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }

    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    ap = (hr < 12) ? "AM" : "PM";
    //hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec;

    if(hr=="00" && min=="00" && sec=="00"){
      window.location='player.php';
    }

    if(sec =="00"){
        // get waktu solat string kepada time kiraan
    var imsak = toDate(document.getElementById("imsak").textContent);
    var subuh = toDate(document.getElementById("subuh").textContent);
    var syuruk = toDate(document.getElementById("syuruk").textContent);
    var zohor = toDate(document.getElementById("zohor").textContent);
    var asar = toDate(document.getElementById("asar").textContent);
    var maghrib = toDate(document.getElementById("maghrib").textContent);
    var isyak = toDate(document.getElementById("isyak").textContent);

    //reset paparan waktu solat
    var list = ['solat-imsak', 'solat-subuh', 'solat-syuruk', 'solat-zohor', 'solat-asar', 'solat-maghrib', 'solat-isyak'];
    for(var i in list){
      var waktu_solat = document.getElementById(list[i]).classList;
      if (waktu_solat.contains("blink")) {
        waktu_solat.remove("blink");
      }
      if (waktu_solat.contains("solat")) {
        waktu_solat.remove("solat");
      }
    }

    //tukar slide ketika masuk waktu
        //subuh
        if(today>=subuh && today-subuh<2000) {
          window.location.replace("azan.php?waktu_solat=SUBUH&tempoh_iqamah=<?php echo $iqamah_subuh; ?>&tempoh_solat=<?php echo $solat_subuh; ?>");
        }
        //zohor
        if(today>=zohor && today-zohor<2000) {
          if(document.getElementById("hari-masihi").textContent==='JUMAAT'){
            window.location.replace("azan_jumaat.php");
          }
          else
          window.location.replace("azan.php?waktu_solat=ZOHOR&tempoh_iqamah=<?php echo $iqamah_zohor; ?>&tempoh_solat=<?php echo $solat_zohor; ?>");
        }
        //asar
        if(today>=asar && today-asar<2000) {
          window.location.replace("azan.php?waktu_solat=ASAR&tempoh_iqamah=<?php echo $iqamah_asar; ?>&tempoh_solat=<?php echo $solat_asar; ?>");
        }
        //maghrib
        if(today>=maghrib && today-maghrib<2000) {
          window.location.replace("azan.php?waktu_solat=MAGHRIB&tempoh_iqamah=<?php echo $iqamah_maghrib; ?>&tempoh_solat=<?php echo $solat_maghrib; ?>");
        }
        //isyak
        if(today>=isyak && today-isyak<2000) {
          window.location.replace("azan.php?waktu_solat=ISYAK&tempoh_iqamah=<?php echo $iqamah_isyak; ?>&tempoh_solat=<?php echo $solat_isyak; ?>");
        }


    //blink 5 minit sebelum solat 1000ms*60*5 = 5minit
    //solat subuh
    if(today<subuh && subuh-today<1000*60*5){
      blink_solat("solat-subuh");
    }

    //solat zohor
    if(today<zohor && zohor-today<1000*60*5){
      blink_solat("solat-zohor");
    }

    //solat asar
    if(today<asar && asar-today<1000*60*5){
      blink_solat("solat-asar");
    }

    //solat maghrib
    if(today<maghrib && maghrib-today<1000*60*5){
      blink_solat("solat-maghrib");
    }

    //solat isyak
    if(today<isyak && isyak-today<1000*60*5){//5 minit
      blink_solat("solat-isyak");
    }


    //highlight waktu solat
    //subuh
    if(today>=subuh && today<syuruk){
      highlight_solat("solat-subuh");
    }
    //zohor
    if(today>=zohor && asar-today>1000*60*5) {
      highlight_solat("solat-zohor");
    }
    //asar
    if(today>=asar && maghrib-today>1000*60*5) {
      highlight_solat("solat-asar");
    }
    //maghrib
    if(today>=maghrib && isyak-today>1000*60*5) {
      highlight_solat("solat-maghrib");
    }
    //isyak
    if(today>=isyak || subuh-today>1000*60*5) {
     highlight_solat("solat-isyak");
    }
    }


    setTimeout(function(){ startTime() }, 1000);
  }

  function get_prayer_times(){
    console.log('get prayer time');
    var currentTime = new Date();
    var year = currentTime.getFullYear();
    var month = currentTime.getMonth();
    var day = currentTime.getDate();
    var lokasi = "<?php echo $lokasiID ?>";

    $.getJSON("waktuSolat/"+year+"/lokasi/"+lokasi+".json", function(result){
      //console.log(result.tarikh[month][day-1].date);
      var waktu_imsak = result.tarikh[month][day-1].imsak;
      document.getElementById('imsak').innerHTML = timeTo12HrFormat(waktu_imsak);
      var waktu_subuh = result.tarikh[month][day-1].subuh;
      document.getElementById('subuh').innerHTML = timeTo12HrFormat(waktu_subuh);
      var waktu_syuruk = result.tarikh[month][day-1].syuruk;
      document.getElementById('syuruk').innerHTML = timeTo12HrFormat(waktu_syuruk);

      var t_zohor = toDate(result.tarikh[month][day-1].zohor);
      var zohor_jam = t_zohor.getHours();
      var zohor_minit = t_zohor.getMinutes();
      if(zohor_minit < 10) zohor_minit = '0' + zohor_minit;
      if(zohor_jam < 12) {
        zohor_jam = zohor_jam + 12;
      }
      var waktu_zohor = zohor_jam + ':' + zohor_minit;
      document.getElementById('zohor').innerHTML = timeTo12HrFormat(waktu_zohor);


      var t_asar = toDate(result.tarikh[month][day-1].asar);
      var asar_jam = t_asar.getHours();
      var asar_minit = t_asar.getMinutes();
      if(asar_minit < 10) asar_minit = '0' + asar_minit;
      if(asar_jam < 12) {
        asar_jam = asar_jam + 12;
      }
      var waktu_asar = asar_jam + ':' + asar_minit;
      document.getElementById('asar').innerHTML = timeTo12HrFormat(waktu_asar);

      var t_maghrib = toDate(result.tarikh[month][day-1].maghrib);
      var maghrib_jam = t_maghrib.getHours();
      var maghrib_minit = t_maghrib.getMinutes();
      if(maghrib_minit < 10) maghrib_minit = '0' + maghrib_minit;
      if(maghrib_jam < 12) {
        maghrib_jam = maghrib_jam + 12;
      }
      var waktu_maghrib = maghrib_jam + ':' + maghrib_minit;
      document.getElementById('maghrib').innerHTML = timeTo12HrFormat(waktu_maghrib);

      var t_isyak = toDate(result.tarikh[month][day-1].isyak);
      var isyak_jam = t_isyak.getHours();
      var isyak_minit = t_isyak.getMinutes();
      if(isyak_minit < 10) isyak_minit = '0' + isyak_minit;
      if(isyak_jam < 12) {
        isyak_jam = isyak_jam + 12;
      }
      var waktu_isyak = isyak_jam + ':' + isyak_minit;
      document.getElementById('isyak').innerHTML = timeTo12HrFormat(waktu_isyak);
      get_hijrah();

    });
  }

  function get_hijrah(){
    console.log('get hijrah');
    var maghrib = toDate(document.getElementById("maghrib").textContent);
    var currentTime = new Date();

    if(currentTime>=maghrib){
      currentTime.setDate(currentTime.getDate()+1);
    }

    var year = currentTime.getFullYear();
    var month = currentTime.getMonth();
    var day = currentTime.getDate();

    $.getJSON("waktuSolat/"+year+"/hijrah.json", function(result){
      //console.log(result.tarikh[month][day-1].tarikh_masihi);
      var tarikh_hijrah = result.tarikh[month][day-1].tarikh_hijrah;
      var pecah_tarikh_hijrah = tarikh_hijrah.split(" ");
      console.log("0 = " + pecah_tarikh_hijrah[0]);
      document.getElementById("tarikh-hijrah").innerHTML = pecah_tarikh_hijrah[0];
      console.log("1 = " + pecah_tarikh_hijrah[1]);
      document.getElementById("bulan-hijrah").innerHTML = pecah_tarikh_hijrah[1].toUpperCase();
      console.log("2 = " + pecah_tarikh_hijrah[2]);
      document.getElementById("tahun-hijrah").innerHTML = pecah_tarikh_hijrah[2];
    });
  }

  function timeTo12HrFormat(time){   // Take a time in 24 hour format and format it in 12 hour format
    var time_part_array = time.split(":");
    var ampm = 'AM';

    if (time_part_array[0] >= 12) {
      ampm = 'PM';
    }

    if (time_part_array[0] > 12) {
      time_part_array[0] = time_part_array[0] - 12;
    }

    formatted_time = time_part_array[0] + ':' + time_part_array[1] + ' ' + ampm;

    return formatted_time;
  }

  function toDate(dStr) {
    var now = new Date();
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var day = now.getDate();

    var time_part_array = dStr.split(" ");
    var time_jam_minit = time_part_array[0].split(":");

    var jam = time_jam_minit[0];
    var minit = time_jam_minit[1];
    var ampm = time_part_array[1];

    if(ampm == "PM") jam = parseInt(jam) + 12;
    //return "Invalid Format";
    return new Date(year+"-"+month+"-"+day+" "+jam+":"+minit+":"+"00");
  }

  function blink_solat(waktu_solat_ku){
    //reset paparan waktu solat
    var list = ['solat-imsak', 'solat-subuh', 'solat-syuruk', 'solat-zohor', 'solat-asar', 'solat-maghrib', 'solat-isyak'];
    for(var i in list){
      var waktu_solat = document.getElementById(list[i]).classList;
      if (waktu_solat.contains("blink")) {
        waktu_solat.remove("blink");
      }
      if (waktu_solat.contains("solat")) {
        waktu_solat.remove("solat");
      }
    }
    document.getElementById(waktu_solat_ku).classList.add("blink");
  }

  function highlight_solat(waktu_solat_ku){
    //reset paparan waktu solat
    var list = ['solat-imsak', 'solat-subuh', 'solat-syuruk', 'solat-zohor', 'solat-asar', 'solat-maghrib', 'solat-isyak'];
    for(var i in list){
      var waktu_solat = document.getElementById(list[i]).classList;
      if (waktu_solat.contains("blink")) {
        waktu_solat.remove("blink");
      }
      if (waktu_solat.contains("solat")) {
        waktu_solat.remove("solat");
      }
    }
    document.getElementById(waktu_solat_ku).classList.add("solat");
  }

  function getUpdate(){
    var masa_terakhir = document.getElementById("id-last-update").value;
    //umum call
    $.ajax({
      url: 'php/perubahan.php',
      type: 'post',
      success: function(data, status) {
        if(data > masa_terakhir) {
          window.location='player.php';
        }
      }
    }); // end ajax umum call
    setTimeout(function(){ getUpdate() }, 20000);
  }//end function paparSliderScroll
  
    $('.marquee').marquee({
    //speed in milliseconds of the marquee
    duration: 15000,
    //gap in pixels between the tickers
    gap: 700,
    //time in milliseconds before the marquee will start animating
    delayBeforeStart: 0,
    //'left' or 'right'
    direction: 'left',
    //true or false - should the marquee be duplicated to show an effect of continues flow
    duplicated: true
  });


  get_tarikh_masihi();
  get_prayer_times();
  startTime();
  getUpdate();

</script>

</body>
</html>