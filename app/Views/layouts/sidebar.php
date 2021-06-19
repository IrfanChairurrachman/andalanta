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
                    <a href="index.html"><img src="/assets/images/logo/logo.png" alt="Logo" srcset=""></a>
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
                    <a href="/mazer" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item <?= ($uri2 == 'layout') ? 'active' : '' ?>">
                    <a href="/mazer/forms/layout" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Form Layout</span>
                    </a>
                </li>


                <li class="sidebar-item <?= ($uri1 == 'table') ? 'active' : '' ?>">
                    <a href="/mazer/table" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Table</span>
                    </a>
                </li>

                <li class="sidebar-item <?= ($uri1 == 'datatable') ? 'active' : '' ?>">
                    <a href="/mazer/datatable" class='sidebar-link'>
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Datatable</span>
                    </a>
                </li>

                <li class="sidebar-title">Extra UI</li>

                <li class="sidebar-item <?= ($uri2 == 'widgets') ? 'active' : '' ?> has-sub">
                    <a href="#" class='sidebar-link <?= ($uri2 == 'widgets') ? 'active' : '' ?>'>
                        <i class="bi bi-pentagon-fill"></i>
                        <span>Widgets</span>
                    </a>
                    <ul class="submenu <?= ($uri2 == 'widgets') ? 'active' : '' ?>">
                        <li class="submenu-item <?= ($uri3 == 'chatbox') ? 'active' : '' ?>">
                            <a href="/mazer/ui/widgets/chatbox">Chatbox</a>
                        </li>
                        <li class="submenu-item <?= ($uri3 == 'pricing') ? 'active' : '' ?>">
                            <a href="/mazer/ui/widgets/pricing">Pricing</a>
                        </li>
                        <li class="submenu-item <?= ($uri3 == 'to-do-list') ? 'active' : '' ?>">
                            <a href="/mazer/ui/widgets/to-do-list">To-do List</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item <?= ($uri2 == 'icons') ? 'active' : '' ?> has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-egg-fill"></i>
                        <span>Icons</span>
                    </a>
                    <ul class="submenu <?= ($uri2 == 'icons') ? 'active' : '' ?>">
                        <li class="submenu-item <?= ($uri3 == 'bootstrap-icons') ? 'active' : '' ?>">
                            <a href="/mazer/ui/icons/bootstrap-icons">Bootstrap Icons </a>
                        </li>
                        <li class="submenu-item <?= ($uri3 == 'fontawesome') ? 'active' : '' ?>">
                            <a href="/mazer/ui/icons/fontawesome">Fontawesome</a>
                        </li>
                        <li class="submenu-item <?= ($uri3 == 'dripicons') ? 'active' : '' ?>">
                            <a href="/mazer/ui/icons/dripicons">Dripicons</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item <?= ($uri2 == 'charts') ? 'active' : '' ?> has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-bar-chart-fill"></i>
                        <span>Charts</span>
                    </a>
                    <ul class="submenu <?= ($uri3 == 'chartjs') ? 'active' : '' ?>">
                        <li class="submenu-item ">
                            <a href="/mazer/ui/charts/chartjs">ChartJS</a>
                        </li>
                        <li class="submenu-item <?= ($uri3 == 'apexcharts') ? 'active' : '' ?>">
                            <a href="/mazer/ui/charts/apexcharts">Apexcharts</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item <?= ($uri2 == 'file-uploader') ? 'active' : '' ?>">
                    <a href="/mazer/ui/file-uploader" class='sidebar-link'>
                        <i class="bi bi-cloud-arrow-up-fill"></i>
                        <span>File Uploader</span>
                    </a>
                </li>

                <li class="sidebar-item <?= ($uri2 == 'maps') ? 'active' : '' ?> has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-map-fill"></i>
                        <span>Maps</span>
                    </a>
                    <ul class="submenu <?= ($uri2 == 'maps') ? 'active' : '' ?>">
                        <li class="submenu-item <?= ($uri3 == 'google-map') ? 'active' : '' ?>">
                            <a href="/mazer/ui/maps/google-map">Google Map</a>
                        </li>
                        <li class="submenu-item <?= ($uri3 == 'jsvector-map') ? 'active' : '' ?>">
                            <a href="/mazer/ui/maps/jsvector-map">JS Vector Map</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Pages</li>

                <li class="sidebar-item <?= ($uri2 == 'email') ? 'active' : '' ?> ">
                    <a href="/mazer/applications/email" class='sidebar-link'>
                        <i class="bi bi-envelope-fill"></i>
                        <span>Email Application</span>
                    </a>
                </li>

                <li class="sidebar-item <?= ($uri2 == 'chat') ? 'active' : '' ?> ">
                    <a href="/mazer/applications/chat" class='sidebar-link'>
                        <i class="bi bi-chat-dots-fill"></i>
                        <span>Chat Application</span>
                    </a>
                </li>

                <li class="sidebar-item <?= ($uri2 == 'gallery') ? 'active' : '' ?> ">
                    <a href="/mazer/applications/gallery" class='sidebar-link'>
                        <i class="bi bi-image-fill"></i>
                        <span>Photo Gallery</span>
                    </a>
                </li>

                <li class="sidebar-item <?= ($uri2 == 'checkout') ? 'active' : '' ?> ">
                    <a href="/mazer/applications/checkout" class='sidebar-link'>
                        <i class="bi bi-basket-fill"></i>
                        <span>Checkout Page</span>
                    </a>
                </li>

                <li class="sidebar-item <?= ($uri2 == 'auth') ? 'active' : '' ?> has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-badge-fill"></i>
                        <span>Authentication</span>
                    </a>
                    <ul class="submenu <?= ($uri2 == 'auth') ? 'active' : '' ?>">
                        <li class="submenu-item <?= ($uri3 == 'login') ? 'active' : '' ?>">
                            <a href="/mazer/applications/auth/login">Login</a>
                        </li>
                        <li class="submenu-item <?= ($uri3 == 'register') ? 'active' : '' ?>">
                            <a href="/mazer/applications/auth/register">Register</a>
                        </li>
                        <li class="submenu-item <?= ($uri3 == 'forgot-password') ? 'active' : '' ?>">
                            <a href="/mazer/applications/auth/forgot-password">Forgot Password</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item <?= ($uri2 == 'errors') ? 'active' : '' ?> has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-x-octagon-fill"></i>
                        <span>Errors</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item <?= ($uri3 == '403') ? 'active' : '' ?>">
                            <a href="/mazer/applications/errors/403">403</a>
                        </li>
                        <li class="submenu-item <?= ($uri3 == '404') ? 'active' : '' ?>">
                            <a href="/mazer/applications/errors/404">404</a>
                        </li>
                        <li class="submenu-item <?= ($uri3 == '500') ? 'active' : '' ?>">
                            <a href="/mazer/applications/errors/500">500</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Raise Support</li>

                <li class="sidebar-item  ">
                    <a href="https://zuramai.github.io/mazer/docs" class='sidebar-link'>
                        <i class="bi bi-life-preserver"></i>
                        <span>Documentation</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="https://github.com/zuramai/mazer/blob/main/CONTRIBUTING.md" class='sidebar-link'>
                        <i class="bi bi-puzzle"></i>
                        <span>Contribute</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="https://github.com/zuramai/mazer#donate" class='sidebar-link'>
                        <i class="bi bi-cash"></i>
                        <span>Donate</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
