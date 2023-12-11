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

					<li class="nav-item">
						<a class="nav-link" href="../about.php">ABOUT US</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<br><br><br><br>

	<div class="container">

		<?php
		$id_transaksi = $_GET['id_transaksi'];
		?>

		<h1 class="display-5">Detail Transaksi</h1>
		Silahkan Cetak Halaman <a href="" onclick="window.open('cetak_struk.php?id_transaksi=<?php echo $id_transaksi; ?>', 'newwindow','width=800,height=500'); 
		return false;">Ini</a> Untuk Mengingat Detail Transaksi Anda

		<hr>

		<p>Berikut Adalah Detail Pembelian Dan Pengiriman</p>

		<?php

		$query = mysqli_query($koneksi, " select *  from transaksi where id_transaksi = '$id_transaksi' order by id_transaksi desc");
		$data = mysqli_fetch_array($query);
		?>
		<div class="form-group row">
			<label for="inputEmail3" class="col-sm-2 col-form-label"><b>Status</b></label>
			<div class="col-sm-10">
				<b><?php echo $data['status']; ?></b>
			</div>
		</div>
		<hr>
		<div class="form-group row">
			<label for="inputEmail3" class="col-sm-2 col-form-label"><b>Tgl Transaksi</b></label>
			<div class="col-sm-10">
				<b><?php echo $data['tgl_transaksi']; ?></b>
			</div>
		</div>
		<hr>

		<div class="form-group row">
			<label for="inputEmail3" class="col-sm-2 col-form-label"><b>Id Transaksi</b></label>
			<div class="col-sm-10">
				<b><?php echo $data['id_transaksi']; ?></b>
			</div>
		</div>
		<hr>

		<div class="form-group row">
			<label for="inputEmail3" class="col-sm-2 col-form-label"><b>Daftar Product</b></label>
			<div class="col-sm-10">
				<table class="table table-borderless">
					<tr>
						<th class="text-center">
							Product
						</th>
						<th class="text-center">
							Harga
						</th>
						<th class="text-center">
							Qty
						</th>
						<th class="text-center">
							Subtotal
						</th>
					</tr>
					<?php
					$query_keranjang = mysqli_query($koneksi, " select *  from keranjang where id_transaksi = '$id_transaksi' order by id_keranjang desc");
					while ($keranjang = mysqli_fetch_array($query_keranjang)) { ?>

						<tr>
							<td class="text-center">
								<?php echo $keranjang['nama_product']; ?>
							</td>
							<td class="text-center">
								Rp.<?php echo number_format($keranjang['harga']); ?>
							</td>
							<td class="text-center">
								<?php echo $keranjang['qty']; ?>
							</td>
							<td class="text-center">
								Rp.<?php echo number_format($keranjang['subtotal']); ?>
							</td>
						</tr>
					<?php } ?>
				</table>

			</div>
		</div>
		<div class="form-group row">
			<label for="inputEmail3" class="col-sm-2 col-form-label"><b>Total Harga</b></label>
			<div class="col-sm-10">
				<?php
				$total_belanja = mysqli_query($koneksi, "SELECT SUM(subtotal) AS total from keranjang where id_transaksi = '$id_transaksi' ");
				$total_harga = mysqli_fetch_array($total_belanja);
				?>
				Rp.<?php echo number_format($total_harga['total']); ?>
			</div>
		</div>
		<hr>

		<?php
		$kurir =  $data['kurir'];
		$query_kurir = mysqli_query($koneksi, "SELECT*FROM kurir where nama_kurir = '$kurir' ");
		$kurir = mysqli_fetch_array($query_kurir); ?>

		<div class="form-group">
			<label for="exampleInputEmail1"><b>Informasi Pengiriman</b></label>

			<div class="form-group row">
				<label for="inputEmail3" class="col-sm-2 col-form-label"><b>Nama Penerima</b></label>
				<div class="col-sm-10">
					<?php echo $data['nama_customer']; ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputEmail3" class="col-sm-2 col-form-label"><b>Kurir</b></label>
				<div class="col-sm-10">
					<?php echo $kurir['nama_kurir']; ?>
					<br>
					Akan Diterima Sekitar : <?php echo $kurir['waktu_pengiriman']; ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputEmail3" class="col-sm-2 col-form-label"><b>No Resi</b></label>
				<div class="col-sm-10">
					<?php echo $data['no_resi']; ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="inputEmail3" class="col-sm-2 col-form-label"><b>Alamat Pengiriman</b></label>
				<div class="col-sm-10">
					<?php echo $data['alamat']; ?>
				</div>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<label for="exampleInputEmail1"><b>Informasi Pembayaran</b></label>

			<div class="form-group row">
				<label for="inputEmail3" class="col-sm-2 col-form-label">Total Harga</label>
				<div class="col-sm-10">
					Rp.<?php echo number_format($total_harga['total']); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="inputEmail3" class="col-sm-2 col-form-label">Ongkos Kirim</label>
				<div class="col-sm-10">
					Rp.<?php echo number_format($kurir['biaya_kurir']); ?>
				</div>
			</div>
			<hr>
			<div class="form-group row">
				<label for="inputEmail3" class="col-sm-2 col-form-label"><b>Total Pembayaran</b></label>
				<div class="col-sm-10">
					Rp.<?php echo number_format($data['total']); ?>
				</div>
			</div>

		</div>
		<hr>
		<?php
		$no_rek =  $data['no_rek'];

		$query_rek = mysqli_query($koneksi, "SELECT*FROM rekening where no_rek = '$no_rek' ");
		$rek = mysqli_fetch_array($query_rek);
		?>
		Silahkan Transfer sebesar Rp.<?php echo number_format($data['total']); ?> Ke Rekening Dibawah Ini:
		<br><br>

		<div class="media border p-3">
			<img src="../assets/img/<?php echo $rek['logo_bank']; ?>" alt="John Doe" class="mr-3 mt-3 rounded-circle" width="150px" height="100px">
			<div class="media-body">
				<h4><?php echo $rek['nama_bank']; ?></h4>
				<h5><?php echo $rek['no_rek']; ?></h5>
				<h5>a.n <?php echo $rek['atas_nama']; ?></h5>
			</div>
		</div>
		<br>
		Cantumkan Id Transaksi : <b><?php echo $data['id_transaksi']; ?></b> Pada Berita Transaksi

		<hr>
		<div class="form-group">
			<label for="exampleInputEmail1"><b>Upload Bukti Transaksi</b></label>


			<?php
			$query_bukti = mysqli_query($koneksi, "SELECT*FROM bukti_transaksi where id_transaksi = '$id_transaksi' ");
			$bukti = mysqli_fetch_array($query_bukti);
			?>
			<?php if ($bukti == null) { ?>

				<form action="aksi_profile.php" method="POST" enctype="multipart/form-data">
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Upload Bukti</label>
						<div class="col-sm-10">
							<input type="hidden" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>">
							<input type="file" id="gambar" name="gambar" required="required">
						</div>
					</div>
					<input type="hidden" name="aksi" value="upload_bukti">
					<button type="submit" class="btn btn-primary btn-sm">Upload</button>
				</form>
			<?php
			} else if ($bukti['status'] == 'Valid') {
			?>
				<h5 class="text-success">Pembayaran Telah Diverifikasi</h5>

			<?php

			} else if ($bukti['status'] == 'Tidak Valid') {
			?>

				<br>
				<h5 class="text-danger">Bukti Yang Telah Di Input Tidak Valid, Mohon Upload Kembali Bukti Transaksi! </h5>
				<br>

				<form action="aksi_profile.php" method="POST" enctype="multipart/form-data">
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Upload Bukti</label>
						<div class="col-sm-10">
							<input type="hidden" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>">
							<input type="file" id="gambar" name="gambar" required="required">
						</div>
					</div>
					<input type="hidden" name="aksi" value="edit_bukti">
					<button type="submit" class="btn btn-primary btn-sm">Upload</button>
				</form>


			<?php } else if ($bukti['status'] == 'Menunggu Konfirmasi') {
			?>
				<h5>Bukti Transaksi Sukses Diupload, Menunggu Verifikasi Dari Admin</h5>
			<?php } ?>
		</div>

		<br><br><br><br>


	</div>

	<div id="footer">

		<br><br>
		<h5 class="text-center">COPYSRIGHT Tarisa Fatihah</h5>
		<br><br>

	</div>

</body>

</html>