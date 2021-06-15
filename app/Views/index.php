<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIABMAS</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">

    <link rel="stylesheet" href="assets/vendors/choices.js/choices.min.css"/>

    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
</head>

<body>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown me-1">
                        <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class='bi bi-person-badge-fill fs-4 text-gray-600'></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Login</h6>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('login') }}">Admin</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Kurir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>ANDALANTA</h1>
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Kurir Makassar Paling Mantap</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                    <?php
                        if(!empty(session()->getFlashdata('success'))){ ?>
                        <div class="alert alert-success">
                            <?php echo session()->getFlashdata('success');?>
                        </div>     
                        <?php } ?>

                        <?php if(!empty(session()->getFlashdata('info'))){ ?>
                        <div class="alert alert-info">
                            <?php echo session()->getFlashdata('info');?>
                        </div>
                        <?php } ?>

                        <?php if(!empty(session()->getFlashdata('warning'))){ ?>
                        <div class="alert alert-warning">
                            <?php echo session()->getFlashdata('warning');?>
                        </div>
                    <?php } ?>
                        <form class="form form-vertical" method="POST" action="<?php echo base_url('pesanan/store'); ?>">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Nama</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control"
                                                    placeholder="Nama Pemesan"
                                                    id="first-name-icon"
                                                    name="pesanan_name">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Toko</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control"
                                                    placeholder="Toko"
                                                    id="first-name-icon"
                                                    name="pesanan_toko">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Kontak</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control"
                                                    placeholder="Kontak"
                                                    id="first-name-icon"
                                                    name="pesanan_kontak">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Alamat</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control"
                                                    placeholder="Alamat"
                                                    id="first-name-icon"
                                                    name="pesanan_alamat">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Kecamatan</label>
                                            <select class="choices form-select" name="kecamatan">
                                                <?php foreach($kecamatan as $key => $row){ ?>
                                                    <option value="<?= $row['kecamatan_id']?>"><?= $row['kecamatan_name']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Fb/Ig</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control"
                                                    placeholder="FB/IG"
                                                    id="first-name-icon"
                                                    name="pesanan_sosmed">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset"
                                            class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/choices.js/choices.min.js"></script>
    <script src="assets/js/extensions/sweetalert2.js"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

    <script src="assets/js/main.js"></script>

</body>

</html>