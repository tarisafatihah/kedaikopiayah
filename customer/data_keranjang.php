 <table class="table table-bordered">
        <tr>
          <th class="text-center">
             
          </th>
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
          <th class="text-center">
            Opsi
          </th>
        </tr>
        <?php
        include"../koneksi.php";
        session_start();
        error_reporting(0);
        $id_customer = $_SESSION['id_customer'];
        $no = 1;
        $data = mysqli_query ($koneksi, " select *  from keranjang where id_customer = '$id_customer' && id_transaksi = 'Belum Ada Transaksi' order by id_keranjang desc");
        while ($row = mysqli_fetch_array ($data))
        {

          $product = mysqli_query ($koneksi, " select *  from product where id_product = '".$row['id_product']."' ");
          $row_product = mysqli_fetch_array ($product);
          ?>
          <tr>
            <td class="text-center">
              <img src="../assets/product/<?php echo $row_product['gambar']; ?>" width="100px" height="100px">
            </td>
           <td class="text-center">
              <?php echo $row['nama_product']; ?>
            </td>
            <td class="text-center">
              Rp.<?php echo number_format($row['harga']);  ?>
            </td>
            <td class="text-center">
              <?php echo $row['qty']; ?>
            </td>
            <td class="text-center">
              Rp.<?php echo number_format($row['subtotal']); ?>
            </td>
            <td class="text-center">
            <a href="#" class="btn btn-primary" id="edit" data-id="<?php echo $row['id_keranjang']; ?>"><span class="fa fa-edit fa-fw"></span></a> |
            <button type="button" id="confirm_delete" class="btn btn-danger" data-id="<?php echo $row['id_keranjang']; ?>"><span class="fa fa-close fa-fw"></span></button>
            </td>
          </tr>
          <?php
          $total += $row['subtotal'];
        }
        ?>
        <tr>
          <td colspan="4" class="text-right"> Total Belanja</td>
          <td colspan="2">
            Rp.<?php echo number_format($total); ?>
          </td>
        </tr>
      </table>