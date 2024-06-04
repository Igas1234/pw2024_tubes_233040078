<?php

require '../function/function.php';

$ip = $_GET["id"];

if ((hapusproduk($ip)) > 0) {
    echo " 
    <script>
alert ('makanan berhasil di hapus');
document.location.href= 'produk.php';  
    </script>
    ";
} else {
    echo " 
    <script>
alert ('makanan gagal di hapus');
document.location.href= 'produk.php';  
    </script>
    ";
}

// include '../connect/conn.php';
// include '../function/function.php';

// if (isset($_GET['id'])) {
//     $id_produk = $_GET['id'];
//     if (hapusproduk($id_produk) > 0) {
//         echo "
//         <script>
//             alert('Data berhasil dihapus');
//             document.location.href = 'produk.php';
//         </script>
//         ";
//     } else {
//         echo "
//         <script>
//             alert('Data gagal dihapus');
//             document.location.href = 'produk.php';
//         </script>
//         ";
//     }
// } else {
//     echo "
//     <script>
//         alert('ID produk tidak ditemukan');
//         document.location.href = 'produk.php';
//     </script>
//     ";
// }
