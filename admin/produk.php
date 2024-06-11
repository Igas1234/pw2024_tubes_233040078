<?php
session_start();

// Periksa apakah pengguna sudah login. Jika belum, alihkan ke halaman login.
if (!isset($_SESSION['login']) || $_SESSION["login"] !== true) {
    header("Location: ../login.php");
    exit;
}

// Jika role kosong maka alihkan ke halaman user karena role user di dalam database nya kosong.
if (empty($_SESSION['role'])) {
    header("Location: ../user/index.php");
    exit;
}

if (empty($_SESSION['role'])) {
    header("Location: ../user/homeuser.php");
    exit;
}

include '../function/function.php';  // Sertakan file fungsi

// Ambil kategori dari parameter GET, jika tersedia
$category = $_GET["category"] ?? 'all';

// Bangun query untuk mengambil produk, dengan filter berdasarkan kategori jika disediakan
$query = "SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori";

if ($category != 'all') {
    $query .= " WHERE kategori.nama_kategori = '$category'";
}

// Eksekusi query dan simpan hasilnya dalam variabel $produk
$produk = query($query);

// Ambil semua kategori untuk ditampilkan sebagai opsi filter
$categories = query("SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="../style/produk.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../style/produk.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .minuman-categories {
            background-color: black;
            border-radius: 10px 10px 10px 10px;

        }

        .makanan-categories {
            background-color: black;
            border-radius: 10px 10px 10px 10px;

        }

        .custom-icon {
            font-size: 50px;
            /* Ubah ukuran ikon sesuai kebutuhan */
        }


        .footer {
            position: relative;
            display: flex;
            align-items: center;
            height: 10vh;
            justify-content: center;
            gap: 10px;
            z-index: 9;
            width: 100%;
            top: 400px;
        }

        .row1 {
            display: flex;
            justify-content: center;
            gap: 10px;

        }

        .img {
            margin-top: 10px;
            width: auto;
        }
    </style>

</head>

<body>
    <?php include '../layout/navbar.html' ?> <!-- Sertakan layout navbar -->

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="bg-dark" fill-opacity="1" d="M0,160L40,186.7C80,213,160,267,240,245.3C320,224,400,128,480,85.3C560,43,640,53,720,64C800,75,880,85,960,106.7C1040,128,1120,160,1200,165.3C1280,171,1360,149,1400,138.7L1440,128L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path>
    </svg>

    <div id="container">
        <div class="container mt-5">
            <!-- Tampilkan tombol filter kategori -->
            <div class="categories d-flex justify-content-center mb-3">
                <a href="?category=all" class="btn btn-dark m-2">Semua</a>
            </div>
            <div class="d-flex justify-content-center mb-3">

                <div class="makanan-categories me-3">
                    <i class="bi bi-cookie text-light custom-icon m-1"></i>
                    <?php foreach ($categories as $cat) : ?>
                        <?php if (strtolower($cat["nama_kategori"]) == "makanan") : ?>
                            <a href="?category=<?= $cat["nama_kategori"]; ?>" class="btn btn-success m-2"><?= $cat["nama_kategori"]; ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <div class="minuman-categories ms-3">
                    <i class="bi bi-cup-straw custom-icon  text-light"></i>
                    <?php foreach ($categories as $cat) : ?>
                        <?php if (strtolower($cat["nama_kategori"]) == "minuman") : ?>
                            <a href="?category=<?= $cat["nama_kategori"]; ?>" class="btn btn-light m-2"><?= $cat["nama_kategori"]; ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>


            <!-- Tampilkan daftar produk -->
            <div class="row d-flex justify-content-evenly mt-4" data-aos="flip-left">
                <h1 class="d-flex justify-content-center mb-3 text-warning">Daftar Menu</h1>
                <?php foreach ($produk as $row) : ?>

                    <div class="card h-100 mb-5 bg-dark   <?= strtolower($row['nama_kategori']); ?>" style="max-width: 350px; margin:auto; ">
                        <img class="img" height="250" src="img/<?= $row["img"]; ?>" width="50" class="card-img-top mt-2 w-100" alt="foto produk">
                        <div class="card-body">
                            <h4 class="text-warning"><?= $row["nama_kategori"] ?></h4>
                            <h5 class="card-title text-warning"><?= $row["nama_produk"]; ?></h5>
                            <p class="text-warning">Rp <?= $row["harga_produk"]; ?>.000</p>
                            <div class="d-flex flex-row">
                                <p><i class="bi bi-star-fill text-warning"></i></p>
                                <p><i class="bi bi-star-fill text-warning"></i></p>
                                <p><i class="bi bi-star-fill text-warning"></i></p>
                                <p><i class="bi bi-star-fill text-warning me-1"></i></p>
                                <i class="bi bi-emoji-laughing text-warning"></i>
                            </div>
                            <div class="d-flex col-9 justify-content-center">
                                <a href="hapusproduk.php?id=<?= $row["id_produk"]; ?>" onclick="return confirm('Apakah yakin menghapus data?');" class="badge text-bg-danger text-decoration-none mx-5">Hapus</a>
                                <a href="ubahproduk.php?id=<?= $row["id_produk"] ?>" class="badge text-bg-warning text-decoration-none">Ubah</a>
                            </div>
                        </div>
                    </div>

                <?php endforeach ?>
            </div>
        </div>
    </div>



    <div class="footer bg-dark">
        <h4 class="text-light">Design Fabregas</h4>
        <div class="row1">
            <i class="bi bi-cup-hot text-light "></i>
            <i class="bi bi-instagram text-light"></i>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="../js/script.js"></script>
</body>

</html>