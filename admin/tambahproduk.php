<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION["login"] !== true) {
    header("Location: ../login.php");
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
    <title>Document</title>
    <link rel="stylesheet" href="../style/tambahproduk.css">
</head>

<body>
    <?php include '../layout/navbar.html' ?>

    <h1>tambah makanan</h1>
    <div class="container1 d-flex justify-content-center">
        <div class="row1 ">
            <form action="" method="post" enctype="multipart/form-data">
                <ul>
                    <li>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="kategori">
                            <?php foreach ($kategori as $ktg) : ?>
                                <option selected value="<?= $ktg["nama_kategori"] ?>"><?= $ktg["nama_kategori"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <li>
                        <label for="floatingInput">masukan nama</label>
                        <input type="text" class="form-control " id="floatingInput" name="nama">
                    </li>
                    <li>
                        <label for="floatingInput">harga</label>
                        <input type="text" class="form-control " id="floatingInput" name="harga">

                    </li>
                    <li>
                        <label for="floatingInput">deskripsi</label>
                        <input type="text" class="form-control " id="floatingInput" name="deskripsi">

                    </li>
                    <li>
                        <label class="label" for="img">Gambar</label>
                        <input class="input" type="file" name="img" id="img" required>
                    </li>
                    <li>
                        <button type="submit" name="submit">Tambah</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    </div>
</body>

</html>