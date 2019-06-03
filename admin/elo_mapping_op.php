<?php 
    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
        
    include_once '../php/dbconnect.php';
    include_once '../php/tb_elo_mapping.php';
    include_once '../php/tb_course.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $elo_mapping = new Elo_mapping($db);
    $course = new Course($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        if (isset($_POST['elo-id'])) {
            $elo_ids = $_POST['elo-id'];
            $cnt_elo_id = count($elo_ids);
            $elo_mapping->course_id = $_POST['course-id'];
            for ($i=0; $i < $cnt_elo_id; $i++) { 
                $elo_mapping->elo_id = $elo_ids[$i];
                if (isset($_POST['elo-verify-' . $elo_ids[$i]])) {
                    $elo_mapping->is_verified = 1;
                } else {
                    $elo_mapping->is_verified = 0;
                }
                $elo_mapping->created_by = "test";
                $elo_mapping->created_date = date("Y/m/d H:i:s");
                //insert
                if ($elo_mapping->create()) {   
                } else {
                    header("Location: elo_mapping.php?err=เพิ่มข้อมูลผิดพลาด");
                    exit;
                }
            }
            //update is_mapped field in course table
            $course->course_id = $_POST['course-id'];
            $course->is_mapped = 1;
            if ($course->update_is_mapped()) {
                header("Location: elo_mapping.php");
                exit;
            } else {
                header("Location: elo_mapping.php?err=เพิ่มข้อมูลผิดพลาด");
                exit;
            }
        } else {
            header("Location: elo_mapping.php");
            exit;
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $elo_ids = $_POST['elo-id'];
        $cnt_elo_id = count($elo_ids);
        $elo_mapping->course_id = $_POST['course-id'];
        for ($i=0; $i < $cnt_elo_id; $i++) {
            $elo_mapping->elo_id = $elo_ids[$i];
            if (isset($_POST['elo-verify-' . $elo_ids[$i]])) {
                $elo_mapping->is_verified = 1;
            } else {
                $elo_mapping->is_verified = 0;
            }
            //update
            if ($elo_mapping->update()) {   
            } else {
                header("Location: elo_mapping.php?err=แก้ไขข้อมูลผิดพลาด");
                exit;
            }
        }
        header("Location: elo_mapping.php");
        exit;
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['course_id'])) {
            $elo_mapping->course_id = $_GET['course_id'];
            //delete
            if ($elo_mapping->delete()) {
                //update is_mapped field in course table
                $course->course_id = $_GET['course_id'];
                $course->is_mapped = 0;
                if ($course->update_is_mapped()) {
                    header("Location: elo_mapping.php");
                    exit;
                } else {
                    header("Location: elo_mapping.php?err=ลบข้อมูลผิดพลาด");
                    exit;
                }
            } else {
                header("Location: elo_mapping.php?err=ลบข้อมูลผิดพลาด");
                exit;
            }
        }
    }

?>