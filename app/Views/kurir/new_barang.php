<?= $this->extend('layouts/app_kurir') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>DataTable</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Simple Datatable
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Toko</th>
                            <th>Kontak</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($barang as $key => $row){ ?>
                        <tr>
                            <td><?= $row['barang_kode']?></td>
                            <td><?= $row['barang_name']?></td>
                            <td><?= $row['barang_harga']?></td>
                            <td><?= $row['barang_ongkir']?></td>
                            <td>
                                <div class="btn-group">
                                    <form action="<?php echo base_url('kurir/barang/update'); ?>" method="POST" class="form" onclick="return confirm('Apakah Anda yakin ingin mengantar barang ini');">
                                        <input type="hidden" name="barang_status" value="Antar">
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
                <div class="card-header">
                    Simple Datatable
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table2">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Toko</th>
                                <th>Kontak</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($antar as $key => $row){ ?>
                                <tr>
                                    <td><?= $row['barang_kode']?></td>
                                    <td><?= $row['pesanan_toko']?></td>
                                    <td><?= $row['barang_ongkir']?></td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="<?php echo base_url('kurir/jemput'); ?>" method="POST" class="form" onclick="return confirm('Apakah Anda yakin menjemput pesanan ini?');">
                                                <input type="hidden" name="pesanan_status" value="On Process">
                                                <button type="submit" class="btn btn-sm btn-info" ><?= $row['barang_status']?></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <form action="<?php echo base_url('kurir/barang/update'); ?>" method="POST" class="form" onclick="return confirm('Apakah Anda yakin pengantaran barang ini telah sukses?');">
                                                <input type="hidden" name="barang_status" value="Sukses">
                                                <input type="hidden" name="barang_id" value="<?= $row['barang_id']?>">
                                                <button type="submit" class="btn btn-sm btn-success" ><i class="icon dripicons-document-edit"></i></button>
                                            </form>
                                            <form action="<?php echo base_url('kurir/barang/update'); ?>" method="POST" class="form" onclick="return confirm('Apakah Anda yakin pengantaran barang ini ditunda?');">
                                                <input type="hidden" name="barang_status" value="Tunda">
                                                <input type="hidden" name="barang_id" value="<?= $row['barang_id']?>">
                                                <button type="submit" class="btn btn-sm btn-info" ><i class="fa fa-edit"></i></button>
                                            </form>
                                            <form action="<?php echo base_url('kurir/barang/update'); ?>" method="POST" class="form" onclick="return confirm('Apakah Anda yakin pengantaran barang ini dibatalkan?');">
                                                <input type="hidden" name="barang_status" value="Cancel">
                                                <input type="hidden" name="barang_id" value="<?= $row['barang_id']?>">
                                                <button type="submit" class="btn btn-sm btn-danger" ><i class="fa fa-trash-alt"></i></button>
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