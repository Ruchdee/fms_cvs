<?php

    session_start();
    ob_start();

    include_once '../php/dbconnect.php';
    include_once '../php/tb_major.php';
    include_once '../php/tb_department.php';
    include_once '../php/titlebar.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $major = new Major($db);
    $department = new Department($db);

    //read all records
    $active = false;
    $result = $major->readall($active);

    ob_end_flush();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php $title = new Titlebar(); ?>
    <title><?php echo $title->major;?></title>
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

    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />

    <style rel="stylesheet" type="text/css">
		#menu, span, h2, label, table, .dropdown-menu, h4, button {font-family: 'Chakra Petch', sans-serif;}
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
                                สาขาวิชา (Major)
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#" data-toggle="modal" data-target="#defaultModal">เพิ่มข้อมูล</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">รหัสสาขาวิชา</th>
                                            <th>ชื่อสาขาวิชา (ไทย)</th>
                                            <th>ชื่อสาขาวิชา (Eng)</th>
                                            <th class="text-center">ภาควิชา</th>
                                            <th class="text-center">สถานะ</th>
                                            <th class="text-center">...</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                                        <tr>
                                            <td class="text-center"><?php echo $row['major_id']; ?></td>
                                            <td><?php echo $row['major_name_th']; ?></td>
                                            <td><?php echo $row['major_name_en']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                    $department->dept_id = $row['dept_id'];
                                                    $result_dept = $department->readone();
                                                    $row_dept = mysqli_fetch_array($result_dept);
                                                    echo $row_dept['dept_name_th'];
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($row['major_status']) {
                                                        echo "ใช้งาน";
                                                    } else { echo "ยกเลิก"; }
                                                ?>
                                            </td>
                                            <td class="text-center js-sweetalert">
                                                <button type="button" class="btn btn-xs bg-amber waves-effect" data-toggle="modal" data-target="#updateModal" data-id="<?php echo $row['major_id']; ?>" id="btn-update">
                                                    <i class="material-icons md-18">edit</i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-danger waves-effect" data-id="<?php echo $row['major_id']; ?>" id="btn-delete">
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">เพิ่มข้อมูล</h4>
                </div>
                <form role="form" method="POST" action="major_op.php?action=i">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <label for="major-id">รหัสสาขาวิชา</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="major-id" name="major-id" class="form-control" placeholder="เช่น FMS-BA-MK, BA-HRM-60" maxlength="15" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="dept-id">ภาควิชา</label>
                                <select id="dept-id" name="dept-id" class="form-control show-tick" required>
                                    <option value="">-- Please select --</option>
                                    <?php
                                        $active_dept = true;
                                        $result_dept_all = $department->readall($active_dept);
                                        while ($row_dept_all = mysqli_fetch_array($result_dept_all)) {
                                            echo "<option value=" . $row_dept_all['dept_id'] . ">" . $row_dept_all['dept_name_th'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <label for="major-name-th">ชื่อสาขาวิชา (ไทย)</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="major-name-th" name="major-name-th" class="form-control" placeholder="" required maxlength="100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="major-name-en">ชื่อสาขาวิชา (Eng)</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="major-name-en" name="major-name-en" class="form-control" placeholder="" maxlength="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="major-status">สถานะการใช้งาน</label>
                        <div class="demo-switch">
                            <div class="switch">
                                <label>ยกเลิก<input type="checkbox" id="major-status" name="major-status" checked><span class="lever"></span>ใช้งาน</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-blue-grey waves-effect"><i class="material-icons">save</i><span>บันทึก</span></button>
                        <button type="button" class="btn bg-grey waves-effect" data-dismiss="modal"><i class="material-icons">cancel</i><span>ยกเลิก</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- Default Size -->

    <!-- update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">แก้ไขข้อมูล</h4>
                </div>
                <form role="form" method="POST" action="major_op.php?action=u">
                    <div class="modal-body">
                        <div id = "modal-loader" style = "display: none; text-align: center;">
                            <img src = "../ajax-loader.gif">
                        </div>
                        <!-- content will be load here -->
                        <div id = "dynamic2-content"></div>
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
            $(document).on('click', '#btn-update', function(e){
                e.preventDefault();
                var major_id = $(this).data('id');   // it will get id of clicked row
                $('#dynamic2-content').html(''); // leave it blank before ajax call
                $('#modal-loader').show();      // load ajax loader
                $.ajax({
                    url: 'major_update.php',
                    type: 'POST',
                    data: 'major_id='+major_id,
                    dataType: 'html'
                })
                .done(function(data){
                    //console.log(data);
                    $('#dynamic2-content').html('');
                    $('#dynamic2-content').html(data); // load response
                    $('#modal-loader').hide();		  // hide ajax loader
                })
                .fail(function(){
                    $('#dynamic2-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                    $('#modal-loader').hide();
                });
            });
            $(document).on('click', '#btn-delete', function(e){
                e.preventDefault();
                var major_id = $(this).data('id');
                swal({
                    title: "แน่ใจว่าต้องการลบข้อมูล?",
                    text: "คำเตือน เมื่อข้อมูลถูกลบ จะไม่สามารถเรียกคืนได้!",
                    type: "warning",
                    showCancelButton: true,
                    //confirmButtonClass: "btn-danger",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ยืนยัน, ลบเดี่ยวนี้",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false
                },
                function(){
                    $(location).attr("href", "major_op.php?action=d&major_id=" + major_id);
                    swal("Deleted!", "ลบข้อมูลเรียบร้อยแล้ว", "success");
                });
            });
        });
    </script>

</body>
</html>
