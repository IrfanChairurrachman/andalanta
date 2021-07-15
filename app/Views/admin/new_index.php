<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <h3>Dashboard Admin Andalanta</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pesanan Belum Selesai</h6>
                                    <h6 class="font-extrabold mb-0"><?= $pesanan ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Barang Belum Selesai</h6>
                                    <h6 class="font-extrabold mb-0"><?= $barang ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Barang Masuk</h6>
                                    <h6 class="font-extrabold mb-0"><?= $barang_masuk ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Barang Keluar</h6>
                                    <h6 class="font-extrabold mb-0"><?= $barang_keluar ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="card">
            <div class="card-header">
                <h5>Pilih Waktu</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo base_url('admin'); ?>">
                    <label for="start">Start:</label>
                    <input type="date" name="start" value="<?php echo empty($start) ? '' : $start ?>">
                    <label for="end">End:</label>
                    <input type="date" name="end" value="<?php echo empty($end) ? '' : $end ?>">
                    <button type="submit" class="btn btn-dark">Pilih</button>
                </form>
            </div>
            </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Grafik per Bulan </h4>
                        </div>
                        <div class="card-body">
                            <canvas id="grafik"></canvas>
                            <?php 
                                if(!empty($grafik_barang)){
                                    foreach($grafik_barang as $data){
                                        $btotal[] = $data['total'];
                                        $bmonth[] = $data['month'];
                                    }
                                }
                            ?>
                            <?php 
                                if(!empty($grafik_pesanan)){
                                    foreach($grafik_pesanan as $data){
                                        $ptotal[] = $data['total'];
                                        $pmonth[] = $data['month'];
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Grafik Pesanan per Kecamatan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="grafik1"></canvas>
                            <?php 
                                if(!empty($grafik_pesanan_kecamatan)){
                                    foreach($grafik_pesanan_kecamatan as $data){
                                        $pktotal[] = $data['total'];
                                        $pkkecamatan[] = $data['kecamatan'];
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Grafik Barang per Kecamatan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="grafik2"></canvas>
                            <?php 
                                if(!empty($grafik_barang_masuk)){
                                    foreach($grafik_barang_masuk as $data){
                                        $bmtotal[] = $data['total'];
                                        $bmkecamatan[] = $data['kecamatan'];
                                    }
                                }
                            ?>
                            <?php 
                                if(!empty($grafik_barang_keluar)){
                                    foreach($grafik_barang_keluar as $data){
                                        $bktotal[] = $data['total'];
                                        $bkkecamatan[] = $data['kecamatan'];
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="/assets/images/faces/1.jpg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold"><?= $user['name'] ?></h5>
                            <h6 class="text-muted mb-0"><?= $user['username'] ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="<?= base_url('assets/vendors/apexcharts/apexcharts.js')?>"></script>
<script src="<?= base_url('assets/js/pages/dashboard.js')?>"></script>
<script src="<?= base_url('assets/vendors/chartjs/Chart.min.js')?>"></script>
<script src="<?= base_url('assets/js/pages/ui-chartjs.js')?>"></script>

<?php if(!empty($grafik_barang)){?>
<script>
var chart2 = document.getElementById("grafik").getContext('2d');
var areaChart2 = new Chart(chart2, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($bmonth); ?>,
    datasets: [
      {
        label: "Pesanan",
        data: <?php echo json_encode($ptotal); ?>,
        backgroundColor: [
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
        ],
        borderColor: [
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
        ],
        borderWidth: 1
      },
      {
        label: "Barang",
        data: <?php echo json_encode($btotal); ?>,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
        ],
        borderWidth: 1
      }
    ]
  },
  options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
  }
});
</script>
<?php } ?>

<?php if(!empty($grafik_pesanan_kecamatan)){?>
<script>
var chart = document.getElementById("grafik1").getContext('2d');
var areaChart = new Chart(chart, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($pkkecamatan); ?>,
    datasets: [
        {
        label: "Pesanan",
        data: <?php echo json_encode($pktotal); ?>,
        backgroundColor: [
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
        ],
        borderColor: [
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
        ],
        borderWidth: 1
      }
    ]
  },
  options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
  }
});
</script>
<?php } ?>

<?php if(!empty($grafik_barang_masuk)){?>
<script>
var chart1 = document.getElementById("grafik2").getContext('2d');
var areaChart1 = new Chart(chart1, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($bkkecamatan); ?>,
    datasets: [
        {
        label: "Barang Masuk",
        data: <?php echo json_encode($bmtotal); ?>,
        backgroundColor: [
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(54, 162, 253, 0.2)',
        ],
        borderColor: [
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(54, 162, 253, 1)',
        ],
        borderWidth: 1
      },
      {
        label: "Barang Keluar",
        data: <?php echo json_encode($bktotal); ?>,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.2)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 99, 132, 1)',
        ],
        borderWidth: 1
      }
    ]
  },
  options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
  }
});
</script>
<?php } ?>
<?= $this->endSection() ?>
