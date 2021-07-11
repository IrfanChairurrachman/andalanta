<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <h3>Dashboard Admin Andalanta</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pesanan Sukses</h6>
                                    <h6 class="font-extrabold mb-0"><?= $pesanan ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Barang Sukses</h6>
                                    <h6 class="font-extrabold mb-0"><?= $barang ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Kurir</h6>
                                    <h6 class="font-extrabold mb-0"><?= $kurir ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Grafik per Bulan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="grafik"></canvas>
                            <?php 
                                if(isset($grafik_barang)){
                                    foreach($grafik_barang as $data){
                                        $btotal[] = $data['total'];
                                        $bmonth[] = $data['month'];
                                    }
                                }
                            ?>
                            <?php 
                                if(isset($grafik_pesanan)){
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
                            <h4>Grafik per Kecamatan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="grafik1"></canvas>
                            <?php 
                                if(isset($grafik_barang_kecamatan)){
                                    foreach($grafik_barang_kecamatan as $data){
                                        $bktotal[] = $data['total'];
                                        $bkkecamatan[] = $data['kecamatan'];
                                    }
                                }
                            ?>
                            <?php 
                                if(isset($grafik_pesanan_kecamatan)){
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

<?php if(isset($grafik_barang)){?>
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
        ],
        borderColor: [
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
        ],
        borderColor: [
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
      },
      {
        label: "Barang",
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
