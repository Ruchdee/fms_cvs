<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_course.php';
    include_once '../php/tb_major.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $course = new Course($db);
    $course->course_id = $_POST['course_id'];
    $result = $course->readone();
    $row_update = mysqli_fetch_array($result);

    $major = new Major($db);
    
    //close connection
    //$database->closeConnection();

?>
<div class="row clearfix">
    <div class="col-md-6">
        <input type="hidden" id="course-id" name="course-id" value="<?php echo $_POST['course_id']; ?>">
        <label for="course-code">รหัสวิชา</label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" id="course-code" name="course-code" class="form-control" placeholder="เช่น 460-107, 477-301" required
                    maxlength="10" value="<?php echo $row_update['course_code']; ?>">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label for="major-id">สาขาวิชา</label>
        <select id="major-id" name="major-id" class="form-control show-tick" required>
            <option value="">-- Please select --</option>
            <?php 
                $active_major = true;
                $result_major_all = $major->readall($active_dept);
                while ($row_major_all = mysqli_fetch_array($result_major_all)) {
                    if ($row_major_all['major_id'] == $row_update['major_id']) {
                        echo "<option value=" . $row_major_all['major_id'] . " selected>" . $row_major_all['major_name_th'] . "</option>";
                    } else {
                        echo "<option value=" . $row_major_all['major_id'] . ">" . $row_major_all['major_name_th'] . "</option>";
                    }
                }
            ?>
        </select>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-6">
        <label for="course-name-th">ชื่อวิชา (ไทย)</label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" id="course-name-th" name="course-name-th" class="form-control" placeholder="" required maxlength="100" value="<?php echo $row_update['course_name_th']; ?>">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label for="course-name-en">ชื่อวิชา (Eng)</label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" id="course-name-en" name="course-name-en" class="form-control" placeholder="" maxlength="100" value="<?php echo $row_update['course_name_en']; ?>">
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-3">
        <label for="course-credit">หน่วยกิต</label>
        <div class="form-group">
            <div class="form-line">
                <input type="number" id="course-credit" name="course-credit" class="form-control" placeholder="" value="<?php echo $row_update['course_credit']; ?>">
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <label for="course-status">สถานะการใช้งาน</label>
        <div class="demo-switch">
            <div class="switch">
                <label>ยกเลิก<input type="checkbox" id="course-status" name="course-status" <?php if ($row_update['course_status']) {echo 'checked';} ?>><span class="lever"></span>ใช้งาน</label>
            </div>
        </div>
    </div>
</div>