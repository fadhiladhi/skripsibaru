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
                    <input type="date" class="form-control" name="tglpemesanan" value="<?= $datamenu[0]['tglpemesanan']; ?>"required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">No Resi</label>
                    <input type="number" class="form-control" name="noresi" value=<?= $datamenu[0]['noresi']; ?> required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jasa Pengiriman</label>
                    <input type="text" class="form-control" name="jasapengiriman" value="<?= set_value('jasapengiriman',$datamenu[0]['jasapengiriman']) ?> "required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pengirima</label>
                    <input type="text" class="form-control" name="namapenerima" value="<?= set_value('namapenerima',$datamenu[0]['namapenerima']) ?> "required>
                </div>



                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </form>
        </div>
    </div>

</div>