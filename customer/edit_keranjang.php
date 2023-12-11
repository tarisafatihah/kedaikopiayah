
    <?php
        include"../koneksi.php";
        $no = 1;
        $id = $_POST['id'];
        $data = mysqli_query($koneksi, " select*from keranjang where id_keranjang = '$id'");
        $row = mysqli_fetch_array($data);

        $id_product = $row['id_product'];
        $query_product = mysqli_query($koneksi,"select*from product where id_product = '$id_product'");
        $product = mysqli_fetch_array($query_product);
    ?>
                <form role="form" id="form-edit" method="post" action="aksi_keranjang.php">
       
                <input type="hidden" name="id_keranjang" value="<?php echo $row['id_keranjang']; ?>">

                <input type="hidden" name="id_product" value="<?php echo $row['id_product']; ?>">
       
                <input type="hidden" name="aksi" value="update">
             
                <div class="form-group">
                     <label>Nama Product</label>
                     <input class="form-control" id="keranjang" name="nama"  required="required" value="<?php echo $row['nama_product']; ?>" disabled>
                </div>
                <div class="form-group">
                     <label>Harga</label>
                     <input type="number" class="form-control" id="keranjang" name="harga"  required="required" value="<?php echo $row['harga']; ?>" disabled>
                </div>
                <div class="form-group">
                     <label>Qty</label>
                     <input type="number" class="form-control" id="keranjang" name="qty"  required="required" value="<?php echo $row['qty']; ?>" min="0" max="<?php echo $product['stok']; ?>">
                </div>
            
        </form>