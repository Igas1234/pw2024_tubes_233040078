<?php
session_start();

// Periksa apakah pengguna sudah login. Jika belum, alihkan ke halaman login.
if (!isset($_SESSION['login']) || $_SESSION["login"] !== true) {
    header("Location: ../login.php");
    exit;
}

include '../function/function.php';  // Sertakan file fungsi

// Ambil ID produk dari parameter GET
$id_produk = $_GET['id'] ?? null;

// Periksa apakah ID produk valid
if ($id_produk === null || !is_numeric($id_produk)) {
    // Jika tidak valid, alihkan ke halaman error atau halaman lain yang sesuai
    header("Location: error.php");
    exit;
}

// Query untuk mengambil detail produk berdasarkan ID
$query = "SELECT * FROM produk WHERE id_produk = $id_produk";
$detail_produk = query($query);

// Periksa apakah produk dengan ID yang diberikan ditemukan
if (!$detail_produk) {
    // Jika tidak ditemukan, alihkan ke halaman error atau halaman lain yang sesuai
    header("Location: error.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahkan gaya khusus di sini jika diperlukan */
        .container {
            display: flex;
            flex-wrap: wrap;
            border: 3px solid black;
            margin-top: 30px;
            border-radius: 20px;
            padding: 10px;
        }

        .product-image {
            width: 60%;
            height: 60%;
            border: 5px solid black;
            position: relative;
            top: 100px;
            left: 100px;
        }

        .row {
            padding: 20px;
        }

        .product-details {
            margin-top: 20px;
        }



        .product-details {
            margin-top: 80px;
            border: 5px solid black;
            border-radius: 10px;
            padding: 5px;
        }

        .gambar {
            display: inline;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Tampilkan detail produk -->
        <div class="row">
            <div class=" gambar col-md-6">
                <!-- Tampilkan gambar produk -->
                <img src="../admin/img/<?= $detail_produk[0]['img']; ?>" class="product-image" alt="<?= $detail_produk[0]['nama_produk']; ?>">
            </div>
            <br>

            <div class="col-md-6">
                <!-- Tampilkan detail produk -->
                <div class="product-details">
                    <h2><?= $detail_produk[0]['nama_produk']; ?></h2>
                    <p>Harga: Rp <?= $detail_produk[0]['harga_produk']; ?>.000.000</p>
                    <p>Deskripsi: <?= $detail_produk[0]['deskripsi']; ?></p>
                </div>
            </div>
        </div>

        <!-- Tambahkan tombol atau link kembali ke halaman sebelumnya -->
        <a href="javascript:history.back()" class="btn btn-primary mt-3">Kembali</a>
    </div>
</body>

</html>