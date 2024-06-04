<?php
session_start();
// if (isset($_SESSION["login"])) {
//     header("location: index.php");
//     exit;
//}

require './function/function.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result =  mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {

        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            //set session
            $_SESSION['login'] = true;

            header("location: admin/produk.php");
            exit;
        }
    }

    $error = true;
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
                <h1>Login </h1>
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
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </form>
            <div class="register">belum punya akun->><a href="register.php">register</a> sekarang</div>
        </div>
        <div class="gambar"><img src="img/Fabregas.jpg" alt=""></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>