<?php
    include_once '../php/dbconnect.php';
    include_once '../php/tb_major.php';
    include_once '../php/tb_course.php';
    include_once '../php/tb_elo.php';
    include_once '../php/tb_elo_mapping.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    //course
    $course = new Course($db);
    $course->course_id = $_POST['course_id'];
    $result_course = $course->readone();
    $row_update_course = mysqli_fetch_array($result_course);

    //major
    $major = new Major($db);
    $major->major_id = $row_update_course['major_id'];
    $result_major = $major->readone();
    $row_update_major = mysqli_fetch_array($result_major);
    
    //elos
    $elo = new Elo($db);

    //elo_mapping
    $elo_mapping = new Elo_mapping($db);
    $elo_mapping->course_id = $_POST['course_id'];
    $result_elo_mapping = $elo_mapping->readonecourse();

?>

<div class="row clearfix">
    <div class="col-md-6">
        <input type="hidden" id="course-id" name="course-id" value="<?php echo $_POST['course_id']; ?>">
        <label for="elo-desc">สาขาวิชา</label>
        <div class="form-group">
            <div class="form-line">
                <span><?php echo $row_update_major['major_name_th']; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label for="elo-desc">รหัสรายวิชา</label>
        <div class="form-group">
            <div class="form-line">
                <span><?php echo $row_update_course['course_code']; ?></span>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-6">
        <label for="elo-type">ชื่อรายวิชา (ไทย)</label>
        <div class="form-group">
            <div class="form-line">
                <span><?php echo $row_update_course['course_name_th']; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label for="elo-type">ชื่อรายวิชา (Eng)</label>
        <div class="form-group">
            <div class="form-line">
                <span><?php echo $row_update_course['course_name_en']; ?></span>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-12">
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th class="text-center">ประเภท</th>
                    <th>ผลการเรียนรู้ (ELOs)</th>
                    <th class="text-center">ประเมิน</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                while ($row_update_elo_mapping = mysqli_fetch_array($result_elo_mapping)) { 
                    $elo->elo_id = $row_update_elo_mapping['elo_id'];
                    $result_update_elo = $elo->readone();
                    $row_update_elo = mysqli_fetch_array($result_update_elo);
            ?>
                <tr>
                    <td class="text-center">
                        <?php 
                            switch ($row_update_elo['elo_type']) {
                                case '1':
                                    echo "ด้านคุณธรรม จริยธรรม";
                                    break;
                                case '2':
                                    echo "ด้านความรู้";
                                    break;
                                case '3':
                                    echo "ด้านทักษะทางปัญญา";
                                    break;
                                case '4':
                                    echo "ด้านทักษะความสัมพันธ์ระหว่างบุคคลและความรับผิดชอบ";
                                    break;
                                case '5':
                                    echo "ด้านทักษะการวิเคราะห์เชิงตัวเลข การสื่อสารและการใช้เทคโนโลยีสารสนเทศ";
                                    break;
                            }
                        ?>
                    </td>
                    <td><?php echo $row_update_elo['elo_desc']; ?></td>
                    <td>
                        <div class="switch">
                            <label><input type="checkbox" id="elo-verify-<?php echo $row_update_elo_mapping['elo_id']; ?>" name="elo-verify-<?php echo $row_update_elo_mapping['elo_id']; ?>" <?php if ($row_update_elo_mapping['is_verified']) {echo 'checked';} ?>><span class="lever"></span></label>
                        </div>
                        <input type="hidden" id="elo-id" name="elo-id[]" value="<?php echo $row_update_elo_mapping['elo_id']; ?>">
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>