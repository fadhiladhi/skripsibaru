<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>LIST DATA IKAN</h3>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit Data Ikan</h1>
<!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/proses_edit_dataikan/'.$datamenu[0]['id']); ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">jenisikan</label>
                    <input type="text" class="form-control" name="jenisikan" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">harga</label>
                    <input type="number" class="form-control" name="harga" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">deskripsi</label>
                    <input type="text" class="form-control" name="deskripsi" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">stock</label>
                    <input type="number" class="form-control" name="stock" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="kategori"  required>
                        <option selected ></option>
                        <option value="makanan">ikan hias</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Gambar</label>
                    <input type="file" class="form-control" name="image">
                </div>


                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </form>
        </div>
    </div>

</div>