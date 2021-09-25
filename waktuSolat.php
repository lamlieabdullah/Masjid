<?php
//header('Content-Type: application/json');

if(isset($_GET['lokasi']))$lokasi = $_GET['lokasi'];
else $lokasi = 'PHG03';

if(isset($_GET['tahun']))$tahun = $_GET['tahun'];
else $tahun = '2021';

if(isset($_GET['bulan']))$bulan = $_GET['bulan'] + 1;
else $bulan = '5';

if(isset($_GET['hari']))$hari = $_GET['hari'] - 1;
else $hari = '17';

// read incoming info and grab the chatID
$content = file_get_contents("waktuSolat/".$tahun."/lokasi/" . $lokasi . ".json");
$kandungan = json_decode($content, true);

//$keluaran = array();

$datee = mktime(0,0,0);
//echo $datee->getTimestamp();
//echo date($datee);

$key = array_search($datee, array_column($kandungan["prayer_times"],"datestamp"));

$waktu_solat = $kandungan["prayer_times"][$key];

$date =  $waktu_solat["date"];
$imsak =  $waktu_solat["imsak"];
$subuh =  $waktu_solat["subuh"];
$syuruk =  $waktu_solat["syuruk"];
$zohor =  $waktu_solat["zohor"];
$asar =  $waktu_solat["asar"];
$maghrib =  $waktu_solat["maghrib"];
$isyak =  $waktu_solat["isyak"];
$isyak = date('g:i a', strtotime($isyak)+240); //+ 4 minutes for pahang

//$keluaran = ['lokasi' => $lokasi, 'date' => $date, 'imsak' => $imsak, 'subuh' => $subuh, 'syuruk' => $syuruk, 'zohor' => $zohor, 'asar' => $asar, 'maghrib' => $maghrib, 'isyak' => $isyak ];
//echo json_encode($keluaran);
