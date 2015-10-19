#!/bin/bash
echo "Solowiz VM Enterprise Edition Installer 1.0 beta"
sleep 2
echo "###########################################"
echo "###########################################"
echo "################           ################"
echo "################  Solowiz  ################"
echo "################           ################"
echo "################  OpenVZ   ################"
echo "################           ################"
echo "###########################################"
echo "###########################################"
echo ""
echo ""
echo ""
sleep 1
echo "This installer will change your kernel, if you want to quit installation please press ctrl + c"
echo "wait 5 seconds"
sleep 5
echo "PLEASE NOTE THAT THIS WILL REMOVE EXISTING SOLOWIZ INSTALLATION"
echo "Wait 5 seconds"
sleep 5
echo "OK, start"
sleep 2

echo "Installing prerequisite"
yum -y install gcc gcc-c++ autoconf automake

sleep 1
echo "Install openSSL"
sleep 1
echo "................................"
yum -y install openssl

echo "Install mysql/php and apache"
sleep 1
echo "................................"

yum -y install httpd mysql-server php php-mysql php-gd

chkconfig httpd on
chkconfig mysqld on
chkconfig iptables off
service iptables stop
service httpd restart
service mysqld restart

echo "Install required devel Packages"
sleep 1
echo "................................"
yum -y install php-devel openssl-devel

echo "Install Libssh2"
sleep 1
echo "................................"
cd /var/www/html
rm -Rf solowiz.zip
rm -Rf *

yum -y install zip unzip
wget --cache=off http://wasiflaeeq.com/solowiz/solowiz.zip
unzip solowiz.zip
chmod -R 0777 /var/www/logos
chmod -R 0777 /var/www/ostmp
cd /var/www/html/install-data
tar -xzvf libssh2-1.2.8.tar.gz
cd libssh2-1.2.8
./configure && make all install


sleep 2


cd /var/www/html/install-data
gunzip -xzvf ssh2-0.11.3.tgz
tar -xvf ssh2*
cd ssh2*
phpize && ./configure
make
make install



sleep 2
cd /var/www/html/install-data

cp openvz.repo /etc/yum.repos.d/openvz.repo
rpm --import  RPM-GPG-Key-OpenVZ




yum -y install ovzkernel vzkernel
yum -y install vzctl vzquota



cd /vz/template/cache/
#wget http://192.168.1.101/ubuntu-11.04-x86.tar.gz



echo "Creating database for Solowiz"
mysqladmin -uroot create solowiz
echo "Importing database Structure and default data"
cd /var/www/html
mysql -uroot solowiz < /var/www/html/solowiz.sql


echo "Starting openVZ"
/sbin/service vz start



echo "Installing Configuration Files"

sleep 3

cd /var/www/html/confs
rm -f /etc/php.ini

cp php.ini /etc/php.ini

rm -f /etc/sysctl.conf
cp sysctl.conf /etc/sysctl.conf
service httpd restart
echo "System will restart in 20 seconds, Please press ctrl + c if you don't want to restart it now"
sleep 20
shutdown -r now