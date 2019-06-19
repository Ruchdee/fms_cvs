<?php
  $url = basename($_SERVER['SCRIPT_NAME']);
?>
<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li <?php if($url == 'index.php'){?>class="active"<?php } ?>>
            <a href="index.php">
                <i class="material-icons">announcement</i>
                <span>ข่าว/ประกาศ</span>
            </a>
        </li>
        <li <?php if($url == 'course_list.php' || $url == 'verify.php'){?>class="active"<?php } ?>>
            <a href="course_list.php">
                <i class="material-icons">assignment</i>
                <span>รายวิชา (Course)</span>
            </a>
        </li>
    </ul>
</div>
