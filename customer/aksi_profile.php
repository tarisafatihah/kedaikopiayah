<?php 
include '../koneksi.php';

$aksi = $_POST['aksi'];
if($aksi == 'edit_profile'){
	session_start();
	$id_customer = $_SESSION['id_customer'];
	$nama		= $_POST['nama_customer'];
	$alamat 	= $_POST['alamat'];
	$email		= $_POST['email'];
	$password	= $_POST['password'];
	$telp   	= $_POST['telp'];

	$query = mysqli_query($koneksi,"UPDATE customer SET nama_customer = '$nama', alamat = '$alamat', email='$email', password = '$password', telp = '$telp' where id_customer = '$id_customer'");
	if($query){
		echo '<script>alert("Berhasil Edit Profile!"); document.location="profile.php";</script>';
	}else{
		echo '<script>alert("Gagal Edit Profile!"); document.location="profile.php";</script>';
	}
}else if($aksi == 'upload_bukti'){

	// ambil data file
	$namaFile = $_FILES['gambar']['name'];
	$namaSementara = $_FILES['gambar']['tmp_name'];

			// tentukan lokasi file akan dipindahkan
	$dirUpload = "../assets/bukti_transaksi/";

			// pindahkan file
	$terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);
	$id_transaksi = $_POST['id_transaksi'];

	if ($terupload) {

		$query = "INSERT INTO bukti_transaksi VALUES('','$id_transaksi','$namaFile','Menunggu Konfirmasi')";
		mysqli_query($koneksi, $query) or die ("Gagal Perintah SQL".mysqli_error($koneksi));

		$update_transaksi = "UPDATE transaksi SET status = 'Menunggu Konfirmasi' where id_transaksi='$id_transaksi' ";
		mysqli_query($koneksi, $update_transaksi) or die ("Gagal Perintah SQL".mysqli_error($koneksi));

		echo '<script>alert("Sukses Upload FIle!"); document.location="detail_transaksi.php?id_transaksi='.$id_transaksi.'";</script>';
	}else{
		echo '<script>alert("Gagal Upload File!"); document.location="detail_transaksi.php?id_transaksi='.$id_transaksi.'";</script>';
	}


}else if($aksi == 'edit_bukti'){

	// ambil data file
	$namaFile = $_FILES['gambar']['name'];
	$namaSementara = $_FILES['gambar']['tmp_name'];

			// tentukan lokasi file akan dipindahkan
	$dirUpload = "../assets/bukti_transaksi/";

			// pindahkan file
	$terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);
	$id_transaksi = $_POST['id_transaksi'];

	if ($terupload) {

		$query = "UPDATE bukti_transaksi SET bukti_transaksi = '$namaFile', status = 'Menunggu Konfirmasi' where id_transaksi = '$id_transaksi'";
		mysqli_query($koneksi, $query) or die ("Gagal Perintah SQL".mysqli_error($koneksi));

		echo '<script>alert("Sukses Upload FIle!"); document.location="detail_transaksi.php?id_transaksi='.$id_transaksi.'";</script>';
	}else{
		echo '<script>alert("Gagal Upload File!"); document.location="detail_transaksi.php?id_transaksi='.$id_transaksi.'";</script>';
	}


}


?>