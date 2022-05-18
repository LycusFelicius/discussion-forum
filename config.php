<?php

$db_host = "localhost";
$db_user = "id18794961_root";
$db_pass = "dJzeU5u1q?gE|kbm";
$db_name = "id18794961_forum";
/* Attempt to connect to MySQL database */
$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

try {    
    //create PDO connection 
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}