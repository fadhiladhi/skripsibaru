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
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>

                  <?php
                    $no = 1;
                    foreach($datauser as $data  => $user){
                ?>

                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $user['nama'];?></td>
                    <td><?= $user['alamat'];?></td>
                    <td><?= $user['email'];?></td>
                    <td><?= $user['nohp'];?></td>
                    <td><?= $user['role'];?></td>
                    <td><?= $user['username'];?></td>
                    <td>
                      <div class="btn-group">
                      <a class="btn btn-edit" href="<?= base_url('dashboard/edit_user/'.$user['id'])?>">edit</i></a>
                        <a class="btn btn-danger" href="<?= base_url('dashboard/delete_user/'.$user['id'])?>"><i class="icon_close_alt2"></i></a>
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