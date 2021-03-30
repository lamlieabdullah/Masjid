<?php $bil_video = $no_video - 1; ?>
<script type="text/javascript">
var play_video = 1;

var sudoSlider = $("#slider").sudoSlider({
  responsive: true,
  prevNext: false,
  effect: "random",
  pause: <?php echo $jeda_slide; ?>000,
  auto:true,
  continuous: true,

  beforeAnimation: function(slide){
    document.getElementsByTagName('body')[0].style.display = "block";  
  },

  afterAnimation: function(slide){
      
    //  $('div.descrip-text #slidenumber').text(slide);
    var text = $(this).attr('class');
    <?php
      while($bil_video > 0){
        ?>
      if( play_video == 1 && text.indexOf('video<?php echo $bil_video; ?>') >= 0){
      // Found word
      var id = document.getElementById("video_ID_<?php echo $bil_video; ?>").value;
      var dur = document.getElementById("video_Dur_<?php echo $bil_video; ?>").value;
      document.getElementsByTagName('body')[0].style.display = "none";
      $.ajax({
        url: 'admin/play_video.php?id='+id,
        type: 'get'
      }); // untuk play video
    }
      <?php
          $bil_video--;
      }
      ?>
  },
  initCallback: function() {
    var slide = this.getValue("currentSlide");
    var text = this.getSlide(slide).attr('class');
    $('div.descrip-text #slidehtml').text(text);
  }
});


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

  //restart device pada jam 12:05 pagi untuk refresh
    
  if(hr=="00" && min=="05" && sec=="00"){
    window.location='player.php';
  }
  

   // if(sec =="00"){
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
    var distance = subuh - today;
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById("counter-azan-minit-saat").innerHTML = minutes + ":" + checkTime(seconds);
    document.getElementById("counter-azan-nama").innerHTML = "Azan Subuh";
    $("#counter-azan-solat").show();
    play_video = 0;
  }

  //solat zohor
  else if(today<zohor && zohor-today<1000*60*5){
    blink_solat("solat-zohor");
    var distance = zohor - today;
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById("counter-azan-minit-saat").innerHTML = minutes + ":" + checkTime(seconds);
    document.getElementById("counter-azan-nama").innerHTML = "Azan Zohor";
    $("#counter-azan-solat").show();
    play_video = 0;
  }

  //solat asar
  else if(today<asar && asar-today<1000*60*5){
    blink_solat("solat-asar");
    var distance = asar - today;
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById("counter-azan-minit-saat").innerHTML = minutes + ":" + checkTime(seconds);
    document.getElementById("counter-azan-nama").innerHTML = "Azan Asar";
    $("#counter-azan-solat").show();
    play_video = 0;
  }

  //solat maghrib
  else if(today<maghrib && maghrib-today<1000*60*5){
    blink_solat("solat-maghrib");
    var distance = maghrib - today;
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById("counter-azan-minit-saat").innerHTML = minutes + ":" + checkTime(seconds);
    document.getElementById("counter-azan-nama").innerHTML = "Azan Maghrib";
    $("#counter-azan-solat").show();
    play_video = 0;
  }

  //solat isyak
  else if(today<isyak && isyak-today<1000*60*5){//5 minit
    blink_solat("solat-isyak");
    var distance = isyak - today;
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById("counter-azan-minit-saat").innerHTML = minutes + ":" + checkTime(seconds);
    document.getElementById("counter-azan-nama").innerHTML = "Azan Isyak";
    $("#counter-azan-solat").show();
    play_video = 0;
  } else
  {
    $("#counter-azan-solat").hide();
    play_video = 1;
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
  //  } //tamat if(sec =="00")


  setTimeout(function(){ startTime() }, 1000);
}

function get_prayer_times(){
    console.log('get prayer time');
    var date = new Date();
    var coordinates = new adhan.Coordinates(<?php echo $latitut; ?>, <?php echo $longitud; ?>);
    var params = adhan.CalculationMethod.Singapore();
    params.madhab = adhan.Madhab.Shafi;
    var prayerTimes = new adhan.PrayerTimes(coordinates, date, params);
    var formattedTime = adhan.Date.formattedTime;   

    document.getElementById('subuh').innerHTML = formattedTime(prayerTimes.fajr, 8);
    
    var waktuSubuh = document.getElementById("subuh").textContent;
    document.getElementById('imsak').innerHTML = moment(waktuSubuh, "h:mm A").subtract(10, 'm').format("h:mm A");

    document.getElementById('syuruk').innerHTML = formattedTime(prayerTimes.sunrise, 8);

    document.getElementById('zohor').innerHTML = formattedTime(prayerTimes.dhuhr, 8);

    document.getElementById('asar').innerHTML = formattedTime(prayerTimes.asr, 8);

    document.getElementById('maghrib').innerHTML = formattedTime(prayerTimes.maghrib, 8);

    document.getElementById('isyak').innerHTML = formattedTime(prayerTimes.isha, 8);
      
    get_tarikh();

}

function get_tarikh(){
    var tahun = moment().year();
    var maghrib = toDate(document.getElementById("maghrib").textContent);
    console.log(maghrib);
    var currentTime = new Date();
    var hariTahunMasihi = moment().dayOfYear() - 1;
    
    if(currentTime>=maghrib){
        var hariTahunHijrah = moment().dayOfYear();
    }else{
        var hariTahunHijrah = moment().dayOfYear() - 1;
    }
    
    $.getJSON("waktuSolat/"+tahun+"/hijrah.json", function(result){
        var tarikh_masihi  = result[hariTahunMasihi].TarikhMiladi;
        var tarikh_hijrah  = result[hariTahunHijrah].TarikhHijri;
        document.getElementById("hari-masihi").innerHTML = result[hariTahunMasihi].Hari.toUpperCase();
        
        var pecah_tarikh_hijrah = tarikh_hijrah.split("-");
        document.getElementById("tarikh-hijrah").innerHTML = pecah_tarikh_hijrah[0];
        document.getElementById("bulan-hijrah").innerHTML = pecah_tarikh_hijrah[1].toUpperCase();
        document.getElementById("tahun-hijrah").innerHTML = pecah_tarikh_hijrah[2];
        
        var pecah_tarikh_masihi = tarikh_masihi.split("-");   
        document.getElementById("tarikh-masihi").innerHTML = pecah_tarikh_masihi[0];
        document.getElementById("bulan-masihi").innerHTML = pecah_tarikh_masihi[1].toUpperCase();
        document.getElementById("tahun-masihi").innerHTML = pecah_tarikh_masihi[2];
    });
        
}

function timeTo12HrFormat(time,ampm){   // Take a time in 24 hour format and format it in 12 hour format
  var time_part_array = time.split(":");
  //var ampm = 'AM';
  //if (time_part_array[0] >= 12) {
  //  ampm = 'PM';
  //}

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

  if(ampm == "PM" && jam != "12") jam = parseInt(jam) + 12;
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


get_prayer_times();
startTime();
getUpdate();

</script>