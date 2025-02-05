
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ogaaperpus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(255, 255, 255);
            margin: 0;
            padding: 0;
        }
        .header {
            background-color:rgb(80, 166, 247);
            color: white;
            padding: 20px;
            text-align: center;
        }
        .menu, .popular-books {
            background-color:rgb(0, 0, 0);
            color: white;
            padding: 16px;
            width: 20%;
            float: left;
            min-height: 500px;
        }
        .content {
            width: 60%;
            float: left;
            padding: 20px;
            text-align: center;
            background-color: white;
            min-height: 400px;
        }
        .menu a, .popular-books a {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
        }
        .menu a:hover, .popular-books a:hover {
            background-color: #1abc9c;
        }
        .book img {
            width: 200px;
        }
        .clearfix {
            clear: both;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Perpustakaan Digital</h1>
    </div>
    
    <div class="menu">
        <h3>MENU</h3>
        <a href="pinjam.php">pinjam</a>
        <a href="login.php">logout</a>
    </div>
    
    <div class="content">
        <h2>Buku Terbaru</h2>
        <h3>Buku: Aku Kamu Dan Kenangan Waktu itu</h3>
        <div class="book">
            <img src="op.jpg" alt="restu - Aku selalu ada untukmu">
        </div>
    </div>

    <div class="clearfix"></div>
</body>
</html>
