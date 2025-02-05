<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ukkyoga";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM peminjaman WHERE userID = $delete_id";  
    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='laporan_petugas.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$sql = "SELECT * FROM peminjaman";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; display: flex; }
        .sidebar { width: 250px; background: #007bff; color: white; padding: 20px; height: 100vh; position: fixed; }
        .sidebar h2 { text-align: center; }
        .sidebar ul { list-style: none; padding: 0; }
        .sidebar ul li { padding: 10px; }
        .sidebar ul li a { color: white; text-decoration: none; display: block; }
        .sidebar ul li a:hover { background: #0056b3; }
        .content { margin-left: 270px; padding: 20px; width: calc(100% - 270px); }
        header { background: #007bff; color: white; padding: 15px; text-align: center; font-size: 20px; }
        table { width: 100%; border-collapse: collapse; background: #fff; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #007bff; color: white; }
        .btn-delete { color: red; cursor: pointer; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="index_petugas.php">Beranda</a></li>
        </ul>
    </div>
    
    <div class="content">
        <header>Daftar Peminjaman</header>
        <table>
            <tr>
                <th>User ID</th>
                <th>Buku ID</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Peminjaman</th>
                <th>Aksi</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['userID']) ?></td>
                <td><?= htmlspecialchars($row['bukuID']) ?></td>
                <td><?= htmlspecialchars($row['TanggalPeminjaman']) ?></td>
                <td><?= htmlspecialchars($row['TanggalPengembalian']) ?></td>
                <td><?= htmlspecialchars($row['StatusPeminjaman']) ?></td>
                <td><a href="?delete_id=<?= $row['userID'] ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>
