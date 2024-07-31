<?php
    include('../../config.php'); // Menyertakan file konfigurasi koneksi database
    session_start();
    if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
        header("Location: index.php");
        exit();
    }

    // Memeriksa apakah ada data yang dikirimkan melalui POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_produk = $_POST['id_produk'];
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];

        // Memeriksa apakah ada file gambar yang diunggah
        if ($_FILES['gambar']['name']) {
            // Mengatur direktori tempat gambar akan disimpan
            $target_dir = "../images/";
            $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Memeriksa apakah file gambar valid atau tidak
            $check = getimagesize($_FILES["gambar"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "<script>alert('File bukan gambar.'); window.location.href = 'admin_dashboard.php';</script>";
                exit();
            }

            // Memeriksa apakah file sudah ada
            if (file_exists($target_file)) {
                echo "<script>alert('Maaf, file sudah ada.'); window.location.href = 'admin_dashboard.php';</script>";
                exit();
            }

            // Memeriksa ukuran file
            if ($_FILES["gambar"]["size"] > 500000) {
                echo "<script>alert('Maaf, ukuran file terlalu besar.'); window.location.href = 'admin_dashboard.php';</script>";
                exit();
            }

            // Mengizinkan format file tertentu
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "<script>alert('Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.'); window.location.href = 'admin_dashboard.php';</script>";
                exit();
            }

            // Jika semua valid, upload file
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $image_url = "images/" . basename($_FILES["gambar"]["name"]);
            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah file.'); window.location.href = 'admin_dashboard.php';</script>";
                exit();
            }
        } else {
            // Jika tidak ada gambar yang diunggah, tetap gunakan gambar yang sudah ada
            $image_url = $_POST['gambar_lama'];
        }

        // Query untuk memperbarui data produk
        $sql = "UPDATE produk SET nama='$nama', deskripsi='$deskripsi', harga='$harga', image_url='$image_url' WHERE id_produk=$id_produk";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Produk berhasil diperbarui.'); window.location.href = '../admin_dashboard.php';</script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Menutup koneksi database
        $conn->close();
    }
?>
