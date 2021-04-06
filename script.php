<?php 
$bil_video = $no_video - 1; 
require('waktuSolat.php');

?>
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
      
}

function get_prayer_times_json (){
    console.log('get prayer time json');

    document.getElementById('subuh').innerHTML = ("<?php echo($subuh) ?>").toUpperCase();;
    document.getElementById('imsak').innerHTML = ("<?php echo($imsak) ?>").toUpperCase();;
    document.getElementById('syuruk').innerHTML = ("<?php echo($syuruk) ?>").toUpperCase();;
    document.getElementById('zohor').innerHTML = ("<?php echo($zohor) ?>").toUpperCase();;
    document.getElementById('asar').innerHTML = ("<?php echo($asar) ?>").toUpperCase();;
    document.getElementById('maghrib').innerHTML = ("<?php echo($maghrib) ?>").toUpperCase();;
    document.getElementById('isyak').innerHTML = ("<?php echo($isyak) ?>").toUpperCase();;
}

function get_tarikh_oee(){
	var iMonthNames = new Array("Muharram","Safar","Rabiul Awal","Rabiul Akhir",
	"Jamadil Awal","Jamadil Akhir","Rejab","Syaban",
  "Ramadan","Syawal","Zulkaedah","Zhulhijjah");
  
  var wdNames = new Array("Ahad","Isnin","Selasa","Rabu","Khamis","Jumaat","Sabtu");

	
	var iDate = kuwaiticalendar(<?php echo $adjustment; ?>);
//	var outputIslamicDate = wdNames[iDate[4]] + ", " 
//	+ iDate[5] + " " + iMonthNames[iDate[6]] + " " + iDate[7] + " AH";
	var outputIslamicDate = iDate[5] + " " + iMonthNames[iDate[6]] + " " + iDate[7];
	//console.log(outputIslamicDate);

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
  
//    $.getJSON("waktuSolat/2019/hijrah.json", function(result){

        //var tarikh_masihi  = result[hariTahunMasihi].TarikhMiladi;
        //var tarikh_hijrah  = result[hariTahunHijrah].TarikhHijri;
        var tarikh_masihi  = formatDate(currentTime);
        //result[hariTahunMasihi].Hari.toUpperCase();

                
//        var pecah_tarikh_hijrah = tarikh_hijrah.split("-");
//        document.getElementById("tarikh-hijrah").innerHTML = pecah_tarikh_hijrah[0];
//        document.getElementById("bulan-hijrah").innerHTML = pecah_tarikh_hijrah[1].toUpperCase();
//        document.getElementById("tahun-hijrah").innerHTML = pecah_tarikh_hijrah[2];

        document.getElementById("tarikh-hijrah").innerHTML = iDate[5];
        document.getElementById("bulan-hijrah").innerHTML = iMonthNames[iDate[6]].toUpperCase();
        document.getElementById("tahun-hijrah").innerHTML = iDate[7];
       
        
        var pecah_tarikh_masihi = tarikh_masihi.split("-");   
        document.getElementById("hari-masihi").innerHTML = wdNames[currentTime.getDay()].toUpperCase();
		    document.getElementById("tarikh-masihi").innerHTML = pecah_tarikh_masihi[0];
        document.getElementById("bulan-masihi").innerHTML = pecah_tarikh_masihi[1].toUpperCase();
        document.getElementById("tahun-masihi").innerHTML = pecah_tarikh_masihi[2];
  //  });
        
}

function formatDate(date) {
  var monthNames = ["Januari", "Februari", "MarMac", "April", "Mei", "Jun", "Julai", "Ogos", "September", "Oktober", "November", "December"];
  
  var day = date.getDate();
  	if (day < 10) { day = "0" + day };
  var monthIndex = date.getMonth();
  var year = date.getFullYear();
    
	//pull the last two digits of the year
	year = year.toString();

  return day + '-' + monthNames[monthIndex] + '-' + year;
}

