#! /bin/sh
ssid=$(/sbin/iwgetid --raw)
if [ -z "$ssid" ]
then
    echo "Wifi is down, reconnecting..."
    /sbin/ifconfig wlan0 down
    sleep 5
    sudo wpa_cli -i wlan0 reconfigure
    /sbin/ifconfig wlan0 up
fi
echo "wifi-check done"
