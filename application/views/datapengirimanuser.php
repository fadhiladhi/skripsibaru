<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"></i>DATA PENGIRIMAN</h3>
            
          </div>
        </div>
        <!-- page start-->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">

              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                  <th>No</th>
                    <th>Nama Pemesanan</th>
                    <th>Jasa Pemesanan</th>
                    <th>No Resi</th>
                    <th>Tanggal Pemesanan</th>
                    <th>status</th>
                    
                  </tr>
            
                  <?php
                    $no = 1;
                    foreach($datauser as $data  => $datapengiriman){
                      if($iduser == $datapengiriman['namapenerima']){
                ?>

                  <tr>
                  <td><?= $no; ?></td>
                    <td><?= $datapengiriman['namapenerima'];?></td>
                    <td><?= $datapengiriman['jasapengiriman'];?></td>
                    <td><?= $datapengiriman['noresi'];?></td>
                    <td><?= $datapengiriman['tglpemesanan'];?></td>
                    <td><?= $datapengiriman['status'];?></td>
                    <?php if($datapengiriman['status']=='pengiriman'){?>
                     <td> <div class="btn-group">
                      <a class="btn btn-success" href="<?= base_url('dashboard/proses_check_datapengirimanuser/'.$datapengiriman['id'])?>"><i class="icon_check"></i></a>
                    </td>
                      <?php }?>
                    
                  </tr>
                <?php
                      }
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/create_datapengiriman'); ?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Pemesanan</label>
                <input type="text" class="form-control" name="tglpemesanan" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Pengiriman</label>
                <input type="text" class="form-control" name="tglpengiriman" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jasa Pengiriman</label>
                <input type="text" class="form-control" name="jasapengiriman" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Penerima</label>
                <input type="nama" class="form-control" name="namapenerima" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Id user</label>
                <input type="nama" class="form-control" name="iduser" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">stock</label>
                <input type="number" class="form-control" name="stock" required>
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