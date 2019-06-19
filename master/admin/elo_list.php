<?php

    session_start();
    ob_start();

    include_once '../php/dbconnect.php';
    include_once '../php/tb_major.php';
    include_once '../php/tb_elo.php';
    include_once '../php/titlebar.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $elo = new Elo($db);

    //read all records
    $active = false;
    $result = $elo->readall($active);

    $major = new Major($db);

    ob_end_flush();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php $title = new Titlebar(); ?>
    <title><?php echo $title->elolist;?></title>
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
                                ผลการเรียนรู้ (Expected Learning Outcomes)
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
                                <table id="elo-table" name="elo-table" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">สาขาวิชา</th>
                                            <th class="text-center">ประเภท</th>
                                            <th>ผลการเรียนรู้</th>
                                            <th class="text-center">สถานะ</th>
                                            <th class="text-center">...</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">สาขาวิชา</th>
                                            <th class="text-center">ประเภท</th>
                                            <th>ผลการเรียนรู้</th>
                                            <th class="text-center">สถานะ</th>
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
                                            <td class="text-center">
                                                <?php
                                                    switch ($row['elo_type']) {
                                                        case '1':
                                                            echo "ด้านคุณธรรม จริยธรรม";
                                                            break;
                                                        case '2':
                                                            echo "ด้านความรู้";
                                                            break;
                                                        case '3':
                                                            echo "ด้านทักษะทางปัญญา";
                                                            break;
                                                        case '4':
                                                            echo "ด้านทักษะความสัมพันธ์ระหว่างบุคคลและความรับผิดชอบ";
                                                            break;
                                                        case '5':
                                                            echo "ด้านทักษะการวิเคราะห์เชิงตัวเลข การสื่อสารและการใช้เทคโนโลยีสารสนเทศ";
                                                            break;
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row['elo_desc']; ?></td>
                                            <td class="text-center">
                                                <?php if ($row['elo_status']) {
                                                        echo "ใช้งาน";
                                                    } else { echo "ยกเลิก"; }
                                                ?>
                                            </td>
                                            <td class="text-center js-sweetalert">
                                                <button type="button" class="btn btn-xs bg-amber waves-effect" data-toggle="modal" data-target="#updateModal" data-id="<?php echo $row['elo_id']; ?>" id="btn-update">
                                                    <i class="material-icons md-18">edit</i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-danger waves-effect" data-id="<?php echo $row['elo_id']; ?>" id="btn-delete">
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
                <form role="form" method="POST" action="elo_op.php?action=i">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <label for="elo-desc">ผลการเรียนรู้</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="elo-desc" name="elo-desc" class="form-control" placeholder="" required maxlength="200">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <label for="elo-type">ประเภทผลการเรียนรู้</label>
                                <select class="form-control show-tick" id="elo-type" name="elo-type" required>
                                    <option value="">-- Please select --</option>
                                    <option value="1">ด้านคุณธรรม จริยธรรม</option>
                                    <option value="2">ด้านความรู้</option>
                                    <option value="3">ด้านทักษะทางปัญญา</option>
                                    <option value="4">ด้านทักษะความสัมพันธ์ระหว่างบุคคลและความรับผิดชอบ</option>
                                    <option value="5">ด้านทักษะการวิเคราะห์เชิงตัวเลข การสื่อสารและการใช้เทคโนโลยีสารสนเทศ</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <label for="major-id">สาขาวิชา</label>
                                <select id="major-id" name="major-id" class="form-control show-tick" required>
                                    <option value="">-- Please select --</option>
                                    <?php
                                        $active_major = true;
                                        $result_major_all = $major->readall($active_dept);
                                        while ($row_major_all = mysqli_fetch_array($result_major_all)) {
                                            echo "<option value=" . $row_major_all['major_id'] . ">" . $row_major_all['major_name_th'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="elo-status">สถานะการใช้งาน</label>
                                <div class="demo-switch">
                                    <div class="switch">
                                        <label>ยกเลิก<input type="checkbox" id="elo-status" name="elo-status" checked><span class="lever"></span>ใช้งาน</label>
                                    </div>
                                </div>
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
                <form role="form" method="POST" action="elo_op.php?action=u">
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
                var elo_id = $(this).data('id');   // it will get id of clicked row
                $('#dynamic2-content').html(''); // leave it blank before ajax call
                $('#modal-loader').show();      // load ajax loader
                $.ajax({
                    url: 'elo_update.php',
                    type: 'POST',
                    data: 'elo_id='+elo_id,
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
                var elo_id = $(this).data('id');
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
                    $(location).attr("href", "elo_op.php?action=d&elo_id=" + elo_id);
                    swal("Deleted!", "ลบข้อมูลเรียบร้อยแล้ว", "success");
                });
            });
        });
    </script>

</body>

</html>
