-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2016 at 11:31 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bookexchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author(s)` varchar(255) DEFAULT NULL,
  `edition` varchar(255) DEFAULT NULL,
  `ISBN` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `have`
--

CREATE TABLE IF NOT EXISTS `have` (
  `have_id` int(11) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `course_number` int(11) DEFAULT NULL,
  `course_section` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE IF NOT EXISTS `major` (
  `major_id` int(11) NOT NULL,
  `major` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`major_id`, `major`) VALUES
(1, 'Accounting'),
(2, 'Actuarial Science'),
(3, 'Advertising'),
(4, 'Art'),
(5, 'Biochemistry'),
(6, 'Biology'),
(7, 'Chemistry'),
(8, 'Civil Engineering'),
(9, 'Communication'),
(10, 'Computer Information Systems'),
(11, 'Computer Science'),
(12, 'Construction'),
(13, 'Criminal Justice Studies'),
(14, 'Dietetics'),
(15, 'Education'),
(16, 'Economics'),
(17, 'Electrical Engineering'),
(18, 'Family and Consumer Science'),
(19, 'Finance'),
(20, 'French'),
(21, 'Health Science'),
(22, 'History '),
(23, 'Hospitality Leadership'),
(24, 'Industrial Engineering'),
(25, 'Interactive Media'),
(26, 'International Business'),
(27, 'International Studies'),
(28, 'Journalism'),
(29, 'Management and Leadership'),
(30, 'Management Informational Systems'),
(31, 'Manufacturing Engineering'),
(32, 'Marketing'),
(33, 'Mathematics'),
(34, 'Mechanical Engineering'),
(35, 'Medical Laboratory Science'),
(36, 'Medical Terminology'),
(37, 'Music'),
(38, 'Music Business'),
(39, 'Nursing'),
(40, 'Philosophy'),
(41, 'Physics'),
(42, 'Political Science'),
(43, 'Physical Therapy'),
(44, 'Psychology'),
(45, 'Public Relations'),
(46, 'Religious Studies'),
(47, 'Retail Merchandising'),
(48, 'Spanish'),
(49, 'Social Work'),
(50, 'Sociology'),
(51, 'Sports Communication'),
(52, 'Theatre');

-- --------------------------------------------------------

--
-- Table structure for table `need`
--

CREATE TABLE IF NOT EXISTS `need` (
  `need_id` int(11) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `course_number` int(11) DEFAULT NULL,
  `course_section` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paired`
--

