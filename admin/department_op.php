<?php 
    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_department.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $department = new Department($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $department->dept_id = $_POST['dept-id'];
        $department->dept_name_th = $_POST['dept-name-th'];
        $department->dept_name_en = $_POST['dept-name-en'];
        if (isset($_POST['dept-status'])) {
            $department->dept_status = 1;
        } else {
            $department->dept_status = 0;
        }
        $department->created_by = "test";
        $department->created_date = date("Y/m/d H:i:s");

        //insert
        if ($department->create()) {
            header("Location: department.php");
        } else {
            header("Location: department.php?err=เพิ่มข้อมูลผิดพลาด");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $department->dept_id = $_POST['dept-id'];
        $department->dept_name_th = $_POST['dept-name-th'];
        $department->dept_name_en = $_POST['dept-name-en'];
        if (isset($_POST['dept-status'])) {
            $department->dept_status = 1;
        } else {
            $department->dept_status = 0;
        }

        //update
        if ($department->update()) {
            header("Location: department.php");
        } else {
            header("Location: department.php?err=แก้ไขข้อมูลผิดพลาด");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['dept_id'])) {
            $department->dept_id = $_GET['dept_id'];
            //delete
            if ($department->delete()) {
                header("Location: department.php");
            } else {
                header("Location: department.php?err=ลบข้อมูลผิดพลาด");
            }
        }
    }

?>