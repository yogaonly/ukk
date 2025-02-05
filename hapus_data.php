<?php
include 'config.php';
$id = $_GET['id'];

$query = "DELETE FROM anggota WHERE id='$id'";
mysqli_query($koneksi, $query);

header("Location: index_petugas.php");
?>
