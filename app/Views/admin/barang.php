<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Barang</h3>
                <p class="text-subtitle text-muted">Daftar Semua Barang</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Barang</li>
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
                <b>Export:</b>
                <form method="POST" action="<?php echo base_url('admin/barang/export'); ?>">
                    <label for="start">Start:</label>
                    <input type="date" name="start">
                    <label for="end">End:</label>
                    <input type="date" name="end">
                    <button type="submit" class="btn btn-dark">Export</button>
                </form>
                <br>
                <b>Daftar Barang:</b>
                <form method="POST" action="<?php echo base_url('admin/barang'); ?>">
                    <label for="start">Start:</label>
                    <input type="date" name="start" value="<?php echo empty($start) ? '' : $start ?>">
                    <label for="end">End:</label>
                    <input type="date" name="end" value="<?php echo empty($end) ? '' : $end ?>">
                    <button type="submit" class="btn btn-success">Pilih</button>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Toko</th>
                            <th>Harga Barang</th>
                            <th>Ongkir</th>
                            <th>Kurir Pengantar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $tbarang=0;$tongkir=0;foreach($barang as $key => $row){ ?>
                            <tr>
                                <td><?= date('j F Y', strtotime($row['created_at']))?></td>
                                <td><?= $row['barang_kode']?></td>
                                <td><?= $row['barang_name']?></td>
                                <td><?= $row['pesanan_toko']?></td>
                                <td><?= "Rp.".number_format($row['barang_harga'])?></td>
                                <td><?= "Rp.".number_format($row['barang_ongkir'])?></td>
                                <td><?= $row['name']?></td>
                                <td>
                                    <div class="btn-group">
                                    <?php if($row['barang_status'] == "Sukses"){?>
                                        <button type="submit" class="btn btn-sm btn-success" ><?= $row['barang_status']?></button>
                                    <?php } ?>
                                    <?php if($row['barang_status'] == "Antar"){?>
                                        <button type="submit" class="btn btn-sm btn-info" ><?= $row['barang_status']?></button>
                                    <?php } ?>
                                    <?php if($row['barang_status'] == "Tunda"){?>
                                        <button type="submit" class="btn btn-sm btn-warning" ><?= $row['barang_status']?></button>
                                    <?php } ?>
                                    <?php if($row['barang_status'] == "Cancel"){?>
                                        <button type="submit" class="btn btn-sm btn-danger" ><?= $row['barang_status']?></button>
                                    <?php } ?>
                                    <?php if($row['barang_status'] == "Terjemput"){?>
                                        <button type="submit" class="btn btn-sm btn-info" ><?= $row['barang_status']?></button>
                                    <?php } ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo base_url('admin/barang/'.$row['barang_id']); ?>" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="<?php echo base_url('admin/barang/edit/'.$row['barang_id']); ?>" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="<?php echo base_url('admin/barang/delete/'.$row['barang_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                            <i class="fa fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php $tbarang += $row['barang_harga']; $tongkir += $row['barang_ongkir']; ?>
                        <?php } ?>
                    </tbody>
                        <tr>
                            <td><b>Total</b></td>
                            <td></td>
                            <td></td>
                            <td><b><?= "Rp.".number_format($tbarang) ?></b></td>
                            <td><b><?= "Rp.".number_format($tongkir) ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
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
