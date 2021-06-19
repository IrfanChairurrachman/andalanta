<?= $this->extend('layouts/app') ?>

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
                            <th>Resi</th>
                            <th>Kecamatan</th>
                            <th>Kontak</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($jemput as $key => $row){ ?>
                            <tr>
                                <td><?= $row['pesanan_resi']?></td>
                                <td><?= $row['kecamatan_name']?></td>
                                <td><?= $row['pesanan_kontak']?></td>
                                <td>
                                    <div class="btn-group">
                                        <form action="<?php echo base_url('kurir/jemput'); ?>" method="POST" class="form" onclick="return confirm('Apakah Anda yakin menjemput pesanan ini?');">
                                            <input type="hidden" name="pesanan_id" value="<?php echo $row['pesanan_id']; ?>">
                                            <input type="hidden" name="pesanan_kurir" value="<?php echo $kurir['id']; ?>">
                                            <input type="hidden" name="pesanan_status" value="On Process">
                                            <button type="submit" class="btn btn-sm btn-success" ><?= $row['pesanan_status']?></button>
                                        </form>
                                        <form action="<?php echo base_url('kurir/pesanan/'.$row['pesanan_id']); ?>" method="GET" class="form">
                                            <button type="submit" class="btn btn-sm btn-info" ><i class="fa fa-eye"></i> Info</button>
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
                                <th>Resi</th>
                                <th>Kecamatan</th>
                                <th>Kontak</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($antar as $key => $row){ ?>
                                <tr>
                                    <td><?= $row['pesanan_resi']?></td>
                                    <td><?= $row['kecamatan_name']?></td>
                                    <td><?= $row['pesanan_kontak']?></td>
                                    <td style="width:195px">
                                        <form action="<?php echo base_url('kurir/pesanan/proses/'.$row['pesanan_id']); ?>" method="GET" class="form">
                                        <button type="submit" class="btn btn-primary me-6 mb-6"><?= $row['pesanan_status']?></button>
                                        </form>
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
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);

    let table2 = document.querySelector('#table2');
    let dataTable2 = new simpleDatatables.DataTable(table2);
</script>
<?= $this->endSection() ?>
