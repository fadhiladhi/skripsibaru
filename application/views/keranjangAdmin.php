<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"></i>DATA PEMESANAN</h3>
            
           
            
            <br><br>
<!-- DataT
            
          </div>
        </div>
         page start-->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">

              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th>Nama Ikan</th>
                    <th>Jenis Ikan</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gambar</th>
                    <th>Namapemesanan</th>
                    <th>Action</th>
                  </tr>

                  <?php
                    $no = 1;
                    $total = 0;
                    foreach($datauser as $data  => $keranjang){
                    
                ?>

                  <tr>
                    <td><?= $keranjang['namaikan'];?></td>
                    <td><?= $keranjang['jenisikan'];?></td>
                    <td><?= $keranjang['harga']; $total = $total + $keranjang['harga'];?></td>
                    <td><?= $keranjang['deskripsi'];?></td>
                    <td><img src="<?=base_url('uploads/'.$keranjang["img_url"]) ?>" with = "200" height="150" ></td>
                    <td><?= $keranjang['namapemesanan'];?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-danger" href="<?= base_url('dashboard/delete_keranjang/'.$keranjang['id'])?>"><i class="icon_close_alt2"></i></a>
                    </div>
                    </td>
                    
                  </tr>
                <?php
                      
                $no++;
                }
                ?>
                </tbody>
              </table>
            </section>
          </div>
        </div>

   
        <!-- page end-->
      </section>
    </section>