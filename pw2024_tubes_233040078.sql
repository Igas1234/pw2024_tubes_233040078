-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 11, 2024 at 07:47 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw2024_tubes_233040078`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `id_produk` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `id_produk`) VALUES
(1, 'makanan', 1),
(2, 'minuman', 2);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` int NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `deskripsi`, `img`) VALUES
(1, 'sate ayam', 12000, 'makanan enak dan lezat', ''),
(2, 'teh botol', 5000, 'minuman segar', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `kategori_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


  <li>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <?php //foreach ($kategori as $ktg) ?>
                            <option selected value="<?=// $ktg["id_kategori"] ?>">Pilih kategori makanan</option>
                        </select>
                    </li>


<?
// // $kategoris = $_POST['kategori'];
// // $nama_produk = $_POST['nama'];
// // $harga_produk = $_POST['harga'];
// // $deskripsi = $_POST['deskripsi'];
// // $img = $_POST['img'];

// // $filename = $_FILES['img']['name'];
// // $tmp_name = $_FILES['img']['tmp_name'];

// // $type1 = explode('.', $filename);
// // $type2 = $type1[1];

// // $newname = 'img' . time() . '.' . $type2;

// // $tipe_izinkan = array('jpg', 'jpeg', 'png');

// // if (!in_array($type2, $tipe_izinkan)) {
// // move_uploaded_file($tmp_name, './img/' . $newname);
// // } else {
// // echo '<script>
    alert("format file tidak di izinkan")
</script>';
// // }

// //cek data
// $sql = "INSERT INTO produk (nama_kategori,nama_produk, harga_produk, deskripsi, img)
// VALUES('$kategoris','$nama_produk','$harga_produk','$deskripsi', '$img')";

// // eksekusi
// if ($koneksi->query($sql) === TRUE) {
// echo "
// <script>
    // alert ('data berhasil di tambah');
    // document.location.href= 'produk.php';  
    //     
</script>
// ";
// } else {
// echo "error";
// echo "<br>";
// echo mysqli_error($koneksi);
// }