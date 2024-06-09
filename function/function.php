<?php
$koneksi = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040078");
if (mysqli_connect_errno()) {
    echo "koneksi gagal" . mysqli_connect_error();
}

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function cekkategori($data)
{
    $result = query("SELECT id_kategori FROM kategori WHERE nama_kategori='$data'")[0]["id_kategori"];
    return $result;
}

function tambahproduk($data)
{
    global $koneksi;
    // ambil data dari elemen form 
    $id_kategori = cekkategori($data["kategori"]);
    $nama_produk = $data["nama"];
    $harga_produk = $data["harga"];
    $deskripsi =  $data["deskripsi"];

    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // query data insert
    $query = "INSERT INTO produk (id_kategori,nama_produk, harga_produk, deskripsi, img) 
      VALUES ('$id_kategori','$nama_produk','$harga_produk','$deskripsi','$gambar')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function upload()
{
    $namafile = $_FILES['img']['name'];
    $ukuranfile = $_FILES['img']['size'];
    $error = $_FILES['img']['error'];
    $tmpname = $_FILES['img']['tmp_name'];
    //cek apkah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "
        <script>
alert('pilih gambar terlebih dahulu!'); 
        </script>
        ";

        return false;
    }
    //cek apakah itu gambar apa bukan 
    $ekstensigambarvalid = ['jpg', 'png', 'jpeg'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
        echo "
        <script>
alert('yang anda upload bukan gambar!'); 
        </script>
        ";
        return false;
    }

    //cek jika size gambar terlalu besar
    if ($ukuranfile > 5000000) {
        echo "
        <script>
alert('ukuran gambar terlalu besar!'); 
        </script>
        ";
        return false;
    }

    //lolos pengecekan gambar siap di upload
    //GENERATE nama gambar baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    // Ensure the 'img/' directory exists and is writable
    if (!is_dir('img')) {
        mkdir('img', 0755, true);
    }

    if (!move_uploaded_file($tmpname, 'img/' . $namafilebaru)) {
        echo "
        <script>
alert('Gagal mengunggah gambar!'); 
        </script>
        ";
        return false;
    }

    return $namafilebaru;
}

function ubahproduk($data)
{
    global $koneksi;

    // ambil data dari elemen form 
    $id = $data["id"];
    $id_kategori = cekkategori($data["kategori"]);
    $nama = htmlspecialchars($data["nama"]);
    $harga =  htmlspecialchars($data["harga"]);
    $deskripsi =  htmlspecialchars($data["deskripsi"]);
    $gambarlama =  htmlspecialchars($data["gambarlama"]);
    //cek apalah admin pilih gambar baru atau tidak
    if ($_FILES['img']['error'] === 4) {
        $gambar = $gambarlama;
    } else {
        $gambar =  upload();
        if (!$gambar) {
            return false;
        }
    }

    // query data update
    $query = "UPDATE produk SET 
        id_kategori='$id_kategori',
        nama_produk='$nama',
        harga_produk='$harga',
        deskripsi='$deskripsi',
        img='$gambar'
    WHERE id_produk=$id";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function hapus($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM user WHERE id= $id");
    return mysqli_affected_rows($koneksi);
}

function hapusproduk($ip)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk=$ip");

    return mysqli_affected_rows($koneksi);
}

function cari($keyword)
{
    $query = "SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE 
    nama_produk LIKE '%$keyword%'";
    return query($query);
}

function registrasi($data)
{
    global $koneksi;
    $username =  strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    // cek username sudah ada apa belum
    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username ='$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert ('username sudah terdaftar');
            </script>";
        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "
        <script>
        alert ('konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambah kan user baru ke database
    $query = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        return true;
    } else {
        return false;
    }
}
