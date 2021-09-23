<?php
DEFINE ('DB_USER', 'root'); //pinda dengan mengisi dengan maklumat yang sesuai
DEFINE ('DB_PASSWORD', 'password'); //pinda dengan mengisi dengan maklumat yang sesuai
DEFINE ('DB_HOST', 'localhost'); //pinda dengan mengisi dengan maklumat yang sesuai
DEFINE ('DB_NAME', 'db_masjid'); //pinda dengan mengisi dengan maklumat yang sesuai

/*=============== jangan pinda di bawah bahagian ini sekiranya anda tidak tahu apa yang anda lakukan=========================*/
// sambungan ke database
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

mysqli_set_charset($dbc, 'utf8');

function escape_data($data, $dbc){
if(get_magic_quotes_gpc()) $data = stripslashes($data);
return mysqli_real_escape_string($dbc, trim($data));
}

