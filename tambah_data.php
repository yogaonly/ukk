<?php
include 'config.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama          = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $kelas         = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $query = "INSERT INTO anggota (`nama`, `jenis_kelamin`, `kelas`, `tempat_lahir`, `alamat`) 
              VALUES ('$nama', '$jenis_kelamin', '$kelas', '$tanggal_lahir', '$alamat')";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: index_petugas.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Form Tambah Anggota</h1>
    <form method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin:</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas:</label>
            <select name="kelas" id="kelas" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                <option value="X">X</option>
                <option value="XI">XI</option>
                <option value="XII">XII</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tanggal Lahir:</label>
            <input type="date" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat:</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
