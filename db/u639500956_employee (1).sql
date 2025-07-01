-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 01, 2025 at 11:59 AM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u639500956_employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `check_in` time NOT NULL,
  `in_status` varchar(255) NOT NULL,
  `check_out` time NOT NULL,
  `out_status` varchar(255) NOT NULL,
  `work_report` text DEFAULT NULL,
  `work_file` longblob DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`id`, `employee_id`, `department`, `shift`, `location`, `message`, `date`, `check_in`, `in_status`, `check_out`, `out_status`, `work_report`, `work_file`, `created_at`) VALUES
(5, 'EMP-5', 'Software Developer', '09:30:00-17:30:00', 'Office', 'cxcx', '2025-05-03', '10:14:16', 'Late', '11:53:33', 'Early', NULL, 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(6, 'EMP-7', 'Customer Executive', '09:30:00-17:30:00', 'Home', 'test', '2025-05-03', '14:14:30', 'Late', '11:53:33', 'Early', NULL, 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(7, 'EMP-6', 'Software Developer', '09:30:00-17:30:00', 'Office', 'test\r\n\r\n', '2025-05-03', '14:15:36', 'Late', '11:53:33', 'Early', NULL, 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(8, 'EMP-3', 'Software Developer', '09:30:00-17:30:00', 'Office', 'test', '2025-05-03', '14:19:07', 'Late', '11:53:33', 'Early', NULL, 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(9, 'EMP-2', 'Customer Executive', '09:30:00-17:30:00', 'Office', 'test', '2025-05-03', '14:20:46', 'Late', '11:53:33', 'Early', NULL, 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(10, 'EMP-4', 'Software Developer', '09:30:00-17:30:00', 'Office', 'test\r\n', '2025-05-03', '14:56:42', 'Late', '11:53:33', 'Early', NULL, 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(11, 'EMP-5', 'Software Developer', '09:30:00-17:30:00', 'Office', 'gfgfgarg', '2025-05-05', '11:01:53', 'Late', '11:53:33', 'Early', NULL, 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(12, 'EMP-5', 'Software Developer', '09:30:00-17:30:00', 'Office', 'office test\r\n', '2025-05-06', '10:09:54', 'Late', '11:53:33', 'Early', '', 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(13, 'EMP-3', 'Software Developer', '09:30:00-17:30:00', 'Office', '', '2025-05-06', '14:45:26', 'Late', '11:53:33', 'Early', 'dsdssd', 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(14, 'EMP-2', 'Customer Executive', '09:30:00-17:30:00', 'Office', '', '2025-05-06', '15:55:06', 'Late', '11:53:33', 'Early', 'eee', 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(15, 'EMP-7', 'Customer Executive', '09:30:00-17:30:00', 'Office', '', '2025-05-06', '16:43:09', 'Late', '11:53:33', 'Early', 's', 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(16, 'EMP-6', 'Software Developer', '09:30:00-17:30:00', 'Office', '', '2025-05-06', '16:45:36', 'Late', '11:53:33', 'Early', NULL, 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(17, '', '', '', 'Office', '', '2025-05-07', '09:41:31', 'Late', '11:53:33', 'Early', NULL, 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(18, 'EMP-5', 'Software Developer', '09:30:00-17:30:00', 'Office', '', '2025-05-07', '09:59:52', 'Late', '11:53:33', 'Early', 'c', 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(19, 'EMP-5', 'Software Developer', '09:30:00-17:30:00', 'Office', '', '2025-05-07', '10:46:16', 'Late', '11:53:33', 'Early', 'c', 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(20, 'EMP-3', 'Software Developer', '09:30:00-17:30:00', 'Office', '', '2025-05-07', '11:09:37', 'Late', '11:53:33', 'Early', '', 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(21, 'EMP-6', 'Software Developer', '09:30:00-17:30:00', 'Office', '', '2025-05-07', '11:53:15', 'Late', '11:53:33', 'Early', NULL, 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530375f454d502d365f5765627369746520436f6e74656e742e706466, '2025-05-07 06:23:33'),
(22, 'EMP-7', 'Customer Executive', '09:30:00-17:30:00', 'Office', '', '2025-05-07', '16:20:32', 'Late', '16:20:39', 'Early', '', '', '2025-05-07 10:50:39'),
(23, 'EMP-5', 'Software Developer', '09:30:00-17:30:00', 'Office', '', '2025-05-09', '11:00:04', 'Late', '11:41:36', 'Early', '', 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530395f454d502d355f363831643963393833326432632e706466, '2025-05-09 06:11:36'),
(24, 'EMP-7', 'Customer Executive', '09:30:00-17:30:00', 'Office', '', '2025-05-09', '12:18:48', 'Late', '12:47:39', 'Early', '', 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530395f454d502d375f363831646163313336613064345f456d706c6f79656520417474656e64616e6365205265706f72742e706466, '2025-05-09 07:17:39'),
(25, 'EMP-7', 'Customer Executive', '09:30:00-17:30:00', 'Office', '', '2025-05-09', '12:22:12', 'Late', '12:47:39', 'Early', '', 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530395f454d502d375f363831646163313336613064345f456d706c6f79656520417474656e64616e6365205265706f72742e706466, '2025-05-09 07:17:39'),
(26, 'EMP-7', 'Customer Executive', '09:30:00-17:30:00', 'Office', '', '2025-05-09', '12:22:15', 'Late', '12:47:39', 'Early', '', 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303530395f454d502d375f363831646163313336613064345f456d706c6f79656520417474656e64616e6365205265706f72742e706466, '2025-05-09 07:17:39'),
(27, 'EMP-6', 'Software Developer', '09:30:00-17:30:00', 'Office', '', '2025-05-09', '12:59:26', 'Late', '12:59:47', 'Early', '', '', '2025-05-09 07:29:47'),
(28, 'EMP-5', 'Software Developer', '09:30:00-17:30:00', 'Office', '', '2025-05-12', '10:20:52', 'Late', '10:21:23', 'Early', '', 0x2e2e2f75706c6f6164732f776f726b5f7265706f7274732f32303235303531325f454d502d355f363832313765346233376263665f456d706c6f79656520417474656e64616e6365205265706f72742e706466, '2025-05-12 04:51:23'),
(29, 'EMP-7', 'Customer Executive', '09:30:00-17:30:00', 'Office', '', '2025-05-12', '11:27:48', 'Late', '11:28:22', 'Early', '', 0x75706c6f6164732f776f726b5f7265706f7274732f32303235303531325f454d502d375f363832313864666538373964305f6769742d63686561742d73686565742e706466, '2025-05-12 05:58:22'),
(30, 'EMP-6', 'Software Developer', '09:30:00-17:30:00', 'Office', '', '2025-05-12', '12:16:59', 'Late', '12:17:13', 'Early', '', 0x2e2e2f75706c6f6164732f776f726b5f7265706f7274732f32303235303531325f454d502d365f363832313939373161653232305f456d706c6f79656520417474656e64616e6365205265706f72742e706466, '2025-05-12 06:47:13'),
(31, 'EMP-5', 'Software Developer', '09:30:00-17:30:00', 'Office', '', '2025-05-13', '10:28:23', 'Late', '10:28:43', 'Early', '', 0x2e2e2f75706c6f6164732f776f726b5f7265706f7274732f32303235303531335f454d502d355f363832326431383333613239395f456d706c6f79656520417474656e64616e6365205265706f72742e706466, '2025-05-13 04:58:43'),
(32, 'EMP-8', 'HR', '09:30:00-17:30:00', 'Office', '', '2025-05-13', '11:23:42', 'Late', '11:24:57', 'Early', 'Attendance Management System Process', 0x2e2e2f75706c6f6164732f776f726b5f7265706f7274732f32303235303531335f454d502d385f363832326465623134643033655f656d706c6f7965655f7265706f72745f323032352d30352d3036202836292e786c73, '2025-05-13 05:54:57'),
(33, 'EMP-5', 'Software Developer', '09:30:00-17:30:00', 'Office', '', '2025-06-19', '09:46:22', 'Late', '00:00:00', '', NULL, NULL, '2025-06-19 04:16:22'),
(34, 'EMP-3', 'Software Developer', '09:30:00-17:30:00', 'Office', '', '2025-06-19', '11:30:39', 'Late', '00:00:00', '', NULL, NULL, '2025-06-19 06:00:39'),
(35, 'EMP-3', 'Software Developer', '09:30:00-17:30:00', 'Office', '', '2025-06-20', '12:27:10', 'Late', '00:00:00', '', NULL, NULL, '2025-06-20 06:57:10'),
(36, 'EMP-2', 'Admin', '09:30:00-17:30:00', 'Office', '', '2025-06-20', '16:12:55', 'Late', '00:00:00', '', NULL, NULL, '2025-06-20 10:42:55'),
(37, '', '', '', 'Office', '', '2025-06-20', '16:33:35', 'Late', '00:00:00', '', NULL, NULL, '2025-06-20 11:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `department_name` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `department_id`, `department_name`, `status`, `created_at`) VALUES
(1, 'IT', 'Software Developer', 1, '2025-05-02 11:35:07'),
(2, 'ADM', 'Admin', 1, '2023-09-29 05:47:39'),
(3, 'HRD', 'HR', 1, '2023-09-29 05:47:51'),
(4, 'BPO', 'Customer Executive', 1, '2025-05-02 11:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `emailid` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `employee_id` varchar(250) NOT NULL,
  `joining_date` varchar(250) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT '0' COMMENT '1=Admin, 0=Employee',
  `status` tinyint(4) NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `first_name`, `last_name`, `username`, `emailid`, `password`, `dob`, `gender`, `employee_id`, `joining_date`, `phone`, `shift`, `department`, `role`, `status`, `created_at`, `profile_image`) VALUES
(1, 'admin', '', 'admin', 'admin@eam.com', 'Admin123', '', '', '', '', '', '', '', '1', 1, '2025-05-06 06:12:49', NULL),
(2, 'Mathanraja', 'P', 'Mathan15', 'mathan15@gmail.com', '1234', '15/03/2000', 'Male', 'EMP-2', '02/05/2025', '7708786932', '09:30:00-17:30:00', 'Software Developer', '0', 1, '2025-07-01 11:54:20', '../uploads/profile_images/2_1751370860_MathanProfile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `location`, `created_at`) VALUES
(1, 'Office', '2023-09-29 05:52:28'),
(2, 'Field', '2023-09-29 05:52:40'),
(3, 'Home', '2023-09-29 05:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift`
--

CREATE TABLE `tbl_shift` (
  `id` int(11) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=Active,0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_shift`
--

INSERT INTO `tbl_shift` (`id`, `start_time`, `end_time`, `status`, `created_at`) VALUES
(1, '09:30:00', '17:30:00', 1, '2025-05-02 11:33:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
