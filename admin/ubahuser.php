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

$id = $_GET['id'];

// Query untuk mendapatkan detail user berdasarkan ID
$query = "SELECT * FROM user WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah password baru diberikan
    if (!empty($password)) {
        // Hash password baru sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_query = "UPDATE user SET username = '$username', password = '$hashed_password' WHERE id = $id";
    } else {
        $update_query = "UPDATE user SET username = '$username' WHERE id = $id";
    }

    if (mysqli_query($koneksi, $update_query)) {
        header("Location: cekuser.php");
        exit;
    } else {
        echo "Error: " . $update_query . "<br>" . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include '../layout/navbar.html'; ?>
    <div class="container mt-5">
        <h2>Ubah User</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Nama</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password (Biarkan kosong jika tidak ingin mengubah)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Ubah</button>
            <a href="cekuser.php"><button type="submit" class="btn btn-primary">kembali</button></a>
        </form>
    </div>
</body>

</html>