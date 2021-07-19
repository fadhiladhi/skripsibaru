<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"></i>DATA PENGIRIMAN</h3>
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
                    <th>No</th>
                    <th>Nama Pemesanan</th>
                    <th>Jasa Pengiriman</th>
                    <th>No Resi</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Status</th>
                    <th>Action</th>
                    
                  </tr>

                  <?php
                    $no = 1;
                    foreach($datauser as $data  => $datapengiriman){
                ?>

                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $datapengiriman['namapenerima'];?></td>
                    <td><?= $datapengiriman['jasapengiriman'];?></td>
                    <td><?= $datapengiriman['noresi'];?></td>
                    <td><?= $datapengiriman['tglpemesanan'];?></td>
                    <td><?= $datapengiriman['status'];?></td>
                    
                    <td>
                      <?php if($datapengiriman['status']=='proses'){?>
                      <div class="btn-group">
                      <a class="btn btn-success" href="<?= base_url('dashboard/proses_check_datapengiriman/'.$datapengiriman['id'])?>"><i class="icon_check"></i></a>
                      <?php }?>
                      <a class="btn btn-warning" href="<?= base_url('dashboard/edit_pengiriman/'.$datapengiriman['id'])?>"><i class="icon_pencil"></i></a>
                        <a class="btn btn-danger" href="<?= base_url('dashboard/delete_datapengiriman/'.$datapengiriman['id'])?>"><i class="icon_close_alt2"></i></a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengiriman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/create_datapengiriman'); ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Pemesanan</label>
                    <input type="date" class="form-control" name="tglpemesanan" required>
                </div>
               
                <div class="form-group">
                    <label for="exampleInputEmail1">Jasa Pengiriman</label>
                    <input type="text" class="form-control" name="jasapengiriman" required>
                    <p style="color:red"> jika dalam tahap proses dan dalam proses pengemasan, isi dengan ( - )</p>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">No Resi</label>
                    <input type="text" class="form-control" name="noresi" required>
                    <p style="color:red"> jika dalam tahap proses dan dalam proses pengemasan, isi dengan ( 0 )</p>
                   
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pemesanan</label>
                    <input type="text" class="form-control" name="namapenerima" required>
                </div>



                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </form>
      </div>
    </div>
  </div>
</div>

        <!-- page end-->
      </section>
    </section>