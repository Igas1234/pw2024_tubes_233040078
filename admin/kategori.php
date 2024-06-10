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

include '../connect/conn.php';

// periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// query untuk mengambil data dari tabel
$query = "SELECT * FROM kategori";
$result = mysqli_query($conn, $query);

// tampilkan data dalam tabel HTML
echo "<table border='1'>
<tr>
<th>id</th>
<th>Nama kategori</th>
<th>id_produk<?th>
</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    $i = 1;
    echo "<tr>";
    echo "<td>$i</td>";
    echo "<td>" . $row['nama_kategori'] . "</td>";
    echo "<td> $i  </td>";
    echo "</tr>";
    $i++;
}

echo "</table>";

// tutup koneksi
