<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"></i>DATA PENJUALAN</h3>
            <button class="btn btn-success"   type="button" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-plus"></i>
            Tambah
            </button>
            
          </div>
        </div>
        <!-- page start-->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">

              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                  <th>Nama Penerima</th>
                    <th>Nama Ikan</th>
                    <th>Harga</th>
                    <th>Tanggal Pengiriman</th>
                    <th>Jasa Pengiriman</th>
                    <th>Keterangan</th>
                    
                  </tr>

                  <?php
                    $no = 1;
                    foreach($datauser as $data  => $datapenjualan){
                ?>

                  <tr>
                    <td><?= $datapenjualan['namapenerima'];?></td>
                    <td><?= $datapenjualan['namaikan'];?></td>
                    <td><?= $datapenjualan['harga'];?></td>
                    <td><?= $datapenjualan['tglpengiriman'];?></td>
                    <td><?= $datapenjualan['jasapengiriman'];?></td>
                    <td><?= $datapenjualan['keterangan'];?></td>
                    
                    <td>
                      <div class="btn-group">
                      <a class="btn btn-edit" href="<?= base_url('dashboard/edit_penjualan/'.$datapenjualan['id'])?>">edit</i></a>
                        <a class="btn btn-danger" href="<?= base_url('dashboard/delete_datapenjualan/'.$datapenjualan['id'])?>"><i class="icon_close_alt2"></i></a>
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

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/create_datapenjualan'); ?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Penerima</label>
                <input type="text" class="form-control" name="namapenerima" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Ikan</label>
                <input type="text" class="form-control" name="namaikan" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Harga</label>
                <input type="number" class="form-control" name="harga" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tanggal pengiriman</label>
                <input type="date" class="form-control" name="tglpengiriman" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jasa Pengiriman</label>
                <input type="text" class="form-control" name="jasapengiriman" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Keterangan</label>
                <input type="text" class="form-control" name="keterangan" required>
            </div>
            <div class="input-group mb-3">
          
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
    
