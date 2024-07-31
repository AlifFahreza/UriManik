<?php
    include('../config.php'); // Menyertakan file konfigurasi koneksi database
    session_start();
    if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
        header("Location: index.php");
        exit();
    }

    // Pagination setup
    $limit = 5; // Jumlah entri per halaman
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Query untuk mengambil data produk dengan limit dan offset
    $sql = "SELECT * FROM produk LIMIT $offset, $limit";
    $result = $conn->query($sql);

    // Query untuk menghitung total jumlah produk
    $sql_count = "SELECT COUNT(*) AS total FROM produk";
    $result_count = $conn->query($sql_count);
    $row_count = $result_count->fetch_assoc();
    $total_rows = $row_count['total'];
    $total_pages = ceil($total_rows / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Selamat Datang Admin</h1>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="../auth/logout.php">Logout</a>
            </li>
        </ul>
        <br>
        <div class="card">
            <div class="card-header">
                Daftar Produk Yang Dijual
            </div>
            <div class="card-body">
                <a href="tambah_produk.php" class="btn btn-primary mb-3">Tambah Produk</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data produk diambil dari database -->
                        <?php
                        if ($result->num_rows > 0) {
                            $number = $offset + 1; // Nomor urut berdasarkan offset
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $number . "</td>";
                                echo "<td><img src='../" . $row["image_url"] . "' alt='Produk' width='80'></td>";
                                echo "<td>" . $row["nama"] . "</td>";
                                echo "<td>" . $row["deskripsi"] . "</td>";
                                echo "<td>Rp " . number_format($row["harga"], 0, ",", ".") . "</td>";
                                echo "<td>
                                    <a href='edit_produk.php?id=" . $row["id_produk"] . "' class='btn btn-warning'>Edit</a>
                                    <a href='delete_produk.php?id=" . $row["id_produk"] . "' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk ini?\")'>Hapus</a>
                                </td>";
                                echo "</tr>";
                                $number++; // Increment nomor urut
                            }
                        } else {
                            echo "<tr><td colspan='6'>Tidak ada data produk</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination links -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-4">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo ($page - 1); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo ($page + 1); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</body>
</html>
<?php
    $conn->close(); // Menutup koneksi database
?>
