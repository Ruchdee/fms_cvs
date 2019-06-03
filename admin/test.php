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

<form role="form" method="POST" action="lecturer_op.php?action=i">
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
                    <select id="title-en" name="title-en" class="form-control show-tick" required>
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
                    <label for="course-name-th">ชื่อ-นามสกุล (ไทย)</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="course-name-th" name="course-name-th" class="form-control" placeholder="" required maxlength="100">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="course-name-en">ชื่อ-นามสกุล (Eng)</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="course-name-en" name="course-name-en" class="form-control" placeholder="" maxlength="100">
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
        <button type="submit" class="btn bg-blue-grey waves-effect"><i class="material-icons">save</i><span>บันทึก</span></button>
        <button type="button" class="btn bg-grey waves-effect" data-dismiss="modal"><i class="material-icons">cancel</i><span>ยกเลิก</span></button>
        
    </form>

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

    <script>
        $(document).ready(function(){
            $(document).on('change', '#dept-id', function(e){
                e.preventDefault();
                var dept_id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'lecturer_major.php',
                    data: 'dept_id='+dept_id,
                    async: true,
                    success: function(results) {
                        console.log(results);
                        $("#major-id").html('');
                        $("#major-id").html(results);
                        $("#major-id").selectpicker("refresh");
                        //$("#major-id").get(0).selectedIndex = 0;
                        //$("#major-id").val(' ').change();
                        //$("#major-id").change();
                        //$("#major-id").empty(); //To reset cities
                        //$("#major-id").append("<option>Liverpool</option>");
                        
                        //$("#major-id").append(results);
                        //$("#test").html(results);
                        
                    }
                });
            });
        });
    </script>

</body>

</html>