<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ukkyoga";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$denda_per_hari = 1000;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['peminjamID'])) {
    $peminjamID = $_POST['peminjamID'];
    
    $sql = "SELECT TanggalPengembalian FROM peminjaman WHERE userID = ? AND StatusPeminjaman = 'Dipinjam'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $peminjamID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tanggal_pengembalian = $row['TanggalPengembalian'];
        $hari_terlambat = max(0, (strtotime(date('Y-m-d')) - strtotime($tanggal_pengembalian)) / (60 * 60 * 24));
        $total_denda = $hari_terlambat * $denda_per_hari;

        if ($total_denda > 0) {
            $stmt_update = $conn->prepare("UPDATE peminjaman SET StatusPeminjaman = 'Dikembalikan' WHERE peminjamID = ?");
            $stmt_update->bind_param("i", $peminjamID);
            $stmt_update->execute();
            echo "<script>alert('Denda sebesar Rp$total_denda telah dibayarkan. Buku telah dikembalikan.');</script>";
        } else {
            echo "<script>alert('Tidak ada denda. Buku telah dikembalikan tepat waktu.');</script>";
        }
    } else {
        echo "<script>alert('ID peminjaman tidak ditemukan atau buku sudah dikembalikan.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Denda</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }
        h2 { text-align: center; }
        form { text-align: center; margin-bottom: 20px; }
        input[type="text"] { padding: 8px; width: 30%; margin: 5px; }
        input[type="submit"] { padding: 8px 15px; background: #dc3545; color: white; border: none; cursor: pointer; }
        .back-button { padding: 8px 15px; background: #28a745; color: white; border: none; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    <h2>Pembayaran Denda Peminjaman</h2>
    <form method="POST">
        <input type="text" name="userID" placeholder="Masukkan ID Peminjaman" required>
        <input type="submit" value="Bayar Denda">
        <a href="javascript:history.back()" class="back-button">Kembali</a>
    </form>
</body>
</html>

<?php $conn->close(); ?>