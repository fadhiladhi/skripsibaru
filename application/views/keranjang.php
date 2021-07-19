<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"></i>DATA PEMESANAN</h3>
        
           <?php $namaikan; ?>
            <a class="btn btn-success" href="<?= 
            'https://web.whatsapp.com/send?phone=6281310590699&text=Assalamaualaikum
            %0ausername : '.$user.
            '%0aingin membeli ikan anda dengan data diri sebagai berikut: 
            %0a
            %0aNama :
            %0aalamat :
            %0aNo Telpon :
            %0a Jenis Cupang : 
          
            
            %0a%0a Untuk Pembayaran saya akan transfer ke BANK BCA :
            %0aNo Rek : 123456
            %0aA/N : Ahmad Fadhil 
            %0a%0a Saya akan transfer dan mengirim foto bukti pembayaran sesuai jumlah di alamat website dengan note : nama username saya 
            '
            
            ?>">Pesan WA</a>
         
            <br><br>
<!-- DataT
            
          </div>
        </div>
         page start-->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">

              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th>Nama Ikan</th>
                    <th>Jenis Ikan</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gambar</th>
                    <th>Namapemesanan</th>
                  </tr>

                  <?php
                    $no = 1;
                    $total = 0;
                    foreach($datauser as $data  => $keranjang){
                     
                      
                ?>

                  <tr>
                    <?php if($keranjang['namapemesanan'] == $user){ ?> 
                    <td><?= $keranjang['namaikan'];
                    $namaikan = $keranjang['namaikan'];
                    ?></td>
                    <td><?= $keranjang['jenisikan'];?></td>
                    <td><?= $keranjang['harga']; $total = $total + $keranjang['harga'];?></td>
                    <td><?= $keranjang['deskripsi'];?></td>
                    <td><img src="<?=base_url('uploads/'.$keranjang["img_url"]) ?>" with = "200" height="150" ></td>
                    <td><?= $keranjang['namapemesanan'];?></td>
                    <td>
                      <div class="btn-group">
                        
                    </div>
                    </td>
                    
                  </tr>
                <?php
                    
                    }
                $no++;
                }
                ?>
                </tbody>
              </table>
            </section>
            <h4><b>Total : <?= $total; ?></b></h4>
          </div>
        </div>

   
        <!-- page end-->
      </section>
    </section>