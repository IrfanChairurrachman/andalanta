<?= $this->extend('layouts/app') ?>

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
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/pesanan'); ?>">Pesanan</a></li>
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
                            <?php
                                if(!empty(session()->getFlashdata('success'))){ ?>
                                <div class="alert alert-success">
                                    <?php echo session()->getFlashdata('success');?>
                                </div>     
                            <?php } ?>
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <dl class="dl-horizontal">
                                    <dt>Resi</dt>
                                    <dd><?php echo $pesanan['pesanan_resi'];?></dd>
                                    <dt>Nama</dt>
                                    <dd><?php echo $pesanan['pesanan_name'];?></dd>
                                    <dt>Toko</dt>
                                    <dd><?php echo $pesanan['pesanan_toko'];?></dd>
                                    <dt>Alamat</dt>
                                    <dd><?php echo $pesanan['pesanan_alamat'];?></dd>
                                    <dt>Kontak</dt>
                                    <dd><?php echo $pesanan['pesanan_kontak'];?></dd>
                                    <dt>Status</dt>
                                    <dd><?php echo $pesanan['pesanan_name'];?></dd>
                                    <dt>Sosmed</dt>
                                    <dd><?php echo $pesanan['pesanan_sosmed'];?></dd>
                                    <dt>Kecamatan</dt>
                                    <dd><?php echo $pesanan['kecamatan_name'];?></dd>
                                    <dt>Kurir Penjemput</dt>
                                    <dd><?php echo $pesanan['name'];?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo base_url('admin/pesanan'); ?>" class="btn btn-outline-info float-right">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Basic Tables end -->
    <section>
            <div class="card">
                <div class="card-header">
                    Simple Datatable
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Tgl</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Ongkir</th>
                                <th>Kecamatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $tbarang=0;$tongkir=0;foreach($barang as $key => $row){ ?>
                                <tr>
                                    <td><?= date('j F Y', strtotime($row['created_at']))?></td>
                                    <td><?= $row['barang_kode']?></td>
                                    <td><?= $row['barang_name']?></td>
                                    <td><?= "Rp.".number_format($row['barang_harga'])?></td>
                                    <td><?= "Rp.".number_format($row['barang_ongkir'])?></td>
                                    <td><?= $row['kecamatan_name']?></td>
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
                                        <?php if($row['barang_status'] == "Terjemput"){?>
                                            <button type="submit" class="btn btn-info" ><?= $row['barang_status']?></button>
                                        <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php $tbarang += $row['barang_harga']; $tongkir += $row['barang_ongkir']; ?>
                            <?php } ?>
                            <tr>
                                <td><b>Total</b></td>
                                <td></td>
                                <td></td>
                                <td><?= "Rp.".number_format($tbarang) ?></td>
                                <td><?= "Rp.".number_format($tongkir) ?></td>
                                <td></td>
                                <td></td>
                            </tr>
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
                                <input type="hidden" name="pesanan_id" value="<?php echo $pesanan['pesanan_id'];?>">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="input-group mb-3">
                                                    <select name="barang_kode" id="" class="form-control">
                                                        <option value="">Pilih Kurir</option>
                                                        <?php foreach($kurir as $key => $row){ ?>
                                                            <option value="<?= $row['kode']?>-"><?= $row['kode']?></option>
                                                        <?php } ?>
                                                    </select>
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
                                                    <input type="text" id="rupiah" class="form-control" name="barang_harga" data-a-sign="" data-a-dec="," data-a-sep="." placeholder="Masukkan Harga Barang">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Ongkir</label>
                                                    <input type="text" id="rupiah2" class="form-control" name="barang_ongkir" data-a-sign="" data-a-dec="," data-a-sep="." placeholder="Masukkan Ongkir Barang">
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
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);

    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }
    
    var rupiah2 = document.getElementById('rupiah2');
    rupiah2.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah2.value = formatRupiah(this.value);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }
</script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<?= $this->endSection() ?>
