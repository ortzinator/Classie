#!/usr/bin/env bash

sudo vhost -s classie.local -d /vagrant/public
sudo service apache2 reload
sudo apt-get install nano

echo ">>> Creating Classie database"
mysql -u root -proot -e "create database if not exists classie;"
mysql -u root -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '' WITH GRANT OPTION; FLUSH PRIVILEGES;"

chmod -R o+w /vagrant/app/storage