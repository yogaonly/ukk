<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ukkyoga";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userID'])) {
    $userID = $_POST['userID'];
    $bukuID = $_POST['bukuID'];
    $TanggalPeminjaman = $_POST['TanggalPeminjaman'];
    $TanggalPengembalian = $_POST['TanggalPengembalian'];
    $StatusPeminjaman = $_POST['StatusPeminjaman'];

    $sql_check_user = "SELECT * FROM user WHERE userID = ?";
    $stmt_check_user = $conn->prepare($sql_check_user);
    $stmt_check_user->bind_param("i", $userID);
    $stmt_check_user->execute();
    $result_check_user = $stmt_check_user->get_result();
    
    if ($result_check_user->num_rows == 0) {
        echo "<script>alert('User ID tidak ditemukan!');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO peminjaman (userID, bukuID, TanggalPeminjaman, TanggalPengembalian, StatusPeminjaman) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $userID, $bukuID, $TanggalPeminjaman, $TanggalPengembalian, $StatusPeminjaman);
        if ($stmt->execute()) {
            echo "<script>alert('Peminjaman berhasil dicatat!');</script>";
        } else {
            echo "<script>alert('Gagal mencatat peminjaman!');</script>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Peminjaman Perpustakaan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }
        h2 { text-align: center; }
        form { margin-bottom: 20px; text-align: center; }
        input[type="text"], input[type="date"], select { padding: 8px; width: 30%; margin: 5px; }
        input[type="submit"], .back-button { padding: 8px 15px; background: #007bff; color: white; border: none; cursor: pointer; margin: 5px; }
        .back-button { background: #28a745; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    <h2>Jurnal Peminjaman Perpustakaan</h2>
    <form method="POST">
        <input type="text" name="userID" placeholder="User ID" required>
        <input type="text" name="bukuID" placeholder="Buku ID" required>
        <input type="date" name="TanggalPeminjaman" required>
        <input type="date" name="TanggalPengembalian" required>
        <select name="StatusPeminjaman" required>
            <option value="Dipinjam">Dipinjam</option>
            <option value="Dikembalikan">Dikembalikan</option>
        </select>
        <input type="submit" value="Catat Peminjaman">
        <a href="javascript:history.back()" class="back-button">Kembali</a>
    </form>
</body>
</html>

<?php $conn->close(); ?>
