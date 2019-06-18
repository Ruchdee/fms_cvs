<?php 
    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_lecturer.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $lecturer = new Lecturer($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $lecturer->lecturer_id = $_POST['lecturer-id'];
        $lecturer->title_th = $_POST['title-th'];
        $lecturer->title_en = $_POST['title-en'];
        $lecturer->lecturer_name_th = $_POST['lecturer-name-th'];
        $lecturer->lecturer_name_en = $_POST['lecturer-name-en'];
        $lecturer->major_id = $_POST['major-id'];
        if (isset($_POST['lecturer-status'])) {
            $lecturer->lecturer_status = 1;
        } else {
            $lecturer->lecturer_status = 0;
        }
        $lecturer->created_by = "test";
        $lecturer->created_date = date("Y/m/d H:i:s");

        //insert
        if ($lecturer->create()) {
            header("Location: lecturer.php");
        } else {
            header("Location: lecturer.php?err=เพิ่มข้อมูลผิดพลาด");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $lecturer->lecturer_id = $_POST['lecturer-id-update'];
        $lecturer->title_th = $_POST['title-th-update'];
        $lecturer->title_en = $_POST['title-en-update'];
        $lecturer->lecturer_name_th = $_POST['lecturer-name-th-update'];
        $lecturer->lecturer_name_en = $_POST['lecturer-name-en-update'];
        $lecturer->major_id = $_POST['major-id-update'];
        if (isset($_POST['lecturer-status-update'])) {
            $lecturer->lecturer_status = 1;
        } else {
            $lecturer->lecturer_status = 0;
        }

        //update
        if ($lecturer->update()) {
            header("Location: lecturer.php");
        } else {
            header("Location: lecturer.php?err=เพิ่มข้อมูลผิดพลาด");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['lecturer_id'])) {
            $lecturer->lecturer_id = $_GET['lecturer_id'];
            //delete
            if ($lecturer->delete()) {
                header("Location: lecturer.php");
            } else {
                header("Location: lecturer.php?err=ลบข้อมูลผิดพลาด");
            }
        }
    }

?>