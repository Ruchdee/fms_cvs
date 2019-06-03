<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_department.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $department = new Department($db);
    $department->dept_id = $_POST['dept_id'];
    $result = $department->readone();
    $row_update = mysqli_fetch_array($result);

    //close connection
    $database->closeConnection();

?>
<div class="row clearfix">
    <div class="col-md-6">
        <label for="email_address">รหัสภาควิชา</label>
        <div class="form-group">
            <div class="form-line disabled">
                <input type="text" name="dept-id" class="form-control" placeholder="เช่น FMS-BA, FMS-ACC" required maxlength="10" value="<?php echo $row_update['dept_id']; ?>" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-6"></div>
</div>
<div class="row clearfix">
    <div class="col-md-6">
        <label for="email_address">ชื่อภาควิชา (ไทย)</label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" class="form-control" name="dept-name-th" placeholder="" required maxlength="50" value="<?php echo $row_update['dept_name_th']; ?>">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label for="email_address">ชื่อภาควิชา (Eng)</label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" class="form-control" name="dept-name-en" placeholder="" maxlength="50" value="<?php echo $row_update['dept_name_en']; ?>">
            </div>
        </div>
    </div>
</div>
<label for="email_address">สถานะการใช้งาน</label>
<div class="demo-switch">
    <div class="switch">
        <label>ยกเลิก<input type="checkbox" name="dept-status" <?php if ($row_update['dept_status']) {echo 'checked';} ?>>
            <span class="lever"></span>ใช้งาน
        </label>
    </div>
</div>