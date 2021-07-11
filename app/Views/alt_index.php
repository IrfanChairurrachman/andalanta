<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Landing Page - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/logo/andalanta.png')?>"/>
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- <link rel="stylesheet" href="assets/css/bootstrap.css"> -->

        <link rel="stylesheet" href="<?= base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css')?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/app.css')?>">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?= base_url('landing/css/styles.css')?>" rel="stylesheet" />
        <link rel="stylesheet" href="<?= base_url('assets/vendors/choices.js/choices.min.css')?>"/>

        <link rel="stylesheet" href="<?= base_url('assets/vendors/sweetalert2/sweetalert2.min.css')?>">
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-light bg-light static-top">
            <div class="container">
                <a class="navbar-brand">Andalanta</a>
                <a class="btn btn-primary" href="<?php echo base_url('login'); ?>">Masuk</a>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container position-relative">
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
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="text-center text-white">
                            <!-- Page heading-->
                            <h1 class="mb-5">Percayakan Pesanan Anda dengan Andalanta!</h1>
                            <!-- Signup form-->
                            <form method="POST" action="<?php echo base_url('pesanan/resi'); ?>">
                            <div class="input-group input-group-lg">
                                <input class="form-control" type="text" name="pesanan_resi" placeholder="Masukan resi Anda"/>
                                <button class="btn btn-primary" type="submit">Cek Resi!</button>
                            </div>
                            </form>
                            <?php $data = session()->getFlashdata('resi');
                                if(!empty($data)){ ?>
                                <div class="alert alert-info">
                                    <h5>Hi <?= $data['pesanan']['pesanan_name'] ?></h5>
                                    <h6>Status Pesananta': <?= $data['pesanan']['pesanan_status'] ?></h6>
                                    <?php if(!empty($data['barang'])){ ?>
                                    <p>Rincian Barang:</p>
                                    <ul>
                                        <?php foreach ($data['barang'] as $row) : ?>
                                            <li><b>[<?= $row['barang_status'] ?>]</b> <?= $row['barang_name'] ?></li>
                                            <?php if($row['barang_status'] == 'Tunda'){ ?>
                                                <p>Keterangan: <?= $row['barang_keterangan'] ?></p>
                                            <?php } ?>
                                        <?php endforeach ?>
                                    </ul>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Image Showcases-->
        <section class="showcase">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('assets/images/samples/origami.jpg')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2>Fully Responsive Design</h2>
                        <p class="lead mb-0">When you use a theme created by Start Bootstrap, you know that the theme will look great on any device, whether it's a phone, tablet, or desktop the page will behave responsively!</p>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 text-white showcase-img" style="background-image: url('assets/images/samples/building.jpg')"></div>
                    <div class="col-lg-6 my-auto showcase-text">
                        <h2>Updated For Bootstrap 5</h2>
                        <p class="lead mb-0">Newly improved, and full of great utility classes, Bootstrap 5 is leading the way in mobile responsive web development! All of the themes on Start Bootstrap are now using Bootstrap 5!</p>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('assets/images/samples/jump.jpg')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2>Easy to Use & Customize</h2>
                        <p class="lead mb-0">Landing Page is just HTML and CSS with a splash of SCSS for users who demand some deeper customization options. Out of the box, just add your content and images, and your new landing page will be ready to go!</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonials-->
        <section class="testimonials text-center bg-light">
            <div class="container">
                <h2 class="mb-5">Testimoni...</h2>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <img class="img-fluid rounded-circle mb-3" src="<?= base_url('assets/images/faces/1.jpg')?>" alt="..." />
                            <h5>Margaret E.</h5>
                            <p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <img class="img-fluid rounded-circle mb-3" src="<?= base_url('assets/images/faces/2.jpg')?>" alt="..." />
                            <h5>Fred S.</h5>
                            <p class="font-weight-light mb-0">"Bootstrap is amazing. I've been using it to create lots of super nice landing pages."</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <img class="img-fluid rounded-circle mb-3" src="<?= base_url('assets/images/faces/3.jpg')?>" alt="..." />
                            <h5>Sarah W.</h5>
                            <p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Icons Grid-->
        <section class="features-icons bg-light text-center">
            <div class="container">
                <h2 class="mb-5">Pastikan</h2>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-exclamation-triangle m-auto text-primary"></i></div>
                            <h3>Tidak Mudah Pecah dan Rusak</h3>
                            <p class="lead mb-0">Paket anda bukan paket yang mudah pecah dan mudah rusak seperti makanan basah.!</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-stopwatch m-auto text-primary"></i></div>
                            <h3>Secepat Mungkin</h3>
                            <p class="lead mb-0">Paket anda bukan paket yang buru-buru, akan tetapi paket Anda akan diantar secepat mungkin di hari yang sama!</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-cash-coin m-auto text-primary"></i></div>
                            <h3>Cek Harga</h3>
                            <p class="lead mb-0">Untuk pengiriman di luar kota Makassar, pastikan anda sudah mengecek ongkir dan wilayah yang dijangkau di sini [link]!</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-list-check m-auto text-primary"></i></div>
                            <h3>Cek Pesanan</h3>
                            <p class="lead mb-0">Setelah dijemput, cek untuk memastikan bahwa kurir sdh menginput semua paket anda dengan menggunakan kode resi. ANDALANTA tidak bertanggung jawab terhadap paket yg tidak diinput ke sistem!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Form Input -->
        <section class="testimonials text-center bg-light call-to-action2" id="contact">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="mb-4" <?php echo $setting['setting_status'] == 'Close' ? 'style="text-decoration: line-through;"' : '' ?>>Ayoo Pesann!</h2>
                <?php echo $setting['setting_status'] == 'Close' ? '<h2 class="mb-4">Maaf, Kami Tutup Sementara</h2>' : '' ?>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form class="form form-vertical" method="POST" action="<?php echo base_url('pesanan/store'); ?>">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="pesanan_name" placeholder="Enter your name..." <?php echo $setting['setting_status'] == 'Close' ? 'disabled' : '' ?>>
                                <label for="name">Nama</label>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" name="pesanan_toko" placeholder="Enter your name..." <?php echo $setting['setting_status'] == 'Close' ? 'disabled' : '' ?>>
                                <label for="email">Toko</label>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" name="pesanan_kontak" type="tel" placeholder="(123) 456-7890" <?php echo $setting['setting_status'] == 'Close' ? 'disabled' : '' ?>>
                                <label for="phone">Kontak</label>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="pesanan_alamat" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required" data-sb-can-submit="no" <?php echo $setting['setting_status'] == 'Close' ? 'disabled' : '' ?>></textarea>
                                <label for="message">Alamat</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="choices form-select" name="kecamatan" <?php echo $setting['setting_status'] == 'Close' ? 'disabled' : '' ?>>
                                    <option value="">Kecamatan</option>    
                                    <?php foreach($kecamatan as $key => $row){ ?>
                                        <option value="<?= $row['kecamatan_id']?>"><?= $row['kecamatan_name']?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="pesanan_sosmed" type="text" placeholder="fb/Ig" <?php echo $setting['setting_status'] == 'Close' ? 'disabled' : '' ?>>
                                <label for="phone">Sosmed</label>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br>
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            <button class="btn btn-primary btn-xl" id="submitButton" type="submit" <?php echo $setting['setting_status'] == 'Close' ? 'disabled' : '' ?>>Pesan</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Call to Action-->
        <section class="text-center bg-light features-icons">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    
                        <h2 class="mb-4">Ada Pertanyaan?? Hubungi Kami!</h2>
                        <!-- Signup form-->
                        <div class="col-lg-3">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <a href="<?php echo $setting['setting_link']; ?>" target="_blank">
                            <div class="features-icons-icon d-flex"><i class="bi-whatsapp m-auto text-primary"></i></div>
                            <h3>WhatsApp</h3>
                        </a>
                        <h5><?php echo $setting['setting_contact']; ?></h5>
                        <p>(atau tinggal klik icon WA di atas)</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                        <ul class="list-inline mb-2">
                            <li class="list-inline-item"><a href="#!">About</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Contact</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Terms of Use</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Privacy Policy</a></li>
                        </ul>
                        <p class="text-muted small mb-4 mb-lg-0">&copy; Andalanta Website 2021. All Rights Reserved.</p>
                    </div>
                    <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item me-4">
                                <a href="#!"><i class="bi-facebook fs-3"></i></a>
                            </li>
                            <li class="list-inline-item me-4">
                                <a href="#!"><i class="bi-twitter fs-3"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!"><i class="bi-instagram fs-3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="<?= base_url('assets/js/main.js')?>"></script>
        <script src="<?= base_url('landing/js/scripts.js')?>"></script>
        <script src="<?= base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.bundle.min.js')?>"></script>

        <script src="<?= base_url('assets/vendors/choices.js/choices.min.js')?>"></script>
        <script src="<?= base_url('assets/js/extensions/sweetalert2.js')?>"></script>
        <script src="<?= base_url('assets/vendors/sweetalert2/sweetalert2.all.min.js')?>"></script>

        <script src="<?= base_url('assets/js/main.js')?>"></script>
    </body>
</html>
