<?php
    include_once '../php/dbconnect.php';
    include_once '../php/tb_department.php';
    include_once '../php/tb_major.php';
    include_once '../php/tb_lecturer.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $lecturer = new Lecturer($db);
    $lecturer->lecturer_id = $_POST['lecturer_id'];
    $result_update = $lecturer->readone();
    $row_update = mysqli_fetch_array($result_update);

    $major = new Major($db);
    $major->major_id = $row_update['major_id'];
    $result_major = $major->readone();
    $row_major = mysqli_fetch_array($result_major);
    
    $department = new Department($db);
    $department->dept_id = $row_major['dept_id'];
    $result_dept = $department->readone();
    $row_dept = mysqli_fetch_array($result_dept);
?>

<div class="row clearfix">
    <div class="col-md-4">
        <label for="lecturer-id-update">รหัสอาจารย์</label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" id="lecturer-id-update" name="lecturer-id-update" class="form-control" placeholder="" required maxlength="8" value="<?php echo $row_update['lecturer_id']; ?>">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label for="title-th-update">คำนำหน้าชื่อ (ไทย)</label>
        <select id="title-th-update" name="title-th-update" class="form-control show-tick" required>
            <option value="" <?php if (empty($row_update['title_th'])) echo "selected"; ?>>-- Please select --</option>
            <option value='1' <?php if ($row_update['title_th'] == '1') echo "selected"; ?>>นาย</option>
            <option value='2' <?php if ($row_update['title_th'] == '2') echo "selected"; ?>>นางสาว</option>
            <option value='3' <?php if ($row_update['title_th'] == '3') echo "selected"; ?>>นาง</option>
            <option value='4' <?php if ($row_update['title_th'] == '4') echo "selected"; ?>>อ.</option>
            <option value="5" <?php if ($row_update['title_th'] == '5') echo "selected"; ?>>ดร.</option>
            <option value="6" <?php if ($row_update['title_th'] == '6') echo "selected"; ?>>ผศ.</option>
            <option value="7" <?php if ($row_update['title_th'] == '7') echo "selected"; ?>>ผศ.ดร.</option>
            <option value="8" <?php if ($row_update['title_th'] == '8') echo "selected"; ?>>รศ.</option>
            <option value="9" <?php if ($row_update['title_th'] == '9') echo "selected"; ?>>รศ.ดร.</option>
            <option value="10" <?php if ($row_update['title_th'] == '10') echo "selected"; ?>>ศ.</option>
        </select>
    </div>
    <div class="col-md-4">
        <label for="title-en-update">คำนำหน้าชื่อ (Eng)</label>
        <select id="title-en-update" name="title-en-update" class="form-control show-tick">
            <option value="" <?php if (empty($row_update['title_en'])) echo "selected"; ?>>-- Please select --</option>
            <option value="1" <?php if ($row_update['title_en'] == '1') echo "selected"; ?>>Mr.</option>
            <option value="2" <?php if ($row_update['title_en'] == '2') echo "selected"; ?>>Ms.</option>
            <option value="3" <?php if ($row_update['title_en'] == '3') echo "selected"; ?>>Mrs.</option>
            <option value="4" <?php if ($row_update['title_en'] == '4') echo "selected"; ?>>Instructor</option>
            <option value="5" <?php if ($row_update['title_en'] == '5') echo "selected"; ?>>Dr.</option>
            <option value="6" <?php if ($row_update['title_en'] == '6') echo "selected"; ?>>Asst.Prof.</option>
            <option value="7" <?php if ($row_update['title_en'] == '7') echo "selected"; ?>>Asst.Prof.Dr.</option>
            <option value="8" <?php if ($row_update['title_en'] == '8') echo "selected"; ?>>Assoc.Prof.</option>
            <option value="9" <?php if ($row_update['title_en'] == '9') echo "selected"; ?>>Assoc.Prof.Dr.</option>
            <option value="10" <?php if ($row_update['title_en'] == '10') echo "selected"; ?>>Prof.</option>
        </select>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-6">
        <label for="lecturer-name-th-update">ชื่อ-นามสกุล (ไทย)</label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" id="lecturer-name-th-update" name="lecturer-name-th-update" class="form-control" placeholder="" required maxlength="100" value="<?php echo $row_update['lecturer_name_th']; ?>">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label for="lecturer-name-en-update">ชื่อ-นามสกุล (Eng)</label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" id="lecturer-name-en-update" name="lecturer-name-en-update" class="form-control" placeholder="" maxlength="100" value="<?php echo $row_update['lecturer_name_en']; ?>">
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-6">
        <label for="dept-id-update">ภาควิชา</label>
        <select id="dept-id-update" name="dept-id-update" class="form-control show-tick" required>
            <option value="">-- Please select --</option>
            <?php 
                $active_dept = true;
                $result_dept_all = $department->readall($active_dept);
                while ($row_dept_all = mysqli_fetch_array($result_dept_all)) {
                    if ($row_dept_all['dept_id'] == $row_dept['dept_id']) {
                        echo "<option value=" . $row_dept_all['dept_id'] . " selected>" . $row_dept_all['dept_name_th'] . "</option>";
                    } else {
                        echo "<option value=" . $row_dept_all['dept_id'] . ">" . $row_dept_all['dept_name_th'] . "</option>";
                    }
                }
            ?>
        </select>
    </div>
    <div class="col-md-6">
        <label for="major-id-update">สาขาวิชา</label>
        <select id="major-id-update" name="major-id-update" class="form-control show-tick" required>
            <option value="">-- Please select --</option>
        </select>
    </div>
</div>
<br>
<div class="row clearfix">
    <div class="col-md-6">
        <label for="lecturer-status">สถานะการใช้งาน</label>
        <div class="demo-switch">
            <div class="switch">
                <label>ยกเลิก<input type="checkbox" id="lecturer-status" name="lecturer-status" checked><span class="lever"></span>ใช้งาน</label>
            </div>
        </div>
    </div>
    <div class="col-md-6"></div>
</div>

<script>
    $(document).ready(function(){
        $("#title-th-update").selectpicker("refresh");
        $("#title-en-update").selectpicker("refresh");
        $("#dept-id-update").selectpicker("refresh");
        $("#major-id-update").selectpicker("refresh");
        //change major options when department is changed
        $(document).on('change', '#dept-id-update', function(e){
            e.preventDefault();
            var dept_id = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'lecturer_major.php',
                data: 'dept_id='+dept_id,
                dataType: 'html',
                success: function(results) {
                    //console.log(results);
                    $("#major-id-update").html('');
                    $("#major-id-update").html(results);
                    $("#major-id-update").selectpicker("refresh");
                }
            });
        });
    });
</script>