
#!/bin/bash
################################################################################
#-------------------------------------------------------------------------------
# Make a new file:
# sudo nano install.sh
# Place this content in it and then make the file executable:
# sudo chmod +x install.sh
# Execute the script to install Odoo:
# ./install
################################################################################

#LAMP
#https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mariadb-php-lamp-stack-debian9
sudo apt update
sudo apt install apache2 -y
sudo apt install mariadb-server -y
sudo apt install php libapache2-mod-php php-mysql -y
sudo systemctl restart apache2

#PHPmyadmin
sudo apt install phpmyadmin php-mbstring php-zip php-gd php-json php-curl -y

sudo apt install git -y
cd /var/www/html
sudo git clone https://github.com/lamlieabdullah/masjid
sudo chmod -R a+rw /var/www/html/masjid/images/





