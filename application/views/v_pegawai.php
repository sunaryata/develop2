<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Yana Prototype I</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/toastr/build/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/adminlte/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
     <link rel="stylesheet" href="<?= base_url() ?>/assets/adminlte/css/skins/_all-skins.min.css">


     <!-- untuk button datatable export start -->


     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css">
     <!-- untuk button datatable export start -->






     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style type="text/css">

    #pegawai .sorting_asc, .sorting_desc {
        color: black;
    }
    #pegawai thead .sorting_desc {
        color: black;
    }


    #pegawai .sorting {
     color: black;
 }
</style>

</head>
<body class="hold-transition ">
    <div class="wrapper">



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Pegawai<small>List</small></h1>
            </section>
            
            <!-- Main content -->
            <section class="content">



                <div class="row">


                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">List Pegawai</h3>
                                <div class="pull-right box-tools">
                                    <button type="button" class="btn btn-info btn-sm check_kode" data-toggle="modal"data-target="#modal-default" title="Add New Pegawai">
                                        <i class="fa fa-plus"></i>
                                        &nbsp;&nbsp;Add Record
                                    </button>


                                </div>
                            </div>

                            <div id="paginatecustom"></div>
                            <div id="infocustom"></div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="pegawai" class="table table-bordered table-striped">
                                    fecha inicio: <input id="min" name="min" type="text" placeholder="Search by Date" /> fecha final: <input id="max" name="max" type="text" placeholder="Search by Date" />

                                    

                                    <thead>
                                        <tr>
                                            <th>Nama Pegawai</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            
                                            <th>Delete</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.box-body -->


                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div id="haha"></div>
            </section>
            <!-- /.content -->
        </div>

        
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Add Pegawai</h4>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control" placeholder="ID..." id="pegawai_id"/>
                            <input type="text" class="form-control" placeholder="Enter Nama Pegawai..." id="pegawai_name"/>
                            <input type="text" value="Belum Dibayar" class="form-control"  id="pegawai_status"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="add_pegawai">Add</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- Modal Delete Product -->
            <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-info">
                                Anda yakin mau menghapus data ini?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="text" name="id" class="id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary btn-delete">Yes</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Ubah Status -->
            <div class="modal fade" id="ModalStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-info">
                                Anda yakin mau Mengubah Status?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="text" name="id" class="id">
                            <input type="text" name="status" class="status">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary btn-status">Yes</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- ./wrapper -->
        
        <!-- jQuery 3 -->
        <script src="<?= base_url() ?>/assets/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?= base_url() ?>/assets/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="<?= base_url() ?>/assets/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>/assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="<?= base_url() ?>/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?= base_url() ?>/assets/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url() ?>/assets/adminlte/js/adminlte.min.js"></script>
        <!-- Toastr -->
        <script src="<?= base_url() ?>/assets/toastr/build/toastr.min.js"></script>
        <!-- Socket.IO -->
        <script src="<?= base_url() ?>/assets/socket.io/dist/socket.io.js"></script>



        <!--   script button datatable export start -->
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap4.min.js"></script>
        <script  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        <script  src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>

        <!--   script button datatable export end -->



        <!-- page script -->
        <?php $this->load->view('pegawai_event') ?>
    </body>
    </html>