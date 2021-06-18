<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>
 
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">ADMIN</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">ADMIN</li>
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
                                        <td>Resi</td>
                                        <td>Kecamatan</td>
                                        <td>Kontak</td>
                                        <td>Status</td>
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
                                                    <a href="<?php echo base_url('admin/pesanan/show/'.$row['pesanan_id']); ?>" class="btn btn-sm btn-info">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('admin/pesanan/edit/'.$row['pesanan_id']); ?>" class="btn btn-sm btn-success">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('admin/pesanan/delete/'.$row['pesanan_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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
                                        <td>Resi</td>
                                        <td>Kecamatan</td>
                                        <td>Kontak</td>
                                        <td>Status</td>
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
                </div>
            </div>
        </div>
    </div>
</div>
 
<?php echo view('_partials/footer'); ?>