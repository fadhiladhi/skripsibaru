

<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"></i>DATA IKAN</h3>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit Data Ikan</h1>
<!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/proses_edit_dataikan/'.$datamenu[0]['id']); ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Ikan</label>
                    <input type="text" class="form-control" name="namaikan" value="<?= set_value('namaikan',$datamenu[0]['namaikan']) ?> "required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">jenis Ikan</label>
                    <input type="text" class="form-control" name="jenisikan" value="<?= set_value('jenisikan',$datamenu[0]['jenisikan']) ?> "required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">harga</label>
                    <input type="number" class="form-control" name="harga" value=<?= $datamenu[0]['harga']; ?> required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">deskripsi</label>
                    <input type="text" class="form-control" name="deskripsi" value="<?= set_value('deskripsi',$datamenu[0]['deskripsi']) ?> "required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">stock</label>
                    <input type="number" class="form-control" name="stock" value=<?= $datamenu[0]['stock']; ?> required>
                </div>
                <div class="input-group mb-3">
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