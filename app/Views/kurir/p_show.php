<?= $this->extend('layouts/app_kurir') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="navbar-brand ms-4">Pesanan Detail</h3>
            </nav>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('kurir'); ?>">Kurir</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('kurir'); ?>">Pesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail Pesanan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <dl class="dl-horizontal">
                                    <dt>Resi</dt>
                                    <dd><?php echo $pesanan['pesanan_resi'];?></dd>
                                    <dt>Nama</dt>
                                    <dd><?php echo $pesanan['pesanan_name'];?></dd>
                                    <dt>Toko</dt>
                                    <dd><?php echo $pesanan['pesanan_toko'];?></dd>
                                    <dt>Kontak</dt>
                                    <dd><?php echo $pesanan['pesanan_kontak'];?></dd>
                                    <dt>Alamat</dt>
                                    <dd><?php echo $pesanan['pesanan_alamat'];?></dd>       
                                    <dt>Kecamatan</dt>
                                    <dd><?php echo $pesanan['kecamatan_name'];?></dd>
                                    <dt>Sosmed</dt>
                                    <dd><?php echo $pesanan['pesanan_sosmed'];?></dd>          
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo base_url('kurir'); ?>" class="btn btn-outline-info float-right">Back</a>
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
