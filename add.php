<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = trim($_POST['judul']);
    $penulis = trim($_POST['penulis']);
    $penerbit = trim($_POST['penerbit']);
    $tahunterbit = trim($_POST['tahunterbit']);

    if (empty($judul) || empty($penulis) || empty($penerbit) || empty($tahunterbit)) {
        echo "<p>Semua kolom harus diisi!</p>";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO `buku` (`judul`, `penulis`, `penerbit`, `tahunterbit`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $judul, $penulis, $penerbit, $tahunterbit);

    if ($stmt->execute()) {
        header("Location: daftar_buku.php");
        exit();
    } else {
        echo "<p>Terjadi kesalahan: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f7f7f7;
        }
        .content {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            border-radius: 8px;
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="date"] {
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            text-align: center;
            display: block;
            margin-top: 10px;
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="content">
        <h2>Tambah Buku</h2>
        <form action="" method="POST">
            <label for="judul">Judul:</label>
            <input type="text" name="judul" id="judul" required>

            <label for="penulis">Penulis:</label>
            <input type="text" name="penulis" id="penulis" required>

            <label for="penerbit">Penerbit:</label>
            <input type="text" name="penerbit" id="penerbit" required>

            <label for="tahunterbit">Tahun Terbit:</label>
            <input type="date" name="tahunterbit" id="tahunterbit" required min="1000-01-01" max="9999-12-31">

            <button type="submit">Simpan</button>
        </form>
        <a href="daftar_buku.php">Kembali</a>
    </div>
</body>
</html>
