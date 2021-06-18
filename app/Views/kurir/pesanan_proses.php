<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar_kurir'); ?>
 
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Lihat Feedback</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active">Show Feedback</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
 
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <dl class="dl-horizontal">
                    <dt>Nama</dt>
                    <dd><?php echo $pesanan['pesanan_name'];?></dd>
                    <dt>Toko</dt>
                    <dd><?php echo $pesanan['pesanan_toko'];?></dd>
                    <dt>Alamat</dt>
                    <dd><?php echo $pesanan['pesanan_alamat'];?></dd>       
                    <dt>Kecamatan</dt>
                    <dd><?php echo $pesanan['kecamatan_name'];?></dd>             
                  </dl>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="<?php echo base_url('kurir'); ?>" class="btn btn-outline-info float-right">Back</a>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card">
          <form class="form form-vertical" method="POST" action="<?php echo base_url('kurir/barang/store'); ?>">
          <input type="hidden" name="barang_kode" value="<?php echo $kurir['kode']; ?>">
          <input type="hidden" name="pesanan_id" value="<?php echo $pesanan['pesanan_id']; ?>">
            <div class="card-body">
                  <?php 
                    $inputs = session()->getFlashdata('inputs');
                    $errors = session()->getFlashdata('errors');
                    if(!empty($errors)){ ?>
                    <div class="alert alert-danger" role="alert">
                      Whoops! Ada kesalahan saat input data, yaitu:
                      <ul>
                        <?php foreach ($errors as $error) : ?>
                          <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                      </ul>
                      </div>
                    <?php } ?>
 
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" class="form-control" name="barang_name" placeholder="Masukkan Nama Barang">
                    </div>
                    <div class="form-group">
                      <label for="">Harga Barang</label>
                      <input type="text" class="form-control" name="barang_harga" placeholder="Masukkan Harga Barang">
                    </div>
                    <div class="form-group">
                      <label for="">Ongkir</label>
                      <input type="text" class="form-control" name="barang_ongkir" placeholder="Masukkan Ongkir Barang">
                    </div>
                    <div class="form-group">
                      <label for="">Kecamatan</label>
                      <select name="kecamatan_id" id="" class="form-control">
                          <option value="">Pilih Kecamatan Tujuan</option>
                          <?php foreach($kecamatan as $key => $row){ ?>
                              <option value="<?= $row['kecamatan_id']?>"><?= $row['kecamatan_name']?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </form>
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <p>Daftar Barang</p>
                  <table class="table table-striped" id="table1">
                      <thead>
                          <tr>
                              <td>Kode</td>
                              <td>Nama</td>
                              <td>Ongkir</td>
                              <td>Kecamatan</td>
                          </tr>
                      </thead>
                      <tbody>
                          <?php foreach($barang as $key => $row){ ?>
                              <tr>
                                  <td><?= $row['barang_kode']?></td>
                                  <td><?= $row['barang_name']?></td>
                                  <td><?= $row['barang_ongkir']?></td>
                                  <td><?= $row['kecamatan_id']?></td>
                              </tr>
                          <?php } ?>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
<?php echo view('_partials/footer'); ?>