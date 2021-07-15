<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"></i>DATA PENJUALAN</h3>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit Data penjualan</h1>
<!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/proses_edit_datapenjualan/'.$datamenu[0]['id']); ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pembeli</label>
                    <input type="text" class="form-control" name="namapenerima" value="<?= set_value('namapenerima',$datamenu[0]['namapenerima']) ?> "required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Barang</label>
                    <input type="text" class="form-control" name="namaikan" value="<?= set_value('namaikan',$datamenu[0]['namaikan']) ?> "required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Harga</label>
                    <input type="number" class="form-control" name="harga" value="<?= $datamenu[0]['harga']; ?>"required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Pengirim</label>
                    <input type="date" class="form-control" name="tglpengiriman" value="<?= $datamenu[0]['tglpengiriman']; ?>"required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jasa Pengirim</label>
                    <input type="text" class="form-control" name="jasapengiriman" value="<?= set_value('jasapengiriman',$datamenu[0]['jasapengiriman']) ?> "required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan" value="<?= set_value('keterangan',$datamenu[0]['keterangan']) ?> "required>
                </div>


                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </form>
        </div>
    </div>

</div>