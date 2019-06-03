<?php 

    session_start();
    ob_start();

    include_once '../php/dbconnect.php';
    include_once '../php/tb_department.php';
    include_once '../php/tb_major.php';
    include_once '../php/tb_lecturer.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $lecturer = new Lecturer($db);

    //read all records
    $active = false;
    $result = $lecturer->readall($active);

    $department = new Department($db);
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
                    <li class="active">
                        <a href="#">
                            <i class="material-icons">people</i>
                            <span>อาจารย์ผู้สอน (Lecturer)</span>
                        </a>
                    </li>
                    <li>
                        <a href="elo_list.php">
                            <i class="material-icons">widgets</i>
                            <span>ผลการเรียนรู้ (ELOs)</span>
                        </a>
                    </li>
                    <li>
                        <a href="elo_mapping.php">
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
                                อาจารย์ผู้สอน (Lecturer)
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
                                            <th class="text-center">รหัสอาจารย์</th>
                                            <th class="text-center">คำนำหน้า</th>
                                            <th>ชื่อ-นามสกุล (ไทย)</th>
                                            <th class="text-center">ภาควิชา</th>
                                            <th class="text-center">สาขาวิชา</th>
                                            <th class="text-center">สถานะ</th>
                                            <th class="text-center">...</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">รหัสอาจารย์</th>
                                            <th class="text-center">คำนำหน้า</th>
                                            <th>ชื่อ-นามสกุล (ไทย)</th>
                                            <th class="text-center">ภาควิชา</th>
                                            <th class="text-center">สาขาวิชา</th>
                                            <th class="text-center">สถานะ</th>
                                            <th class="text-center">...</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                                        <tr>
                                            <td class="text-center"><?php echo $row['lecturer_id']; ?></td>
                                            <td class="text-center">
                                                <?php 
                                                    switch ($row['title_th']) {
                                                        case '1':
                                                            echo "นาย";
                                                            break;
                                                        case '2':
                                                            echo "น.ส.";
                                                            break;
                                                        case '3':
                                                            echo "นาง";
                                                            break;
                                                        case '4':
                                                            echo "อ.";
                                                            break;
                                                        case '5':
                                                            echo "ดร.";
                                                            break;
                                                        case '6':
                                                            echo "ผศ.";
                                                            break;
                                                        case '7':
                                                            echo "ผศ.ดร.";
                                                            break;
                                                        case '8':
                                                            echo "รศ.";
                                                            break;
                                                        case '9':
                                                            echo "รศ.ดร.";
                                                            break;
                                                        case '10':
                                                            echo "ศ.";
                                                            break;
                                                        default:
                                                            echo "";
                                                            break;
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row['lecturer_name_th']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                    $major->major_id = $row['major_id'];
                                                    $result_major = $major->readone();
                                                    $row_major = mysqli_fetch_array($result_major);
                                                    $department->dept_id = $row_major['dept_id'];
                                                    $result_dept = $department->readone();
                                                    $row_dept = mysqli_fetch_array($result_dept);
                                                    echo $row_dept['dept_name_th'];
                                                ?>
                                            </td>
                                            <td class="text-center"><?php echo $row_major['major_name_th']; ?></td>
                                            <td class="text-center">
                                                <?php if ($row['lecturer_status']) {
                                                        echo "ใช้งาน";
                                                    } else { echo "ยกเลิก"; } 
                                                ?>
                                            </td>
                                            <td class="text-center js-sweetalert">
                                                <button type="button" class="btn btn-xs bg-amber waves-effect" data-toggle="modal" data-target="#updateModal" data-id="<?php echo $row['lecturer_id']; ?>" id="btn-update">
                                                    <i class="material-icons md-18">edit</i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-danger waves-effect" data-id="<?php echo $row['lecturer_id']; ?>" id="btn-delete">
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
                <form role="form" method="POST" action="lecturer_op.php?action=i">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <label for="lecturer-id">รหัสอาจารย์</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="lecturer-id" name="lecturer-id" class="form-control" placeholder="" required maxlength="8">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="title-th">คำนำหน้าชื่อ (ไทย)</label>
                                <select id="title-th" name="title-th" class="form-control show-tick" required>
                                    <option value="">-- Please select --</option>
                                    <option value="1">นาย</option>
                                    <option value="2">นางสาว</option>
                                    <option value="3">นาง</option>
                                    <option value="4">อ.</option>
                                    <option value="5">ดร.</option>
                                    <option value="6">ผศ.</option>
                                    <option value="7">ผศ.ดร.</option>
                                    <option value="8">รศ.</option>
                                    <option value="9">รศ.ดร.</option>
                                    <option value="10">ศ.</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="title-en">คำนำหน้าชื่อ (Eng)</label>
                                <select id="title-en" name="title-en" class="form-control show-tick">
                                    <option value="">-- Please select --</option>
                                    <option value="1">Mr.</option>
                                    <option value="2">Ms.</option>
                                    <option value="3">Mrs.</option>
                                    <option value="4">Instructor</option>
                                    <option value="5">Dr.</option>
                                    <option value="6">Asst.Prof.</option>
                                    <option value="7">Asst.Prof.Dr.</option>
                                    <option value="8">Assoc.Prof.</option>
                                    <option value="9">Assoc.Prof.Dr.</option>
                                    <option value="10">Prof.</option>
                                </select>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <label for="lecturer-name-th">ชื่อ-นามสกุล (ไทย)</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="lecturer-name-th" name="lecturer-name-th" class="form-control" placeholder="" required maxlength="100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="lecturer-name-en">ชื่อ-นามสกุล (Eng)</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="lecturer-name-en" name="lecturer-name-en" class="form-control" placeholder="" maxlength="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
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
                            <div class="col-md-6">
                                <label for="major-id">สาขาวิชา</label>
                                <select id="major-id" name="major-id" class="form-control show-tick" required>
                                    <option value="">-- Please select --</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <label for="lecturer-status">สถานะการใช้งาน</label>
                                <div class="demo-switch">
                                    <div class="switch">
                                        <label>ยกเลิก<input type="checkbox" id="lecturer-status" name="lecturer-status" checked><span class="lever"></span>ใช้งาน</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-blue-grey waves-effect"><i class="material-icons">save</i><span>บันทึก</span></button>
                        <button type="button" class="btn bg-grey waves-effect" data-dismiss="modal"><i class="material-icons">cancel</i><span>ยกเลิก</span></button>
                    </div>
                    <div id="test" name="test"></div>
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
                <form role="form" method="POST" action="lecturer_op.php?action=u">
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
            //change major options when department is changed
            $(document).on('change', '#dept-id', function(e){
                e.preventDefault();
                var dept_id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'lecturer_major.php',
                    data: 'dept_id='+dept_id,
                    dataType: 'html',
                    success: function(results) {
                        //console.log(results);
                        $("#major-id").html('');
                        $("#major-id").html(results);
                        $("#major-id").selectpicker("refresh");
                    }
                });
            });
            $(document).on('click', '#btn-update', function(e){
                e.preventDefault();
                var lecturer_id = $(this).data('id');   // it will get id of clicked row
                $('#dynamic2-content').html(''); // leave it blank before ajax call
                $('#modal-loader').show();      // load ajax loader
                $.ajax({
                    url: 'lecturer_update.php',
                    type: 'POST',
                    data: 'lecturer_id='+lecturer_id,
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
                var lecturer_id = $(this).data('id');
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
                    $(location).attr("href", "lecturer_op.php?action=d&lecturer_id=" + lecturer_id);
                    swal("Deleted!", "ลบข้อมูลเรียบร้อยแล้ว", "success");
                });
            });
        });
    </script>

</body>

</html>