<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="navbar-brand ms-4">Detail Kurir</h3>
            </nav>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/settings'); ?>">Settings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kurir</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <?php $total_harga=0;$ongkir_pesanan=0;foreach($pesanan as $key => $row){
        $total_harga += $row['total'];
        $ongkir_pesanan += $row['ongkir'];
    } ?>
    <?php $total_ongkir=0;foreach($barang as $key => $row){
        $total_ongkir += $row['barang_ongkir'];
    } ?>
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total Penjemputan</h6>
                                    <h6 class="font-extrabold mb-0"><?= $pesanan_total ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total Pengantaran</h6>
                                    <h6 class="font-extrabold mb-0"><?= $barang_total ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Ongkir Pengantaran</h6>
                                    <h6 class="font-extrabold mb-0"><?= "Rp.".number_format($total_ongkir) ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total Harga Barang Penjemputan</h6>
                                    <h6 class="font-extrabold mb-0"><?= "Rp.".number_format($total_harga) ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <div class="card">
                    <b>Pilih Waktu</b>
                    <form method="POST" action="<?php echo base_url('admin/kurir/'.$kurir['id']); ?>">
                        <label for="start">Start:</label>
                        <input type="date" name="start" value="<?php echo empty($start) ? '' : $start ?>">
                        <label for="end">End:</label>
                        <input type="date" name="end" value="<?php echo empty($end) ? '' : $end ?>">
                        <button type="submit" class="btn btn-dark">Pilih</button>
                    </form>
                    <div class="card-content">
                        <div class="card-header">
                            <h5>Informasi Kurir</h5>
                        </div>          
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <dl class="dl-horizontal">
                                    <dt>Kode</dt>
                                    <dd><?php echo $kurir['kode'];?></dd>
                                    <dt>Nama</dt>
                                    <dd><?php echo $kurir['name'];?></dd>
                                    <dt>Username</dt>
                                    <dd><?php echo $kurir['username'];?></dd>
                                    <dt>Password</dt>
                                    <dd><?php echo $kurir['password'];?></dd>       
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo base_url('admin/settings'); ?>" class="btn btn-outline-info float-right">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Harga Barang</th>
                                        <th>Ongkir</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $tbarang=0;$tongkir=0;foreach($barang as $key => $row){ ?>
                                        <tr>
                                            <td><?= $row['barang_kode']?></td>
                                            <td><?= "Rp.".number_format($row['barang_harga'])?></td>
                                            <td><?= "Rp.".number_format($row['barang_ongkir'])?></td>
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
                                        </tr>
                                        <?php $tbarang += $row['barang_harga']; $tongkir += $row['barang_ongkir']; ?>
                                    <?php } ?>
                                </tbody>
                                <tr>
                                    <td><b>Total</b></td>
                                    <td><b><?= "Rp.".number_format($tbarang) ?></b></td>
                                    <td><b><?= "Rp.".number_format($tongkir) ?></b></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <!-- Table with outer spacing -->
                            <table class="table table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th>Resi</th>
                                        <th>Pesanan</th>
                                        <th>Total Harga</th>
                                        <th>Ongkir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($pesanan as $key => $row){ ?>
                                        <tr>
                                            <td><?= $row['pesanan_resi']?></td>
                                            <td><?= $row['pesanan_name']?></td>
                                            <td><?= "Rp.".number_format($row['total'])?></td>
                                            <td><?= "Rp.".number_format($row['ongkir'])?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tr>
                                    <td><b>Total</b></td>
                                    <td></td>
                                    <td><b><?= "Rp.".number_format($total_harga) ?></b></td>
                                    <td><b><?= "Rp.".number_format($ongkir_pesanan) ?></b></td>
                                </tr>
                            </table>
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

    let table = document.querySelector('#table');
    let dataTable2 = new simpleDatatables.DataTable(table);
</script>
<?= $this->endSection() ?>
