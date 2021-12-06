
#!/bin/bash
################################################################################
#-------------------------------------------------------------------------------
# Download file
# sudo wget https://raw.githubusercontent.com/lamlieabdullah/Masjid/main/update.sh 
# Place this content in it and then make the file executable:
# sudo chmod +x update.sh
# Execute the script to install:
# ./update
################################################################################

cd /var/www/html/masjid
sudo wget https://raw.githubusercontent.com/lamlieabdullah/Masjid/main/script.php
sudo wget https://raw.githubusercontent.com/lamlieabdullah/Masjid/main/kemaskini1-2.php
sudo wget https://raw.githubusercontent.com/lamlieabdullah/Masjid/main/grabjakim.php
