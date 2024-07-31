<?php
    include('../config.php'); // Menyertakan file konfigurasi koneksi database
    session_start();
    if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
        header("Location: index.php");
        exit();
    }

    $id_produk = $_GET['id'];

    // Query untuk mengambil data produk berdasarkan id_produk
    $sql = "SELECT * FROM produk WHERE id_produk = $id_produk";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Produk tidak ditemukan.'); window.location.href = 'admin_dashboard.php';</script>";
        exit();
    }
    
    // Menutup koneksi database
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Optional: Style untuk menampilkan gambar */
        .product-image {
            max-width: 200px;
            max-height: 200px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Produk</h1>
        <form method="post" action="process/edit_process.php" enctype="multipart/form-data">
            <input type="hidden" name="id_produk" value="<?php echo $row['id_produk']; ?>">
            
            <!-- Nama Produk -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
            </div>
            
            <!-- Deskripsi Produk -->
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?php echo $row['deskripsi']; ?></textarea>
            </div>
            
            <!-- Harga Produk -->
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
            </div>
            
            <!-- Gambar Produk -->
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Produk</label><br>
                <img src="../<?php echo $row['image_url']; ?>" alt="Gambar Produk" class="product-image"><br>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                <input type="hidden" name="gambar_lama" value="<?php echo $row['image_url']; ?>">
                <small class="form-text text-muted">Upload gambar baru jika ingin mengganti.</small>
            </div>
            
            <!-- Tombol Simpan dan Batal -->
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Batal</a>
        </form>

        <br><br>
    </div>
</body>
</html>