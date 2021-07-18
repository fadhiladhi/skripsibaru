<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"></i>LIST DATA IKAN</h3>
           
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
                    <th>Gambar</th>
                    
                  </tr>

                  <?php
                    $no = 1;
                    foreach($datauser as $data  => $dataikan){
                ?>

                  <tr>
                    <td><?= $dataikan['namaikan'];?></td>
                    <td><?= $dataikan['jenisikan'];?></td>
                    <td><?= $dataikan['harga'];?></td>
                    <td><?= $dataikan['deskripsi'];?></td>
                    <td><img src="<?=base_url('uploads/'.$dataikan["img_url"]) ?>" with = "200" height="150"></td>
                    <td>
                    <a class="btn btn-success" href="<?= base_url('dashboard/create_keranjang/'.$dataikan['id'])?>">Pesan
                    
                    
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

        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Ikan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/create_dataikan'); ?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" class="form-control" name="namaikan" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">jenis ikan</label>
                <input type="text" class="form-control" name="jenisikan" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">harga</label>
                <input type="number" class="form-control" name="harga" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">deskripsi</label>
                <input type="nama" class="form-control" name="deskripsi" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">stock</label>
                <input type="number" class="form-control" name="stock" required>
            </div>
          
            <div>
            <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" name="file" id="file">
                    </label>
              </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
        <!-- page end-->
      </section>
    </section>