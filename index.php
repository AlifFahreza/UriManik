<?php
  include('config.php'); // Menyertakan file konfigurasi koneksi database
  // Query SQL untuk mengambil data produk
  $sql = "SELECT * FROM produk";
  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Online Sederhana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="bg-secondary">
    <div class="container p-0 mb-4 mt-4 rounded-3 shadow bg-white">
      
        <!-- menu -->
         <nav class="d-md-flex p-4">
            <div><h1>UriManik</h1></div>
            <div class="ms-auto my-auto">
                <ul class="list-inline m-0">
                    <li class="list-inline-item mx-md-3"><a href="#collections" class="text-decoration-none 
                        text-dark fw-bold">Produk Kami</a></li>
                    <li class="list-inline-item mx-md-3"><a href="#tentang" class="text-decoration-none 
                        text-dark fw-bold">Tentang Kami</a></li>
                    <li class="list-inline-item mx-md-3"><a href="#order" class="text-decoration-none 
                        text-dark fw-bold">Cara Order</a></li>
                    <li class="list-inline-item mx-md-3"><a href="auth/logout.php" class="text-decoration-none 
                        text-dark fw-bold">Log Out</a></li>
                </ul>
            </div>
         </nav>

         <!-- banner -->
          <div class="px-4 mb-4">
            <img src="images/banner1.png" class="w-100 rounded-3"/>
          </div>

          <!-- catalogue -->
          <h3 class="text-center" id="collections">Our Collections</h3> 
          <div class="text-center w-50 mx-auto fw-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis illum adipisci, minus voluptatibus iure aliquam?</div>

          <div class="row row-cols-md-3 row-cols-2 gx-5 p-5">
          <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col mb-5">';
                    echo '<div class="card shadow">';
                    echo '<img src="' . $row["image_url"] . '" class="card-img-top">';
                    echo '<div class="card-body">';
                    echo '<p class="card-text">' . $row["deskripsi"] . '</p>';
                    echo '</div>';
                    echo '<div class="card-footer d-md-flex">';
                    echo '<a class="btn btn-sm btn-primary d-block btnDetail">Detail</a>';
                    echo '<span class="ms-auto text-danger fw-bold d-block text-center harga">Rp ' . number_format($row["harga"], 0, ",", ".") . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>Tidak ada produk yang tersedia.</p>';
            }
            ?>
          </div>

            <!-- tentang kami -->
            <div id="tentang" class="px-4 py-4 bg-secondary text-center"> 
              <div class="mx-auto w-75">
                <h3 class="text-white">Tentang Kami</h3>
                <p class="text-center text-white">
                  <img src="image/about-us.png" style="width: 100px; height: auto; float: left; margin-right: 1rem; margin-bottom: 1rem;" />
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum, quibusdam unde, hic aperiam iusto debitis reiciendis quae magni deleniti dolorum dignissimos dicta nam consequuntur nobis amet, magnam est temporibus. Quaerat facere natus facilis odio nulla dolore veritatis, optio quo distinctio iure quas ea at illo quod quae. Laudantium, dolores possimus.
                </p>                                          
              </div>
            </div>
            
            <!-- Cara Order -->
            <div id="order" class="px-4 py-4 bg-light text-center">
              <div class="mx-auto w-75">
                <h3 class="text-dark">Cara Order</h3>
                <p class="text-center text-dark">
                  <img src="image/order.png" style="width: 100px; height: auto; float: right; margin-left: 1rem; margin-bottom: 1rem;" class="ms-3 mb-3" />
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae eos suscipit, quam sed fuga corrupti voluptatum est, voluptate nemo sequi debitis numquam consequuntur atque? In ducimus ex perspiciatis doloremque pariatur, voluptatem enim quasi magni. Aperiam deleniti odit quos atque non!
                </p>                            
              </div>
            </div>
                                    
          <!-- copyright -->
           <div class="text-center p-4 border-top">&copy; 2024 uri manik. Toko Online Sederhana
            </div>
           </div>
           <!-- modal -->
<button type="button" class="btn btn-primary d-none btnModal" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 modalTitle" id="exampleModalLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row">
      <div class="modalImage col-md-6 col-12"></div>
      <div class="col-md-6 col-12"> 
           <div class="modalDeskripsi"></div>
           <div class="d-md-flex">
            <a href="" target="blank" class=" btn btn-sm btn-warning d-block btnBeli">Beli Produk Ini</a>
            <span class="ms-auto text-danger fw-bold d-block text-center modalHarga"></span>
        </div> 
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>
    <script src="main.js"></script>
  </body>
</html>