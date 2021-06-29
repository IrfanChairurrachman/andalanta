<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <nav class="navbar navbar-light">
                <a href="/kurir"><i class="bi bi-chevron-left"></i></a>
                <h3 class="navbar-brand ms-4">Form Layout</h3>
            </nav>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/kurir">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form Layout</li>
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
                    <div class="card-header">
                        <h4 class="card-title">Vertical Form</h4>
                    </div>
                    <div class="card-content">
                        <form class="form form-vertical" method="POST" action="<?php echo base_url('admin/pesanan/store'); ?>">
                            <div class="card-body">
                                <form class="form form-vertical">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" name="barang_name" placeholder="Masukkan Nama Pemesan">
                                                </div>
                                            </div>
                                            <div class="col-12">
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
                            <a href="<?php echo base_url('admin/pesanan'); ?>" class="btn btn-outline-info float-right">Back</a>
                        </div>
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
