	<?php 
	include '../koneksi.php';
	session_start();

	$id_customer = $_SESSION['id_customer'];

	$sql = "SELECT id_transaksi as maxid FROM transaksi order by id_transaksi desc";
	$hasil = mysqli_query($koneksi,$sql);
	$data  = mysqli_fetch_array($hasil);
	$id_trans = $data['maxid'];
	$noUrut = (int) substr($id_trans, 6);
	$noUrut++;

	$char = "trans_";
	$newID = $char . $noUrut;

	$nama = $_POST['nama_customer'];
	$telp = $_POST['telp'];
	$catatan_pembelian = $_POST['catatan_pembelian'];
	$alamat = $_POST['alamat'];
	$total = $_POST['total'];
	$no_rek = $_POST['no_rek'];
	$kurir = $_POST['kurir'];
	$q_kurir = mysqli_query($koneksi,"SELECT*FROM kurir WHERE nama_kurir = '$kurir'"); 
	$data_kurir = mysqli_fetch_array($q_kurir);

	$total = $total + $data_kurir['biaya_kurir'];

	date_default_timezone_set('Asia/Jakarta');
	$tgl = date("d M Y h:i");


	$query = mysqli_query($koneksi,"INSERT INTO transaksi values('$newID','$id_customer','$nama','$telp','$catatan_pembelian','$alamat','$total','$no_rek','$kurir','Belum Dikirim','$tgl','Menunggu Pembayaran')");

	$data = mysqli_query ($koneksi, " select *  from keranjang where id_customer = '$id_customer' && id_transaksi = 'Belum Ada Transaksi' order by id_keranjang desc");
	while ($keranjang = mysqli_fetch_array ($data))
	{

		$update_stok =  mysqli_query ($koneksi,"UPDATE product SET stok = stok - '".$keranjang['qty']."' where id_product = '".$keranjang['id_product']."'" );

		$update_keranjang =  mysqli_query ($koneksi,"UPDATE keranjang SET id_transaksi = '$newID' where id_transaksi = 'Belum Ada Transaksi' AND id_customer = '$id_customer'" );
	}
	if ($query&&$update_stok) {

		echo "<script>window.open('cetak_struk.php', 'new window','width=800,height=500'); return false;</script>";
		echo '<script>alert("Transaksi Telah Di Proses!"); document.location="detail_transaksi.php?id_transaksi='.$newID.'";</script>';


	}else{

		echo '<script>alert("Error Mohon Coba Lagi!"); document.location="checkout.php";</script>';

	}

	?>