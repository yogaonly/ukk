<?php
session_start();
include 'koneksi.php'; 
$result_buku = mysqli_query($conn, "SELECT COUNT(*) AS total FROM buku");
$row_buku = mysqli_fetch_assoc($result_buku);
$total_buku = $row_buku['total'];

$result_anggota = mysqli_query($conn, "SELECT COUNT(*) AS total FROM anggota");
$row_anggota = mysqli_fetch_assoc($result_anggota);
$total_anggota = $row_anggota['total'];

$check_column = mysqli_query($conn, "SHOW COLUMNS FROM peminjaman LIKE 'status'");
if (mysqli_num_rows($check_column) > 0) {
    $result_peminjaman = mysqli_query($conn, "SELECT COUNT(*) AS total FROM peminjaman WHERE status = 'dipinjam'");
    $row_peminjaman = mysqli_fetch_assoc($result_peminjaman);
    $total_peminjaman = $row_peminjaman['total'];
} else {
    $total_peminjaman = 0;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            background-color: #343a40;
            padding-top: 20px;
            color: white;
        }
        .sidebar a {
            padding: 10px;
            display: block;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .card {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">ADMINISTRATOR</h4>
        <a href="data_anggota.php">User</a>
        <a href="laporan_admin.php">Laporan</a>
        <a href="login.php">Logout</a>
    </div>
    <div class="content">
        <h2></h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <h5>Data buku</h5>
                    <p><?php echo $total_buku; ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark">
                    <h5>Data anggota</h5>
                    <p><?php echo $total_anggota; ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <h5>Buku yang dipinjam</h5>
                    <p><?php echo $total_peminjaman; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>