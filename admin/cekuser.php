<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION["login"] !== true) {
    header("Location: ../login.php");
    exit;
}
include '../function/function.php';
// query untuk mengambil data dari tabel
$query = "SELECT * FROM user";
$result = mysqli_query($koneksi, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include '../layout/navbar.html' ?>
    <table class="table">
        <thead>
            <?php $i = 1; ?>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nama</th>
                <th scope="col">password</th>
                <th scope="col">aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <th scope="col"><?= $i; ?></th>
                    <th><?= $row["username"]; ?></th>
                    <td><?= $row["password"]; ?></td>
                    <td>
                        <a href="ubahuser.php?id=<?= $row["id"]; ?>" class="badge text-bg-warning text-decoration-none">ubah</a>
                        <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('apakah yakin menghapus data');" class="badge text-bg-danger text-decoration-none">Hapus</a>
                    </td>

                </tr>
        </tbody>
        <?php $i++; ?>
    <?php endwhile ?>
    </table>
</body>

</html>