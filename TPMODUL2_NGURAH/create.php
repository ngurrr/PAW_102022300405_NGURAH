<?php
include "connect.php"; 

// ==================1==================
// If statement untuk mengecek POST request dari form
// Lalu definisikan variabel-variabel untuk menyimpan data yang dikirim dari POST

if (isset($_POST['judul'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun_terbit = $_POST['tahun_terbit'];

    // ==================2==================
    // Definisikan $query untuk melakukan koneksi ke database
    $query = "INSERT INTO tb_buku (judul, penulis, tahun_terbit) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // ==================3==================
    // Eksekusi query
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi", $judul, $penulis, $tahun_terbit);
        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            header("Location: katalog_buku.php");
        } else {
            echo "<script>alert('Data gagal ditambahkan');</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Terjadi kesalahan pada query');</script>";
    }
}
?>
