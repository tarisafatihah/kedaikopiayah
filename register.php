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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              REGISTER & LOGIN
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="login.php">LOGIN</a>
              <a class="dropdown-item" href="register.php">REGISTER</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">ABOUT US</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <br><br><br><br>
  <div class="container">

    <div class="row">
      <div class="col-md-4">
        <div class="garis"></div>
      </div>
      <div class="col-md-4">
        <h1 class="display-5 text-center">Register</h1>
      </div>
      <div class="col-md-4">
        <div class="garis"></div>
      </div>
    </div><br><br>

    <div class="jumbotron-custom">
      <form method="POST" action="aksi_register.php">

        <div class="form-group">
          <label for="exampleInputEmail1">Nama Lengkap</label>
          <input type="text" class="form-control" name="nama" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama" required="required">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Alamat</label>
          <textarea class="form-control" name="alamat" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Alamat" required="required"></textarea>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Email</label>
          <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required="required">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required="required">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Telepon</label>
          <input type="number" class="form-control" name="telp" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nomor Telepon" required="required">
        </div>

        <button type="submit" class="btn btn-primary">Daftar</button>
        <button type="reset" class="btn btn-danger">Reset</button>
      </form>
    </div>
  </div>

  <div id="footer">

    <br><br>
    <h5 class="text-center">COPYSRIGHT Terisa Fatihah</h5>
    <br><br>

  </div>


</body>

</html>