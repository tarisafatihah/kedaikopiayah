<?php
include 'koneksi.php';

$sql = "SELECT id_customer as maxid FROM customer order by id_customer desc";
$hasil = mysqli_query($koneksi,$sql);
$data  = mysqli_fetch_array($hasil);
$id_user = $data['maxid'];
$noUrut = (int) substr($id_user, 9);
$noUrut++;

$char = "Customer_";
$newID = $char . $noUrut;

$nama		= $_POST['nama'];
$alamat 	= $_POST['alamat'];
$email		= $_POST['email'];
$password	= $_POST['password'];
$telp   	= $_POST['telp'];

$cek = mysqli_query($koneksi, "SELECT * FROM customer WHERE email = '$email'") or die(mysqli_error($koneksi));

if(mysqli_num_rows($cek) == 0){
    $sql = mysqli_query($koneksi, "INSERT INTO customer VALUES('$newID','$nama','$alamat','$email','$password','$telp')") or die(mysqli_error($koneksi));
    
    if($sql){
        echo '<script>alert("Berhasil Register!"); document.location="register.php";</script>';
    }else{
        echo '<script>alert("Gagal Register!"); document.location="register.php";</script>';
    }
}else{
    echo '<script>alert("email Telah Terregister!"); document.location="register.php";</script>';
}
?>