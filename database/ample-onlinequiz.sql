-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2021 at 06:26 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ample-onlinequiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `isAnswer` tinyint(1) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `slug`, `answer`, `isAnswer`, `question_id`) VALUES
(1, '', 'Personal Home Page', 0, 1),
(2, '', 'Personal HyperText Preprocessor', 0, 1),
(3, '', 'Hypertext Preprocessor', 1, 1),
(4, '', 'client-side programming language', 0, 2),
(5, '', 'server-side programming language', 1, 2),
(6, '', 'frontend language', 0, 2),
(7, '', 'backend language', 1, 2),
(8, '', 'cookie is destroyed when browser is closed', 0, 3),
(9, '', 'session is destroyed when browser is closed', 1, 3),
(10, '', 'both', 0, 3),
(11, '', 'php framework', 1, 4),
(12, '', 'php library', 0, 4),
(13, '', 'php controller', 0, 4),
(14, '', 'php package manager', 0, 4),
(15, '', 'route naming with naming() function', 0, 5),
(16, '', 'a routing with a name', 1, 5),
(17, '', 'give name to route with name() function', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `platform` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `outline` text DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `lunch_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `slug`, `platform`, `description`, `outline`, `create_date`, `lunch_date`) VALUES
(1, 'PHP basic', 'php-basic-61cbe87e60813', 'Facebook group', 'PHP basic', 'Variable\r\nLoops\r\nfunctions\r\nblah blah', '2021-12-29', NULL),
(2, 'Laravel Basic', 'laravel-basic-61cbe8b486263', 'Telegram', 'basic laravel', 'basic MVC', '2021-12-29', NULL),
(3, 'Dance', 'dance-61cbed8922cf3', 'Zoom', 'dancing basic to advance', 'da da da da', '2021-12-29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses_exams`
--

CREATE TABLE `courses_exams` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses_exams`
--

INSERT INTO `courses_exams` (`id`, `course_id`, `exam_id`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `courses_students`
--

CREATE TABLE `courses_students` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses_students`
--

INSERT INTO `courses_students` (`id`, `course_id`, `student_id`) VALUES
(1, 2, 2),
(2, 1, 2),
(3, 3, 1),
(4, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `courses_users`
--

CREATE TABLE `courses_users` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses_users`
--

INSERT INTO `courses_users` (`id`, `course_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `ins_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `time_limit` time NOT NULL,
  `create_date` date DEFAULT NULL,
  `lunch_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `ins_id`, `slug`, `title`, `description`, `time_limit`, `create_date`, `lunch_date`) VALUES
(1, 1, 'php-basic-61cbed4804b81', 'PHP basic', 'syntax, loops and function', '01:00:00', '2021-12-29', '2021-12-29'),
(2, 1, 'laravel-route-61cbead724e01', 'Laravel route', 'route basic', '01:00:00', '2021-12-29', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `exam_id`, `slug`, `question`, `mark`) VALUES
(1, 1, '1-61cbe9351d37e', 'What is PHP stand for?', 2),
(2, 1, '1-61cbe97c80c9c', 'PHP is', 3),
(3, 1, '1-61cbeaa8c9071', 'What is main difference between session and cookies?', 2),
(4, 2, '2-61cbeb124c144', 'What is laravel?', 1),
(5, 2, '2-61cbebef47be9', 'What is naming route?', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `review`, `date`) VALUES
(1, 2, 'wow i learning a lot from laravel basic course', '2021-12-29'),
(2, 3, 'nice php basic course fully recommand', '2021-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `students_answers`
--

CREATE TABLE `students_answers` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_answers`
--

INSERT INTO `students_answers` (`id`, `student_id`, `answer_id`, `question_id`) VALUES
(1, 2, 11, 0),
(2, 2, 15, 0),
(3, 2, 16, 0),
(4, 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students_exams`
--

CREATE TABLE `students_exams` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `submit_date` date DEFAULT NULL,
  `submit_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_exams`
--

INSERT INTO `students_exams` (`id`, `student_id`, `exam_id`, `submit_date`, `submit_time`) VALUES
(1, 2, 2, '2021-12-29', NULL),
(2, 3, 1, '2021-12-29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `slug` varchar(225) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(200) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `phone_no` varchar(200) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `slug`, `username`, `email`, `password`, `role`, `address`, `phone_no`, `image`) VALUES
(1, 'administrator-61cbe80a1d0b6', 'Administrator', 'admin@gmail.com', '$2y$10$.TjGSC8pq7BqaSz0mk1z0O7mmxezH5M2QklEoFO48HSe3d5cp09Vq', 'Teacher', NULL, NULL, 'assets/images/user-profiles/user.png'),
(2, 'jennie-61cbec3462d26', 'Jennie', 'jenn@gmail.com', '$2y$10$RwNpwIys0xiQJQ3OHlpz0.UVUtPF9q6q6t9GufmsZ6ljj4T8sqx1i', 'Teacher', NULL, NULL, 'assets/images/user-profiles/user.png'),
(3, 'rose-61cbee1349c29', 'Rose', 'rose@gmail.com', '$2y$10$6gA4cx4OOJa0HX9P0rfk5OwGH.uJGlSI1t3BeArNZ4miHxfRz9Ooi', 'Student', NULL, NULL, 'assets/images/user-profiles/user.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses_exams`
--
ALTER TABLE `courses_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses_students`
--
ALTER TABLE `courses_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses_users`
--
ALTER TABLE `courses_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_answers`
--
ALTER TABLE `students_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_exams`
--
ALTER TABLE `students_exams`
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
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses_exams`
--
ALTER TABLE `courses_exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses_students`
--
ALTER TABLE `courses_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses_users`
--
ALTER TABLE `courses_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students_answers`
--
ALTER TABLE `students_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students_exams`
--
ALTER TABLE `students_exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
