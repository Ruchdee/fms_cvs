<?php
    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_course.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $course = new Course($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $course->course_code = $_POST['course-code'];
        $course->course_name_th = $_POST['course-name-th'];
        $course->course_name_en = $_POST['course-name-en'];
        $course->major_id = $_POST['major-id'];
        $course->course_credit = $_POST['course-credit'];
        $course->is_mapped = 0;
        if (isset($_POST['course-status'])) {
            $course->course_status = 1;
        } else {
            $course->course_status = 0;
        }
        $course->created_by = "test";
        $course->created_date = date("Y/m/d H:i:s");

        //insert
        if ($course->create()) {
            header("Location: course.php");
        } else {
            header("Location: course.php?err=เพิ่มข้อมูลผิดพลาด");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $course->course_id = $_POST['course-id'];
        $course->course_code = $_POST['course-code'];
        $course->course_name_th = $_POST['course-name-th'];
        $course->course_name_en = $_POST['course-name-en'];
        $course->major_id = $_POST['major-id'];
        $course->course_credit = $_POST['course-credit'];
        if (isset($_POST['course-status'])) {
            $course->course_status = 1;
        } else {
            $course->course_status = 0;
        }

        //update
        if ($course->update()) {
            header("Location: course.php");
        } else {
            header("Location: course.php?err=แก้ไขข้อมูลผิดพลาด");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['course_id'])) {
            $course->course_id = $_GET['course_id'];
            //delete
            if ($course->delete()) {
                header("Location: course.php");
            } else {
                header("Location: course.php?err=ลบข้อมูลผิดพลาด");
            }
        }
    }
?>