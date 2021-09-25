<?php
require('../config/config.inc.php');

require(MYSQL);

//kill omxplayer. sebagai persediaan kalau-kalau omxplayer sedang play.
exec("sudo killall omxplayer & killall omxplayer.bin");

exec("sudo omxplayer -o hdmi /var/www/html/masjid/audio/beepbeep.mp3");

exit;
