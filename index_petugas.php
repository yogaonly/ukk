<?php
include 'config.php'; 

if (!$koneksi) {
    die("Variabel \$koneksi tidak terdefinisi atau null. Periksa file koneksi.php");
}

$query = "SELECT * FROM anggota";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Error pada query: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Anggota</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color:rgb(113, 176, 196);
    }

    .navbar {
      margin-bottom: 30px;
    }

    .sidebar {
      background-color:rgb(20, 14, 14);
    }

    .table {
      background-color: white;
      border-radius: 10px;
    }

    th, td {
      text-align: center;
    }

    th {
      background-color:rgb(164, 195, 228);
      color: white;
    }

    td {
      background-color:rgb(157, 195, 233);
    }

    tr:nth-child(even) td {
      background-color:rgb(255, 255, 255);
    }

    tr:hover td {
      background-color:rgb(255, 255, 255);
    }

    .btn {
      margin: 0 5px;
    }

    .container-fluid {
      margin-top: 30px;
    }

    .btn-success {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"></a>
  </div>
</nav>

<div class="container-fluid mt-3">
  <div class="row">
    <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar p-3">
      <ul class="nav flex-column">
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index_petugas.php">Data anggota</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="daftar_buku.php">Data buku</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="laporan_petugas.php">laporan</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="login.php">logout</a>
      </li>
      </ul>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <h2 class="mb-3">Data Anggota</h2>
      <a href="tambah_data.php" class="btn btn-success mb-2">Tambah Anggota</a>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Kelas</th>
            <th>Tempat Lahir</th>
            <th>Alamat</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            $jenis_kelamin = ($row['jenis_kelamin'] == 'L') ? 'Laki-laki' : (($row['jenis_kelamin'] == 'P') ? 'Perempuan' : 'Tidak Diketahui');
            $kelas_options = ['X', 'XI', 'XII'];
              $kelas = in_array($row['kelas'], $kelas_options) ? $row['kelas'] : 'Tidak Diketahui';

              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['id']) . "</td>";
              echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
              echo "<td>" . htmlspecialchars($jenis_kelamin) . "</td>";
              echo "<td>" . htmlspecialchars($kelas) . "</td>";
              echo "<td>" . htmlspecialchars($row['tempat_lahir']) . "</td>";
              echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
              echo "<td>
                      <a href='edit.php?id=" . urlencode($row['id']) . "' class='btn btn-primary btn-sm'>Edit</a>
                      <a href='hapus_data.php?id=" . urlencode($row['id']) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                    </td>";
              echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
