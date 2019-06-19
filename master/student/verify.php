<?php

    session_start();
    ob_start();

    include_once '../php/dbconnect.php';
    include_once '../php/titlebar.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    ob_end_flush();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php $title = new Titlebar(); ?>
    <title><?php echo $title->studentresult;?></title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Google Thai Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Chakra+Petch" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />

    <style rel="stylesheet" type="text/css">
		#menu, span, h2, label, table, .dropdown-menu, h4, button {font-family: 'Chakra Petch', sans-serif;}
    </style>

</head>

<body class="theme-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <?php include_once 'include/navbar.php'; ?>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <?php include_once 'include/user_info.php'; ?>
            <!-- #User Info -->
            <!-- Menu -->
            <?php include_once 'include/menu.php'; ?>
            <!-- #Menu -->
            <!-- Footer -->
            <?php include_once 'include/footer.php'; ?>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- <div class="block-header">
                <h2>BLANK PAGE</h2>
            </div> -->

            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ทวนสอบผลสัมฤทธิ์ รายวิชา 477-301
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#" data-toggle="modal" data-target="#defaultModal">เพิ่มข้อมูล</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form action="#" method="POST">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ผลการเรียนรู้</th>
                                                <th class="text-center">คะแนน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td class="text-center">
                                                    <div class="form-line">
                                                        <input type="radio" name="score_elo1" id="score_51" class="with-gap">
                                                        <label for="score_51">5</label>
                                                        <input type="radio" name="score_elo1" id="score_41" class="with-gap">
                                                        <label for="score_41" class="m-l-10">4</label>
                                                        <input type="radio" name="score_elo1" id="score_31" class="with-gap">
                                                        <label for="score_31" class="m-l-10">3</label>
                                                        <input type="radio" name="score_elo1" id="score_21" class="with-gap">
                                                        <label for="score_21" class="m-l-10">2</label>
                                                        <input type="radio" name="score_elo1" id="score_11" class="with-gap">
                                                        <label for="score_11" class="m-l-10">1</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td class="text-center">
                                                    <div class="form-line">
                                                        <input type="radio" name="score_elo2" id="score_52" class="with-gap">
                                                        <label for="score_52">5</label>
                                                        <input type="radio" name="score _elo2" id="score_42" class="with-gap">
                                                        <label for="score_42" class="m-l-10">4</label>
                                                        <input type="radio" name="score_elo2" id="score_32" class="with-gap">
                                                        <label for="score_32" class="m-l-10">3</label>
                                                        <input type="radio" name="score_elo2" id="score_22" class="with-gap">
                                                        <label for="score_22" class="m-l-10">2</label>
                                                        <input type="radio" name="score_elo2" id="score_12" class="with-gap">
                                                        <label for="score_12" class="m-l-10">1</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td class="text-center">
                                                    <div class="form-line">
                                                        <input type="radio" name="score_elo3" id="score_53" class="with-gap">
                                                        <label for="score_53">5</label>
                                                        <input type="radio" name="score_elo3" id="score_43" class="with-gap">
                                                        <label for="score_43" class="m-l-10">4</label>
                                                        <input type="radio" name="score_elo3" id="score_33" class="with-gap">
                                                        <label for="score_33" class="m-l-10">3</label>
                                                        <input type="radio" name="score_elo3" id="score_23" class="with-gap">
                                                        <label for="score_23" class="m-l-10">2</label>
                                                        <input type="radio" name="score_elo3" id="score_13" class="with-gap">
                                                        <label for="score_13" class="m-l-10">1</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <button type="submit" class="btn btn-primary m-t-15 waves-effect">บันทึก</button> -->
                                <button type="submit" class="btn bg-blue-grey waves-effect"><i
                                    class="material-icons">save</i><span>บันทึก</span></button>
                                <button type="reset" class="btn bg-grey waves-effect" data-dismiss="modal"><i
                                    class="material-icons">cancel</i><span>ยกเลิก</span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
    </section>
    <!-- Default Size -->

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Sweetalert Plugin Js -->
    <script src="../plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/jquery-datatable.js"></script>
    <script src="../js/dialogs.js"></script>

    <!-- Demo Js -->
    <!-- <script src="../../js/demo.js"></script> -->
</body>

</html>
