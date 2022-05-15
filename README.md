# Masjid
Paparan info masjid.

Forcked from https://denshie.com/

 sudo wget https://raw.githubusercontent.com/lamlieabdullah/Masjid/install.sh
 sudo chmod +x install.sh
 ./install.sh

login to Phpmyadmin and create database masjid
import db from create_databse_masjid.sql


30/9/21
- [x]  Time offset (pahang insya +4min)
    - [x]  kena check balik waktusolat.php
    - [x]  remove +4min kalau json
    - [x]  Check kalau calculate

- [x]  Grab waktu solat Jakim — json
    - [x]  grab from jakim
    - [x]  save into .json
    - [x]  put on kemaskini.php
- [x]  check latest date from json, put on screen
