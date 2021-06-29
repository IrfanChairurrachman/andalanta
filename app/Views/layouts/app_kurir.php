<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css')?>">

    <link rel="stylesheet" href="<?= base_url('assets/vendors/iconly/bold.css')?>">

    <link rel="stylesheet" href="<?= base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css')?>">
    <?= $this->renderSection('styles') ?>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/logo/andalanta.png')?>"/>
</head>

<body>
    <div id="app">
        <!-- Sidebar -->
        <?= $this->include('layouts/sidebar_kurir') ?>
        <!-- End Sidebar -->

        <!-- Main -->
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <!-- Content -->
            <?= $this->renderSection('content') ?>
            <!-- End Content -->
            
            <!-- Footer -->
            <?= $this->include('layouts/footer') ?>
            <!-- End Footer -->
        </div>
        <!-- End Main -->
    </div>

    <script src="<?= base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js')?>"></script>

    <?= $this->renderSection('javascript') ?>

    <script src="<?= base_url('assets/js/main.js')?>"></script>
</body>
</html>
