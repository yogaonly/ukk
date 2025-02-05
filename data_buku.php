<?php
session_start();
include 'koneksi.php'; 

$query = "SELECT * FROM buku";
$result_buku = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        #sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 50px;
        }
        #sidebar a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            font-size: 18px;
        }
        #sidebar a:hover {
            background-color: #575d63;
        }
        .header {
            position: fixed;
            top: 0;
            left: 250px;
            width: calc(100% - 250px);
            background-color: #343a40;
            color: white;
            padding: 15px;
            z-index: 1000;
        }
        .header h1 {
            margin: 0;
        }
        .content {
            margin-left: 250px;
            padding-top: 70px;
        }
        /* Buku Card */
        .buku-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            padding: 20px;
        }
        .buku-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 250px;
            text-align: center;
        }
        .buku-card h5 {
            font-size: 18px;
            font-weight: bold;
            color: #343a40;
        }
        .buku-card p {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>

    <div id="sidebar">
        <a href="dashboard_admin.php">Home</a>
        <a href="data_anggota.php">Anggota</a>
    </div>

    <div class="header">
        <h1>Data Buku</h1>
    </div>

    <div class="content">
        <div class="container">
            <h2 class="text-center mt-3"> </h2>

            <div class="buku-container">
                <?php while ($row = mysqli_fetch_assoc($result_buku)) { ?>
                    <div class="buku-card">
                        <h5><?php echo $row['judul']; ?></h5>
                        <p>Penulis: <?php echo $row['penulis']; ?></p>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>

</body>
</html>
