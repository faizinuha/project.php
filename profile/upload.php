<?php
// Termasuk file koneksi
include_once "koneksi.php";

// Memulai sesi
session_start();

// Memeriksa apakah user_id telah diatur
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Memeriksa apakah data formulir telah dikirimkan
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_image_path"])) {
        // Path untuk menyimpan gambar
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["profile_image_path"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Memeriksa ukuran file
        if ($_FILES["profile_image_path"]["size"] > 900000) {
            echo "Maaf, file Anda terlalu besar.";
            $uploadOk = 0;
        }

        // Izinkan hanya format gambar tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
            $uploadOk = 0;
        }

        // Jika semua validasi terpenuhi, simpan file gambar
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["profile_image_path"]["tmp_name"], $target_file)) {
                // Simpan path gambar ke database
                $image_path = $target_file;
                $query = "UPDATE users SET profile_image_path=? WHERE id=?";
                $stmt = mysqli_prepare($koneksi, $query);
                mysqli_stmt_bind_param($stmt, "si", $image_path, $user_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                echo "File " . basename($_FILES["profile_image_path"]["name"]) . " telah diunggah.";
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
            }
        }
    }
} else {
    // Jika user_id tidak diatur
    echo "User ID tidak ditemukan.";
}

// Tutup koneksi ke database (jika tidak menggunakan koneksi persistent)
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Edit Profil</title>
    <style>
        /* Styling untuk tombol "Upload Image" */
        .btn-upload {
            background-color: #007bff;
            border-color: #007bff;
        }

        /* Styling untuk tombol "Back" */
        .btn-back{
            background-color: #dc3545;
            border-color: #dc3545;
            margin-left: 10px; /* Menambahkan margin agar tidak terlalu rapat dengan tombol "Upload Image" */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Edit Profil</h1>
        <div class="card mt-4">
            <div class="card-body">
                <!-- Form untuk mengunggah foto profil -->
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="profile_image_path" class="form-label">Pilih foto baru:</label>
                        <input type="file" class="form-control" id="profile_image_path" name="profile_image_path">
                    </div>
                    <button type="submit" class="btn btn-primary btn-upload" name="submit">Upload Image</button>
                    <a href="profile_user.php" class="btn btn-danger btn-back">Back</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
 