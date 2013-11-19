#!/usr/bin/env bash

echo ">>> Starting Install Script"

# Update
sudo apt-get update

# Install MySQL without prompt
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

echo ">>> Installing Base Items"

# Install base items
sudo apt-get install -y curl wget build-essential python-software-properties nano

echo ">>> Adding PPA's and Installing Server Items"

# Add repo for latest PHP
sudo add-apt-repository -y ppa:ondrej/php5

# Update Again
sudo apt-get update

# Install the Rest
sudo apt-get install -y git-core php5 apache2 libapache2-mod-php5 php5-mysql php5-curl php5-gd php5-mcrypt php5-xdebug mysql-server

echo ">>> Configuring Server"

# xdebug Config
cat << EOF | sudo tee -a /etc/php5/mods-available/xdebug.ini
xdebug.scream=1
xdebug.cli_color=1
xdebug.show_local_vars=1
EOF

# Apache Config
sudo a2enmod rewrite

rm -rf /var/www
ln -fs /vagrant/public /var/www

sudo echo "ServerName localhost" > /etc/apache2/httpd.conf
# Setup hosts file
VHOST=$(cat <<EOF
<VirtualHost *:80>
  DocumentRoot "/var/www"
  ServerName localhost
  <Directory "/var/www">
    AllowOverride All
  </Directory>
</VirtualHost>
EOF
)
sudo echo "${VHOST}" > /etc/apache2/sites-enabled/000-default.conf

# PHP Config
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini


sudo service apache2 restart

# Git Config
# curl https://gist.github.com/fideloper/3751524/raw/e576c7b38587d6ab73f47ba901c359496069fc77/.gitconfig > /home/vagrant/.gitconfig

echo ">>> Installing Composer"

# Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

echo "PATH=/vagrant/vendor/bin:\$PATH" >> ~/.bash_profile
echo "alias art='php artisan'" >> ~/.bash_profile

echo ">>> Creating Classie database"
mysql -u root -proot -e "create database if not exists classie;"

chmod -R o+w /vagrant/app/storage

sudo sed -i "s/;date.timezone =/date.timezone = Europe\/London/" /etc/php5/apache2/php.ini
sudo sed -i "s/;date.timezone =/date.timezone = Europe\/London/" /etc/php5/cli/php.ini