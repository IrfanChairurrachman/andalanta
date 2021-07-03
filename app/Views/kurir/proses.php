<?= $this->extend('layouts/app_kurir') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="navbar-brand ms-4">Pesanan Proses</h3>
            </nav>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('kurir'); ?>">Kurir</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('kurir'); ?>">Pesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Proses</li>
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
                        <a href="<?php echo base_url('kurir'); ?>" class="btn btn-outline-info float-right">Back</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        <?php
                        if(!empty(session()->getFlashdata('success'))){ ?>
                        <div class="alert alert-success">
                            <?php echo session()->getFlashdata('success');?>
                        </div>     
                        <?php } ?>
                            <h4 class="float-right">Pesanan</h4>
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
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Tables end -->
    <section>
            <div class="card">
                <div class="card-header">
                    Daftar Barang Pesanan ini
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Ongkir</th>
                                <th>Kecamatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($barang as $key => $row){ ?>
                                <tr>
                                    <td><?= $row['barang_kode']?></td>
                                    <td><?= $row['barang_name']?></td>
                                    <td><?= $row['barang_ongkir']?></td>
                                    <td><?= $row['kecamatan_name']?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
    <!-- Basic Vertical form layout section start -->
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
                    <div class="card-header">
                        <h4 class="card-title">Tambah Barang</h4>
                    </div>
                    <div class="card-content">
                        <form class="form form-vertical" method="POST" action="<?php echo base_url('kurir/barang/store'); ?>">
                            <div class="card-body">
                                <form class="form form-vertical">
                                <input type="hidden" name="barang_kode" value="<?php echo $kurir['kode'];?>-<?php echo $date;?>-">
                                <input type="hidden" name="pesanan_id" value="<?php echo $pesanan['pesanan_id'];?>">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><?php echo $kurir['kode'];?>-<?php echo $date;?>-</span>
                                                    <input type="number" class="form-control" name="kode" placeholder="Nomor Kode"
                                                        aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" name="barang_name" placeholder="Masukkan Nama Barang">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Harga Barang</label>
                                                    <input type="number" class="form-control" name="barang_harga" placeholder="Masukkan Harga Barang">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Ongkir</label>
                                                    <input type="number" class="form-control" name="barang_ongkir" placeholder="Masukkan Ongkir Barang">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Kecamatan</label>
                                                    <select name="kecamatan_id" id="" class="form-control">
                                                        <option value="">Pilih Kecamatan Tujuan</option>
                                                        <?php foreach($kecamatan as $key => $row){ ?>
                                                            <option value="<?= $row['kecamatan_id']?>"><?= $row['kecamatan_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic Vertical form layout section end -->
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
