-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2019 at 03:31 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moneymanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`) VALUES
(37, 'Food'),
(38, 'Bills'),
(39, 'Transportation'),
(40, 'Entertainment'),
(41, 'Insurance'),
(42, 'Clothing'),
(43, 'Tax'),
(44, 'Shopping'),
(45, 'Telephone'),
(46, 'Sports'),
(47, 'Health'),
(48, 'Beauty'),
(49, 'Baby'),
(50, 'Pet'),
(51, 'Travel'),
(52, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(10) NOT NULL,
  `expense_categories` varchar(255) NOT NULL,
  `expense_user_fk_id` int(11) DEFAULT NULL,
  `expense_dateTime` date NOT NULL,
  `expense_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `expense_categories`, `expense_user_fk_id`, `expense_dateTime`, `expense_amount`) VALUES
(2, 'Bills', 59, '2019-07-29', 5000),
(3, 'Food', 59, '2019-07-28', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `expensebycat`
--

CREATE TABLE `expensebycat` (
  `expense_cat_fk_id` int(11) NOT NULL,
  `expense_user_cat_id` int(11) NOT NULL,
  `expense_cat_amount` int(11) NOT NULL,
  `expense_cat_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expensebycat`
--

INSERT INTO `expensebycat` (`expense_cat_fk_id`, `expense_user_cat_id`, `expense_cat_amount`, `expense_cat_date`) VALUES
(37, 59, 10000, '2019-07-28'),
(38, 59, 5000, '2019-07-29'),
(44, 59, 0, '2019-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `income_id` int(10) NOT NULL,
  `income_categories` varchar(255) NOT NULL,
  `income_user_fk_id` int(11) DEFAULT NULL,
  `income_dateTime` date NOT NULL,
  `income_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `income_categories`, `income_user_fk_id`, `income_dateTime`, `income_amount`) VALUES
(1, 'Salary', 59, '2019-07-30', 5000),
(4, 'Salary', 59, '2019-01-01', 10000),
(5, 'Awards', 59, '2019-07-28', 20000),
(6, 'Lottery', 59, '2019-07-28', 10000),
(7, 'Pocket Money', 59, '2019-07-30', 30000),
(8, 'Sale', 59, '2019-07-29', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `incomebycat`
--

CREATE TABLE `incomebycat` (
  `income_cat_fk_id` int(11) NOT NULL,
  `income_user_cat_id` int(11) NOT NULL,
  `income_cat_amount` int(11) NOT NULL,
  `income_cat_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incomebycat`
--

INSERT INTO `incomebycat` (`income_cat_fk_id`, `income_user_cat_id`, `income_cat_amount`, `income_cat_date`) VALUES
(11, 59, 5000, '2019-07-28'),
(12, 59, 20000, '2019-07-28'),
(14, 59, 10000, '2019-07-28'),
(11, 59, 10000, '2019-01-01'),
(17, 59, 10000, '2019-07-28'),
(19, 59, 30000, '2019-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `incomecat`
--

CREATE TABLE `incomecat` (
  `income_categories_id` int(11) NOT NULL,
  `income_categories_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incomecat`
--

INSERT INTO `incomecat` (`income_categories_id`, `income_categories_name`) VALUES
(11, 'Salary'),
(12, 'Awards'),
(13, 'Grants'),
(14, 'Sale'),
(15, 'Rental'),
(16, 'Investments'),
(17, 'Lottery'),
(18, 'Dividends'),
(19, 'Pocket Money'),
(20, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `mail_confirmation` tinyint(1) NOT NULL,
  `one_time_password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`user_id`, `user_name`, `user_email`, `user_password`, `token`, `created_date`, `mail_confirmation`, `one_time_password`) VALUES
(44, 'Kaung MinSat', 'zzero4439@gmail.com', '$2y$10$x3gxUxOxqY1O3z4p2S5Q2uqDz6DDdPDjLwjwhg7RmN9NrZPr9jCI6', '1^EbMg(GPx', '2019-07-16 19:22:29', 1, 0),
(46, 'Kaung Min Htet', 'kaungminh08@gmail.com', '$2y$10$YB7cSA8e7xLrhF.y.JkuYebUMgyF//de2q2SEBCTJYCNifWNJOk7S', 'keDzhgoMQ(', '2019-07-16 19:28:42', 1, 0),
(47, 'Zuzan Win', 'Zuzanwinkhin@gmail.com', '$2y$10$7S0ArpXjWBosb4R3aIZhpuVYLrwDv9pPIbRC.VGSc/IhjA9WY97sq', 'tfpu8SIvq@', '2019-07-16 19:31:00', 1, 0),
(55, 'Kaung Myat Htet\r\n', 'kaungmyatinfo27@gmail.com', '$2y$10$GIgsooeYBrL7WY.WSbeuD.e7Ds16mz58rmbUm1uTtc84100C3DPDe', 'Asy3zn&c5r', '2019-07-17 18:36:00', 1, 0),
(59, 'Ye Phone Kyaw', 'yephonekyaw05@gmail.com', '$2y$10$/tLqu1vyI.lVEr6gDPpm5.gYz5syy9EN9Ltz9/Hdjg9PNFmHQNEZC', 'y2OAj^z89r', '2019-07-19 19:08:58', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `expense_user_fk_id` (`expense_user_fk_id`);

--
-- Indexes for table `expensebycat`
--
ALTER TABLE `expensebycat`
  ADD KEY `expense_cat_fk_id` (`expense_cat_fk_id`),
  ADD KEY `expense_user_cat_id` (`expense_user_cat_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`income_id`),
  ADD KEY `income_user_fk_id` (`income_user_fk_id`);

--
-- Indexes for table `incomebycat`
--
ALTER TABLE `incomebycat`
  ADD KEY `income_user_cat_id` (`income_user_cat_id`),
  ADD KEY `income_cat_fk_id` (`income_cat_fk_id`);

--
-- Indexes for table `incomecat`
--
ALTER TABLE `incomecat`
  ADD PRIMARY KEY (`income_categories_id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `incomecat`
--
ALTER TABLE `incomecat`
  MODIFY `income_categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_user_fk_id` FOREIGN KEY (`expense_user_fk_id`) REFERENCES `userinfo` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expensebycat`
--
ALTER TABLE `expensebycat`
  ADD CONSTRAINT `expense_cat_fk_id` FOREIGN KEY (`expense_cat_fk_id`) REFERENCES `categories` (`categories_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expense_user_cat_id` FOREIGN KEY (`expense_user_cat_id`) REFERENCES `userinfo` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_user_fk_id` FOREIGN KEY (`income_user_fk_id`) REFERENCES `userinfo` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incomebycat`
--
ALTER TABLE `incomebycat`
  ADD CONSTRAINT `income_cat_fk_id` FOREIGN KEY (`income_cat_fk_id`) REFERENCES `incomecat` (`income_categories_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `income_user_cat_id` FOREIGN KEY (`income_user_cat_id`) REFERENCES `userinfo` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
