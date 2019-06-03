<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_major.php';
    include_once '../php/tb_department.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $major = new Major($db);
    $major->major_id = $_POST['major_id'];
    $result = $major->readone();
    $row_update = mysqli_fetch_array($result);

    $department = new Department($db);

    //close connection
    //$database->closeConnection();

?>
<div class="row clearfix">
    <div class="col-md-6">
        <label for="major-id">รหัสสาขาวิชา</label>
        <div class="form-group">
            <div class="form-line disabled">
                <input type="text" id="major-id" name="major-id" class="form-control" placeholder="เช่น FMS-BA-MK, BA-HRM-60" maxlength="15" required value="<?php echo $row_update['major_id']; ?>" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label for="dept-id">ภาควิชา</label>
        <select id="dept-id" name="dept-id" class="form-control show-tick" required>
            <option value="">-- Please select --</option>
            <?php 
                $active_dept = true;
                $result_dept_all = $department->readall($active_dept);
                while ($row_dept_all = mysqli_fetch_array($result_dept_all)) {
                    if ($row_dept_all['dept_id'] == $row_update['dept_id']) {
                        echo "<option value=" . $row_dept_all['dept_id'] . " selected>" . $row_dept_all['dept_name_th'] . "</option>";
                    } else {
                        echo "<option value=" . $row_dept_all['dept_id'] . ">" . $row_dept_all['dept_name_th'] . "</option>";
                    }
                }
            ?>
        </select>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-6">
        <label for="major-name-th">ชื่อสาขาวิชา (ไทย)</label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" id="major-name-th" name="major-name-th" class="form-control" placeholder="" required maxlength="100" value="<?php echo $row_update['major_name_th']; ?>">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label for="major-name-en">ชื่อสาขาวิชา (Eng)</label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" id="major-name-en" name="major-name-en" class="form-control" placeholder="" maxlength="100" value="<?php echo $row_update['major_name_en']; ?>">
            </div>
        </div>
    </div>
</div>
<label for="major-status">สถานะการใช้งาน</label>
<div class="demo-switch">
    <div class="switch">
        <label>ยกเลิก<input type="checkbox" id="major-status" name="major-status" <?php if ($row_update['major_status']) {echo 'checked';} ?>><span class="lever"></span>ใช้งาน</label>
    </div>
</div>