<?php
include 'koneksi.php';
session_start();
// menangkap data yang dikirim dari form
$email = $_POST['email'];
$password = $_POST['password'];
 
// menyeleksi data customer dengan email dan password yang sesuai
$data = mysqli_query($koneksi,"select * from customer where email='$email' and password='$password'");
// menghitung jumlah data yang ditemukan
$data1 = mysqli_fetch_array($data);
$id_customer = $data1['id_customer'];
$cek = mysqli_num_rows($data);
 
if($cek > 0){
	
	$_SESSION['id_customer'] = $id_customer;

		
	echo '<script>alert("Login Sukes!"); document.location="index.php";</script>';

} else {
	
	echo '<script>alert("Login Gagal!");  document.location="login.php"</script>';
	
}

?>