CREATE TABLE IF NOT EXISTS `paired` (
  `need_id` int(11) NOT NULL,
  `have_id` int(11) NOT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE IF NOT EXISTS `school` (
  `school_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`school_id`, `name`, `street_address`, `city`, `state_id`) VALUES
(1, 'Bradley University', '1501 W Bradley Ave', 'Peoria', 17);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `name`, `code`) VALUES
(1, 'Alabama', 'AL'),
(2, 'Alaska', 'AK'),
(3, 'American Samoa', 'AS'),
(4, 'Arizona', 'AZ'),
(5, 'Arkansas', 'AR'),
(6, 'California', 'CA'),
(7, 'Colorado', 'CO'),
(8, 'Connecticut', 'CT'),
(9, 'Delaware', 'DE'),
(10, 'District of Columbia', 'DC'),
(11, 'Federated States of Micronesia', 'FM'),
(12, 'Florida', 'FL'),
(13, 'Georgia', 'GA'),
(14, 'Guam', 'GU'),
(15, 'Hawaii', 'HI'),
(16, 'Idaho', 'ID'),
(17, 'Illinois', 'IL'),
(18, 'Indiana', 'IN'),
(19, 'Iowa', 'IA'),
(20, 'Kansas', 'KS'),
(21, 'Kentucky', 'KY'),
(22, 'Louisiana', 'LA'),
(23, 'Maine', 'ME'),
(24, 'Marshall Islands', 'MH'),
(25, 'Maryland', 'MD'),
(26, 'Massachusetts', 'MA'),
(27, 'Michigan', 'MI'),
(28, 'Minnesota', 'MN'),
(29, 'Mississippi', 'MS'),
(30, 'Missouri', 'MO'),
(31, 'Montana', 'MT'),
(32, 'Nebraska', 'NE'),
(33, 'Nevada', 'NV'),
(34, 'New Hampshire', 'NH'),
(35, 'New Jersey', 'NJ'),
(36, 'New Mexico', 'NM'),
(37, 'New York', 'NY'),
(38, 'North Carolina', 'NC'),
(39, 'North Dakota', 'ND'),
(40, 'Northern Mariana Islands', 'MP'),
(41, 'Ohio', 'OH'),
(42, 'Oklahoma', 'OK'),
(43, 'Oregon', 'OR'),
(44, 'Palau', 'PW'),
(45, 'Pennsylvania', 'PA'),
(46, 'Puerto Rico', 'PR'),
(47, 'Rhode Island', 'RI'),
(48, 'South Carolina', 'SC'),
(49, 'South Dakota', 'SD'),
(50, 'Tennessee', 'TN'),
(51, 'Texas', 'TX'),
(52, 'Utah', 'UT'),
(53, 'Vermont', 'VT'),
(54, 'Virgin Islands', 'VI'),
(55, 'Virginia', 'VA'),
(56, 'Washington', 'WA'),
(57, 'West Virginia', 'WV'),
(58, 'Wisconsin', 'WI'),
(59, 'Wyoming', 'WY');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL,
  `Rating` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `school_id` int(11) NOT NULL,
  `grad_year` varchar(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `Rating`, `password`, `fname`, `lname`, `phone`, `bio`, `email`, `school_id`, `grad_year`) VALUES
(1, NULL, '74b4a420d74b7b8428973218b511e8c0', 'Big', 'McLargeHuge', 1112221111, 'This is the biography of Big McLargeHuge.  He is the height of 3 men, and has the strength of 5.  He is fast as a bullet, and more flexible than the world''s greatest gymnast.', 'bigNlarge@amazing.com', 1, '2000'),
(2, NULL, 'bce434f9560d9215c3c14f4b6e03d1c8', 'Jacob', 'Nash', 1234567899, NULL, 'jpnash@mail.bradley.edu', 1, '2017'),
(3, NULL, '4f3522843435962860bfd994851c9304', 'test', 'num1', 123456789, NULL, 'test4@example.com', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_major`
--

CREATE TABLE IF NOT EXISTS `user_major` (
  `user_id` int(11) NOT NULL,
  `major_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `have`
--
ALTER TABLE `have`
  ADD PRIMARY KEY (`have_id`), ADD KEY `RefUser28` (`user_id`), ADD KEY `RefBook30` (`book_id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `need`
--
ALTER TABLE `need`
  ADD PRIMARY KEY (`need_id`), ADD KEY `RefUser27` (`user_id`), ADD KEY `RefBook29` (`book_id`);

--
-- Indexes for table `paired`
--
ALTER TABLE `paired`
  ADD PRIMARY KEY (`need_id`,`have_id`), ADD KEY `RefHave26` (`have_id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`school_id`), ADD KEY `RefState6` (`state_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`), ADD KEY `RefSchool7` (`school_id`);

--
-- Indexes for table `user_major`
--
ALTER TABLE `user_major`
  ADD PRIMARY KEY (`user_id`,`major_id`), ADD KEY `RefMajor25` (`major_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `have`
--
ALTER TABLE `have`
  MODIFY `have_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `need`
--
ALTER TABLE `need`
  MODIFY `need_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `have`
--
ALTER TABLE `have`
ADD CONSTRAINT `RefBook30` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
ADD CONSTRAINT `RefUser28` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `need`
--
ALTER TABLE `need`
ADD CONSTRAINT `RefBook29` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
ADD CONSTRAINT `RefUser27` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `paired`
--
ALTER TABLE `paired`
ADD CONSTRAINT `RefHave26` FOREIGN KEY (`have_id`) REFERENCES `have` (`have_id`),
ADD CONSTRAINT `RefNeed22` FOREIGN KEY (`need_id`) REFERENCES `need` (`need_id`);

--
-- Constraints for table `school`
--
ALTER TABLE `school`
ADD CONSTRAINT `RefState6` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `RefSchool7` FOREIGN KEY (`school_id`) REFERENCES `school` (`school_id`);

--
-- Constraints for table `user_major`
--
ALTER TABLE `user_major`
ADD CONSTRAINT `RefMajor25` FOREIGN KEY (`major_id`) REFERENCES `major` (`major_id`),
ADD CONSTRAINT `RefUser24` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
