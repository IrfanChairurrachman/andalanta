<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="navbar-brand ms-4">Detail Barang</h3>
            </nav>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/barang'); ?>">Barang</a></li>
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
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <dl class="dl-horizontal">
                                    <dt>Resi</dt>
                                    <dd><?php echo $barang['pesanan_resi'];?></dd>       
                                    <dt>Kode</dt>
                                    <dd><?php echo $barang['barang_kode'];?></dd>
                                    <dt>Nama</dt>
                                    <dd><?php echo $barang['barang_name'];?></dd>
                                    <dt>Harga</dt>
                                    <dd><?php echo "Rp.".number_format($barang['barang_harga']);?></dd>
                                    <dt>Ongkir</dt>
                                    <dd><?php echo "Rp.".number_format($barang['barang_ongkir']);?></dd>
                                    <dt>Kurir</dt>
                                    <dd><?php echo $barang['name'];?></dd>
                                    <dt>Status</dt>
                                    <dd><?php echo $barang['barang_status'];?></dd>
                                    <dt>Keterangan</dt>
                                    <dd><?php echo $barang['barang_keterangan'];?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo base_url('admin/barang'); ?>" class="btn btn-outline-info float-right">Back</a>
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
