<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"></i>DATA PENGIRIMAN</h3>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit Data Pengiriman</h1>
<!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/proses_edit_datapengiriman/'.$datamenu[0]['id']); ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Pemesanan</label>
                    <input type="text" class="form-control" name="tglpemesanan" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Pengiriman</label>
                    <input type="text" class="form-control" name="tglpengiriman" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Ikan</label>
                    <input type="text" class="form-control" name="namaikan" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jasa Pengiriman</label>
                    <input type="text" class="form-control" name="jasapengiriman" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pengirima</label>
                    <input type="text" class="form-control" name="namapenerima" required>
                </div>



                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </form>
        </div>
    </div>

</div>