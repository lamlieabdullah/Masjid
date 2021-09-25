<?php
require('config/config.inc.php');
require(MYSQL);

//start process
fetchAllZones('2021');

function fetchAllZones($year) {
        $db = new Mysql(DB_NAME,DB_HOST,DB_USER,DB_PASS);
        $rs = $db->db_assoc("SELECT DISTINCT zone FROM kawasan");
        while(list(, $rw) = @each($rs)) {
                $zone = strtoupper($rw['zone']);
                fetchAnnually($zone, $year);
        }
}

function curlContent($url, $year) {
        $handle = curl_init();
        $postfields = array("datestart" => "$year-01-01", "dateend" => "$year-12-31");
	print_r($postfields);
        
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_HTTPHEADER, ['Content-Type: multipart/form-data;']);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $postfields);

        $output = curl_exec($handle);
        curl_close($handle);
	// echo $output;
	return $output;
}

function fetchAnnually($zone, $year) {
        $url = 'https://www.e-solat.gov.my/index.php?r=esolatApi/takwimsolat&period=duration&zone=' . $zone;
        echo $url . "\n";
        // $html = file_get_contents($url);
	$html = curlContent($url, $year);
        $array = json_decode($html);

        $days = [
                'Monday' => 1,
                'Tuesday' => 2,
                'Wednesday' => 3,
                'Thursday' => 4,
                'Friday' => 5,
                'Saturday' => 6,
                'Sunday' => 7
        ];

        $mnths = [
                'Jan' => 1,
                'Feb' => 2,
                'Mac' => 3,
                'Apr' => 4,
                'Mei' => 5,
                'Jun' => 6,
                'Jul' => 7,
                'Ogos' => 8,
                'Sep' => 9,
                'Okt' => 10,
                'Nov' => 11,
                'Dis' => 12
        ];

        foreach ($array->prayerTime as $pt) {
                $date = explode('-', $pt->date);
                $d = $date[0];
                $m = $mnths[$date[1]];
                $y = $date[2];
                $obj = [
                        'zone' => $zone,
                        'day' => $d,
                        'month' => $m,
                        'year' => $y,
                        'hari' => $days[$pt->day],
                        'imsak' => dateToTimestamp($d, $m, $y, $pt->imsak),
                        'subuh' => dateToTimestamp($d, $m, $y, $pt->fajr),
                        'syuruk' => dateToTimestamp($d, $m, $y, $pt->syuruk),
                        'zohor' => dateToTimestamp($d, $m, $y, $pt->dhuhr),
                        'asar' => dateToTimestamp($d, $m, $y, $pt->asr),
                        'maghrib' => dateToTimestamp($d, $m, $y, $pt->maghrib),
                        'isyak' => dateToTimestamp($d, $m, $y, $pt->isha),
                ];
                $obj = json_decode(json_encode($obj));
                insertIntoDb($obj);
        }
}

function dateToTimestamp($D, $M, $Y, $prayer) {
        $ex = explode(':', $prayer);
        $h = $ex[0];
        $m = $ex[1];
        return mktime($h, $m, 0, $M, $D, $Y);
}

function insertIntoDb($obj) {
        $db = new Mysql(DB_NAME,DB_HOST,DB_USER,DB_PASS);
        echo "Inserting waktu solat for zone:$obj->zone, date:$obj->day-$obj->month-$obj->year";
        $db->db_insert("INSERT INTO waktu_solat SET
                zone='".$obj->zone."',
                day='".$obj->day."',
                month='".$obj->month."',
                year='".$obj->year."',
                hari='".$obj->hari."',
                imsak='".$obj->imsak."',
                subuh='".$obj->subuh."',
                syuruk='".$obj->syuruk."',
                zohor='".$obj->zohor."',
                asar='".$obj->asar."',
                maghrib='".$obj->maghrib."',
                isyak='".$obj->isyak."',
                created=NOW(),
                updated=NOW()
        ");
        echo " -- done.\n";
}

?>
