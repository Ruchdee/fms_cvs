<?php
  $url_sub = basename($_SERVER['SCRIPT_NAME']);
?>
<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li <?php if($url_sub == 'index.php'){?>class="active"<?php } ?> >
            <a href="index.php">
                <i class="material-icons">home</i>
                <span>หน้าหลัก (Home Page)</span>
            </a>
        </li>
        <li <?php if($url_sub == 'settings.php'){?>class="active"<?php } ?> >
            <a href="settings.php">
                <i class="material-icons">settings</i>
                <span>ข้อมูลการตั้งค่า (System Settings)</span>
            </a>
        </li>
        <li <?php if($url_sub == 'department.php'){?>class="active"<?php } ?> >
            <a href="department.php">
                <i class="material-icons">view_list</i>
                <span>ภาควิชา (Department)</span>
            </a>
        </li>
        <li <?php if($url_sub == 'major.php'){?>class="active"<?php } ?> >
            <a href="major.php">
                <i class="material-icons">layers</i>
                <span>สาขาวิชา (Major)</span>
            </a>
        </li>
        <li <?php if($url_sub == 'course.php'){?>class="active"<?php } ?> >
            <a href="course.php">
                <i class="material-icons">assignment</i>
                <span>รายวิชา (Course)</span>
            </a>
        </li>
        <li <?php if($url_sub == 'lecturer.php'){?>class="active"<?php } ?> >
            <a href="lecturer.php">
                <i class="material-icons">people</i>
                <span>อาจารย์ผู้สอน (Lecturer)</span>
            </a>
        </li>
        <li <?php if($url_sub == 'elo_list.php'){?>class="active"<?php } ?> >
            <a href="elo_list.php">
                <i class="material-icons">widgets</i>
                <span>ผลการเรียนรู้ (ELOs)</span>
            </a>
        </li>
        <li <?php if($url_sub == 'elo_mapping.php'){?>class="active"<?php } ?> >
            <a href="elo_mapping.php">
                <i class="material-icons">swap_calls</i>
                <span>ผลการเรียนรู้สู่รายวิชา (Curriculum Mapping)</span>
            </a>
        </li>
        <li class="header">OPTIONS</li>
        <li <?php if($url_sub == 'announce.php'){?>class="active"<?php } ?>>
            <a href="announce.php">
                <i class="material-icons col-red">announcement</i>
                <span>แจ้งข่าว/ประกาศ</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);">
                <i class="material-icons col-amber">donut_large</i>
                <span>Warning</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);">
                <i class="material-icons col-light-blue">donut_large</i>
                <span>Information</span>
            </a>
        </li>
    </ul>
</div>
