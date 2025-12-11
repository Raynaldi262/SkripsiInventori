<?php require('../model/AdminBarang.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Data Admin</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
</head>
<style>
    #tambah_data {
        margin-left: 60%;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <div class="" id="include-navbar"></div>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left" id="data_admin">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Barang Keluar</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data INVENTORI</h3>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-tambahAdmin" id="tambah_data">
                                        Tambah
                                    </button>
                                </div>
                                <!-- /.card-header -->
                                <div class=" card-body">
                                    <table id="dataAdmin" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Transaksi</th>
                                                <th>Tanggal Keluar</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah Keluar</th>
                                                <th>Satuan Barang</th>
                                                <th>Tujuan</th>
                                                <th>Pengaturan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            while ($data = mysqli_fetch_assoc($keluar)) { ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $data['id_transaksi']; ?></td>
                                                    <td><?php echo $data['tanggal']; ?></td>
                                                    <td><?php echo $data['kode_barang']; ?></td>
                                                    <td><?php echo $data['nama_barang']; ?></td>
                                                    <td><?php echo $data['jumlah']; ?></td>
                                                    <td><?php echo $data['satuan']; ?></td>
                                                    <td><?php echo $data['tujuan']; ?></td>
                                                    <td>
                                                            <form action="../model/AdminBarang.php" method="post">
                                                                <input type="hidden" name="admin_id" value="<?php echo $data['id'] ?>">
                                                                <input type="hidden" name="kode_barang" value="<?php echo $data['kode_barang'] ?>">
                                                                <input type="hidden" name="jmlh_barang" value="<?php echo $data['jumlah'] ?>">
                                                                <button type="submit" name="deleteKeluar" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                                            </form>
                                                    </td>
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
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>INVENTORI</a></strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- modal tambah data -->
    <div class="modal fade" id="modal-tambahAdmin">
        <div class="modal-dialog">
            <div class="modal-content col-20">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/AdminBarang.php" method="post">
                       
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">ID Transaksi </div>
                            <input type="text" class="form-control" placeholder="id" name="trx" value="<?php echo getFormatKeluar() ?>" readonly>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Tanggal Keluar </div>
                            <input type="date" class="form-control" placeholder="Tanggal" name="tgl">
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                             <div class="col-5 input-group-text">Barang : </div>
                            <select id="barang" name="barang" required >
                                <?php while($row = mysqli_fetch_assoc($data_barang)){ ?>
                                <option value="<?= $row['kode_barang']; ?>">
                                    <?= $row['kode_barang'] . " | " .  $row['nama_barang'] . " | " .  $row['jumlah'] ; ?>
                                </option>
                            <?php } ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Jumlah : </div>
                            <input type="number" class="form-control" placeholder="Jumlah" name="jmlh">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Tujuan : </div>
                            <input type="text" class="form-control" placeholder="Tujuan" name="tujuan">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success" name="insert_keluar" value="Tambah Data">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal tambah data -->

    
    <!-- /.modal Edit data-->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Page specific script -->
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

        $(function() {
            $("#include-navbar").load("left-navbar.php");
        });

        $(document).on("click", ".adminData", function() {
            var adminID = $(this).attr('id');
            $.ajax({
                url: "../model/AdminBarang.php", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    edit_supplier: 1,
                    admin_id: adminID
                },
                success: function(data) {
                    console.log(data)
                    $("#edt_id").val(data.id);
                    $("#edt_ks").val(data.kode_supplier);
                    $("#edt_ns").val(data.nama_supplier);
                    $("#edt_alamat").val(data.alamat);
                    $("#edt_hp").val(data.telepon);

                },
                error: function(xhr, status, error) {
                    console.log("AJAX ERROR:", error);
                    console.log("RESPONSE TEXT:", xhr.responseText);
                }

            });
        });
    </script>
</body>

</html>