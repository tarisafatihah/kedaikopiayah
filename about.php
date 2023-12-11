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
          <li class="nav-item">
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
          <li class="nav-item active">
            <a class="nav-link" href="about.php">ABOUT US</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/unsplash6.jpg" alt="Los Angeles" width="100%" height="300">
      <div class="carousel-caption">
        <h1><b>Kedai Kopi Ayah</b></h1>
      </div>
    </div>
  </div>
  <br><br><br>

  <div class="container-custom">
    <div class="row">
      <div class="col-md-6">
        <img src="assets/img/unsplash5.jpg" alt="Los Angeles" width="100%" height="100%" style="border-radius: 10px 0 0 15px; ">
      </div>
      <div class="col-md-6">
        <div class="container">
          <br>
          <h1><b>Kedai Kopi Ayah</b></h1>
          <br>

          Kedai Kopi Ayah adalah Coffee online Store yang menawarkan Kopi Arabika terbaik di Indonesia. Berdiri di bawah naungan PT. Ayah, Kedai Kopi Ayah memiliki tujuan yang baik agar semua peminum, pecinta, biji kopi yang kami Tanam di tanah Indonesia. Kopi yang kami jual diambil dari Perkebunan kami sendiri, sehingga menghasilkan Kopi terbaik untuk dinikmati oleh seluruh masyarakat di seluruh dunia dimanapun berada.
          <br><br>
          Kedai Kopi Ayah memastikan setiap Kopi yang diterima konsumen adalah kopi baru dan segar, dan dijaga kualitas kopinya agar konsumen mendapatkan kopi arabika dengan kualitas terbaik. temancoffe akan terus berinovasi dan mengembangkan Perusahaannya agar bisa selalu memberikan pengalaman baru bagi para peminum, pecinta dan Pemilik warung Kopi.
          <br><br>
          <a href="index.php" class="btn btn-dark btn-lg">LIHAT PRODUCT</a>
          <br><br>
        </div>
      </div>
    </div>
  </div>
  <br><br>
  <div class="container-custom">
    <div class="container about-us">


      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="card-body">
              <h4>Kontak kami</h4>
              <p class="card-text">
              <p>PT. Ayah</p>
              Jl. Brantas Raya Blok DN 17, RT.005/RW.015, Jatisari,
              Kec. Jatiasih, Bekasi Selatan, Jawa Barat 17426 </p>
              <p>Call/SMS/WA : 081212800349
                E-mail : fbtarisa@gmail.com </p>
            </div>
          </div>
        </div>



        <div class="col-md-6">
          <div class="row">
            <div class="card-body">
              <h4>Media Sosial</h4>
              <p class="card-text">
              <p><img src="assets/img/instagram.png" width="50px" height="50px"> <a href="">Instagram.com/KedaiKopiAyah</a></p>

              <p><img src="assets/img/facebook.png" width="50px" height="50px"> <a href=""> facebook.com/KedaiKopiAyah</a></p>

              <p><img src="assets/img/twitter.png" width="50px" height="50px"> <a href=""> Twitter.com/KedaiKopiAyah</a></p>

              <p><img src="assets/img/youtube.png" width="50px" height="50px"><a href=""> KedaiKopiAyah</a></p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <br><br><br>

  <div id="footer">

    <br><br>
    <h5 class="text-center">COPYSRIGHT Terisa Fatihah</h5>
    <br><br>

  </div>


</body>

</html>