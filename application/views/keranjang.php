<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"></i>KERANJANG</h3>
            <h4>Total : <?= $datatotal[0]['total']?></h4>
            <a href="" class="btn btn-success">Pesan</a>
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
                    <th>Stock</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gambar</th>
                    <th>Namapemesanan</th>
                  </tr>

                  <?php
                    $no = 1;
                    foreach($datauser as $data  => $keranjang){
                ?>

                  <tr>
                    <td><?= $keranjang['namaikan'];?></td>
                    <td><?= $keranjang['jenisikan'];?></td>
                    <td><?= $keranjang['harga'];?></td>
                    <td><?= $keranjang['deskripsi'];?></td>
                    <td><?= $keranjang['stock'];?></td>
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