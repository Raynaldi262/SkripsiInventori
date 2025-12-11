<?php
require('../model/laporan.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Laporan Gudang</title>

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
                                <li class="breadcrumb-item active">Laporan Gudang</li>
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
                            
                                    <table id="example1" class="table table-bordered table-striped">
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
    let judul = "Laporan_Stok_Gudang - " + d + "-" + m + "-" + y;

        $('#example1').DataTable({
        dom: 'Bfrtip',
        buttons: [
        {
            extend: 'excelHtml5',
            title: judul,
            messageTop: 'Laporan Stok Gudang',
            exportOptions: {
                columns: [0,1,2,3,4,5], // Kolom yang diexport
                modifier: { page: 'current' }
            }
        }
    ]
});
    </script>
</body>

</html>