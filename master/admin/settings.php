<?php

    session_start();
    ob_start();

    include_once '../php/dbconnect.php';
    include_once '../php/tb_settings.php';
    include_once '../php/titlebar.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $settings = new Settings($db);

    //read a record
    $result = $settings->readone();
    $row = mysqli_fetch_array($result);

    ob_end_flush();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php $title = new Titlebar(); ?>
    <title><?php echo $title->settings;?></title>
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

    <!-- Wait Me Css -->
    <!-- <link href="../plugins/waitme/waitMe.css" rel="stylesheet" /> -->

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />

    <style rel="stylesheet" type="text/css">
		  #menu, span, h2, label {font-family: 'Chakra Petch', sans-serif;}
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
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                การตั้งค่า (System Settings)
                            </h2>
                            <ul class="header-dropdown m-r--5">
                            </ul>
                        </div>
                        <div class="body">
                            <form role="form" method="POST" action="settings_op.php?action=u">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="fac-name-th">ชื่อคณะ (ภาษาไทย)</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="fac-name-th" name="fac-name-th" class="form-control" placeholder="" required value="<?php echo $row['fac_name_th']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fac-name-en">ชื่อคณะ (ภาษาอังกฤษ)</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="fac-name-en" name="fac-name-en" class="form-control" placeholder="" value="<?php echo $row['fac_name_en']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-7">
                                        <label for="curr-semester">ภาคการศึกษาปัจจุบัน</label>
                                        <div class="form-group">
                                            <div class="demo-radio-button">
                                                <input type="radio" name="curr-semester" id="curr-semester1" class="radio-col-green" value="1" <?php if ($row['curr_semester'] == '1') echo "checked"; ?> />
                                                <label for="curr-semester1">ภาคการศึกษาที่ 1</label>
                                                <input type="radio" name="curr-semester" id="curr-semester2" class="radio-col-green" value="2" <?php if ($row['curr_semester'] == '2') echo "checked"; ?> />
                                                <label for="curr-semester2">ภาคการศึกษาที่ 2</label>
                                                <input type="radio" name="curr-semester" id="curr-semester3" class="radio-col-green" value="3" <?php if ($row['curr_semester'] == '3') echo "checked"; ?> />
                                                <label for="curr-semester3">ภาคการศึกษาฤดูร้อน</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="curr-ac-year">ปีการศึกษาปัจจุบัน</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="curr-ac-year" id="curr-ac-year" class="form-control" placeholder="2562" required maxlength="4" value="<?php echo $row['curr_ac_year']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <!-- <button type="submit" class="btn btn-primary m-t-15 waves-effect">บันทึก</button> -->
                                <button type="submit" class="btn bg-blue-grey waves-effect"><i class="material-icons">save</i><span>บันทึก</span></button>
                                <button type="reset" class="btn bg-grey waves-effect" data-dismiss="modal"><i class="material-icons">cancel</i><span>ยกเลิก</span></button>
                            </form>
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

        </div>
    </section>

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

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <!-- <script src="../js/basic-form-elements.js"></script> -->

    <!-- Demo Js -->
    <!-- <script src="../js/demo.js"></script> -->
</body>

</html>
