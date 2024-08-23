-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2024 at 05:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slime_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `fee`
--

CREATE TABLE `fee` (
  `roll` varchar(11) NOT NULL,
  `due_amt` int(255) NOT NULL DEFAULT 45000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee`
--

INSERT INTO `fee` (`roll`, `due_amt`) VALUES
('22EEB0B19', 0),
('22EEB0F04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `roll` varchar(11) NOT NULL,
  `file` varchar(50) NOT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`roll`, `file`, `type`) VALUES
('admin', 'makeitmeme_Dw7V3.jpeg', 'news'),
('admin', 'makeitmeme_yVVYe.jpeg', 'news'),
('22EEB0B19', '22EEB0B19.jpg', 'pfp'),
('22EEB0F04', 'default_pfp.webp', 'pfp');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `roll` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `gender` text NOT NULL,
  `dept` text NOT NULL,
  `caste` text NOT NULL,
  `contact` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `fname`, `lname`, `roll`, `email`, `dob`, `gender`, `dept`, `caste`, `contact`) VALUES
(58, 'Pratheek', 'Reddy', '22EEB0B19', 'pratheekreddy143@gmail.com', '04/02/2005', 'Male', 'EEE', 'OC', 7995899259),
(59, 'Vaishnavi', 'Gambheera Rao', '22EEB0F04', 'vaishnavi@nitw.ac.in', '09/15/2004', 'Female', 'EEE', 'OC', 7995899259);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `heading` text NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`heading`, `body`) VALUES
('Bob memes are restricted', 'Bob memes are restricted in the campus and whoever tries are punished.'),
('bhAAi should not be hated', 'It is found that bhAAi is hated by all in the college due to his YSRCP affiliations. But bhAAi is gud. Just a little chapri.'),
('Mandatory Mess Fee', 'Everyone are supposed to pay 12000Rs as 3 months advance for mess'),
('Hostel Allocation Open', '3rd years can now book their hostel rooms in 1k hostel'),
('Fee Payment open', 'Fee payment option is open in the student portal. Pay the fee');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `roll` varchar(255) NOT NULL,
  `M1` varchar(5) NOT NULL DEFAULT '-',
  `ED` varchar(5) NOT NULL DEFAULT '-',
  `AP` varchar(5) NOT NULL DEFAULT '-',
  `BEE` varchar(5) NOT NULL DEFAULT '-',
  `PSCP` varchar(5) NOT NULL DEFAULT '-',
  `cgpa` varchar(255) DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`roll`, `M1`, `ED`, `AP`, `BEE`, `PSCP`, `cgpa`) VALUES
('22EEB0B19', 'A', 'C', 'A', 'A', 'S', NULL),
('22EEB0F04', '-', '-', '-', '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `roll` varchar(11) NOT NULL,
  `full_name` text NOT NULL,
  `amount` int(255) NOT NULL,
  `timestamp` text NOT NULL,
  `payment_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`roll`, `full_name`, `amount`, `timestamp`, `payment_id`) VALUES
('22EEB0F04', 'Vaishnavi Gambheera Rao', 45000, '2024-07-02 23:57:20.4', 'pay_OTrWUacIunweuC'),
('22EEB0F04', 'Vaishnavi Gambheera Rao', 45000, '2024-07-03 11:51:54.8', 'pay_OU3hHncRnxivQA'),
('22EEB0B19', 'Yedla Sai Pratheek Reddy', 45000, '2024-07-03 17:37:28.9', 'pay_OU9aKi1zGE4OBE'),
('22EEB0F04', 'Vaishnavi Gambheera Rao', 45000, '2024-07-03 17:39:18.3', 'pay_OU9cFFVd5sfeD6'),
('22EEB0B05', 'Chilukani Vamshi Kiran Reddy', 45000, '2024-07-03 17:47:56.8', 'pay_OU9lPST1Aui2yL'),
('22EEB0B19', 'Pratheek Reddy', 45000, '2024-07-09 11:11:40', 'pay_OWTnrUs11ye9gd'),
('22EEB0F04', 'Vaishnavi Gambheera Rao', 45000, '2024-07-10 18:26:46', 'pay_OWzkQHKLrJLOop'),
('22EEB0B19', 'Pratheek Reddy', 45000, '2024-07-11 22:12:59', 'pay_OXS8bol6O2MSWz'),
('22EEB0B19', 'Pratheek Reddy', 45000, '2024-07-23 08:01:52', 'pay_Oby2wOVNdXwKpB'),
('22EEB0F04', 'Vaishnavi Gambheera Rao', 45000, '2024-07-28 20:33:30', 'pay_Oe9WQfz9tciLOu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `roll` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roll`, `pass`, `usertype`) VALUES
(37, 'admin', '$2y$12$9e9zIOydi3MMHvZp7tsRauXWta802kO8s4fjBbPr0txl2TTjZwNbe', 'admin'),
(61, '22EEB0B19', '$2y$10$bBeTSFTLQUIuvu4EKNwjKuJbd.VEr.Z5y0GhFAyIwTRpDRtnm87jS', 'student'),
(62, '22EEB0F04', '$2y$10$crDFEBbMwSHZWHmXnQyAAOfLK06U5df80d6oi2BoEuZdQRo/zwuJa', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info`
--
ALTER TABLE `info`
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
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
