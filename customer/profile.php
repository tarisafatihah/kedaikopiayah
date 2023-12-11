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

	<br><br><br><br>

	<div class="container">

		<h1 class="display-5">Profile</h1>
		<hr>
		<form method="POST" action="aksi_profile.php">

			<div class="form-group">
				<label for="exampleInputEmail1">Nama Customer</label>
				<input type="text" class="form-control" name="nama_customer" id="nama" aria-describedby="emailHelp" placeholder="Nama" required="required" value="<?php echo $cust['nama_customer']; ?>">
			</div>

			<div class="form-group">
				<label for="exampleInputPassword1">Alamat</label>
				<textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat" required="required"><?php echo $cust['alamat']; ?></textarea>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Email</label>
				<input type="email" class="form-control" name="email" id="email" placeholder="Email" required="required" value="<?php echo $cust['email']; ?>">
			</div>

			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" class="form-control" name="password" id="pass" placeholder="Password" required="required" value="<?php echo $cust['password']; ?>">
				<input type="checkbox" onclick="showPassword()"> Show Password
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">Telepon</label>
				<input type="number" class="form-control" name="telp" id="telepon" aria-describedby="emailHelp" placeholder="Nomor Telepon" required="required" value="<?php echo $cust['telp']; ?>">
			</div>


			<button type="submit" class="btn btn-primary">Edit Profile</button>
			<input type="hidden" name="aksi" value="edit_profile">
		</form>



		<hr>
		<h1 class="display-5">Riwayat Transaksi</h1>

		<?php
		$cek = mysqli_query($koneksi, "SELECT*FROM transaksi where id_customer = '$id_customer'");
		$cek_data = mysqli_num_rows($cek);
		if ($cek_data < 1) {
		?>
			<hr>
			<center>
				<img src="../assets/img/no_order.png" width="200px" height="200px">
				<br>
				<h3>Belum Ada Transaksi</h3><br>
			</center>

			<?php
		} else {

			$data = mysqli_query($koneksi, " select *  from transaksi where id_customer = '$id_customer' order by id_transaksi desc");
			while ($row = mysqli_fetch_array($data)) {

			?>

				<hr>
				<div id="detail_transaksi">
					<a href="detail_transaksi.php?id_transaksi=<?php echo $row['id_transaksi']; ?>">
						<div class="media border p-3">
							<!-- <img src="img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;"> -->
							<div class="media-body">
								<small><?php echo $row['tgl_transaksi']; ?></small>
								<h5>Rp.<?php echo number_format($row['total']); ?></h5>
								<h4 class="text-right"><?php echo $row['status']; ?></h4>
							</div>
						</div>
					</a>
				</div>
				<br>
			<?php } ?>
			<br>

		<?php } ?>

	</div>
	<br><br><br>
	<div id="footer">

		<br><br>
		<h5 class="text-center">COPYSRIGHT Tarisa Fatihah</h5>
		<br><br>

	</div>


</body>

</html>


<script type="text/javascript">
	function showPassword() {
		var x = document.getElementById("pass");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
</script>