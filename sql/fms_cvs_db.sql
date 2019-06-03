-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 03, 2019 at 11:02 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fms_cvs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL COMMENT 'Course ID',
  `course_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Course Code',
  `course_name_th` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Course Thai Name',
  `course_name_en` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Course English Name',
  `major_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Major ID',
  `course_credit` tinyint(4) NOT NULL COMMENT 'No of Credit(s)',
  `is_mapped` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Is it mapped with elos?',
  `course_status` tinyint(1) NOT NULL COMMENT 'Course Status',
  `created_by` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User ID',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_code`, `course_name_th`, `course_name_en`, `major_id`, `course_credit`, `is_mapped`, `course_status`, `created_by`, `created_date`) VALUES
(2, '460-107', 'ซอฟท์แวร์ประยุกต์ทางธุรกิจ', 'Software Application in Business', 'FMS-BA-MK', 3, 0, 1, 'test', '2019-05-18 07:37:18'),
(3, '477-302', 'การเขียนโปรแกรมบนเว็บ', 'Web Programming', 'FMS-BA-BIS', 3, 1, 1, 'test', '2019-05-18 07:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Department ID',
  `dept_name_th` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Department Thai Name',
  `dept_name_en` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Department English Name',
  `dept_status` tinyint(1) NOT NULL COMMENT 'Department Status',
  `created_by` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User ID',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name_th`, `dept_name_en`, `dept_status`, `created_by`, `created_date`) VALUES
('FMS-BA', 'บริหารธุรกิจ', 'Business Administration', 1, 'test', '2019-05-06 14:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `elos`
--

CREATE TABLE `elos` (
  `elo_id` varchar(18) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Major ID + "-99"',
  `elo_desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ELO Description',
  `elo_type` char(1) COLLATE utf8_unicode_ci NOT NULL COMMENT '5 Learning Outcome Types',
  `major_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Major ID',
  `elo_status` tinyint(1) NOT NULL COMMENT 'ELO Status',
  `created_by` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User ID',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elos`
--

INSERT INTO `elos` (`elo_id`, `elo_desc`, `elo_type`, `major_id`, `elo_status`, `created_by`, `created_date`) VALUES
('FMS-BA-BIS-01', 'มีวินัย ตรงต่อเวลา ซื่อสัตย์สุจริต และความรับผิดชอบต่อตนเองและสังคม', '1', 'FMS-BA-BIS', 1, 'test', '2019-05-25 05:32:09'),
('FMS-BA-BIS-02', 'ตระหนักถึงสิทธิและหน้าที่ของตนเอง รวมถึงเคารพสิทธิและรับฟังความคิดเห็นของผู้อื่น', '1', 'FMS-BA-BIS', 1, 'test', '2019-05-25 05:32:25'),
('FMS-BA-BIS-03', 'เคารพกฎระเบียบและข้อบังคับต่าง ๆ ขององค์กรและสังคม', '1', 'FMS-BA-BIS', 1, 'test', '2019-05-25 05:32:40'),
('FMS-BA-BIS-04', 'มีทัศนคติที่ดีต่อวิชาชีพ และแสดงออกถึงคุณธรรมและจรรยาบรรณทางวิชาการและวิชาชีพ', '1', 'FMS-BA-BIS', 1, 'test', '2019-05-25 05:33:00'),
('FMS-BA-BIS-05', 'มีความรู้และความเข้าใจเกี่ยวกับหลักการและทฤษฎีที่สำคัญในเนื้อหาที่ศึกษา', '2', 'FMS-BA-BIS', 1, 'test', '2019-05-25 05:39:19');

-- --------------------------------------------------------

--
-- Table structure for table `elos_mapping`
--

CREATE TABLE `elos_mapping` (
  `course_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Course ID',
  `elo_id` varchar(18) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ELO ID',
  `is_verified` tinyint(1) NOT NULL COMMENT 'Is it verified?',
  `created_by` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User ID',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created Date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elos_mapping`
--

INSERT INTO `elos_mapping` (`course_id`, `elo_id`, `is_verified`, `created_by`, `created_date`) VALUES
('3', 'FMS-BA-BIS-01', 0, 'test', '2019-06-01 05:15:19'),
('3', 'FMS-BA-BIS-02', 1, 'test', '2019-06-01 05:15:19'),
('3', 'FMS-BA-BIS-03', 1, 'test', '2019-06-01 05:15:19'),
('3', 'FMS-BA-BIS-04', 1, 'test', '2019-06-01 05:15:19'),
('3', 'FMS-BA-BIS-05', 0, 'test', '2019-06-01 05:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `lecturer_id` varchar(8) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL COMMENT 'Lecturer ID',
  `title_th` tinyint(4) NOT NULL COMMENT '1=นาย 2=น.ส. 3=นาง 4=อ. 5=ดร. 6=ผศ. 7=ผศ.ดร. 8=รศ. 9=รศ.ดร. 10=ศ.',
  `title_en` tinyint(4) DEFAULT NULL COMMENT '1=Mr. 2=Ms. 3=Mrs. 4=Instructor 5=Dr. 6=Asst.Prof. 7=Asst.Prof.Dr. 8=Assoc.Prof. 9=Assoc.Prof.Dr. 10=Prof.',
  `lecturer_name_th` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Lecturer Thai Name',
  `lecturer_name_en` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Lecturer English Name',
  `major_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Major ID',
  `lecturer_status` tinyint(1) NOT NULL COMMENT 'Lecturer Status',
  `created_by` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User ID',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Created Date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`lecturer_id`, `title_th`, `title_en`, `lecturer_name_th`, `lecturer_name_en`, `major_id`, `lecturer_status`, `created_by`, `created_date`) VALUES
('0024121', 5, 5, 'รุชดี บิลหมัด', 'Ruchdee Binmad', 'FMS-BA-BIS', 1, 'test', '2019-06-02 08:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `major_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Major ID',
  `major_name_th` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Major Thai Name',
  `major_name_en` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Major English Name',
  `dept_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Department ID',
  `major_status` tinyint(1) NOT NULL COMMENT 'Major Status',
  `created_by` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User ID',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`major_id`, `major_name_th`, `major_name_en`, `dept_id`, `major_status`, `created_by`, `created_date`) VALUES
('FMS-BA-BIS', 'ระบบสารสนเทศทางธุรกิจ', 'Business Information System', 'FMS-BA', 1, 'test', '2019-05-18 07:36:56'),
('FMS-BA-FIN', 'การเงิน', 'Finance', 'FMS-BA', 0, 'test', '2019-05-06 14:12:42'),
('FMS-BA-HRM', 'บริหารทรัพยากรมนุษย์', 'Human Resource Management', 'FMS-BA', 1, 'test', '2019-05-06 14:13:10'),
('FMS-BA-LM', 'การจัดการโลจิสติกส์', 'Logistics Management', 'FMS-BA', 1, 'test', '2019-05-06 14:13:39'),
('FMS-BA-MICE', 'การจัดการประชุม นิทรรศการ', 'MICE', 'FMS-BA', 1, 'test', '2019-05-06 14:14:45'),
('FMS-BA-MK', 'การตลาด', 'Marketing', 'FMS-BA', 1, 'test', '2019-05-06 14:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `fac_name_th` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Faculty Thai Name',
  `fac_name_en` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Faculty English Name',
  `curr_semester` char(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Current Semester',
  `curr_ac_year` char(4) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Current Academic Year',
  `updated_by` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`fac_name_th`, `fac_name_en`, `curr_semester`, `curr_ac_year`, `updated_by`, `updated_date`) VALUES
('คณะวิทยาการจัดการ', 'Management Sciences', '3', '2561', 'test', '2019-06-01 06:11:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `session_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Session ID',
  `user_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User ID',
  `login_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Login Date & Time',
  `logout_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Logout Date & Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verification_avg`
--

CREATE TABLE `verification_avg` (
  `course_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Course ID',
  `lecturer_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Lecturer ID',
  `semester` char(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Semester 1=1, Semester 2=2, Semester 3=3',
  `ac_year` char(4) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Academic Year',
  `section` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Section "01", "02", ...',
  `elo_id` varchar(18) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ELO ID',
  `is_verified` tinyint(1) NOT NULL COMMENT 'Is it verified?',
  `no_students` smallint(6) NOT NULL COMMENT 'Number of Students',
  `score_sum` int(11) NOT NULL COMMENT 'Score Summation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verification_courses`
--

CREATE TABLE `verification_courses` (
  `verification_id` int(11) NOT NULL COMMENT 'Verification ID',
  `student_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Student ID',
  `course_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Course ID',
  `lecturer_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Lecturer ID',
  `section` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Section',
  `semester` char(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Semester 1=1, Semester 2=2, Semester 3=3',
  `ac_year` char(4) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Academic Year',
  `score_avg` decimal(10,4) NOT NULL COMMENT 'Average Score',
  `verified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Verified Date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verification_elos`
--

CREATE TABLE `verification_elos` (
  `verification_id` int(11) NOT NULL,
  `elo_id` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL COMMENT 'Is it verified?',
  `score` tinyint(4) NOT NULL COMMENT 'Score'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `elos`
--
ALTER TABLE `elos`
  ADD PRIMARY KEY (`elo_id`);

--
-- Indexes for table `elos_mapping`
--
ALTER TABLE `elos_mapping`
  ADD PRIMARY KEY (`course_id`,`elo_id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`lecturer_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `verification_courses`
--
ALTER TABLE `verification_courses`
  ADD PRIMARY KEY (`verification_id`);

--
-- Indexes for table `verification_elos`
--
ALTER TABLE `verification_elos`
  ADD PRIMARY KEY (`verification_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Course ID', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `verification_courses`
--
ALTER TABLE `verification_courses`
  MODIFY `verification_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Verification ID';COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
