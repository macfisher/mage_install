<?php

// clone Magento 1.7 mirror
system("sudo -u root git clone https://github.com/amacgregor/magento-1.7.0.2.git /var/www/public/install");

// set permissions
system("sudo -u root chown -R www-data:www-data install/");
system("sudo -u root chmod -R 755 install/var/");
system("sudo -u root chmod -R 755 install/media/");
system("sudo -u root chmod -R 755 install/app/etc/");

$servername = "localhost";
$username = "root";
$password = "root";

// Create connection to MySQL
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database
$sql = "CREATE DATABASE magento";
if ($conn->query($sql) === TRUE) {
    echo "\nDatabase created successfully";
} else {
    echo "\nError creating database: " . $conn->error;
}

system("sudo -u root cd /var/www/public");
system("sudo -u root rm -r /var/www/public/mage_install");