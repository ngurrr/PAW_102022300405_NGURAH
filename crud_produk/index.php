<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "wad_handson");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambah Produk
if (isset($_POST["tambah"])) {
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];

    $sql = "INSERT INTO product (nama_produk, harga, stok) VALUES ('$nama', '$harga', '$stok')";
    $conn->query($sql);
}

// Hapus Produk
if (isset($_GET["hapus"])) {
    $id = $_GET["hapus"];
    $conn->query("DELETE FROM product WHERE id=$id");
}

// Edit Produk
if (isset($_POST["edit"])) {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];

    $conn->query("UPDATE product SET nama_produk='$nama', harga='$harga', stok='$stok' WHERE id=$id");
}

// Ambil data produk
$result = $conn->query("SELECT * FROM product");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h2 class="text-center">Manajemen Produk</h2>

    <!-- Form Tambah Produk -->
    <div class="card p-3 mb-3">
        <h4>Tambah Produk</h4>
        <form method="POST">
            <div class="mb-2">
                <label>Nama Produk</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>
            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
        </form>
    </div>

    <!-- Tabel Data Produk -->
    <h4>Daftar Produk</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= $row["nama_produk"] ?></td>
                <td>Rp<?= number_format($row["harga"]) ?></td>
                <td><?= $row["stok"] ?></td>
                <td>
                    <a href="?hapus=<?= $row["id"] ?>" class="btn btn-danger btn-sm">Hapus</a>
                    <button class="btn btn-warning btn-sm" onclick="editProduk(<?= $row['id'] ?>, '<?= $row['nama_produk'] ?>', <?= $row['harga'] ?>, <?= $row['stok'] ?>)">Edit</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Form Edit Produk (Modal) -->
    <div class="modal" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Edit Produk</h4>
                    <button type="button" class="btn-close" onclick="closeModal()"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-2">
                            <label>Nama Produk</label>
                            <input type="text" id="editNama" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Harga</label>
                            <input type="number" id="editHarga" name="harga" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Stok</label>
                            <input type="number" id="editStok" name="stok" class="form-control" required>
                        </div>
                        <button type="submit" name="edit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editProduk(id, nama, harga, stok) {
            document.getElementById('editId').value = id;
            document.getElementById('editNama').value = nama;
            document.getElementById('editHarga').value = harga;
            document.getElementById('editStok').value = stok;
            document.getElementById('editModal').style.display = "block";
        }
        function closeModal() {
            document.getElementById('editModal').style.display = "none";
        }
    </script>

</body>
</html>
