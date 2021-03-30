<?php
header('Content-Type: application/json');

if(isset($_GET['lokasi']))$lokasi = $_GET['lokasi'];
else $lokasi = 'PLS01';

if(isset($_GET['tahun']))$tahun = $_GET['tahun'];
else $tahun = '2018';

if(isset($_GET['bulan']))$bulan = $_GET['bulan'] + 1;
else $bulan = '1';

if(isset($_GET['hari']))$hari = $_GET['hari'] - 1;
else $hari = '0';

// read incoming info and grab the chatID
$content = file_get_contents("waktuSolat/".$tahun."/lokasi/" . $lokasi . ".json");
$kandungan = json_decode($content, true);

$keluaran = array();

$waktu_solat = $kandungan["$bulan"]["data"][$hari];


$date =  $waktu_solat["date"];
$imsak =  $waktu_solat["imsak"];
$subuh =  $waktu_solat["subuh"];
$syuruk =  $waktu_solat["syuruk"];
$zohor =  $waktu_solat["zohor"];
$asar =  $waktu_solat["asar"];
$maghrib =  $waktu_solat["maghrib"];
$isyak =  $waktu_solat["isyak"];

$keluaran = ['lokasi' => $lokasi, 'date' => $date, 'imsak' => $imsak, 'subuh' => $subuh, 'syuruk' => $syuruk, 'zohor' => $zohor, 'asar' => $asar, 'maghrib' => $maghrib, 'isyak' => $isyak ];
echo json_encode($keluaran);
