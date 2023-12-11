                      
                      <div class="row about-us">
                            <?php 

                             include 'koneksi.php';

                                $action = $_REQUEST['action'];


                               if($action == "show-all"){

                               $query =  mysqli_query($koneksi,'SELECT * FROM product order by id_product DESC');
      
                                }
                               else{

                               $query =  mysqli_query($koneksi,"SELECT * FROM product WHERE kategori ='$action' order by id_product DESC");
     
                                }
                             while ($data = mysqli_fetch_array($query)) {
                              
                             ?>

                            <div class="col-md-3">
                            <br>
                              <div class="card">
                                   <a href="detail_product.php?id_product=<?php echo $data['id_product']; ?>" title="<?php echo $data['nama_product']; ?>">
                                    <img src="assets/product/<?php echo $data['gambar']; ?>" class="card-img-top" alt="Card image cap" height="300px">
                                    <div class="card-body">
                                      <h5 class="card-title text-center"><?php echo $data['nama_product']; ?></h5>
                                      </a>
                                      <a href="detail_product.php?id_product=<?php echo $data['id_product']; ?>" class="btn btn-primary btn-block"> Beli</a>
                                    </div>
                              </div>
                            </div>

                            <?php } ?>
                      </div>