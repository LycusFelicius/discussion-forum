<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "discussion_forum";
/* Attempt to connect to MySQL database */
$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

try {    
    //create PDO connection 
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}
