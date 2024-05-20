<?php
session_start();

// Pastikan hanya request method GET yang diizinkan
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['hapus'])) {
    // Definisikan informasi koneksi ke database
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "blog";

    // Buat koneksi
    $koneksi = new mysqli($host, $user, $password, $database);

    // Periksa koneksi
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    // Ambil parameter hapus dari URL
    $hapus_id = $_GET['hapus'];

    // Ambil informasi pengguna yang sedang login
    $pengguna_login = $_SESSION['username'];

    // Eksekusi query untuk menghapus komentar berdasarkan id dan hanya jika pengguna yang sedang login adalah pemilik komentar
    $query = $koneksi->prepare("DELETE FROM comments WHERE id = ? AND author = ?");
    $query->bind_param("is", $hapus_id, $pengguna_login);
    $query->execute();

    // Periksa apakah query berhasil dijalankan
    if ($query->affected_rows > 0) {
        header('Location: komen.php');
        exit;
    } else {
        // echo "Gagal menghapus komentar atau Anda tidak memiliki izin untuk menghapus komentar ini.";
        echo "<script>alert('Gagal menghapus komentar atau Anda tidak memiliki izin untuk menghapus komentar ini.'); window.history.back();</script>";

    }

    // Tutup koneksi
    $koneksi->close();
} else {
    // Jika request method bukan GET, atau parameter hapus tidak ada, tampilkan pesan kesalahan
    echo "Metode request tidak valid atau parameter hapus tidak ditemukan.";
}
?>
