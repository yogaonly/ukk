<?php
include 'config.php';  

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak ditemukan");
}

$id = $_GET['id'];

$query = "SELECT * FROM anggota WHERE id='$id'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Data anggota tidak ditemukan");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $updateQuery = "UPDATE anggota SET 
                    nama='$nama', 
                    jenis_kelamin='$jenis_kelamin', 
                    kelas='$kelas', 
                    tempat_lahir='$tempat_lahir', 
                    alamat='$alamat' 
                    WHERE id='$id'";

    if (mysqli_query($koneksi, $updateQuery)) {
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
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h1>Edit Data Anggota</h1>

    <form method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?= htmlspecialchars($row['nama']); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin:</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                <option value="L" <?= ($row['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="P" <?= ($row['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas:</label>
            <select name="kelas" id="kelas" class="form-select" required>
                <option value="X" <?= ($row['kelas'] == 'X') ? 'selected' : ''; ?>>X</option>
                <option value="XI" <?= ($row['kelas'] == 'XI') ? 'selected' : ''; ?>>XI</option>
                <option value="XII" <?= ($row['kelas'] == 'XII') ? 'selected' : ''; ?>>XII</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tenggal Lahir:</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?= htmlspecialchars($row['tempat_lahir']); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat:</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3" required><?= htmlspecialchars($row['alamat']); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
