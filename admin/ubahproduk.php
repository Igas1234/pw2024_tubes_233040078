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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/tambahproduk.css">
</head>

<body>
    <?php include '../layout/navbar.html' ?>

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Ubah Makanan</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $produk['id_produk'] ?>">
                    <input type="hidden" name="gambarlama" value="<?= $produk['img'] ?>">

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <li>
                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="kategori">
                                <?php foreach ($kategori as $ktg) : ?>
                                    <option value="<?= $ktg["nama_kategori"] ?>"><?= $ktg["nama_kategori"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </li>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Masukan Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $produk['nama_produk']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" value="<?= $produk['harga_produk']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $produk['deskripsi']; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="img" class="form-label">Gambar</label>
                        <div class="mb-2">
                            <img src="img/<?= $produk['img']; ?>" alt="Gambar Produk" class="img-thumbnail" width="150">
                        </div>
                        <input class="form-control" type="file" id="img" name="img">
                    </div>

                    <button type="submit" class="btn btn-primary w-100" name="submit">Ubah</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>