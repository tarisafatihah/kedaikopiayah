<?php
include '../koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
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
          <li class="nav-item">
            <a class="nav-link" href="../index.php">HOME
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <?php

          session_start();
          error_reporting(0);
          $id_customer = $_SESSION['id_customer'];

          $customer = mysqli_query($koneksi, "SELECT*FROM customer where id_customer = '$id_customer' ");
          $cust = mysqli_fetch_array($customer);
          ?>

          <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php
              echo $cust['nama_customer'];
              ?>

            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="profile.php">Profile</a>
              <a class="dropdown-item" href="Keranjang.php">Keranjang</a>
              <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../about.php">ABOUT US</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <?php
  $query = mysqli_query($koneksi, " select *  from keranjang where id_customer = '$id_customer' && id_transaksi = 'Belum Ada Transaksi' order by id_keranjang desc");
  $data = mysqli_fetch_array($query);

  if ($data == null) {
  ?>
    <br><br><br><br><br><br><br><br>
    <center>
      <img src="../assets/img/empty-cart-vector.png" width="200px" height="200px">
      <br>
      <h3>Keranjang Belanja Anda Kosong</h3><br>
      <a href="../index.php" class="btn btn-dark">Belanja Sekarang</a>
    </center>

  <?php
  } else {
  ?>
    <br><br><br><br><br>

    <div class="container">

      <div class="row">
        <div class="col-md-4">
          <div class="garis"></div>
        </div>
        <div class="col-md-4">
          <h1 class="display-5 text-center">Keranjang</h1>
        </div>
        <div class="col-md-4">
          <div class="garis"></div>
        </div>
      </div>
      <br><br>

      <div id="data-keranjang"></div>

      <a href="../index.php" class="btn btn-primary">Lanjutkan Belanja</a>
      <a href="checkout.php" class="btn btn-success">Checkout</a>
    <?php } ?>
    <br><br><br><br><br><br><br><br>


    </div>

    <div id="footer">

      <br><br>
      <h5 class="text-center">COPYSRIGHT Tarisa Fatihah</h5>
      <br><br>

    </div>


</body>

</html>

<div id="modal-edit" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" id="form-edit" method="post" action="aksi_keranjang.php">
        <div class="modal-header">
          <h4 class="modal-title">Edit keranjang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div id="data-edit">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="modal-hapus" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete keranjang</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div id="delete-keranjang"></div>
      </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    var data = "data_keranjang.php";
    $('#data-keranjang').load(data);

    $(document).on('click', '#edit', function(e) {
      e.preventDefault();
      $("#modal-edit").modal('show');
      $.post('edit_keranjang.php', {
          id: $(this).attr('data-id')
        },
        function(html) {
          $("#data-edit").html(html);
        }
      );
    });


    $("#form-edit").submit(function(e) {
      e.preventDefault();

      var dataform = new FormData($("#form-edit")[0]);
      $.ajax({
        url: "aksi_keranjang.php",
        type: "post",
        processData: false,
        contentType: false,
        data: dataform,
        success: function(result) {

          $('#modal-edit').modal('hide');
          $("#form-edit")[0].reset();
          alert('Edit Data Sukses');
          $('#data-keranjang').load(data);
        },
        error: function() {
          $('#modal-edit').modal('hide');
          $("#form-edit")[0].reset();
          alert('Edit Data Gagal');
        }
      });
    });


    $(document).on('click', '#confirm_delete', function(e) {
      e.preventDefault();
      $("#modal-hapus").modal('show');
      $.post('confirm_delete.php', {
          id: $(this).attr('data-id')
        },
        function(html) {
          $("#delete-keranjang").html(html);
        }
      );
    });


    $(document).on('click', '#hapus', function(e) {
      e.preventDefault();
      $.post('aksi_keranjang.php', {
          id: $(this).attr('data-id')
        },
        function(html) {
          $('#modal-hapus').modal('hide');
          alert('Delete Data Sukses');
          $('#data-keranjang').load(data);

        }
      );
    });


  });
</script>