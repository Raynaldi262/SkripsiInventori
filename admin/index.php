<?php require('../model/AdminDash.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

</head>

<?php
//login confirmation
confirm_logged_in();
?>
<style>
  img {
    max-height: 200px;
    max-width: 200px;
  }
  
#chart-container {
    width: 100%;
    height: 350px;
}
</style>

<?php
$notif = '';

if (isset($_GET['success'])) {
    $notif = 'success';
}

if (isset($_GET['error'])) {
    $notif = 'error';
}
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Right navbar -->
    <div class="" id="include-navbar"></div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-left" id="home">
                <li class="breadcrumb-item">Home</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- <div id="chart-container">
              <canvas id="myChart" height="120"></canvas>
          </div> -->
          
          <div class="row">
            <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                            
                                    <table id="dataAdmin" class="table table-bordered table-striped">
                                        <thead>
                                            <tr align="center">
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jenis Barang</th>
                                                <th>Jumlah Barang</th>
                                                <th>Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            while ($data = mysqli_fetch_array($gudang)) { ?>
                                                <tr align="center">
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $data['kode_barang']; ?></td>
                                                    <td><?php echo $data['nama_barang']; ?></td>
                                                    <td><?php echo $data['jenis_barang']; ?></td>
                                                    <td><?php echo $data['jumlah']; ?></td>
                                                    <td><?php echo $data['satuan']; ?></td>
                                                </tr>
                                            <?php $i++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

            <?php if ($_SESSION['role_id'] == 1) { ?>
            <div class="col-lg-3 col-6">
              
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <p>Data Users</p>
                </div>
                <a href="user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
           <?php } ?>
           
           <?php if ($_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 2) { ?>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <p>Data Supplier</p>
                </div>
                <a href="supplierBarang.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <p>Data Gudang</p>
                  </div>
                  <a href="barang.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <p>Barang Masuk</p>
                  </div>
                  <a href="barangMasuk.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <p>Barang Keluar</p>
                  </div>
                  <a href="barangKeluar.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <?php } ?>
            <!-- ./col -->
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>INVENTORI</a></strong>
    </footer>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>


<script>
          $(function() {
            $("#dataAdmin").DataTable({
                "scrollX": true,
                "responsive": false,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "autoWidth": false,
            })
        });

        
fetch("../model/data_chart.php")
    .then(res => res.json())
    .then(data => {
        const ctx = document.getElementById("myChart").getContext("2d");
        const dynamicColors = data.labels.map(() => {
                const r = Math.floor(Math.random() * 255);
                const g = Math.floor(Math.random() * 255);
                const b = Math.floor(Math.random() * 255);
                return `rgba(${r}, ${g}, ${b}, 0.6)`;
            });
        
        new Chart(ctx, {
            type: "bar",
            data: {
                labels: data.labels,
                datasets: [{
                    label: "Stok Barang diGudang",
                    data: data.values,
                    backgroundColor: dynamicColors,
                    borderColor: dynamicColors.map(color =>
                            color.replace("0.6", "1")
                        ),
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "Jumlah"
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: "Nama Barang"
                        }
                    }
                }
            }
        });
    });
</script>


<script>
  $(function() {
    $("#include-navbar").load("left-navbar.php");
  });
</script>
  </body>


</html>