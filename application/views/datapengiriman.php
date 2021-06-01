<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>LIST PENGIRIMAN</h3>
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
                    <th>Tanggal pemesanan</th>
                    <th>Tanggal Pengiriman</th>
                    <th>Jasa Pengiriman</th>
                    <th>Nama Penerima</th>
                    <th>ID user</th>
                  </tr>

                  <?php
                    $no = 1;
                    foreach($datauser as $data  => $datapengiriman){
                ?>

                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $datapengiriman['tglpemesanan'];?></td>
                    <td><?= $datapengiriman['tglpengiriman'];?></td>
                    <td><?= $datapengiriman['jasapengiriman'];?></td>
                    <td><?= $datapengiriman['namapenerima'];?></td>
                    <td><?= $datapengiriman['iduser'];?></td>
                    <td>
                      <div class="btn-group">
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
        <!-- page end-->
      </section>
    </section>