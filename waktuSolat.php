<?php
//header('Content-Type: application/json');

$sql = "SELECT `lokasiID` FROM " . database_prefix ."_umum";
$result = mysqli_query($dbc, $sql);
if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
  $lokasi = $row['lokasiID'];
}

$content = file_get_contents("waktuSolat/".$tahun."/lokasi/" . $lokasi . ".json");
$kandungan = json_decode($content, true);

$datee = mktime(0,0,0);

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

$keluaran = ['lokasi' => $lokasi, 'date' => $date, 'imsak' => $imsak, 'subuh' => $subuh, 'syuruk' => $syuruk, 'zohor' => $zohor, 'asar' => $asar, 'maghrib' => $maghrib, 'isyak' => $isyak ];
// echo json_encode($keluaran);
