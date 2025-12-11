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
                                <li class="breadcrumb-item active">Data Barang</li>
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
                                        Tambah Barang
                                    </button>
                                </div>
                                <!-- /.card-header -->
                                <div class=" card-body">
                                    <table id="dataAdmin" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jenis Barang</th>
                                                <th>Jumlah Barang</th>
                                                <th>Satuan</th>
                                                <th>Foto</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            while ($data = mysqli_fetch_assoc($data_barang)) { ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $data['kode_barang']; ?></td>
                                                    <td><?php echo $data['nama_barang']; ?></td>
                                                    <td><?php echo $data['jenis_barang']; ?></td>
                                                    <td><?php echo $data['jumlah']; ?></td>
                                                    <td><?php echo $data['satuan']; ?></td>
                                                    <td><img src="../dist/img/barang/<?php echo $data['foto'] ?>"width="50" height="50" alt=""></td>
                                                    <td>
                                                            <button type="button" class="btn btn-success adminData" data-toggle="modal" data-target="#modal-adminData" id="<?php echo $data['id']; ?>">
                                                                Ubah
                                                            </button>
                                                            <button type="button" class="btn btn-success adminDataDetail" data-toggle="modal" data-target="#modal-adminDataDetail" id="<?php echo $data['kode_barang']; ?>">
                                                                Detail
                                                            </button>
                                                            <form action="../model/AdminBarang.php" method="post">
                                                                <input type="hidden" name="admin_id" value="<?php echo $data['id'] ?>">
                                                                <button type="submit" name="deleteBarang" class="btn btn-danger"><i class="fas fa-times"></i></button>
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
            <div class="modal-content col-8">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/AdminBarang.php" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Kode : </div>
                            <input type="text" class="form-control" placeholder="Kode" name="kode" value="<?php echo getFormat(); ?>" readonly>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Nama : </div>
                            <input type="text" class="form-control" placeholder="Nama Barang" name="nama">
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Jenis : </div>
                            <select id="jenis" name="jenis" required >
                                <?php while($row = mysqli_fetch_assoc($jenis_barang)){ ?>
                                <option value="<?= $row['jenis_barang']; ?>">
                                    <?= $row['jenis_barang']; ?>
                                </option>
                            <?php } ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Jumlah : </div>
                            <input type="number" class="form-control" placeholder="Jmlh" name="jmlh" value="0" readonly>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Satuan : </div>
                            <select id="satuan" name="satuan" required >
                                <?php while($row = mysqli_fetch_assoc($satuan_barang)){ ?>
                                <option value="<?= $row['satuan']; ?>">
                                    <?= $row['satuan']; ?>
                                </option>
                            <?php } ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name"><b> Foto </b></label>
                            <input type="file" name="img" />
                        </div>
                        <input type="submit" class="btn btn-success" name="insert_barang" value="Tambah Data">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal tambah data -->

    <!-- modal Edit Data -->
        <div class="modal fade" id="modal-adminData">
        <div class="modal-dialog">
            <div class="modal-content col-8">
                <div class="modal-header">
                    <h4 class="modal-title">Update Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <form action="../model/AdminBarang.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="edt_id" id="edt_id">
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Kode : </div>
                            <input type="text" class="form-control" placeholder="Kode" name="edt_kode" id="edt_kode" readonly>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Nama : </div>
                            <input type="text" class="form-control" placeholder="Nama Barang" name="edt_nama" id="edt_nama">
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Jenis : </div>
                            <select id="jenis" name="edt_jenis" id="edt_jenis" required >
                                <?php while($row = mysqli_fetch_assoc($jenis_barang2)){ ?>
                                <option value="<?= $row['jenis_barang']; ?>">
                                    <?= $row['jenis_barang']; ?>
                                </option>
                            <?php } ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-5 input-group-text">Satuan : </div>
                            <select id="satuan" name="edt_satuan" id="edt_satuan" required >
                                <?php while($row = mysqli_fetch_assoc($satuan_barang2)){ ?>
                                <option value="<?= $row['satuan']; ?>">
                                    <?= $row['satuan']; ?>
                                </option>
                            <?php } ?>
                            </select>
                            <div class="input-group-append">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name"><b> Foto </b></label>
                            <input type="file" name="edt_img" id="edt_img" />
                        </div>
                        <input type="submit" class="btn btn-success" name="save_barang" value="Edit Data">
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Edit data-->

    <!-- modal Edit Data -->
    <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataModalLabel">Data Barang Masuk & Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                <!-- Tabel 1: Barang Masuk -->
                <div class="col-md-6">
                    <h6>Barang Masuk</h6>
                    <table id="tableMasuk" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                        <th>ID Transaksi</th>
                        <th>Jumlah</th>
                        <th>Pengirim</th>
                        <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    </table>
                </div>

                <!-- Tabel 2: Barang Keluar -->
                <div class="col-md-6">
                    <h6>Barang Keluar</h6>
                    <table id="tableKeluar" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                        <th>ID Transaksi</th>
                        <th>Jumlah</th>
                        <th>Tujuan</th>
                        <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>

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
                    edit_barang: 1,
                    admin_id: adminID
                },
                success: function(data) {
                    console.log(data)
                    $("#edt_id").val(data.id);
                    $("#edt_kode").val(data.kode_barang);
                    $("#edt_nama").val(data.nama_barang);
                    $("#edt_jenis").val(data.jenis_barang);
                    $("#edt_satuan").val(data.satuan);
                },
                error: function(xhr, status, error) {
                    console.log("AJAX ERROR:", error);
                    console.log("RESPONSE TEXT:", xhr.responseText);
                }

            });
        });

        $(document).ready(function() {

            var tableMasuk = $("#tableMasuk").DataTable({
                responsive: true,
                paging: true,
                searching: true,
                data: [],  // kosong dulu
                columns: [
                    { data: "id_transaksi" },
                    { data: "jumlah" },
                    { data: "pengirim" },
                    { data: "satuan" }
                ]
            });

            var tableKeluar = $("#tableKeluar").DataTable({
                responsive: true,
                paging: true,
                searching: true,
                data: [],
                columns: [
                    { data: "id_transaksi" },
                    { data: "jumlah" },
                    { data: "tujuan" },
                    { data: "satuan" }
                ]
            });

            $(document).on("click", ".adminDataDetail", function(){
                var adminID = $(this).attr('id');

                // Tampilkan modal
                var modal = new bootstrap.Modal(document.getElementById('dataModal'));
                modal.show();

                $.ajax({
                url: "../model/AdminBarang.php", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    detail_masuk: 1,
                    admin_id: adminID
                },
                success: function(data) {
                    console.log(data)
                    tableMasuk.clear();
                    tableMasuk.rows.add(data);  // res harus array objek
                    tableMasuk.draw();
                },
                error: function(xhr, status, error) {
                    console.log("AJAX ERROR:", error);
                    console.log("RESPONSE TEXT:", xhr.responseText);
                }

                });

                $.ajax({
                url: "../model/AdminBarang.php", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {
                    detail_keluar: 1,
                    admin_id: adminID
                },
                success: function(data) {
                    console.log(data)
                    tableKeluar.clear();
                    tableKeluar.rows.add(data);  // res harus array objek
                    tableKeluar.draw();
                },
                error: function(xhr, status, error) {
                    console.log("AJAX ERROR:", error);
                    console.log("RESPONSE TEXT:", xhr.responseText);
                }

                });

            });

            });


    </script>
</body>

</html>