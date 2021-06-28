<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="navbar-brand ms-4">Edit Barang</h3>
            </nav>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/barang'); ?>">Barang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
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
                        <form class="form form-vertical" method="POST" action="<?php echo base_url('admin/barang/update'); ?>">
                            <div class="card-body">
                                <form class="form form-vertical">
                                <input type="hidden" name="barang_id" value="<?php echo $barang['barang_id']; ?>">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                <label for="">Resi</label>
                                                <input type="text" value="<?php echo $barang['pesanan_resi']; ?>" class="form-control" name="pesanan_resi" placeholder="Masukkan Resi Barang" disabled>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                <label for="">Kode</label>
                                                <input type="text" value="<?php echo $barang['barang_kode']; ?>" class="form-control" name="barang_kode" placeholder="Masukkan Kode Barang">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                <label for="">Nama</label>
                                                <input type="text" value="<?php echo $barang['barang_name']; ?>" class="form-control" name="barang_name" placeholder="Masukkan Nama Barang">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                <label for="">Harga</label>
                                                <input type="text" value="<?php echo $barang['barang_harga']; ?>" class="form-control" name="barang_harga" placeholder="Masukkan Harga Barang">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                <label for="">Ongkir</label>
                                                <input type="text" value="<?php echo $barang['barang_ongkir']; ?>" class="form-control" name="barang_ongkir" placeholder="Masukkan Ongkir Barang">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Kecamatan</label>
                                                    <select name="kecamatan_id" id="" class="form-control">
                                                        <option value="">Pilih Kecamatan Tujuan</option>
                                                        <?php foreach($kecamatan as $key => $row){ ?>
                                                            <option value="<?= $row['kecamatan_id']?>" <?php echo $barang['kecamatan_id'] == $row['kecamatan_id'] ? 'selected' : '' ?>><?= $row['kecamatan_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
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
                                                <input type="text" value="<?php echo $barang['barang_keterangan']; ?>" class="form-control" name="barang_keterangan" placeholder="Masukkan Keterangan Barang">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </form>
                        <div class="card-footer">
                            <a href="<?php echo base_url('admin/barang'); ?>" class="btn btn-outline-info float-right">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="/assets/vendors/simple-datatables/style.css">
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>
<?= $this->endSection() ?>
