<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Pesanan</h3>
                <p class="text-subtitle text-muted">Daftar Semua Pesanan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
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
            <div class="card-header">
                Daftar Pesanan Masuk
                <a href="<?php echo base_url('admin/pesanan/create'); ?>" class="btn btn-primary float-lg-end">Tambah</a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Resi</th>
                            <th>Kecamatan</th>
                            <th>Toko</th>
                            <th>Kontak</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($jemput as $key => $row){ ?>
                            <tr>
                                <td><?= $row['pesanan_resi']?></td>
                                <td><?= $row['kecamatan_name']?></td>
                                <td><?= $row['pesanan_toko']?></td>
                                <td><?= $row['pesanan_kontak']?></td>
                                <td>
                                    <div class="btn-group">
                                    <?php if($row['pesanan_status'] == "Sukses"){?>
                                        <button type="submit" class="btn btn-sm btn-success" ><?= $row['pesanan_status']?></button>
                                    <?php } ?>
                                    <?php if($row['pesanan_status'] == "On Process"){?>
                                        <button type="submit" class="btn btn-sm btn-info" ><?= $row['pesanan_status']?></button>
                                    <?php } ?>
                                    <?php if($row['pesanan_status'] == "Jemput"){?>
                                        <button type="submit" class="btn btn-sm btn-warning" ><?= $row['pesanan_status']?></button>
                                    <?php } ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo base_url('admin/pesanan/'.$row['pesanan_id']); ?>" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="<?php echo base_url('admin/pesanan/edit/'.$row['pesanan_id']); ?>" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="<?php echo base_url('admin/pesanan/delete/'.$row['pesanan_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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
<link rel="stylesheet" href="/assets/vendors/simple-datatables/style.css">
<link rel="stylesheet" href="/assets/vendors/dripicons/webfont.css">
<link rel="stylesheet" href="/assets/css/pages/dripicons.css">
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/assets/vendors/fontawesome/all.min.js"></script>
<script src="/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);

    let table2 = document.querySelector('#table2');
    let dataTable2 = new simpleDatatables.DataTable(table2);
</script>
<?= $this->endSection() ?>
