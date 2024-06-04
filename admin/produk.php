<?php
session_start();



if (!isset($_SESSION['login']) || $_SESSION["login"] !== true) {
    header("Location: ../login.php");
    exit;
}

include '../connect/conn.php';
include '../function/function.php';

$kategori = query("SELECT nama_kategori FROM kategori");


//mengambil data dari tabel
$produk = query("SELECT * FROM produk");

//  tombol cari di tekan
if (isset($_POST["cari"])) {
    $produk = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/produk.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../style/produk.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .card-opacity {
            position: relative;
            overflow: hidden;
        }

        .card-opacity::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.8);
            /* Atur opacity di sini */
            z-index: 1;
        }

        .card-opacity>* {
            position: relative;
            z-index: 2;
        }
    </style>

</head>

<body>
    <?php include '../layout/navbar.html' ?>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="bg-dark" fill-opacity="1" d="M0,160L40,186.7C80,213,160,267,240,245.3C320,224,400,128,480,85.3C560,43,640,53,720,64C800,75,880,85,960,106.7C1040,128,1120,160,1200,165.3C1280,171,1360,149,1400,138.7L1440,128L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path>
    </svg>

    <svg class="blobmaker" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path class="bg-dark" d="M39.4,-64.3C47.1,-56.3,46.8,-38.8,53.9,-24.3C60.9,-9.9,75.3,1.5,79.6,15.5C83.9,29.5,78.2,46.2,66,53.4C53.8,60.6,35.1,58.3,19.7,59.4C4.2,60.4,-8,64.8,-19.9,63.3C-31.7,61.8,-43.1,54.5,-53.6,45C-64.1,35.5,-73.7,23.7,-72.9,12.1C-72.2,0.4,-61,-11.2,-54.7,-24.9C-48.3,-38.6,-46.7,-54.5,-38.4,-62.2C-30.1,-70,-15.1,-69.7,0.4,-70.2C15.8,-70.8,31.6,-72.3,39.4,-64.3Z" transform="translate(100 100)" />
    </svg>

    <svg class="blobmaker1" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path class="bg-dark " d="M39.4,-64.3C47.1,-56.3,46.8,-38.8,53.9,-24.3C60.9,-9.9,75.3,1.5,79.6,15.5C83.9,29.5,78.2,46.2,66,53.4C53.8,60.6,35.1,58.3,19.7,59.4C4.2,60.4,-8,64.8,-19.9,63.3C-31.7,61.8,-43.1,54.5,-53.6,45C-64.1,35.5,-73.7,23.7,-72.9,12.1C-72.2,0.4,-61,-11.2,-54.7,-24.9C-48.3,-38.6,-46.7,-54.5,-38.4,-62.2C-30.1,-70,-15.1,-69.7,0.4,-70.2C15.8,-70.8,31.6,-72.3,39.4,-64.3Z" transform="translate(100 100)" />
    </svg>

    <svg class="blobmaker2" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path class="bg-dark" d="M39.4,-64.3C47.1,-56.3,46.8,-38.8,53.9,-24.3C60.9,-9.9,75.3,1.5,79.6,15.5C83.9,29.5,78.2,46.2,66,53.4C53.8,60.6,35.1,58.3,19.7,59.4C4.2,60.4,-8,64.8,-19.9,63.3C-31.7,61.8,-43.1,54.5,-53.6,45C-64.1,35.5,-73.7,23.7,-72.9,12.1C-72.2,0.4,-61,-11.2,-54.7,-24.9C-48.3,-38.6,-46.7,-54.5,-38.4,-62.2C-30.1,-70,-15.1,-69.7,0.4,-70.2C15.8,-70.8,31.6,-72.3,39.4,-64.3Z" transform="translate(100 100)" />
    </svg>

    <div class="container mt-5">
        <div class="row d-flex justify-content-evenly" data-aos="flip-left">
            <h1 class="d-flex justify-content-center mb-3 text-warning">Daftar menu</h1>
            <?php foreach ($produk as $row) : ?>
                <div class="card  mb-5 bg-dark" style="width: 18rem;">
                    <img src="img/<?= $row["img"]; ?>" width="50" class="card-img-top mt-2" alt="foto produk">
                    <div class="card-body">
                        <h5 class="card-title text-warning"><?= $row["nama_produk"]; ?></h5>
                        <p class="text-warning">Rp <?= $row["harga_produk"]; ?></p>
                        <p class="card-text text-warning"><?= $row["deskripsi"]; ?></p>
                        <div class="d-flex flex-row">
                            <p><i class="bi bi-star-fill text-warning"></i></p>
                            <p><i class="bi bi-star-fill text-warning"></i></p>
                            <p><i class="bi bi-star-fill text-warning"></i></p>
                            <p><i class="bi bi-star-fill text-warning me-1"></i></p>
                            <i class="bi bi-emoji-laughing text-warning"></i>
                        </div>
                        <a href="hapusproduk.php?id=<?= $row["id_produk"]; ?>" onclick="return confirm('apakah yakin menghapus data');" class="badge text-bg-danger text-decoration-none mx-5">Hapus</a>
                        <a href="ubahproduk.php?id=<?= $row["id_produk"] ?>" class="badge text-bg-warning text-decoration-none">Ubah</a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>


</html>