<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_elo.php';
    include_once '../php/tb_elo_mapping.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    //elo_mapping
    $elo_mapping = new Elo_mapping($db);
    $elo_mapping->course_id = $_POST['course_id'];
    $result_elo_mapping = $elo_mapping->readonecourse();

    //elos
    $elo = new Elo($db);
?>

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
                while ($row_list_elo = mysqli_fetch_array($result_elo_mapping)) { 
                    $elo->elo_id = $row_list_elo['elo_id'];
                    $result_elo = $elo->readone();
                    $row_elo = mysqli_fetch_array($result_elo);
            ?>
                <tr>
                    <td class="text-center">
                        <?php 
                            switch ($row_elo['elo_type']) {
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
                    <td><?php echo $row_elo['elo_desc']; ?></td>
                    <td class="text-center">
                    <?php
                        if ($row_list_elo['is_verified']) {
                            echo "<i class='material-icons col-amber'>check_circle</i>";
                        } else {
                            echo "<i class='material-icons col-deep-orange'>remove_circle</i>";
                        }
                    ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>