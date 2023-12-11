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
					<li class="nav-item active">
						<a class="nav-link" href="../index.php">HOME
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
								<a class="dropdown-item" href="profile.php">Profile</a>
								<a class="dropdown-item" href="Keranjang.php">Keranjang</a>
								<a class="dropdown-item" href="logout.php">Logout</a>
							</div>
						</li>
					<?php } ?>
					<li class="nav-item">
						<a class="nav-link" href="../about.php">ABOUT US</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<br><br><br><br>

	<div class="container">

		<h1 class="display-5">Checkout</h1>
		<hr>
		<form method="POST" action="aksi_checkout.php">

			<div class="form-group">
				<label for="exampleInputEmail1">Nama Penerima</label>
				<input type="text" class="form-control" name="nama_customer" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama" required="required" value="<?php echo $cust['nama_customer']; ?>">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">Telepon</label>
				<input type="number" class="form-control" name="telp" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nomor Telepon" required="required" value="<?php echo $cust['telp']; ?>">
			</div>

			<div class="form-group">
				<label for="exampleInputPassword1">Catatan Pembelian</label>
				<textarea class="form-control" name="catatan_pembelian" id="exampleInputEmail1" aria-describedby="catatan_pembelian" placeholder="Catatan Pembelian" required="required"></textarea>
			</div>

			<div class="form-group">
				<label for="exampleInputPassword1">Alamat</label>
				<textarea class="form-control" name="alamat" id="exampleInputPassword1" placeholder="Password" required="required"><?php echo $cust['alamat']; ?></textarea>
			</div>

			<div class="form-group">
				<label>Total Pembayaran</label>
				<br>
				<?php
				$keranjang = mysqli_query($koneksi, "SELECT SUM(subtotal) AS total from keranjang where id_customer = '$id_customer' AND id_transaksi = 'Belum Ada Transaksi' ");
				$total_belanja = mysqli_fetch_array($keranjang);
				?>
				<h5>Rp.<?php echo $total_belanja['total']; ?></h5>
				<input type="hidden" name="total" value="<?php echo $total_belanja['total']; ?>">

			</div>

			<div class="form-group">
				<label>Pilih Bank</label>

				<div class="radio">

					<?php
					$q_rekening = mysqli_query($koneksi, "SELECT*FROM rekening");
					while ($data_rek = mysqli_fetch_array($q_rekening)) {
					?>
						<label><input type="radio" name="no_rek" value="<?php echo $data_rek['no_rek']; ?>" required="required">
							<img src="../assets/img/<?php echo $data_rek['logo_bank']; ?>" width="70px" height="50px">
							<?php echo $data_rek['nama_bank']; ?></label><br>
					<?php } ?>

				</div>

			</div>

			<div class="form-group">
				<label>Pilih Kurir</label>

				<div class="radio">

					<?php
					$q_kurir = mysqli_query($koneksi, "SELECT*FROM kurir");
					while ($data_kurir = mysqli_fetch_array($q_kurir)) {
					?>
						<label><input type="radio" name="kurir" value="<?php echo $data_kurir['nama_kurir']; ?>" required="required">
							<?php echo $data_kurir['nama_kurir']; ?><br>
							Rp.<?php echo $data_kurir['biaya_kurir']; ?><br>
							Akan Diterima Sekitar : <?php echo $data_kurir['waktu_pengiriman']; ?></label><br>
					<?php } ?>

				</div>

			</div>

			<button type="submit" class="btn btn-primary">Submit</button>
			<button type="reset" class="btn btn-danger">Reset</button>
		</form>


		<br><br><br><br>


	</div>

	<div id="footer">

		<br><br>
		<h5 class="text-center">COPYSRIGHT Tarisa Fatihah</h5>
		<br><br>

	</div>


</body>

</html>