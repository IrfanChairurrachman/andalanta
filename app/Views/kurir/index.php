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
                                        <td>Kecamatan</td>
                                        <td>Toko</td>
                                        <td>Kontak</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($jemput as $key => $row){ ?>
                                        <tr>
                                            <td><?= $row['kecamatan_id']?></td>
                                            <td><?= $row['pesanan_toko']?></td>
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
                                        <td>Kecamatan</td>
                                        <td>Toko</td>
                                        <td>Kontak</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($antar as $key => $row){ ?>
                                        <tr>
                                            <td><?= $row['kecamatan_id']?></td>
                                            <td><?= $row['pesanan_toko']?></td>
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