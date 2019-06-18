<?php 
    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_major.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $major = new Major($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $major->major_id = $_POST['major-id'];
        $major->major_name_th = $_POST['major-name-th'];
        $major->major_name_en = $_POST['major-name-en'];
        $major->dept_id = $_POST['dept-id'];
        if (isset($_POST['major-status'])) {
            $major->major_status = 1;
        } else {
            $major->major_status = 0;
        }
        $major->created_by = "test";
        $major->created_date = date("Y/m/d H:i:s");

        //insert
        if ($major->create()) {
            header("Location: major.php");
        } else {
            header("Location: major.php?err=เพิ่มข้อมูลผิดพลาด");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $major->major_id = $_POST['major-id-update'];
        $major->major_name_th = $_POST['major-name-th-update'];
        $major->major_name_en = $_POST['major-name-en-update'];
        $major->dept_id = $_POST['dept-id-update'];
        if (isset($_POST['major-status-update'])) {
            $major->major_status = 1;
        } else {
            $major->major_status = 0;
        }

        //update
        if ($major->update()) {
            header("Location: major.php");
        } else {
            header("Location: major.php?err=แก้ไขข้อมูลผิดพลาด");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['major_id'])) {
            $major->major_id = $_GET['major_id'];
            //delete
            if ($major->delete()) {
                header("Location: major.php");
            } else {
                header("Location: major.php?err=ลบข้อมูลผิดพลาด");
            }
        }
    }

?>