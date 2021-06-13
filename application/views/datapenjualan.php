<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>LIST PENJUALAN</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
              <li><i class="fa fa-table"></i>Master Data</li>
              <li><i class="fa fa-th-list"></i>User</li>
            </ol>
          </div>
        </div>
        <!-- page start-->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">

              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th>ID user</th>
                    <th>Tanggal Penjualan</th>
                    <th>Keterangan</th>
                    
                  </tr>

                  <?php
                    $no = 1;
                    foreach($datauser as $data  => $datapenjualan){
                ?>

                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $datapenjualan['iduser'];?></td>
                    <td><?= $datapenjualan['tglpenjualan'];?></td>
                    <td><?= $datapenjualan['keterangan'];?></td>
                    
                    <td>
                      <div class="btn-group">
                      <a class="btn btn-edit" href="<?= base_url('dashboard/edit_datapejualan/'.$datapenjualan['id'])?>">edit</i></a>
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
        <!-- page end-->
      </section>
    </section>
    
