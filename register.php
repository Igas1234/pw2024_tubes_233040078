<?php
require './function/function.php';

if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "  <script>
        alert ('berhasil registrasi');
        document.location.href= 'login.php';      
            </script>";
    } else {
        echo mysqli_error($koneksi);
    }
}

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/register.css">
</head>

<body>
    <div class="login">
        <form action="" method="post">
            <h1>Register sekarang</h1>
            <div class="form-floating mb-3">
                <input type="username" class="form-control" id="floatingInput" placeholder="name@example.com" name="username">
                <label for="floatingInput">masukan nama</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword2" placeholder="Password" name="password2">
                <label for="floatingPassword2">konfirmasi password</label>
            </div>
            <button type="submit" name="register" class="btn btn-primary d-flex justify-content-start">register</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>