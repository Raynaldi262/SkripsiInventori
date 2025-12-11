<?php
require('../model/laporan.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Laporan Keluar</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

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
                            <ol class="breadcrumb float-sm-left" id="laporan_pesanan">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Laporan Keluar</li>
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
                                <!-- /.card-header -->
                                <div class="card-body">
                                <form method="POST">
                                        <table align="center" border="0" bordercolor="black">
                                            <tr>
                                                <td><b>Dari Tanggal</b></td>
                                                <td>
                                                    <input type="date" id="start" name="start" required>
                                                </td>
                                                <td><b>Sampai Tanggal</b></td>
                                                <td><input type="date" id="end" name="end" required></td>
                                                <td><input type="submit" value="Cari" class="btn-info" id="cari" name="search"></td>
                                            </tr>
                                        </table>
                                    </form>
                                    <br>
                                    <?php
                                    if (isset($_POST['search'])) {
                                        $start = date("d-m-Y", strtotime($_POST['start']));
                                        $end = date("d-m-Y", strtotime($_POST['end']));
                                    ?> <p align="center" class="title"><?php
                                                                        echo 'Data tanggal ' . $start . ' sampai tanggal ' . $end;  ?>
                                        </p><?php ?>
                                        <form action="">
                                            <input type='hidden' name='ins_start' id='ins_start' value='<?php echo $_POST['start']; ?>'>
                                            <input type='hidden' name='ins_end' id='ins_end' value='<?php echo $_POST['end']; ?>'>
                                        </form>
                                    <?php
                                    } else {
                                    ?>
                                        <form action="">
                                            <input type='hidden' name='ins_start' id='ins_start' value=''>
                                            <input type='hidden' name='ins_end' id='ins_end' value=''>
                                        </form>
                                    <?php
                                    } ?>
                                    <br>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr align="center">
                                                <th>No</th>
                                                <th>ID Transaksi</th>
                                                <th>Tanggal Keluar</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Tujuan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            if (isset($_POST['search'])) {
                                                $start = $_POST['start'];
                                                $end = $_POST['end'];

                                                $sql = "select *
                                                        from barang_keluar
                                                        where tanggal >= '" . $start . " 00:00:00' and tanggal <= '" . $end . " 00:00:00'";
                                                $getStok = mysqli_query($conn, $sql);
                                            } else {
                                                $sql = "select *
                                                        from barang_keluar";
                                                $getStok = mysqli_query($conn, $sql);
                                            }
                                            while ($data = mysqli_fetch_array($getStok)) { ?>
                                                <tr align="center">
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $data['id_transaksi']; ?></td>
                                                    <td><?php echo $data['tanggal']; ?></td>
                                                    <td><?php echo $data['kode_barang']; ?></td>
                                                    <td><?php echo $data['nama_barang']; ?></td> 
                                                    <td><?php echo $data['jumlah']; ?></td>
                                                    <td><?php echo $data['tujuan']; ?></td>
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
            <strong>Inventori</a></strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

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
    <script src="../plugins/datatables-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <!-- Page specific script -->
    <script>
        // $(function() {
        //     var judul = $('.title').text();
        //     $("#example1").DataTable({
        //         "responsive": true,
        //         "autoWidth": false,
        //         "lengthMenu": [
        //             [10, 25, 50, -1],
        //             [10, 25, 50, "All"]
        //         ],
        //         "scrollX": true,
        //         "buttons": [{
        //                 extend: "excel",
        //                 messageTop: judul,
        //                 exportOptions: {
        //                     columns: [0, 1, 2, 3, 4],
        //                     modifier: {
        //                         page: "current"
        //                     }
        //                 }
        //             }, {
        //                 text: 'PDF',
        //                 action: function(e, dt, node, config) {
        //                     var start = $('#ins_start').val();
        //                     var end = $('#ins_end').val();
        //                     window.location.href = 'laporan_supplier_pdf.php'
        //                 }
        //             },
        //             // {
        //             //     extend: "pdf",
        //             //     messageTop: judul,
        //             //     exportOptions: {
        //             //         columns: [0, 1, 2, 3, 4],
        //             //         modifier: {
        //             //             page: "current"
        //             //         }
        //             //     }
        //             // }, 
        //             "colvis"
        //         ]
        //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        // });

        $(function() {
            $("#include-navbar").load("left-navbar.php");
        });

        $('#start').change(function() {
            var a = $(this).val();
            $('#end').attr('min', a);
            $('#end').val('');
        })

        let today = new Date();
    let d = today.getDate().toString().padStart(2, '0');
    let m = (today.getMonth() + 1).toString().padStart(2, '0');
    let y = today.getFullYear();

    // Format judul
    let judul = "Laporan_Barang_Keluar - " + d + "-" + m + "-" + y;

        $('#example1').DataTable({
        dom: 'Bfrtip',
        buttons: [
        {
            extend: 'excelHtml5',
            title: judul,
            messageTop: '',
            exportOptions: {
                columns: [0,1,2,3,4,5,6], // Kolom yang diexport
                modifier: { page: 'current' }
            },
            action: function (e, dt, button, config) {

       
        var start = $('#ins_start').val();
        var end = $('#ins_end').val();
        var msgTop = "Laporan Barang Keluiar Tanggal " + start + " sampai " + end;
        
        config.messageTop = msgTop;

        // 🔹 Jalankan export default
        $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, button, config);
        }
        
        }
    ]
});
    </script>
</body>

</html>