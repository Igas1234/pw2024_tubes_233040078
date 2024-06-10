<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION["login"] !== true) {
    header("Location: ../login.php");
    exit;
}

if (empty($_SESSION['role'])) {
    header("Location: ../user/index.php");
    exit;
}

require '../function/function.php';
$kategori = query("SELECT nama_kategori FROM kategori");

if (isset($_POST['submit'])) {
    if (tambahproduk($_POST) > 0) {
        echo " 
        <script>
alert ('data berhasil di tambahkan');
document.location.href= 'produk.php';  
        </script>
        ";
    } else {
        echo "<script>
        alert ('data gagal di tambahkan');
        document.location.href= 'produk.php';  
                </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container1 {
            margin-top: 50px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include '../layout/navbar.html'; ?>

    <div class="container1 container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg ">
                    <div class="card-header bg-dark text-white">
                        <h3 class="card-title mb-0">Tambah Makanan</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori" name="kategori">
                                    <?php foreach ($kategori as $ktg) : ?>
                                        <option value="<?= $ktg["nama_kategori"] ?>"><?= $ktg["nama_kategori"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Masukkan Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="img" class="form-label">Gambar</label>
                                <input class="form-control" type="file" id="img" name="img" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary bg-dark">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>