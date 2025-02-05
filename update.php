<?php
include 'koneksi.php';

$id = $_GET['id'] ?? null; 
if (!$id) {
    die("ID tidak ditemukan.");
}

$stmt = $conn->prepare("SELECT * FROM buku WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Data buku tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahunterbit = $_POST['tahunterbit'];

    $stmt = $conn->prepare("UPDATE buku SET judul=?, penulis=?, penerbit=?, tahunterbit=? WHERE id=?");
    $stmt->bind_param("sssii", $judul, $penulis, $penerbit, $tahunterbit, $id);

    if ($stmt->execute()) {
        header("Location: daftar_buku.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
</head>
<body>
    <h2>Edit Buku</h2>
    <form action="" method="POST">
        <label>Judul:</label><br>
        <input type="text" name="judul" value="<?= htmlspecialchars($row['judul']); ?>" required><br>
        <label>Penulis:</label><br>
        <input type="text" name="penulis" value="<?= htmlspecialchars($row['penulis']); ?>" required><br>
        <label>Penerbit:</label><br>
        <input type="text" name="penerbit" value="<?= htmlspecialchars($row['penerbit']); ?>" required><br>
        <label>Tahun Terbit:</label><br>
        <input type="date" name="tahunterbit" value="<?= htmlspecialchars($row['tahunterbit']); ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
    <a href="daftar_buku.php">Kembali</a>
</body>
</html>
