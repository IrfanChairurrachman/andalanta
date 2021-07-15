<?= $this->extend('layouts/app_kurir') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Barang</h3>
                <p class="text-subtitle text-muted">Barang yang masuk dan diproses hari ini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('kurir'); ?>">Kurir</a></li>
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
            <div class="card-header">
                Barang Belum Diantar
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Kecamatan</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Ongkir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $total=0;foreach($barang as $key => $row){ ?>
                        <tr>
                            <td><?= date('j F Y', strtotime($row['created_at']))?></td>
                            <td><?= $row['barang_kode']?></td>
                            <td><?= $row['kecamatan_name']?></td>
                            <td><?= $row['barang_name']?></td>
                            <td><?= "Rp.".number_format($row['barang_harga'])?></td>
                            <td><?= "Rp.".number_format($row['barang_ongkir'])?></td>
                            <td>
                                <div class="btn-group">
                                    <form action="<?php echo base_url('kurir/barang/update'); ?>" method="POST" class="form" onclick="return confirm('Apakah Anda yakin ingin mengantar barang ini');">
                                        <input type="hidden" name="barang_status" value="Antar">
                                        <input type="hidden" name="barang_keterangan" value="">
                                        <input type="hidden" name="barang_id" value="<?= $row['barang_id']?>">
                                        <button type="submit" class="btn btn-sm btn-success" >Antar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <section>
            <div class="card">
                <div class="card-header bg-light">
                    Barang yang Saya Antar
                </div>
                <div class="card-body bg-light">
                    <table class="table table-striped table-light" id="table2">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kode</th>
                                <th>Kecamatan</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Ongkir</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $tbarang=0;$tongkir=0;foreach($antar as $key => $row){ ?>
                                <tr>
                                    <td><?= date('j F Y', strtotime($row['created_at']))?></td>
                                    <td><?= $row['barang_kode']?></td>
                                    <td><?= $row['kecamatan_name']?></td>
                                    <td><?= $row['barang_name']?></td>
                                    <td><?= "Rp.".number_format($row['barang_harga'])?></td>
                                    <td><?= "Rp.".number_format($row['barang_ongkir'])?></td>
                                    <td>
                                        <div class="btn-group">
                                        <?php if($row['barang_status'] == "Sukses"){?>
                                            <button type="submit" class="btn btn-success" ><?= $row['barang_status']?></button>
                                        <?php } ?>
                                        <?php if($row['barang_status'] == "Antar"){?>
                                            <button type="submit" class="btn btn-info" ><?= $row['barang_status']?></button>
                                        <?php } ?>
                                        <?php if($row['barang_status'] == "Tunda"){?>
                                            <button type="submit" class="btn btn-warning" ><?= $row['barang_status']?></button>
                                        <?php } ?>
                                        <?php if($row['barang_status'] == "Cancel"){?>
                                            <button type="submit" class="btn btn-danger" ><?= $row['barang_status']?></button>
                                        <?php } ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <form action="<?php echo base_url('kurir/barang/show/'.$row['barang_id']); ?>" method="GET" class="form">
                                                <button type="submit" class="btn btn-primary" ><i class="fa fa-eye"></i>Detail dan Aksi</button>
                                            </form>
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
                                <td></td>
                                <td><b><?= "Rp.".number_format($tbarang) ?></b></td>
                                <td><b><?= "Rp.".number_format($tongkir) ?></b></td>
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