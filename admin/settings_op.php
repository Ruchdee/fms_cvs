<?php 
    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_settings.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $settings = new Settings($db);

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $settings->fac_name_th = $_POST['fac-name-th'];
        $settings->fac_name_en = $_POST['fac-name-en'];
        $settings->curr_semester = $_POST['curr-semester'];
        $settings->curr_ac_year = $_POST['curr-ac-year'];
        $settings->updated_by = "test";
        $settings->updated_date = date("Y/m/d H:i:s");
        
        //update
        if ($settings->update()) {
            header("Location: settings.php");
        } else {
            header("Location: settings.php?err=บันทึกข้อมูลผิดพลาด");
        }
    }

?>