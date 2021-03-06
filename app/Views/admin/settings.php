<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Settings</h3>
                <p class="text-subtitle text-muted">Setelan Umum</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
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
                    if(!empty(session()->getFlashdata('success'))){ ?>
                    <div class="alert alert-success">
                        <?php echo session()->getFlashdata('success');?>
                    </div>     
                <?php } ?>
                <?php if(!empty(session()->getFlashdata('warning'))){ ?>
                    <div class="alert alert-warning">
                        <?php echo session()->getFlashdata('warning');?>
                    </div>
                <?php } ?>
                    <div class="card-content">
                        <div class="card-header">
                        <h4>Setelan Umum</h4>
                            <a href="<?php echo base_url('admin/setting'); ?>" class="btn btn-primary float-lg-end">Edit</a>
                        </div>
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <dl class="dl-horizontal">
                                    <dt>Nama</dt>
                                    <dd><?php echo $setting['setting_name'];?></dd>
                                    <dt>Kontak</dt>
                                    <dd><?php echo $setting['setting_contact'];?></dd>
                                    <dt>Kontak Link</dt>
                                    <dd><?php echo $setting['setting_link'];?></dd>
                                    <dt>Status</dt>
                                    <dd>
                                        <div class="btn-group">
                                        <?php if($setting['setting_status'] == "Open"){?>
                                            <button type="submit" class="btn btn-sm btn-success" ><?= $setting['setting_status']?></button>
                                        <?php } ?>
                                        <?php if($setting['setting_status'] == "Close"){?>
                                            <button type="submit" class="btn btn-sm btn-danger" ><?= $setting['setting_status']?></button>
                                        <?php } ?>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Kurir</h4>
                <a href="<?php echo base_url('admin/kurir/create'); ?>" class="btn btn-primary float-lg-end">Tambah</a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($kurir as $key => $row){ ?>
                            <tr>
                                <td><?= $row['kode']?></td>
                                <td><?= $row['name']?></td>
                                <td><?= $row['username']?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo base_url('admin/kurir/'.$row['id']); ?>" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="<?php echo base_url('admin/kurir/edit/'.$row['id']); ?>" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="<?php echo base_url('admin/settings/delete/'.$row['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus User ini?');">
                                            <i class="fa fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>

    <!-- Basic Tables end -->
    <section>
            <div class="card">
                <div class="card-header">
                    <h4>Admin</h4>
                    <a href="<?php echo base_url('admin/create'); ?>" class="btn btn-primary float-lg-end">Tambah</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($admin as $key => $row){ ?>
                                <tr>
                                    <td><?= $row['name']?></td>
                                    <td><?= $row['username']?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo base_url('admin/settings/'.$row['id']); ?>" class="btn btn-sm btn-info">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="<?php echo base_url('admin/settings/edit/'.$row['id']); ?>" class="btn btn-sm btn-success">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="<?php echo base_url('admin/settings/delete/'.$row['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus User ini?');">
                                                <i class="fa fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
    
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/vendors/simple-datatables/style.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/vendors/dripicons/webfont.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/css/pages/dripicons.css')?>">
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="<?= base_url('assets/vendors/fontawesome/all.min.js')?>"></script>
<script src="<?= base_url('assets/vendors/simple-datatables/simple-datatables.js')?>"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);

    let table2 = document.querySelector('#table2');
    let dataTable2 = new simpleDatatables.DataTable(table2);
</script>
<?= $this->endSection() ?>
