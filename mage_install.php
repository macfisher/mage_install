<?php

// clone Magento 1.7 mirror
system("sudo -u root git clone https://github.com/amacgregor/magento-1.7.0.2.git /var/www/public/install");

// set permissions
system("sudo -u root chown -R www-data:www-data /var/www/public/install/");
system("sudo -u root chmod -R 755 /var/www/public/install/var/");
system("sudo -u root chmod -R 755 /var/www/public/install/media/");
system("sudo -u root chmod -R 755 /var/www/public/install/app/etc/");

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
    echo "Database created successfully\n";
} else {
    echo "\nError creating database: " . $conn->error . "\n";
}

system("sudo -u root mv /var/www/public/install/* ..");
system("sudo -u root rm -r /var/www/public/install");
system("sudo -u root rm -r /var/www/public/mage_install");


//Replace in file app/code/core/Mage/Install/etc/config.xml (near 71th string) this 
/*
<extensions>
    <pdo_mysql/>
</extensions>

with this 

<extensions>
    <pdo_mysql>1</pdo_mysql>
</extensions>
*/