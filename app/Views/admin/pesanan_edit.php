<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>
 
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Pesanan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Pesanan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
 
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
            <form action="<?php echo base_url('admin/pesanan/update'); ?>" method="post">
              <div class="card">
                <div class="card-body">
                  <?php 
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
 
                  <input type="hidden" name="pesanan_id" value="<?php echo $pesanan['pesanan_id']; ?>">
                  <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" value="<?php echo $pesanan['pesanan_name']; ?>" class="form-control" name="pesanan_name" placeholder="Enter pesanan name">
                  </div>
                  <div class="form-group">
                      <label for="">Status</label>
                      <select name="kecamatan_id" class="form-control">
                        <option value="">Pilih Kategori</option>
                        <?php foreach($kecamatan as $key => $row){ ?>
                          <option value="<?= $row['kecamatan_id']?>" <?php echo $pesanan['kecamatan_id'] == $row['kecamatan_id'] ? 'selected' : '' ?>><?= $row['kecamatan_name']?></option>
                        <?php } ?>
                      </select>
                  </div>
 
                </div>
                <div class="card-footer">
                    <a href="<?php echo base_url('admin/pesanan'); ?>" class="btn btn-outline-info">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </div>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
 
</div>
<?php echo view('_partials/footer'); ?>