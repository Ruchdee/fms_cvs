<?php 

    session_start();
    ob_start();

    include_once '../php/dbconnect.php';
    include_once '../php/tb_major.php';
    include_once '../php/tb_course.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $course = new Course($db);

    //read all records
    $is_mapped = true;
    $result = $course->readallmapping($is_mapped);

    $major = new Major($db);

    ob_end_flush();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Blank Page | Bootstrap Based Admin Template - Material Design</title>
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

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />

    <style rel="stylesheet" type="text/css">
		#menu, span, h2, label, table, .dropdown-menu, h4, button {font-family: 'Chakra Petch', sans-serif;}

        /* CSS used here will be applied after bootstrap.css */
        #modal-elo-mapping, #modal-update {
            overflow-y: initial !important
        }
        #modal-body-elo-mapping, #modal-body-update {
            height: 400px;
            overflow-y: auto;
        }
    </style>
    
</head>

<body class="theme-red">
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
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="#">FMSCVS - Course Verification System</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
                    <div class="email">john.doe@example.com</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="settings.php">
                            <i class="material-icons">settings</i>
                            <span>ข้อมูลการตั้งค่า (System Settings)</span>
                        </a>
                    </li>
                    <li>
                        <a href="department.php">
                            <i class="material-icons">view_list</i>
                            <span>ภาควิชา (Department)</span>
                        </a>
                    </li>
                    <li>
                        <a href="major.php">
                            <i class="material-icons">layers</i>
                            <span>สาขาวิชา (Major)</span>
                        </a>
                    </li>
                    <li>
                        <a href="course.php">
                            <i class="material-icons">assignment</i>
                            <span>รายวิชา (Course)</span>
                        </a>
                    </li>
                    <li>
                        <a href="elo_list.php">
                            <i class="material-icons">widgets</i>
                            <span>ผลการเรียนรู้ (ELOs)</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#">
                            <i class="material-icons">swap_calls</i>
                            <span>ผลการเรียนรู้สู่รายวิชา (Curriculum Mapping)</span>
                        </a>
                    </li>
                    <li class="header">OPTIONS</li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-red">announcement</i>
                            <span>แจ้งข่าว/ประกาศ</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-amber">donut_large</i>
                            <span>Warning</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Information</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2019 <a href="javascript:void(0);">FMS@Prince of Songkla University</a>
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
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
                                ผลการเรียนรู้สู่รายวิชา (Curriculum Mapping)
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="elo_mapping_search.php">ค้นหารายวิชา</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">สาขาวิชา</th>
                                            <th class="text-center">รหัสรายวิชา</th>
                                            <th>ชื่อรายวิชา (ไทย)</th>
                                            <th class="text-center">ผลการเรียนรู้ที่ประเมิน</th>
                                            <th class="text-center">...</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">สาขาวิชา</th>
                                            <th class="text-center">รหัสรายวิชา</th>
                                            <th>ชื่อรายวิชา (ไทย)</th>
                                            <th class="text-center">ผลการเรียนรู้ที่ประเมิน</th>
                                            <th class="text-center">...</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php
                                                    $major->major_id = $row['major_id'];
                                                    $result_major = $major->readone();
                                                    $row_major = mysqli_fetch_array($result_major);
                                                    echo $row_major['major_name_th'];
                                                ?>
                                            </td>
                                            <td class="text-center"><?php echo $row['course_code']; ?></td>
                                            <td><?php echo $row['course_name_th']; ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-xs bg-light-green waves-effect" data-toggle="modal" data-target="#defaultModal" data-id="<?php echo $row['course_id']; ?>" id="btn-list">
                                                    <i class="material-icons md-18">format_list_bulleted</i>
                                                    <span>รายละเอียด</span>
                                                </button>
                                            </td>
                                            <td class="text-center js-sweetalert">
                                                <button type="button" class="btn btn-xs bg-amber waves-effect" data-toggle="modal" data-target="#updateModal" data-id="<?php echo $row['course_id']; ?>" id="btn-update">
                                                    <i class="material-icons md-18">edit</i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-danger waves-effect" data-id="<?php echo $row['course_id']; ?>" id="btn-delete">
                                                    <i class="material-icons md-18">delete</i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                                if (isset($_GET['err'])) {
                                    echo "<div class='alert bg-red'>";
                                    echo "<span>" . $_GET['err'] . "</span>";
                                    echo "</div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>
    <!-- Default Size -->
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document" id="modal-elo-mapping">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">ผลการเรียนรู้ที่ประเมิน</h4>
                </div>
                <div class="modal-body" id="modal-body-elo-mapping">
                    <div id="modal-loader2" style="display: none; text-align: center;">
                        <img src = "../ajax-loader.gif">
                    </div>                            
                    <!-- content will be load here -->                          
                    <div id="dynamic2-content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-grey waves-effect" data-dismiss="modal"><i class="material-icons">close</i><span>ปิด</span></button>
                </div>
            </div>
        </div>
    </div> <!-- Default Size -->

    <!-- update Modal -->
    <!-- add data-keyboard="false" and data-backdrop="static" to disallow modal window from closing -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document" id="modal-update">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">แก้ไขข้อมูล</h4>
                </div>
                <form role="form" method="POST" action="elo_mapping_op.php?action=u">
                    <div class="modal-body" id="modal-body-update">
                        <div id="modal-loader3" style="display: none; text-align: center;">
                            <img src = "../ajax-loader.gif">
                        </div>                            
                        <!-- content will be load here -->                          
                        <div id="dynamic3-content"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-blue-grey waves-effect" name="dept-submit"><i class="material-icons">save</i><span>บันทึก</span></button>
                        <button type="button" class="btn bg-grey waves-effect" data-dismiss="modal"><i class="material-icons">cancel</i><span>ยกเลิก</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- Default Size -->

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

    <script>
        $(document).ready(function(){	
            $(document).on('click', '#btn-list', function(e){
                e.preventDefault();
                var course_id = $(this).data('id');   // it will get id of clicked row
                $('#dynamic2-content').html(''); // leave it blank before ajax call
                $('#modal-loader2').show();      // load ajax loader
                $.ajax({
                    url: 'elo_mapping_list.php',
                    type: 'POST',
                    data: 'course_id='+course_id,
                    dataType: 'html'
                })
                .done(function(data){	
                    $('#dynamic2-content').html('');    
                    $('#dynamic2-content').html(data); // load response 
                    $('#modal-loader2').hide();		  // hide ajax loader	
                })
                .fail(function(){
                    $('#dynamic2-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                    $('#modal-loader2').hide();
                });
            });
            $(document).on('click', '#btn-update', function(e){
                e.preventDefault();
                var course_id = $(this).data('id');   // it will get id of clicked row
                $('#dynamic3-content').html(''); // leave it blank before ajax call
                $('#modal-loader3').show();      // load ajax loader
                $.ajax({
                    url: 'elo_mapping_update.php',
                    type: 'POST',
                    data: 'course_id='+course_id,
                    dataType: 'html'
                })
                .done(function(data){
                    //console.log(data);	
                    $('#dynamic3-content').html('');    
                    $('#dynamic3-content').html(data); // load response 
                    $('#modal-loader3').hide();		  // hide ajax loader	
                })
                .fail(function(){
                    $('#dynamic3-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                    $('#modal-loader3').hide();
                });
            });
            $(document).on('click', '#btn-delete', function(e){
                e.preventDefault();
                var course_id = $(this).data('id');
                swal({
                    title: "แน่ใจว่าต้องการลบข้อมูล?",
                    text: "คำเตือน เมื่อข้อมูลถูกลบ จะไม่สามารถเรียกคืนได้!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "ยืนยัน, ลบเดี่ยวนี้",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false
                },
                function(){
                    $(location).attr("href", "elo_mapping_op.php?action=d&course_id=" + course_id);
                    swal("Deleted!", "ลบข้อมูลเรียบร้อยแล้ว", "success");
                });
            });
        });
    </script>
</body>

</html>
