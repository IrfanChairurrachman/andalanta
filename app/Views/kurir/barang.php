<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar_kurir'); ?>
 
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">KURIR</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">KURIR</li>
            </ol>
            </div>
        </div>
        </div>
    </div>
 
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">PESANAN MASUK</h5>
                        </div>
                        <div class="card-body">
                            <p>MASUK</p>
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <td>Kode</td>
                                        <td>Toko</td>
                                        <td>Kontak</td>
                                        <td>Status</td>
                                        <td>Action</td>
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
                                                    <form action="<?php echo base_url('kurir/jemput'); ?>" method="POST" class="form" onclick="return confirm('Apakah Anda yakin menjemput pesanan ini?');">
                                                        <input type="hidden" name="barang_status" value="On Process">
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
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">PESANAN PROSES</h5>
                        </div>
                        <div class="card-body">
                            <p>On Process</p>
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <td>Kode</td>
                                        <td>Toko</td>
                                        <td>Kontak</td>
                                        <td>Status</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($antar as $key => $row){ ?>
                                        <tr>
                                            <td><?= $row['barang_kode']?></td>
                                            <td><?= $row['barang_name']?></td>
                                            <td><?= $row['barang_harga']?></td>
                                            <td><?= $row['barang_ongkir']?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <form action="<?php echo base_url('kurir/jemput'); ?>" method="POST" class="form" onclick="return confirm('Apakah Anda yakin menjemput pesanan ini?');">
                                                        <input type="hidden" name="pesanan_status" value="On Process">
                                                        <button type="submit" class="btn btn-sm btn-success" ><?= $row['barang_status']?></button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="<?php echo base_url('admin/product/show/') ?>" class="btn btn-sm btn-info">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('admin/product/edit/') ?>" class="btn btn-sm btn-success">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('admin/product/delete/') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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
                </div>
            </div>
        </div>
    </div>
</div>
 
<?php echo view('_partials/footer'); ?>