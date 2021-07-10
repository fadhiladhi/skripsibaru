<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"></i>USER</h3>
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
                    <th>Nama</th>
                    <th>Username</th>
                    <th>No HP </th>
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
                    <td><?= $user['username'];?></td>
                    <td><?= $user['nohp'];?></td>
                    <td><?= $user['role'];?></td>
                    <td>
                      <div class="btn-group">
                      <a class="btn btn-edit" href="<?= base_url('dashboard/edituser/'.$user['id'])?>">edit</i></a>
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/create_user'); ?>">
      <div class="form-group">
                <div>
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div>
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" class="form-control" name="password" required>
                <div class="form-group">
                    <label for="exampleInputEmail1">No Hp</label>
                    <input type="number" class="form-control" name="nohp" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Role</label>
                    <br>
                    <select class="custom-select".id="inputGroupSelect01" name="role" require>
                        <option selected>pilih...</option>
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                <select>
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