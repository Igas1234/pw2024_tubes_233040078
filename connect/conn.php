<?php

$koneksi = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040078");
if (mysqli_connect_errno()) {
    echo "koneksi gagal" . mysqli_connect_error();
}
