<?php
session_start();

// Memeriksa apakah pengguna yang login adalah pengguna yang mengunggah postingan
if (isset($_SESSION['username']) && isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $current_user = $_SESSION['username'];

    // Koneksi ke database
    require_once __DIR__ . '/allkoneksi/koneksi.php';
    // Query untuk memeriksa apakah pengguna yang login adalah pengunggah postingan
    $stmt = $koneksi->prepare("SELECT * FROM posts WHERE id=? AND uploaded_by=?");
    $stmt->bind_param("is", $post_id, $current_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ambil data postingan dari hasil query
        $row = $result->fetch_assoc();

        // Hapus baris terkait di tabel dislikes dan likes
        $stmt = $koneksi->prepare("DELETE FROM dislikes WHERE post_id=?");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        
        $stmt = $koneksi->prepare("DELETE FROM likes WHERE post_id=?");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();

        // // Hapus baris terkait di tabel notifications
        // $stmt = $koneksi->prepare("DELETE FROM notifications WHERE post_id=?");
        // $stmt->bind_param("i", $post_id);
        // $stmt->execute();

        // Hapus postingan dari database
        $stmt = $koneksi->prepare("DELETE FROM posts WHERE id=?");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Hapus file gambar dari direktori
            $image_path = "blogs/uploads/" . $row['image'];
            if (file_exists($image_path)) {
                if (unlink($image_path)) {
                    $_SESSION['message'] = "Postingan dan gambar berhasil dihapus.";
                } else {
                    $_SESSION['message'] = "Postingan dihapus, tetapi gagal menghapus gambar.";
                }
            } else {
                $_SESSION['message'] = "Postingan dihapus. Gambar tidak ditemukan.";
            }
        } else {
            $_SESSION['message'] = "Gagal menghapus postingan.";
        }
    } else {
        $_SESSION['message'] = "Anda tidak memiliki izin untuk menghapus postingan ini.";
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $koneksi->close();
}

// Redirect dengan menggunakan JavaScript
echo "<script>window.location.href='/index.php';</script>";
exit();
?>
