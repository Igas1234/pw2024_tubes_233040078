<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION["login"] !== true) {
    header("Location: ../login.php");
    exit;
}

include '../function/function.php';
$kategori = query("SELECT nama_kategori FROM kategori");

// Check if id is set in the URL
if (!isset($_GET["id"])) {
    echo "<script>
    alert('ID not set in URL');
    document.location.href= 'produk.php';  
    </script>";
    exit;
}

$id = $_GET["id"];

// Query data produk berdasarkan id nya
$produk = query("SELECT * FROM produk WHERE id_produk = $id")[0];

if (!$produk) {
    echo "<script>
    alert('Product not found');
    document.location.href= 'produk.php';  
    </script>";
    exit;
}

// Check if the submit button has been pressed
if (isset($_POST["submit"])) {
    // Add the id_produk to the $_POST array
    $_POST['id'] = $id;

    // Check if data was successfully updated
    if (ubahproduk($_POST) > 0) {
        echo "<script>
        alert('Data berhasil diubah');
        document.location.href= 'produk.php';  
        </script>";
    } else {
        echo "<script>
        alert('Data gagal diubah');
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
    <title>Ubah Produk</title>
    <link rel="stylesheet" href="../style/tambahproduk.css">
</head>
<style>
    * {
        list-style: none;

    }

    .form-control {
        width: 10000px;
    }
</style>

<body>
    <?php include '../layout/navbar.html' ?>

    <h1>Ubah Makanan</h1>
    <div class="container1 d-flex justify-content-center">
        <div class="row1">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $produk["id_produk"] ?>">
                <input type="hidden" name="gambarlama" value="<?= $produk["img"] ?>">
                <ul>
                    <li>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="kategori">
                            <?php foreach ($kategori as $ktg) : ?>
                                <option value="<?= $ktg["nama_kategori"] ?>"><?= $ktg["nama_kategori"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <li>
                        <label for="floatingInput">Masukan Nama</label>
                        <input type="text" class="form-control w-100" id="floatingInput" name="nama" value="<?= $produk["nama_produk"]; ?>">
                    </li>
                    <li>
                        <label for="floatingInput">Harga</label>
                        <input type="text" class="form-control w-100" id="floatingInput" name="harga" value="<?= $produk["harga_produk"]; ?>">
                    </li>
                    <li>
                        <label for="floatingInput">Deskripsi</label>
                        <input type="text" class="form-control w-100" id="floatingInput" name="deskripsi" value="<?= $produk["deskripsi"]; ?>">
                    </li>
                    <li>
                        <label class="label" for="img">Gambar</label>
                        <img src="img/<?= $produk["img"]; ?>" alt="">
                        <input class="input " type="file" name="img" id="img">
                    </li>
                    <li>
                        <button type="submit" name="submit">Ubah</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</body>

</html>