<?php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ogaaperpus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color:rgb(98, 170, 241);
        }
        .sidebar {
            background-color:rgb(0, 0, 0);
            height: 100vh;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
        }
        .sidebar a:hover {
            background-color:rgb(169, 199, 230);
        }
        .book-card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar">
                <h4></h4>
                <a href="index.php">Home</a>
                <a href="daftar_buku.php">buku</a>
                <hr>
            </nav>
            
            <main class="col-md-10 p-4">
                <header class="mb-4 text-center">
                    <h2>Perpustakaan Digital</h2>
                </header>
                <div class="row">
                    <?php
                    $books = [
                        ["title" => "kancil,   kerbau dan buaya", "author" => "Akhila", "cover" => "kncl.jpg"],
                        ["title" => "upin ipin", "author" => "Ismail", "cover" => "th.jpg"],
                    ];
                    
                    foreach ($books as $book) {
                        echo "<div class='col-md-3'>
                                <div class='card book-card mb-4'>
                                    <img src='{$book['cover']}' class='card-img-top' alt='Cover'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>{$book['title']}</h5>
                                        <p class='card-text'>{$book['author']}</p>
                                    </div>
                                </div>
                              </div>";
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>
</body>
</html>