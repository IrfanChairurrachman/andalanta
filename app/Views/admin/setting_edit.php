<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="navbar-brand ms-4">Setting Edit</h3>
            </nav>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/settings'); ?>">Settings</a></li>
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
                        <form class="form form-vertical" method="POST" action="<?php echo base_url('admin/setting/update'); ?>">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" value="<?php echo $setting['setting_name']; ?>" class="form-control" name="setting_name" placeholder="Masukkan Nama">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                            <label for="">Kontak</label>
                                            <input type="text" value="<?php echo $setting['setting_contact']; ?>" class="form-control" name="setting_contact" placeholder="Masukkan Kontak">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                            <label for="">Kontak Link</label>
                                            <input type="text" value="<?php echo $setting['setting_link']; ?>" class="form-control" name="setting_link" placeholder="Masukkan Link">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="setting_status" id="" class="form-control">
                                                    <option value="Open" <?php echo $setting['setting_status'] == 'Open' ? 'selected' : '' ?>>Open</option>
                                                    <option value="Close" <?php echo $setting['setting_status'] == 'Close' ? 'selected' : '' ?>>Close</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                            <a href="<?php echo base_url('admin/settins'); ?>" class="btn btn-outline-info float-right">Back</a>
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
