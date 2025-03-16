<?php
include 'connect.php';

// ==================1==================
// If statement untuk memeriksa apakah request berasal dari form POST dan memiliki ID
if (isset($_POST['update']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun_terbit = $_POST['tahun_terbit'];

    // ==================2==================
    // Definisikan query untuk mengupdate data menggunakan Prepared Statement
    $query = "UPDATE tb_buku SET judul = ?, penulis = ?, tahun_terbit = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssii", $judul, $penulis, $tahun_terbit, $id);
    
    // ==================3==================
    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data berhasil diperbarui'); window.location='katalog_buku.php';</script>";
    } else {
        echo "<script>alert('Data gagal diperbarui'); window.location='edit_buku.php?id=$id';</script>";
    }

    // Tutup statement dan koneksi
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('Akses tidak valid'); window.location='katalog_buku.php';</script>";
}

mysqli_close($conn);
?>
