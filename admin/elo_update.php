<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_elo.php';
    include_once '../php/tb_major.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $elo = new Elo($db);
    $elo->elo_id = $_POST['elo_id'];
    $result = $elo->readone();
    $row_update = mysqli_fetch_array($result);

    $major = new Major($db);

?>

<div class="row clearfix">
    <div class="col-md-12">
        <input type="hidden" id="elo-id-update" name="elo-id-update" value="<?php echo $_POST['elo_id']; ?>">
        <label for="elo-desc-update">ผลการเรียนรู้</label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" id="elo-desc-update" name="elo-desc-update" class="form-control" placeholder="" required maxlength="200" value="<?php echo $row_update['elo_desc']; ?>">
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-12">
        <label for="elo-type-update">ประเภทผลการเรียนรู้</label>
        <select class="form-control show-tick" id="elo-type-update" name="elo-type-update" required>
            <option value="">-- Please select --</option>
            <option value="1" <?php if ($row_update['elo_type'] == '1') { echo 'selected'; } ?>>ด้านคุณธรรม จริยธรรม</option>
            <option value="2" <?php if ($row_update['elo_type'] == '2') { echo 'selected'; } ?>>ด้านความรู้</option>
            <option value="3" <?php if ($row_update['elo_type'] == '3') { echo 'selected'; } ?>>ด้านทักษะทางปัญญา</option>
            <option value="4" <?php if ($row_update['elo_type'] == '4') { echo 'selected'; } ?>>ด้านทักษะความสัมพันธ์ระหว่างบุคคลและความรับผิดชอบ</option>
            <option value="5" <?php if ($row_update['elo_type'] == '5') { echo 'selected'; } ?>>ด้านทักษะการวิเคราะห์เชิงตัวเลข การสื่อสารและการใช้เทคโนโลยีสารสนเทศ</option>
        </select>
    </div>
</div>
<br>
<div class="row clearfix">
    <div class="col-md-6">
        <label for="major-id-update">สาขาวิชา</label>
        <select id="major-id-update" name="major-id-update" class="form-control show-tick" required>
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
    <div class="col-md-6">
        <label for="elo-status-update">สถานะการใช้งาน</label>
        <div class="demo-switch">
            <div class="switch">
                <label>ยกเลิก<input type="checkbox" id="elo-status-update" name="elo-status-update" <?php if ($row_update['elo_status']) {echo 'checked';} ?>><span class="lever"></span>ใช้งาน</label>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        //refresh all select elements
        $("#elo-type-update").selectpicker("refresh");
        $("#major-id-update").selectpicker("refresh");
    });
</script>