<?php
include 'connect.php';

// ==================1==================
// If statement untuk mengambil GET request dari URL kemudian simpan variabel id
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ==================2==================
    // Definisikan query untuk menghapus data menggunakan Prepared Statement
    $query = "DELETE FROM tb_buku WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    // ==================3==================
    // Cek apakah query berhasil dijalankan
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>alert('Data berhasil dihapus'); window.location='katalog_buku.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus atau tidak ditemukan'); window.location='katalog_buku.php';</script>";
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('ID tidak ditemukan'); window.location='katalog_buku.php';</script>";
}

// Tutup koneksi database
mysqli_close($conn);
?>
