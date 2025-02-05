<?php

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "ukkyoga"; 


$conn = new mysqli($servername, $username_db, $password_db, $dbname);


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
