<?php 
include '../koneksi.php';

	$aksi = $_POST['aksi'];
	if ($aksi == 'update'){

			$id_keranjang = $_POST['id_keranjang'];
			$id_product   = $_POST['id_product'];
			$qty 		  = $_POST['qty'];
			$harga 		  = $_POST['harga'];


			$cek	 = mysqli_query($koneksi,"SELECT*FROM product where id_product = '$id_product'");
			$product = mysqli_fetch_array($cek);

			$subtotal = $qty * $product['harga'];

			$query = "UPDATE keranjang SET qty = '$qty', subtotal = '$subtotal' where id_keranjang = '$id_keranjang'";
			 mysqli_query($koneksi, $query)
			or die ("Gagal Perintah SQL".mysql_error());
	
			
	}else {

			$id = $_POST['id'];
			$query = "DELETE FROM keranjang WHERE id_keranjang ='$id'";
			mysqli_query($koneksi, $query) or die ("Gagal Perintah SQL".mysql_error());
	}



 ?>
