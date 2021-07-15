<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"></i>EDIT USER</h3>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit User</h1>
<!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/proses_edit_user/'.$datamenu[0]['id']); ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?= set_value('nama',$datamenu[0]['nama']) ?> "required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" name="username" value="<?= set_value('username',$datamenu[0]['username']) ?> " required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="text" class="form-control" name="password" required>
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
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </form>
        </div>
    </div>

</div>