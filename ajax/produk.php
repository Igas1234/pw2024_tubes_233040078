<?php
session_start();
require '../function/function.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE 
    nama_produk LIKE '%$keyword%'";
$produk = query($query);

?>
<div class="row d-flex justify-content-evenly" data-aos="flip-left">
    <h1 class="d-flex justify-content-center mb-3 text-warning">Daftar menu</h1>

    <?php foreach ($produk as $row) : ?>

        <div class="card  mb-5 bg-dark mt-5" style="width: 18rem;">
            <img src="img/<?= $row["img"]; ?>" width="50" class="card-img-top mt-2" alt="foto produk">
            <div class="card-body">
                <h4 class=" text-warning"><?= $row["nama_kategori"] ?></h4>
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
                <?php
                if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin") {
                    // Role is admin
                    echo '<a href="ubahproduk.php?id=' . $row["id_produk"] . '" class="badge text-bg-warning text-decoration-none">Ubah</a>';
                    echo '<a href="hapusproduk.php?id=' . $row["id_produk"] . '" onclick="return confirm(\'apakah yakin menghapus data\');" class="badge text-bg-danger text-decoration-none mx-5">Hapus</a>';
                } else {
                    // Role is not set or not admin
                    echo '<a href="#" class="btn bg-success">Beli</a>';
                }
                ?>

            </div>
        </div>

    <?php endforeach ?>
</div>
</div>