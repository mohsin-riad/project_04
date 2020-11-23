-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2020 at 07:18 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_04`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `code`, `credit`, `type`, `semester`) VALUES
(1, 'ACC', 'ACC 101', '3', 'theory', 1),
(2, 'ICS', 'CSE 110', '2', 'theory', 1),
(3, 'ElectCt-1', 'EEE 101', '3', 'theory', 1),
(4, 'ENG-1', 'ENG 101', '3', 'theory', 1),
(5, 'EM-1', 'MAT 105', '3', 'theory', 1),
(6, 'PHY-1', 'PHY 101', '3', 'theory', 1),
(7, 'DM', 'CSE 103', '3', 'theory', 2),
(8, 'SP', 'CSE 111', '2', 'theory', 2),
(9, 'Elect-1', 'EEE 211', '3', 'theory', 2),
(10, 'ENG-2', 'ENG 103', '2', 'theory', 2),
(11, 'EM-2', 'MAT 107', '3', 'theory', 2),
(12, 'PHY-2', 'PHY 103', '3', 'theory', 2),
(13, 'OOP', 'CSE 211', '3', 'theory', 3),
(14, 'DS', 'CSE 221', '3', 'theory', 3),
(15, 'ECO', 'ECO 201', '3', 'theory', 3),
(16, 'DE', 'EEE 311', '3', 'theory', 3),
(17, 'EM-3', 'MAT 201', '3', 'theory', 3),
(18, 'ADA', 'CSE 225', '3', 'theory', 4),
(19, 'DMS', 'CSE 237', '3', 'theory', 4),
(20, 'SS', 'EEE 201', '3', 'theory', 4),
(21, 'EM-4', 'MAT 203', '3', 'theory', 4),
(22, 'IBM', 'MGT 203', '3', 'theory', 4),
(23, 'MM', 'EEE 371', '3', 'theory', 5),
(24, 'SEISD', 'CSE 305', '4', 'theory', 5),
(25, 'CE', 'EEE 309', '3', 'theory', 5),
(26, 'OB', 'MGT 251', '3', 'theory', 5),
(27, 'CMEP', 'CSE 301', '3', 'theory', 5);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `student_id`, `course_id`, `type_id`, `section_id`, `teacher_id`, `session_id`, `status`) VALUES
(1, 19, 13, 1, 7, 12, 1, 1),
(2, 20, 23, 1, 13, 18, 3, 1),
(3, 20, 24, 1, 14, 16, 3, 1),
(4, 20, 25, 1, 13, 17, 3, 1),
(5, 20, 27, 1, 13, 15, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `num_dist`
--

CREATE TABLE `num_dist` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `catagory_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `num_dist`
--

