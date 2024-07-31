<?php
require_once "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
         body {
            background-image: url('../images/bg.jpeg'); /* Gambar latar belakang */
            background-size: cover; /* Menyesuaikan ukuran gambar dengan layar */
            background-repeat: no-repeat; /* Menghindari pengulangan gambar */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Efek bayangan untuk card */
        }
        .card-header {
            background-color: #5f555f; /* Warna header card */
            color: #fff;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            padding: 2rem;
        }
        .form-floating label {
            color: #9c27b0; /* Warna label form */
        }
        .btn-dark {
            background-color: #5f555f; /* Warna tombol */
            border-color: #5f555f;
        }
        .btn-dark:hover {
            background-color: #c2185b; /* Warna tombol saat dihover */
            border-color: #c2185b;
        }
        .alert {
            background-color: #f8bbd0; /* Warna background alert */
            color: #c2185b; /* Warna teks alert */
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid #f48fb1; /* Warna border alert */
            border-radius: 0.25rem;
        }
    </style>
</head>
<body class="bg-secondary">
    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan']=="gagal"){
            echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
        }
    }
    ?>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h4 class="text-center font-weight-light my-4">Login</h4></div>
                                <div class="card-body">
                                    <form action="cek_login.php" method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" name="username" placeholder="Username .." required="required">
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="password" name="password" placeholder="Password .." required="required">
                                        </div>
                                        <button type="submit" name="login" class="btn btn-dark col-12 rounded-pill my-2">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
