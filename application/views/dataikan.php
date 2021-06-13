<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>LIST DATA IKAN</h3>
            <button class="btn btn-success"   type="button" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-plus"></i>
            Tambah
            </button>
            <br><br>
<!-- DataT
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
              <li><i class="fa fa-table"></i>Master Data</li>
              <li><i class="fa fa-th-list"></i>User</li>
            </ol>
          </div>
        </div>
         page start-->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">

              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th>Namaikan</th>
                    <th>Jenisikan</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Stock</th>
                  </tr>

                  <?php
                    $no = 1;
                    foreach($datauser as $data  => $dataikan){
                ?>

                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $dataikan['namaikan'];?></td>
                    <td><?= $dataikan['jenisikan'];?></td>
                    <td><?= $dataikan['harga'];?></td>
                    <td><?= $dataikan['deskripsi'];?></td>
                    <td><?= $dataikan['stock'];?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-edit" href="<?= base_url('dashboard/edit_dataikan/'.$dataikan['id'])?>">edit</i></a>
                        <a class="btn btn-danger" href="<?= base_url('dashboard/delete_dataikan/'.$dataikan['id'])?>"><i class="icon_close_alt2"></i></a>
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

        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
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
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="kategori" required>
                    <option selected>pilih...</option>
                    <option value="minuman">ikan hias</option>
                </select>
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