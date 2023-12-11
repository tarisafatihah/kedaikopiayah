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
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="script.js"></script>

  <title>Kedai Kopi Ayah</title>
</head>

<body class="body">

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
          if (!isset($id_customer)) {

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
  <br><br><br>

  <div class="container-custom">

    <div id="demo" class="carousel slide" data-ride="carousel">
      <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
      </ul>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/img/unsplash2.jpg" alt="Los Angeles" width="100%" height="500">
          <div class="carousel-caption">
            <h1><b>Coffee Like Friends</b></h1>
          </div>
        </div>
        <div class="carousel-item">
          <img src="assets/img/unsplash4.jpg" alt="Chicago" width="100%" height="500">
          <div class="carousel-caption">
            <h1><b>Coffee Like Friends</b></h1>
          </div>
        </div>
        <div class="carousel-item">
          <img src="assets/img/unsplash5.jpg" alt="Chicago" width="100%" height="500">
          <div class="carousel-caption">
            <h1><b>Coffee Like Friends</b></h1>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>

    <br><br><br>

    <div class="container-fluid">

      <div class="row">
        <div class="col-md-4">
          <div class="garis"></div>
        </div>
        <div class="col-md-4">
          <h1 class="display-5 text-center">Our Product</h1>
        </div>
        <div class="col-md-4">
          <div class="garis"></div>
        </div>
      </div>

      <br>
      <br>

      <div class="form-group col-md-3">
        <label for="exampleInputEmail1">Pilih Kategori</label>

        <select class="form-control text-center" id="kategori">
          <option value="show-all" selected="selected">Pilihan Kategori</option>
          <?php
          $q_kategori = mysqli_query($koneksi, "SELECT*FROM kategori");
          while ($data_kat = mysqli_fetch_array($q_kategori)) {
          ?>
            <option value="<?php echo $data_kat['kategori']; ?>"><?php echo $data_kat['kategori']; ?></option>
          <?php } ?>
        </select>

      </div>

      <div id="data-product"></div>

      <br><br>

    </div>
  </div>

  <div id="footer">

    <br><br>
    <h5 class="text-center">COPYSRIGHT Tarisa Fatihah</h5>
    <br><br>

  </div>


</body>

</html>