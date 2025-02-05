<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM buku WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: daftar_buku.php?message=success");
        exit();
    } else {
        $stmt->close();
        $conn->close();
        header("Location: daftar_buku.php?message=error");
        exit();
    }
} else {
    header("Location: daftar_buku.php?message=invalid");
    exit();
}
?>
