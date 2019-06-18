<?php 
    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_elo.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $elo = new Elo($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $elo->elo_desc = $_POST['elo-desc'];
        $elo->elo_type = $_POST['elo-type'];
        $elo->major_id = $_POST['major-id'];
        $elo->elo_id = $elo->getnew_id();
        if (isset($_POST['elo-status'])) {
            $elo->elo_status = 1;
        } else {
            $elo->elo_status = 0;
        }
        $elo->created_by = "test";
        $elo->created_date = date("Y/m/d H:i:s");

        //insert
        if ($elo->create()) {
            header("Location: elo_list.php");
        } else {
            header("Location: elo_list.php?err=เพิ่มข้อมูลผิดพลาด");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $elo->elo_id = $_POST['elo-id-update'];
        $elo->elo_desc = $_POST['elo-desc-update'];
        $elo->elo_type = $_POST['elo-type-update'];
        $elo->major_id = $_POST['major-id-update'];
        if (isset($_POST['elo-status-update'])) {
            $elo->elo_status = 1;
        } else {
            $elo->elo_status = 0;
        }

        //update
        if ($elo->update()) {
            header("Location: elo_list.php");
        } else {
            header("Location: elo_list.php?err=แก้ไขข้อมูลผิดพลาด");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['elo_id'])) {
            $elo->elo_id = $_GET['elo_id'];
            //delete
            if ($elo->delete()) {
                header("Location: elo_list.php");
            } else {
                header("Location: elo_list.php?err=ลบข้อมูลผิดพลาด");
            }
        }
    }

?>