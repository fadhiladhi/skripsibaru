<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>LIST USER</h3>
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
        <!-- page end-->
      </section>
    </section>