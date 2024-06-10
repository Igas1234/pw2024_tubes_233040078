// console.log('ok');

// //ambil elemen2 yang di butuhkan
// var keyword =document.getElementById ('keyword');
// var tombolcari = document.getElementById('tombol-cari');
// var container = document.getElementById('container');

// //tambahkan event ketika keyword yang ditulis
// keyword.addEventListener('keyup', function(){
// //objek ajax
// var xhr = new XMLHttpRequest();
// // mengecek  kesiapan ajax
// xhr.onreadystatechange = function(){
//     if(xhr.readyState === 4 && xhr.status == 200){
//         container.innerHTML = xhr.responseText;
//     }
// }   


// //eksekusi ajax
// xhr.open('GET','../ajax/produk.php?keyword=' + keyword.value, true);
// xhr.send();
// });


console.log('ok');

// Get the elements needed
var keyword = document.getElementById('keyword');
var tombolcari = document.getElementById('tombol-cari');
var container = document.getElementById('container');

// Add event when keyword is typed
keyword.addEventListener('keyup', function() {
    // AJAX object
    var xhr = new XMLHttpRequest();
    
    // Check AJAX readiness
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            container.innerHTML = xhr.responseText;
        }
    };
    
    // Execute AJAX
    xhr.open('GET', '../ajax/produk.php?keyword=' + keyword.value, true);
    xhr.send();
});
