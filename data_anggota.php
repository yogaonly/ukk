<?php
session_start();
include 'koneksi.php'; 

$search = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM anggota WHERE nama LIKE '%$search%'";
} else {
    $query = "SELECT * FROM anggota";
}

$result_anggota = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #343a40;
            color: white;
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
        .search-box {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div id="sidebar">
        <a href="dashboard_admin.php">Home</a>
        <a href="data_buku.php">Buku</a>
    </div>

    <div class="header">
        <h1>Data Anggota</h1>
    </div>

    <div class="content">
        <div class="container">
            <h2 class="text-center"> </h2>

            <form method="GET" action="" class="form-inline search-box">
                <input type="text" name="search" class="form-control mr-2" placeholder="Cari Nama..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="data_anggota.php" class="btn btn-secondary ml-2">Reset</a>
            </form>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Kelas</th>
                        <th>Tempat Lahir</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result_anggota) > 0) { ?>
                        <?php while ($row = mysqli_fetch_assoc($result_anggota)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['jenis_kelamin']; ?></td>
                            <td><?php echo $row['kelas']; ?></td>
                            <td><?php echo $row['tempat_lahir']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                        </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6" class="text-center text-danger">Data tidak ditemukan!</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
