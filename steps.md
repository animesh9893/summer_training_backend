
## Steps for Creating this project

Referance --- https://www.hostinger.in/tutorials/how-to-install-laravel-on-ubuntu-18-04-with-apache-and-php/


after creating project

1. We have to give some permission to run project.

-> sudo chgrp -R www-data /var/www/project/
-> sudo chmod -R 775 /var/www/project/storage

2. Connecting Laravel project with Apache2 server so we need to write configurations.

-> cd /etc/apache2/sites-available
-> sudo nano project.conf

---- Inside project.conf

<VirtualHost *:80>
   ServerName project
   ServerAdmin webmaster@localhost
   DocumentRoot /var/www/project/public

   <Directory /var/www/project>
       AllowOverride All
   </Directory>
   ErrorLog ${APACHE_LOG_DIR}/error.log
   CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

-------------------------------

3. Disable default config file

-> sudo a2dissite 000-default.conf
-> sudo a2ensite project


4. Restart Server

-> sudo a2enmod rewrite 
-> sudo apache2 start

----- Server Done



