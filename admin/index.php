<?php session_start();?><!DOCTYPE html>
<?php
include '../_db.php';

if(!isset($_SESSION['level'])){
    eksyen('','../');
}

$db = new Database();
$db->connect();
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrasi - <?=TITLE;?></title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../dist/css/nprogress.css" rel="stylesheet">
    <link href="../dist/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../dist/js/nprogress.js"></script>
    <script src="../dist/js/raphael-min.js"></script>
    <script src="../dist/js/morris.min.js"></script>

    <!-- Just Number -->
    <script src="../js/isNumber.js"></script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?=TITLE;?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?=strtoupper($_SESSION['username']);?> [<?=$_SESSION['level'];?>]  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="?p=profil"><i class="fa fa-user fa-fw"></i> Ubah Profil</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php include 'menu.php';?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <?php 
                    if(isset($_GET['p'])){
                        if(file_exists($_GET['p'].'.php')){
                            include $_GET['p'].'.php';
                        }else{
                            eksyen('Halaman tidak ditemukan','index.php');
                        }
                    }else{
                    ?>
                    <?php if($_SESSION['level']=='Admin' or $_SESSION['level']=='Direktur'){ ?>
                    <h1>Admin Panel</h1>
                    <?php
                    $qj = mysql_query("select * from jabatan");
                    $dj = mysql_num_rows($qj);
                    ?>
                    <div class="col-lg-4">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-th-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?=$dj;?></div>
                                        <div>Data Jabatan</div>
                                    </div>
                                </div>
                            </div>
                            <a href="?p=jabatan">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                    $qj = mysql_query("select * from users");
                    $dj = mysql_num_rows($qj);
                    ?>
                    <div class="col-lg-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-group fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?=$dj;?></div>
                                        <div>Data Pegawai</div>
                                    </div>
                                </div>
                            </div>
                            <a href="?p=user">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                    $qj = mysql_query("select id,sum(total) as total from gaji");
                    $dj = mysql_num_rows($qj);
                    $ddj = mysql_fetch_array($qj);
                    ?>
                    <div class="col-lg-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-euro fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">Penggajian</div>
                                        <div>Rp.<?=number_format($ddj['total'],0,',','.');?></div>
                                    </div>
                                </div>
                            </div>
                            <a href="?p=laporan_gaji">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php } // end of session admin ?>


                    <?php if($_SESSION['level']=='Pegawai'){ ?>
                    <p class="lead"></p>
                    <p class="lead text-center">Selamat datang di Sistem Informasi Penggajian Karyawan.</p>
                    <p class="lead page-header text-center">Disini Anda dapat mencetak slip gaji secara mandiri (Online).</p>
                    <a href="?p=kwitansi" class="btn btn-primary btn-block btn-lg">Cetak Slip Gaji</a>
                    <?php } // end of session pegawai ?>



                    <?php } // end of else MENU ?>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script>
    $(document).ready(function() {

        // jQuery DataTables
        $('#tbl,#tbl2,#tbl3').DataTable({
            responsive: true
        });
        // end of jQuery DataTables

        // jQuery SelectAll
        $('#select_all').on('click',function(){
            if(this.checked){
                $('.checkbox').each(function(){
                    this.checked = true;
                });
            }else{
                 $('.checkbox').each(function(){
                    this.checked = false;
                });
            }
        });        
        $('.checkbox').on('click',function(){
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#select_all').prop('checked',true);
            }else{
                $('#select_all').prop('checked',false);
            }
            // cara pemakaian
            // pada th : <input type="checkbox" id="select_all" />
            // pada td : <input type="checkbox" class="checkbox" value="1"/>
        });
        // end of jQuery SelectAll

    });
    </script>

</body>

</html>