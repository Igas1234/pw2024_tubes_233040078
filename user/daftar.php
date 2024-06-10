<?php
session_start();

// Periksa apakah pengguna sudah login. Jika belum, alihkan ke halaman login.
if (!isset($_SESSION['login']) || $_SESSION["login"] !== true) {
    header("Location: ../login.php");
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
    <link rel="stylesheet" href="./style/produk.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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



        .svg {
            position: absolute;
            z-index: -9999999;
        }

        @media only screen and (max-width:600px) {
            .menu {
                top: 130px;
                left: 50px;
            }
        }
    </style>
</head>

<body>

    <?php require '../user/navbaruser.html'; ?>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="svg">
        <path fill="bg-dark" fill-opacity="1" d="M0,160L40,186.7C80,213,160,267,240,245.3C320,224,400,128,480,85.3C560,43,640,53,720,64C800,75,880,85,960,106.7C1040,128,1120,160,1200,165.3C1280,171,1360,149,1400,138.7L1440,128L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path>
    </svg>

    <div id="container">
        <div class="container ">
            <!-- Tampilkan tombol filter kategori -->
            <div class="categories d-flex justify-content-center mb-3">
                <a href="?category=all" class="btn btn-dark m-2">Semua</a>
            </div>
            <div class="d-flex justify-content-center mb-3 menu">

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
            <div class="row d-flex justify-content-evenly" data-aos="flip-left">
                <h1 class="d-flex justify-content-center mb-3 text-warning">Daftar Menu</h1>
                <?php foreach ($produk as $row) :
                    $imagePath = "../admin/img/" . $row["img"];
                ?>
                    <div class="card mb-5 bg-dark <?= strtolower($row['nama_kategori']); ?>" style="width: 18rem;">
                        <?php if (file_exists($imagePath)) : ?>
                            <img src="<?= $imagePath ?>" width="50" class="card-img-top mt-2" alt="foto produk">
                        <?php else : ?>
                            <img src="https://via.placeholder.com/150" width="50" class="card-img-top mt-2" alt="Foto tidak ditemukan">
                            <p class="text-warning text-center">Foto tidak ditemukan</p>
                        <?php endif; ?>
                        <div class="card-body">
                            <h4 class="text-warning"><?= $row["nama_kategori"] ?></h4>
                            <h5 class="card-title text-warning"><?= $row["nama_produk"]; ?></h5>
                            <p class="text-warning">Rp <?= $row["harga_produk"]; ?>.000.000</p>
                            <p class="card-text text-warning"><?= $row["deskripsi"]; ?></p>
                            <div class="d-flex flex-row">
                                <p><i class="bi bi-star-fill text-warning"></i></p>
                                <p><i class="bi bi-star-fill text-warning"></i></p>
                                <p><i class="bi bi-star-fill text-warning"></i></p>
                                <p><i class="bi bi-star-fill text-warning me-1"></i></p>
                                <i class="bi bi-emoji-laughing text-warning"></i>
                            </div>
                            <a href="" class="btn bg-success">beli</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>


    <footer class="bg-body-tertiary text-center bg-dark mt-5">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: Social media -->
            <section class="mb-4 ">
                <!-- Facebook -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #f61c5d;" href="#!" role="button"><i class="bi bi-instagram"></i></a>

                <!-- Twitter -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #55acee;" href="#!" role="button"><i class="bi bi-facebook"></i></a>

                <!-- Google -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #1ace83;" href="#!" role="button"><i class="bi bi-whatsapp"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3 text-light" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-light text-decoration-none" href="https://mdbootstrap.com/">Muhammad Fabregas garda samudra</a>
        </div>
        <!-- Copyright -->
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>