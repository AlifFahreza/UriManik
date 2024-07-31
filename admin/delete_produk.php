<?php
include('../config.php'); // Menyertakan file konfigurasi koneksi database

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Query untuk menghapus data produk berdasarkan id_produk
    $sql = "DELETE FROM produk WHERE id_produk = $id_produk";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Produk berhasil dihapus.'); window.location.href = 'admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "\\n" . $conn->error . "'); window.location.href = 'admin_dashboard.php';</script>";
    }
} else {
    echo "<script>alert('ID produk tidak valid atau tidak tersedia.'); window.location.href = 'admin_dashboard.php';</script>";
}

$conn->close(); // Menutup koneksi database
?>