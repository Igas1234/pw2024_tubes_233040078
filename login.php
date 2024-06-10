<?php
session_start();
// if (isset($_SESSION["login"])) {
//     header("location: index.php");
//     exit;
//}



require './function/function.php'; // Sertakan file fungsi yang diperlukan

if (isset($_POST["login"])) { // Periksa apakah form login telah dikirim
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result =  mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) { // Jika ada pengguna dengan username yang cocok

        //cek password
        $row = mysqli_fetch_assoc($result); // Ambil data pengguna dari database
        if (password_verify($password, $row["password"])) { // Jika password cocok dengan hash yang disimpan di database

            //set session
            $_SESSION['login'] = true; // Tetapkan session login ke true
            $_SESSION['role'] = $row['role'];

            // Periksa peran pengguna untuk menentukan halaman tujuan setelah login
            if ($row['role'] === 'admin') { // Jika pengguna adalah admin
                header("location: admin/produk.php"); // Alihkan ke halaman admin
            } else { // Jika pengguna adalah pengguna biasa
                header("location: user/index.php"); // Alihkan ke halaman pengguna biasa
            }
            exit; // Keluar dari skrip setelah mengalihkan pengguna
        }
    }

    $error = true; // Jika username atau password tidak cocok, set error ke true
}





?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/login.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <form action="" method="post">
                <h1 class="d-flex justify-content-center">Login </h1>
                <?php if (isset($error)) : ?>
                    <p>username/password salah</p>

                <?php endif; ?>
                <div class="form-floating mb-3">
                    <input type="username" class="form-control" id="floatingInput" placeholder="name@example.com" name="username">
                    <label for="floatingInput">masukan nama</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control " id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="login d-flex ">
                    <button type="submit" class="btn btn-primary " name="login">Login</button>
                </div>
            </form>
            <div class="register d-flex justify-content-center">belum punya akun->><a href="register.php">register </a> sekarang</div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>