function get_tarikh(){
	var iMonthNames = new Array("Muharram","Safar","Rabiul Awal","Rabiul Akhir",
	"Jamadil Awal","Jamadil Akhir","Rejab","Syaban",
	"Ramadan","Syawal","Zulkaedah","Zhulhijjah");

	
	var iDate = kuwaiticalendar(<?php echo $adjustment; ?>);
//	var outputIslamicDate = wdNames[iDate[4]] + ", " 
//	+ iDate[5] + " " + iMonthNames[iDate[6]] + " " + iDate[7] + " AH";
	var outputIslamicDate = iDate[5] + " " + iMonthNames[iDate[6]] + " " + iDate[7];
	
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
        
//        var pecah_tarikh_hijrah = tarikh_hijrah.split("-");
//        document.getElementById("tarikh-hijrah").innerHTML = pecah_tarikh_hijrah[0];
//        document.getElementById("bulan-hijrah").innerHTML = pecah_tarikh_hijrah[1].toUpperCase();
//        document.getElementById("tahun-hijrah").innerHTML = pecah_tarikh_hijrah[2];

        document.getElementById("tarikh-hijrah").innerHTML = iDate[5];
        document.getElementById("bulan-hijrah").innerHTML = iMonthNames[iDate[6]].toUpperCase();
        document.getElementById("tahun-hijrah").innerHTML = iDate[7];		
		
        
        var pecah_tarikh_masihi = tarikh_masihi.split("-");   
        document.getElementById("tarikh-masihi").innerHTML = pecah_tarikh_masihi[0];
        document.getElementById("bulan-masihi").innerHTML = pecah_tarikh_masihi[1].toUpperCase();
        document.getElementById("tahun-masihi").innerHTML = pecah_tarikh_masihi[2];
    });
        
}
//Convert Hijri
//http://stackoverflow.com/questions/5177598/converting-gregorian-date-to-hijri-date
function gmod(n,m){
return ((n%m)+m)%m;
}

function kuwaiticalendar(adjust){
	var today = new Date();
	if(adjust) {
		adjustmili = 1000*60*60*24*adjust; 
		todaymili = today.getTime()+adjustmili;
		today = new Date(todaymili);
	}
	day = today.getDate();
	month = today.getMonth();
	year = today.getFullYear();
	m = month+1;
	y = year;
	if(m<3) {
		y -= 1;
		m += 12;
	}
	
	a = Math.floor(y/100.);
	b = 2-a+Math.floor(a/4.);
	if(y<1583) b = 0;
	if(y==1582) {
		if(m>10)  b = -10;
		if(m==10) {
			b = 0;
			if(day>4) b = -10;
		}
	}
	
	jd = Math.floor(365.25*(y+4716))+Math.floor(30.6001*(m+1))+day+b-1524;
	
	b = 0;
	if(jd>2299160){
		a = Math.floor((jd-1867216.25)/36524.25);
		b = 1+a-Math.floor(a/4.);
	}
	bb = jd+b+1524;
	cc = Math.floor((bb-122.1)/365.25);
	dd = Math.floor(365.25*cc);
	ee = Math.floor((bb-dd)/30.6001);
	day =(bb-dd)-Math.floor(30.6001*ee);
	month = ee-1;
	if(ee>13) {
		cc += 1;
		month = ee-13;
	}
	year = cc-4716;
	
	
	wd = gmod(jd+1,7)+1;
	
	iyear = 10631./30.;
	epochastro = 1948084;
	epochcivil = 1948085;
	
	shift1 = 8.01/60.;
	
	z = jd-epochastro;
	cyc = Math.floor(z/10631.);
	z = z-10631*cyc;
	j = Math.floor((z-shift1)/iyear);
	iy = 30*cyc+j;
	z = z-Math.floor(j*iyear+shift1);
	im = Math.floor((z+28.5001)/29.5);
	if(im==13) im = 12;
	id = z-Math.floor(29.5001*im-29);
	
	var myRes = new Array(8);
	
	myRes[0] = day; //calculated day (CE)
	myRes[1] = month-1; //calculated month (CE)
	myRes[2] = year; //calculated year (CE)
	myRes[3] = jd-1; //julian day number
	myRes[4] = wd-1; //weekday number
	myRes[5] = id; //islamic date
	myRes[6] = im-1; //islamic month
	myRes[7] = iy; //islamic year
	
	return myRes;
}

function writeIslamicDate(adjustment) {
	var wdNames = new Array("Ahad","Isnin","Selasa","Rabu","Khamis","Jumaat","Sabtu");
	var iMonthNames = new Array("Muharram","Safar","Rabiul Awal","Rabiul Akhir",
	"Jamadil Awal","Jamadil Akhir","Rejab","Syaban",
	"Ramadan","Syawal","Zulkaedah","Zhulhijjah");

	
	var iDate = kuwaiticalendar(adjustment);
//	var outputIslamicDate = wdNames[iDate[4]] + ", " 
//	+ iDate[5] + " " + iMonthNames[iDate[6]] + " " + iDate[7] + " AH";
	var outputIslamicDate = idate[0] + " " + iDate[5] + " " + iMonthNames[iDate[6]] + " " + iDate[7];
	
	return outputIslamicDate;
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

<?php
if (!empty($date)) { ?>
        get_prayer_times_json();
<?php } else { ?>
        get_prayer_times();
<?php } ?>

?>
get_tarikh_oee();
startTime();
getUpdate();

</script>
