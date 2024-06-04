<?php
include '../function/function.php';
include '../connect/conn.php';
$id = $_GET["id"];

if (hapus($id) > 0) {
    echo " 
    <script>
alert ('data berhasil di hapus');
document.location.href= 'cekuser.php';  
    </script>
    ";
} else {
    echo " 
    <script>
alert ('data gagal di hapus');
document.location.href= 'cekuser.php';  
    </script>
    ";
}