INSERT INTO `num_dist` (`id`, `course_id`, `teacher_id`, `section_id`, `session_id`, `catagory_name`, `marks`) VALUES
(1, 5, 3, 1, 7, 'ct-1', 5),
(2, 5, 3, 1, 7, 'ct-2', 5),
(3, 5, 3, 1, 7, 'attendance', 10),
(4, 5, 3, 1, 7, 'assignment', 10),
(5, 5, 3, 1, 7, 'mid', 20),
(6, 5, 3, 1, 7, 'final', 50),
(7, 11, 3, 4, 8, 'attendance', 10),
(8, 11, 3, 4, 8, 'assignment', 10),
(9, 11, 3, 4, 8, 'ct', 10),
(10, 11, 3, 4, 8, 'mid', 20),
(11, 11, 3, 4, 8, 'final', 50),
(12, 18, 12, 10, 2, 'attendance', 10),
(13, 18, 12, 10, 2, 'ct', 10),
(14, 18, 12, 10, 2, 'assignment', 10),
(15, 18, 12, 10, 2, 'mid', 20),
(16, 18, 12, 10, 2, 'final', 50),
(17, 21, 3, 10, 2, 'assignment', 20),
(18, 21, 3, 10, 2, 'mid', 30),
(19, 21, 3, 10, 2, 'final', 50),
(20, 24, 16, 14, 3, 'attendance', 10),
(21, 24, 16, 14, 3, 'ct', 10),
(22, 24, 16, 14, 3, 'assignment', 10),
(23, 24, 16, 14, 3, 'mid', 20),
(24, 24, 16, 14, 3, 'final', 50);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `semester`) VALUES
(1, 'C1A', '1'),
(2, 'C1B', '1'),
(3, 'C1C', '1'),
(4, 'C2A', '2'),
(5, 'C2B', '2'),
(6, 'C2C', '2'),
(7, 'C3A', '3'),
(8, 'C3B', '3'),
(9, 'C3C', '3'),
(10, 'C4A', '4'),
(11, 'C4B', '4'),
(12, 'C4C', '4'),
(13, 'C5A', '5'),
(14, 'C5B', '5'),
(15, 'C5C', '5');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `name`, `status`) VALUES
(1, 'Spring 2019', 0),
(2, 'fall 2019', 0),
(3, 'Spring 2020', 1),
(4, 'fall 2020', 0),
(5, 'Spring 2021', 0),
(6, 'fall 2021', 0),
(7, 'spring 2018', 0),
(8, 'fall 2018', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_assign`
--

CREATE TABLE `teacher_assign` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_assign`
--

INSERT INTO `teacher_assign` (`id`, `teacher_id`, `section_id`, `course_id`, `session_id`, `status`) VALUES
(1, 3, 1, 5, 7, 1),
(2, 3, 4, 11, 8, 1),
(3, 3, 10, 21, 2, 1),
(4, 12, 4, 7, 3, 0),
(5, 12, 10, 18, 2, 1),
(7, 12, 7, 13, 1, 0),
(8, 15, 13, 27, 3, 0),
(9, 16, 14, 24, 3, 1),
(10, 17, 13, 25, 3, 0),
(11, 18, 13, 23, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`, `status`) VALUES
(1, 'Regular', 0),
(2, 'Retake', 0),
(3, 'Recourse', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'admin'),
(2, 'Mohammad Arif ', 'arif@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(3, 'Akramul Kabir Khan', 'akram@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(4, 'Sumon Sen ', 'sumon@gmail.com', '96e79218965eb72c92a549dd5a330112', 'teacher'),
(5, 'Toufiq sayed', 'toufiq@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(6, 'Iftekhar Khan', 'iftekhar@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(7, 'Nusrat Shirin', 'shirin@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(8, 'Faisal ahmed', 'faisal@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(9, 'KMH hamim', 'hamim@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(10, 'Rukon Uddin', 'rukon@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(11, 'Farhana shirin', 'shirin@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(12, 'Minhaz hossen', 'minhaz@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(13, 'Mehedi hassan', 'mehedi@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(14, 'minhaz Rahat', 'hamim@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(15, 'Tania noor', 'tania@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(16, 'Anik sen', 'anik@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(17, 'tanni Dhoom', 'tanni@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(18, 'kingshuk dhar', 'king@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'teacher'),
(19, 'student1', 'std1@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'student'),
(20, 'student2', 'std2@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'student'),
(21, 'student3', 'std3@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `num_dist`
--
ALTER TABLE `num_dist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_assign`
--
ALTER TABLE `teacher_assign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `num_dist`
--
ALTER TABLE `num_dist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teacher_assign`
--
ALTER TABLE `teacher_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `enrollment_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `enrollment_ibfk_4` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `enrollment_ibfk_5` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`),
  ADD CONSTRAINT `enrollment_ibfk_6` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Constraints for table `num_dist`
--
ALTER TABLE `num_dist`
  ADD CONSTRAINT `num_dist_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `num_dist_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `num_dist_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `num_dist_ibfk_4` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`);

--
-- Constraints for table `teacher_assign`
--
ALTER TABLE `teacher_assign`
  ADD CONSTRAINT `teacher_assign_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `teacher_assign_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `teacher_assign_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `teacher_assign_ibfk_4` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
