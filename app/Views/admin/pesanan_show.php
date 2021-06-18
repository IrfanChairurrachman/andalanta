<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>
 
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
              <a href="<?php echo base_url('admin/pesanan'); ?>" class="btn btn-outline-info float-right">Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo view('_partials/footer'); ?>