<?php
    include_once '../php/dbconnect.php';
    include_once '../php/tb_major.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $major = new Major($db);

    if (isset($_POST["dept_id"]) && !empty($_POST["dept_id"])) {
        $major->dept_id = $_POST['dept_id'];
        $result_dept_id = $major->readbydept_id();
        if (mysqli_num_rows($result_dept_id) > 0) {
            echo '<option value="">-- Please select --</option>';
            while ($row_dept_id = mysqli_fetch_array($result_dept_id)) {
                echo '<option value="' . $row_dept_id['major_id'] . '">' . $row_dept_id['major_name_th'] . '</option>';
            }
        } else {
            echo '<option value="">-- Please select --</option>';
        }
    } else {
        echo '<option value="">-- Please select --</option>';
    }
?>