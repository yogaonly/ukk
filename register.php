<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $nama_lengkap = trim($_POST["nama_lengkap"]);
    $alamat = trim($_POST["alamat"]);
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];
    $role = $_POST["role"];

    if ($password !== $password_confirm) {
        echo "<script>alert('Password tidak cocok!'); window.history.back();</script>";
        exit();
    }

    $plain_password = $password; 

    $stmt = $conn->prepare("SELECT ukkyoga FROM user WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username atau email sudah terdaftar!'); window.history.back();</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO user (username, email, namalengkap, alamat, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Error pada prepare statement INSERT: " . $conn->error);
        }

        $stmt->bind_param("ssssss", $username, $email, $nama_lengkap, $alamat, $plain_password, $role);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Pendaftaran berhasil! Silakan login.');
                    window.location.href='login.php';
                  </script>";
            exit();
        } else {
            echo "<script>alert('Terjadi kesalahan saat mendaftar!'); window.history.back();</script>";
        }
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h1 {
            color: #333;
            font-size: 24px;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            text-align: left;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .logo {
            width: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <img src="logoi.jpg" alt="Logo" class="logo">
    <h1>Halaman Register</h1>

    <form method="POST" action="register.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="nama_lengkap">Nama Lengkap:</label>
        <input type="text" name="nama_lengkap" id="nama_lengkap" required>

        <label for="alamat">Alamat:</label>
        <textarea name="alamat" id="alamat" required></textarea>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <label for="password_confirm">Konfirmasi Password:</label>
        <input type="password" name="password_confirm" id="password_confirm" required>

        <label for="role">Daftar Sebagai:</label>
        <select name="role" id="role" required>
            <option value="Administrator">Administrator</option>
            <option value="Petugas">Petugas</option>
            <option value="Peminjam">Peminjam</option>
        </select>

        <input type="submit" value="Register">
    </form>

    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</div>

</body>
</html>
