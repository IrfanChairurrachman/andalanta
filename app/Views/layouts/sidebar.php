<?php
$uri = service('uri')->getSegments();
$uri1 = $uri[1] ?? 'index';
$uri2 = $uri[2] ?? '';
$uri3 = $uri[3] ?? '';
?>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="/assets/images/logo/andalanta.png"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item <?= ($uri1 == 'index') ? 'active' : '' ?> ">
                    <a href="<?php echo base_url('admin'); ?>" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item <?= ($uri1 == 'pesanan') ? 'active' : '' ?>">
                    <a href="<?php echo base_url('admin/pesanan'); ?>" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Pesanan</span>
                    </a>
                </li>


                <li class="sidebar-item <?= ($uri1 == 'barang') ? 'active' : '' ?>">
                    <a href="<?php echo base_url('admin/barang'); ?>" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Barang</span>
                    </a>
                </li>

                <li class="sidebar-item <?= ($uri1 == 'settings') ? 'active' : '' ?>">
                    <a href="<?php echo base_url('admin/settings'); ?>" class='sidebar-link'>
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Settings</span>
                    </a>
                </li>

                <li class="sidebar-title">Bantuan</li>

                <li class="sidebar-item  ">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-life-preserver"></i>
                        <span>Documentation</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="<?php echo base_url('logout'); ?>" class="nav-link">
                        <i class="bi bi-circle-notch"></i>
                        <p class="text">Logout</p>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
