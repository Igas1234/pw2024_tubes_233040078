<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION["login"] !== true) {
    header("Location: ../login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .icon {
            font-size: 80px;
        }

        .layanan {
            display: flex;
        }

        .maps {
            width: 500px;
            height: 300px;
            margin-left: 10%;
        }

        .body {
            margin: 10px 0 20px 20px;
            border-radius: 100px;
            box-shadow: 2px 2px 10px 5px black;
        }

        .maps1 {
            background-color: white;
            width: 500px;
            height: 200px;
            margin: 20px 20px 20px 20px;
            border-radius: 10px;
            border: 2px solid black;
        }
    </style>
</head>

<body>
    <?php require 'navbaruser.html'; ?>

    <h1 class="d-flex justify-content-center mt-2">selamat datang <i class="bi bi-emoji-laughing-fill text-warning ms-3"></i></h1>
    <div class="container ">
        <h1 class="d-flex justify-content-center  mt-2">layanan</h1>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card">
                    <i class="bi bi-basket2 icon d-flex justify-content-center"></i>
                    <div class="card-body">
                        <h5 class="card-title  d-flex justify-content-center">Layanan katering</h5>
                        <p class="card-text  d-flex justify-content-center">
                            Paket Katering: Informasi tentang berbagai paket katering untuk acara pernikahan, pesta, pertemuan bisnis, dan lainnya.
                            <br>
                            Konsultasi Katering: Opsi untuk konsultasi katering secara gratis atau berbayar.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <i class="bi bi-basket2 icon d-flex justify-content-center"></i>
                    <div class="card-body">
                        <h5 class="card-title  d-flex justify-content-center">Takeaway</h5>
                        <p class="card-text  d-flex justify-content-center">
                            Pesan Ambil (Takeaway)
                            Pesan Online, Ambil di Toko: Pelanggan bisa memesan makanan secara online dan mengambilnya di lokasi fisik restoran.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <i class="bi bi-basket2 icon d-flex justify-content-center"></i>
                    <div class="card-body ">
                        <h5 class="card-title  d-flex justify-content-center">Pembayaran Online</h5>
                        <p class="card-text  d-flex justify-content-center">
                            Berbagai Metode Pembayaran: Opsi pembayaran yang beragam, termasuk kartu kredit, e-wallet, dan transfer bank.
                            <br>
                            Pembayaran Aman: Sistem pembayaran yang aman dan terenkripsi.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <i class="bi bi-basket2 icon d-flex justify-content-center"></i>
                    <div class="card-body">
                        <h5 class="card-title  d-flex justify-content-center">Delivery</h5>
                        <p class="card-text  d-flex justify-content-center">
                            Pengiriman Cepat: Opsi untuk pengiriman makanan dalam waktu singkat.
                            <br>
                            Pelacakan Pesanan: Fitur untuk melacak status dan lokasi pesanan secara real-time.

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card-group mt-5 ">
        <div class="body card">
            <div class="card-body">
                <h5 class="card-title d-flex justify-content-center">maps</h5>
                <iframe class="maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.971321228161!2d107.53917667356498!3d-6.894033767460679!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e5b3cd6d2469%3A0x2977069d83e67ca6!2sMYMO%20MIE%20BASO%20CEKER%20DAN%20JUICE!5e0!3m2!1sid!2sid!4v1718003747686!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <div class="maps1">
            <div class="maps2 p-4 mt-5">
                <i class="bi bi-telephone-fill">+62 0120182018</i>
                <br>
                <a href="https://maps.app.goo.gl/XaicxCN5r1iQyHku9" class="text-dark text-decoration-none "><i class="bi bi-geo-alt text-dark "></i>JL.HMS mintareja sarjana hukum Gang Harjo N0.55b,baros,kec cimahi tengah</a>
                <p></p>
                <p></p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>