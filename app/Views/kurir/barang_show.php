<?= $this->extend('layouts/app_kurir') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="navbar-brand ms-4">Barang Detail</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('kurir'); ?>">Kurir</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('kurir/barang'); ?>">Barang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <div class="card">
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
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <dl class="dl-horizontal">
                                    <dt>Resi</dt>
                                    <dd><?php echo $barang['pesanan_resi'];?></dd>
                                    <dt>Kode</dt>
                                    <dd><?php echo $barang['barang_kode'];?></dd>
                                    <dt>Nama</dt>
                                    <dd><?php echo $barang['barang_name'];?></dd>
                                    <dt>Harga</dt>
                                    <dd><?php echo $barang['barang_harga'];?></dd>
                                    <dt>Ongkir</dt>
                                    <dd><?php echo $barang['barang_ongkir'];?></dd>       
                                    <dt>Kecamatan</dt>
                                    <dd><?php echo $barang['kecamatan_name'];?></dd>
                                </dl>
                            </div>
                            <form action="<?php echo base_url('kurir/barang/update'); ?>" method="POST" class="form">
                            <input type="hidden" name="barang_id" value="<?= $barang['barang_id']?>">
                            <input type="hidden" name="pesanan_id" value="<?= $barang['pesanan_id']?>">
                            <div class="form-body">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="barang_status" id="" class="form-control">
                                            <option value="">Pilih Status Barang</option>
                                            <option value="Terjemput" <?php echo $barang['barang_status'] == "Terjemput" ? 'selected' : '' ?>>Terjemput</option>
                                            <option value="Antar" <?php echo $barang['barang_status'] == "Antar" ? 'selected' : '' ?>>Antar</option>
                                            <option value="Sukses" <?php echo $barang['barang_status'] == "Sukses" ? 'selected' : '' ?>>Sukses</option>
                                            <option value="Tunda" <?php echo $barang['barang_status'] == "Tunda" ? 'selected' : '' ?>>Tunda</option>
                                            <option value="Cancel" <?php echo $barang['barang_status'] == "Cancel" ? 'selected' : '' ?>>Cancel</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text" value="<?= $barang['barang_keterangan'] ?>" class="form-control" name="barang_keterangan" placeholder="Masukkan Keterangan Barang">
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1" onclick="return confirm('Apakah Anda yakin mengubah status barang ini?');">Submit</button>
                                    <button type="reset"
                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo base_url('kurir/barang'); ?>" class="btn btn-outline-info float-right">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/vendors/simple-datatables/style.css')?>">
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="<?= base_url('assets/vendors/simple-datatables/simple-datatables.js')?>"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>
<?= $this->endSection() ?>
