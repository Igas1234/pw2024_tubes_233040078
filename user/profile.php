<?php

function getProfile($koneksi, $userId)
{
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}

// Include function untuk mengambil profil
include '../function/function.php';

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    $profile = getProfile($koneksi, $userId);

    if ($profile) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Profil Pengguna</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 20px;
                }

                .profile {
                    border: 1px solid #ccc;
                    padding: 20px;
                    max-width: 600px;
                    margin: auto;
                }

                .profile h2 {
                    margin-top: 0;
                }

                .profile p {
                    margin: 5px 0;
                }
            </style>
        </head>

        <body>
            <div class="profile">
                <h2>Profil Pengguna</h2>
                <p><strong>ID:</strong> <?php echo htmlspecialchars($profile['id']); ?></p>
                <p><strong>Nama:</strong> <?php echo htmlspecialchars($profile['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($profile['email']); ?></p>
                <p><strong>Telepon:</strong> <?php echo htmlspecialchars($profile['phone']); ?></p>
                <!-- Tambahkan field lain sesuai dengan tabel users -->
            </div>
        </body>

        </html>
<?php
    } else {
        echo "Pengguna tidak ditemukan.";
    }
} else {
    echo "ID pengguna tidak diberikan.";
}

mysqli_close($koneksi);
?>