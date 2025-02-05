<?php
include 'koneksi.php';

$result = $conn->query("SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background:#007bff;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100%;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background:#007bff;
        }


        .content {
            margin-left: 250px;
            flex: 1;
            padding: 20px;
        }


        .header {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            text-align: left;
        }

        th, td {
            padding: 10px;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100px;
                padding: 10px;
            }

            .sidebar h2 {
                font-size: 16px;
            }

            .sidebar a {
                font-size: 14px;
                padding: 8px;
            }

            .content {
                margin-left: 100px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Menu</h2>
        <a href="index_petugas.php">Beranda</a>
    </div>
    <div class="content"> 
        <div class="header">
          DAFTAR BUKU
        </div>
        <table>
            <td><a href="add.php">Tambah Buku</a></td>
        </table>
        <table>
            <tr>
                <th>id</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['judul']; ?></td>
                <td><?= $row['penulis']; ?></td>
                <td><?= $row['penerbit']; ?></td>
                <td><?= $row['tahunterbit']; ?></td>
                <td>
                    <a href="update.php?id=<?= intval($row['id']); ?>">Edit</a> |
                    <a href="delete.php?id=<?= intval($row['id']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

</body>
</html>
