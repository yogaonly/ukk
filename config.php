<?php
$host   = "localhost";
$user   = "root";                 
$pass   = "";                      
$dbname = "ukkyoga";     

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
