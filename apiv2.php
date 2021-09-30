<?php

/*
	Forked from https://github.com/afzafri/Waktu-Solat-API/blob/master/apiv2.php

	Waktu Solat API v2 created by Afif Zafri
	XML data are fetch directly from JAKIM e-solat website
	This new version will be able to fetch prayer time data for the whole Year or by each month for chosen Zone

*/

require('config/config.inc.php');
$title = "Kemaskini";
include('admin/template/header.php');

require(MYSQL);

$sql = "SELECT `lokasiID` FROM " . database_prefix ."_umum";
$result = mysqli_query($dbc, $sql);
if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
  $zone =  $row['lokasiID'];
}

	$tahun = $_POST['pilih_tahun'];

	$arrData = fetchPage($zone,$tahun);

	# print JSON data
	//echo header('Content-Type: application/json');
	$json_pretty = json_encode(json_decode(json_encode($arrData)), JSON_PRETTY_PRINT);
	//echo $json_pretty;

	//Write to file
	$waktusolat = json_decode($json_pretty, true);
		
	if ($waktusolat['status'] == 'OK!'){
		$dir = 'waktuSolat/'. $tahun;
		if( is_dir($dir) === false )
		{
			mkdir($dir);
			chmod($dir, 0777);
			mkdir($dir . '/lokasi/');
			chmod($dir . '/lokasi/', 0777);

		}

		$fileName = 'waktuSolat/'. $tahun . '/lokasi/' . $zone . '.json';
		//$fp = fopen($fileName, 'w');
		//fwrite($fp, $json_pretty);
		//fclose($fp);
		file_put_contents($fileName, $json_pretty);
		
		chmod($fileName, 0777);
		echo "Done. ";
		echo "Zone: " . $zone;
		echo "Tahun: " . $tahun;
	} else {
		echo "NO_RECORD!";
	}

# function for fetching the webpage and parse data
function fetchPage($kodzon,$tahun)
{
	$url = "https://www.e-solat.gov.my/index.php?r=esolatApi/takwimsolat&period=duration&zone=".$kodzon;

		# data for POST request
		$dates = getDurationDate(1, $tahun);
    $postdata = http_build_query(
        array(
            'datestart' => $dates['start'],
            'dateend' => $dates['end'],
        )
    );

    # cURL also have more options and customizable
    $ch = curl_init(); # initialize curl object
    curl_setopt($ch, CURLOPT_URL, $url); # set url
    curl_setopt($ch, CURLOPT_POST, 1); # set option for POST data
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); # set post data array
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); # receive server response
    $result = curl_exec($ch); # execute curl, fetch webpage content
    $httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE); # receive http response status
    curl_close($ch);  # close curl

    $arrData = array();
	//$arrData['Data'] = array();
    $arrData['zone'] = $kodzon;
	$arrData['start'] = $dates['start'];
	$arrData['end'] = $dates['end'];

	$waktusolat = json_decode($result, true);
		
	if ($waktusolat['status'] == 'OK!'){
		$arrData['status'] = "OK!";
		if(count($waktusolat['prayerTime']) > 0) {
			foreach ($waktusolat['prayerTime'] as $waktu) {
				$arrData['prayer_times'][] = array(
					'date' => date("d-m-Y", myStrtotime($waktu['date'])),
					'datestamp' => mktime(0,0,0,date("m", myStrtotime($waktu['date'])),date("d", myStrtotime($waktu['date'])),date("Y", myStrtotime($waktu['date']))),
					'imsak' => convertTime($waktu['imsak']),
					'subuh' => convertTime($waktu['fajr']),
					'syuruk' => convertTime($waktu['syuruk']),
					'zohor' => convertTime($waktu['dhuhr']),
					'asar' => convertTime($waktu['asr']),
					'maghrib' => convertTime($waktu['maghrib']),
					'isyak' => convertTime($waktu['isha']),
				);
			}
		}
	
	} else {
		$arrData['status'] = "NO_RECORD!";
	}
	return $arrData; # return array data	
}

function myStrtotime($date_string)
{
	 $convertDate = array('jan'=>'jan','feb'=>'feb','mac'=>'march','apr'=>'apr','mei'=>'may','jun'=>'jun','jul'=>'jul','ogos'=>'aug','sep'=>'sep','okt'=>'oct','nov'=>'nov','dis'=> 'dec');
	 return strtotime(strtr(strtolower($date_string), $convertDate));
}

function getDurationDate($month, $year)
{
	$month = str_pad($month,2,'0',STR_PAD_LEFT);
	$startdate = $year.'-'.$month.'-'.'01';
	$enddate = $year.'-'.'12'.'-'.date("t", strtotime(date("F", mktime(0, 0, 0, 12, 10))));

	return array(
		'start' => $startdate,
		'end' => $enddate
	);
}

// Function to convert the time
function convertTime($time)
{
    // replace separator
    $time = str_replace(".", ":", $time);
    // convert 24h to 12h
    $newtime = date('h:i', strtotime($time));
    // include a.m. or p.m. prefix
    $newtime .= explode(':', $time)[0] <= 12 ? ' a.m.' : ' p.m.';

    return $newtime;
}
include('admin/template/footer.php');
?>
