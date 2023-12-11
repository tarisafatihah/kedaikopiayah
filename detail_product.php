    <?php
    include 'koneksi.php';
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <title>Kedai Kopi Ayah</title>
    </head>

    <body>

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
          <a class="navbar-brand" href="#">Kedai Kopi Ayah</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">HOME
                  <span class="sr-only">(current)</span>
                </a>
              </li>

              <?php

              session_start();
              error_reporting(0);
              $id_customer = $_SESSION['id_customer'];
              if ($id_customer == null) {

              ?>


                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    REGISTER & LOGIN
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="login.php">LOGIN</a>
                    <a class="dropdown-item" href="register.php">REGISTER</a>
                  </div>
                </li>

              <?php } else {

                $customer = mysqli_query($koneksi, "SELECT*FROM customer where id_customer = '$id_customer' ");
                $cust = mysqli_fetch_array($customer);
              ?>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    echo $cust['nama_customer'];
                    ?>

                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="customer/profile.php">Profile</a>
                    <a class="dropdown-item" href="customer/keranjang.php">Keranjang</a>
                    <a class="dropdown-item" href="customer/logout.php">Logout</a>
                  </div>
                </li>
              <?php } ?>

              <li class="nav-item">
                <a class="nav-link" href="about.php">ABOUT US</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="jumbotron">
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            <?php

            $id = $_GET['id_product'];
            $query = mysqli_query($koneksi, "SELECT*FROM product where id_product = '$id'");
            $data = mysqli_fetch_array($query)
            ?>

            <div class="row">
              <div class="col-md-6">
                <img src="assets/product/<?php echo $data['gambar']; ?>" height="500px" width="100%">
              </div>
              <div class="col-md-6">
                <h3 class="font-weight-bold"><?php echo $data['nama_product']; ?></h3><br>
                <h5>Rp.<?php echo number_format($data['harga']); ?></h5><br>
                <h5>Description</h5>
                <p class="text-justify display-5"><?php echo $data['description']; ?></p>
                <form role="form" id="form-tambah" method="post" action="aksi_beli.php">
                  <input type="hidden" name="id_product" value="<?php echo $data['id_product']; ?>">
                  <input type="hidden" name="nama_product" value="<?php echo $data['nama_product']; ?>">
                  <input type="hidden" name="harga" value="<?php echo $data['harga']; ?>">
                  <div class="form-group">
                    <label>QTY</label>
                    <input type="number" class="form-control" id="qty" name="qty" required="required" value="1" min="1" max="<?php echo $data['stok']; ?>">
                  </div>
                  <?php if ($data['stok'] < 1) { ?>

                    <h4 class="text-danger">Stok Habis</h4>


                  <?php } else { ?>
                    <button type="submit" class="btn btn-primary">Beli</button>
                  <?php } ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div id="footer">

        <br><br>
        <h5 class="text-center">COPYSRIGHT Tarisa Fatihah</h5>
        <br><br>

      </div>

    </body>

    </html>