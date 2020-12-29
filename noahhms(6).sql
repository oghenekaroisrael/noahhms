-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2020 at 09:08 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noahhms`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `order_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pharm_stack` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `front_desk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `app_id` int(11) NOT NULL,
  `adm` int(11) NOT NULL,
  `item` longtext COLLATE utf8_unicode_ci NOT NULL,
  `item_number` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `card_type` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `cash` int(11) NOT NULL,
  `bank` int(11) NOT NULL,
  `bank_used` longtext COLLATE utf8_unicode_ci NOT NULL,
  `to_pay` decimal(10,2) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 =not paid, 1= paid',
  `payment_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `HMO` int(50) NOT NULL,
  `dispenser` int(11) NOT NULL,
  `date_paid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `order_id`, `pharm_stack`, `patient_id`, `front_desk`, `app_id`, `adm`, `item`, `item_number`, `quantity`, `card_type`, `amount`, `cash`, `bank`, `bank_used`, `to_pay`, `payment_status`, `payment_type`, `company_id`, `HMO`, `dispenser`, `date_paid`, `date_added`, `date_stamp`) VALUES
(1, '6469', 0, 1, '5f6c675b7c598', 1, 0, '8', 0, 0, 0, '0.00', 0, 0, '', '1000.00', 0, '', 0, 0, 0, '2020-09-25 07:27:03', '2020-09-25', '2020-09-25 07:27:03'),
(2, '86697', 0, 4, '5f6d9c419c831', 0, 0, '5', 0, 0, 14, '0.00', 0, 0, '', '2500.00', 0, '', 0, 0, 0, '2020-09-25 07:29:05', '2020-09-25', '2020-09-25 07:29:05'),
(3, '87626', 0, 4, '5f6d9c419c831', 2, 0, '8', 0, 0, 14, '0.00', 0, 0, '', '5000.00', 0, '', 0, 0, 0, '2020-09-25 07:31:02', '2020-09-25', '2020-09-25 07:31:02'),
(4, '35377', 0, 4, '5f6d9c419c831', 3, 0, '8', 0, 0, 14, '0.00', 0, 0, '', '2000.00', 0, '', 0, 0, 0, '2020-09-25 18:31:41', '2020-09-25', '2020-09-25 18:31:41'),
(5, '10730', 0, 3, '5f6c6789324bc', 4, 0, '8', 0, 0, 0, '0.00', 0, 0, '', '5000.00', 0, '', 0, 0, 0, '2020-09-26 20:23:19', '2020-09-26', '2020-09-26 20:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `acc_balance`
--

CREATE TABLE `acc_balance` (
  `acc_balance_id` int(11) NOT NULL,
  `particulars` longtext NOT NULL,
  `cash` longtext NOT NULL,
  `bank` longtext NOT NULL,
  `day_date` longtext NOT NULL,
  `b_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `acc_daily`
--

CREATE TABLE `acc_daily` (
  `acc_daily_id` int(11) NOT NULL,
  `date_tim` longtext NOT NULL,
  `description` longtext NOT NULL,
  `approver` longtext NOT NULL,
  `recipient` longtext NOT NULL,
  `quantity` int(11) NOT NULL,
  `cash` longtext NOT NULL,
  `bank` longtext NOT NULL,
  `d_date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `acc_month`
--

CREATE TABLE `acc_month` (
  `acc_month_id` int(11) NOT NULL,
  `card_num` longtext NOT NULL,
  `patient_id` int(11) NOT NULL,
  `sex` longtext NOT NULL,
  `visit_date` longtext NOT NULL,
  `date_admission` longtext NOT NULL,
  `no_days` int(11) NOT NULL,
  `dod` longtext NOT NULL,
  `diagnosis` longtext NOT NULL,
  `service` longtext NOT NULL,
  `description` longtext NOT NULL,
  `amount` longtext NOT NULL,
  `mtotal` longtext NOT NULL,
  `m_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `logged_in` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_stock`
--

CREATE TABLE `admin_stock` (
  `admin_stock_id` int(11) NOT NULL,
  `pharm_stock_id` int(11) NOT NULL,
  `quantity` longtext NOT NULL,
  `taken_by` longtext NOT NULL,
  `patient_id` int(11) NOT NULL,
  `time_taken` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admission_request`
--

CREATE TABLE `admission_request` (
  `admission_request_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `front_desk` varchar(255) NOT NULL,
  `ward_id` int(255) NOT NULL COMMENT 'male ward =1 , female ward = 2, vip ward =3',
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 is pending 1 is done, 2 is cancelled',
  `request_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admission_status`
--

CREATE TABLE `admission_status` (
  `admission_status_id` int(11) NOT NULL,
  `admission_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admission_status`
--

INSERT INTO `admission_status` (`admission_status_id`, `admission_status`) VALUES
(3, 'Deceased'),
(2, 'Discharged'),
(1, 'Reffered'),
(5, 'Requested discharge'),
(4, 'SAMA');

-- --------------------------------------------------------

--
-- Table structure for table `antenatal`
--

CREATE TABLE `antenatal` (
  `id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pos` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `house_num` longtext COLLATE utf8_unicode_ci NOT NULL,
  `town` longtext COLLATE utf8_unicode_ci NOT NULL,
  `village` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ward` longtext COLLATE utf8_unicode_ci NOT NULL,
  `state` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lga` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mother_phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `father_phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cg` longtext COLLATE utf8_unicode_ci NOT NULL,
  `cg_phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `twin` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fed` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `support` longtext COLLATE utf8_unicode_ci NOT NULL,
  `underweight` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `extra_care` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum1` int(11) NOT NULL,
  `v1` int(11) NOT NULL,
  `dg1` int(11) NOT NULL,
  `dn1` int(11) NOT NULL,
  `cm1` int(11) NOT NULL,
  `bnum2` int(11) NOT NULL,
  `v2` int(11) NOT NULL,
  `dg2` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn2` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm2` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum3` int(11) NOT NULL,
  `v3` int(11) NOT NULL,
  `dg3` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn3` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm3` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum4` int(11) NOT NULL,
  `v4` int(11) NOT NULL,
  `dg4` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn4` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm4` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum5` int(11) NOT NULL,
  `v5` int(11) NOT NULL,
  `dg5` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn5` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm5` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum6` int(11) NOT NULL,
  `v6` int(11) NOT NULL,
  `dg6` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn6` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm6` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum7` int(11) NOT NULL,
  `v7` int(11) NOT NULL,
  `dg7` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn7` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm7` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum8` int(11) NOT NULL,
  `v8` int(11) NOT NULL,
  `dg8` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn8` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm8` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum9` int(11) NOT NULL,
  `v9` int(11) NOT NULL,
  `dg9` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn9` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm9` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum10` int(11) NOT NULL,
  `v10` int(11) NOT NULL,
  `dg10` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn10` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm10` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum11` int(11) NOT NULL,
  `v11` int(11) NOT NULL,
  `dg11` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn11` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm11` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum12` int(11) NOT NULL,
  `v12` int(11) NOT NULL,
  `dg12` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn12` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm12` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum13` int(11) NOT NULL,
  `v13` int(11) NOT NULL,
  `dg13` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn13` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm13` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum14` int(11) NOT NULL,
  `v14` int(11) NOT NULL,
  `dg14` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn14` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm14` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum15` int(11) NOT NULL,
  `v15` int(11) NOT NULL,
  `dg15` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn15` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm15` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum16` int(11) NOT NULL,
  `v16` int(11) NOT NULL,
  `dg16` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn16` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm16` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum17` int(11) NOT NULL,
  `v17` int(11) NOT NULL,
  `dg17` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn17` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm17` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum18` int(11) NOT NULL,
  `v18` int(11) NOT NULL,
  `dg18` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn18` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm18` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum19` int(11) NOT NULL,
  `v19` int(11) NOT NULL,
  `dg19` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn19` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm19` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum20` int(11) NOT NULL,
  `v20` int(11) NOT NULL,
  `dg20` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn20` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm20` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bnum21` int(11) NOT NULL,
  `v21` int(11) NOT NULL,
  `dg21` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dn21` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cm21` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `antenatal1`
--

CREATE TABLE `antenatal1` (
  `id` int(11) NOT NULL,
  `surname` longtext,
  `first_name` longtext,
  `hospital_number` longtext,
  `instructions` longtext,
  `address` longtext,
  `preg_duration` longtext,
  `age` int(11) NOT NULL,
  `marriage_age` int(11) NOT NULL,
  `lmp` longtext,
  `tribe` longtext,
  `occupation` longtext,
  `edd` longtext,
  `hypertension` longtext,
  `chest` longtext,
  `anaemia` longtext,
  `heart` longtext,
  `kidney` longtext,
  `blood` longtext,
  `git` longtext,
  `diabetes` longtext,
  `operation` longtext,
  `admission` longtext,
  `G` longtext,
  `P1` longtext,
  `F` longtext,
  `P2` longtext,
  `A` longtext,
  `L` longtext,
  `nurse` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `antenatal_note`
--

CREATE TABLE `antenatal_note` (
  `id` int(11) NOT NULL,
  `antenatal_id` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `preg_duration` longtext,
  `weight` longtext,
  `complication_p` longtext,
  `complication_l` longtext,
  `puerperium` longtext,
  `death_age` int(11) DEFAULT NULL,
  `cause_of_death` longtext,
  `added_by` int(11) DEFAULT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `antenatal_record`
--

CREATE TABLE `antenatal_record` (
  `id` int(11) NOT NULL,
  `antenatal_id` int(11) DEFAULT NULL,
  `ega` longtext,
  `sfh` longtext,
  `pres` longtext,
  `pos` longtext,
  `fh` longtext,
  `o` longtext,
  `u` longtext,
  `p` longtext,
  `w` longtext,
  `bp` longtext,
  `added_by` int(11) DEFAULT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ante_other_children`
--

CREATE TABLE `ante_other_children` (
  `id` int(11) NOT NULL,
  `c_year` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `c_health` longtext COLLATE utf8_unicode_ci NOT NULL,
  `c_sex` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ante_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `bed_id` int(11) NOT NULL,
  `bed` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`bed_id`, `bed`) VALUES
(2, 'bottom'),
(1, 'top');

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `id` int(11) NOT NULL,
  `bed_type` int(11) NOT NULL,
  `bed` text NOT NULL,
  `charge` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`id`, `bed_type`, `bed`, `charge`, `status`, `description`, `added_by`, `date_added`) VALUES
(1, 1, 'Bed 1', 2500, 1, 'Not a bad room', 2, '2020-08-24 02:34:28'),
(2, 2, 'Bed 2', 2000, 1, '', 2, '2020-08-24 03:13:33'),
(3, 2, 'Bed 1', 2000, 1, '', 2, '2020-08-24 03:13:41'),
(4, 2, 'Bed 3', 2000, 1, '', 2, '2020-08-24 03:13:45'),
(5, 2, 'Bed 4', 2000, 0, '', 2, '2020-08-24 03:13:50'),
(6, 2, 'Bed 5', 2000, 1, '', 2, '2020-08-24 03:13:54'),
(7, 2, 'Bed 6', 2000, 0, '', 2, '2020-08-24 03:13:59'),
(8, 2, 'Bed 7', 2000, 0, '', 2, '2020-08-24 03:14:06'),
(9, 1, 'Bed 2', 2000, 0, '', 2, '2020-08-24 03:14:14'),
(10, 1, 'Bed 3', 2000, 0, '', 2, '2020-08-24 03:14:19'),
(11, 1, 'Bed 4', 2000, 0, '', 2, '2020-08-24 03:14:25'),
(12, 1, 'Bed 5', 2000, 1, '', 2, '2020-08-24 03:14:31'),
(13, 1, 'Bed 6', 2000, 2, '', 2, '2020-08-24 03:14:40'),
(14, 1, 'Bed 7', 2000, 0, '', 2, '2020-08-24 03:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `bed_types`
--

CREATE TABLE `bed_types` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bed_types`
--

INSERT INTO `bed_types` (`id`, `name`, `added_by`, `date_added`) VALUES
(1, 'ICU', 2, '2020-08-24 02:31:38'),
(2, 'VIP Ward', 2, '2020-08-24 02:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `blood_groups`
--

CREATE TABLE `blood_groups` (
  `blood_group_id` int(11) NOT NULL,
  `blood_group` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_groups`
--

INSERT INTO `blood_groups` (`blood_group_id`, `blood_group`, `status`, `added_by`, `date_added`, `updated_by`, `date_updated`) VALUES
(1, 'O-', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'K not', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'K not1', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `id` int(11) NOT NULL,
  `requester` int(11) NOT NULL,
  `patient_name` text NOT NULL,
  `patient_gender` text NOT NULL,
  `patient_dob` date NOT NULL,
  `patient_address` text NOT NULL,
  `patient_adm_no` text NOT NULL,
  `patient_phone` text NOT NULL,
  `diagnosis` text NOT NULL,
  `reason` text NOT NULL,
  `time_needed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `location_needed` text NOT NULL,
  `facility` text NOT NULL,
  `phone` text NOT NULL,
  `facility_clinician` text NOT NULL,
  `urgency` text NOT NULL,
  `sample_type` text NOT NULL,
  `rbc` text NOT NULL,
  `date_lknas` text NOT NULL,
  `pregnancy` text NOT NULL,
  `volume` int(11) NOT NULL,
  `requests` longtext NOT NULL,
  `cmeds` text NOT NULL,
  `info` text NOT NULL,
  `transfusion` text NOT NULL,
  `status` int(11) NOT NULL,
  `label_given` text NOT NULL,
  `date_given` datetime DEFAULT NULL,
  `given_by` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blood_stock`
--

CREATE TABLE `blood_stock` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `sample_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blood_test`
--

CREATE TABLE `blood_test` (
  `id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `link_ref` text NOT NULL,
  `lab_test_id` int(11) NOT NULL,
  `lab_test_type_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_test`
--

INSERT INTO `blood_test` (`id`, `donor_id`, `link_ref`, `lab_test_id`, `lab_test_type_id`, `status`, `added_by`, `date_added`) VALUES
(1, 1, '5f3f5d03a742e', 3, 1, 0, 2, '2020-08-21 06:34:59'),
(2, 1, '5f3f5d03a742e', 23, 1, 0, 2, '2020-08-21 06:34:59'),
(3, 1, '5f3f5d03a742e', 45, 3, 0, 2, '2020-08-21 06:34:59'),
(4, 1, '5f3f5d03a742e', 48, 3, 0, 2, '2020-08-21 06:34:59'),
(5, 1, '5f3f5d03a742e', 49, 3, 0, 2, '2020-08-21 06:34:59'),
(6, 1, '5f3f5d03a742e', 50, 3, 0, 2, '2020-08-21 06:35:00'),
(7, 1, '5f3f5d03a742e', 64, 2, 0, 2, '2020-08-21 06:35:00'),
(8, 1, '5f3f658fd838f', 3, 1, 0, 2, '2020-08-21 07:11:28'),
(9, 1, '5f3f658fd838f', 23, 1, 0, 2, '2020-08-21 07:11:28'),
(10, 1, '5f3f658fd838f', 45, 3, 0, 2, '2020-08-21 07:11:28'),
(11, 1, '5f3f658fd838f', 48, 3, 0, 2, '2020-08-21 07:11:28'),
(12, 1, '5f3f658fd838f', 49, 3, 0, 2, '2020-08-21 07:11:28'),
(13, 1, '5f3f658fd838f', 50, 3, 0, 2, '2020-08-21 07:11:28'),
(14, 1, '5f3f658fd838f', 64, 2, 0, 2, '2020-08-21 07:11:28'),
(15, 1, '5f410c4d30b3a', 3, 1, 0, 2, '2020-08-22 13:15:09'),
(16, 1, '5f410c4d30b3a', 23, 1, 0, 2, '2020-08-22 13:15:09'),
(17, 1, '5f410c4d30b3a', 45, 3, 0, 2, '2020-08-22 13:15:09'),
(18, 1, '5f410c4d30b3a', 48, 3, 0, 2, '2020-08-22 13:15:09'),
(19, 1, '5f410c4d30b3a', 49, 3, 0, 2, '2020-08-22 13:15:09'),
(20, 1, '5f410c4d30b3a', 50, 3, 0, 2, '2020-08-22 13:15:09'),
(21, 1, '5f410c4d30b3a', 64, 2, 0, 2, '2020-08-22 13:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `blood_test_group`
--

CREATE TABLE `blood_test_group` (
  `blood_test_group_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `link_ref` longtext NOT NULL,
  `test_num` int(11) NOT NULL,
  `a_and_e` varchar(255) NOT NULL,
  `total_fee` longtext NOT NULL,
  `awaiting_result` int(11) NOT NULL COMMENT '0 is yes 1 is no',
  `seen_result` int(11) NOT NULL COMMENT '0 is not seen by doctor, 1 is seen',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blood_test_result`
--

CREATE TABLE `blood_test_result` (
  `id` int(11) NOT NULL,
  `donor_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `test_id` int(11) NOT NULL,
  `ref_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `test_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lab_temp_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `caf_accounts`
--

CREATE TABLE `caf_accounts` (
  `id` int(11) NOT NULL,
  `order_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pharm_stack` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `front_desk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `app_id` int(11) NOT NULL,
  `adm` int(11) NOT NULL,
  `item` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bchange` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `card_type` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `cash` int(11) NOT NULL,
  `transfer` int(11) NOT NULL,
  `pos` int(11) NOT NULL,
  `bank_used` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to_pay` decimal(10,2) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 =not paid, 1= paid',
  `payment_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `HMO` int(50) NOT NULL,
  `dispenser` int(11) NOT NULL,
  `date_paid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `caf_sales_detail`
--

CREATE TABLE `caf_sales_detail` (
  `Sales_ID` int(11) NOT NULL,
  `Sales_Number` varchar(255) NOT NULL,
  `account_status` varchar(255) DEFAULT NULL,
  `Stock_Item` varchar(15) NOT NULL,
  `Sales_Quantity` double NOT NULL DEFAULT '0',
  `Purchasing_Price` double NOT NULL DEFAULT '0',
  `S_given` text NOT NULL,
  `sales_date` text NOT NULL,
  `returned` int(11) NOT NULL,
  `rstatus` int(2) NOT NULL,
  `rdate` datetime NOT NULL,
  `addedby` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `caf_stock`
--

CREATE TABLE `caf_stock` (
  `id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `units` int(11) NOT NULL,
  `Stock_number` text COLLATE utf8_unicode_ci NOT NULL,
  `manufactured` datetime NOT NULL,
  `expiring` datetime NOT NULL,
  `batch` text COLLATE utf8_unicode_ci NOT NULL,
  `cost_price` int(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `caf_units`
--

CREATE TABLE `caf_units` (
  `id` int(11) NOT NULL,
  `unit_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `caf_units`
--

INSERT INTO `caf_units` (`id`, `unit_name`, `date_added`) VALUES
(1, 'Plate', '2020-09-01 06:14:34'),
(2, 'Small Paper Bag', '2020-09-01 10:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `capitations`
--

CREATE TABLE `capitations` (
  `id` int(50) NOT NULL,
  `amount` int(50) NOT NULL,
  `enrollees` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `hmo_id` int(50) NOT NULL,
  `added_by` int(50) NOT NULL,
  `date_added` date NOT NULL,
  `date_stamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_types`
--

CREATE TABLE `card_types` (
  `id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `card_types`
--

INSERT INTO `card_types` (`id`, `name`, `cost`, `date_added`) VALUES
(11, 'COMPANY', '0.00', '2019-04-22 15:24:05'),
(14, 'PERSONAL', '2500.00', '2019-09-16 12:41:03'),
(19, 'HMO', '0.00', '2019-06-06 15:24:33'),
(20, 'FAMILY', '6000.00', '2019-09-16 14:23:13'),
(30, 'ANTENATAL', '8500.00', '2019-09-16 14:24:46'),
(31, 'EMERGENCY (NEW CARD)', '3000.00', '2020-03-12 11:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `id` int(50) NOT NULL,
  `name` text NOT NULL,
  `amount` int(50) NOT NULL,
  `date_added` date NOT NULL,
  `user_id` int(50) NOT NULL,
  `date_edited` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company_name` longtext NOT NULL,
  `company_addr` longtext NOT NULL,
  `company_pn` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `staff_no` int(255) NOT NULL,
  `branch` int(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_bill`
--

CREATE TABLE `company_bill` (
  `order_id` varchar(255) NOT NULL,
  `items` longtext NOT NULL,
  `amount` int(255) NOT NULL,
  `status` int(2) NOT NULL,
  `id` int(255) NOT NULL,
  `company_id` int(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consulting_rooms`
--

CREATE TABLE `consulting_rooms` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consulting_rooms`
--

INSERT INTO `consulting_rooms` (`id`, `doctor_id`, `room`, `date_added`) VALUES
(1, 2, 2, '2020-07-30 08:37:42'),
(2, 2, 1, '2020-07-30 08:40:10'),
(3, 2, 2, '2020-07-30 08:42:00'),
(4, 2, 1, '2020-07-30 08:43:20'),
(5, 2, 2, '2020-07-30 08:46:18'),
(6, 2, 1, '2020-07-30 09:30:47'),
(7, 2, 1, '2020-08-21 19:37:42'),
(8, 2, 3, '2020-08-21 19:37:46'),
(9, 2, 1, '2020-08-21 19:58:17'),
(10, 86, 1, '2020-09-20 16:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `contact_method`
--

CREATE TABLE `contact_method` (
  `contact_method_id` int(11) NOT NULL,
  `contact_method` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_method`
--

INSERT INTO `contact_method` (`contact_method_id`, `contact_method`) VALUES
(1, 'Call'),
(2, 'Email'),
(3, 'Text');

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE `costs` (
  `id` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `amt` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `code` text NOT NULL,
  `recipient` text NOT NULL,
  `method` text NOT NULL,
  `approver` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `pdate` date NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costs`
--

INSERT INTO `costs` (`id`, `description`, `amt`, `quantity`, `type`, `code`, `recipient`, `method`, `approver`, `comment`, `pdate`, `date_added`, `added_by`, `updated`) VALUES
(1, 'cost of drugs', '100000', 1, 1, '0001', 'igbudu market', 'Cash', 2, '', '2020-02-28', '2020-02-28 15:49:41', 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cost_types`
--

CREATE TABLE `cost_types` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cost_types`
--

INSERT INTO `cost_types` (`id`, `name`, `added_by`, `date_added`) VALUES
(1, 'DRUGS/CONSUMABLE', 2, '2019-08-16 00:00:00'),
(2, 'LABORATORY CONSUMABLE', 2, '2019-08-16 00:00:00'),
(3, 'RADIOLOGY CONSUMABLE', 2, '2019-08-16 00:00:00'),
(4, 'IMMUNIZATION', 2, '2019-08-16 00:00:00'),
(5, 'GCMC MINI MARKET', 2, '2019-08-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `credit_balance`
--

CREATE TABLE `credit_balance` (
  `id` int(11) NOT NULL,
  `c_date` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `particulars` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `cash_bank` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bal_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '1=credit,2=debit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_result`
--

CREATE TABLE `custom_result` (
  `id` int(11) NOT NULL,
  `result` longtext NOT NULL,
  `ref` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `daily_expense`
--

CREATE TABLE `daily_expense` (
  `id` int(11) NOT NULL,
  `exp_date` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `code` text COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `approver` longtext COLLATE utf8_unicode_ci NOT NULL,
  `recipient` longtext COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `amt` decimal(10,2) NOT NULL,
  `cash_bank` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bank_used` longtext COLLATE utf8_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dispensing_chart`
--

CREATE TABLE `dispensing_chart` (
  `dispensing_chart_id` int(11) NOT NULL,
  `ipd_patient_id` int(11) NOT NULL,
  `pharm_stock_id` int(11) NOT NULL,
  `dosage` longtext NOT NULL,
  `meth_administration` longtext NOT NULL,
  `given_by` int(11) NOT NULL,
  `remark` longtext NOT NULL,
  `ddate_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule`
--

CREATE TABLE `doctor_schedule` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `day_of_week` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `time_in` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `time_out` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `day_date` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_types`
--

CREATE TABLE `doctor_types` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_types`
--

INSERT INTO `doctor_types` (`id`, `name`, `type_id`) VALUES
(1, 'General Doctor', 0),
(2, 'Pediatrics', 1),
(3, 'Dentistry', 2);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `pints` int(11) NOT NULL,
  `abo_result` text NOT NULL,
  `abo_observation` longtext NOT NULL,
  `abo_added_by` int(11) NOT NULL,
  `abo_date_added` datetime NOT NULL,
  `rhd_result` text NOT NULL,
  `rhd_observation` longtext NOT NULL,
  `rhd_added_by` int(11) NOT NULL,
  `rhd_date_added` datetime DEFAULT NULL,
  `serum_result` text NOT NULL,
  `serum_observation` text NOT NULL,
  `serum_added_by` int(11) NOT NULL,
  `serum_date_added` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Untested',
  `lab_ref` text NOT NULL,
  `scientist_id` int(11) NOT NULL,
  `label` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `donor_id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `fathers_name` longtext NOT NULL,
  `gender` longtext NOT NULL,
  `dob` date NOT NULL,
  `body_weight` int(11) NOT NULL,
  `email` longtext NOT NULL,
  `blood_group` longtext NOT NULL,
  `phone` longtext NOT NULL,
  `state` longtext NOT NULL,
  `city` longtext NOT NULL,
  `address` longtext NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `duty_check`
--

CREATE TABLE `duty_check` (
  `id` int(11) NOT NULL,
  `morn` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `bed` int(11) NOT NULL,
  `v_bed` int(11) NOT NULL,
  `t_pt` int(11) NOT NULL,
  `adm` int(11) NOT NULL,
  `disc` int(11) NOT NULL,
  `delivery` int(11) NOT NULL,
  `cs` int(11) NOT NULL,
  `labour` int(11) NOT NULL,
  `trans` int(11) NOT NULL,
  `death` int(11) NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_request`
--

CREATE TABLE `exam_request` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `front_desk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses_types`
--

CREATE TABLE `expenses_types` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses_types`
--

INSERT INTO `expenses_types` (`id`, `name`, `added_by`, `date_added`) VALUES
(1, 'Wage', 2, '2019-08-17 05:06:23'),
(2, 'Automatic Expenditure', 2, '2019-12-09 13:38:44'),
(3, 'SALIU', 84, '2020-02-17 12:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `extra_effects`
--

CREATE TABLE `extra_effects` (
  `id` int(11) NOT NULL,
  `d_year` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `complaint` longtext COLLATE utf8_unicode_ci NOT NULL,
  `types` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `manag` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ante_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `extra_effects`
--

INSERT INTO `extra_effects` (`id`, `d_year`, `complaint`, `types`, `manag`, `ante_id`, `date_added`) VALUES
(0, '', '', '', '', 1, '2020-09-16 19:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `extra_file`
--

CREATE TABLE `extra_file` (
  `extra_file_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `patient_appointment_id` int(11) NOT NULL,
  `extra_file` longtext NOT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extra_file`
--

INSERT INTO `extra_file` (`extra_file_id`, `name`, `patient_id`, `patient_appointment_id`, `extra_file`, `date_uploaded`) VALUES
(1, 'stuff', 1, 1, '1596488066.jpg', '2020-08-03 20:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE `families` (
  `id` int(11) NOT NULL,
  `family_name` longtext NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hmo_lab_test`
--

CREATE TABLE `hmo_lab_test` (
  `lab_test_id` int(11) NOT NULL,
  `lab_test` varchar(200) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tariff_one` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hospital_info`
--

CREATE TABLE `hospital_info` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `address` longtext NOT NULL,
  `phone` longtext NOT NULL,
  `email` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital_info`
--

INSERT INTO `hospital_info` (`id`, `name`, `address`, `phone`, `email`) VALUES
(1, 'GROUP CHRISTAIN MEDICAL CENTRE', 'Inside Mosheshe Estate, Effurun, Delta State.', 'Tel: 08038225528, 08123980842, 08089732520', 'Email: groupchristianmedical@gmail.com'),
(2, 'GROUP CHRISTAIN MEDICAL CENTRE CAFETERIA', 'Inside Mosheshe Estate, Effurun, Delta State.', 'Tel: 08038225528, 08123980842, 08089732520', 'Email: groupchristianmedical@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `in-patients`
--

CREATE TABLE `in-patients` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `item` text COLLATE utf8_unicode_ci NOT NULL,
  `t` int(11) NOT NULL,
  `nature` int(11) NOT NULL,
  `to_pay` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 =not paid, 1= paid',
  `prepared_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_paid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `amount` text NOT NULL,
  `date_added` date NOT NULL,
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `income_types`
--

CREATE TABLE `income_types` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `added_by` int(22) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income_types`
--

INSERT INTO `income_types` (`id`, `name`, `added_by`, `date`) VALUES
(1, 'Rent', 2, '2019-08-16 00:00:00'),
(2, 'Interest', 2, '2019-08-16 00:00:00'),
(3, 'MEDICAL REPORT/RETAINERSHIP FEE', 2, '2019-08-16 00:00:00'),
(4, 'AMBULANCE FEE', 2, '2019-08-16 00:00:00'),
(5, 'HMB CONTRIBUTION-DIVIDEND', 2, '2019-08-16 00:00:00'),
(6, '40% FROM EYE CLINIC', 2, '2019-08-16 00:00:00'),
(7, 'GCMC MINI MARKET', 2, '2019-08-16 00:00:00'),
(8, 'LABORATORY', 84, '2020-02-03 13:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_type`
--

CREATE TABLE `insurance_type` (
  `insurance_type_id` int(11) NOT NULL,
  `insurance_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `invoice_id` text NOT NULL,
  `prep_mode` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `drug` text NOT NULL,
  `supplier` int(11) NOT NULL,
  `lot` text NOT NULL,
  `batch` text NOT NULL,
  `destination` int(11) NOT NULL,
  `expiring` date NOT NULL,
  `unit` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `in_patient_payment`
--

CREATE TABLE `in_patient_payment` (
  `in_patient_payment_id` int(11) NOT NULL,
  `in_patient_payment` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `in_sales`
--

CREATE TABLE `in_sales` (
  `id` int(11) NOT NULL,
  `sales_id` text NOT NULL,
  `reference` longtext NOT NULL,
  `full_name` longtext NOT NULL,
  `type` int(50) NOT NULL,
  `description` longtext NOT NULL,
  `quantity` int(50) NOT NULL,
  `unit` int(11) NOT NULL,
  `amount` int(50) NOT NULL,
  `dispenser` int(11) NOT NULL,
  `rstatus` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `returned` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `time_stamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ipd_food`
--

CREATE TABLE `ipd_food` (
  `ipd_food_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `company` longtext NOT NULL,
  `breakfast` longtext NOT NULL,
  `lunch` longtext NOT NULL,
  `dinner` longtext NOT NULL,
  `amount` longtext NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ipd_patients`
--

CREATE TABLE `ipd_patients` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `front_desk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `nurse` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `admin_no` int(11) NOT NULL,
  `admin_date` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ref` longtext COLLATE utf8_unicode_ci NOT NULL,
  `room` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ward` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bed_no` int(11) NOT NULL,
  `admission_status_id` int(11) NOT NULL,
  `admission_status_date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `discharged` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `deceased_status` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labour`
--

CREATE TABLE `labour` (
  `id` int(11) NOT NULL,
  `surname` longtext,
  `first_name` longtext,
  `parity` longtext,
  `hospital_number` longtext,
  `age` longtext,
  `living_children` longtext,
  `past_obstetic_history` longtext,
  `lmp` longtext,
  `edd` longtext,
  `antenatal_history` longtext,
  `onset` longtext,
  `hours` longtext,
  `state` longtext,
  `membrane_ruptured` longtext,
  `amnitomy` longtext,
  `contractions` longtext,
  `oxytocics` longtext,
  `condition` longtext,
  `fundal_height` longtext,
  `type` longtext,
  `lie` longtext,
  `presentation` longtext,
  `position` longtext,
  `descent` longtext,
  `foetal_heart_rate` longtext,
  `vulva` longtext,
  `vagina` longtext,
  `cervix` longtext,
  `pp_state` longtext,
  `os` longtext,
  `ruptured` longtext,
  `intact` longtext,
  `ppo` longtext,
  `in_position` longtext,
  `caput` longtext,
  `mould` longtext,
  `pelvis_ap` longtext,
  `pelvis_sacral_curve` longtext,
  `forecast` longtext,
  `ischial_spine` longtext,
  `added_by` int(11) DEFAULT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab_notifications`
--

CREATE TABLE `lab_notifications` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `request` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=untreated, 1=treated',
  `payment` int(11) NOT NULL DEFAULT '0' COMMENT '0=unpaid,1=paid',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab_result`
--

CREATE TABLE `lab_result` (
  `id` int(11) NOT NULL,
  `lab_tech_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `lab_test` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lab_test_type_id` int(11) NOT NULL,
  `test_result` longtext COLLATE utf8_unicode_ci NOT NULL,
  `test_flag` longtext COLLATE utf8_unicode_ci NOT NULL,
  `test_units` longtext COLLATE utf8_unicode_ci NOT NULL,
  `test_ref` longtext COLLATE utf8_unicode_ci NOT NULL,
  `front_desk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `test_range` longtext COLLATE utf8_unicode_ci NOT NULL,
  `normal_value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab_temps`
--

CREATE TABLE `lab_temps` (
  `id` int(11) NOT NULL,
  `temp_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `label_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lab_temps`
--

INSERT INTO `lab_temps` (`id`, `temp_name`, `label_id`, `date_added`) VALUES
(1, 'pCV_#9#1Men#7_40_-_54#3_Female#7_36_-_47#2', 1, '2019-06-13 09:47:27'),
(2, 'total_WBC_#6Mm3_#14#3000_-11#3000#2', 1, '2019-06-13 09:47:27'),
(3, 'nEUTROPHIL_#9_#145_-_70#2', 1, '2019-06-13 09:47:27'),
(4, 'lYMPHOCYTE_#9_#125_-_40#2', 1, '2019-06-13 09:47:27'),
(5, 'eOSINOPHIL_#9_#10_-_6#2', 1, '2019-06-13 09:47:27'),
(6, 'bASAPHIL_#9_#10_-_1#2', 1, '2019-06-13 09:47:27'),
(7, 'mONOCYTE', 1, '2019-05-24 00:01:24'),
(8, 'bLOOD_FILM', 1, '2019-05-24 00:01:24'),
(12, 'aBO_Group', 5, '2019-05-24 00:14:40'),
(13, 'rH_D_', 5, '2019-05-24 00:14:40'),
(14, 'ePITH__hpf_', 6, '2019-05-24 00:28:36'),
(15, 'pUS_CELLS__hpf_', 6, '2019-05-24 00:28:36'),
(16, 'rBCS__hpf_', 6, '2019-05-24 00:28:36'),
(17, 'cASTS__hpf_', 6, '2019-05-24 00:28:36'),
(18, 'cRYSTALS__hpf_', 6, '2019-05-24 00:28:36'),
(19, 'bACTERIA__hpf_', 6, '2019-05-24 00:28:36'),
(20, 'yEAST_LIKE_CELLS__hpf_', 6, '2019-05-24 00:28:36'),
(21, 't_VAGINALIS__hpf_', 6, '2019-05-24 00:28:36'),
(22, 's_HEMOTOMINM__hpf_', 6, '2019-05-24 00:28:36'),
(23, 'iSOLATE_1', 6, '2019-05-24 00:28:36'),
(24, 'iSOLATE_2', 6, '2019-05-24 00:28:36'),
(25, 'iSOLATE_3', 6, '2019-05-24 00:28:36'),
(26, 'fORTUM', 6, '2019-05-24 00:28:36'),
(27, 'aMPICILLIN', 6, '2019-05-24 00:28:36'),
(28, 'rULID', 6, '2019-05-24 00:28:36'),
(29, 'aUGMENTIN', 6, '2019-05-24 00:28:36'),
(30, 'cHLORAMPHENICOL', 6, '2019-05-24 00:28:36'),
(31, 'zINNAT_AINNACEF', 6, '2019-05-24 00:28:36'),
(32, 'c_SULPHONAMIDES', 6, '2019-05-24 00:28:36'),
(33, 'nORBACTIN', 6, '2019-05-24 00:28:36'),
(34, 'cOLLISTIN_SO', 6, '2019-05-24 00:28:36'),
(35, 'cIPROXIN', 6, '2019-05-24 00:28:36'),
(36, 'tOGAMYCIN', 6, '2019-05-24 00:28:36'),
(37, 'aMOXYCILLIN', 6, '2019-05-24 00:28:36'),
(38, 'aZITHROMYCIN', 6, '2019-05-24 00:28:36'),
(39, 'cLOXACILLIN', 6, '2019-05-24 00:28:36'),
(40, 'cLAFORAN', 6, '2019-05-24 00:28:36'),
(41, 'cLINDAMCIN', 6, '2019-05-24 00:28:36'),
(42, 'eRYTHROMYCIN', 6, '2019-05-24 00:28:36'),
(43, 'dOXO_CYCLIN', 6, '2019-05-24 00:28:36'),
(44, 'nITROFURATION', 6, '2019-05-24 00:28:37'),
(45, 'gENTAMYCIN', 6, '2019-05-24 00:28:37'),
(46, 'aMIKACIN', 6, '2019-05-24 00:28:37'),
(47, 'pEFOXACINE', 6, '2019-05-24 00:28:37'),
(48, 'nALIDIXIC_A', 6, '2019-05-24 00:28:37'),
(49, 'cAPOREX', 6, '2019-05-24 00:28:37'),
(50, 'rECEPHIN', 6, '2019-05-24 00:28:37'),
(51, 'tARIVID', 6, '2019-05-24 00:28:37'),
(52, 'sTREPTOMCIN', 6, '2019-05-24 00:28:37'),
(53, 'sEPTIN', 6, '2019-05-24 00:28:37'),
(54, 'tETRACYLINE', 6, '2019-05-24 00:28:37'),
(55, 'pENICILINE_G', 6, '2019-05-24 00:28:37'),
(56, 'aPPEARANCE', 7, '2019-05-24 00:31:48'),
(57, 'cOLOUR', 7, '2019-05-24 00:31:48'),
(58, 'pH', 7, '2019-05-24 00:31:48'),
(59, 'pROTEIN', 7, '2019-05-24 00:31:48'),
(60, 'sUGAR', 7, '2019-05-24 00:31:48'),
(61, 'kETONE', 7, '2019-05-24 00:31:48'),
(62, 'uRINE_SPECIFIC_GRAVITY', 7, '2019-05-24 00:31:48'),
(63, 'bILLS_SALTS', 7, '2019-05-24 00:31:48'),
(64, 'uROBILINOGEN', 7, '2019-05-24 00:31:48'),
(65, 'aSCORBIC_ACID', 7, '2019-05-24 00:31:48'),
(66, 'nITRITE', 7, '2019-05-24 00:31:48'),
(67, 'bLOOD', 7, '2019-05-24 00:31:48'),
(68, 'bILLRUBIN', 7, '2019-05-24 00:31:48'),
(69, 'iSOLATE_1', 8, '2019-05-24 00:43:54'),
(70, 'iSOLATE_2', 8, '2019-05-24 00:43:54'),
(71, 'iSOLATE_3', 8, '2019-05-24 00:43:55'),
(72, 'fORTUM', 8, '2019-05-24 00:43:55'),
(73, 'aMPICILLIN', 8, '2019-05-24 00:43:55'),
(74, 'rUILD', 8, '2019-05-24 00:43:55'),
(75, 'aUGMENTIN', 8, '2019-05-24 00:43:55'),
(76, 'cHLORAMPHENICOL', 8, '2019-05-24 00:43:55'),
(77, 'zINNAT_ZINNACEF', 8, '2019-05-24 00:43:55'),
(78, 'c_SULPHONAMIDES', 8, '2019-05-24 00:43:55'),
(79, 'nORBACTIN', 8, '2019-05-24 00:43:55'),
(80, 'cOLLISTIN_SO', 8, '2019-05-24 00:43:55'),
(81, 'cIPROXIN', 8, '2019-05-24 00:43:55'),
(82, 'tOGAMYCIN', 8, '2019-05-24 00:43:55'),
(83, 'aMOXYCILLIN', 8, '2019-05-24 00:43:55'),
(84, 'aZITHROMYCIN', 8, '2019-05-24 00:43:55'),
(85, 'cLOXACILLIN', 8, '2019-05-24 00:43:55'),
(86, 'cLAFORAN', 8, '2019-05-24 00:43:55'),
(87, 'cLINDAMCIN', 8, '2019-05-24 00:43:55'),
(88, 'eRYTHROMYCIN', 8, '2019-05-24 00:43:55'),
(89, 'dOXO_CYCLIN', 8, '2019-05-24 00:43:55'),
(90, 'nITROFURATION', 8, '2019-05-24 00:43:55'),
(91, 'gENTAMYCIN', 8, '2019-05-24 00:43:55'),
(92, 'aMIKACIN', 8, '2019-05-24 00:43:55'),
(93, 'pEFOXACINE', 8, '2019-05-24 00:43:55'),
(94, 'nALIDIXIC_A', 8, '2019-05-24 00:43:55'),
(95, 'cAPOREX', 8, '2019-05-24 00:43:55'),
(96, 'rECEPHIN', 8, '2019-05-24 00:43:55'),
(97, 'tARIVID', 8, '2019-05-24 00:43:55'),
(98, 'sTREPTOMCIN', 8, '2019-05-24 00:43:55'),
(99, 'sEPTIN', 8, '2019-05-24 00:43:55'),
(100, 'tETRACYLINE', 8, '2019-05-24 00:43:55'),
(101, 'pENICILIN_G', 8, '2019-05-24 00:43:55'),
(102, 'iSOLATE_1', 9, '2019-05-24 00:44:29'),
(103, 'iSOLATE_2', 9, '2019-05-24 00:44:29'),
(104, 'iSOLATE_3', 9, '2019-05-24 00:44:29'),
(105, 'fORTUM', 9, '2019-05-24 00:44:29'),
(106, 'aMPICILLIN', 9, '2019-05-24 00:44:29'),
(107, 'rUILD', 9, '2019-05-24 00:44:29'),
(108, 'aUGMENTIN', 9, '2019-05-24 00:44:29'),
(109, 'cHLORAMPHENICOL', 9, '2019-05-24 00:44:29'),
(110, 'zINNAT_ZINNACEF', 9, '2019-05-24 00:44:29'),
(111, 'c_SULPHONAMIDES', 9, '2019-05-24 00:44:29'),
(112, 'nORBACTIN', 9, '2019-05-24 00:44:29'),
(113, 'cOLLISTIN_SO', 9, '2019-05-24 00:44:29'),
(114, 'cIPROXIN', 9, '2019-05-24 00:44:29'),
(115, 'tOGAMYCIN', 9, '2019-05-24 00:44:29'),
(116, 'aMOXYCILLIN', 9, '2019-05-24 00:44:29'),
(117, 'aZITHROMYCIN', 9, '2019-05-24 00:44:29'),
(118, 'cLOXACILLIN', 9, '2019-05-24 00:44:29'),
(119, 'cLAFORAN', 9, '2019-05-24 00:44:29'),
(120, 'cLINDAMCIN', 9, '2019-05-24 00:44:29'),
(121, 'eRYTHROMYCIN', 9, '2019-05-24 00:44:29'),
(122, 'dOXO_CYCLIN', 9, '2019-05-24 00:44:29'),
(123, 'nITROFURATION', 9, '2019-05-24 00:44:29'),
(124, 'gENTAMYCIN', 9, '2019-05-24 00:44:29'),
(125, 'aMIKACIN', 9, '2019-05-24 00:44:29'),
(126, 'pEFOXACINE', 9, '2019-05-24 00:44:29'),
(127, 'nALIDIXIC_A', 9, '2019-05-24 00:44:29'),
(128, 'cAPOREX', 9, '2019-05-24 00:44:29'),
(129, 'rECEPHIN', 9, '2019-05-24 00:44:29'),
(130, 'tARIVID', 9, '2019-05-24 00:44:29'),
(131, 'sTREPTOMCIN', 9, '2019-05-24 00:44:29'),
(132, 'sEPTIN', 9, '2019-05-24 00:44:29'),
(133, 'tETRACYLINE', 9, '2019-05-24 00:44:29'),
(134, 'pENICILIN_G', 9, '2019-05-24 00:44:29'),
(135, 'iSOLATE_1', 10, '2019-05-24 00:45:05'),
(136, 'iSOLATE_2', 10, '2019-05-24 00:45:05'),
(137, 'iSOLATE_3', 10, '2019-05-24 00:45:05'),
(138, 'fORTUM', 10, '2019-05-24 00:45:05'),
(139, 'aMPICILLIN', 10, '2019-05-24 00:45:05'),
(140, 'rUILD', 10, '2019-05-24 00:45:05'),
(141, 'aUGMENTIN', 10, '2019-05-24 00:45:05'),
(142, 'cHLORAMPHENICOL', 10, '2019-05-24 00:45:05'),
(143, 'zINNAT_ZINNACEF', 10, '2019-05-24 00:45:05'),
(144, 'c_SULPHONAMIDES', 10, '2019-05-24 00:45:05'),
(145, 'nORBACTIN', 10, '2019-05-24 00:45:05'),
(146, 'cOLLISTIN_SO', 10, '2019-05-24 00:45:05'),
(147, 'cIPROXIN', 10, '2019-05-24 00:45:05'),
(148, 'tOGAMYCIN', 10, '2019-05-24 00:45:05'),
(149, 'aMOXYCILLIN', 10, '2019-05-24 00:45:05'),
(150, 'aZITHROMYCIN', 10, '2019-05-24 00:45:05'),
(151, 'cLOXACILLIN', 10, '2019-05-24 00:45:05'),
(152, 'cLAFORAN', 10, '2019-05-24 00:45:05'),
(153, 'cLINDAMCIN', 10, '2019-05-24 00:45:06'),
(154, 'eRYTHROMYCIN', 10, '2019-05-24 00:45:06'),
(155, 'dOXO_CYCLIN', 10, '2019-05-24 00:45:06'),
(156, 'nITROFURATION', 10, '2019-05-24 00:45:06'),
(157, 'gENTAMYCIN', 10, '2019-05-24 00:45:06'),
(158, 'aMIKACIN', 10, '2019-05-24 00:45:06'),
(159, 'pEFOXACINE', 10, '2019-05-24 00:45:06'),
(160, 'nALIDIXIC_A', 10, '2019-05-24 00:45:06'),
(161, 'cAPOREX', 10, '2019-05-24 00:45:06'),
(162, 'rECEPHIN', 10, '2019-05-24 00:45:06'),
(163, 'tARIVID', 10, '2019-05-24 00:45:06'),
(164, 'sTREPTOMCIN', 10, '2019-05-24 00:45:06'),
(165, 'sEPTIN', 10, '2019-05-24 00:45:06'),
(166, 'tETRACYLINE', 10, '2019-05-24 00:45:06'),
(167, 'pENICILIN_G', 10, '2019-05-24 00:45:06'),
(168, 'iSOLATE_1', 11, '2019-05-24 00:45:18'),
(169, 'iSOLATE_2', 11, '2019-05-24 00:45:18'),
(170, 'iSOLATE_3', 11, '2019-05-24 00:45:18'),
(171, 'fORTUM', 11, '2019-05-24 00:45:18'),
(172, 'aMPICILLIN', 11, '2019-05-24 00:45:18'),
(173, 'rUILD', 11, '2019-05-24 00:45:18'),
(174, 'aUGMENTIN', 11, '2019-05-24 00:45:18'),
(175, 'cHLORAMPHENICOL', 11, '2019-05-24 00:45:18'),
(176, 'zINNAT_ZINNACEF', 11, '2019-05-24 00:45:18'),
(177, 'c_SULPHONAMIDES', 11, '2019-05-24 00:45:18'),
(178, 'nORBACTIN', 11, '2019-05-24 00:45:18'),
(179, 'cOLLISTIN_SO', 11, '2019-05-24 00:45:18'),
(180, 'cIPROXIN', 11, '2019-05-24 00:45:18'),
(181, 'tOGAMYCIN', 11, '2019-05-24 00:45:18'),
(182, 'aMOXYCILLIN', 11, '2019-05-24 00:45:18'),
(183, 'aZITHROMYCIN', 11, '2019-05-24 00:45:18'),
(184, 'cLOXACILLIN', 11, '2019-05-24 00:45:18'),
(185, 'cLAFORAN', 11, '2019-05-24 00:45:18'),
(186, 'cLINDAMCIN', 11, '2019-05-24 00:45:18'),
(187, 'eRYTHROMYCIN', 11, '2019-05-24 00:45:18'),
(188, 'dOXO_CYCLIN', 11, '2019-05-24 00:45:18'),
(189, 'nITROFURATION', 11, '2019-05-24 00:45:18'),
(190, 'gENTAMYCIN', 11, '2019-05-24 00:45:18'),
(191, 'aMIKACIN', 11, '2019-05-24 00:45:18'),
(192, 'pEFOXACINE', 11, '2019-05-24 00:45:18'),
(193, 'nALIDIXIC_A', 11, '2019-05-24 00:45:18'),
(194, 'cAPOREX', 11, '2019-05-24 00:45:18'),
(195, 'rECEPHIN', 11, '2019-05-24 00:45:18'),
(196, 'tARIVID', 11, '2019-05-24 00:45:18'),
(197, 'sTREPTOMCIN', 11, '2019-05-24 00:45:18'),
(198, 'sEPTIN', 11, '2019-05-24 00:45:18'),
(199, 'tETRACYLINE', 11, '2019-05-24 00:45:18'),
(200, 'pENICILIN_G', 11, '2019-05-24 00:45:18'),
(201, 'iSOLATE_1', 12, '2019-05-24 00:45:28'),
(202, 'iSOLATE_2', 12, '2019-05-24 00:45:28'),
(203, 'iSOLATE_3', 12, '2019-05-24 00:45:28'),
(204, 'fORTUM', 12, '2019-05-24 00:45:28'),
(205, 'aMPICILLIN', 12, '2019-05-24 00:45:28'),
(206, 'rUILD', 12, '2019-05-24 00:45:28'),
(207, 'aUGMENTIN', 12, '2019-05-24 00:45:28'),
(208, 'cHLORAMPHENICOL', 12, '2019-05-24 00:45:28'),
(209, 'zINNAT_ZINNACEF', 12, '2019-05-24 00:45:28'),
(210, 'c_SULPHONAMIDES', 12, '2019-05-24 00:45:28'),
(211, 'nORBACTIN', 12, '2019-05-24 00:45:28'),
(212, 'cOLLISTIN_SO', 12, '2019-05-24 00:45:28'),
(213, 'cIPROXIN', 12, '2019-05-24 00:45:28'),
(214, 'tOGAMYCIN', 12, '2019-05-24 00:45:28'),
(215, 'aMOXYCILLIN', 12, '2019-05-24 00:45:28'),
(216, 'aZITHROMYCIN', 12, '2019-05-24 00:45:28'),
(217, 'cLOXACILLIN', 12, '2019-05-24 00:45:28'),
(218, 'cLAFORAN', 12, '2019-05-24 00:45:28'),
(219, 'cLINDAMCIN', 12, '2019-05-24 00:45:28'),
(220, 'eRYTHROMYCIN', 12, '2019-05-24 00:45:28'),
(221, 'dOXO_CYCLIN', 12, '2019-05-24 00:45:28'),
(222, 'nITROFURATION', 12, '2019-05-24 00:45:28'),
(223, 'gENTAMYCIN', 12, '2019-05-24 00:45:28'),
(224, 'aMIKACIN', 12, '2019-05-24 00:45:28'),
(225, 'pEFOXACINE', 12, '2019-05-24 00:45:28'),
(226, 'nALIDIXIC_A', 12, '2019-05-24 00:45:28'),
(227, 'cAPOREX', 12, '2019-05-24 00:45:29'),
(228, 'rECEPHIN', 12, '2019-05-24 00:45:29'),
(229, 'tARIVID', 12, '2019-05-24 00:45:29'),
(230, 'sTREPTOMCIN', 12, '2019-05-24 00:45:29'),
(231, 'sEPTIN', 12, '2019-05-24 00:45:29'),
(232, 'tETRACYLINE', 12, '2019-05-24 00:45:29'),
(233, 'pENICILIN_G', 12, '2019-05-24 00:45:29'),
(234, 'iSOLATE_1', 13, '2019-05-24 00:45:38'),
(235, 'iSOLATE_2', 13, '2019-05-24 00:45:38'),
(236, 'iSOLATE_3', 13, '2019-05-24 00:45:38'),
(237, 'fORTUM', 13, '2019-05-24 00:45:38'),
(238, 'aMPICILLIN', 13, '2019-05-24 00:45:38'),
(239, 'rUILD', 13, '2019-05-24 00:45:38'),
(240, 'aUGMENTIN', 13, '2019-05-24 00:45:38'),
(241, 'cHLORAMPHENICOL', 13, '2019-05-24 00:45:38'),
(242, 'zINNAT_ZINNACEF', 13, '2019-05-24 00:45:38'),
(243, 'c_SULPHONAMIDES', 13, '2019-05-24 00:45:38'),
(244, 'nORBACTIN', 13, '2019-05-24 00:45:38'),
(245, 'cOLLISTIN_SO', 13, '2019-05-24 00:45:38'),
(246, 'cIPROXIN', 13, '2019-05-24 00:45:38'),
(247, 'tOGAMYCIN', 13, '2019-05-24 00:45:38'),
(248, 'aMOXYCILLIN', 13, '2019-05-24 00:45:38'),
(249, 'aZITHROMYCIN', 13, '2019-05-24 00:45:38'),
(250, 'cLOXACILLIN', 13, '2019-05-24 00:45:38'),
(251, 'cLAFORAN', 13, '2019-05-24 00:45:38'),
(252, 'cLINDAMCIN', 13, '2019-05-24 00:45:38'),
(253, 'eRYTHROMYCIN', 13, '2019-05-24 00:45:38'),
(254, 'dOXO_CYCLIN', 13, '2019-05-24 00:45:38'),
(255, 'nITROFURATION', 13, '2019-05-24 00:45:38'),
(256, 'gENTAMYCIN', 13, '2019-05-24 00:45:38'),
(257, 'aMIKACIN', 13, '2019-05-24 00:45:38'),
(258, 'pEFOXACINE', 13, '2019-05-24 00:45:38'),
(259, 'nALIDIXIC_A', 13, '2019-05-24 00:45:38'),
(260, 'cAPOREX', 13, '2019-05-24 00:45:38'),
(261, 'rECEPHIN', 13, '2019-05-24 00:45:38'),
(262, 'tARIVID', 13, '2019-05-24 00:45:38'),
(263, 'sTREPTOMCIN', 13, '2019-05-24 00:45:38'),
(264, 'sEPTIN', 13, '2019-05-24 00:45:38'),
(265, 'tETRACYLINE', 13, '2019-05-24 00:45:38'),
(266, 'pENICILIN_G', 13, '2019-05-24 00:45:38'),
(267, 'iSOLATE_1', 14, '2019-05-24 00:45:56'),
(268, 'iSOLATE_2', 14, '2019-05-24 00:45:56'),
(269, 'iSOLATE_3', 14, '2019-05-24 00:45:56'),
(270, 'fORTUM', 14, '2019-05-24 00:45:56'),
(271, 'aMPICILLIN', 14, '2019-05-24 00:45:56'),
(272, 'rUILD', 14, '2019-05-24 00:45:56'),
(273, 'aUGMENTIN', 14, '2019-05-24 00:45:56'),
(274, 'cHLORAMPHENICOL', 14, '2019-05-24 00:45:56'),
(275, 'zINNAT_ZINNACEF', 14, '2019-05-24 00:45:56'),
(276, 'c_SULPHONAMIDES', 14, '2019-05-24 00:45:56'),
(277, 'nORBACTIN', 14, '2019-05-24 00:45:56'),
(278, 'cOLLISTIN_SO', 14, '2019-05-24 00:45:56'),
(279, 'cIPROXIN', 14, '2019-05-24 00:45:56'),
(280, 'tOGAMYCIN', 14, '2019-05-24 00:45:56'),
(281, 'aMOXYCILLIN', 14, '2019-05-24 00:45:56'),
(282, 'aZITHROMYCIN', 14, '2019-05-24 00:45:56'),
(283, 'cLOXACILLIN', 14, '2019-05-24 00:45:56'),
(284, 'cLAFORAN', 14, '2019-05-24 00:45:56'),
(285, 'cLINDAMCIN', 14, '2019-05-24 00:45:56'),
(286, 'eRYTHROMYCIN', 14, '2019-05-24 00:45:56'),
(287, 'dOXO_CYCLIN', 14, '2019-05-24 00:45:56'),
(288, 'nITROFURATION', 14, '2019-05-24 00:45:56'),
(289, 'gENTAMYCIN', 14, '2019-05-24 00:45:56'),
(290, 'aMIKACIN', 14, '2019-05-24 00:45:56'),
(291, 'pEFOXACINE', 14, '2019-05-24 00:45:56'),
(292, 'nALIDIXIC_A', 14, '2019-05-24 00:45:56'),
(293, 'cAPOREX', 14, '2019-05-24 00:45:56'),
(294, 'rECEPHIN', 14, '2019-05-24 00:45:56'),
(295, 'tARIVID', 14, '2019-05-24 00:45:56'),
(296, 'sTREPTOMCIN', 14, '2019-05-24 00:45:56'),
(297, 'sEPTIN', 14, '2019-05-24 00:45:56'),
(298, 'tETRACYLINE', 14, '2019-06-13 09:44:13'),
(299, 'pENICILIN_G', 14, '2019-05-24 00:45:57'),
(300, 'iSOLATE_1', 15, '2019-05-24 00:46:07'),
(301, 'iSOLATE_2', 15, '2019-05-24 00:46:08'),
(302, 'iSOLATE_3', 15, '2019-05-24 00:46:08'),
(303, 'fORTUM', 15, '2019-05-24 00:46:08'),
(304, 'aMPICILLIN', 15, '2019-05-24 00:46:08'),
(305, 'rUILD', 15, '2019-05-24 00:46:08'),
(306, 'aUGMENTIN', 15, '2019-05-24 00:46:08'),
(307, 'cHLORAMPHENICOL', 15, '2019-05-24 00:46:08'),
(308, 'zINNAT_ZINNACEF', 15, '2019-05-24 00:46:08'),
(309, 'c_SULPHONAMIDES', 15, '2019-05-24 00:46:08'),
(310, 'nORBACTIN', 15, '2019-05-24 00:46:08'),
(311, 'cOLLISTIN_SO', 15, '2019-05-24 00:46:08'),
(312, 'cIPROXIN', 15, '2019-05-24 00:46:08'),
(313, 'tOGAMYCIN', 15, '2019-05-24 00:46:08'),
(314, 'aMOXYCILLIN', 15, '2019-05-24 00:46:08'),
(315, 'aZITHROMYCIN', 15, '2019-05-24 00:46:08'),
(316, 'cLOXACILLIN', 15, '2019-05-24 00:46:08'),
(317, 'cLAFORAN', 15, '2019-05-24 00:46:08'),
(318, 'cLINDAMCIN', 15, '2019-05-24 00:46:08'),
(319, 'eRYTHROMYCIN', 15, '2019-05-24 00:46:08'),
(320, 'dOXO_CYCLIN', 15, '2019-05-24 00:46:08'),
(321, 'nITROFURATION', 15, '2019-05-24 00:46:08'),
(322, 'gENTAMYCIN', 15, '2019-05-24 00:46:08'),
(323, 'aMIKACIN', 15, '2019-05-24 00:46:08'),
(324, 'pEFOXACINE', 15, '2019-05-24 00:46:08'),
(325, 'nALIDIXIC_A', 15, '2019-05-24 00:46:08'),
(326, 'cAPOREX', 15, '2019-05-24 00:46:08'),
(327, 'rECEPHIN', 15, '2019-05-24 00:46:08'),
(328, 'tARIVID', 15, '2019-05-24 00:46:08'),
(329, 'sTREPTOMCIN', 15, '2019-05-24 00:46:08'),
(330, 'sEPTIN', 15, '2019-05-24 00:46:08'),
(331, 'tETRACYLINE', 15, '2019-05-24 00:46:08'),
(332, 'pENICILIN_G', 15, '2019-05-24 00:46:08'),
(333, 'iSOLATE_1', 16, '2019-05-24 00:47:16'),
(334, 'iSOLATE_2', 16, '2019-05-24 00:47:16'),
(335, 'iSOLATE_3', 16, '2019-05-24 00:47:16'),
(336, 'fORTUM', 16, '2019-05-24 00:47:16'),
(337, 'aMPICILLIN', 16, '2019-05-24 00:47:16'),
(338, 'rUILD', 16, '2019-05-24 00:47:16'),
(339, 'aUGMENTIN', 16, '2019-05-24 00:47:16'),
(340, 'cHLORAMPHENICOL', 16, '2019-05-24 00:47:16'),
(341, 'zINNAT_ZINNACEF', 16, '2019-05-24 00:47:17'),
(342, 'c_SULPHONAMIDES', 16, '2019-05-24 00:47:17'),
(343, 'nORBACTIN', 16, '2019-05-24 00:47:17'),
(344, 'cOLLISTIN_SO', 16, '2019-05-24 00:47:17'),
(345, 'cIPROXIN', 16, '2019-05-24 00:47:17'),
(346, 'tOGAMYCIN', 16, '2019-05-24 00:47:17'),
(347, 'aMOXYCILLIN', 16, '2019-05-24 00:47:17'),
(348, 'aZITHROMYCIN', 16, '2019-05-24 00:47:17'),
(349, 'cLOXACILLIN', 16, '2019-05-24 00:47:17'),
(350, 'cLAFORAN', 16, '2019-05-24 00:47:17'),
(351, 'cLINDAMCIN', 16, '2019-05-24 00:47:17'),
(352, 'eRYTHROMYCIN', 16, '2019-05-24 00:47:17'),
(353, 'dOXO_CYCLIN', 16, '2019-05-24 00:47:17'),
(354, 'nITROFURATION', 16, '2019-05-24 00:47:17'),
(355, 'gENTAMYCIN', 16, '2019-05-24 00:47:17'),
(356, 'aMIKACIN', 16, '2019-05-24 00:47:17'),
(357, 'pEFOXACINE', 16, '2019-05-24 00:47:17'),
(358, 'nALIDIXIC_A', 16, '2019-05-24 00:47:17'),
(359, 'cAPOREX', 16, '2019-05-24 00:47:17'),
(360, 'rECEPHIN', 16, '2019-05-24 00:47:17'),
(361, 'tARIVID', 16, '2019-05-24 00:47:17'),
(362, 'sTREPTOMCIN', 16, '2019-05-24 00:47:17'),
(363, 'sEPTIN', 16, '2019-05-24 00:47:17'),
(364, 'tETRACYLINE', 16, '2019-05-24 00:47:17'),
(365, 'pENICILIN_G', 16, '2019-05-24 00:47:17'),
(366, 'iSOLATE_1', 17, '2019-05-24 00:49:05'),
(367, 'iSOLATE_2', 17, '2019-05-24 00:49:05'),
(368, 'iSOLATE_3', 17, '2019-05-24 00:49:05'),
(369, 'fORTUM', 17, '2019-05-24 00:49:05'),
(370, 'aMPICILLIN', 17, '2019-05-24 00:49:05'),
(371, 'rUILD', 17, '2019-05-24 00:49:05'),
(372, 'aUGMENTIN', 17, '2019-05-24 00:49:05'),
(373, 'cHLORAMPHENICOL', 17, '2019-05-24 00:49:05'),
(374, 'zINNAT_ZINNACEF', 17, '2019-05-24 00:49:05'),
(375, 'c_SULPHONAMIDES', 17, '2019-05-24 00:49:05'),
(376, 'nORBACTIN', 17, '2019-05-24 00:49:05'),
(377, 'cOLLISTIN_SO', 17, '2019-05-24 00:49:05'),
(378, 'cIPROXIN', 17, '2019-05-24 00:49:05'),
(379, 'tOGAMYCIN', 17, '2019-05-24 00:49:05'),
(380, 'aMOXYCILLIN', 17, '2019-05-24 00:49:05'),
(381, 'aZITHROMYCIN', 17, '2019-05-24 00:49:05'),
(382, 'cLOXACILLIN', 17, '2019-05-24 00:49:05'),
(383, 'cLAFORAN', 17, '2019-05-24 00:49:05'),
(384, 'cLINDAMCIN', 17, '2019-05-24 00:49:05'),
(385, 'eRYTHROMYCIN', 17, '2019-05-24 00:49:05'),
(386, 'dOXO_CYCLIN', 17, '2019-05-24 00:49:05'),
(387, 'nITROFURATION', 17, '2019-05-24 00:49:05'),
(388, 'gENTAMYCIN', 17, '2019-05-24 00:49:05'),
(389, 'aMIKACIN', 17, '2019-05-24 00:49:05'),
(390, 'pEFOXACINE', 17, '2019-05-24 00:49:05'),
(391, 'nALIDIXIC_A', 17, '2019-05-24 00:49:05'),
(392, 'cAPOREX', 17, '2019-05-24 00:49:05'),
(393, 'rECEPHIN', 17, '2019-05-24 00:49:05'),
(394, 'tARIVID', 17, '2019-05-24 00:49:05'),
(395, 'sTREPTOMCIN', 17, '2019-05-24 00:49:05'),
(396, 'sEPTIN', 17, '2019-05-24 00:49:05'),
(397, 'tETRACYLINE', 17, '2019-05-24 00:49:05'),
(398, 'pENICILIN_G', 17, '2019-05-24 00:49:05'),
(399, 'ePITH_CELLS', 17, '2019-05-24 00:49:05'),
(400, 'pUS_CELLS', 17, '2019-05-24 00:49:06'),
(401, 'rBCS', 17, '2019-05-24 00:49:06'),
(402, 'bACTERIA', 17, '2019-05-24 00:49:06'),
(403, 't__VAGINALIS', 17, '2019-05-24 00:49:06'),
(404, 'yEAST_LIKE_CELLS', 17, '2019-05-24 00:49:06'),
(405, 'iSOLATE_1', 18, '2019-05-24 00:59:44'),
(406, 'iSOLATE_2', 18, '2019-05-24 00:59:44'),
(407, 'iSOLATE_3', 18, '2019-05-24 00:59:44'),
(408, 'fORTUM', 18, '2019-05-24 00:59:44'),
(409, 'aMPICILLIN', 18, '2019-05-24 00:59:44'),
(410, 'rUILD', 18, '2019-05-24 00:59:44'),
(411, 'aUGMENTIN', 18, '2019-05-24 00:59:44'),
(412, 'cHLORAMPHENICOL', 18, '2019-05-24 00:59:44'),
(413, 'zINNAT_ZINNACEF', 18, '2019-05-24 00:59:44'),
(414, 'c_SULPHONAMIDES', 18, '2019-05-24 00:59:44'),
(415, 'nORBACTIN', 18, '2019-05-24 00:59:44'),
(416, 'cOLLISTIN_SO', 18, '2019-05-24 00:59:44'),
(417, 'cIPROXIN', 18, '2019-05-24 00:59:44'),
(418, 'tOGAMYCIN', 18, '2019-05-24 00:59:44'),
(419, 'aMOXYCILLIN', 18, '2019-05-24 00:59:44'),
(420, 'aZITHROMYCIN', 18, '2019-05-24 00:59:44'),
(421, 'cLOXACILLIN', 18, '2019-05-24 00:59:44'),
(422, 'cLAFORAN', 18, '2019-05-24 00:59:44'),
(423, 'cLINDAMCIN', 18, '2019-05-24 00:59:44'),
(424, 'eRYTHROMYCIN', 18, '2019-05-24 00:59:44'),
(425, 'dOXO_CYCLIN', 18, '2019-05-24 00:59:44'),
(426, 'nITROFURATION', 18, '2019-05-24 00:59:44'),
(427, 'gENTAMYCIN', 18, '2019-05-24 00:59:44'),
(428, 'aMIKACIN', 18, '2019-05-24 00:59:44'),
(429, 'pEFOXACINE', 18, '2019-05-24 00:59:44'),
(430, 'nALIDIXIC_A', 18, '2019-05-24 00:59:44'),
(431, 'cAPOREX', 18, '2019-05-24 00:59:44'),
(432, 'rECEPHIN', 18, '2019-05-24 00:59:44'),
(433, 'tARIVID', 18, '2019-05-24 00:59:44'),
(434, 'sTREPTOMCIN', 18, '2019-05-24 00:59:44'),
(435, 'sEPTIN', 18, '2019-05-24 00:59:44'),
(436, 'tETRACYLINE', 18, '2019-05-24 00:59:44'),
(437, 'pENICILIN_G', 18, '2019-05-24 00:59:45'),
(438, 'ePITH_CELLS', 18, '2019-05-24 00:59:45'),
(439, 'pUS_CELLS', 18, '2019-05-24 00:59:45'),
(440, 'rBCS', 18, '2019-05-24 00:59:45'),
(441, 'bACTERIA', 18, '2019-05-24 00:59:45'),
(442, 't__VAGINALIS', 18, '2019-05-24 00:59:45'),
(443, 'yEAST_-_LIKE_CELLS', 18, '2019-05-24 00:59:45'),
(444, 'aPPEARANCE', 19, '2019-05-24 01:06:13'),
(445, 'oVA', 19, '2019-05-24 01:06:13'),
(446, 'cYSTS', 19, '2019-05-24 01:06:13'),
(447, 'wBC', 19, '2019-05-24 01:06:13'),
(448, 'lARVAE', 19, '2019-05-24 01:06:13'),
(449, 'pARASITES', 19, '2019-05-24 01:06:13'),
(450, 'tIME_EJACULATED', 20, '2019-05-24 01:07:27'),
(451, 'tIME_RECEIVED', 20, '2019-05-24 01:07:27'),
(452, 'tIME_EXAMINED', 20, '2019-05-24 01:07:27'),
(453, 'aPPEARANCE', 20, '2019-05-24 01:07:27'),
(454, 'sPERM_COUNT_#160_-_100_X_10#2cells#6mm', 20, '2019-06-13 09:47:27'),
(455, 'sPERM_MORPHOLOGY#6MICROSCOPY_REMARK', 20, '2019-06-13 09:47:27'),
(456, 'vOLUME', 20, '2019-05-25 08:06:37'),
(457, 'pH', 20, '2019-05-25 08:06:37'),
(458, 'cOLOUR', 20, '2019-05-25 08:06:37'),
(459, 'oDOUR', 20, '2019-05-25 08:06:37'),
(460, 'vISCOSITY', 20, '2019-05-25 08:06:37'),
(461, 'vIABILITY', 20, '2019-05-25 08:06:37'),
(462, 'mOTILITY', 20, '2019-05-25 08:06:37'),
(463, 'pROGRESSIVELY_MOTILE', 20, '2019-05-25 08:06:37'),
(464, 'nON_PROGRESSIVELY_MOTILE', 20, '2019-05-25 08:06:37'),
(465, 'nON_MOTILE', 20, '2019-05-25 08:06:37'),
(466, 'sEMINAL_FLUID_COLLECTED_IN_LAB', 20, '2019-05-25 08:06:37'),
(467, 'rEMARK#6RESULTS', 20, '2019-06-13 09:47:27'),
(468, 'rESULT', 21, '2019-05-24 02:19:01'),
(469, 'rESULT', 22, '2019-05-24 02:19:08'),
(470, 'rESULT_mg#6d_#1up_to_150#2', 23, '2019-06-13 09:47:27'),
(471, 'ePITH__hpf_', 24, '2019-05-24 02:24:20'),
(472, 'pUS_CELLS__hpf_', 24, '2019-05-24 02:24:20'),
(473, 'rBCS__hpf_', 24, '2019-05-24 02:24:20'),
(474, 'cASTS__hpf_', 24, '2019-05-24 02:24:20'),
(475, 'cRYSTALS__hpf_', 24, '2019-05-24 02:24:20'),
(476, 'bACTERIA__hpf_', 24, '2019-05-24 02:24:20'),
(477, 'yEAST_LIKE_CELLS__hpf_', 24, '2019-05-24 02:24:20'),
(478, 't__VAGINALIS__hpf_', 24, '2019-05-24 02:24:20'),
(479, 's__HEMATOMINM__hpf_', 24, '2019-05-24 02:24:21'),
(480, 'rESULT_mmol#6l_#18#87_-_10#87#2mg#6d1', 25, '2019-06-13 09:47:27'),
(481, 'rESULT_mg#6d1_#1200#2mg#6d', 26, '2019-06-13 09:47:27'),
(482, 'rESULT_mEq#61_#140_-_150#2', 27, '2019-06-13 09:47:27'),
(483, 'rESULT_mEq#61#14#80_-_8#80#2', 28, '2019-06-13 09:47:27'),
(484, 'bLOOD_UREA_Mg#6d1_#110_-_55#2', 29, '2019-06-13 09:47:27'),
(485, 'rESULT_mg#6d1_#110_-_55#2', 30, '2019-06-13 09:47:27'),
(486, 'rESULT_mEq#61_#13#85_-_5#85#2', 31, '2019-06-13 09:47:27'),
(487, 'rESULT_mEq#61_#1135#6150#2', 32, '2019-06-13 09:47:27'),
(488, 'rESULT_Mg#6d1_#180_-_120#2', 33, '2019-06-13 09:47:28'),
(489, 'rESULT', 34, '2019-05-24 09:34:54'),
(490, 'rESULT_Mg#6d1_#180_-140#2', 35, '2019-06-13 09:47:28'),
(491, 'rESULT_Mg#6d1_#160_-_115#2', 36, '2019-06-13 09:47:28'),
(492, 'rESULT_U#6m_#10_-_12#2', 37, '2019-06-13 09:47:28'),
(493, 'rESULT_U#6m_#10_-12#2', 38, '2019-06-13 09:47:28'),
(494, 'rESULT', 39, '2019-05-24 09:39:45'),
(495, 'aBO_GROUP', 40, '2019-05-25 08:06:38'),
(496, 'rESULT', 41, '2019-05-24 09:41:19'),
(497, 'rESULT', 42, '2019-05-24 09:41:35'),
(498, 'rESULT', 43, '2019-05-24 09:42:17'),
(499, 'rESULT', 44, '2019-05-24 09:42:27'),
(500, 'rESULT', 45, '2019-05-24 09:42:41'),
(501, 'rESULT', 46, '2019-05-24 09:42:50'),
(502, 'rESULT', 47, '2019-05-24 09:43:00'),
(503, 'rESULT_mEq#61_#1135#6150#2', 48, '2019-06-13 09:47:28'),
(504, 'rESULT_g#6D1_Men#7_13_5_-_28#3_Female#7_12_5_-_16', 2, '2019-06-13 09:47:28'),
(505, 'rESULT_#6Mm3_#14000_-_11000#2', 3, '2019-06-13 09:47:28'),
(506, 'aPPEARANCE', 49, '2019-05-25 08:06:38'),
(507, 'rESULT', 50, '2019-05-24 09:59:47'),
(509, 'rESULT', 52, '2019-05-24 10:00:05'),
(510, 'rESULT', 53, '2019-05-24 10:00:14'),
(511, 'rESULT', 51, '2019-05-25 08:06:38'),
(512, 'tOTAL_PROTEIN_mg#6d1#115_-_45#2', 49, '2019-06-13 09:47:28'),
(513, 'gLUCOSE_mg#6d1#150_-_80#2', 49, '2019-06-13 09:47:29'),
(514, 'cHLORIDE_mg#6d1#1120_-_126#2', 49, '2019-06-13 09:47:29'),
(515, 'rESULT', 54, '2019-05-24 11:01:57'),
(516, 'rESULT', 55, '2019-05-24 11:02:13'),
(517, 'rESULT', 56, '2019-05-24 11:02:33'),
(518, 'rESULT', 57, '2019-05-24 11:02:45'),
(519, 'rESULT', 58, '2019-05-24 11:02:57'),
(520, 'rESULT', 59, '2019-05-24 11:03:02'),
(521, 'rESULT', 60, '2019-05-24 11:03:19'),
(522, 'sALMTYPHI__O_', 61, '2019-05-24 11:09:25'),
(523, 'sALMTYPHI__H_', 61, '2019-05-24 11:09:25'),
(524, 'pARATYPHI_A__O_', 61, '2019-05-24 11:09:25'),
(525, 'pARATYPHI_A__H_', 61, '2019-05-24 11:09:25'),
(526, 'pARATYPHI_B__O_', 61, '2019-05-24 11:09:25'),
(527, 'pARATYPHI_B__H_', 61, '2019-05-24 11:09:25'),
(528, 'pARATYPHI_C__O_', 61, '2019-05-24 11:09:25'),
(529, 'pARATYPHI_C__H_', 61, '2019-05-24 11:09:25'),
(530, 'tYPHI_MURIUM__O_', 61, '2019-05-24 11:09:25'),
(531, 'tYPHI_MURIUM__H_', 61, '2019-05-24 11:09:25'),
(532, 'cOMMENT', 61, '2019-05-24 11:09:25'),
(533, 'tIME_EJACULATED', 62, '2019-05-24 11:21:03'),
(534, 'tIME_RECEIVED', 62, '2019-05-24 11:21:03'),
(535, 'tIME_EXAMINED', 62, '2019-05-24 11:21:03'),
(536, 'aPPEARANCE', 62, '2019-05-24 11:21:03'),
(537, 'sPERM_COUNT', 62, '2019-05-24 11:21:03'),
(538, 'sPERM_MORPHOLOGY_MICROSCOPY_REMARK', 62, '2019-05-24 11:21:03'),
(539, 'vOLUME', 62, '2019-05-24 11:21:03'),
(540, 'pH', 62, '2019-05-24 11:21:03'),
(541, 'cOLOUR', 62, '2019-05-24 11:21:03'),
(542, 'oDOUR', 62, '2019-05-24 11:21:03'),
(543, 'vISCOSITY', 62, '2019-05-24 11:21:03'),
(544, 'mOTILITY', 62, '2019-05-24 11:21:03'),
(545, 'pROGRESSIVELY_MOTILE', 62, '2019-05-24 11:21:03'),
(546, 'nON_PROGRESSIVELY_MOTILE', 62, '2019-05-24 11:21:03'),
(547, 'nON_MOTILE', 62, '2019-05-24 11:21:03'),
(548, 'sEMINAL_FLUID_COLLECTED_IN_LAB', 62, '2019-05-24 11:21:03'),
(549, 'rEMARK_RESULT', 62, '2019-05-24 11:21:03'),
(550, 'fORTUM', 62, '2019-05-24 11:21:03'),
(551, 'aMPICILLIN', 62, '2019-05-24 11:21:04'),
(552, 'rUILD', 62, '2019-05-24 11:21:04'),
(553, 'aUGMENTIN', 62, '2019-05-24 11:21:04'),
(554, 'cHLORAMPHENICOL', 62, '2019-05-24 11:21:04'),
(555, 'zINNAT_ZINNACEF', 62, '2019-05-24 11:21:04'),
(556, 'c_SULPHONAMIDES', 62, '2019-05-24 11:21:04'),
(557, 'nORBACTIN', 62, '2019-05-24 11:21:04'),
(558, 'cOLLISTIN_SO', 62, '2019-05-24 11:21:04'),
(559, 'cIPROXIN', 62, '2019-05-24 11:21:04'),
(560, 'tOGAMYCIN', 62, '2019-05-24 11:21:04'),
(561, 'aMOXYCILLIN', 62, '2019-05-24 11:21:04'),
(562, 'aZITHROMYCIN', 62, '2019-05-24 11:21:04'),
(563, 'cLOXACILLIN', 62, '2019-05-24 11:21:04'),
(564, 'cLAFORAN', 62, '2019-05-24 11:21:04'),
(565, 'cLINDAMCIN', 62, '2019-05-24 11:21:04'),
(566, 'eRYTHROMYCIN', 62, '2019-05-24 11:21:04'),
(567, 'dOXO_CYCLIN', 62, '2019-05-24 11:21:04'),
(568, 'nITROFURATION', 62, '2019-05-24 11:21:04'),
(569, 'gENTAMYCIN', 62, '2019-05-24 11:21:04'),
(570, 'aMIKACIN', 62, '2019-05-24 11:21:04'),
(571, 'pEFOXACINE', 62, '2019-05-24 11:21:04'),
(572, 'nALIDIXIC_A', 62, '2019-05-24 11:21:04'),
(573, 'cAPOREX', 62, '2019-05-24 11:21:04'),
(574, 'rECEPHIN', 62, '2019-05-24 11:21:04'),
(575, 'tARIVID', 62, '2019-05-24 11:21:04'),
(576, 'sTREPTOMCIN', 62, '2019-05-24 11:21:04'),
(577, 'sEPTIN', 62, '2019-05-24 11:21:04'),
(578, 'tETRACYLINE', 62, '2019-05-24 11:21:04'),
(579, 'pENICILIN_G', 62, '2019-05-24 11:21:04'),
(580, 'iSOLATE_1', 62, '2019-05-24 11:21:04'),
(581, 'iSOLATE_2', 62, '2019-05-25 08:06:38'),
(582, 'iSOLATE_3', 62, '2019-05-25 08:06:38'),
(583, 'bLOOD_UREA_mg_d1_10_-_55_', 63, '2019-05-24 15:13:10'),
(584, 'sODIUM_mEq_1__135_150_', 63, '2019-05-24 15:13:11'),
(585, 'pOTASSIUM_mEq_1', 63, '2019-05-24 15:13:11'),
(589, 'bLOOD_UREA_mg_d1_10_-_55_', 64, '2019-05-24 15:15:21'),
(590, 'sODIUM_mEq_1__135_150_', 64, '2019-05-24 15:15:21'),
(591, 'pOTASSIUM_mEq_1__3_5_-_5_5_', 64, '2019-05-24 15:15:21'),
(592, 'bICARBONATE_mEq_1__21_-_30_', 64, '2019-05-24 15:15:21'),
(593, 'cHLORIDE_mEq_1__95_-_100_', 64, '2019-05-24 15:15:21'),
(594, 'cREATININE_mEq_1__0_5_-_1_0_', 64, '2019-05-24 15:15:22'),
(595, 'rESULT_male__26_-_63_', 65, '2019-05-24 15:20:03'),
(596, 'rESULT_female__35_-_75_', 65, '2019-05-24 15:20:03'),
(597, 'bLOOD_UREA_mg_d1_135_150_', 66, '2019-05-24 15:26:06'),
(598, 'sODIUM_mEq_1__135_150_', 66, '2019-05-24 15:26:06'),
(599, 'pOTASSIUM_mEq_1__3_5_-_5_5_', 66, '2019-05-24 15:26:06'),
(600, 'bICARBONATE_mEq_1__21_-_30_', 66, '2019-05-24 15:26:06'),
(601, 'cHLORIDE_mEq_1__95_-_100_', 66, '2019-05-24 15:26:06'),
(602, 'tOTAL_PROTEIN_G_d1__6_0_-_8_0_', 67, '2019-05-24 15:32:00'),
(603, 'aLBUMIN_G_d1__3_5_-5_2_', 67, '2019-05-24 15:32:00'),
(604, 'sGOT_U_m__0_-12_', 67, '2019-05-24 15:32:00'),
(605, 'sGPT_U_m__0_-_12_', 67, '2019-05-24 15:32:00'),
(606, 'tOTAL_BILLRUBINM_g_d1__0_1_-_1_0_', 67, '2019-05-24 15:32:00'),
(607, 'cONJUGATED_BILLRUBIN_M_g_d1__0_0_-_0_3_', 67, '2019-05-24 15:32:00'),
(608, 'uNCONJUGATED_BILLRUBIN_M_g_d1__0_1_-_0_5_', 67, '2019-05-24 15:32:00'),
(609, 'aLK_PHOSPATTSE_U_I__73_-_207_', 67, '2019-05-24 15:32:00'),
(610, 'rESULT_mEq_1__4_0_-_8_0_', 68, '2019-05-24 15:35:23'),
(611, 'u_A_APPEARANCE', 69, '2019-05-24 16:01:20'),
(612, 'u_A_COLOUR', 69, '2019-05-24 16:01:20'),
(613, 'u_A_PH', 69, '2019-05-24 16:01:20'),
(614, 'u_A_PROTEIN', 69, '2019-05-24 16:01:20'),
(615, 'u_A_SUGAR', 69, '2019-05-24 16:01:20'),
(616, 'u_A_KETONE', 69, '2019-05-24 16:01:20'),
(617, 'uRINE_SPECIFIC_GRAVITY', 69, '2019-05-24 16:01:20'),
(618, 'u_A_BILLS_SALTS', 69, '2019-05-24 16:01:20'),
(619, 'u_A_UROBILINOGEN', 69, '2019-05-24 16:01:21'),
(620, 'u_A_ASCIRBIC_ACID', 69, '2019-05-24 16:01:21'),
(621, 'u_A_NITRITE', 69, '2019-05-24 16:01:21'),
(622, 'u_A_BLOOD', 69, '2019-05-24 16:01:21'),
(623, 'u_A_BILLRUBIN', 69, '2019-05-24 16:01:21'),
(624, 'aBO_GROUP', 69, '2019-05-24 16:01:21'),
(625, 'rH', 69, '2019-05-24 16:01:21'),
(626, 'hIV_1_2', 69, '2019-05-24 16:01:21'),
(627, 'hBSAG', 69, '2019-05-24 16:01:21'),
(628, 'rESULT_mEq_1__4_0_-_8_0_', 70, '2019-05-24 16:02:55'),
(629, 'aPPEARANCE', 71, '2019-05-24 16:05:44'),
(630, 'oVA', 71, '2019-05-24 16:05:44'),
(631, 'cYSTS', 71, '2019-05-24 16:05:44'),
(632, 'wBC', 71, '2019-05-24 16:05:44'),
(633, 'lARVAE', 71, '2019-05-24 16:05:44'),
(634, 'pARASITES', 71, '2019-05-24 16:05:44'),
(635, 'rESULT', 72, '2019-05-24 16:06:55'),
(636, 'pCV____Men__40_-_54__Female__36_-_47_', 73, '2019-05-24 16:18:30'),
(637, 'tOTAL_WBC__Mm3__4000_-_11000_', 73, '2019-05-24 16:18:30'),
(638, 'nEUTROPHIL___45_-_70_', 73, '2019-05-24 16:18:30'),
(639, 'lYMPHOCYTE___25_-_40_', 73, '2019-05-24 16:18:30'),
(640, 'eOSINOPHIL___0_-_6_', 73, '2019-05-24 16:18:30'),
(641, 'bASAPHIL___0_-_1_', 73, '2019-05-24 16:18:30'),
(642, 'mONOCYTE', 73, '2019-05-24 16:18:30'),
(643, 'bLOOD_FILM_COMMENT', 73, '2019-05-24 16:18:30'),
(644, 'tOTAL_BILLRUBIN_M_g_d1__0_1_-_1_0_', 74, '2019-05-24 16:22:00'),
(645, 'cONJUGATED_BILLRUBIN_M_g_d1__0_0_-_0_3_', 74, '2019-05-24 16:22:00'),
(646, 'uNCONJUGATED_BILLRUBIN_M_g_d1__0_1_-_0_5_', 74, '2019-05-24 16:22:00'),
(647, 'tOTAL_PROTEIN_G_d1__6_0_-_8_0_', 75, '2019-05-24 16:23:16'),
(649, 'sERUM_CREATININE_mEq#61_#10#85_-_1#80#2', 29, '2019-06-13 09:47:29'),
(651, 'rESULT', 76, '2019-05-24 17:07:33'),
(652, 'pCV____Men__40_-_54__Female__36_-_47_', 77, '2019-05-24 17:38:06'),
(653, 'aBO_GROUP', 77, '2019-05-24 17:38:06'),
(654, 'rH', 77, '2019-05-24 17:38:06'),
(655, 'hEPATITIS_B', 77, '2019-05-24 17:38:06'),
(656, 'u_A_APPEARANCE', 77, '2019-05-24 17:38:06'),
(657, 'u_A_COLOUR', 77, '2019-05-24 17:38:06'),
(658, 'u_A_PH', 77, '2019-05-24 17:38:06'),
(659, 'u_A_PROTEIN', 77, '2019-05-24 17:38:06'),
(660, 'u_A_SUGAR', 77, '2019-05-24 17:38:06'),
(661, 'u_A_KETONE', 77, '2019-05-24 17:38:06'),
(662, 'uRINE_SPECIFIC_GRAVITY', 77, '2019-05-24 17:38:06'),
(663, 'u_A_BILLS_SALTS', 77, '2019-05-24 17:38:06'),
(664, 'u_A_UROBILINOGEN', 77, '2019-05-24 17:38:06'),
(665, 'u_A_ASCRIBIC_ACID', 77, '2019-05-24 17:38:06'),
(666, 'u_A_NITRITE', 77, '2019-05-24 17:38:06'),
(667, 'u_A_BLOOD', 77, '2019-05-24 17:38:06'),
(668, 'u_A_BILLRUBIN', 77, '2019-05-24 17:38:06'),
(669, 'hIV_1_2', 77, '2019-05-24 17:38:06'),
(670, 'rESULT__+', 78, '2019-05-25 08:06:38'),
(671, 'rESULT_-', 78, '2019-05-24 17:39:56'),
(672, 'rESULT__', 79, '2019-05-24 17:41:14'),
(673, 'rESULT_-', 79, '2019-05-24 17:41:14'),
(674, 'rESULT', 80, '2019-05-24 17:42:28'),
(675, 'rESULT', 80, '2019-05-24 17:42:28'),
(676, 'rESULT', 80, '2019-05-24 17:42:28'),
(677, 'rESULT', 80, '2019-05-24 17:42:28'),
(678, 'rESULT', 80, '2019-05-24 17:42:28'),
(679, 'rESULT', 80, '2019-05-24 17:42:28'),
(680, 'rESULT', 81, '2019-05-24 17:44:05'),
(681, 'fORTUM', 82, '2019-05-24 18:00:03'),
(682, 'aMPICILLIN', 82, '2019-05-24 18:00:03'),
(683, 'rUILD', 82, '2019-05-24 18:00:03'),
(684, 'aUGMENTIN', 82, '2019-05-24 18:00:03'),
(685, 'cHLORAMPHENICOL', 82, '2019-05-24 18:00:03'),
(686, 'zINNAT_ZINNACEF', 82, '2019-05-24 18:00:03'),
(687, 'c_SULPHONAMIDES', 82, '2019-05-24 18:00:03'),
(688, 'nORBACTIN', 82, '2019-05-24 18:00:03'),
(689, 'cOLLISTIN_SO', 82, '2019-05-24 18:00:03'),
(690, 'cIPROXIN', 82, '2019-05-24 18:00:03'),
(691, 'tOGAMYCIN', 82, '2019-05-25 08:06:38'),
(692, 'aMOXYCILLIN', 82, '2019-05-24 18:00:03'),
(693, 'aZITHROMYCIN', 82, '2019-05-24 18:00:03'),
(694, 'cLOXACILLIN', 82, '2019-05-24 18:00:03'),
(695, 'cLAFORAN', 82, '2019-05-24 18:00:04'),
(696, 'cLINDAMCIN', 82, '2019-05-24 18:00:04'),
(697, 'eRYTHROMYCIN', 82, '2019-05-25 08:06:38'),
(698, 'dOXO_CYCLIN', 82, '2019-05-24 18:00:04'),
(699, 'nITROFURATION', 82, '2019-05-24 18:00:04'),
(700, 'gENTAMYCIN', 82, '2019-05-24 18:00:04'),
(701, 'aMIKACIN', 82, '2019-05-24 18:00:04'),
(702, 'pEFOXACINE', 82, '2019-05-24 18:00:04'),
(703, 'nALIDIXIC_A', 82, '2019-05-25 08:06:38'),
(704, 'cAPOREX', 82, '2019-05-24 18:00:04'),
(705, 'rECEPHIN', 82, '2019-05-24 18:00:04'),
(706, 'tARIVID', 82, '2019-05-24 18:00:04'),
(707, 'sTREPTOMCIN', 82, '2019-05-24 18:00:04'),
(708, 'sEPTIN', 82, '2019-05-24 18:00:04'),
(709, 'tETRACYLINE', 82, '2019-05-24 18:00:04'),
(710, 'pENICILIN_G', 82, '2019-05-24 18:00:04'),
(711, 'ePITH_CELLS', 82, '2019-05-24 18:00:04'),
(712, 'pUS_CELLS', 82, '2019-05-25 08:06:38'),
(713, 'rBCS', 82, '2019-05-25 08:06:38'),
(714, 'bACTERIA', 82, '2019-05-25 08:06:38'),
(715, 't_VAGINALIS', 82, '2019-05-25 08:06:38'),
(716, 'yEAST_LIKE_CELLS', 82, '2019-05-25 08:06:38'),
(717, 'iSOLATE_1', 82, '2019-05-24 18:00:04'),
(718, 'iSOLATE_2', 82, '2019-05-24 18:00:04'),
(719, 'iSOLATE_3', 82, '2019-05-24 18:00:04'),
(720, 'rH', 40, '2019-05-25 08:06:38'),
(721, 'rESULT_+', 40, '2019-05-25 08:06:38'),
(722, 'rESULT_-', 40, '2019-05-25 08:06:38'),
(723, 'hEPATITIS_BSAG', 40, '2019-05-25 08:06:39'),
(724, 'hIV_1&2', 40, '2019-05-25 08:06:39'),
(725, 'pCV_#9#1Men#7_40-54#3_Female#7_36-47#2', 40, '2019-06-13 09:47:29'),
(726, 'hEPATITIS_C', 40, '2019-05-25 08:06:39'),
(727, 'rESULT__', 83, '2019-05-24 18:23:00'),
(728, 'rESULT_-', 83, '2019-05-24 18:23:00'),
(729, 'hEPATITIS_BSAG', 83, '2019-05-24 18:23:00'),
(730, 'hIV_1_2', 83, '2019-05-24 18:23:00'),
(731, 'pCV___Men__40-54__Female__36-47_', 83, '2019-05-25 08:06:39'),
(732, 'hEPATITIS_C', 83, '2019-05-24 18:23:00'),
(733, 'test_(50_-65)%_AND_(2|3_-_3|4)', 64, '2019-07-30 15:57:58'),
(734, 'test_(50_-65)%_>_(2|3_-_3|4)M/dm3', 64, '2019-07-30 15:57:58'),
(735, 'test_(50_-65)%_>_(2|3_-_3|4)M/dm3', 64, '2019-07-30 15:57:58'),
(741, '', 84, '2019-10-09 10:15:50'),
(742, 'HCV', 77, '2019-10-15 13:33:27'),
(743, 'MID%', 1, '2019-11-19 07:30:55'),
(744, 'fBC___PLATLET_MP', 85, '2019-11-19 10:23:20'),
(745, 'fBC___PLATLET___MP', 86, '2019-11-19 10:23:32'),
(746, 'HBg/dl', 86, '2019-11-21 13:52:49'),
(748, '', 88, '2019-11-22 09:46:27'),
(749, '', 89, '2019-11-22 09:46:27'),
(750, 'wBC_total_count_', 90, '2019-11-22 09:47:25'),
(751, 'FBS', 87, '2019-11-22 09:51:42'),
(752, '2HPP', 87, '2019-11-22 09:54:10'),
(769, 'PCV %', 86, '2019-11-29 12:25:57'),
(770, 'WBC mm3', 86, '2019-11-29 12:30:11'),
(771, 'LYMPHOCYTES %', 86, '2019-11-29 12:33:00'),
(772, 'EOSINOPHILS %', 86, '2019-11-29 12:34:17'),
(773, 'MONOCYTES %', 86, '2019-11-29 12:34:43'),
(774, 'BASOPHILS %', 86, '2019-11-29 12:35:07'),
(775, 'RBC MIL/mm3', 86, '2019-11-29 12:35:30'),
(776, 'PLATELETS mm3', 86, '2019-11-29 12:35:59'),
(777, 'result', 91, '2019-12-11 15:09:53'),
(778, '', 74, '2020-05-14 10:17:46'),
(779, 'NEUTROPHILS', 86, '2020-05-18 12:38:20'),
(780, 'pOSITIVE', 92, '2020-06-11 08:44:07'),
(781, 'nEGATIVE', 92, '2020-06-11 08:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `lab_temp_name`
--

CREATE TABLE `lab_temp_name` (
  `id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lab_test_type_id` int(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lab_temp_name`
--

INSERT INTO `lab_temp_name` (`id`, `name`, `lab_test_type_id`, `date_added`) VALUES
(1, 'FBC', 0, '2019-05-24 00:01:24'),
(2, 'HB', 0, '2019-05-24 16:40:06'),
(3, 'PCV(%)', 0, '2020-09-17 06:40:34'),
(5, 'BLOOD GROUP', 0, '2019-05-24 00:14:40'),
(6, 'URINE M.C.S', 0, '2019-05-24 00:28:36'),
(7, 'URINE ANALYSIS', 0, '2019-05-24 00:31:48'),
(8, 'THROAT SWAB', 0, '2019-05-24 00:43:54'),
(9, 'SPUTUM M.C.S', 0, '2019-05-24 01:28:06'),
(10, 'URETHRAL SWAB', 0, '2019-05-24 00:45:05'),
(11, 'WOUND SWAB', 0, '2019-05-24 00:45:18'),
(12, 'EAR SWAB', 0, '2019-05-24 00:45:28'),
(13, 'EYE SWAB', 0, '2019-05-24 00:45:38'),
(14, 'RECTAL SWAB', 0, '2019-05-24 00:45:56'),
(15, 'ASPIRATE', 0, '2019-05-24 00:46:07'),
(16, 'NASAL SWAB', 0, '2019-05-24 00:47:16'),
(17, 'HVS M.C.S', 0, '2019-05-24 01:02:13'),
(18, 'ECS M.C.S', 0, '2019-05-24 01:02:03'),
(19, 'STOOL R/E', 0, '2019-05-24 01:06:13'),
(20, 'SEMINAL FLUID ANALYSIS', 0, '2019-05-24 01:07:27'),
(23, 'LDL CHOLESTEROL', 0, '2019-05-24 02:20:02'),
(24, 'URINE MICROSCOPY', 0, '2019-05-24 02:24:20'),
(25, 'CALCIUM', 0, '2019-05-24 02:25:16'),
(26, 'TOTAL CHOLESTEROL', 0, '2019-05-24 02:25:33'),
(27, 'TRIGLYCERIDES', 0, '2019-05-24 02:25:49'),
(28, 'SERUM CREATININE mEq/1(4.0 - 8.0)', 0, '2019-05-24 16:46:45'),
(29, 'BLOOD UREA + SERUM CREATININE', 0, '2019-05-24 02:26:27'),
(30, 'BLOOD UREA', 0, '2019-05-24 02:27:05'),
(31, 'POTASSIUM', 0, '2019-05-24 02:27:16'),
(32, 'SODIUM', 0, '2019-05-24 02:27:21'),
(33, '2HOURS POST PRANDIAL', 0, '2019-05-24 09:34:29'),
(34, 'RBS', 0, '2019-05-24 09:34:53'),
(36, 'FASTING BLOOD SUGAR', 0, '2019-05-24 09:35:16'),
(37, 'SGOT', 0, '2019-05-24 09:39:27'),
(38, 'SGPT', 0, '2019-05-24 09:39:34'),
(39, 'PREGNANCY TEST', 0, '2019-05-24 09:39:45'),
(40, 'BLOOD GROUPING + CROSS MATCHING', 0, '2019-05-24 09:40:13'),
(41, 'GENOTYPE', 0, '2019-05-24 09:41:19'),
(42, 'SKIN SNIP', 0, '2019-05-24 09:41:35'),
(43, 'MALARIA PARASITE', 0, '2019-05-24 09:42:17'),
(44, 'URINE ANALYSIS', 0, '2019-05-24 09:42:27'),
(45, 'SEMINAL FLUID ANALYSIS', 0, '2019-05-24 09:42:41'),
(46, 'STOOL R/E', 0, '2019-05-24 09:42:50'),
(48, 'SODIUM', 0, '2019-05-24 09:54:42'),
(49, 'CEREBROSPINAL FLUID', 0, '2019-05-24 10:14:33'),
(50, 'P.S.A', 0, '2019-05-24 09:59:47'),
(51, 'E.S.R', 0, '2019-05-24 09:59:57'),
(52, 'PCV(%)', 0, '2020-09-17 06:40:14'),
(53, 'HB', 0, '2019-05-24 10:00:14'),
(54, 'SPUTUM AFB', 0, '2019-05-24 11:01:57'),
(55, 'HIV 1&2', 0, '2019-05-24 11:02:13'),
(56, 'STOOL: OCCULT BLOOD', 0, '2019-05-24 11:02:33'),
(57, 'H. PYLORI', 0, '2019-05-24 11:02:45'),
(58, 'HEPATITIS B', 0, '2019-05-24 11:02:57'),
(59, 'HEPATITIS C', 0, '2019-05-24 11:03:02'),
(60, 'RHEUMATIOD FACTOR', 0, '2019-05-24 11:03:19'),
(61, 'WIDAL TEST', 0, '2019-05-24 11:09:25'),
(62, 'SEMINAL FLUID M.C.S', 0, '2019-05-24 11:21:03'),
(64, 'E/U/CR', 0, '2019-05-24 15:15:21'),
(65, 'HDL CHOLESTEROL', 0, '2019-05-24 15:20:03'),
(66, 'ELECTROLYSTE', 0, '2019-05-24 15:26:06'),
(67, 'LFT', 0, '2019-05-24 15:32:00'),
(68, 'URIC ACID', 0, '2019-05-24 15:35:23'),
(69, 'ANC ROUTINE (PCV, U/A, BG, RVS & HBSAG)', 0, '2019-05-24 16:01:20'),
(70, 'URIC ACID', 0, '2019-05-24 16:02:55'),
(71, 'STOOL MICROSCOPY', 0, '2019-05-24 16:05:44'),
(72, 'HEP B SAG', 0, '2019-05-24 16:06:55'),
(73, 'WBC + DIFF. COUNT', 0, '2019-05-24 16:18:30'),
(74, 'SERIUM BILIRUBIN', 0, '2019-05-24 16:22:00'),
(75, 'SERIUM PROTEIN', 0, '2019-05-24 16:23:16'),
(76, 'HEPATITIS A', 0, '2019-05-24 17:07:33'),
(77, 'ANTENATAL SCREENING', 0, '2019-05-24 17:38:06'),
(78, 'VDRL', 0, '2019-05-24 17:39:56'),
(79, 'CHLAMYDIA ASSAY', 0, '2019-05-24 17:41:14'),
(80, 'ASCITIC FLUID', 0, '2019-05-24 17:42:28'),
(81, 'RHEUMATIOD FACTOR', 0, '2019-05-24 17:44:05'),
(82, 'BLOOD CULTURE', 0, '2019-05-24 18:00:03'),
(83, 'CROSS MATCHING', 0, '2019-05-24 18:23:00'),
(84, 'ESR', 0, '2019-10-09 09:46:21'),
(86, 'FBC + PLATLET +MP', 0, '2019-11-19 10:23:32'),
(87, 'FBS + 2HPP', 0, '2019-11-21 14:51:19'),
(89, 'FBC', 0, '2020-09-16 15:54:40'),
(90, 'WBC(total count)', 0, '2019-11-22 09:47:25'),
(91, 'Alkaline Phosphatase', 0, '2019-12-11 15:09:53'),
(92, 'RVS', 0, '2020-06-11 08:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `lab_test`
--

CREATE TABLE `lab_test` (
  `lab_test_id` int(11) NOT NULL,
  `lab_test` varchar(200) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `lab_test_type_id` int(11) NOT NULL,
  `template` int(11) NOT NULL,
  `normal_range` longtext NOT NULL,
  `normal_value` longtext NOT NULL,
  `reference_range` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_test`
--

INSERT INTO `lab_test` (`lab_test_id`, `lab_test`, `fee`, `lab_test_type_id`, `template`, `normal_range`, `normal_value`, `reference_range`) VALUES
(1, 'FBC', '2700.00', 1, 1, '', '', ''),
(2, 'HB', '800.00', 1, 2, '', 'G/d1', ''),
(3, 'PCV', '800.00', 1, 3, '', '%', ''),
(4, 'ESR', '700.00', 1, 51, '', 'Mm/hr', ''),
(5, 'BLOOD GROUP', '500.00', 1, 5, '', '', ''),
(6, 'P.S.A', '10500.00', 1, 50, '', '', ''),
(7, 'URINE M.C.S', '1500.00', 3, 6, '', '', ''),
(8, 'URINE ANALYSIS', '800.00', 3, 7, '', '', ''),
(9, 'THROAT SWAB', '1500.00', 3, 8, '', '', ''),
(10, 'SPUTUM M.C.S', '1500.00', 3, 9, '', '', ''),
(11, 'URETHRAL SWAB', '1500.00', 3, 10, '', '', ''),
(12, 'HVS M.C.S', '1500.00', 3, 17, '', '', ''),
(13, 'ECS M.C.S', '1500.00', 3, 18, '', '', ''),
(14, 'WOUND SWAB', '1500.00', 1, 11, '', '', ''),
(15, 'ASPIRATE', '1500.00', 3, 15, '', '', ''),
(16, 'CEREBROSPINAL FLUID', '2500.00', 3, 49, '', '', ''),
(17, 'NASAL SWAB', '1500.00', 3, 16, '', '', ''),
(18, 'STOOL R/E', '800.00', 3, 19, '', '', ''),
(19, 'SEMINAL FLUID ANALYSIS', '1500.00', 3, 20, '', '', ''),
(20, 'URINE ANALYSIS', '800.00', 3, 7, '', '', ''),
(21, 'MALARIA PARASITE', '800.00', 4, 43, '', '', ''),
(22, 'SKIN SNIP', '1000.00', 3, 42, '', '', ''),
(23, 'GENOTYPE', '1500.00', 1, 41, '', '', ''),
(24, 'BLOOD GROUPING + CROSS MATCHING', '6000.00', 1, 40, '', '', ''),
(25, 'PREGNANCY TEST', '1000.00', 3, 39, '', '', ''),
(26, 'SGOT', '3000.00', 2, 37, '', '', ''),
(27, 'SGPT', '3000.00', 2, 38, '', '', ''),
(28, 'FASTING BLOOD SUGAR', '800.00', 2, 36, '', '', ''),
(29, 'RANDOM BLOOD SUGAR', '800.00', 2, 34, '', '', ''),
(30, '2HOURS POST PRANDIAL', '1000.00', 2, 33, '', '', ''),
(31, 'SODIUM', '1000.00', 2, 48, '', '', ''),
(32, 'POTASSIUM', '1000.00', 2, 31, '', '', ''),
(33, 'BLOOD UREA', '2000.00', 2, 30, '', '', ''),
(35, 'SERUM CREATININE', '2000.00', 2, 28, '', '', ''),
(36, 'TRIGLYCERIDES', '2500.00', 2, 27, '', '', ''),
(38, 'CALCIUM', '3000.00', 2, 25, '', '', ''),
(39, 'URINE MICROSCOPY', '800.00', 3, 24, '', '', ''),
(40, 'LDL CHOLESTEROL', '3000.00', 2, 23, '', '', ''),
(41, 'HDL CHOLESTEROL', '3000.00', 2, 65, '', '', ''),
(43, 'WIDAL TEST', '1000.00', 3, 61, '', '', ''),
(44, 'SPUTUM AFB', '3000.00', 3, 54, '', '', ''),
(45, 'HIV 1&2', '1500.00', 3, 55, '', '', ''),
(46, 'STOOL: OCCULT BLOOD', '2000.00', 4, 56, '', '', ''),
(47, 'H. PYLORI', '3000.00', 3, 57, '', '', ''),
(48, 'HEPATITIS A', '1000.00', 3, 76, '', '', ''),
(49, 'HEPATITIS B', '1500.00', 3, 58, '', '', ''),
(50, 'HEPATITIS C', '1500.00', 3, 59, '', '', ''),
(51, 'RHEUMATOID  FACTOR', '1000.00', 4, 60, '', '', ''),
(52, 'SEMINAL FLUID M.C.S', '2000.00', 3, 62, '', '', ''),
(53, 'CROSS MATCHING', '6000.00', 1, 83, '', '', ''),
(54, 'WBC (DIFF. COUNT)', '800.00', 1, 73, '', '', ''),
(55, 'ANTENATAL SCREENING', '3500.00', 1, 77, '', '', ''),
(56, 'ELECTROLYTES', '4000.00', 2, 66, '', '', 'sODIUM     130 - 145  mmol/L; POTASSIUM   3.0 - 5.0  mmol/L;  CHLORIDE   98 - 110  mmol/L;  BICARBONATE  20 - 30 mmol/L'),
(58, 'SERUM PROTEIN', '3000.00', 2, 75, '', '', ''),
(59, 'E/U/CR', '6000.00', 2, 64, '', '', ''),
(60, 'SERUM BILIRUBIN', '3000.00', 2, 74, '', '', ''),
(61, 'URIC ACID', '3000.00', 2, 68, '', '', ''),
(62, 'BLOOD CULTURE', '6500.00', 3, 82, '', '', ''),
(63, 'ASCITIC FLUID', '2500.00', 3, 80, '', '', ''),
(64, 'VDRL', '1500.00', 2, 78, '', '', ''),
(66, 'CHLAMYDIA ASSAY', '6500.00', 2, 79, '', '', ''),
(67, 'HEP B SAG', '1500.00', 2, 72, '', '', ''),
(68, 'STOOL MICROSCOPY', '800.00', 4, 71, '', '', ''),
(71, 'ANC ROUTINE (PCV, U/A, BG, RVS & HBSAG)', '6600.00', 4, 69, '', '', ''),
(72, 'LFT', '6000.00', 2, 67, '', '', ''),
(73, 'ESR', '700.00', 1, 84, '', '', 'm : 3-5, F : 4-7  (mm/hr)'),
(74, 'FBC + PLATLET +MP', '3500.00', 1, 86, '', '', ''),
(75, 'WBC', '1000.00', 1, 90, '', '', ''),
(76, 'FBS + 2HPP', '1600.00', 2, 87, '', '', ''),
(77, 'Alkaline Phosphatase', '3500.00', 2, 91, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', ''),
(0, 'RVS', '1500.00', 7, 55, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `lab_test_type`
--

CREATE TABLE `lab_test_type` (
  `lab_test_type_id` int(11) NOT NULL,
  `lab_test_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_test_type`
--

INSERT INTO `lab_test_type` (`lab_test_type_id`, `lab_test_type`) VALUES
(6, '2000'),
(2, 'CHEMICAL PATHOLOGY'),
(1, 'HAEMATOLOGY'),
(5, 'Homonal Assay'),
(3, 'MICROBIOLOGY'),
(4, 'PARASITOLOGY'),
(7, 'SEROLOGY');

-- --------------------------------------------------------

--
-- Table structure for table `ledger_temp`
--

CREATE TABLE `ledger_temp` (
  `id` int(11) NOT NULL,
  `ref` longtext NOT NULL,
  `jmt` longtext NOT NULL,
  `description` longtext NOT NULL,
  `debit` bigint(20) NOT NULL,
  `credit` bigint(20) NOT NULL,
  `balance` int(11) NOT NULL,
  `date_ref` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `module_name` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`) VALUES
(1, 'opd'),
(2, 'ipd'),
(3, 'lab'),
(4, 'pharmacy'),
(5, 'accounts'),
(6, 'billing'),
(7, 'consultation'),
(8, 'duty_roster'),
(9, 'ward'),
(10, 'theatre'),
(11, 'physiotherapy'),
(12, 'radiography');

-- --------------------------------------------------------

--
-- Table structure for table `morgue_beds`
--

CREATE TABLE `morgue_beds` (
  `id` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `name` text NOT NULL,
  `charge` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `morgue_beds`
--

INSERT INTO `morgue_beds` (`id`, `room`, `name`, `charge`, `description`, `status`) VALUES
(1, 2, 'Test', 5000, 'Yes', 0),
(2, 2, 'there', 1000, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `morgue_bed_types`
--

CREATE TABLE `morgue_bed_types` (
  `id` int(11) NOT NULL,
  `types` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `morgue_bed_types`
--

INSERT INTO `morgue_bed_types` (`id`, `types`) VALUES
(1, 'VIP'),
(2, 'Regular');

-- --------------------------------------------------------

--
-- Table structure for table `morgue_bills`
--

CREATE TABLE `morgue_bills` (
  `id` int(11) NOT NULL,
  `corpse_id` int(11) NOT NULL,
  `charge` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `addedby` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `morgue_charges`
--

CREATE TABLE `morgue_charges` (
  `id` int(11) NOT NULL,
  `charge` text NOT NULL,
  `amount` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `morgue_charges`
--

INSERT INTO `morgue_charges` (`id`, `charge`, `amount`, `added_by`, `date_added`, `updatedby`, `date_updated`) VALUES
(1, 'Washing', 29000, 2, '2020-08-30 15:25:49', 0, '2020-08-30 15:31:12'),
(2, 'dressing', 12000, 2, '2020-08-31 04:18:06', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `morgue_index`
--

CREATE TABLE `morgue_index` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `sex` varchar(10) NOT NULL,
  `tag_number` varchar(255) NOT NULL,
  `serial_number` text NOT NULL,
  `rel_name` varchar(255) NOT NULL,
  `rel_phone` varchar(20) NOT NULL,
  `rel_address` text NOT NULL,
  `rel_rel` varchar(200) NOT NULL,
  `room` int(11) NOT NULL,
  `bed` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `note` longtext NOT NULL,
  `ipd_numb` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(50) NOT NULL,
  `to_staff` varchar(255) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `visitor` text NOT NULL,
  `appointment_id` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `link` longtext NOT NULL,
  `status` int(2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `strikes` int(11) NOT NULL,
  `timer_notify` datetime NOT NULL,
  `time_taken` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `staff_id`, `to_staff`, `patient_id`, `visitor`, `appointment_id`, `message`, `link`, `status`, `type`, `strikes`, `timer_notify`, `time_taken`) VALUES
(1, '97', '', 0, 'Milla NOAH kENH', '', 'You Have A Visitor', 'vlog?id=2&nid=1&nstat=1', 1, '', 1, '0000-00-00 00:00:00', '2020-09-24 10:25:50'),
(2, 'front_desk', '', 0, 'Milla NOAH kENH', '', 'Remark Made Concerning Visit', 'visitor_note?id=2&nid=2&nstat=1', 1, '', 1, '0000-00-00 00:00:00', '2020-09-24 10:26:43'),
(3, '67', '', 0, 'Milla NOAH kENH', '', 'Your Visitor\'s Entry Was Updated', 'vlog?id=2&nid=3&nstat=1', 0, '', 0, '0000-00-00 00:00:00', '2020-09-24 10:27:49'),
(4, '97', '', 0, 'Jane Milla', '', 'You Have A Visitor', 'vlog?id=3&nid=4&nstat=1', 1, '', 1, '0000-00-00 00:00:00', '2020-09-24 21:41:32'),
(5, 'front_desk', '', 0, 'Jane Milla', '', 'Remark Made Concerning Visit', 'visitor_note?id=3&nid=5&nstat=1', 1, '', 1, '0000-00-00 00:00:00', '2020-09-24 21:47:36'),
(6, 'front_desk', '', 0, 'Jane Milla', '', 'Remark Made Concerning Visit', 'visitor_note?id=3&nid=6&nstat=1', 0, '', 0, '0000-00-00 00:00:00', '2020-09-25 08:08:03'),
(7, 'front_desk', '', 0, 'Jane Milla', '', 'Remark Made Concerning Visit', 'visitor_note?id=3&nid=7&nstat=1', 0, '', 0, '0000-00-00 00:00:00', '2020-09-25 08:11:10'),
(8, 'front_desk', '', 0, 'Oghenekaro Favour', '', 'Remark Made Concerning Visit', 'visitor_note?id=1&nid=8&nstat=1', 0, '', 0, '0000-00-00 00:00:00', '2020-09-25 08:13:27'),
(9, 'front_desk', '', 0, 'Milla NOAH kENH', '', 'Remark Made Concerning Visit', 'visitor_note?id=2&nid=9&nstat=1', 0, '', 0, '0000-00-00 00:00:00', '2020-09-25 08:13:57'),
(10, 'front_desk', '', 0, 'Jane Milla', '', 'Remark Made Concerning Visit', 'visitor_note?id=3&nid=10&nstat=1', 1, '', 2, '2020-09-25 08:44:06', '2020-09-25 08:14:06'),
(11, 'Nurses', '', 0, '1', '', 'New Appointment Created: ', 'vitals?nid=11&nstat=1', 0, '', 0, '0000-00-00 00:00:00', '2020-09-25 08:27:03'),
(12, 'Nurses', '', 0, '4', '', 'New Appointment Created: ', 'vitals?nid=12&nstat=1', 0, '', 0, '0000-00-00 00:00:00', '2020-09-25 08:31:02'),
(13, 'Nurses', '', 0, '4', '', 'New Appointment Created: ', 'vitals?nid=13&nstat=1', 0, '', 0, '0000-00-00 00:00:00', '2020-09-25 19:31:41'),
(14, 'Nurses', '', 0, '3', '', 'New Appointment Created: ', 'vitals?nid=14&nstat=1', 0, '', 0, '0000-00-00 00:00:00', '2020-09-26 21:23:19'),
(15, '97', '', 0, '1', '', 'You Have A New Appointment', 'lab_results?id=1&p=1&nid=15&nstat=1', 0, '', 0, '0000-00-00 00:00:00', '2020-09-26 21:24:39'),
(16, '86', '', 0, '4', '', 'You Have A New Appointment', 'lab_results?id=2&p=4&nid=16&nstat=1', 0, '', 0, '0000-00-00 00:00:00', '2020-09-26 21:25:06'),
(17, '86', '', 0, '4', '', 'You Have A New Appointment', 'lab_results?id=3&p=4&nid=17&nstat=1', 0, '', 0, '0000-00-00 00:00:00', '2020-09-30 18:33:47'),
(18, '97', '', 0, '3', '', 'You Have A New Appointment', 'lab_results?id=4&p=3&nid=18&nstat=1', 0, '', 0, '0000-00-00 00:00:00', '2020-09-30 18:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `id` int(11) NOT NULL,
  `note` longtext NOT NULL,
  `surgery_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `other_income`
--

CREATE TABLE `other_income` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `amt` int(11) NOT NULL,
  `code` text NOT NULL,
  `type` int(11) NOT NULL,
  `approver` text NOT NULL,
  `cash_bank` text NOT NULL,
  `comment` longtext NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `patient_type` int(11) NOT NULL DEFAULT '1',
  `front_desk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `a_and_e` text COLLATE utf8_unicode_ci NOT NULL,
  `reg_num` longtext COLLATE utf8_unicode_ci NOT NULL,
  `card_pay` int(11) NOT NULL DEFAULT '0' COMMENT '0=unpaid,1=paid',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `surname` longtext COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `first_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `card_type` int(11) NOT NULL,
  `company_id` int(255) NOT NULL,
  `family_id` int(11) NOT NULL,
  `tariff` int(11) NOT NULL,
  `sex` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `city` longtext COLLATE utf8_unicode_ci NOT NULL,
  `state` longtext COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ethnic` longtext COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `national_id` int(11) NOT NULL,
  `insurance_type_id` int(11) NOT NULL,
  `nhis_num` int(11) NOT NULL,
  `enrollee_num` int(11) NOT NULL COMMENT 'HMO or Enrollee number',
  `Enr` int(11) NOT NULL,
  `contact_method_id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `age_type` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tel_one` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tel_two` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_kin` longtext COLLATE utf8_unicode_ci NOT NULL,
  `rel_of_kin` longtext COLLATE utf8_unicode_ci NOT NULL,
  `next_kin_phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `next_kin_address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `photo` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `patient_type`, `front_desk`, `a_and_e`, `reg_num`, `card_pay`, `title`, `surname`, `middle_name`, `first_name`, `card_type`, `company_id`, `family_id`, `tariff`, `sex`, `blood_group`, `address`, `city`, `state`, `religion`, `ethnic`, `nationality`, `national_id`, `insurance_type_id`, `nhis_num`, `enrollee_num`, `Enr`, `contact_method_id`, `age`, `age_type`, `dob`, `tel_one`, `tel_two`, `email`, `mobile`, `name_of_kin`, `rel_of_kin`, `next_kin_phone`, `next_kin_address`, `photo`, `status`, `date_added`) VALUES
(1, 1, '5f6c675b7c598', '', 'REF 232', 1, 'Mr', 'Pitrus', 'Karoake', 'James', 0, 0, 0, 0, 'Male', 'O-', '124 egor benin', 'Benin', 'Edo', 'Nine', 'Benin', 'Nigerian', 0, 0, 0, 0, 0, 1, 0, 'Elder', '', '09032536799', '09032536799', 'horsemantechnologies@gmail.com', '09032536799', 'Sarah Pitrus', 'brother', '09032536799', '123 ekehuan road', '', 0, '2020-09-24 09:31:07'),
(2, 1, '5f6c676d1f6fc', '', 'REF 232', 1, 'Mr', 'Pitrus', 'Karoake', 'James', 0, 0, 0, 0, 'Male', 'O-', '124 egor benin', 'Benin', 'Edo', 'Nine', 'Benin', 'Nigerian', 0, 0, 0, 0, 0, 1, 0, 'Elder', '2020-09-04', '09032536799', '09032536799', 'horsemantechnologies@gmail.com', '09032536799', 'Sarah Pitrus', 'brother', '09032536799', '123 ekehuan road', '', 0, '2020-09-24 09:31:25'),
(3, 1, '5f6c6789324bc', '', 'REF 232', 1, 'Mr', 'Pitrus', 'Karoake', 'James', 0, 0, 0, 0, 'Male', 'O-', '124 egor benin', 'Benin', 'Edo', 'Nine', 'Benin', 'Nigerian', 0, 0, 0, 0, 0, 1, 0, 'Elder', '2020-09-04', '09032536799', '09032536799', 'horsemantechnologies@gmail.com', '09032536799', 'Sarah Pitrus', 'brother', '09032536799', '123 ekehuan road', '1600939913.jpg', 0, '2020-09-24 09:31:53'),
(4, 1, '5f6d9c419c831', '', 'Test-101', 1, 'Miss', 'Ibori', 'Onenefe', 'Israel', 14, 0, 0, 0, 'Male', 'O-', '', '', '', '', '', 'Nigerian', 0, 0, 0, 0, 0, 0, 26, 'Elder', '1994-02-08', '09032536799', '09032536799', '', '', '', '', '09023898765', '', '1601018945.jpg', 0, '2020-09-25 07:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `patient_appointment`
--

CREATE TABLE `patient_appointment` (
  `id` int(11) NOT NULL,
  `front_desk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `specialty` int(11) NOT NULL,
  `vital_nurse` int(11) NOT NULL,
  `time_added` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `treated` int(11) NOT NULL DEFAULT '0' COMMENT '0=untreated, 1= treated',
  `temperature` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `bmi` int(11) DEFAULT NULL,
  `spo2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `allergies` text COLLATE utf8_unicode_ci,
  `routine_blood_pressure` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blood_press_stand_s` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `blood_press_stand_d` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `blood_press_sit_s` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `blood_press_sit_d` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pulse_rate` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `blood_sugar` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `echo_result` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ecg_result` longtext COLLATE utf8_unicode_ci NOT NULL,
  `got` int(11) NOT NULL,
  `history` longtext COLLATE utf8_unicode_ci NOT NULL,
  `complaint` longtext COLLATE utf8_unicode_ci NOT NULL,
  `patients_note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `examination` longtext COLLATE utf8_unicode_ci NOT NULL,
  `nurse_complaint` longtext COLLATE utf8_unicode_ci NOT NULL,
  `diagnosis` longtext COLLATE utf8_unicode_ci NOT NULL,
  `adm_note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `prescription` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lab` longtext COLLATE utf8_unicode_ci NOT NULL,
  `respiratory` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_time_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patient_appointment`
--

INSERT INTO `patient_appointment` (`id`, `front_desk`, `patient_id`, `doctor_id`, `specialty`, `vital_nurse`, `time_added`, `date_added`, `treated`, `temperature`, `height`, `weight`, `bmi`, `spo2`, `allergies`, `routine_blood_pressure`, `blood_press_stand_s`, `blood_press_stand_d`, `blood_press_sit_s`, `blood_press_sit_d`, `pulse_rate`, `blood_sugar`, `echo_result`, `ecg_result`, `got`, `history`, `complaint`, `patients_note`, `examination`, `nurse_complaint`, `diagnosis`, `adm_note`, `prescription`, `lab`, `respiratory`, `date_time_added`) VALUES
(1, '5f6c675b7c598', 1, '97', 0, 2, '2020-09-25 08:27:03', '2020-09-25', 0, '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', '', '', '', '', '', '', '2020-09-26 20:24:39'),
(2, '5f6d9c419c831', 4, '86', 0, 2, '2020-09-25 08:31:01', '2020-09-25', 0, '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', '', '', '', '', '', '', '2020-09-26 20:25:06'),
(3, '5f6d9c419c831', 4, '86', 0, 2, '2020-09-25 19:31:41', '2020-09-25', 0, '7', 7, '7', 7, '7', '7', '7', '7', '7', '7', '7', '7', '7', '', '', 1, '', '', '', '', '7', '', '', '', '', '7', '2020-09-30 17:33:46'),
(4, '5f6c6789324bc', 3, '97', 0, 2, '2020-09-26 21:23:19', '2020-09-10', 2, 'Y', 0, 'Y', 0, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', '', '', 1, '', '', '', '', 'Y', '', '', '', '', 'Y', '2020-09-30 19:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `patient_fluid`
--

CREATE TABLE `patient_fluid` (
  `patient_fluid_id` int(11) NOT NULL,
  `ipd_patient_id` int(11) NOT NULL,
  `nature` longtext NOT NULL,
  `oral` longtext NOT NULL,
  `rectal` longtext NOT NULL,
  `iv` longtext NOT NULL,
  `intake_other` longtext NOT NULL COMMENT 'other routes intake',
  `intake_total` longtext NOT NULL,
  `urine` longtext NOT NULL,
  `vomit` longtext NOT NULL,
  `tube` longtext NOT NULL,
  `output_other` longtext NOT NULL,
  `output_total` longtext NOT NULL,
  `balance` longtext NOT NULL,
  `chloride` longtext NOT NULL,
  `fdate_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_obs`
--

CREATE TABLE `patient_obs` (
  `patient_obs_id` int(11) NOT NULL,
  `ipd_patient_id` int(11) NOT NULL,
  `temp` longtext NOT NULL,
  `resr` longtext NOT NULL,
  `pulse` longtext NOT NULL,
  `bp` longtext NOT NULL,
  `intake` longtext NOT NULL,
  `output` longtext NOT NULL,
  `done_by` int(11) NOT NULL,
  `odate_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_scan_group`
--

CREATE TABLE `patient_scan_group` (
  `patient_scan_group_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `link_ref` longtext NOT NULL,
  `scan_num` int(11) NOT NULL,
  `patient_appointment_id` int(11) NOT NULL,
  `total_fee` longtext NOT NULL,
  `awaiting_result` int(11) NOT NULL COMMENT '0 is yes 1 is no',
  `seen_result` int(11) NOT NULL COMMENT '0 is not seen by doctor, 1 is seen',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_scan_result`
--

CREATE TABLE `patient_scan_result` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `front_desk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `scan_id` int(11) NOT NULL,
  `ref_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file` longtext COLLATE utf8_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `scan_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_test`
--

CREATE TABLE `patient_test` (
  `patient_test_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `staff_id` int(255) NOT NULL,
  `patient_appointment_id` int(11) NOT NULL,
  `front_desk` varchar(255) NOT NULL,
  `link_ref` longtext NOT NULL,
  `lab_test_id` int(11) NOT NULL,
  `lab_test_type_id` int(11) NOT NULL,
  `lab_result` longtext NOT NULL,
  `O` longtext NOT NULL,
  `H` longtext NOT NULL,
  `remarks` longtext NOT NULL,
  `tested` int(11) NOT NULL COMMENT '0 is no 1 is yes',
  `date_tested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_test_group`
--

CREATE TABLE `patient_test_group` (
  `patient_test_group_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `link_ref` longtext NOT NULL,
  `test_num` int(11) NOT NULL,
  `patient_appointment_id` int(11) NOT NULL,
  `front_desk` varchar(255) NOT NULL,
  `total_fee` longtext NOT NULL,
  `awaiting_result` int(11) NOT NULL COMMENT '0 is yes 1 is no',
  `seen_result` int(11) NOT NULL COMMENT '0 is not seen by doctor, 1 is seen',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_test_result`
--

CREATE TABLE `patient_test_result` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `front_desk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `test_id` int(11) NOT NULL,
  `ref_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `test_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lab_temp_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_xray_group`
--

CREATE TABLE `patient_xray_group` (
  `patient_xray_group_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `link_ref` longtext NOT NULL,
  `xray_num` int(11) NOT NULL,
  `patient_appointment_id` int(11) NOT NULL,
  `total_fee` longtext NOT NULL,
  `awaiting_result` int(11) NOT NULL COMMENT '0 is yes 1 is no',
  `seen_result` int(11) NOT NULL COMMENT '0 is not seen by doctor, 1 is seen',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_xray_result`
--

CREATE TABLE `patient_xray_result` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `front_desk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `xray_id` int(11) NOT NULL,
  `ref_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file` longtext COLLATE utf8_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `xray_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `reference` longtext NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_id` varchar(255) NOT NULL,
  `front_desk` varchar(255) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `amount` longtext NOT NULL,
  `company_id` int(255) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 is pending, 1 is paid',
  `pdate_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `payment_type_id` int(11) NOT NULL,
  `payment_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`payment_type_id`, `payment_type`) VALUES
(4, 'Admission'),
(12, 'Admission Deposit Refund'),
(5, 'Card'),
(8, 'Consultation'),
(3, 'Drugs'),
(10, 'HMO Bill'),
(11, 'Immunization'),
(9, 'In-Patient Bill'),
(2, 'Lab Test'),
(1, 'Pharmacy'),
(7, 'Physiotherapy'),
(6, 'Xray');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(50) NOT NULL,
  `staff_id` int(50) NOT NULL,
  `basic` int(50) NOT NULL,
  `housing` int(50) NOT NULL,
  `transport` int(50) NOT NULL,
  `cduty` int(50) NOT NULL,
  `hazard` int(50) NOT NULL,
  `feeding` int(50) NOT NULL,
  `medicals` int(50) NOT NULL,
  `pholiday` int(50) NOT NULL,
  `others` int(50) NOT NULL,
  `total_income` int(50) NOT NULL,
  `paye` int(50) NOT NULL,
  `pension` int(11) NOT NULL,
  `loan` int(50) NOT NULL,
  `thrift` int(50) NOT NULL,
  `advance` int(50) NOT NULL,
  `daycare` int(50) NOT NULL,
  `pharmacy` int(50) NOT NULL,
  `welfare` int(50) NOT NULL,
  `dothers` int(50) NOT NULL,
  `total_deductions` int(50) NOT NULL,
  `net_salary` int(20) NOT NULL,
  `type` int(50) NOT NULL DEFAULT '1',
  `added_by` int(11) NOT NULL,
  `date_paid` datetime NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `percentage`
--

CREATE TABLE `percentage` (
  `id` int(1) NOT NULL,
  `percentage` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `percentage`
--

INSERT INTO `percentage` (`id`, `percentage`) VALUES
(1, 40);

-- --------------------------------------------------------

--
-- Table structure for table `pharm_category`
--

CREATE TABLE `pharm_category` (
  `id` int(11) NOT NULL,
  `cat_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pharm_category`
--

INSERT INTO `pharm_category` (`id`, `cat_name`, `date_added`) VALUES
(24, 'Analgestics injection', '2019-09-16 11:37:41'),
(25, 'Analgestics Susp', '2019-09-16 11:41:35'),
(27, 'Analgestics Syrup', '2019-09-16 11:42:53'),
(28, 'Anti-Helmithectics Syrup', '2019-09-16 12:35:03'),
(29, 'Anti-Helmithectics Susp', '2019-09-16 12:35:16'),
(30, 'Anti-Helmithectics Tablet', '2019-09-16 12:35:30'),
(31, 'Anti-Helmithectics Inj', '2019-09-16 12:35:46'),
(32, 'Antimalaria drugs Syrup', '2019-09-18 09:57:07'),
(33, 'Antimalaria drugs Susp', '2019-09-18 09:57:16'),
(34, 'Antimalaria drugs Tab', '2019-09-18 09:57:26'),
(35, 'Antimalaria drugs Inj', '2019-09-18 09:57:36'),
(40, 'Hormones Tab', '2019-09-18 09:58:39'),
(41, 'Hormones Inj', '2019-09-18 09:58:48'),
(42, 'Antibiotics Susp', '2019-09-18 09:59:05'),
(43, 'Antibiotics Syrup', '2019-09-18 09:59:12'),
(44, 'Antibiotics Tab', '2019-09-18 09:59:21'),
(45, 'Antibiotics Inj', '2019-09-18 09:59:29'),
(46, 'GIT drugs Inj', '2019-09-18 09:59:47'),
(47, 'GIT drugs Tab', '2019-09-18 09:59:54'),
(48, 'GIT drugs Syrup', '2019-09-18 10:00:03'),
(49, 'GIT drugs Susp', '2019-09-18 10:00:13'),
(50, 'Analgestic drugs tab', '2019-09-18 10:04:43'),
(51, 'Nutrition & Vitamins Susp', '2019-09-18 10:06:32'),
(52, 'Nutrition & Vitamins Syrup', '2019-09-18 10:06:41'),
(53, 'Nutrition & Vitamins Tab', '2019-09-18 10:06:49'),
(54, 'Nutrition & Vitamins Inj', '2019-09-18 10:06:56'),
(55, 'Endocrine Tab', '2019-09-18 10:07:15'),
(56, 'Endocrine Inj', '2019-09-18 10:07:25'),
(57, 'CNS  Inj', '2019-09-18 10:07:51'),
(58, 'CNS  Tab', '2019-09-18 10:08:08'),
(59, 'Cardiovascular Drugs Tab', '2019-09-18 10:08:33'),
(60, 'Cardiovascular Drugs inj', '2019-09-18 10:08:43'),
(61, 'Steriods Inj', '2019-09-18 10:09:08'),
(62, 'Steriods Tab', '2019-09-18 10:09:17'),
(63, 'Steriods Syrup', '2019-09-18 10:09:24'),
(64, 'Steriods Susp', '2019-09-18 10:09:32'),
(65, 'Sexual Dysfunction Tab', '2019-09-18 10:09:56'),
(66, 'Sexual Dysfunction Capsule', '2019-09-18 10:10:11'),
(67, 'Heamatology Tabs', '2019-09-18 10:10:36'),
(68, 'Antihistamines Tab', '2019-09-18 10:11:06'),
(69, 'Antihistamines Inj', '2019-09-18 10:11:11'),
(70, 'Antihistamines Syrup', '2019-09-18 10:11:25'),
(71, 'Antihistamines Drops', '2019-09-18 10:11:32'),
(72, 'Antihistamines Inhalers', '2019-09-18 10:11:40'),
(73, 'Antihistamines Nebules', '2019-09-18 10:11:46'),
(74, 'Uterine Tabs', '2019-09-18 10:11:57'),
(75, 'Uterine Inj', '2019-09-18 10:12:04'),
(76, 'Ocular/ Optic Eye Drops', '2019-09-18 10:12:48'),
(77, 'Ocular/ Optic Ointment', '2019-09-18 10:13:02'),
(78, 'IV Fluids Inj', '2019-09-18 10:13:18'),
(79, 'IV Fluids', '2019-09-18 10:13:45'),
(80, 'Tropicals Preps Creams', '2019-09-18 10:14:32'),
(81, 'Tropicals Preps Tabs', '2019-09-18 10:14:39'),
(82, 'Tropicals Preps Gel', '2019-09-18 10:14:48'),
(83, 'Tropicals Preps Powders', '2019-09-18 10:14:57'),
(84, 'Medical Accessories', '2019-09-18 10:15:20'),
(85, 'Antiretroviral Tabs', '2019-09-18 10:15:40'),
(86, 'Antiretroviral Susp', '2019-09-18 10:15:47'),
(87, 'Antiretroviral Syrup', '2019-09-18 10:16:13'),
(88, 'Anticancer Tabs', '2019-09-18 10:16:40'),
(89, 'Anticancer Inj', '2019-09-18 10:16:49'),
(90, 'Anesthetics inj', '2019-09-18 10:17:41'),
(91, 'Vaccines', '2019-09-18 10:18:04'),
(92, 'Antiseptics', '2019-09-18 10:18:26'),
(93, 'FOOD', '2019-10-15 07:46:25'),
(94, 'ANALGESIC TAB', '2019-10-16 08:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `pharm_form`
--

CREATE TABLE `pharm_form` (
  `id` int(11) NOT NULL,
  `form_name` text NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharm_form`
--

INSERT INTO `pharm_form` (`id`, `form_name`, `date_added`) VALUES
(1, 'Tablet', '2019-07-12 13:34:13'),
(2, 'Capsule', '2019-07-12 13:34:14'),
(3, 'Oil', '2019-07-12 13:34:14'),
(4, 'Suppository', '2019-07-12 13:34:14'),
(5, 'Cream', '2019-07-12 13:34:14'),
(6, 'Ointment', '2019-07-12 13:34:14'),
(7, 'Injection', '2019-07-12 13:34:14'),
(8, 'Powder', '2019-07-12 13:34:14'),
(9, 'Suspension', '2019-07-12 13:34:14'),
(10, 'Syrup', '2019-07-12 13:34:14'),
(11, 'Lotion', '2019-07-12 13:34:14'),
(12, 'Satchet', '2019-07-12 13:34:14'),
(13, 'GEL', '2019-07-12 13:34:14'),
(14, 'Nebule', '2019-07-12 13:34:14'),
(15, 'IV Infusion', '2019-07-12 13:34:14'),
(16, 'Intravenous', '2019-07-12 13:34:14'),
(17, 'Gutt', '2019-07-12 13:34:14'),
(18, 'Injectable', '2019-07-12 13:34:14'),
(19, 'Device', '2019-07-12 13:34:14'),
(20, 'Solution', '2019-07-12 13:34:14'),
(21, 'Wound Dressing', '0000-00-00 00:00:00'),
(22, 'PAD', '0000-00-00 00:00:00'),
(23, 'DELIVERY MAT', '0000-00-00 00:00:00'),
(24, 'PLASTER', '0000-00-00 00:00:00'),
(25, 'THREAD', '0000-00-00 00:00:00'),
(26, 'NEEDLES', '0000-00-00 00:00:00'),
(27, 'BLADES', '0000-00-00 00:00:00'),
(28, 'BUFFER', '0000-00-00 00:00:00'),
(29, 'Pre-filled Syringe', '0000-00-00 00:00:00'),
(30, 'Syringe', '0000-00-00 00:00:00'),
(31, 'Glove', '0000-00-00 00:00:00'),
(32, 'Cotton Wool', '0000-00-00 00:00:00'),
(33, 'Gown', '0000-00-00 00:00:00'),
(34, 'Bed Sheet', '0000-00-00 00:00:00'),
(35, 'Surgical Pack', '0000-00-00 00:00:00'),
(36, 'Section Pack', '0000-00-00 00:00:00'),
(37, 'Tube', '0000-00-00 00:00:00'),
(38, 'Liquid', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pharm_notifications`
--

CREATE TABLE `pharm_notifications` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `prescription` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=pending,1=complete',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharm_requests`
--

CREATE TABLE `pharm_requests` (
  `request_id` int(11) NOT NULL,
  `reference` longtext NOT NULL,
  `staff_id` int(11) NOT NULL,
  `warehouse_stock_id` int(11) NOT NULL,
  `Stock_number` longtext NOT NULL,
  `quantity_needed` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `batch` longtext NOT NULL,
  `pdate_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `request_status` int(11) NOT NULL,
  `returned` int(11) NOT NULL,
  `rstatus` int(2) NOT NULL,
  `rdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pharm_sales_detail`
--

CREATE TABLE `pharm_sales_detail` (
  `Sales_ID` int(50) NOT NULL,
  `Sales_Number` text NOT NULL,
  `account_status` text NOT NULL,
  `Stock_Item` text NOT NULL,
  `Sales_Quantity` text NOT NULL,
  `Purchasing_Price` int(50) NOT NULL,
  `S_given` text NOT NULL,
  `sales_date` text NOT NULL,
  `returned` int(50) NOT NULL,
  `rstatus` int(50) NOT NULL,
  `rdate` datetime NOT NULL,
  `addedby` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pharm_stock`
--

CREATE TABLE `pharm_stock` (
  `id` int(11) NOT NULL,
  `reference2` text COLLATE utf8_unicode_ci NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `Stock_number` text COLLATE utf8_unicode_ci NOT NULL,
  `manufactured` datetime NOT NULL,
  `expiring` datetime NOT NULL,
  `c_carton` text COLLATE utf8_unicode_ci NOT NULL,
  `r_packs` text COLLATE utf8_unicode_ci NOT NULL,
  `erp` int(11) NOT NULL,
  `manufacturer` text COLLATE utf8_unicode_ci NOT NULL,
  `generic` text COLLATE utf8_unicode_ci NOT NULL,
  `batch` text COLLATE utf8_unicode_ci NOT NULL,
  `s_usage` int(11) NOT NULL,
  `cost_price` int(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `nurse` text COLLATE utf8_unicode_ci NOT NULL,
  `doctor's` text COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pharm_stock`
--

INSERT INTO `pharm_stock` (`id`, `reference2`, `name`, `category`, `units`, `stock`, `Stock_number`, `manufactured`, `expiring`, `c_carton`, `r_packs`, `erp`, `manufacturer`, `generic`, `batch`, `s_usage`, `cost_price`, `price`, `nurse`, `doctor's`, `date_added`) VALUES
(2, '', 'Diclofenac inj', 24, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 150, '300.00', '', '', '2019-09-16 12:06:03'),
(3, '', 'ACTIVATED CHARCOAL', 49, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '32', '', 0, '', '', '', 0, 10, '700.00', '', '', '2019-09-24 14:11:03'),
(4, '', 'ANUSOL SUPPOSITORY', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '', 0, '', '', '', 0, 260, '500.00', '', '', '2019-09-24 14:13:23'),
(5, '', 'AVOMINE TAB 25MG', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3, '10.00', '', '', '2019-09-24 14:15:41'),
(6, '', 'BONJELA CREAM', 82, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 550, '1100.00', '', '', '2019-09-24 14:20:19'),
(7, '', 'BUSCOPAN TAB 10MG', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 31, '60.00', '', '', '2019-09-24 14:21:34'),
(8, '', 'BUSCOPAN 20MG INJ', 46, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 35, '250.00', '', '', '2019-09-24 14:23:01'),
(9, '', 'CIMETIDINE 200MG TAB', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '25.00', '', '', '2019-09-24 14:24:46'),
(10, '', 'CIMETIDINE 400MG TAB', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 20, '50.00', '', '', '2019-09-24 14:25:40'),
(11, '', 'DULCOLAX TAB 5MG', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '25.00', '', '', '2019-09-24 14:27:30'),
(12, '', 'DULCOLAX 10MG SUPP', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 230, '450.00', '', '', '2019-09-24 14:28:57'),
(13, '', 'FLORANORM', 49, 9, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 475, '800.00', '', '', '2019-09-24 14:32:30'),
(14, '', 'GASCOL', 49, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 480, '800.00', '', '', '2019-09-24 14:33:42'),
(15, '', 'GAVISCONE SYR', 49, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1375, '3000.00', '', '', '2019-09-24 14:35:32'),
(16, '', 'GELUSIL TAB', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1, '10.00', '', '', '2019-09-24 14:36:13'),
(17, '', 'GESTID SUSP 200MLS', 49, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 546, '1100.00', '', '', '2019-09-24 14:37:11'),
(18, '', 'OMEPRAZOLE INJ', 46, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 600, '1200.00', '', '', '2019-09-24 14:38:07'),
(19, '', 'IMODIUM 2MG CAP', 47, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 125, '200.00', '', '', '2019-09-24 14:39:36'),
(21, '', 'LIQUID PARAFFIN', 48, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 438, '700.00', '', '', '2019-09-24 14:42:39'),
(22, '', 'LOMOTIL TABS', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 20, '40.00', '', '', '2019-09-24 14:43:43'),
(23, '', 'MAALOX SUSP', 49, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 2500, '4000.00', '', '', '2019-09-24 14:44:53'),
(24, '', 'MAXOLONE 10MG INJ', 46, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 31, '300.00', '', '', '2019-09-24 14:46:14'),
(25, '', 'MAXOLONE 10MG TAB', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3, '10.00', '', '', '2019-09-24 14:47:05'),
(26, '', 'MIST MAG TRISILICATE 200ML', 49, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 375, '600.00', '', '', '2019-09-24 14:48:13'),
(27, '', 'MOUTHWASH BRETT', 48, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 325, '700.00', '', '', '2019-09-24 14:49:33'),
(28, '', 'OMEPRAZOLE TAB', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 37, '80.00', '', '', '2019-09-24 14:51:09'),
(29, '', 'O R S SATCHET', 49, 9, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 43, '250.00', '', '', '2019-09-24 14:52:56'),
(30, '', 'PARIET 20MG TAB', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 277, '350.00', '', '', '2019-09-24 14:53:43'),
(31, '', 'RANITIDINE INJ', 46, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 560, '1200.00', '', '', '2019-09-24 14:54:56'),
(32, '', 'STEMETIL 5MG TAB', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 6, '20.00', '', '', '2019-09-24 14:56:24'),
(33, '', 'CIMETIDINE INJ', 46, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 250, '500.00', '', '', '2019-09-24 14:57:44'),
(35, '', 'THALAZOLE TAB', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 8, '20.00', '', '', '2019-09-24 14:59:12'),
(36, '', 'RANITIDINE 300MG TAB', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 2, 188, '400.00', '', '', '2019-09-24 15:05:17'),
(37, '', 'ZINC 10MG TAB', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 50, '200.00', '', '', '2019-09-24 15:06:39'),
(38, '', 'ACCICLOVIR 200MG TAB (VIREST)', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 105, '200.00', '', '', '2019-10-03 06:24:05'),
(39, '', 'ACICLOVIR 400MG TAB (VIREST)', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 178, '300.00', '', '', '2019-10-03 06:29:08'),
(40, '', 'ACICLOVIR INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 4625, '9250.00', '', '', '2019-10-03 06:33:11'),
(41, '', 'ACCICLOVIR 200MG TAB NHIS', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 84, '50.00', '', '', '2019-10-03 06:51:13'),
(42, '', 'ACCICLOVIR 400MG TAB NHIS', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 156, '75.00', '', '', '2019-10-03 06:53:34'),
(43, '', 'BUSCOPAN TAB 10MG NHIS', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 17, '20.00', '', '', '2019-10-03 06:54:46'),
(44, '', 'BUSCOPAN 20MG INJ NHIS', 46, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 18, '50.00', '', '', '2019-10-03 06:56:03'),
(45, '', 'LIQUID PARAFFIN NHIS', 48, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 138, '220.00', '', '', '2019-10-03 06:59:36'),
(46, '', 'MAXOLONE 10MG INJ NHIS', 46, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 31, '300.00', '', '', '2019-10-03 07:01:17'),
(47, '', 'MAXOLONE 10MG TAB NHIS', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3, '7.00', '', '', '2019-10-03 07:05:49'),
(48, '', 'MIST MAG TRISILICATE NHIS', 48, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 131, '300.00', '', '', '2019-10-03 07:07:07'),
(49, '', 'OMEPRAZOLE TAB NHIS', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 14, '33.00', '', '', '2019-10-03 07:08:04'),
(50, '', 'O R S SATCHET NHIS', 49, 9, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 43, '50.00', '', '', '2019-10-03 07:10:12'),
(51, '', 'FLEMING 1.2G INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 1500, '3000.00', '', '', '2019-10-03 07:16:50'),
(52, '', 'FLEMMING INJ NHIS', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 750, '1500.00', '', '', '2019-10-03 07:18:01'),
(53, '', 'MEROPENEM INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 4375, '9250.00', '', '', '2019-10-03 07:21:48'),
(54, '', 'AMOKSIKLAV 375MG TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 75, '300.00', '', '', '2019-10-03 07:23:35'),
(55, '', 'AMOXIL 250MG CAP', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '50.00', '', '', '2019-10-03 07:25:34'),
(56, '', 'AMOXIL CAP 250MG NHIS', 47, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 6, '10.00', '', '', '2019-10-03 07:26:54'),
(57, '', 'AMOXIL 500MG CAP', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 15, '60.00', '', '', '2019-10-03 07:32:05'),
(58, '', 'AMOXIL 500MG TAB NHIS', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '15.00', '', '', '2019-10-03 07:34:05'),
(59, '', 'AMOXIL 125MG SYR', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 688, '1200.00', '', '', '2019-10-03 07:35:58'),
(60, '', 'AMOXIL 125MG SYR NHIS', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 180, '200.00', '', '', '2019-10-03 07:50:55'),
(61, '', 'AMPICILLIN 500MG INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 44, '300.00', '', '', '2019-10-03 08:01:22'),
(62, '', 'AMPICILLIN 500MG INJ NHIS', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 44, '120.00', '', '', '2019-10-03 08:01:58'),
(63, '', 'AMPICLOX 500MG INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 120, '500.00', '', '', '2019-10-03 08:09:46'),
(64, '', 'AMPICLOX 500MG INJ NHIS', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 120, '120.00', '', '', '2019-10-03 08:10:24'),
(65, '', 'AMPICLOX 500MG CAP', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 20, '50.00', '', '', '2019-10-03 08:14:57'),
(66, '', 'AMPICLOX 500MG CAP NHIS', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 20, '10.00', '', '', '2019-10-03 08:17:16'),
(67, '', 'AMPICLOX SYR 250mg/5ml', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 1196, '2000.00', '', '', '2019-10-03 08:21:19'),
(68, '', 'AMPICLOX SUSP NHIS', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 438, '700.00', '', '', '2019-10-03 08:22:21'),
(69, '', 'AUGMENTIN 228MG SYR', 42, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 2065, '4000.00', '', '', '2019-10-03 08:23:58'),
(70, '', 'AUGMENTIN 625MG TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 246, '500.00', '', '', '2019-10-03 08:28:35'),
(71, '', 'AUGMENTIN 1G TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 280, '600.00', '', '', '2019-10-03 08:34:29'),
(72, '', 'AUGMENTIN 475MG SYR', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 2968, '4000.00', '', '', '2019-10-03 08:36:47'),
(73, '', 'AUGMENTIN ES SYR', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 4000, '6000.00', '', '', '2019-10-03 08:38:27'),
(74, '', 'AZITHROMYCIN 500MG TAB NHIS', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 63, '80.00', '', '', '2019-10-03 08:40:11'),
(75, '', 'BETAZIDINE 1G INJ (FORTUM)', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1625, '3250.00', '', '', '2019-10-03 08:42:58'),
(76, '', 'CEFTRIAXONE INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 625, '2750.00', '', '', '2019-10-03 08:45:31'),
(77, '', 'CEFTRIAXONE INJ (ROCEPHIN)', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3500, '7000.00', '', '', '2019-10-03 08:51:07'),
(78, '', 'CEFPODOXIME SYR (ORELOX)', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 3375, '6000.00', '', '', '2019-10-03 08:55:58'),
(79, '', 'CEPOREX 500MG TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 50, '100.00', '', '', '2019-10-03 15:04:40'),
(80, '', 'CEFUROXIME 125ML SYR (ZINNAT)', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3125, '5500.00', '', '', '2019-10-03 15:07:33'),
(81, '', 'CEFUROXIME 125MG SYR (ZINNAT) NHIS', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 950, '1200.00', '', '', '2019-10-03 15:08:58'),
(82, '', 'CEFUROXIME 250MG TAB (ZINNAT)', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 256, '500.00', '', '', '2019-10-03 15:13:24'),
(83, '', 'CEFUROXIME 250MG TAB (ZINNAT) NHIS', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 55, '150.00', '', '', '2019-10-03 15:14:17'),
(84, '', 'CEFUROXIME 500MG TAB (ZINNAT)', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 375, '600.00', '', '', '2019-10-03 15:16:44'),
(85, '', 'CHLORAMPHENICOL INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 500, '1000.00', '', '', '2019-10-03 15:21:20'),
(86, '', 'CHLORAMPHENCOL INJ NHIS', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 50, '100.00', '', '', '2019-10-03 15:22:03'),
(87, '', 'CHLORAMPHENICOL CAP', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 5, '10.00', '', '', '2019-10-03 15:23:02'),
(88, '', 'CIPROTAB DRIP', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 331, '700.00', '', '', '2019-10-03 15:24:08'),
(89, '', 'CIPROTAB DRIP NHIS', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '100.00', '', '', '2019-10-03 15:25:32'),
(90, '', 'CHLORAMPHENICOL CAP NHIS', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 5, '5.00', '', '', '2019-10-03 15:26:19'),
(91, '', 'CIPROTAB 500MG TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 120, '250.00', '', '', '2019-10-03 15:27:39'),
(92, '', 'CIPROTAB 500MG TAB NHIS', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 20, '40.00', '', '', '2019-10-03 15:29:22'),
(93, '', 'CLARITHROMYCIN 500MG CAP', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 125, '250.00', '', '', '2019-10-03 15:39:05'),
(94, '', 'CLARITHROMYCIN 500MG CAP NHIS', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 70, '120.00', '', '', '2019-10-03 15:40:56'),
(95, '', 'CEFUROXIME 500MG TAB (ZINNAT) NHIS', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 100, '150.00', '', '', '2019-10-03 15:44:38'),
(96, '', 'CRYSTAPEN INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 270, '500.00', '', '', '2019-10-03 15:45:47'),
(97, '', 'DIFLUCAN CAP', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 625, '1100.00', '', '', '2019-10-03 15:46:57'),
(98, '', 'DOXYCYCLINE CAP (DOXYCAP)', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '35.00', '', '', '2019-10-03 15:48:38'),
(99, '', 'DOXYCYCLINE CAP (DOXYCAP) NHIS', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '10.00', '', '', '2019-10-03 15:49:38'),
(100, '', 'FLEMMING 625MG TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 112, '250.00', '', '', '2019-10-03 15:53:11'),
(101, '', 'FLEMMING 625MG TAB NHIS (NECTACLAV)', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 70, '150.00', '', '', '2019-10-03 15:54:56'),
(102, '', 'FLEMMING 228MG SYR', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 1000, '3000.00', '', '', '2019-10-03 15:56:51'),
(103, '', 'FLEMMING 228MG SYR NHIS (NECTACLAV)', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 725, '1500.00', '', '', '2019-10-03 15:57:54'),
(104, '', 'FLEMMING 457MG SYR', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 1413, '4000.00', '', '', '2019-10-03 15:59:32'),
(105, '', 'ERYTHROMYCIN 125MG SYR', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 625, '1400.00', '', '', '2019-10-03 16:01:29'),
(106, '', 'ERYTHROMYCIN 125MG SYR NHIS', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 200, '400.00', '', '', '2019-10-03 16:03:20'),
(107, '', 'ERYTHROMYCIN 500MG TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 43, '100.00', '', '', '2019-10-03 16:04:22'),
(108, '', 'ERYTHROMYCIN 500MG TAB NHIS', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 30, '50.00', '', '', '2019-10-03 16:05:08'),
(109, '', 'FLAGYL 200MG TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '20.00', '', '', '2019-10-03 16:06:28'),
(110, '', 'FLAGYL 200MG TAB NHIS', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 5, '5.00', '', '', '2019-10-03 16:07:04'),
(111, '', 'FLAGYL 500MG DRIP', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 195, '500.00', '', '', '2019-10-03 16:08:36'),
(112, '', 'FLAGYL 200MG SUSP', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 180, '700.00', '', '', '2019-10-03 16:09:49'),
(113, '', 'OCEXONE INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 2250, '4500.00', '', '', '2019-10-03 16:10:57'),
(114, '', 'FLEMMING 1G TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 120, '250.00', '', '', '2019-10-03 16:11:56'),
(115, '', 'CEFEPIME INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 2875, '5750.00', '', '', '2019-10-03 16:15:09'),
(116, '', 'AZITHROMYCIN SYR', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 937, '1900.00', '', '', '2019-10-03 16:17:09'),
(117, '', 'FLUCAMED 50MG CAP', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 20, '50.00', '', '', '2019-10-03 16:20:16'),
(118, '', 'FLUCAMED SYR', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1025, '1600.00', '', '', '2019-10-03 16:20:59'),
(119, '', 'GENTAMICINE 80MG INJ (GENTALEK)', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 200, '1000.00', '', '', '2019-10-03 16:23:54'),
(120, '', 'GENTAMICINE 80MG INJ (GENTALEK) NHIS', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 62, '200.00', '', '', '2019-10-03 16:25:08'),
(121, '', 'ISONIAZIDE TAB (INH)', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 22, '50.00', '', '', '2019-10-03 16:26:53'),
(122, '', 'LAMISIL TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 232, '400.00', '', '', '2019-10-03 16:27:55'),
(123, '', 'ORELOX TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 142, '300.00', '', '', '2019-10-03 16:29:12'),
(124, '', 'NYSTATIN ORAL SUSP', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 750, '1500.00', '', '', '2019-10-03 16:30:18'),
(125, '', 'UNASYN INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 3500, '6000.00', '', '', '2019-10-03 16:32:00'),
(126, '', 'CEFUROXIME 750MG INJ (ZINNAT)', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1175, '3000.00', '', '', '2019-10-03 16:37:20'),
(127, '', 'FORTUM INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3000, '5500.00', '', '', '2019-10-03 16:38:37'),
(128, '', 'CLINDAMYCIN 150MG CAP', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 86, '300.00', '', '', '2019-10-03 16:39:46'),
(129, '', 'CLINDAMYCIN 300MG CAP', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 86, '120.00', '', '', '2019-10-03 16:40:30'),
(130, '', 'ETHAMBUTOL TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 219, '500.00', '', '', '2019-10-03 16:42:14'),
(131, '', 'IMIPRENEM INJ (BACQURE)', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 4125, '7500.00', '', '', '2019-10-03 16:43:57'),
(132, '', 'INTERZOL TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 20, '40.00', '', '', '2019-10-03 16:44:58'),
(133, '', 'KETOKONAZOLE TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 42, '60.00', '', '', '2019-10-03 16:45:54'),
(134, '', 'KETOKONAZOLE TAB NHIS', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 23, '30.00', '', '', '2019-10-03 16:46:46'),
(135, '', 'OFLOXACINE 400MG TAB (TARIVID)', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '200.00', '', '', '2019-10-03 16:50:12'),
(136, '', 'OFLOXACINE 400MG TAB (TARIVID) NHIS', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 43, '100.00', '', '', '2019-10-03 16:51:31'),
(137, '', 'PEFLACINE 400MG TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 20, '50.00', '', '', '2019-10-03 16:54:11'),
(138, '', 'CIPROFLOXACIN WITH TINIDAZOLE TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 32, '100.00', '', '', '2019-10-03 16:55:48'),
(139, '', 'PYRAZINAMIDE 500MG TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 13, '30.00', '', '', '2019-10-03 16:56:53'),
(140, '', 'RIFAMPICIN 300MG TAB', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 215, '500.00', '', '', '2019-10-03 16:57:46'),
(141, '', 'SECNIDAZOLE TAB (SECWID)', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 219, '500.00', '', '', '2019-10-03 16:58:53'),
(142, '', 'SEPTRIN SUSP', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 135, '300.00', '', '', '2019-10-03 17:00:03'),
(143, '', 'SEPTRIN TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 8, '30.00', '', '', '2019-10-03 17:00:46'),
(144, '', 'CEPHALEXIN 250MG CAP (SPORIDEX)', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 49, '100.00', '', '', '2019-10-03 17:04:32'),
(145, '', 'CEPHALEXIN 500MG CAP (SPORIDEX)', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 375, '800.00', '', '', '2019-10-03 17:06:11'),
(146, '', 'CEPHALEXIN 250MG SUSP (SPORIDEX)', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 613, '2500.00', '', '', '2019-10-03 17:07:32'),
(147, '', 'CEPHALEXIN 250MG SUSP (SPORIDEX) NHIS', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 613, '650.00', '', '', '2019-10-03 17:09:05'),
(148, '', 'STREPSIL TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 75, '130.00', '', '', '2019-10-03 17:14:18'),
(149, '', 'STREPSIL TAB NHIS', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 31, '60.00', '', '', '2019-10-03 17:15:24'),
(150, '', 'STREPTOMYCIN INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 150, '500.00', '', '', '2019-10-03 17:16:30'),
(151, '', 'TINIDAZOLE TAB (FASIGYN)', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 47, '100.00', '', '', '2019-10-03 17:19:04'),
(152, '', 'AZITHROMYCIN SYR ( ZITHROMAX )', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 2625, '5500.00', '', '', '2019-10-03 17:20:38'),
(153, '', 'AZITHROMYCIN 250MG CAP (ZITHROMAX )', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 583, '1000.00', '', '', '2019-10-03 17:22:09'),
(154, '', 'AMODIAQUINE SYR', 32, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 625, '1000.00', '', '', '2019-10-04 05:30:11'),
(155, '', 'ARTESUNAT SUSP', 33, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1125, '2000.00', '', '', '2019-10-04 05:35:11'),
(156, '', 'ARTESUNAT SUSP NHIS', 33, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 600, '600.00', '', '', '2019-10-04 05:36:13'),
(157, '', 'ARTESUNATE 50MG TAB', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 78, '120.00', '', '', '2019-10-04 05:38:26'),
(158, '', 'ARTESUNATE 50MG TAB NHIS', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 30, '40.00', '', '', '2019-10-04 05:39:56'),
(159, '', 'ARTESUNATE 30MG INJ', 35, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 400, '700.00', '', '', '2019-10-04 05:46:47'),
(160, '', 'ARTESUNATE 60MG INJ', 35, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 938, '2000.00', '', '', '2019-10-04 05:48:06'),
(161, '', 'CHLOROQUINE INJ X 5ML', 35, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 30, '100.00', '', '', '2019-10-04 05:49:44'),
(162, '', 'CHLOROQUINE INJ X 5ML NHIS', 35, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 30, '30.00', '', '', '2019-10-04 05:50:35'),
(163, '', 'CHLOROQUINE TAB', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 4, '20.00', '', '', '2019-10-04 05:54:17'),
(164, '', 'CHLOROQUINE TAB NHIS', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 4, '10.00', '', '', '2019-10-04 05:54:52'),
(165, '', 'CHLOROQUINE SYR (VINAQUINE)', 32, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 400, '700.00', '', '', '2019-10-04 05:56:04'),
(166, '', 'COARTEM 80/480 DS TAB', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 280, '500.00', '', '', '2019-10-04 05:57:55'),
(167, '', 'COARTEM DISPERSIBLE TAB', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 78, '150.00', '', '', '2019-10-04 06:00:31'),
(168, '', 'PYRAMAX SACHET', 34, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 174, '300.00', '', '', '2019-10-04 06:02:43'),
(169, '', 'PYRAMAX TAB', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 278, '550.00', '', '', '2019-10-04 06:04:00'),
(170, '', 'EMAL INJ', 35, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 1000, '2000.00', '', '', '2019-10-04 06:04:56'),
(171, '', 'EMAL INJ NHIS', 35, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 270, '450.00', '', '', '2019-10-04 06:45:31'),
(172, '', 'FANSIDAR SYR (MALDOX) X5ML', 32, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 400, '800.00', '', '', '2019-10-04 06:48:52'),
(173, '', 'FANSIDAR TAB', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 96, '200.00', '', '', '2019-10-04 06:49:37'),
(174, '', 'FANSIDAR TAB (MALDOX)', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 46, '120.00', '', '', '2019-10-04 06:50:30'),
(175, '', 'LONART DS TAB X 6TAB', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 200, '417.00', '', '', '2019-10-04 06:54:27'),
(176, '', 'MACULLUM 20/120 TAB (ORTRIMEF)', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 150, '300.00', '', '', '2019-10-04 06:55:54'),
(177, '', 'Colart 20/120 TAB NHIS', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 18, '50.00', '', '', '2019-10-04 06:56:59'),
(178, '', 'P ALAXIN SUSP', 33, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1125, '2000.00', '', '', '2019-10-04 06:58:32'),
(179, '', 'P ALAXIN SUSP NHIS', 33, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 425, '600.00', '', '', '2019-10-04 06:59:15'),
(180, '', 'P ALAXIN TAB', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 120, '250.00', '', '', '2019-10-04 07:00:14'),
(181, '', 'P ALAXIN TAB NHIS X6', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 425, '600.00', '', '', '2019-10-04 07:08:00'),
(182, '', 'PALUDRINE TAB', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 120, '200.00', '', '', '2019-10-04 07:09:03'),
(183, '', 'PALUDRINE TAB NHIS', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 31, '35.00', '', '', '2019-10-04 07:11:56'),
(184, '', 'DOUTHER 80/480', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 600, '1500.00', '', '', '2019-10-04 07:13:03'),
(185, '', 'DOUTHER 80/480 TAB NHIS', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 437, '500.00', '', '', '2019-10-04 07:14:17'),
(187, '', 'PALUTHER 80MG INJ (ARTEMETHER)', 35, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 188, '1500.00', '', '', '2019-10-04 07:16:05'),
(188, '', 'PALUTHER 40MG INJ (ARTEMETHER)', 35, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 200, '1000.00', '', '', '2019-10-04 07:16:45'),
(189, '', 'PALUTHER 20MG INJ (ARTEMETHER)', 35, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 188, '700.00', '', '', '2019-10-04 07:17:21'),
(190, '', 'QUINNINE 300MG TAB', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 56, '100.00', '', '', '2019-10-04 07:18:47'),
(191, '', 'QUINNINE 300MG TAB NHIS', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 24, '45.00', '', '', '2019-10-04 07:19:55'),
(192, '', 'QUINNINE SYR', 32, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 400, '700.00', '', '', '2019-10-04 07:21:26'),
(193, '', 'QUNNINE INJ', 35, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 55, '300.00', '', '', '2019-10-04 07:22:35'),
(194, '', 'UPXIN TAB X 9', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1125, '2000.00', '', '', '2019-10-04 07:24:52'),
(195, '', 'COMBANTRIN TAB (PYRANTRIN)', 68, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 60, '120.00', '', '', '2019-10-04 07:26:52'),
(196, '', 'COMBANTRIN SUSP (PYRANTRIN) X 5ML', 29, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 208, '400.00', '', '', '2019-10-04 07:27:54'),
(197, '', 'MEBENDAZOLE TAB (WORMIN)', 30, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 48, '100.00', '', '', '2019-10-04 07:34:43'),
(198, '', 'ZENTEL 200MG TAB', 30, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 437, '900.00', '', '', '2019-10-04 07:42:24'),
(199, '', 'ZENTEL SYR', 28, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 200, '400.00', '', '', '2019-10-04 07:43:42'),
(200, '', 'ZOLAT 200MG TAB', 30, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 95, '200.00', '', '', '2019-10-04 07:44:56'),
(201, '', 'ZOLAT SYR', 28, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 144, '300.00', '', '', '2019-10-04 07:48:48'),
(202, '', 'ARTHOCARE FORTE CAP', 94, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 73, '300.00', '', '', '2019-10-16 08:36:27'),
(203, '', 'ARTHROTEC CAP', 94, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 76, '200.00', '', '', '2019-10-16 08:37:34'),
(204, '', 'ARTHROTEC CAP NHIS', 94, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 76, '80.00', '', '', '2019-10-16 08:38:25'),
(205, '', 'VASOPRIM 75MG TAB (ASPRIN)', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3, '10.00', '', '', '2019-10-16 08:40:17'),
(206, '', 'BACLOFEN TAB 10MG', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 27, '50.00', '', '', '2019-10-16 08:44:47'),
(207, '', 'BRUFEN 200MG TAB(IBUPROFEN)', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3, '10.00', '', '', '2019-10-16 08:47:33'),
(208, '', 'CATAFLAM 50MG TAB', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 63, '150.00', '', '', '2019-10-16 08:49:31'),
(209, '', 'CELEBREX CAP', 94, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 219, '400.00', '', '', '2019-10-16 08:52:57'),
(210, '', 'CHYMORAL TAB', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '50.00', '', '', '2019-10-16 08:53:44'),
(211, '', 'DICLOFENAC 50MG TAB', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 19, '40.00', '', '', '2019-10-16 09:00:31'),
(212, '', 'DICLOFENAC 50MG TAB NHIS', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 8, '15.00', '', '', '2019-10-16 09:05:18'),
(213, '', 'DICLOFENAC INJ', 24, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 24, '300.00', '', '', '2019-10-16 09:06:53'),
(214, '', 'DICLOFENAC INJ NHIS', 24, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 24, '50.00', '', '', '2019-10-16 09:07:52'),
(215, '', 'DIHYDROCODEIN 30MG TAB', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 37, '200.00', '', '', '2019-10-16 09:14:14'),
(216, '', 'DOLOMETA B TAB', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 17, '40.00', '', '', '2019-10-16 09:15:22'),
(217, '', 'DOLOMETA B TAB NHIS', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 17, '20.00', '', '', '2019-10-16 09:16:05'),
(218, '', 'FLOTAC 75MG TAB', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 157, '300.00', '', '', '2019-10-16 09:18:16'),
(219, '', 'IBRUFEN SYR (REPROFEN)', 27, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 250, '800.00', '', '', '2019-10-16 09:20:32'),
(221, '', 'COCODAMOL TAB', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 31, '60.00', '', '', '2019-10-16 09:25:55'),
(222, '', 'IRON DEXTRAN INJ', 54, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '500.00', '', '', '2019-10-16 09:26:50'),
(223, '', 'JOINT FREE TAB', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 33, '80.00', '', '', '2019-10-16 09:28:20'),
(224, '', 'METHOCARBAMOL TAB', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 57, '150.00', '', '', '2019-10-16 09:29:52'),
(225, '', 'MORPHINE 10MG INJ', 24, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 813, '2000.00', '', '', '2019-10-16 09:30:37'),
(226, '', 'NEUROVIT TAB', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 50, '100.00', '', '', '2019-10-16 09:33:51'),
(227, '', 'PENTAZOCINE 30MG INJ (FORTWIN)', 24, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 560, '1200.00', '', '', '2019-10-16 09:36:32'),
(228, '', 'PENTAZOCINE 30MG INJ (FORTWIN) NHIS', 24, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 181, '300.00', '', '', '2019-10-16 09:38:37'),
(229, '', 'DICLOFENAC 12.5MG SUPPOSITORY (VOLTAREEN)', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 356, '600.00', '', '', '2019-10-16 09:41:31'),
(230, '', 'DICLOFENAC 100MG SUPPOSITORY (VOLTAREEN)', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 194, '500.00', '', '', '2019-10-16 09:46:48'),
(231, '', 'NORGESIC TAB', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 24, '60.00', '', '', '2019-10-16 09:48:07'),
(232, '', 'NO ACHE TAB', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 37, '70.00', '', '', '2019-10-16 09:49:00'),
(233, '', 'PARACETAMOL 2ML INJ (PCM)', 24, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 25, '300.00', '', '', '2019-10-16 09:55:56'),
(234, '', 'PARACETAMOL 2ML INJ NHIS', 24, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 24, '30.00', '', '', '2019-10-16 09:57:18'),
(235, '', 'PARACETAMOL 500MG TAB (PCM)', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3, '8.00', '', '', '2019-10-16 10:03:01'),
(236, '', 'PARACETAMOL 500MG TAB NHIS', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 3, '8.00', '', '', '2019-10-16 10:03:28'),
(237, '', 'PARACETAMOL SYR (PCM)', 27, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 145, '300.00', '', '', '2019-10-16 10:04:44'),
(238, '', 'PARACETAMOL SYR NHIS (PCM)', 27, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 135, '150.00', '', '', '2019-10-16 10:05:28'),
(240, '', 'TRAMALDOL 100MG INJ', 24, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 200, '500.00', '', '', '2019-10-16 10:08:07'),
(241, '', 'TRAMALDOL 50MG CAP', 94, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 35, '70.00', '', '', '2019-10-16 10:10:05'),
(242, '', 'LYRICA 75MG TAB', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 241, '600.00', '', '', '2019-10-16 10:12:08'),
(243, '', 'ASTYMIN CAP', 53, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 58, '120.00', '', '', '2019-10-16 10:15:44'),
(244, '', 'ASTYMIN INFUSION', 54, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 4250, '8000.00', '', '', '2019-10-16 10:16:55'),
(245, '', 'ASTYMIN SYR', 52, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1500, '3000.00', '', '', '2019-10-16 10:18:03'),
(246, '', 'CAC SANDOZ / TIN', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1688, '4000.00', '', '', '2019-10-16 10:20:13'),
(247, '', 'CALCIUM LACTATE 300MG TAB', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1, '5.00', '', '', '2019-10-16 10:21:31'),
(248, '', 'CALCIMAX TAB', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '50.00', '', '', '2019-10-16 10:22:28'),
(249, '', 'EVENING PRIMROSE TAB (EVE)', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 58, '150.00', '', '', '2019-10-16 10:25:03'),
(250, '', 'COD LIVER OIL CAP', 53, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 11, '30.00', '', '', '2019-10-16 10:26:19'),
(251, '', 'COD LIVER OIL SYR', 52, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 2300, '4600.00', '', '', '2019-10-16 10:30:30'),
(252, '', 'ENCEPHABOL TAB', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 32, '100.00', '', '', '2019-10-16 10:31:23'),
(253, '', 'FERROUS GLUCONATE TAB', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 4, '10.00', '', '', '2019-10-16 10:32:21'),
(254, '', 'FERSOLATE TAB', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1, '5.00', '', '', '2019-10-16 10:32:58'),
(255, '', 'FOLIC ACID TAB', 52, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 5, '10.00', '', '', '2019-10-16 10:33:35'),
(256, '', 'HAEMACCEL DRIP', 54, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 4400, '7000.00', '', '', '2019-10-16 10:35:26'),
(257, '', 'LYCOFER SYR', 52, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1000, '2000.00', '', '', '2019-10-16 10:38:19'),
(258, '', 'LYCOSET SYR', 52, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 1750, '3500.00', '', '', '2019-10-16 10:38:59'),
(259, '', 'LYCOFER CAP', 53, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 25, '50.00', '', '', '2019-10-16 10:40:51'),
(260, '', 'MANIX CAP', 53, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 75, '150.00', '', '', '2019-10-16 10:45:36'),
(261, '', 'MULTIVITE SYR', 52, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 225, '500.00', '', '', '2019-10-16 10:46:26'),
(262, '', 'MULTIVITE SYR NHIS', 52, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 125, '300.00', '', '', '2019-10-16 10:46:47'),
(263, '', 'MULTIVITE TAB', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1, '5.00', '', '', '2019-10-16 10:47:20'),
(264, '', 'ASTYFER CAP', 53, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 47, '100.00', '', '', '2019-10-16 10:48:08'),
(265, '', 'ASTYFER SYR', 52, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1500, '3000.00', '', '', '2019-10-16 10:50:38'),
(266, '', 'RENERVE PLUS', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 120, '250.00', '', '', '2019-10-16 10:56:49'),
(267, '', 'RANFERON SYR', 52, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 350, '700.00', '', '', '2019-10-16 11:00:00'),
(268, '', 'ROVIGON CAP', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 73, '150.00', '', '', '2019-10-16 11:05:48'),
(269, '', 'SLOW K 600MG TAB', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 75, '120.00', '', '', '2019-10-16 11:06:30'),
(270, '', 'VITAMIN A 25000IU CAP', 53, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 22, '50.00', '', '', '2019-10-16 11:07:51'),
(271, '', 'VITAMIN B2 TAB', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 5, '10.00', '', '', '2019-10-16 11:08:37'),
(272, '', 'VITAMIN B6 TAB', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 5, '10.00', '', '', '2019-10-16 11:08:49'),
(273, '', 'VITAMIN B COMPLEX INJ / 5ML', 54, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 50, '100.00', '', '', '2019-10-16 11:09:46'),
(274, '', 'VITAMIN B COMPLEX SYR', 52, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 183, '400.00', '', '', '2019-10-16 11:10:15'),
(275, '', 'VITAMIN B COMPLEX SYR NHIS', 52, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 125, '150.00', '', '', '2019-10-16 11:10:35'),
(276, '', 'VITAMIN B COMPLEX TAB', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 3, '10.00', '', '', '2019-10-16 11:11:08'),
(277, '', 'VITAMIN C SYR', 52, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 200, '400.00', '', '', '2019-10-16 11:11:42'),
(278, '', 'VITAMIN C SYR NHIS', 52, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 125, '200.00', '', '', '2019-10-16 11:12:05'),
(279, '', 'VITAMIN C TAB', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3, '10.00', '', '', '2019-10-16 11:13:02'),
(280, '', 'VITAMIN E CAP', 53, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 50, '100.00', '', '', '2019-10-16 11:13:52'),
(281, '', 'VITAMIN K INJ', 54, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 150, '400.00', '', '', '2019-10-16 11:14:29'),
(282, '', 'DHA EMULSION', 52, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1750, '4000.00', '', '', '2019-10-16 11:15:37'),
(283, '', 'VITAMIN D TAB', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 25, '100.00', '', '', '2019-10-16 11:16:14'),
(285, '', 'ALPHABETIC TAB', 55, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 102, '300.00', '', '', '2019-10-17 12:22:20'),
(286, '', 'DAONIL 5MG TAB (GLIBENCLAMIDE)', 55, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 24, '50.00', '', '', '2019-10-17 12:25:15'),
(287, '', 'DAONIL 5MG TAB (GLIBENCLAMIDE) NHIS', 55, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 11, '15.00', '', '', '2019-10-17 12:25:36'),
(288, '', 'GALVUS MET TAB', 55, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 209, '400.00', '', '', '2019-10-17 12:30:06'),
(289, '', 'GLUCOPHAGE 500MG TAB (METFORMIN)', 55, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 23, '40.00', '', '', '2019-10-17 12:35:07'),
(290, '', 'GLUCOPHAGE 500MG TAB (METFORMIN) NHIS', 55, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 10, '15.00', '', '', '2019-10-17 12:35:44'),
(291, '', 'CARBIMAZOLE 5MG TAB', 55, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 50, '100.00', '', '', '2019-10-17 12:38:28'),
(292, '', 'HUMAN INSULIN (PLAIN) INJ (ATRAPID)', 56, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 4750, '10000.00', '', '', '2019-10-17 12:44:41'),
(293, '', 'HUMAN INSULIN (MIXTARD) INJ', 56, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 4750, '10000.00', '', '', '2019-10-17 12:46:08'),
(294, '', 'ALDOMET 250MG TAB (METHYLDOPA)', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 44, '100.00', '', '', '2019-10-17 12:52:13'),
(295, '', 'ALDOMET 250MG TAB (METHYLDOPA) NHIS', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 8, '15.00', '', '', '2019-10-17 12:52:32'),
(296, '', 'AMLOVAR 5MG TAB (AMLODIPINE)', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 39, '100.00', '', '', '2019-10-17 12:55:23'),
(298, '', 'AMLOVAR 5MG TAB (AMLODIPINE) NHIS', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 27, '60.00', '', '', '2019-10-17 13:00:02'),
(299, '', 'AMLOVAR 10MG TAB (AMLODIPINE)', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 76, '150.00', '', '', '2019-10-17 13:00:40'),
(300, '', 'AMLOVAR 10MG TAB (AMLODIPINE) NHIS', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 27, '60.00', '', '', '2019-10-17 13:00:58'),
(301, '', 'APPESOLINE INJ (HYDRALAZINE)', 60, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 375, '800.00', '', '', '2019-10-17 13:03:33'),
(302, '', 'APPESOLINE  (HYDRALAZINE) TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 20, '50.00', '', '', '2019-10-17 13:04:19'),
(303, '', 'CADURA XL 4MG TAB (DANAXOSIN)', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 296, '500.00', '', '', '2019-10-17 13:10:28'),
(304, '', 'ATENOLOL 50MG TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 45, '90.00', '', '', '2019-10-17 13:12:02'),
(305, '', 'ATENOLOL 100MG TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 90, '200.00', '', '', '2019-10-17 13:12:28'),
(306, '', 'CLOPIDOGREL 75MG TAB (PLAGERINE)', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 63, '150.00', '', '', '2019-10-17 13:15:27'),
(307, '', 'CLOPIDOGREL 75MG TAB (PLAGERINE) NHIS', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 50, '60.00', '', '', '2019-10-17 13:15:52');
INSERT INTO `pharm_stock` (`id`, `reference2`, `name`, `category`, `units`, `stock`, `Stock_number`, `manufactured`, `expiring`, `c_carton`, `r_packs`, `erp`, `manufacturer`, `generic`, `batch`, `s_usage`, `cost_price`, `price`, `nurse`, `doctor's`, `date_added`) VALUES
(308, '', 'CODIOVAN TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 143, '300.00', '', '', '2019-10-17 13:17:41'),
(309, '', 'DIGOXIN 0.25MG TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 8, '20.00', '', '', '2019-10-17 13:19:29'),
(310, '', 'DIOVAN TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 115, '300.00', '', '', '2019-10-17 13:21:58'),
(311, '', 'INDERAL 40MG TAB (PROPRANOLOL)', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 25, '50.00', '', '', '2019-10-17 13:26:36'),
(312, '', 'LASIX 40MG TAB (FUROSEMIDE)', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '20.00', '', '', '2019-10-17 13:31:01'),
(313, '', 'LASIX 40MG TAB (FUROSEMIDE) NHIS', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3, '5.00', '', '', '2019-10-17 13:31:17'),
(314, '', 'LASIX 20MG INJ (FUROSEMIDE)', 60, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 20, '100.00', '', '', '2019-10-17 13:32:06'),
(315, '', 'LASIX 20MG INJ (FUROSEMIDE) NHIS', 60, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 20, '140.00', '', '', '2019-10-17 13:32:21'),
(316, '', 'LIPITOR 20MG TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 264, '500.00', '', '', '2019-10-17 13:35:24'),
(317, '', 'CRESTOR 10MG TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 125, '250.00', '', '', '2019-10-17 13:38:15'),
(318, '', 'LISINOPRIL 5MG TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 30, '65.00', '', '', '2019-10-17 13:40:23'),
(319, '', 'LISINOPRIL 5MG TAB NHIS', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 16, '20.00', '', '', '2019-10-17 13:41:00'),
(320, '', 'LISINOPRIL 10MG TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 50, '120.00', '', '', '2019-10-17 13:41:35'),
(321, '', 'LISINOPRIL 10MG TAB NHIS', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 13, '25.00', '', '', '2019-10-17 13:41:57'),
(322, '', 'LOSARTAN 50MG TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 63, '150.00', '', '', '2019-10-17 13:43:22'),
(323, '', 'LOSARTAN 100MG TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 63, '180.00', '', '', '2019-10-17 13:43:44'),
(324, '', 'MUDURETIC TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 16, '30.00', '', '', '2019-10-17 13:44:47'),
(325, '', 'MUDURETIC TAB NHIS', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 7, '7.00', '', '', '2019-10-17 13:45:10'),
(326, '', 'NIFEDIPINE 20MG TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 39, '80.00', '', '', '2019-10-17 13:49:08'),
(327, '', 'NIFEDIPINE 20MG TAB NHIS', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '15.00', '', '', '2019-10-17 13:49:29'),
(328, '', 'NORVASC 5MG TAB (AMLODIPINE)', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '250.00', '', '', '2019-10-17 13:50:36'),
(329, '', 'NORVASC 10MG TAB (AMLODIPINE)', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 206, '400.00', '', '', '2019-10-17 13:50:56'),
(330, '', 'SPIRONOLACTONE 25MG TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 9, '20.00', '', '', '2019-10-17 13:52:59'),
(331, '', 'THIAPRIL 5MG TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 83, '150.00', '', '', '2019-10-17 13:53:54'),
(332, '', 'LABETALOL 200MG TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 239, '400.00', '', '', '2019-10-17 13:56:39'),
(333, '', 'LIPITOR 10MG TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 200, '350.00', '', '', '2019-10-17 13:57:41'),
(334, '', 'AMITRYPTYLINE 25MG TAB (TRIPTIZOLE)', 58, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 25, '100.00', '', '', '2019-10-17 13:59:14'),
(335, '', 'ARTANE 2MG TAB', 58, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 13, '30.00', '', '', '2019-10-17 14:03:36'),
(336, '', 'DIAZEPAM 5MG TAB', 58, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 50, '100.00', '', '', '2019-10-17 14:08:05'),
(337, '', 'DIAZEPAM 10MG INJ (ROCHE)(VALIUM)', 57, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 500, '1000.00', '', '', '2019-10-17 14:08:45'),
(338, '', 'IMIPRAMINE 25MG TAB (TOFRANIL)', 58, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 33, '60.00', '', '', '2019-10-17 14:11:54'),
(339, '', 'LARGACTIL 50MG INJ (CHLORPROMAZINE)', 57, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 25, '500.00', '', '', '2019-10-17 14:14:47'),
(340, '', 'LEXOTAN 3MG TAB (BROMAZEPAM)', 58, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 24, '150.00', '', '', '2019-10-17 14:17:14'),
(341, '', 'MAGNISIUM SULPHATE INJ 5G', 57, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 875, '2000.00', '', '', '2019-10-17 14:19:41'),
(342, '', 'NITRAZEPAM 5MG TAB', 58, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 50, '100.00', '', '', '2019-10-17 14:21:02'),
(343, '', 'PHENEGAN INJ (PROMETHAZINE)', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 21, '500.00', '', '', '2019-10-17 14:24:51'),
(344, '', 'PHENOBARBITONE 30MG TAB', 58, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 8, '50.00', '', '', '2019-10-17 14:26:44'),
(345, '', 'PHENOBARBITONE 100MG/ML INJ', 57, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 414, '800.00', '', '', '2019-10-17 14:30:52'),
(346, '', 'PHENOBARBITONE SYR', 95, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 413, '1200.00', '', '', '2019-10-17 14:53:17'),
(347, '', 'SIRDALUD TAB', 58, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 63, '100.00', '', '', '2019-10-17 15:11:52'),
(348, '', 'STUGERON TAB', 58, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 15, '50.00', '', '', '2019-10-17 15:12:59'),
(349, '', 'TEGRETOL 200MG TAB', 58, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 98, '200.00', '', '', '2019-10-17 15:13:45'),
(350, '', 'KEPPRA 250MG TAB', 58, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 62, '250.00', '', '', '2019-10-17 15:14:27'),
(351, '', 'KEPPRA 500MG TAB', 58, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 69, '300.00', '', '', '2019-10-17 15:14:48'),
(352, '', 'ADDYZOA TAB', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 160, '300.00', '', '', '2019-10-17 15:19:26'),
(353, '', 'ANTI D RHESUS INJ (RHOGAM)', 41, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 41250, '50000.00', '', '', '2019-10-17 15:22:58'),
(354, '', 'CLOMID 50MG TAB (CLOMIPHENE CITRATE)', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 306, '400.00', '', '', '2019-10-17 15:28:16'),
(355, '', 'CYCLOGEST 400MG TAB (PROGESTERONE)', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 875, '1500.00', '', '', '2019-10-17 15:31:13'),
(356, '', 'DEPO POVERA INJ', 41, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 300, '1000.00', '', '', '2019-10-17 15:32:04'),
(357, '', 'FERTIAID CAP (WOMAN)', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 250, '350.00', '', '', '2019-10-17 15:33:20'),
(358, '', 'FERTIAID CAP (MAN)', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 250, '350.00', '', '', '2019-10-17 15:33:33'),
(359, '', 'VEGA TAB (SILDENAFIL)', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 44, '100.00', '', '', '2019-10-17 15:34:50'),
(360, '', 'ERYTHROPOETIN INJ', 41, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 6500, '15000.00', '', '', '2019-10-17 15:36:21'),
(361, '', 'FSH 75IU INJ', 41, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 6625, '9000.00', '', '', '2019-10-18 11:29:05'),
(362, '', 'HCG (HUMAN CHORIONIC GONADOTROPHIN) INJ 5000IU', 41, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 6250, '10000.00', '', '', '2019-10-18 11:35:09'),
(363, '', 'HCG (HUMAN CHORIONIC GONADOTROPHIN) INJ 10000IU', 41, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10000, '13000.00', '', '', '2019-10-18 11:35:26'),
(364, '', 'KENALOG INJ (TRIAMCINOLONE ACETONIDE)', 41, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1625, '2500.00', '', '', '2019-10-18 11:38:51'),
(365, '', 'NORISTERAT 200MG INJ', 41, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 375, '800.00', '', '', '2019-10-18 11:41:24'),
(366, '', 'BROMOCRIPTINE 2.5MG TAB (BOMERGON)', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '200.00', '', '', '2019-10-18 11:42:52'),
(367, '', 'TRANEXAMIC ACID TAB', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 94, '200.00', '', '', '2019-10-18 11:44:26'),
(368, '', 'TRANEXAMIC ACID INJ', 41, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1125, '2000.00', '', '', '2019-10-18 11:44:56'),
(369, '', 'PRIMOLUT N 5MG TAB', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 46, '100.00', '', '', '2019-10-18 11:50:04'),
(370, '', 'PRIMOLUT DEPOT 250MG INJ', 41, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 2500, '5000.00', '', '', '2019-10-18 11:50:41'),
(371, '', 'PROGYNOVA 2MG TAB', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 142, '300.00', '', '', '2019-10-18 11:52:30'),
(373, '', 'DUPHASTON 10MG TAB', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 132, '300.00', '', '', '2019-10-18 11:55:15'),
(374, '', 'SPERM LOAD CAP', 40, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 135, '250.00', '', '', '2019-10-18 11:56:06'),
(375, '', 'TAMOXIFEN 20MG TAB', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 92, '200.00', '', '', '2019-10-18 11:57:55'),
(376, '', 'DEPO MEDROL INJ', 61, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 875, '1500.00', '', '', '2019-10-18 11:59:55'),
(377, '', 'HYDROCORTISONE 100MG INJ', 61, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 750, '1500.00', '', '', '2019-10-18 12:04:05'),
(378, '', 'HYDROCORTISONE 100MG INJ NHIS', 61, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 175, '350.00', '', '', '2019-10-18 12:05:05'),
(379, '', 'PREDNISOLONE 5MG TAB', 62, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 18, '50.00', '', '', '2019-10-18 12:07:28'),
(380, '', 'PREDNISOLONE 5MG TAB NHIS', 62, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3, '8.00', '', '', '2019-10-18 12:07:57'),
(381, '', 'SINUFED TAB', 62, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 25, '50.00', '', '', '2019-10-18 12:10:37'),
(382, '', 'SINUFED SYR', 63, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 375, '1000.00', '', '', '2019-10-18 12:11:09'),
(383, '', 'AMINOPHYLLIN INJ', 61, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 875, '1800.00', '', '', '2019-10-18 12:12:00'),
(384, '', 'BRONCHOLITE SYR', 63, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1625, '2500.00', '', '', '2019-10-18 12:13:15'),
(385, '', 'EMZOLYN EXPECTORANT', 63, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 212, '700.00', '', '', '2019-10-18 12:14:51'),
(386, '', 'EMZOLYN EXPECTORANT NHIS', 63, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 212, '300.00', '', '', '2019-10-18 12:18:09'),
(387, '', 'EMZOLYN PAEDIATRIC', 63, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 203, '700.00', '', '', '2019-10-18 12:18:42'),
(388, '', 'EMZOLYN PAEDIATRIC NHIS', 63, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 203, '300.00', '', '', '2019-10-18 12:18:57'),
(389, '', 'MENTHOL CRYSTALS 7.5G', 64, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '500.00', '', '', '2019-10-18 12:20:37'),
(390, '', 'CIALIS TAB (TADALAFIL)', 65, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 5625, '6500.00', '', '', '2019-10-18 12:23:19'),
(391, '', 'LEVITRA 5MG TAB', 65, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1550, '2500.00', '', '', '2019-10-18 12:24:26'),
(392, '', 'ASMALYN SYR', 70, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 355, '1500.00', '', '', '2019-10-18 12:26:09'),
(393, '', 'LORATIDINE 10MG TAB', 68, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 31, '50.00', '', '', '2019-10-18 12:27:49'),
(394, '', 'LORATIDINE 10MG TAB NHIS', 68, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 8, '20.00', '', '', '2019-10-18 12:28:37'),
(395, '', 'LORATIDINE SYR', 70, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 620, '1200.00', '', '', '2019-10-18 12:30:12'),
(396, '', 'LORATIDINE SYR NHIS', 70, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 620, '1000.00', '', '', '2019-10-18 12:30:28'),
(397, '', 'OTRIVIN NASAL DROP (ADULT)', 72, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 800, '1200.00', '', '', '2019-10-18 12:32:36'),
(398, '', 'OTRIVIN NASAL DROP (CHILDREN)', 72, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 750, '1200.00', '', '', '2019-10-18 12:32:58'),
(399, '', 'PIRITON INJ (CHLORPHENIRAMINE)', 69, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 31, '300.00', '', '', '2019-10-18 12:36:34'),
(400, '', 'AREACTIN SYR (CHLORPHENIRAMINE)', 70, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 313, '1000.00', '', '', '2019-10-18 12:37:17'),
(401, '', 'ALLERGIN SYR (CHLORPHENIRAMINE)', 70, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 150, '300.00', '', '', '2019-10-18 12:38:25'),
(402, '', 'SERETIDE INHALER', 72, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 6875, '10000.00', '', '', '2019-10-18 12:39:29'),
(403, '', 'VENTOLIN INHALER', 72, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1250, '1800.00', '', '', '2019-10-18 12:40:47'),
(404, '', 'VENTOLIN NEBULES 2.5MG', 73, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 200, '1000.00', '', '', '2019-10-18 12:42:56'),
(405, '', 'VENTOLIN NEBULES 5MG', 73, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 200, '1800.00', '', '', '2019-10-18 12:43:25'),
(406, '', 'VENTOLIN 4MG TAB', 68, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '25.00', '', '', '2019-10-18 12:44:04'),
(407, '', 'CYTOTEC 200MG TAB (MISOPROSTOL)', 74, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 200, '1000.00', '', '', '2019-10-18 12:47:41'),
(408, '', 'CYTOTEC 200MG TAB (MISOPROSTOL) NHIS', 74, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 200, '1000.00', '', '', '2019-10-18 12:50:43'),
(409, '', 'ERGOMETRINE INJ', 75, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 313, '700.00', '', '', '2019-10-18 12:52:22'),
(410, '', 'HEAVY MARCAINE INJ', 75, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1000, '2000.00', '', '', '2019-10-18 12:52:59'),
(411, '', 'PLAIN MARCAINE INJ', 75, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1000, '2000.00', '', '', '2019-10-18 12:54:02'),
(412, '', 'OXYTOCIN INJ', 75, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 300, '600.00', '', '', '2019-10-18 12:55:20'),
(413, '', 'BETADRONE N EYE DROP', 76, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 525, '1100.00', '', '', '2019-10-18 12:58:50'),
(414, '', 'CERUMOL EAR DROP', 96, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1500, '3000.00', '', '', '2019-10-18 13:02:01'),
(415, '', 'CHLORAMPHENICOL EAR DROP', 96, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 120, '300.00', '', '', '2019-10-18 13:05:30'),
(416, '', 'CHLORAMPHENICOL EYE DROP', 76, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 120, '300.00', '', '', '2019-10-18 13:07:12'),
(417, '', 'CHLORAMPHENICOL EYE OINTMENT', 77, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 113, '250.00', '', '', '2019-10-18 13:08:41'),
(418, '', 'CHLORAMPHENICOL EYE OINTMENT NHIS', 77, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 113, '150.00', '', '', '2019-10-18 13:09:15'),
(419, '', 'CHLORAMPHENICOL EYE DROP NHIS', 76, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 120, '150.00', '', '', '2019-10-18 13:09:45'),
(420, '', 'CHLORAMPHENICOL EAR DROP NHIS', 96, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 120, '150.00', '', '', '2019-10-18 13:10:16'),
(421, '', 'CIPROXIN EYE DROP', 76, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 850, '1600.00', '', '', '2019-10-18 13:11:33'),
(422, '', 'GENTALAB EYE DROP', 76, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '800.00', '', '', '2019-10-18 13:13:39'),
(423, '', 'GENTALAB EYE DROP NHIS', 76, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '150.00', '', '', '2019-10-18 13:13:58'),
(424, '', 'GENTALAB EAR DROP', 96, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '800.00', '', '', '2019-10-18 13:14:34'),
(425, '', 'GENTALAB EAR DROP NHIS', 96, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '150.00', '', '', '2019-10-18 13:14:52'),
(426, '', 'GENTICIN OINTMENT', 77, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 313, '400.00', '', '', '2019-10-18 13:15:54'),
(427, '', 'TIMOLOL EYE DROP', 76, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 938, '2000.00', '', '', '2019-10-18 13:17:46'),
(428, '', 'DICLOFENAC EYE DROP', 76, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 575, '1000.00', '', '', '2019-10-18 13:19:01'),
(429, '', '10% D/WATER', 79, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 175, '1200.00', '', '', '2019-10-18 13:21:04'),
(430, '', '5% D/WATER', 79, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 175, '1500.00', '', '', '2019-10-18 13:21:42'),
(431, '', '5% D/SALINE', 79, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 175, '1500.00', '', '', '2019-10-18 13:22:02'),
(432, '', '4.3% D/SALINE', 79, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 175, '1500.00', '', '', '2019-10-18 13:22:26'),
(433, '', 'NORMAL SALINE', 79, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 175, '1800.00', '', '', '2019-10-18 13:22:59'),
(434, '', '50% D/WATER', 79, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 223, '1800.00', '', '', '2019-10-18 13:24:17'),
(435, '', 'CALCIUM GLUCONATE INJ', 78, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 87, '500.00', '', '', '2019-10-18 13:26:41'),
(436, '', 'FULL STRENGHT DARROWS', 79, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 450, '1800.00', '', '', '2019-10-18 13:27:39'),
(437, '', 'HALF STRENGHT DARROWS', 79, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 338, '1800.00', '', '', '2019-10-18 13:28:05'),
(438, '', 'IRON DEXTRAN INJ', 78, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '400.00', '', '', '2019-10-18 13:29:04'),
(439, '', 'MANNITOL 10%', 79, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 350, '1800.00', '', '', '2019-10-18 13:29:40'),
(440, '', 'MANNITOL 20%', 79, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 500, '1800.00', '', '', '2019-10-18 13:29:54'),
(441, '', 'SODIUM BICARBONATE', 78, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 650, '1500.00', '', '', '2019-10-18 13:30:51'),
(442, '', 'POTASSIUM CHLORIDE INJ (KCL)', 78, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 650, '1500.00', '', '', '2019-10-18 13:31:21'),
(443, '', 'RINGER LACTATE', 79, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 313, '1800.00', '', '', '2019-10-18 13:32:00'),
(444, '', 'WATER FOR INJ', 78, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 35, '70.00', '', '', '2019-10-18 13:32:43'),
(445, '', 'CALCIUM GLUCONATE INJ (ALPHA)', 78, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1063, '2000.00', '', '', '2019-10-18 13:34:38'),
(446, '', 'BACTROBAN CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1600, '3200.00', '', '', '2019-10-18 13:41:57'),
(447, '', 'BENZYL BENZOATE', 80, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 313, '500.00', '', '', '2019-10-18 13:43:39'),
(448, '', 'BENTADRONE N CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 300, '600.00', '', '', '2019-10-18 13:45:29'),
(449, '', 'CALAMIN LOTION', 80, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 150, '500.00', '', '', '2019-10-18 13:48:14'),
(450, '', 'DAKTACORT CREAM', 80, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 2062, '4000.00', '', '', '2019-10-18 13:48:51'),
(451, '', 'COPPER T (IUCD)', 97, 10, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 210, '500.00', '', '', '2019-10-18 13:52:35'),
(452, '', 'ENDIX G CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 500, '1000.00', '', '', '2019-10-18 13:54:40'),
(453, '', 'ENDIX G CREAM NHIS', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 200, '350.00', '', '', '2019-10-18 13:55:12'),
(454, '', 'GENTICIN OINTMENT', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 150, '300.00', '', '', '2019-10-18 13:56:22'),
(455, '', 'GENTICIN OINTMENT NHIS', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 150, '150.00', '', '', '2019-10-18 13:56:31'),
(456, '', 'HYDROCORTISONE CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 380, '800.00', '', '', '2019-10-18 13:58:38'),
(457, '', 'HYDROCORTISONE CREAM NHIS', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 300, '300.00', '', '', '2019-10-18 13:58:53'),
(458, '', 'K Y JELLY', 82, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 500, '1000.00', '', '', '2019-10-18 13:59:32'),
(459, '', 'MYCOTEN CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 381, '800.00', '', '', '2019-10-18 14:01:14'),
(460, '', 'MYCOTEN CREAM NHIS', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 290, '350.00', '', '', '2019-10-18 14:01:37'),
(461, '', 'MYCOTEN PRESSARIES', 97, 10, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 122, '335.00', '', '', '2019-10-18 14:02:23'),
(462, '', 'MYCOTEN PRESSARIES NHIS', 97, 10, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 35, '60.00', '', '', '2019-10-18 14:02:42'),
(463, '', 'NEUROGESIC CREAM (METHYLSALICYLATE)', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 562, '1300.00', '', '', '2019-10-18 14:04:00'),
(464, '', 'NEUROGESIC CREAM (METHYLSALICYLATE) NHIS', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 225, '250.00', '', '', '2019-10-18 14:04:16'),
(465, '', 'MYCOTEN POWDER', 83, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3500, '5000.00', '', '', '2019-10-18 14:06:47'),
(466, '', 'NIZORAL CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 2000, '3800.00', '', '', '2019-10-18 14:10:01'),
(467, '', 'SULPHUR CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 875, '1600.00', '', '', '2019-10-18 14:10:47'),
(468, '', 'TROSYD CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1025, '2200.00', '', '', '2019-10-18 14:11:47'),
(469, '', 'VIREST CREAM (ACCICLOVAR)', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1000, '2000.00', '', '', '2019-10-18 14:12:35'),
(470, '', 'PERMETHRIN CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3500, '7000.00', '', '', '2019-10-18 14:14:31'),
(471, '', 'QUADRICLEAR CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 750, '1500.00', '', '', '2019-10-18 14:14:59'),
(472, '', 'LIFE CAST (SCOTCH CAST)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 4375, '6500.00', '', '', '2019-10-19 06:04:05'),
(473, '', 'RAZOR BLADE', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 31, '50.00', '', '', '2019-10-19 06:05:00'),
(474, '', 'CANNULAR (ALL TYPES)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 106, '500.00', '', '', '2019-10-19 06:05:54'),
(475, '', 'CATHETER 3-WAY(ALL TYPES)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 313, '1500.00', '', '', '2019-10-19 06:07:08'),
(476, '', 'CERVICAL COLLAR', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1200, '3000.00', '', '', '2019-10-19 06:08:48'),
(477, '', 'COTTON BANDAGE (ALL SIZE)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '250.00', '', '', '2019-10-19 06:10:18'),
(478, '', 'CREPE BANDAGE 4', 84, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 280, '1000.00', '', '', '2019-10-19 06:13:56'),
(479, '', 'CREPE BANDAGE 6', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 280, '1000.00', '', '', '2019-10-19 06:14:15'),
(480, '', 'DELIVERY MAT', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 300, '1500.00', '', '', '2019-10-19 06:16:34'),
(481, '', 'URINE BAG (DRAINAGE BAG)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 156, '300.00', '', '', '2019-10-19 06:20:13'),
(482, '', 'EBT SET', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 7500, '14000.00', '', '', '2019-10-19 06:21:03'),
(483, '', 'ELBOW LENGTH GLOVES', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 625, '1000.00', '', '', '2019-10-19 06:21:37'),
(484, '', 'FEEDING TUBES (ALL TYPES)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 263, '500.00', '', '', '2019-10-19 06:22:35'),
(485, '', 'FOLEY CATHETERS (ALL TYPES)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 263, '500.00', '', '', '2019-10-19 06:23:55'),
(486, '', 'GIVING SET (BLOOD)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 281, '500.00', '', '', '2019-10-19 06:27:49'),
(487, '', 'GIVING SET (FLUID)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 130, '300.00', '', '', '2019-10-19 06:28:35'),
(488, '', 'LATEX GLOVES', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 28, '100.00', '', '', '2019-10-19 06:29:38'),
(489, '', 'SURGICAL GLOVES', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 130, '300.00', '', '', '2019-10-19 06:31:04'),
(490, '', 'INSULINE SYRINGE 100IU', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 35, '500.00', '', '', '2019-10-19 06:34:00'),
(491, '', 'INSULINE SYRINGE 40IU', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 35, '100.00', '', '', '2019-10-19 06:34:28'),
(492, '', 'MERSILENE TAPE', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 9375, '14000.00', '', '', '2019-10-19 06:35:36'),
(493, '', 'METHYLATED SPIRIT 120ML', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 300, '600.00', '', '', '2019-10-19 06:37:11'),
(494, '', 'NEEDLE 21G', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '100.00', '', '', '2019-10-19 06:38:51'),
(495, '', 'NEEDLE 23G', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '100.00', '', '', '2019-10-19 06:38:59'),
(496, '', 'NEEDLE 25G', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '100.00', '', '', '2019-10-19 06:39:12'),
(497, '', 'POP (PLASTER OF PARIS)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 375, '1500.00', '', '', '2019-10-19 06:42:25'),
(498, '', 'PLASTIBEL (ALL SIZE)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 875, '1500.00', '', '', '2019-10-19 06:43:00'),
(499, '', 'S/V NEEDLE (ALL SIZE)(SCALP VEIN)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 13, '30.00', '', '', '2019-10-19 06:43:59'),
(500, '', 'SHAVING STICK', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '200.00', '', '', '2019-10-19 06:45:11'),
(501, '', 'SOFRA TULLE (SUFRATULLE)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 150, '250.00', '', '', '2019-10-19 06:46:01'),
(502, '', 'SOFTBAN 4', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 700, '1400.00', '', '', '2019-10-19 06:47:19'),
(503, '', 'SURGICAL BLADE', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 25, '50.00', '', '', '2019-10-19 06:49:20'),
(504, '', 'SYRINGES 2ML', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 25, '100.00', '', '', '2019-10-19 06:50:26'),
(505, '', 'SYRINGES 5ML', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 25, '100.00', '', '', '2019-10-19 06:50:37'),
(506, '', 'SYRINGES 10ML', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 25, '500.00', '', '', '2019-10-19 06:52:51'),
(507, '', 'SYRINGES 20ML', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 47, '600.00', '', '', '2019-10-19 06:53:09'),
(508, '', 'SYRINGES 50ML', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 350, '1000.00', '', '', '2019-10-19 06:54:15'),
(509, '', 'DIGITAL THERMOMETER', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 500, '1000.00', '', '', '2019-10-19 06:54:58'),
(510, '', 'DRESSING PACK AND GANGI', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 625, '1250.00', '', '', '2019-10-19 06:56:01'),
(511, '', 'GANGI', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 500, '1000.00', '', '', '2019-10-19 06:56:24'),
(512, '', 'FLUMOX 250MG SYR', 43, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 1565, '3150.00', '', '', '2019-10-19 06:58:40'),
(513, '', 'LAMIVUDINE TAB', 85, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 170, '400.00', '', '', '2019-10-19 07:01:59'),
(514, '', 'NEVIRAPINE/ZIDOVUDINE/LAMIVUDINE TAB', 85, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 170, '400.00', '', '', '2019-10-19 07:03:24'),
(515, '', '5 FLUOROURACIL INJ (5-FU)', 89, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 500, '1500.00', '', '', '2019-10-19 07:05:36'),
(516, '', 'CYCLOPHOSPHAMIDE 50MG TAB', 88, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 88, '150.00', '', '', '2019-10-19 07:08:15'),
(517, '', 'FILGRASTIN INJ', 89, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 12688, '20000.00', '', '', '2019-10-19 07:08:56'),
(518, '', 'FLUTAMIDE 250MG TAB', 88, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 140, '300.00', '', '', '2019-10-19 07:09:51'),
(519, '', 'METHOTREXATE INJ', 89, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 750, '1500.00', '', '', '2019-10-19 07:11:11'),
(520, '', 'CHROMIC (ALL TYPES)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 833, '1500.00', '', '', '2019-10-19 07:15:37'),
(521, '', 'ETHILON (ALL TYPES)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1665, '2500.00', '', '', '2019-10-19 07:16:22'),
(522, '', 'MONOCRYL (ALL TYPES)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 833, '1500.00', '', '', '2019-10-19 07:17:12'),
(523, '', 'NYLON (ALL TYPES)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 417, '1500.00', '', '', '2019-10-19 07:17:37'),
(524, '', 'VICRYL (ALL TYPES)', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1500, '2500.00', '', '', '2019-10-19 07:18:43'),
(525, '', 'ADRENALINE INJ', 90, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 313, '500.00', '', '', '2019-10-19 07:22:55'),
(526, '', 'ATRACURIUM INJ', 90, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1625, '3000.00', '', '', '2019-10-19 07:23:27'),
(527, '', 'ATROPINE INJ', 90, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 350, '1060.00', '', '', '2019-10-19 07:23:55'),
(528, '', 'EPHEDRINE INJ', 90, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 313, '700.00', '', '', '2019-10-19 07:29:02'),
(529, '', 'ISOFLURANE INJ/ML', 90, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 250, '1000.00', '', '', '2019-10-19 07:30:40'),
(530, '', 'KETAMINE INJ', 90, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 688, '1000.00', '', '', '2019-10-19 07:31:32'),
(531, '', 'NEOSTIGMINE INJ', 90, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 275, '750.00', '', '', '2019-10-19 07:32:30'),
(532, '', 'ONDANSETRON INJ', 90, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 313, '500.00', '', '', '2019-10-19 07:35:23'),
(533, '', 'OXYGEN (LARGE)', 84, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 7500, '15000.00', '', '', '2019-10-19 07:36:25'),
(534, '', 'OXYGEN (BIG)', 84, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 2500, '5500.00', '', '', '2019-10-19 07:36:45'),
(535, '', 'PANCURONIUM INJ', 90, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1106, '3000.00', '', '', '2019-10-19 07:37:31'),
(536, '', 'PETHIDINE INJ', 90, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1100, '3000.00', '', '', '2019-10-19 07:38:08'),
(537, '', 'PROPOFOL INJ', 90, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 875, '4000.00', '', '', '2019-10-19 07:39:34'),
(538, '', 'SUXAMETHONIUM INJ', 90, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 200, '500.00', '', '', '2019-10-19 07:40:19'),
(539, '', 'MANUAL THERMOMETER', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 105, '300.00', '', '', '2019-10-19 07:41:11'),
(541, '', 'XYLOCAINE INJ / 1ML', 90, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 13, '100.00', '', '', '2019-10-19 07:43:17'),
(542, '', 'XYLOCAINE + ADRENALINE INJ / 1ML', 90, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 15, '150.00', '', '', '2019-10-19 07:43:44'),
(543, '', 'ANTI SNAKE VENUM', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 2500, '4500.00', '', '', '2019-10-19 07:46:40'),
(544, '', 'BCG', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '200.00', '', '', '2019-10-19 07:47:15'),
(545, '', 'CERVARIX', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 11125, '15000.00', '', '', '2019-10-19 07:48:10'),
(546, '', 'DTP', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 600, '700.00', '', '', '2019-10-19 07:48:32'),
(547, '', 'HBV', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 200, '400.00', '', '', '2019-10-19 07:50:06'),
(548, '', 'MEASLES', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '200.00', '', '', '2019-10-19 07:50:57'),
(549, '', 'CHOLERA', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 6938, '10000.00', '', '', '2019-10-19 07:54:29'),
(550, '', 'MEASLES, MUMPS AND RUBELLA (MMR)', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 4375, '7000.00', '', '', '2019-10-19 07:57:00'),
(551, '', 'ANTIRABIES', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3750, '11500.00', '', '', '2019-10-19 07:57:46'),
(552, '', 'ROTAIX', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 8125, '12000.00', '', '', '2019-10-19 07:58:33'),
(553, '', 'TWINRIX', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 7125, '10000.00', '', '', '2019-10-19 07:58:59'),
(554, '', 'TYPHOID', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 5625, '10000.00', '', '', '2019-10-19 07:59:36'),
(555, '', 'CHICKEN POX (VARILIX)', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 7000, '10000.00', '', '', '2019-10-19 08:00:07'),
(556, '', 'NIMENRIX', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 8978, '10000.00', '', '', '2019-10-19 08:00:33'),
(557, '', 'YELLOW FEVER', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 100, '200.00', '', '', '2019-10-19 08:01:01'),
(558, '', 'HEPATITIS A', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 11250, '15000.00', '', '', '2019-10-19 08:04:01'),
(559, '', 'DEXAMETHASONE INJ', 61, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 31, '200.00', '', '', '2019-11-01 11:56:56'),
(560, '', 'FLUCONAZOLE CAP NHIS', 44, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 20, '50.00', '', '', '2019-11-01 12:18:34'),
(561, '', 'MODURETIC TAB', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 6, '20.00', '', '', '2019-11-01 12:55:05'),
(562, '', 'MODURETIC TAB NHIS', 59, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 6, '7.00', '', '', '2019-11-01 12:55:27'),
(563, '', 'MEFENAMIC ACID TAB', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 94, '200.00', '', '', '2019-11-01 13:22:47'),
(564, '', 'EVE 500MG TAB', 40, 7, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 50, '150.00', '', '', '2019-11-01 13:28:23'),
(565, '', 'ORAL REHYDRATION SOLUTION (ORS)', 49, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 43, '250.00', '', '', '2019-11-01 13:33:34'),
(566, '', 'BAROLE (RABEPRAZOLE) 20MG TAB NHIS', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 35, '80.00', '', '', '2019-11-01 13:43:11'),
(567, '', 'ZINC 20MG TAB', 47, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 50, '200.00', '', '', '2019-11-01 13:51:20'),
(568, '', 'FYBOGEL SATCHET', 49, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 270, '500.00', '', '', '2019-11-01 13:54:23'),
(569, '', 'FORTSPORINE1G INJ (CEFEPIME)', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 2875, '5750.00', '', '', '2019-11-01 14:21:56'),
(570, '', 'NIRIZONE INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1000, '3000.00', '', '', '2019-11-01 14:27:51'),
(571, '', '10% DEXTROSE', 79, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 500, '1800.00', '', '', '2019-11-01 14:32:08'),
(572, '', 'CAFERGOT TAB', 94, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 25, '50.00', '', '', '2019-11-01 14:48:38'),
(573, '', 'CALCIMAX SYR', 52, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 250, '500.00', '', '', '2019-11-01 15:05:31'),
(574, '', 'SPIRONOLACTONE 50MG TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 60, '100.00', '', '', '2019-11-01 15:12:44'),
(575, '', 'LARGACTIL 100MG TAB', 58, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 8, '20.00', '', '', '2019-11-01 15:19:29'),
(576, '', 'AMATEM 20/120MG TAB', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', 0, '', '', '', 0, 26, '100.00', '', '', '2019-11-01 15:33:52'),
(578, '', 'CAMOQUINE TAB', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 67, '100.00', '', '', '2019-11-01 16:41:32'),
(579, '', 'CLEXANE INJ', 45, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1750, '3000.00', '', '', '2019-11-02 07:02:26'),
(580, '', 'ASPIRIN TAB', 50, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3, '10.00', '', '', '2019-11-02 07:08:35'),
(581, '', 'PIRITON 4MG TAB', 68, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '20.00', '', '', '2019-11-02 07:11:23'),
(582, '', 'NITROFURATOIN TAB', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1, '10.00', '', '', '2019-11-02 07:24:24'),
(583, '', 'NALOXONE 0.4MG INJ', 56, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1500, '3000.00', '', '', '2019-11-02 07:42:10'),
(584, '', 'QUINNINE 600MG INJ', 35, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 55, '300.00', '', '', '2019-11-02 08:02:00'),
(586, '', 'DEEP RELIEF CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 213, '250.00', '', '', '2019-11-02 08:06:18'),
(587, '', 'TIOCOCID CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1025, '2200.00', '', '', '2019-11-02 08:09:24'),
(588, '', 'DERMAZINE CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1700, '2500.00', '', '', '2019-11-02 08:12:31'),
(589, '', 'DERMAZINE CREAM NHIS (BURNOUT)', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 300, '400.00', '', '', '2019-11-02 08:13:58'),
(590, '', 'BETATHASONE CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1000, '1500.00', '', '', '2019-11-02 08:17:29'),
(591, '', 'MUPIDERM CREAM', 80, 8, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 2250, '4000.00', '', '', '2019-11-02 08:22:03'),
(592, '', 'ORAL CONTRACEPTIVE', 40, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 5, '10.00', '', '', '2019-11-02 08:43:51'),
(593, '', 'SOLUSET', 84, 11, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1320, '4500.00', '', '', '2019-11-02 08:57:21'),
(594, '', 'PREVENAR 13', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10750, '14500.00', '', '', '2019-11-02 09:13:50'),
(595, '', 'HEPATITIS B', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 3938, '6000.00', '', '', '2019-11-02 09:15:23'),
(596, '', 'DUOTHER 80/480MG TAB NHIS', 34, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 73, '83.00', '', '', '2019-11-19 13:35:50'),
(598, '', 'VITAMIN A 100000 IU', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 1, '1.00', '', '', '2019-11-19 13:37:58'),
(599, '', 'VITAMIN A 25000 IU', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 22, '50.00', '', '', '2019-11-19 13:38:13'),
(600, '', 'ROUTINE ANC DRUGS 1WK', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 176, '450.00', '', '', '2019-11-22 18:40:26'),
(601, '', 'ROUTINE ANC DRUGS 2WK', 53, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 352, '850.00', '', '', '2019-11-22 18:40:43'),
(602, '', 'IBRUFEN SYRUP NHIS', 27, 5, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 146, '250.00', '', '', '2019-11-26 09:27:09'),
(603, '', 'TETANUS INJ (T.T)', 91, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 50, '200.00', '', '', '2019-12-10 10:41:21'),
(604, '', 'Aciclovir 200mg', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 105, '200.00', '', '', '2019-12-11 15:00:20'),
(605, '', 'Aciclovir 400mg', 44, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 178, '300.00', '', '', '2019-12-11 15:01:25'),
(606, '', 'Ventolin nebules 2.5mg', 73, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 106, '1000.00', '', '', '2019-12-11 15:03:45'),
(607, '', 'Ventolin nebules 5mg', 73, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 200, '1800.00', '', '', '2019-12-11 15:04:41'),
(608, '', 'Ventolin tab 4mg', 68, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 10, '25.00', '', '', '2019-12-11 15:06:13'),
(609, '', 'Ventolin tab 2mg', 68, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 25, '50.00', '', '', '2019-12-18 08:06:18'),
(610, '', 'Phenegan injection', 69, 6, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 0, 250, '500.00', '', '', '2019-12-18 08:09:42'),
(611, '', 'Phenobarbitone 60mg', 58, 4, 100, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', 1, 8, '50.00', '', '', '2019-12-18 08:15:49');
INSERT INTO `pharm_stock` (`id`, `reference2`, `name`, `category`, `units`, `stock`, `Stock_number`, `manufactured`, `expiring`, `c_carton`, `r_packs`, `erp`, `manufacturer`, `generic`, `batch`, `s_usage`, `cost_price`, `price`, `nurse`, `doctor's`, `date_added`) VALUES
(612, '', 'GLUFORMIN 500MG TAB', 59, 4, 100, '6156000067674', '2019-07-30 00:00:00', '2022-06-30 00:00:00', '', '', 0, 'NGC', 'METFORMIN HYDROCHLORIDE', 'FPG080219', 2, 1800, '0.00', '', '', '2020-09-18 13:47:23'),
(613, '', 'GLUFORMIN 500MG TAB', 59, 4, 100, '6156000067674', '2019-07-30 00:00:00', '2022-06-30 00:00:00', '', '', 0, 'NGC', 'METFORMIN HYDROCHLORIDE', 'FPG080219', 2, 1800, '0.00', '', '', '2020-09-18 13:51:36'),
(614, '', 'DUPHASTON 10MG TAB', 40, 4, 100, '213', '2019-03-01 00:00:00', '2024-02-28 00:00:00', '', '', 0, 'ABBOT', 'DYDRGESTERONE/DIDROGESTERONA', '358680', 2, 2300, '0.00', '', '', '2020-09-18 13:53:21'),
(615, '', 'QUININE', 34, 4, 100, '15', '2019-03-31 00:00:00', '2022-02-01 00:00:00', '', '', 0, 'SAVOCENT PHARMA', 'QUININE', '19T0302', 2, 2600, '0.00', '', '', '2020-09-18 13:58:41'),
(618, '', 'TYPHIM', 91, 6, 100, '871', '2019-04-01 00:00:00', '2021-04-30 00:00:00', '', '', 0, 'SANOFI', 'TYPHOID', 'R2A272M', 2, 4500, '0.00', '', '', '2020-09-18 20:26:56'),
(620, '2020092316', 'STUGERON TAB', 68, 4, 100, '111', '2019-01-01 00:00:00', '2021-12-30 00:00:00', '', '', 0, 'JANSSEN', 'CINARICINA', '19AQ135', 2, 1700, '0.00', '', '', '2020-09-22 22:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `pharm_stock1`
--

CREATE TABLE `pharm_stock1` (
  `id` int(11) NOT NULL,
  `pharm_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pharm_stock1`
--

INSERT INTO `pharm_stock1` (`id`, `pharm_id`, `qty`, `status`, `staff`, `date_added`) VALUES
(1, 611, 2, 1, 2, '2020-07-30 12:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `pharm_suppliers`
--

CREATE TABLE `pharm_suppliers` (
  `Supplier_ID` int(11) NOT NULL,
  `Supplier_Number` varchar(255) NOT NULL,
  `Supplier_Name` text NOT NULL,
  `Address` text NOT NULL,
  `City` text NOT NULL,
  `Country` text NOT NULL,
  `Contact_Person` text NOT NULL,
  `Phone_Number` text NOT NULL,
  `Email` text NOT NULL,
  `Mobile_Number` text NOT NULL,
  `Notes` longtext NOT NULL,
  `Balance` double(10,2) NOT NULL,
  `Is_Stock_Available` text NOT NULL,
  `Date_Added` datetime NOT NULL,
  `Added_By` int(11) NOT NULL,
  `Date_Updated` datetime NOT NULL,
  `Updated_By` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pharm_units`
--

CREATE TABLE `pharm_units` (
  `id` int(11) NOT NULL,
  `unit_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pharm_units`
--

INSERT INTO `pharm_units` (`id`, `unit_name`, `date_added`) VALUES
(4, 'Tablet', '2019-09-16 12:51:21'),
(5, 'Bottle', '2019-09-16 12:51:40'),
(6, 'Ampoule', '2019-09-16 12:52:02'),
(7, 'Capsule', '2019-09-16 13:33:18'),
(8, 'TUBE', '2019-09-24 15:19:25'),
(9, 'SUSPENSION', '2019-09-24 15:31:00'),
(10, 'Material', '2020-03-12 08:28:09'),
(11, 'Satchet', '2020-03-16 11:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `pharm_updates`
--

CREATE TABLE `pharm_updates` (
  `id` int(11) NOT NULL,
  `pharm_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharm_updates`
--

INSERT INTO `pharm_updates` (`id`, `pharm_id`, `quantity`, `staff`, `date_added`) VALUES
(1, 177, 875, 179, '2020-06-01 23:02:17'),
(2, 184, 282, 179, '2020-06-01 23:04:11'),
(3, 174, 101, 179, '2020-06-01 23:05:13'),
(4, 181, 88, 179, '2020-06-01 23:06:13'),
(5, 179, 8, 179, '2020-06-01 23:07:26'),
(6, 183, 143, 179, '2020-06-01 23:09:13'),
(7, 274, 36, 179, '2020-06-01 23:10:32'),
(8, 282, 6, 179, '2020-06-01 23:11:56'),
(9, 277, 49, 179, '2020-06-01 23:12:50'),
(10, 261, 22, 179, '2020-06-01 23:13:25'),
(11, 278, 34, 179, '2020-06-01 23:15:43'),
(12, 275, 23, 179, '2020-06-01 23:16:35'),
(13, 246, 3, 179, '2020-06-01 23:17:06'),
(14, 599, 157, 179, '2020-06-01 23:18:49'),
(15, 283, 6, 179, '2020-06-01 23:19:42'),
(16, 280, 130, 179, '2020-06-01 23:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `pharm_usage`
--

CREATE TABLE `pharm_usage` (
  `id` int(11) NOT NULL,
  `usage_name` text NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharm_usage`
--

INSERT INTO `pharm_usage` (`id`, `usage_name`, `date_added`) VALUES
(2, 'Consumable', '2019-06-29 08:33:29'),
(3, 'Non - Consumable', '2019-06-29 08:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `physiotherapy_requests`
--

CREATE TABLE `physiotherapy_requests` (
  `physiotherapy_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `link_ref` longtext NOT NULL,
  `front_desk` varchar(255) NOT NULL,
  `patient_appointment_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = paid, 0 = not paid',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prechecklist`
--

CREATE TABLE `prechecklist` (
  `id` int(11) NOT NULL,
  `q1` text NOT NULL,
  `q2` text NOT NULL,
  `q3` text NOT NULL,
  `q4` text NOT NULL,
  `q5` text NOT NULL,
  `q6` text NOT NULL,
  `q7` text NOT NULL,
  `q8` text NOT NULL,
  `q9` text NOT NULL,
  `q10` text NOT NULL,
  `q11` text NOT NULL,
  `q12` text NOT NULL,
  `q13` text NOT NULL,
  `q14` text NOT NULL,
  `q15` text NOT NULL,
  `q16` text NOT NULL,
  `q17` text NOT NULL,
  `staff` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescription_id` int(11) NOT NULL,
  `reference` longtext NOT NULL,
  `sales_id` longtext NOT NULL,
  `diagnosis` longtext NOT NULL,
  `pharm_stock_id` int(11) NOT NULL,
  `bid` varchar(255) NOT NULL,
  `tabs` int(11) DEFAULT NULL,
  `dosage` int(11) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `quantity_dispense` varchar(255) DEFAULT NULL,
  `stabs` varchar(255) NOT NULL,
  `squantity_dispense` varchar(255) NOT NULL,
  `sdosage` varchar(255) NOT NULL,
  `sduration` varchar(255) NOT NULL,
  `instruction` longtext NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_id` varchar(255) NOT NULL,
  `front_desk` varchar(255) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 is pending 1 is done',
  `company_id` int(255) NOT NULL,
  `pres_status` int(11) NOT NULL COMMENT '0 is pending 1 is processed',
  `pdate_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `prescription_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prescription1`
--

CREATE TABLE `prescription1` (
  `prescription_id` int(11) NOT NULL,
  `reference` longtext NOT NULL,
  `sales_id` longtext NOT NULL,
  `diagnosis` longtext NOT NULL,
  `pharm_stock_id` int(11) NOT NULL,
  `bid` varchar(255) NOT NULL,
  `tabs` int(11) DEFAULT NULL,
  `dosage` int(11) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `quantity_dispense` int(11) DEFAULT NULL,
  `stabs` varchar(255) NOT NULL,
  `squantity_dispense` varchar(255) NOT NULL,
  `sdosage` varchar(255) NOT NULL,
  `sduration` varchar(255) NOT NULL,
  `instruction` longtext NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_id` varchar(255) NOT NULL,
  `front_desk` varchar(255) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 is pending 1 is done',
  `company_id` int(255) NOT NULL,
  `pres_status` int(11) NOT NULL COMMENT '0 is pending 1 is processed',
  `pdate_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `prescription_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription1`
--

INSERT INTO `prescription1` (`prescription_id`, `reference`, `sales_id`, `diagnosis`, `pharm_stock_id`, `bid`, `tabs`, `dosage`, `duration`, `quantity_dispense`, `stabs`, `squantity_dispense`, `sdosage`, `sduration`, `instruction`, `doctor_id`, `appointment_id`, `front_desk`, `patient_id`, `status`, `company_id`, `pres_status`, `pdate_added`, `prescription_status`) VALUES
(1, '10447', '', 'Problem', 2, '', 0, 0, '', 0, '2', '2', '1', '1', '', 2, '1', '5f2877b8c4c5a', 1, 0, 0, 0, '2020-08-03 20:58:29', NULL),
(2, '14477', '', 'Problem', 8, '', 0, 0, '', 0, '3', '18', '2', '3', '', 2, '1', '5f2877b8c4c5a', 1, 12, 0, 0, '2020-08-24 03:25:16', NULL),
(3, '22556', '', '', 2, '', 0, 0, '', 0, '2', '8', '2', '2', 'kkb', 86, '1', '5f401a2088562', 9, 8, 0, 0, '2020-09-16 10:01:54', NULL),
(4, '85742', '', '', 2, '', 0, 0, '', 0, '1', '1omls', '4', '22', 'fshrygb', 97, '5', '5f61f5f64b8c9', 11, 0, 0, 0, '2020-09-16 15:38:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `note` longtext NOT NULL,
  `ipd_numb` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `samples`
--

CREATE TABLE `samples` (
  `id` int(11) NOT NULL,
  `sample` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `samples`
--

INSERT INTO `samples` (`id`, `sample`, `status`, `added_by`, `date_added`, `updated_by`, `date_updated`) VALUES
(1, 'Whole Blood', 1, 2, '2020-08-20 07:41:51', 0, '0000-00-00 00:00:00'),
(2, 'Red Blood Cell', 1, 2, '2020-08-20 07:42:05', 0, '0000-00-00 00:00:00'),
(3, 'White Blood Cell', 1, 2, '2020-08-20 07:42:11', 0, '0000-00-00 00:00:00'),
(4, 'Plasma', 1, 2, '2020-08-20 07:42:17', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `scan`
--

CREATE TABLE `scan` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `fee` int(255) NOT NULL,
  `nurse` int(11) NOT NULL,
  `category` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scan`
--

INSERT INTO `scan` (`id`, `name`, `fee`, `nurse`, `category`) VALUES
(6, 'Obstetrics', 3000, 0, '1'),
(39, 'Pelvic', 5000, 0, '1'),
(41, 'Abdominal', 5000, 0, '1'),
(42, 'Abdominopelvic', 5000, 0, '1'),
(43, 'Breast', 7000, 0, '1'),
(44, 'Prostate', 7000, 0, '1'),
(45, 'ABDOMENAL', 5000, 0, '1'),
(46, 'ABDOMENAL', 5000, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `scan_files`
--

CREATE TABLE `scan_files` (
  `extra_file_id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `link_ref` varchar(255) NOT NULL,
  `extra_file` longtext NOT NULL,
  `comment` longtext NOT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scan_requests`
--

CREATE TABLE `scan_requests` (
  `id` int(11) NOT NULL,
  `patient_id` int(20) NOT NULL,
  `appointment_id` int(20) NOT NULL,
  `link` longtext NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` longtext NOT NULL,
  `time_requested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scan_requests`
--

INSERT INTO `scan_requests` (`id`, `patient_id`, `appointment_id`, `link`, `name`, `type`, `time_requested`, `staff_id`) VALUES
(1, 1039, 896, '5e284234ced87', '6', '1', '2020-01-22 12:38:12', 146),
(2, 1042, 899, '5e285af50fc7f', '39', '1', '2020-01-22 14:23:49', 144),
(3, 1071, 942, '5e2aa669437da', '42', '1', '2020-01-24 08:10:17', 92),
(4, 1443, 1502, '5e6a286438149', '45', '1', '2020-03-12 12:17:40', 2),
(5, 1495, 1566, '5e6f79e334000', '42', '1', '2020-03-16 13:06:43', 92),
(6, 2029, 2427, '5f22f60e0205c', '6', '1', '2020-07-30 16:32:14', 2),
(7, 2029, 2428, '5f23244449523', '6', '1', '2020-07-30 19:49:24', 2),
(8, 2029, 2428, '5f23244449523', '39', '1', '2020-07-30 19:49:24', 2),
(9, 1, 1, '5f28791091720', '6', '1', '2020-08-03 20:52:32', 2),
(10, 9, 1, '5f60e1b84d874', '46', '1', '2020-09-15 15:46:00', 86),
(12, 11, 5, '5f61fa4be49ed', '39', '1', '2020-09-16 11:43:07', 97),
(13, 2, 8, '5f630d1f6847d', '45', '1', '2020-09-17 07:15:43', 2),
(14, 2, 22, '5f67b2c4e241d', '6', '1', '2020-09-20 19:51:32', 86);

-- --------------------------------------------------------

--
-- Table structure for table `scan_types`
--

CREATE TABLE `scan_types` (
  `scan_cat_id` int(200) NOT NULL,
  `category` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scan_types`
--

INSERT INTO `scan_types` (`scan_cat_id`, `category`) VALUES
(1, 'Ultrasound');

-- --------------------------------------------------------

--
-- Table structure for table `send_test`
--

CREATE TABLE `send_test` (
  `id` int(255) NOT NULL,
  `staff_to` varchar(255) NOT NULL,
  `staff_from` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = not viewed 1 = viewed',
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_url`
--

CREATE TABLE `site_url` (
  `id` int(11) NOT NULL,
  `site_url` longtext COLLATE utf8_unicode_ci NOT NULL,
  `site_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `user_id` int(11) NOT NULL,
  `staff_img` text COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `other_names` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `contact_address` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `pob` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `mstatus` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `religion` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `nok` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `phone_nok` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `lga` int(11) NOT NULL,
  `date_of_emp` datetime NOT NULL,
  `starting_salary` int(20) NOT NULL,
  `weight` int(20) NOT NULL,
  `no_of_children` int(11) NOT NULL,
  `child1` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `child2` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `child3` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `child4` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `reg_num` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `salary` int(11) NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `status1` int(11) NOT NULL DEFAULT '0' COMMENT '0=not approved, 1= approved',
  `role_id` int(11) NOT NULL,
  `specialty` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `logged_in` int(11) NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`user_id`, `staff_img`, `first_name`, `last_name`, `other_names`, `contact_address`, `phone_number`, `dob`, `sex`, `pob`, `mstatus`, `religion`, `nok`, `phone_nok`, `state`, `lga`, `date_of_emp`, `starting_salary`, `weight`, `no_of_children`, `child1`, `child2`, `child3`, `child4`, `position`, `username`, `password`, `reg_num`, `address`, `email`, `phone`, `salary`, `image`, `status1`, `role_id`, `specialty`, `ward_id`, `logged_in`, `date_added`) VALUES
(2, '1558244160.jpg', 'Admin', 'Admin', '', '', '90923898753', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', '', 'admin', '$2y$10$CUdKkGd20dRB3ZhCqw.nfui.qpKHTBAxp4g1E6j2APVAagAiNs8DK', '', '', '', '', 0, '', 0, 1, 0, 0, 1, '2019-02-07 03:07:05'),
(67, '', 'Chinyere Rita', 'Ezeobollo', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'medical Imaging Scientist', 'rITA', '$2y$10$nsj/Esw0rcZLI4Cjq8BhsOWaiQjZcZ.08OHvrnFN4KnAOICAmrE3e', '', '', '', '', 0, '', 0, 11, 0, 0, 0, '2019-09-12 10:40:29'),
(71, '', 'Glory', 'Ebireri', '', '15, Uti street,PTI road', '09022319695', '1970-01-01', 'female', '', 'sINGLE', '', '', '', 'delta', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'it student', 'glory', '$2y$10$6fiFaNcvKvkB4wNRiYuDf.Pb/TWqN4iaNLEd5XW8ft0E17seovhx2', '', '', '', '', 0, '', 0, 3, 0, 0, 0, '2019-09-12 11:35:00'),
(72, '', 'ESIRORIE', 'IGHOTEVWO', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'mEDICAL OFFICER', 'drtevwo', '$2y$10$h9Olc6RgZfmONDCMCu9LaOqxMwLwX2jTSxaVIFJ9DKdGs9ySb0w4S', '', '', '', '', 0, '', 0, 5, 0, 0, 0, '2019-09-12 12:02:34'),
(75, '', 'Stella', 'Nzefili', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'pharm assistant', 'nze', '$2y$10$BfPpJT3CjOmXK.hpHqO33uU3BtaGxt62rfEFLwP.IacdoKOLlSsy2', '', '', '', '', 0, '', 0, 4, 0, 0, 0, '2019-09-12 12:47:19'),
(76, '', 'IFEANYI', 'JUDE', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'aDMI N OFFICER', 'nWAOJEI', '$2y$10$kgAxXtejxvFqouMZP0QDsuU60Hq1F2YGhRpCIbOLcTi77ar98LcUC', '', '', '', '', 0, '', 0, 1, 0, 0, 0, '2019-09-12 12:56:36'),
(77, '', 'Sylvia', 'Edobor', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'record Officer', 'ese', '$2y$10$W9pKE7IgNBhJcs/l61Nhk.ik9KbtBPY7ZvCewatbcOm5nEOTQ.sje', '', '', '', '', 0, '', 0, 2, 0, 0, 0, '2019-09-12 13:09:54'),
(78, '', 'AVWEROSUO', 'AKPOWENE-OVIE', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'aDMIN 2', 'aNGELIC SUO', '$2y$10$UsvaWAFo8o//yAteEra6F.0nqBAVQUP4gWgQ18s9eQBOM7ql1t1oC', '', '', '', '', 0, '', 0, 1, 0, 0, 0, '2019-09-12 13:17:42'),
(79, '', 'Janet', 'Okoh', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'corper', 'janet', '$2y$10$VJMxRYGqKHzi9UwDaER4d.FDiPlaZXr.GuHB0G0g6bdQ.lE0mrpjO', '', '', '', '', 0, '', 0, 2, 0, 0, 0, '2019-09-12 13:18:56'),
(80, '', 'Victoria', 'Okeke', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'record Officer', 'nkeiruka', '$2y$10$oHR2rfvJfRXLExmNESYrA.cvCUaqAQHuy00hQ/07a2jHdQT8Q2gj.', '', '', '', '', 0, '', 0, 2, 0, 0, 0, '2019-09-12 13:24:53'),
(81, '', 'Naomi', 'Diamreyan', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'record Officer', 'naomi', '$2y$10$iv5SHM1WEg466HbNRugNNOUj.CkNVw0622iVz3.p40iKKFMnuvp.G', '', '', '', '', 0, '', 0, 2, 0, 0, 0, '2019-09-13 07:01:15'),
(83, '', 'Priscillia', 'Igbunu', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'accountant', 'marvel', '$2y$10$PBs5nFv9akqxFtmfmTIgmO..IoZ04xibHnk249FTnmtVX3cY3/6YO', '', '', '', '', 0, '', 0, 18, 0, 0, 0, '2019-09-13 07:40:49'),
(84, '', 'Samson', 'Omale', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'accountant', 'samson', '$2y$10$47m1R2U8G8tg5fx0dmdWoepp8cPpaQRNB6eRtdMxzCT5rviwxMlci', '', '', '', '', 0, '', 0, 6, 0, 0, 0, '2019-09-13 07:48:04'),
(85, '', 'Jennifer', 'Onoriode', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'pharmacologist', 'jennyskillz', '$2y$10$4AmdhP.GyPwKXG9LX0Oqd.uiOdZhsSDT3NONL/hCR.s87thLayrnS', '', '', '', '', 0, '', 0, 15, 0, 0, 0, '2019-09-13 08:51:17'),
(86, '', 'Test', 'Doc', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'test doctor', 'fake', '$2y$10$K/eoROUEB9u..fnbpN73xeDrTU8qvBDArCMNfx/K.SdsBEtWagyWe', '', '', '', '', 0, '', 0, 5, 2, 0, 1, '2019-09-13 10:49:05'),
(88, '', 'Onyinye', 'Nwankwo', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'pharm assistant', 'onyinye', '$2y$10$9MnurhhWgZiDF70SxzQHx.mDxkB02dbnAlPoKPubtrmbAKzs64Lai', '', '', '', '', 0, '', 0, 4, 0, 0, 0, '2019-09-13 11:21:06'),
(89, '', 'Agnes', 'Igbokwe', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nHIS officer', 'ifeoma', '$2y$10$fCqrhxHRbrailpcLXzyKoe92LcnoDuFg2nA.zXkB2Xx/qfR04KM5i', '', '', '', '', 0, '', 0, 13, 0, 0, 0, '2019-09-13 11:36:50'),
(90, '', 'Beverly', 'Oniyama', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'accountant', 'beverly', '$2y$10$ewOjiqrGeNoGSRIleRwL8uwZt4.Z4HUGW4b4.575NwjykqgNgTrLW', '', '', '', '', 0, '', 0, 18, 0, 0, 0, '2019-09-13 11:40:56'),
(91, '', 'Bevo', 'Oniyama', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'requisition officer', 'beverly2', '$2y$10$wnO8/1pjukr5R8G6J9KrQutAlMNdxLL3sl.uvD3SyIWmyjGFOTrhC', '', '', '', '', 0, '', 0, 16, 0, 0, 0, '2019-09-13 11:43:41'),
(92, '', 'ELOHOR', 'UNUARHE', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'mEDICAL OFFICER', 'drelohor', '$2y$10$euRqFD6.Cx9dPghqIUZtPe0/SIzNTabDvcsG5pn/WvykbhSEZZoyO', '', '', '', '', 0, '', 0, 5, 0, 0, 0, '2019-09-16 08:11:25'),
(93, '', 'EKPE', 'ORIEMOGOR', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'aDMIN. MANAGER', 'grace4mercy', '$2y$10$I4c3yHjzuIT8EnGRK37jkO6mmBA8391GyLh5f0yKnrMwBK4y2rM2a', '', '', '', '', 0, '', 0, 1, 0, 0, 0, '2019-09-16 08:50:00'),
(96, '', 'Moyo', 'Akinyosoye', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'record Officer', 'moyo', '$2y$10$GwvyOREGemXZuC33O9cYZenKUHA3NzQXbTFB/qSbSo2VkZA9Tsvpu', '', '', '', '', 0, '', 0, 2, 0, 0, 0, '2019-09-18 09:24:31'),
(97, '', 'Fake', 'Doc', '', '', '', '1970-01-01', '', '', '', '', '', '', '', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'fake doc', 'doctor', '$2y$10$v0cy2rB8W0qODHKEfTikqeBoNX.zRJT8xhOes96y7s6/9aF68WGbG', '', '', '', '', 0, '', 0, 5, 0, 0, 0, '2019-09-18 09:31:39'),
(98, '', 'Bevy', 'Oniyama', '', '', '', '0000-00-00', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'pharm Assistant', 'bevy', '$2y$10$sf5GoqFYUVQo4LJKdcxetudga3Zu4H7dybr2DMxqhLA7D8CuINAL6', '', '', '', '', 0, '', 0, 4, 0, 0, 0, '2019-09-19 08:43:41'),
(99, '1570194058.ico', 'Chioma', 'Uzoh', 'Stella', '16 Ogunu road, Warri', '', '0000-00-00', 'male', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'greenhouse Admin', 'chioma', '$2y$10$ppElFfmlY7.bWXCifg5I6.gpEUX6V2ggUsJBIEKqeHwGxNQyGDHeK', '', '', '', '', 0, '', 0, 1, 0, 0, 0, '2019-10-04 10:00:58'),
(100, '', 'Francisca', 'Obi', 'Elo', '', '07067487706', '1970-01-01', 'female', '', 'single', '', '', '', 'delta', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'nurse', 'francisca', '$2y$10$jOuaLM5FFsu8H9NVSjW5EunMde/G7Mh5eYjbYhX8ZO196iXb9D81K', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-04 10:16:50'),
(103, '1570196571.ico', 'Chinyere', 'Etumonuwa', 'Theresa', '11 glorious street, Okuokoko', '08130767591, 0807423', '0000-00-00', 'male', '', '', 'christian', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nurse', 'chichi', '$2y$10$mVdssnAP7JrDXjkdhjEBWeiOrIsnd8/LO9NYX5su0Jw2m5iVJ7ut2', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-04 10:42:51'),
(104, '1570197709.ico', 'Avwerosuoghene', 'Otuonunyo', 'Trust', '30 Aka Avenue off refinery road', '07036776678', '0000-00-00', 'male', '', '', 'christian', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nurse', 'trust', '$2y$10$DPpJv20EGCzJJsaW4Y951OF/cNE7MmDPTCMjz2W0bWCGgYLGdVPwW', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-04 11:01:49'),
(105, '1570199367.ico', 'Judith', 'Emekwe', 'Ogo', '4 light house GRA Effurun', '08038910995', '0000-00-00', 'female', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nurse', 'judith', '$2y$10$FmZBB7X9ldF7xR4/i6RVreMVRwhNelaqJVZ85fHASTQBO1Vd5I0Fm', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-04 11:29:27'),
(106, '1570201765.hlp', 'Joyce', 'Ebiniyi', 'Inure', 'white house Jakpa road', '09039333672', '0000-00-00', 'male', '', '', 'christian', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nurse', 'joyce', '$2y$10$d5Lo4ivjI9gyE.JEDof8yeaedxIYt.ev31zGjCUM6nm73uwvIb4SW', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-04 12:09:25'),
(107, '1570445356.ico', 'ANTHONIA', 'ANIMENE', 'ADAJESUS', 'gROUP CHRISTIAN MEDICAL CENTRE STAFF QUARTERS, INSIDE M', '08037627275', '0000-00-00', 'female', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'mEDICAL RECORD OFFICER', 'tONIAADAJESUS', '$2y$10$Xg1VM..FsakxNG2tcZCE4efaeFUg7pksvxIORujujh3n6iiXAtQg.', '', '', '', '', 0, '', 0, 2, 0, 0, 0, '2019-10-07 07:49:16'),
(108, '1570445563.ico', 'ONYINYECHI', 'NWOSU', 'FAVOUR', 'gROUP MEDICAL STAFF QUARTER', '08165638256', '0000-00-00', 'female', '', '', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'mEDICAL RECORD OFFICER', 'jAMES FAVOUR', '$2y$10$AE0tZsda1r64D/p3TKuez.mv4imY9fOhzAlzUfYfgw9dcE4LgUOo.', '', '', '', '', 0, '', 0, 2, 0, 0, 0, '2019-10-07 07:52:43'),
(109, '1570450865.ico', 'ANGELA', 'ZUOKUMOR', 'OSOMINE', '5 OBIORA STREET IGBOGIDI UDU LGA', '08052463805', '0000-00-00', 'female', 'aUCHI', 'mARRIED', 'cHRISTIAN', 'pETER', '08106660838', 'dELTA', 0, '2003-03-23 00:00:00', 0, 51, 4, 'ZUOKUMOR MARY', 'ZUOKOMOR PETER', 'ZUOKOMOR FRANCIS', 'ZUOKOMOR ANTHONY', 'mATRON', 'aNGELA', '$2y$10$TbNtweeHtTxiWw8tiaBsmOjDBaF8wJ0HY6s8ITPp0iymAK2OPkrMq', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-07 09:21:05'),
(110, '1570451706.ico', 'JANE', 'ABANUM', 'OGHENEKUME', '5 AJOMATA STREET ', '07034837639', '0000-00-00', 'female', 'oNDO STATE', 'mARRIED', 'cHRISTIAN', 'aBANUM GODSPOWER', '08163229325', 'dELTA', 0, '2002-10-22 00:00:00', 0, 0, 3, '', '', '', '', 'cHEW', 'kUME', '$2y$10$RA6bLb7F2tjUBOl5fWXxiuOMHvgd3PSI33IkEXuXVofyw.LWZx3Mu', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-07 09:35:06'),
(111, '1570452639.ico', 'ABIGAEL', 'AIYEDUN', '', 'gROUP MEDICAL STAFF QUATERS', '07038736325', '0000-00-00', 'female', 'kOGI STATE', 'sINGLE', 'cHRISTIAIN', 'mRS MARY AIYEDUN', '08130753845', 'kOGI', 0, '2019-04-01 00:00:00', 0, 47, 0, '', '', '', '', 'pHARMAACY ASSISTANT', 'aIYEDUN10', '$2y$10$4h0gT5lr.2Bk2PC5ecJNJudAAFQMDzBcTg9U2N/ZkvLQGDfVUpuSm', '', '', '', '', 0, '', 0, 4, 0, 0, 0, '2019-10-07 09:50:39'),
(112, '1570453784.ico', 'Fortune', 'Ighoyota', 'Ochuko', '18 famous streest osubi', '08141656606', '0000-00-00', 'female', '', 'married', 'christain', 'lemuel', '', 'delta state', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'pharmacy', 'fortune', '$2y$10$P878/onDCqVADtx/3D8cI.qVA7plEvp0crLGaKtDFEz79b4ROKs6m', '', '', '', '', 0, '', 0, 4, 0, 0, 0, '2019-10-07 10:09:44'),
(113, '1570617428.ico', 'YINKA', 'AKINFENWA', '', '', '08066961961', '0000-00-00', 'male', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'mEDICAL LABORATORY SCIENTIST', 'yINKUS', '$2y$10$q8UHz/fEAnd4Pr7dNAIyqeDo67DgM0m9onEzCBuoRg5SOwjzPfrpq', '', '', '', '', 0, '', 0, 3, 0, 0, 0, '2019-10-09 07:37:08'),
(114, '1570624360.ico', 'NKEIRUKA', 'OKEKE', 'VICTORIA', 'nO 2 OMOVIE STREET OFF UGBORIKOKO', '08034849342', '0000-00-00', 'female', 'wARRI', 'mARRIED', 'cHRISTIAN', 'mR OKEKE', '07038251000', 'aNAMBRA', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'rECORD', 'mIRABEL', '$2y$10$2k/pHunxZyfhP76rm1Ti8uh6MG0JSon4K42iz7tnuT.ELWD7qWXyi', '', '', '', '', 0, '', 0, 2, 0, 0, 0, '2019-10-09 09:32:40'),
(116, '1570625723.ico', 'NGOZI', 'NWAIWU', 'BLESSING', 'jEDDO', '07089174890', '0000-00-00', 'male', 'wARRI', '', '', 'pROMISE NWAIWU', '08160575297', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'fAKE DOCTOR', 'bLESSING', '$2y$10$CTro7xX3oStVZHqElNtTVOigMy2mJoCZEb/rwrKWylMXRYmBnqtdy', '', '', '', '', 0, '', 0, 5, 0, 0, 0, '2019-10-09 09:55:23'),
(117, '1570627540.ico', 'LUCY', 'DUDIEGHA', 'DENYEFA', 'mOSHESHE ESTATE', '08131189811', '2002-12-12', 'female', 'wARRI', 'sINGLE', 'cHRISTIAN', 'dUDIEGHA ISAAC', '07011944813', 'dELTA STATE', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'sTAFF', 'lUCY', '$2y$10$GYwKXQSs8r4p3w0QZe6zcuWcU.uCcRtSVafrY/n9pVMqKpiDgpHVK', '', '', '', '', 0, '', 0, 13, 0, 0, 0, '2019-10-09 10:25:40'),
(121, '1570890769.ico', 'Anthonia', 'Omadudu', 'Elohor', '6 Enerhen road, Effurun', '08133930084', '1996-04-27', 'female', '', 'sINGLE', 'cHRISTIAIN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'pharmacy Assistant', 'elohor', '$2y$10$k44VTiEvHvGLSmayOG0cQ.Tl2v3EXSOFAJ/Kb6d7aAN0GFLjvrb6y', '', '', '', '', 0, '', 0, 4, 0, 0, 0, '2019-10-12 11:32:49'),
(122, '1571051571.ico', 'IYOBO', 'EDOMWONYI', 'VICTORY', '23 SIKOH ESTATE ROAD', '08057957878', '0000-00-00', 'female', '', 'mARRIED', 'cHRISTIAN', 'iMAFIDON SOLOMON', '08028996962', 'eDO', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'cHEW', 'iYOBO', '$2y$10$DFgcHt/IXzv.3aUIONy6Nub0EvWFixfv/UCwEBwoqE/4eZFFomGqq', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-14 08:12:51'),
(123, '1571051956.ico', 'BLESSING', 'AWHOTU', '', 'nO 13 OJABUGBE SREET OFF OKUMAGBA LAYOUT', '08060454095', '0000-00-00', 'female', '', 'mARRIED', 'cHRISTIAN', 'iRUABOGHENE', '07017179875', 'dELTA', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'cHEW', 'aWHOTU', '$2y$10$xy1fbaYUSMB81Ivpp79XousB1TS7lkfWPzFouwzqwF8jJQtv/LNo.', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-14 08:19:16'),
(124, '1571052749.ico', 'Ifeanyi', 'Okowa', '', '', '', '0000-00-00', 'male', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'fake Doctor', 'okowa', '$2y$10$ZcqIHOPK2CZ531pMGhH.JuWpT8vwQVcv0sJs2ZQdyvMQKCRYUCsBq', '', '', '', '', 0, '', 0, 5, 0, 0, 0, '2019-10-14 08:32:29'),
(125, '', 'OJEVWE', 'IGHOGBOJA', 'PURITY', 'gROUP CHRISTIAN MEDICAL CENTRE, MUSHESHE ESTATE', '08134348881', '1997-11-14', 'male', '', '', 'cHRISTIAN', '', '', '', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'nURSE', 'iGHOGBOJA ', '$2y$10$Xs4JwR4fAGsleSJ0KG69puMpy1VpWIsS1EIEZUaZhQ2SSUhSCK.Ru', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-14 09:10:57'),
(126, '', 'Ozioma', 'Ngene', 'Joy', 'musheshe Estate', '07055588844', '1970-01-01', 'female', '', '', 'cHRISTIAN', '', '', '', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'nurse', 'ozioma', '$2y$10$gjLdEh9wQD7Kd2p8iyPus.5HVJvbVQXOAlAjgz0G7xBn32Mcz6Zaa', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-14 09:48:10'),
(127, '', 'OGHENETEGA', 'TOM', 'VALLERY', 'iNSIDE STEEL VILLAGE OTOKUTU OFF DSC EXPRESSWAY', '08148955397', '1970-01-01', 'female', '', 'mARRIED', 'cHRISTIAN', 'tOM', '08160261047', '', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'nURSE', 'tEGA', '$2y$10$wepG9n/IX8o0Hty6z.0EeOVRckcASwnvKKAQgtx7hfLGasBHJaRem', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-15 06:03:04'),
(130, '1571132522.ico', 'MERRYLYN', 'OGOR', 'IDONOR', '17 OROROKPE TOWN', '08102858979', '0000-00-00', 'female', '', 'mARRIED', 'cHRISTIAIN', 'gENESIS', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'pHARMACIST', 'oGOR', '$2y$10$927lPNSuIvI8OYm3MdX5IO4BKHmmXsAX7BHr.3M97QRBkPkNXBXAS', '', '', '', '', 0, '', 0, 4, 0, 0, 0, '2019-10-15 06:42:02'),
(131, '1571134252.ico', 'LORINE', 'UMUKORO', '', '100 ORHUWHORUN ROAD', '07080881304', '0000-00-00', 'female', '', 'mARRIED', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nURSE', 'lorine', '$2y$10$QZk1NQa4TwcQz6b3il6mnebZr1uesUAbG0nEUpPZCXSxPTQtcqMJS', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-15 07:10:52'),
(132, '1571134321.ico', 'HOPE', 'UBUARA', 'AVWEROSUO', '110 OKPE ROAD SAPELE ,DELTA STATE', '08032612348', '1992-08-24', 'female', 'sAPELE', 'sINGLE', 'christian', 'uBUARA FAITH', '08038951544', 'dELTA', 0, '2019-09-01 00:00:00', 0, 56, 0, '', '', '', '', 'nurse', 'hOPE', '$2y$10$ZP3gTmxg8NQqvjaFgvs3PeX7RxJheUWMnhbvdgNVVp3F7SdWs9NEq', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-15 07:12:01'),
(133, '1571134863.ico', 'JOYCELYN', 'IBAMA', '', 'gROUP CHRISTIAN MEDICAL CENTER', '07039309947', '0000-00-00', 'female', '', 'sINGLE', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nHIS OFFICER', 'iBAMA', '$2y$10$mmOazOnI6QJwB/i5IDUQ7eoRyGSrk.kQTlN5F6008cV.qU2H5Tus6', '', '', '', '', 0, '', 0, 13, 0, 0, 0, '2019-10-15 07:21:03'),
(134, '1571135396.ico', 'UZUAZOKARO', 'OKOR', 'BLESSING', 'cELE ROAD BY REFINERY, OFF JEDDO ROAD', '08037966370', '0000-00-00', 'female', '', 'mARRIED', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nHIS ACCOUNTANT', 'uZUAZOKARO', '$2y$10$4YZdYySfVliNbiNvMvMYNONwmdlSTRqiIpVWwirDjokdkDysBXc7u', '', '', '', '', 0, '', 0, 13, 0, 0, 0, '2019-10-15 07:29:56'),
(135, '1571149422.ico', 'KELVIN', 'UWADIA', '', '1 street', '07038398847', '0000-00-00', 'male', '', 'married', 'christian', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'lab Scientist', 'kelvin123', '$2y$10$jwWqOrMuKE6870BZwwyZletPArEA3XOLfXfEtZ3vD3jYUMmn68Q8y', '', '', '', '', 0, '', 0, 3, 0, 0, 0, '2019-10-15 11:23:42'),
(137, '1571218640.ico', 'DEBORAH', 'OSAZUWA', 'EFOSA', 'oGBOROKE OFF AIRPORT ROAD', '08028284391', '0000-00-00', 'female', '', 'mARRIED', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nURSE', 'dEBBIELICIOUS', '$2y$10$tCl6Azp3qefZdLSIEv90e.GfSG8wiywiwDx5dgKP4j4q62UZEMMHi', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-16 06:37:20'),
(138, '1571218809.ico', 'TINA', 'ONWUAGANA  ', '', '9 AKPATABI STREET OKUMAGBA LAY-OUT WARRI', '08068470842', '0000-00-00', 'female', '', 'sINGLE', 'cHRISTIAN', 'cHUKS ', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nURSE', 'tINA', '$2y$10$3hzJPAqyVsO8O/QIn6G.UeeSbxZ/Lh7jJ7d6SXJGHlIfn/1W9TyGa', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-16 06:40:09'),
(140, '1571219319.ico', 'RUKEVWE', 'EDEDEY', '', '11 ESSI-IDESOH', '07017690033', '0000-00-00', 'male', '', 'mARRIED', 'cHRISTIAN', 'oRITSEWEYINMI EDEDEY', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nURSE', 'rUKEVWE', '$2y$10$9s1wEOqp/PWh0WncaJtruOky8kK7P7uJfW.8L5uKVCAzUr8vkTTk2', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-16 06:48:39'),
(141, '1571219657.ico', 'SOPHIA', 'ODJIGHORO', '', '66 EMEBIREN STREET OKUMAGBA LAY-OUT WARRI', '07080722242', '0000-00-00', 'female', '', 'mARRIED', 'cHRISTIAN', 'eLOHOR ODJIGHORO', '08036846296', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nURSE', 'oDJISSOPHIA', '$2y$10$JyJKgbizhWl5d/O5MRLFSOEYwaPbvOU2Eje.cRB4n032j2IrFOT4y', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-16 06:54:17'),
(142, '1571221637.ico', 'FLORENCE', 'AKOTA', '', '9 ONOS SCHOOL ROAD', '07065100678', '0000-00-00', 'female', '', 'mARRIED', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nURSE', 'fLOXY', '$2y$10$.NL6ii.1e3OwEyeN3UeSJuJ2rldV1nyAJxSbSVCgGz6bBazPoWjja', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-16 07:27:17'),
(143, '', 'ROSELYN', 'STEPHEN', '', 'nEHEMIAH ROAD, OKUOKOKO ', '08162406087', '1970-01-01', 'female', '', 'sINGLE', 'cHRISTIAN', '', '', '', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'nURSE', 'rOSELYN', '$2y$10$2P6Q5LrCYTEv3q2TufeBQOLq0Jlsf/3dlZmo4IqWpNCFZHLeiWck2', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-16 07:47:57'),
(144, '1571222970.ico', 'JOSIE', 'OGBEVIRE', '', 'gCMC ', '08034394011', '0000-00-00', 'female', '', 'mARRIED', 'christian', 'fOGHI LEMUEL', '07037794590', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'dOCTOR', 'rIDO', '$2y$10$46VE/LVjqTxtr99tz7fXZu66YXM1drnHsRX8RM3W3RnCLMqFM9PiG', '', '', '', '', 0, '', 0, 5, 0, 0, 0, '2019-10-16 07:49:30'),
(145, '1571224022.ico', 'Mercy', 'Uduedu', '', 'gCMC STAFF QUARTERS', '07064638879', '0000-00-00', 'female', '', 'sINGLE', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'cHEW', 'oGMERCY', '$2y$10$IlxUtG9JBmQ6DJB2z74LC.OJrIR4QHeKQyAT/RLT48JZ2rDHsLaJG', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-10-16 08:07:02'),
(146, '1572525277.ico', 'ONIOVOSA', 'AKPORHONOR', '', '5,EBRAWINORO STREET OFF JAKPA ROAD', '08136662502', '0000-00-00', 'male', 'aGBARHO', 'sINGLE', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'dOCTOR', 'vosa', '$2y$10$Lh1qFMrSjSTxK3sAp84D9OEXoJWnWldfSZ4bZr5TXJS7W8wjo6Q/K', '', '', '', '', 0, '', 0, 5, 0, 0, 0, '2019-10-31 09:34:37'),
(147, '', 'Test', 'Account', 'User', '9, JESUS IS LORD STREET REFINERY ROAD', '08060796224', '1970-01-01', 'female', '', 'sINGLE', 'cHRISTIAN', '', '', '', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'accountant', 'account', '$2y$10$hmvgsD5J/EF7U3zZX.l3EOapoMMWbdJietQBo4Xq8d4NyxYFL/weW', '', '', '', '', 0, '', 0, 6, 0, 0, 0, '2019-10-31 09:52:28'),
(149, '1572529214.jpg', 'FEGA', 'ATIGARI', '', '4A SAMARUN D.S.C TOWNSHIP', '08066431867', '0000-00-00', 'female', '', 'sINGLE', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'accountant', 'fEGA', '$2y$10$veXmeVTZ3wnjw24EA6BLnOz5Vcyh5sCO.ssJvp/b5L4M3G3u/4eGi', '', '', '', '', 0, '', 0, 18, 0, 0, 0, '2019-10-31 10:40:14'),
(150, '1572597085.ico', 'EKENE', 'ONYEMA', 'STANLEY', 'oSUBI', '09097825250', '0000-00-00', 'male', '', 'sINGLE', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'dOCTOR', 'jOHNSTAN', '$2y$10$9y7UEWufT8bPVC5VJ22aTe0cKGYIdzhAUKyBrSDNWhqiH7qwyyDN2', '', '', '', '', 0, '', 0, 5, 0, 0, 0, '2019-11-01 05:31:25'),
(152, '1572604019.exe', 'MARY', 'EKEZIE', '', '', '08063083555', '0000-00-00', 'female', '', 'mARRIED', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nHIS officer', 'ekezie', '$2y$10$leO95KX9BRyHAkpJeKYvGO67EDOSMGPaQdy7q2YngjkKR16ZZUco2', '', '', '', '', 0, '', 0, 13, 0, 0, 0, '2019-11-01 07:26:59'),
(153, '1574086092.ico', 'KEVWE', 'OKORODAFE', '', '', '', '0000-00-00', 'male', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'lab IT', 'klop', '$2y$10$MbAbMvqLF5Yfdis9gsZF9OP6lKMLk8W4e3yxfgGtYvFut7/XJeJd2', '', '', '', '', 0, '', 0, 3, 0, 0, 0, '2019-11-18 12:08:12'),
(154, '1581938050.ico', 'SUNNY', 'NKOR', '', '', '', '0000-00-00', 'male', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'mD', 'sknk', '$2y$10$m.S9mK0tuEp.qwQiq2FdPu2A7UkYL2hQenkcpFkx/KnOB7iNfbXfa', '', '', '', '', 0, '', 0, 5, 0, 0, 0, '2020-02-17 10:14:10'),
(155, '1574325400.ico', 'AKPEVWE', 'OGAGBE', 'ANITA', 'oKUOKOKO', '07060440527', '0000-00-00', 'female', '', 'mARRIED', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nURSE', 'anita', '$2y$10$4nqToAgaiarQ68sXFFAnduvOtm/zUXLM2TJCxws.jW/xPmWCs/Mo.', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-11-21 06:36:40'),
(156, '1574354116.ico', 'RUKY', 'JECKINS', '', 'no 10 Igbudu street off essi layout warri', '08163093129', '0000-00-00', 'female', '', 'sINGLE', 'christian', 'emmanuel Jeckins', '08163093129', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'lab IT', 'ruky2giftd', '$2y$10$kEZTGJjwWR/C5s80D/08HOXO7Mcd3wWjdVrU3Sj6ThUbii9ft9N8O', '', '', '', '', 0, '', 0, 3, 0, 0, 0, '2019-11-21 14:35:16'),
(157, '1575026973.ico', 'OGHENEOVO', 'OYIBO', 'JOSIAH', '17 MOSHESHE STREET, EFFURUN', '08156869719', '1998-07-10', 'male', 'wARRI', 'sINGLE', 'christian', 'rOSELINE OYIBO', '08054533079', 'delta', 0, '0000-00-00 00:00:00', 0, 70, 0, '', '', '', '', 'lAB TECHINICIAN', 'oGHENEOVO OYIBO', '$2y$10$8cY/H5s7TwPf3d89Qth4S.B098RtUAZiDqeAF2K6zJwrJ8DROhXFa', '', '', '', '', 0, '', 0, 3, 0, 0, 0, '2019-11-29 09:29:34'),
(162, '1575284561.ico', 'Gaius', 'Iyasere', '', '', '08023055452, 0805403', '1960-05-24', 'male', 'ugbogiobo, Near NIFOR Edo State', 'maried', 'christianity', '', '08053227702', 'anambra', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'pediatrician Doctor', 'erute', '$2y$10$KBNlIjdqKjTdsIalorgnU.9eDZGUhLhdOCLZzI.AMOhYriLd4cjD.', '', '', '', '', 0, '', 0, 5, 0, 0, 0, '2019-12-02 09:02:41'),
(163, '1575642781.ico', 'ONAJITE', 'ORIGBO ', '', 'gROUP CHRISTIAN MEDICAL CENTRE MOSHESHE ', '07069333619', '1984-11-11', 'female', 'aGBARHA 0TOR ', 'sINGLE ', 'cHRISTIAN', 'jITE', '09092103544', 'dELTA STATE', 0, '2012-12-10 00:00:00', 0, 74, 0, '', '', '', '', 'nHIS OFFICER', 'jITE', '$2y$10$jqO.A2WgVh1OVvI2EjZw0OFw0ZAICHaf8roCzKQy61fbtVM7tGlTi', '', '', '', '', 0, '', 0, 13, 0, 0, 0, '2019-12-06 12:33:01'),
(164, '', 'Ezekiel', 'Ebumu', '', '', '', '1970-01-01', 'male', '', '', '', '', '', '', 0, '1970-01-01 00:00:00', 500000, 0, 0, '', '', '', '', 'consultant', 'ezekiel', '$2y$10$ZDRXYXitvUSu8R6g1VAdFuudqJb6/gBIYML9EiJUF7a2tHsa.R5xC', '', '', '', '', 0, '', 0, 5, 0, 0, 0, '2019-12-09 13:30:58'),
(165, '1575990679.ico', 'Christabel', 'Osemenkhian', 'Uyinorma', '', '09060976757', '0000-00-00', 'female', '', 'single', 'christian', '', '', 'edo ', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'administrator', 'christbeauty', '$2y$10$O6DvGym8LHM8CcJa5Zauuu5TztAihouYq1RVbwC9vuOy4S0W/ypXK', '', '', '', '', 0, '', 0, 1, 0, 0, 0, '2019-12-10 13:11:19'),
(166, '', 'Test', 'Nurse', 'User', 'group Christian Medical Centre', '07030161851', '1970-01-01', 'female', '', 'single', 'christian', '', '', 'edo', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'nurse Mid-wife', 'nurse', '$2y$10$0rOg68RvtjBqJJEcalg0R.pkjnqdY6fqUO6Hs1k/UY3.WPhZeWDa6', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2019-12-12 08:20:50'),
(167, '1578918220.ico', 'BLESSED', 'AIKIGBE', '', 'gCMC', '08037557632', '0000-00-00', 'male', '', 'mARRIED', 'christian', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'aDMIN OFFICER', 'bishop', '$2y$10$FNIn4BD0hvJSMbKpCMnVMOSqRU1YQb6XEb1viYkmUTgPcodQxo4WS', '', '', '', '', 0, '', 0, 9, 0, 0, 0, '2020-01-13 10:23:40'),
(168, '1579872278.ico', 'UZOEFE', 'UBEKU', '', 'gCMC', '08060533894', '0000-00-00', 'female', '', '', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'lAB SCIENTIST', 'efe', '$2y$10$6PlOQStn326UWTkmbWHE/etJVxXkMsGM5Vs8lOYyNZuOfYC5M3qJS', '', '', '', '', 0, '', 0, 3, 0, 0, 0, '2020-01-24 12:24:38'),
(169, '1580217821.ico', 'BLESSING', 'NWOSU', '', 'iNSIDE MOSHESHE ESTATE', '070393307', '0000-00-00', 'female', '', '', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'aCCOUNTANT', 'isioma', '$2y$10$qJ49t4eMRT/ydt75k8kFw.pd54IIus1KuBvhfdXEUFzVHvdYDfG/K', '', '', '', '', 0, '', 0, 18, 0, 0, 0, '2020-01-28 12:23:41'),
(170, '', 'Test', 'Front Desk', 'User', '25 ONOKUTA STREET', '', '1970-01-01', 'female', '', '', 'cHRISTIAN', '', '', '', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'lAB SACIENTIST', 'front', '$2y$10$mqONO2qjyZlZBF7hZc6aV.wjcXlc92ov2Zwl67ENkQSJQcI0yg7U6', '', '', '', '', 0, '', 0, 2, 0, 0, 1, '2020-02-04 15:51:23'),
(171, '', 'Test', 'Pharmacist', 'User', '9 EMORE STREET OFF AIRPORT ROAD', '08039592629', '1970-01-01', 'male', '', '', 'cHRISTIAN', '', '', '', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'pHARMACIST', 'pharm', '$2y$10$dF5iJcv0QXBVjJ29/wHWWuZpO/ucP9fLsbLVJL0ZWiSUDAwo02Yv.', '', '', '', '', 0, '', 0, 4, 0, 0, 1, '2020-02-07 12:30:44'),
(173, '', 'VICTORY', 'JEREMIAH', '', '', '', '1970-01-01', 'female', '', '', 'christian', '', '', '', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'lab Scientist', 'vicky', '$2y$10$bq.QrlGKPnCC5.Uc16hV9OOgZ2uIxUF3xXRh0wtr6ZARguKl0C93K', '', '', '', '', 0, '', 0, 3, 0, 0, 0, '2020-02-17 12:13:34'),
(174, '', 'Test', 'Warehouse Staff', 'User', 'no 22 oferuse street udu orhuwhorun', '07089320754', '2000-05-27', 'female', 'ojobo', 'single', 'cHRISTIAN', 'mrs zuokumor', '08052463805', 'dELTA', 0, '2019-12-28 00:00:00', 20000, 0, 0, '', '', '', '', 'front desk', 'warehouseS', '$2y$10$QgB0GZ7OABN.SPE77aZlu.kiDiLTAclUmKTuhtYMKDn3mnkv1n4F.', '', '', '', '', 0, '', 0, 16, 0, 0, 0, '2020-03-12 11:33:20'),
(175, '', 'Test', 'Warehouse Manager', 'User', 'no. 9 Jesus is Lord Street off Refinary road, Efurrun', '07063803732', '1970-01-01', 'male', '', '', '', '', '', '', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'pharmacist', 'warehouseA', '$2y$10$LBunfRyFmalbXLqhJ92HjOoBBIYjkTIfMqcTLv.5r9hQYKNu15SQq', '', '', '', '', 0, '', 0, 15, 0, 0, 0, '2020-03-12 12:11:17'),
(176, '1584525321.ico', 'Ruth', 'Onoja', '', '', '', '0000-00-00', 'female', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'lAB SCIENTIST', 'onojaruth', '$2y$10$rJYvVtd5htguZsoGIXHFM.z92AfNh6NVaiXBtf.lD0XLztjWZUne.', '', '', '', '', 0, '', 0, 3, 0, 0, 0, '2020-03-18 08:55:21'),
(178, '1584529566.ico', 'Rukeme', 'Obiku', 'Oritselaju', '16 Siakpere street kolokolo layout off udu road', '08092553326', '0000-00-00', 'female', '', 'mARRIED', 'cHRISTIAN', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'nURSE', 'rukylaj', '$2y$10$nK79JY4yZnfOBE20GBpa9.8LZGa6QJj8lztonoWriZsxLAQYel0QW', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2020-03-18 10:06:06'),
(179, '1584535773.ico', 'Benedict', 'Obasi', '', '', '', '0000-00-00', 'male', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'internal admin', 'inadmin', '$2y$10$iGK6kbVApmU4OG6PLJhjWeWKw7swOFZ1l3RMUitECfgmk7TxNiaKm', '', '', '', '', 0, '', 0, 1, 0, 0, 0, '2020-03-18 11:49:33'),
(180, '', 'Test', 'Laboratory', 'User', '', '08160426931', '1970-01-01', 'female', '', 'sINGLE', '', '', '', '', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'lab IT', 'lab', '$2y$10$bIr7y.gVW.KkiqgelNpfaeK10rjk8Q2S//.6KzMUow9t9soRA26OS', '', '', '', '', 0, '', 0, 3, 0, 0, 0, '2020-05-12 13:29:06'),
(181, '', 'Test', 'Cafeteria', 'User', '', '', '1970-01-01', 'female', '', '', '', '', '', '', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'nURSE', 'caf', '$2y$10$GGP5.oVe8g8liQD7nnXreeSnSmEPTYz1ayzkf3TGVa1EDtyQaaZpq', '', '', '', '', 0, '', 0, 7, 0, 0, 0, '2020-05-13 07:48:00'),
(182, '', 'Test', 'Xray', 'User', '', '', '1970-01-01', 'female', '', '', 'christian', '', '', '', 0, '1970-01-01 00:00:00', 0, 0, 0, '', '', '', '', 'lab Scientist', 'xray', '$2y$10$93McVNNGtv9tFpXqxWe3ye4QU1hFz309G7ifiDqSqM5uMiPD69KLa', '', '', '', '', 0, '', 0, 19, 0, 0, 1, '2020-05-18 10:34:41'),
(183, '1600546083.jpg', 'Jeffery', 'Obasohan', 'Bokue', '', '', '0000-00-00', 'male', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', '', 'xray', '$2y$10$n/jc9UyyYIxN3VST4cP6zeU1GomjJQkeiu3cTmzLPhMX2tGo4MZIm', '', '', '', '', 0, '', 0, 19, 0, 0, 1, '2020-09-19 20:08:03'),
(184, '1600546234.jpg', 'Gurkle', 'Litos', 'Fire', '', '', '0000-00-00', 'male', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', '', 'scan', '$2y$10$1WwbC8YmkD5CWdjuANm6TeYmpeXq6XTKwMXy.5vHTdfJ5Wnus/zrO', '', '', '', '', 0, '', 0, 20, 0, 0, 0, '2020-09-19 20:10:34'),
(185, '1600546345.jpg', 'Joseph', 'Brume', 'Bean', '', '', '0000-00-00', 'male', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', '', 'physiotherapy', '$2y$10$e.3To7aG0tERfvICwre0xeMRmr72W1P4A5fZF/7CO3IKqa2v/vKYu', '', '', '', '', 0, '', 0, 12, 0, 0, 0, '2020-09-19 20:12:38'),
(186, '1558244160.jpg', 'Lanist', 'Sarsi', 'Billa', '', '', '0000-00-00', 'male', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', '', 'warehousestaff', '$2y$10$Ik..c5RS72lxMUNlMHvooeKqb/sswRf4rUZzjSogUtSvvj4bJuHcu', '', '', '', '', 0, '', 0, 16, 0, 0, 0, '2020-09-19 20:21:39'),
(187, '1558244160.jpg', 'Jacobs', 'Litos', 'Fire', '', '', '0000-00-00', 'male', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', '', 'cafeteria', '$2y$10$A0Ly.qodIAXNip7t9VUdsOT1xx7JW5PLIxwhNeeZw84PKM0MZXxEG', '', '', '', '', 0, '', 0, 21, 0, 0, 0, '2020-09-19 20:22:57'),
(188, '1558244160.jpg', 'Gurkle', 'Brume', 'Billa', '', '', '0000-00-00', 'male', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', '', 'morgue', '$2y$10$xQ7Q2Happ/Dg1tcdFGrJKeMPxSM.svld4xEcW1t7eF.fEZnB/bIU.', '', '', '', '', 0, '', 0, 22, 0, 0, 0, '2020-09-19 20:24:04'),
(189, '1558244160.jpg', 'Jeffery', 'Sarsi', 'Fire', '', '', '0000-00-00', 'male', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', '', 'blood', '$2y$10$HugN.kWQ2FSu2.YUXpG8keJ0yteiIJeX4aVvaayHMMs/YV70cGgD2', '', '', '', '', 0, '', 0, 23, 0, 0, 0, '2020-09-19 20:25:05'),
(190, '1558244160.jpg', 'Jeffery', 'Sarsi', 'Billa', '', '', '0000-00-00', 'male', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', '', 'pediatrics', '$2y$10$S9MjozWh8YCEhyuusKcJ7OfXLdGkMUZspaEXQ/fsqFw1L.DH2njrS', '', '', '', '', 0, '', 0, 14, 0, 0, 0, '2020-09-19 20:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `surgery_perm`
--

CREATE TABLE `surgery_perm` (
  `surgery_perm_id` int(11) NOT NULL,
  `accepted_by` longtext NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `surgery_name` longtext NOT NULL,
  `surgery_date` date NOT NULL,
  `surgery_time` text NOT NULL,
  `surgery_remark` longtext NOT NULL,
  `added_by` int(11) NOT NULL,
  `prechecklist` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surgery_perm`
--

INSERT INTO `surgery_perm` (`surgery_perm_id`, `accepted_by`, `patient_id`, `appointment_id`, `surgery_name`, `surgery_date`, `surgery_time`, `surgery_remark`, `added_by`, `prechecklist`, `status`, `date_added`) VALUES
(1, '', 1, 1, 'Blood', '2020-05-06', '12:40', 'Yeah', 2, 1, 1, '2020-08-03 21:55:22'),
(2, '', 2, 0, 'Liver Transplant', '2020-09-01', '12:00 am', 'Prep', 2, 1, 1, '2020-08-17 09:54:25'),
(3, '', 11, 0, 'AMputation of the left foot', '2020-02-05', '9pm', 'Jhuhfu9hu9', 97, 1, 1, '2020-09-16 17:11:23'),
(4, '', 11, 0, 'AMputation of the left foot', '2020-12-22', '9pm', 'Jhiw0tih0ig0i', 97, 1, 1, '2020-09-16 17:16:39');

-- --------------------------------------------------------

--
-- Table structure for table `tariffs`
--

CREATE TABLE `tariffs` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `color` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `percentage` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `added_by` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `name`, `percentage`, `status`, `added_by`, `date_added`) VALUES
(1, 'PAYE', '7', 1, 84, '2020-02-17');

-- --------------------------------------------------------

--
-- Table structure for table `temp_presc`
--

CREATE TABLE `temp_presc` (
  `id` int(11) NOT NULL,
  `pid` text NOT NULL,
  `drug` longtext NOT NULL,
  `type` longtext NOT NULL,
  `tabs` longtext NOT NULL,
  `freq` longtext NOT NULL,
  `duration` longtext NOT NULL,
  `Instruction` longtext NOT NULL,
  `patient` int(50) NOT NULL,
  `doc` int(50) NOT NULL,
  `app_id` int(50) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_presc`
--

INSERT INTO `temp_presc` (`id`, `pid`, `drug`, `type`, `tabs`, `freq`, `duration`, `Instruction`, `patient`, `doc`, `app_id`, `date_added`) VALUES
(1, '20200915055021', '576', 'Tablet/Capsule', '', '', '', '', 9, 86, 1, '2020-09-15 16:50:46'),
(2, '20200916015708', '576', 'Tablet/Capsule', '', '', '', '', 11, 97, 5, '2020-09-16 12:58:11'),
(3, '20200916015708', '5', 'Tablet/Capsule', '', '', '', '', 11, 97, 5, '2020-09-16 12:58:44'),
(4, '20200916112504', '3', 'Tablet/Capsule', '', '', '', '', 2, 97, 8, '2020-09-16 22:25:21'),
(5, '20200916113145', '2', 'Tablet/Capsule', '', '', '', '', 10, 86, 3, '2020-09-16 22:32:07'),
(6, '20200917072236', '3', 'Tablet/Capsule', '', '', '', '', 3, 2, 2, '2020-09-17 06:22:46'),
(8, '20200918030952', '3', 'Tablet/Capsule', '', '', '', '', 9, 97, 1, '2020-09-18 14:10:17'),
(9, '20200918031134', '4', 'Cream', '', '', '', '', 9, 97, 1, '2020-09-18 14:12:08'),
(10, '20200918032529', '3', 'Tablet/Capsule', '', '', '', '', 10, 97, 3, '2020-09-18 14:32:42'),
(11, '20200918032529', '4', 'Tablet/Capsule', '', '', '', '', 10, 97, 3, '2020-09-18 14:50:24'),
(12, '20200919103036', '612', 'Tablet/Capsule', '', '', '', '', 12, 2, 18, '2020-09-19 21:30:50'),
(13, '20200919103350', '612', 'Tablet/Capsule', '', '', '', '', 13, 97, 7, '2020-09-19 21:34:04'),
(14, '20200920095024', '2', 'Tablet/Capsule', '', '', '', '', 2, 86, 22, '2020-09-20 20:50:32'),
(15, '20200923120312', '54', 'Tablet/Capsule', '', '', '', '', 12, 2, 18, '2020-09-22 23:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `temp_presc1`
--

CREATE TABLE `temp_presc1` (
  `id` int(11) NOT NULL,
  `pid` text NOT NULL,
  `drug` longtext NOT NULL,
  `type` longtext NOT NULL,
  `tabs` longtext NOT NULL,
  `freq` longtext NOT NULL,
  `duration` longtext NOT NULL,
  `Instruction` longtext NOT NULL,
  `patient` int(50) NOT NULL,
  `doc` int(50) NOT NULL,
  `app_id` int(50) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_presct`
--

CREATE TABLE `temp_presct` (
  `id` int(11) NOT NULL,
  `pid` text NOT NULL,
  `drug` longtext NOT NULL,
  `type` longtext NOT NULL,
  `tabs` longtext NOT NULL,
  `freq` longtext NOT NULL,
  `duration` longtext NOT NULL,
  `Instruction` longtext NOT NULL,
  `patient` int(50) NOT NULL,
  `doc` int(50) NOT NULL,
  `app_id` int(50) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_presct`
--

INSERT INTO `temp_presct` (`id`, `pid`, `drug`, `type`, `tabs`, `freq`, `duration`, `Instruction`, `patient`, `doc`, `app_id`, `date_added`) VALUES
(12, '20200919104237', '3', 'Tablet/Capsule', '', '', '', '', 14, 2, 2, '2020-09-19 10:19:03'),
(13, '20200919104237', '4', 'Tablet/Capsule', '', '', '', '', 14, 2, 2, '2020-09-19 10:24:39'),
(14, '20200919072702', '3', 'Tablet/Capsule', '', '', '', '', 14, 2, 2, '2020-09-19 21:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `temp_test`
--

CREATE TABLE `temp_test` (
  `id` int(11) NOT NULL,
  `lab_test_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `pid` longtext NOT NULL,
  `doc` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_test`
--

INSERT INTO `temp_test` (`id`, `lab_test_id`, `patient_id`, `app_id`, `eid`, `pid`, `doc`, `date_added`) VALUES
(1, 24, 1, 9, 0, '20200915050101', 86, '2020-09-15 16:02:59'),
(2, 48, 5, 11, 0, '20200916014033', 97, '2020-09-16 12:41:09'),
(3, 21, 5, 11, 0, '20200916014033', 97, '2020-09-16 12:41:22'),
(4, 3, 8, 2, 0, '20200917083418', 2, '2020-09-17 07:34:27'),
(5, 3, 3, 10, 0, '20200917084130', 2, '2020-09-17 07:42:12'),
(6, 3, 7, 13, 0, '20200917085723', 2, '2020-09-17 07:57:33'),
(7, 1, 5, 11, 0, '20200917090318', 2, '2020-09-17 08:03:24'),
(8, 2, 1, 9, 0, '20200917090737', 2, '2020-09-17 08:07:42'),
(9, 2, 8, 2, 0, '20200917090757', 2, '2020-09-17 08:08:02'),
(10, 1, 22, 2, 0, '20200920092028', 86, '2020-09-20 20:20:47');

-- --------------------------------------------------------

--
-- Table structure for table `therapy_plans`
--

CREATE TABLE `therapy_plans` (
  `id` int(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `link_ref` varchar(255) NOT NULL,
  `appointment_id` int(255) NOT NULL,
  `front_desk` varchar(255) NOT NULL,
  `comment` longtext NOT NULL,
  `doctor_id` int(255) NOT NULL,
  `time_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `therapy_plans`
--

INSERT INTO `therapy_plans` (`id`, `patient_id`, `link_ref`, `appointment_id`, `front_desk`, `comment`, `doctor_id`, `time_added`) VALUES
(1, 9, '', 1, '', 'yfyu', 2, '2020-09-16 10:02:32'),
(2, 11, '', 5, '', 'h', 2, '2020-09-16 16:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `treatments`
--

CREATE TABLE `treatments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `disease` text NOT NULL,
  `reference` text NOT NULL,
  `symptom` text NOT NULL,
  `extra_note` text NOT NULL,
  `next_checkup` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatments`
--

INSERT INTO `treatments` (`id`, `patient_id`, `admission_id`, `disease`, `reference`, `symptom`, `extra_note`, `next_checkup`, `date_added`, `added_by`) VALUES
(2, 14, 6, '1', '20200919072702', 'I just know', 'That thing', '2020-09-20 00:00:00', '2020-09-19 08:18:54', 2);

-- --------------------------------------------------------

--
-- Table structure for table `treatment_list`
--

CREATE TABLE `treatment_list` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fee` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `addedby` int(11) NOT NULL,
  `date_updated` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatment_list`
--

INSERT INTO `treatment_list` (`id`, `name`, `fee`, `date_added`, `addedby`, `date_updated`, `updated_by`) VALUES
(1, 'Malaria', 1200, '2020-09-19 06:59:27', 2, '2020-09-19 07:14:19', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `date_added`) VALUES
(1, 'Admin', '2019-02-07 02:42:46'),
(2, 'Reception', '2019-02-07 02:42:46'),
(3, 'Lab', '2019-02-07 02:43:20'),
(4, 'Pharmacy', '2019-02-07 02:43:20'),
(5, 'Doctor', '2019-02-07 02:43:34'),
(6, 'Accountant', '2019-02-07 02:43:34'),
(7, 'Nurse', '2019-02-27 10:58:49'),
(8, 'O&G', '2019-03-06 07:44:32'),
(9, 'Operations', '2019-03-23 08:18:26'),
(10, 'Staff', '2019-03-27 03:29:30'),
(11, 'Radiography', '2019-05-07 09:46:52'),
(12, 'Physiotherapy', '2019-05-07 09:47:13'),
(13, 'NHIS', '2019-07-31 03:12:41'),
(14, 'Pediatrics', '2019-08-01 03:13:19'),
(15, 'Warehouse Admin', '2019-09-10 10:16:46'),
(16, 'Warehouse Staff', '2019-09-10 10:17:29'),
(17, 'Reception/Cashier', '2020-01-05 18:52:12'),
(18, 'Accountant (Cashier)', '2020-01-05 18:59:42'),
(19, 'Xray', '2020-09-16 11:55:09'),
(20, 'Scan', '2020-09-16 11:55:09'),
(21, 'Cafeteria', '2020-09-16 11:57:42'),
(22, 'Morgue', '2020-09-16 11:57:42'),
(23, 'Blood Bank', '2020-09-16 15:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `visitors_log`
--

CREATE TABLE `visitors_log` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `staff` int(11) NOT NULL,
  `tel` text NOT NULL,
  `sex` varchar(6) NOT NULL,
  `address` text NOT NULL,
  `reason` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `remark` longtext NOT NULL,
  `time_addded` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitors_log`
--

INSERT INTO `visitors_log` (`id`, `name`, `staff`, `tel`, `sex`, `address`, `reason`, `status`, `remark`, `time_addded`, `added_by`, `date_added`) VALUES
(1, 'Oghenekaro Favour', 180, '09023989876', 'Female', 'Ikhueniro', 'Regarding the school\'s SAGE project', 1, 'ttuutfutdcfu', '0000-00-00 00:00:00', 170, '2020-09-23 05:14:32'),
(2, 'Milla NOAH kENH', 67, '09023989876', 'Male', 'Ikhueniro', 'U', 1, 'h', '0000-00-00 00:00:00', 2, '2020-09-24 10:27:49'),
(3, 'Jane Milla', 97, '09023989876', 'Female', 'Ikhueniro', 'I dont know', 1, 'h', '0000-00-00 00:00:00', 2, '2020-09-24 21:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE `wards` (
  `id` int(11) NOT NULL,
  `ward` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`id`, `ward`, `added_by`, `date_added`) VALUES
(1, 'Semi Ward 1', 2, '2020-08-19 00:00:00'),
(2, 'Semi Private 1', 2, '2020-08-19 00:11:53'),
(3, 'Semi Private 2', 2, '2020-08-19 00:11:53'),
(4, 'Semi Private 3', 2, '2020-08-19 00:13:47'),
(5, 'Children Ward', 2, '2020-08-19 00:13:47'),
(6, 'Main Ward', 2, '2020-08-19 00:13:47'),
(7, 'Neo-Natal Ward', 2, '2020-08-19 00:13:47'),
(8, 'Private Ward', 2, '2020-08-19 00:13:48'),
(9, 'ICU Ward', 2, '2020-08-19 00:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_stock`
--

CREATE TABLE `warehouse_stock` (
  `id` int(11) NOT NULL,
  `Stock_number` text NOT NULL,
  `reference` text NOT NULL,
  `manufactured` date NOT NULL,
  `expiring` date NOT NULL,
  `name` text NOT NULL,
  `category` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `unitb` int(11) NOT NULL,
  `cartons` bigint(20) NOT NULL,
  `bunit` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `manufacturer` text NOT NULL,
  `Supplier` int(11) NOT NULL,
  `generic` text NOT NULL,
  `form` text NOT NULL,
  `batch` text NOT NULL,
  `s_usage` text NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse_stock`
--

INSERT INTO `warehouse_stock` (`id`, `Stock_number`, `reference`, `manufactured`, `expiring`, `name`, `category`, `units`, `unitb`, `cartons`, `bunit`, `cost`, `manufacturer`, `Supplier`, `generic`, `form`, `batch`, `s_usage`, `date_added`) VALUES
(1, '001', '', '2016-10-01', '2021-07-01', 'ACTIVATED CHARCOAL', 49, 9, 0, 1000, 9, 550, 'KUNIMED', 13, 'ACTIVATED CHARCOAL', '8', 'KACOO1', '2', '2020-01-12 20:50:40'),
(2, '18908002536529', '', '2018-12-31', '2021-11-30', 'CEFTRIAXONE INJ', 45, 6, 0, 1000, 6, 450, 'GENEITH PHARM', 11, 'CEFTRIAXONE', '7', 'IC1840002', '2', '2020-01-12 20:50:40'),
(3, '890129610514', '', '2019-04-30', '2021-03-31', 'BACQURE INJ', 45, 6, 0, 1000, 6, 3000, 'SUN PHARM', 4, 'IMIPENEME', '7', 'AA34233', '2', '2020-01-12 20:50:40'),
(4, '002', '', '2018-12-31', '2020-12-31', 'TRANEXAMINE ACID TAB', 40, 4, 0, 1000, 4, 6900, 'MANX PHARMA', 4, 'TRANEXAMIC ACID', '1', 'X01289', '2', '2020-01-12 20:50:40'),
(5, '003', '', '2018-10-30', '2021-10-30', 'MEFENAMIC ACID TAB', 40, 4, 0, 1000, 4, 2000, 'SUN PHARM', 4, 'MEFENAMIC ACID', '1', '1235', '2', '2020-01-12 20:50:40'),
(6, '0301730010667', '', '2018-08-30', '2020-08-30', 'SERETIDE INHALER', 63, 5, 0, 1000, 5, 3900, 'GSK', 4, 'SALMETEROL / FLUTICASONE PROPIONATE', '14', 'AE2X', '2', '2020-01-12 20:50:40'),
(7, '6164004605037', '', '2018-09-30', '2021-08-30', 'OTRIVIN NASAL DROP CHILD', 63, 5, 0, 1000, 5, 450, 'GSK', 4, 'XYLOMETAZOLINE HYROCHLORIDE 0.05%', '19', 'B89B', '2', '2020-01-12 20:50:40'),
(8, '004', '', '2019-07-30', '2022-07-30', 'NORMAL SALINE', 79, 6, 0, 1000, 6, 2800, 'DANA', 4, 'NORMAL SALINE', '16', 'BN0933', '2', '2020-01-12 20:50:40'),
(9, '005', '', '2019-01-30', '2022-12-30', '4.3% DESTROSE SALINE', 79, 6, 0, 1000, 6, 2800, 'DANA', 4, '4.3% DESTROSE SALINE', '15', '841N1013', '2', '2020-01-12 20:50:40'),
(10, '006', '', '2019-03-30', '2022-02-28', '50% DEXTROSE SALINE', 79, 6, 0, 1000, 6, 9540, 'DANA', 4, '50% DEXTROSE SALINE', '15', 'M5010185', '2', '2020-01-12 20:50:40'),
(11, '8906001820499', '', '2019-02-01', '2022-01-01', 'CIPROTAB', 0, 4, 4, 1000, 0, 125, 'FIDSON', 13, 'CIPROFLOXACIN', '1', 'CO19007', '2', '0000-00-00 00:00:00'),
(12, '8906001820499', '', '2019-02-01', '2022-01-01', 'CIPROTAB', 0, 4, 4, 1000, 4, 125, 'FIDSON', 13, 'CIPROFLOXACIN', '1', 'CO19007', '2', '0000-00-00 00:00:00'),
(13, '10', '', '2019-06-01', '2022-05-01', 'LONART DS', 0, 4, 4, 1000, 0, 900, 'GREENLIFE', 13, '', '1', 'J1AFM049', '2', '0000-00-00 00:00:00'),
(14, '13', '', '2019-01-01', '2020-12-01', 'COARTEM DS', 34, 4, 4, 1000, 0, 1500, 'NORVATIS', 9, 'ARTEMETER/LUMEFANTRINE', '1', 'KL320', '2', '0000-00-00 00:00:00'),
(15, '14', '', '2017-08-31', '2022-08-31', 'FANSIDAR(SWIPHA)', 34, 4, 4, 1000, 0, 180, 'SWIPHA', 13, 'SULFADOXINE+PYRIMETHAMINE', '1', 'L217033', '2', '0000-00-00 00:00:00'),
(16, '15', '', '2019-03-31', '2022-02-01', 'QUININE', 34, 4, 4, 1000, 0, 2600, 'SAVOCENT PHARMA', 13, 'QUININE', '1', '19T0302', '2', '0000-00-00 00:00:00'),
(17, '16', '', '2018-03-31', '2021-02-20', 'PALUDRINE NHIS', 34, 4, 4, 1000, 0, 3500, 'REALS', 13, 'PROGUANIL', '1', 'AF60801', '2', '0000-00-00 00:00:00'),
(18, '17', '', '0000-00-00', '2020-10-31', 'PALUDRINE', 34, 4, 4, 1000, 0, 9500, 'ALLIANCE', 13, 'PROGUANIL', '1', '1451333', '2', '0000-00-00 00:00:00'),
(19, '18', '', '2017-12-31', '2020-11-30', 'VINAQUINE', 34, 4, 9, 1000, 0, 500, 'MAY&BAKER', 4, 'CHLOROQUINE SULPHATE', '1', 'AI72071', '2', '0000-00-00 00:00:00'),
(20, '18', '', '2019-08-30', '2022-08-30', 'AUGMENTIN 1G TAB', 44, 4, 4, 1000, 0, 2900, 'GSK', 5, 'AMOXYCILLIN CLAVULANATE POTASSIUM', '1', 'AV5B', '2', '0000-00-00 00:00:00'),
(21, '19', '', '2019-08-30', '2021-08-30', 'AUGMENTIN 1G TAB', 44, 4, 4, 1000, 0, 3100, 'GSK', 0, 'AMOXYCILLIN CLAVULANATE POTASSIUM', '3', 'AR3P', '2', '0000-00-00 00:00:00'),
(22, '19', '', '2019-08-30', '2021-08-30', 'AUGMENTIN 1G TAB', 44, 4, 4, 1000, 0, 3100, 'GSK', 5, 'AMOXYCILLIN CLAVULANATE POTASSIUM', '3', 'AR3P', '2', '0000-00-00 00:00:00'),
(23, '19', '', '2019-08-30', '2022-08-30', 'AUGMENTIN 625', 44, 4, 4, 1000, 0, 2900, 'GSK', 5, 'AMOXYCILLIN CLAVULANATE POTASSIUM', '1', 'AV5B', '2', '0000-00-00 00:00:00'),
(24, '20', '', '2019-09-30', '2022-08-30', 'EMAL', 35, 6, 6, 1000, 0, 1750, 'THEMIS', 13, 'ARTEETHER', '18', 'EMD911', '3', '0000-00-00 00:00:00'),
(25, '21', '', '2019-10-20', '2022-09-30', 'EMAL INJ NHIS', 35, 6, 6, 1000, 0, 550, 'THEMIS', 13, 'ARTEETHER', '7', 'SE9035', '2', '0000-00-00 00:00:00'),
(26, '22', '', '2018-11-30', '2021-11-30', 'BCO INJ', 54, 6, 6, 1000, 0, 65, 'PAUCO', 13, 'BCOMPLEX', '18', '181138', '2', '0000-00-00 00:00:00'),
(27, '23', '', '2019-11-30', '2021-10-30', 'AQUACLAV 375', 44, 4, 4, 1000, 0, 700, 'PINNACLE HEALTH', 13, 'AMOXYCILLIN CLAVULANATE POTASSIUM', '1', 'B2602', '2', '0000-00-00 00:00:00'),
(28, '23', '', '2019-05-01', '2021-05-30', 'ZANTAC INJ', 46, 6, 6, 1000, 0, 700, 'GSK', 13, 'RANITIDINE', '7', '9ZABW', '2', '0000-00-00 00:00:00'),
(29, '24', '', '2019-10-20', '2021-10-30', '.KENALOG INJ', 61, 6, 6, 1000, 0, 6500, 'BRISTOL MYERS PHARMA', 4, 'TRIAMCINOLONE AETONOID', '18', 'ABC1110', '2', '0000-00-00 00:00:00'),
(30, '26', '', '2018-05-20', '2021-04-30', 'CIPROTAB 500MG TAB NHIS', 44, 4, 5, 1000, 0, 250, 'MAYDON', 15, 'CIPROFLOXACIN', '1', 'PL8023', '2', '0000-00-00 00:00:00'),
(31, '27', '', '2020-01-30', '2023-12-30', 'AMODIAQUINE SYR', 33, 9, 4, 1000, 0, 500, 'NEW GLOBAL PHARMA', 14, 'AMODAQUINE', '10', '2001', '2', '0000-00-00 00:00:00'),
(32, '30', '', '2019-06-01', '2021-05-30', 'FLEMMING 625', 44, 4, 4, 1000, 0, 1350, 'SANOFI', 16, 'AMOXYCILLIN CLAVULANATE POTASSIUM', '1', '910837', '2', '0000-00-00 00:00:00'),
(33, '32', '', '2019-12-01', '2021-11-30', 'FLEMMING 457', 43, 9, 9, 1000, 0, 1300, 'SANOFI', 16, 'AMOXYCILLIN CLAVULANATE POTASSIUM', '10', '911682', '2', '0000-00-00 00:00:00'),
(34, '33', '', '2018-11-01', '2020-10-30', 'FLEMMING 228MG', 43, 9, 9, 1000, 0, 850, 'SANOFI', 16, 'AMOXYCILLIN CLAVULANATE POTASSIUM', '10', '811412', '2', '0000-00-00 00:00:00'),
(35, '37', '', '2019-09-01', '2021-08-30', 'FLEMMING 1.2', 45, 6, 6, 1000, 0, 900, 'SANOFI', 16, 'AMOXYCILLIN CLAVULANATE POTASSIUM', '18', 'NI90073', '2', '0000-00-00 00:00:00'),
(36, '39', '', '2018-12-01', '2020-11-30', 'ORELOX', 43, 9, 9, 1000, 0, 2900, 'SANOFI', 16, 'CEFPODIXIME', '10', '8R25A', '2', '0000-00-00 00:00:00'),
(37, '40', '', '2019-11-01', '2021-10-30', 'AQUACLAV SYR', 43, 9, 9, 1000, 0, 450, 'PINNACLE HEALTH', 17, 'AMOXYCILLIN CLAVULANATE POTASSIUM', '10', 'TPNAD9036', '2', '0000-00-00 00:00:00'),
(38, '42', '', '2019-10-01', '2021-09-30', 'AQUACLAV 625', 45, 4, 4, 1000, 0, 750, 'PINNACLE HEALTH', 17, 'AMOXYCILLIN CLAVULANATE POTASSIUM', '1', 'B2579', '2', '0000-00-00 00:00:00'),
(39, '45', '', '2019-10-01', '2021-09-30', 'CEFDOXIM(ORELOX NHIS)', 0, 9, 9, 1000, 0, 1200, 'DIGITAL HEALTH CARE', 17, 'CEFPODIXIME', '10', 'CDM-18', '2', '0000-00-00 00:00:00'),
(40, '46', '', '2019-10-01', '2022-09-30', 'CEFUROXIME 125MG SYR (ZINNAT) NHIS', 43, 5, 5, 1000, 0, 750, 'POCCO', 4, 'CEFUROXIME', '10', '0339Z002', '2', '0000-00-00 00:00:00'),
(41, '47', '', '2019-10-01', '2022-05-30', 'COCODAMOL', 50, 4, 4, 1000, 0, 3500, 'M&A PHARAMACHEM', 4, 'CODIENE PHOSPHATE PARACETAMOL', '1', 'JI71', '2', '0000-00-00 00:00:00'),
(42, '49', '', '2018-09-01', '2021-08-30', 'LYRICA 75MG TAB', 50, 4, 4, 1000, 0, 5600, 'PFIZER', 17, 'PREGABALIN', '', 'AK9911', '2', '0000-00-00 00:00:00'),
(43, '50', '', '2019-10-01', '2021-09-30', 'BACLOFEN TAB 10MG', 50, 4, 4, 1000, 0, 1000, 'TEVA', 17, 'BACLOFEN', '1', '105827', '2', '0000-00-00 00:00:00'),
(44, '51', '', '2018-09-01', '2021-08-30', 'BUSCOPAN TAB 10MG', 94, 4, 4, 1000, 0, 1500, 'MAYDON', 15, 'HYOSCINE BUTYLBROMIDE', '1', 'MQ001', '2', '0000-00-00 00:00:00'),
(45, '53', '', '2018-11-01', '2021-10-30', 'CELEBREX', 50, 4, 4, 1000, 0, 1950, 'PFIZER', 17, 'CELECOXIB', '1', '00020119', '2', '0000-00-00 00:00:00'),
(46, '58', '', '2019-04-01', '2021-03-30', 'NEUROVIT TAB', 53, 4, 4, 1000, 0, 6000, 'HOVID', 13, 'VITAMIN B', '1', 'BK04656', '2', '0000-00-00 00:00:00'),
(47, '59', '', '2019-07-01', '2022-06-30', 'NO-ACHE', 50, 4, 4, 1000, 0, 800, 'PHARMA ETHICS', 9, 'ACECLOFENAC PARACETAMOL', '1', '2869005', '2', '0000-00-00 00:00:00'),
(48, '60', '', '2019-11-01', '2021-10-30', 'ARTHOCARE FORTE CAP', 62, 4, 5, 1000, 0, 1800, 'FIDSON', 13, 'GLUCOSAMINE HCL CHONDROTIN', '1', '0HH19023', '2', '0000-00-00 00:00:00'),
(49, '61', '', '2019-04-01', '2021-03-30', 'CATAFLAM', 50, 4, 4, 1000, 0, 6000, 'NOR', 13, 'DICLOFENAC POTASSIUM', '1', 'KM561', '2', '0000-00-00 00:00:00'),
(50, '62', '', '2019-03-01', '2022-04-30', 'CHYMORAL', 50, 4, 4, 1000, 0, 230, 'MANCARE', 13, 'TRPSIN CHYMOTRYPSIN', '1', 'TTC1O', '2', '0000-00-00 00:00:00'),
(51, '63', '', '2018-05-01', '2021-04-30', 'NORGESIC', 0, 4, 4, 1000, 0, 370, 'BLUE DIAMOND', 13, 'ORPHENADRINE PARACETAMOL', '1', 'ZT8055', '2', '0000-00-00 00:00:00'),
(52, '64', '', '2018-02-01', '2021-08-30', 'CAFERGOT', 0, 4, 4, 1000, 0, 850, 'ASSOS PHARMA', 13, '', '1', '1809015', '2', '0000-00-00 00:00:00'),
(53, '65', '', '2019-06-01', '2022-05-31', 'DICLOFENAC TAB', 50, 4, 4, 1000, 0, 1600, 'HOVID', 0, 'DICLOFENAC SODIUM', '1', 'BK06520', '2', '0000-00-00 00:00:00'),
(54, '67', '', '2019-04-01', '2022-04-30', 'DOLOMETA B', 53, 4, 4, 1000, 0, 1000, 'VIXA PHARMA', 13, 'VITAMIN B + DICLOFENAC', '1', '190446', '2', '0000-00-00 00:00:00'),
(55, '67', '', '2018-10-01', '2021-10-30', 'ZORECTC', 59, 4, 4, 1000, 0, 600, 'EMZOR', 13, 'AMILORIDE HYDOCHLORIDE', '1', '4502X', '2', '0000-00-00 00:00:00'),
(56, '69', '', '2019-10-12', '2022-02-20', 'BUSCOPAN TAB 10MG NHIS', 94, 4, 4, 1000, 0, 1050, 'JUMA PHARM', 13, 'HYOSCINE BUTYLBROMIDE', '1', '357', '2', '0000-00-00 00:00:00'),
(57, '70', '', '2018-11-30', '2021-10-30', 'LORATADINE TAB NHIS', 68, 4, 4, 1000, 0, 550, 'PONTAL', 13, 'LORATADINE', '1', '8462', '2', '0000-00-00 00:00:00'),
(58, '71', '', '2019-03-01', '2023-02-20', 'PREDNISOLONE TAB NHIS', 62, 4, 4, 1000, 0, 210, 'PAUCO', 13, 'PREDNISOLONE', '1', '006', '2', '0000-00-00 00:00:00'),
(59, '72', '', '2018-11-30', '2021-10-30', 'KETCONAZOLE TAB NHIS', 44, 4, 4, 1000, 0, 1600, 'DUPEN', 13, 'KETCONAZOLE', '1', 'A801', '2', '0000-00-00 00:00:00'),
(60, '73', '', '2019-05-01', '2022-04-30', 'AZITHROMYCIN 500MG NHIS', 44, 4, 4, 1000, 0, 5500, 'LONGERLIFE PHARM', 13, 'AZITHROMYCIN', '1', 'GT19160', '2', '0000-00-00 00:00:00'),
(61, '74', '', '2019-09-01', '2022-08-30', 'FLUCONAZOLE TAB NHIS', 44, 4, 4, 1000, 0, 2300, 'KALYAN PHARMA', 13, 'FLUCONAZOLE', '1', '19356301', '2', '0000-00-00 00:00:00'),
(62, '75', '', '2019-03-01', '2022-02-20', 'CEFUROXIME 250MG TAB NHIS', 44, 4, 4, 1000, 0, 4800, 'ALPHA LAB', 13, 'CEFUROXIME', '1', 'TE3117', '2', '0000-00-00 00:00:00'),
(63, '76', '', '2018-08-05', '2021-07-30', 'CEFUROXIME 500MG TAB NHIS', 44, 4, 4, 1000, 0, 8000, 'MAYDON', 15, 'CEFUROXIME', '1', 'CO18014', '2', '0000-00-00 00:00:00'),
(64, '77', '', '2019-04-01', '2022-04-30', 'AMOXYL 500MG', 44, 4, 4, 1000, 0, 900, 'CLARION', 13, 'AMOXYCILLIN', '1', '1904810', '2', '0000-00-00 00:00:00'),
(65, '78', '', '2020-01-01', '2022-12-30', 'AMOXYL 500MG NHIS', 44, 4, 4, 1000, 0, 750, 'MICHELLE LAB', 13, 'AMOXYCILLIN', '1', 'CM131', '2', '0000-00-00 00:00:00'),
(66, '79', '', '2018-07-01', '2021-06-30', 'AMPICLOX  TAB', 44, 4, 4, 1000, 0, 800, 'VADIS PHARM', 13, 'AMPICILLIN CLOXACILLIN', '1', '06040718', '2', '0000-00-00 00:00:00'),
(67, '80', '', '2020-01-01', '2022-12-30', 'AMOXYL 250MG', 44, 4, 4, 1000, 0, 500, 'MICHELLE LAB', 13, 'AMOXYCILLIN', '', 'CM159', '2', '0000-00-00 00:00:00'),
(68, '81', '', '2018-01-01', '2021-01-30', 'PALAXIN TAB NHIS', 34, 4, 4, 1000, 0, 3800, 'HANBET PHARMA', 13, 'DIHYDROARTEMISININ PIPERAQUINE', '1', '180152', '2', '0000-00-00 00:00:00'),
(69, '83', '', '2019-03-01', '2022-02-20', 'PALAXIN TAB', 34, 4, 4, 1000, 0, 8000, 'GREENLIFE', 13, 'DIHYDROARTEMISININ PIPERAQUINE', '1', 'J1AFNO33', '2', '0000-00-00 00:00:00'),
(70, '84', '', '2018-03-01', '2021-03-30', 'PALAXIN SYR NHIS', 32, 9, 9, 1000, 0, 600, 'HANBET PHARMA', 13, 'DIHYDROARTEMISININ PIPERAQUINE', '10', '180301', '2', '0000-00-00 00:00:00'),
(71, '86', '', '2019-04-01', '2022-04-30', 'VITAMIN D', 53, 4, 4, 1000, 0, 2500, 'PURITAN PRIDE', 13, 'VITAMIN D', '13', '493273', '2', '0000-00-00 00:00:00'),
(72, '88', '', '2018-02-01', '2021-01-30', 'VITAMIN A', 53, 4, 4, 1000, 0, 400, 'BIOMEDICINE', 13, 'VITAMIN A', '13', 'S182116', '2', '0000-00-00 00:00:00'),
(73, '89', '', '2019-06-01', '2022-05-30', 'RANFERON SYR', 52, 9, 9, 1000, 0, 300, 'RANBAXY', 13, 'IRON', '10', 'AA55296', '2', '0000-00-00 00:00:00'),
(74, '90', '', '2019-05-01', '2022-04-30', 'LYCOFER TAB', 53, 4, 4, 1000, 0, 700, 'PHARMA ETHICS', 9, '', '1', 'CE19008', '2', '0000-00-00 00:00:00'),
(75, '91', '', '2019-01-01', '2021-12-30', 'PARACETAMOL SYR', 27, 9, 9, 1000, 0, 150, 'MAY&BAKER', 13, 'PARACETAMOL', '10', 'A190134', '2', '0000-00-00 00:00:00'),
(76, '91', '', '2020-01-01', '2023-01-30', 'PARACETAMOL SYR NHIS', 27, 5, 5, 1000, 0, 130, 'EMZOR', 13, 'PARACETAMOL', '10', 'LO23Z', '3', '0000-00-00 00:00:00'),
(77, '95', '', '2018-12-01', '2021-11-30', 'IBUPROFEN SYR NHIS', 27, 5, 5, 1000, 0, 100, 'LIFETIMEW', 13, 'IBUPROFEN', '10', '02CL05', '2', '0000-00-00 00:00:00'),
(78, '97', '', '2019-06-01', '2022-05-30', 'REPROFEN SYR', 25, 5, 5, 1000, 0, 250, 'REALS', 13, 'IBUPROFEN', '9', 'RA396', '2', '0000-00-00 00:00:00'),
(79, '97', '', '2019-03-01', '2021-02-28', 'BCO SYR NHIS', 52, 5, 5, 1000, 0, 100, 'KP PHARMA', 13, 'VITAMIN B', '10', '2323B', '2', '0000-00-00 00:00:00'),
(80, '98', '', '2019-06-01', '2021-05-30', 'VIT C SYR NHIS', 52, 5, 5, 1000, 0, 100, 'KP PHARMA', 13, 'VITAMIN C', '10', '2986', '2', '0000-00-00 00:00:00'),
(81, '101', '', '2019-11-01', '2021-10-30', 'ASTYFER SYR', 52, 5, 5, 1000, 0, 1300, 'FIDSON', 13, 'IRON', '10', 'ARL19030', '2', '0000-00-00 00:00:00'),
(82, '102', '', '2019-11-01', '2021-07-30', 'ASTYMIN', 52, 5, 5, 1000, 0, 1300, 'FIDSON', 13, 'AMINO ACID', '10', 'ASL19095', '2', '0000-00-00 00:00:00'),
(83, '103', '', '2019-10-01', '2022-10-30', 'MENTHODEX SYR', 70, 5, 5, 1000, 0, 566, 'BELLS SONS & CO', 13, 'MENTHODEX', '10', '468X1', '2', '0000-00-00 00:00:00'),
(84, '104', '', '2019-04-01', '2022-04-30', 'LORATIDINE SYR', 70, 5, 5, 1000, 0, 300, 'AFRAB', 13, 'LORATADINE', '10', '19136', '2', '0000-00-00 00:00:00'),
(85, '104', '', '2019-06-01', '0021-06-30', 'SINUFED SYR', 70, 5, 5, 1000, 0, 380, 'SKG', 13, 'TRIPROLIDINE PSEUDOEPHEDRINE', '10', 'S21904', '2', '0000-00-00 00:00:00'),
(86, '105', '', '2019-10-01', '2022-09-30', 'ALLERGIN SYR', 70, 5, 5, 1000, 0, 116, 'DANA', 13, 'CHLORAPHENIRAMINE', '10', 'CLO64', '2', '0000-00-00 00:00:00'),
(87, '107', '', '2019-08-01', '2022-07-30', 'AREACTIN SYR', 70, 9, 9, 1000, 0, 250, 'PHARMATEX', 20, 'CHLORAPHENIRAMINE', '10', 'L9039', '2', '0000-00-00 00:00:00'),
(88, '108', '', '2019-05-01', '2022-05-30', 'EMZOLYN CHILD', 70, 5, 5, 1000, 0, 170, 'EMZOR', 13, 'DIPHENHYDRAMINE', '10', 'L54BY', '2', '0000-00-00 00:00:00'),
(89, '109', '', '2019-09-01', '2022-09-30', 'EMZOLYN ADULT', 70, 5, 5, 1000, 0, 175, 'EMZOR', 13, 'DIPHENHYDRAMINE', '10', 'L921Y', '2', '0000-00-00 00:00:00'),
(90, '100', '', '2018-11-01', '2021-10-30', 'CEPHAFLASH SYR (SPORIDEX NHIS)', 43, 9, 9, 1000, 0, 600, 'MIRAFLASH', 13, 'CEPHALEXIN', '9', 'NLF111804', '2', '0000-00-00 00:00:00'),
(91, '101', '', '2019-06-01', '2022-05-30', 'ASMALYN SYR', 70, 9, 9, 1000, 0, 270, 'MOPSON PHARMA', 13, 'SALBUTAMOL', '10', '2060819', '2', '0000-00-00 00:00:00'),
(92, '103', '', '2020-01-01', '2022-12-30', 'GESTID', 49, 9, 9, 1000, 0, 450, 'RANBAXY', 13, '', '9', 'AB18025', '2', '0000-00-00 00:00:00'),
(93, '107', '', '2019-09-01', '2022-08-30', 'ZINC TAB 20MG', 47, 4, 4, 1000, 0, 450, 'ARCHY PHARMA', 13, 'ZINC SULPHATE', '1', 'ZST19030', '2', '0000-00-00 00:00:00'),
(94, '109', '', '2019-04-04', '2022-04-30', 'ZINC 10MG', 48, 4, 4, 1000, 0, 1700, 'PHARMEDIC', 14, 'ZINC SULPHATE', '1', '0010319', '2', '0000-00-00 00:00:00'),
(95, '110', '', '2019-06-01', '2024-06-30', 'MAXOLONEW TAB', 47, 4, 4, 1000, 0, 1200, 'GSK', 4, 'METOCLOPRRAMIDE', '1', 'IMGAC', '2', '0000-00-00 00:00:00'),
(96, '111', '', '2019-01-01', '2021-12-30', 'STUGERON TAB', 68, 4, 4, 996, 0, 1700, 'JANSSEN', 4, 'CINARICINA', '1', '19AQ135', '2', '0000-00-00 00:00:00'),
(97, '112', '', '2019-10-01', '2022-09-30', 'LOMOTIL', 47, 4, 4, 1000, 0, 500, 'RPG LIFE', 13, 'DIPHENOXYLATE HYDROCHLORIDFE ATROPINE', '1', '03L19078', '2', '0000-00-00 00:00:00'),
(98, '113', '', '2018-09-01', '2023-08-30', 'IMODIUM', 47, 4, 4, 1000, 0, 750, 'JANSSEN', 13, 'LOPERAMIDE', '1', '18IQ086', '2', '0000-00-00 00:00:00'),
(99, '114', '', '2019-04-01', '2022-03-30', 'MAALOX SUSP', 49, 9, 9, 1000, 0, 1400, 'SANOFI', 13, 'ANTACID', '9', '740', '2', '0000-00-00 00:00:00'),
(100, '116', '', '2020-02-01', '2023-01-30', 'GASCOL', 49, 9, 9, 1000, 0, 450, 'FIDSON', 13, 'ANTACID', '9', 'L0120004', '2', '0000-00-00 00:00:00'),
(101, '117', '', '2019-02-01', '2022-02-28', 'STREPSIL TAB', 92, 4, 4, 1000, 0, 1350, 'RECKITT BENCKISER', 13, '', '1', 'GK349', '2', '0000-00-00 00:00:00'),
(102, '118', '', '2018-07-01', '2020-08-30', 'STREPSIL TAB NHIS', 92, 4, 4, 1000, 0, 1700, 'ROCKET BROTHERS', 13, '', '1', '000103', '2', '0000-00-00 00:00:00'),
(103, '119', '', '2018-08-01', '2021-07-30', 'BRETT MOUTH WASH', 92, 5, 5, 1000, 0, 540, 'PHARMA DEKO', 4, 'THYMOL', '10', '007', '2', '0000-00-00 00:00:00'),
(104, '120', '', '2019-05-01', '2022-04-30', 'NYSTATIN ORAL', 43, 5, 5, 1000, 0, 550, 'TIMEC PHARMA', 5, 'NYSTATIN', '10', 'MOL901', '2', '0000-00-00 00:00:00'),
(105, '121', '', '2019-08-01', '2022-07-30', 'CIMETIDINE 200MG TAB', 47, 4, 4, 1000, 0, 600, 'KRISHAT PHARMA', 13, 'CIMITIDINE', '1', 'KP19158', '2', '0000-00-00 00:00:00'),
(106, '122', '', '2019-10-01', '2022-09-30', 'CIMITIDINE 400MG', 47, 4, 4, 1000, 0, 780, 'KRISHAT PHARMA', 13, 'CIMITIDINE', '1', 'KP19147', '2', '0000-00-00 00:00:00'),
(107, '124', '', '2019-11-01', '2022-10-30', 'RABEPRAZOLE TAB', 49, 4, 4, 1000, 0, 450, 'DONY TRIUMP', 5, 'RABEPRAZOLE', '1', 'RBC902', '2', '0000-00-00 00:00:00'),
(108, '127', '', '2019-02-01', '2021-02-28', 'MIST MAG', 49, 9, 9, 1000, 0, 240, 'SPC', 13, 'ANTACID', '9', 'PO1235', '2', '0000-00-00 00:00:00'),
(109, '128', '', '2020-04-01', '2022-09-30', 'MIST MAG NHIS', 49, 9, 9, 1000, 0, 168, 'GAUZE', 13, 'ANTACID', '9', 'LOI452', '2', '0000-00-00 00:00:00'),
(110, '130', '', '2018-02-02', '2023-02-01', 'LIQUID PARAFFIN', 48, 9, 9, 1000, 0, 341, 'MOKO', 13, 'ANTACID', '9', '12LOPO', '2', '0000-00-00 00:00:00'),
(111, '132', '', '2019-11-01', '2022-11-30', 'VIT B SYR', 52, 5, 5, 1000, 0, 150, 'EMZOR', 13, 'VITAMIN B', '10', 'LI2013', '2', '0000-00-00 00:00:00'),
(112, '138', '', '2019-11-01', '2022-11-30', 'VITAMIN C', 52, 5, 5, 1000, 0, 150, 'EMZOR', 13, 'VITAMIN C', '10', 'LO45', '2', '0000-00-00 00:00:00'),
(113, '5017007019213', '', '2020-01-31', '2022-03-31', 'ATENOLOL 50MG TAB', 59, 4, 4, 1000, 4, 8, 'TEVA', 17, 'ATENOLOL', '', '', '2', '0000-00-00 00:00:00'),
(114, '5017007019220', '', '2020-01-30', '2022-02-28', 'ATENOLOL 100MG TAB', 59, 4, 4, 1000, 0, 9, 'TEVA', 13, 'ATENOLOL', '', '', '2', '0000-00-00 00:00:00'),
(115, '8906045369480', '', '2019-08-19', '2022-06-30', 'LOSARTAN 100MG TAB', 59, 4, 4, 1000, 0, 20, 'SAVORITE', 13, 'LOSARTAN POTASSIUM', '1', 'TL-500001', '2', '0000-00-00 00:00:00'),
(116, '8904159402420', '', '2019-01-30', '2022-03-30', 'LASARTAN 50MG TAB', 59, 4, 4, 1000, 0, 27, 'POCCO', 13, 'LOSARTAN POTASSIUM', '1', 'XT9D004', '2', '0000-00-00 00:00:00'),
(117, '150', '', '2018-10-30', '2020-09-30', 'THIAPRIL', 59, 4, 4, 1000, 0, 53, 'MAY&BAKER', 4, 'RAMIPRIL AND HYDROCHLOROTHIAZIDE', '1', 'A181958', '2', '0000-00-00 00:00:00'),
(118, '5017007070580', '', '2019-01-30', '2022-11-30', 'SPIRONOLACTONE 25MG TAB', 59, 4, 4, 1000, 0, 32, 'TEVA', 13, 'SPIRONOLACTONE', '1', '100031311844232', '2', '0000-00-00 00:00:00'),
(119, '151', '', '2019-01-30', '2022-10-31', 'NIFEDIPINE 20MG TAB', 59, 4, 4, 1000, 0, 4, 'GEMINI', 13, 'NIFEDIPINE', '1', 'NF003', '2', '0000-00-00 00:00:00'),
(120, '152', '', '2019-02-28', '2022-01-31', 'LIPITOR', 59, 4, 4, 1000, 0, 190, 'PFIZER', 13, 'ATORVASTATIN', '1', 'CD5296', '2', '0000-00-00 00:00:00'),
(121, '153', '', '2018-09-30', '2022-08-31', 'NORVASC 10MG TAB', 59, 4, 4, 1000, 0, 165, 'PFIZER', 13, 'AMLODIPINE', '1', '00018577', '2', '0000-00-00 00:00:00'),
(122, '5017007023364', '', '2019-01-31', '2023-09-30', 'AMLODIPINE 5MG TAB NHIS', 59, 4, 4, 1000, 0, 10, 'TEVA', 13, 'AMLODIPINE', '1', '1410918', '2', '0000-00-00 00:00:00'),
(123, '8904159102412', '', '2019-06-30', '2022-05-31', 'PROPRANOLOL 40MG TAB', 59, 4, 4, 1000, 0, 2500, 'POCCO', 4, 'PROPRANOLOL HYDROCHLORIDE', '1', 'XT9F030', '2', '0000-00-00 00:00:00'),
(124, '154', '', '2017-11-30', '2020-11-30', 'AMLOVAR 5MG TAB', 59, 4, 4, 1000, 0, 2800, 'NEIMETH', 13, 'AMLODIPINE', '1', '70105102', '2', '0000-00-00 00:00:00'),
(125, '155', '', '2018-04-30', '2021-04-30', 'AMLOVAR 10MG TAB', 59, 4, 4, 1000, 0, 4200, 'NEIMETH', 13, 'AMLODIPINE', '1', '80105002', '2', '0000-00-00 00:00:00'),
(126, '156', '', '2018-11-30', '2021-10-30', 'VASOPRIN 75MG TAB', 59, 4, 4, 1000, 0, 1800, 'JUHEL', 13, 'ACETYL SALICYCLIC ACID', '1', '1186', '2', '0000-00-00 00:00:00'),
(127, '6156000067674', '', '2019-07-30', '2022-06-30', 'GLUFORMIN 500MG TAB', 59, 4, 4, 1000, 0, 1800, 'NGC', 13, 'METFORMIN HYDROCHLORIDE', '1', 'FPG080219', '2', '0000-00-00 00:00:00'),
(128, '156', '', '2018-02-28', '2021-01-31', 'LISINOPRIL 10MG TAB NHIS', 59, 4, 4, 1000, 0, 1500, 'STRIDE', 13, 'LISINOPRIL', '1', 'SP180201', '2', '0000-00-00 00:00:00'),
(129, '6156000152660', '', '2018-05-30', '2022-11-30', 'NIFEDIPINE 20MG TAB NHIS', 59, 4, 4, 1000, 0, 130, 'UNICURE', 13, 'NIFEDIPINE', '1', '0611', '2', '0000-00-00 00:00:00'),
(130, '8901040270021', '', '2018-09-30', '2021-08-30', 'AMLODIPINE 10MG TAB NHIS', 59, 4, 4, 1000, 0, 650, 'MEDREICH', 16, 'AMLODIPINE', '1', '831028', '2', '0000-00-00 00:00:00'),
(131, '8904030900595', '', '2018-04-30', '2021-03-30', 'FRUSEMIDE 40MG TAB', 59, 4, 4, 1000, 0, 650, 'TIMEC PHARMA', 13, 'FRUSEMIDE', '', 'FRS808', '2', '0000-00-00 00:00:00'),
(132, '08906009312194', '', '2019-11-30', '2022-10-30', 'CLOPIDOGREL 75MG TAB', 59, 4, 4, 1000, 0, 750, 'ISSO', 13, 'CLOPIDOGREL', '1', 'F19121001', '2', '0000-00-00 00:00:00'),
(133, '5017123300233', '', '2019-01-30', '2021-07-30', 'SIMVASTATIN 20MG TAB', 0, 4, 4, 1000, 0, 450, 'CRESCENT', 13, 'SIMVASTATIN', '1', 'A18376', '2', '0000-00-00 00:00:00'),
(134, '8699532035486', '', '2019-01-30', '2021-10-30', 'CARDURA XL 4MG TAB', 59, 4, 4, 1000, 0, 1600, 'PFIZER', 13, 'DOKSAZOSIN', '1', '00022352', '2', '0000-00-00 00:00:00'),
(135, '157', '', '2019-07-30', '2022-06-30', 'ALDOMET 250MG TAB (METHYLDOPA)', 59, 4, 4, 1000, 0, 1180, 'UNICURE', 13, 'METHYDOPA', '1', '0701', '2', '0000-00-00 00:00:00'),
(136, '5017007023128', '', '2019-01-30', '2021-06-30', 'LISINOPRIL 10MG TAB', 59, 4, 4, 1000, 0, 500, 'TEVA', 13, 'LISINOPRIL', '1', '10074143786011', '2', '0000-00-00 00:00:00'),
(137, 'UDOP05', '', '2019-03-01', '2022-02-28', 'DOPATAB', 59, 4, 4, 1000, 0, 3500, 'HOVID', 20, 'METHYDOPA', '1', 'BK03509', '2', '0000-00-00 00:00:00'),
(138, '8906001820703', '', '2018-02-28', '2021-01-30', 'PEFLOTAB 400MG TAB', 59, 4, 4, 1000, 0, 700, 'FIDSON', 13, 'PEFLOXACIN', '1', 'PO18001', '2', '0000-00-00 00:00:00'),
(139, '8699504010657', '', '2019-01-30', '2021-10-30', 'SIRDALUD TAB', 50, 4, 4, 1000, 0, 1700, 'NOVARTIS', 13, 'TIZANIDINE', '1', 'KD118', '2', '0000-00-00 00:00:00'),
(140, '3582910052210', '', '2018-10-30', '2021-09-30', 'ORELOX 200MG TAB', 44, 4, 4, 1000, 0, 3200, 'SANOFI', 4, 'CEFPODIXIME', '1', 'BRC4C', '2', '0000-00-00 00:00:00'),
(141, '158', '', '2018-11-30', '2020-10-30', 'AUGMENTIN ES SUSP', 43, 5, 5, 1000, 0, 3000, 'GSK', 5, 'AMOXICILLIN TRIHYDRATE / POTASSIUM CLAVULANATE', '9', 'P670', '2', '0000-00-00 00:00:00'),
(142, '6221032150608', '', '2019-09-30', '2021-09-30', 'FLUMOX 250MG SYR', 42, 5, 5, 1000, 0, 1250, 'EIPICO', 13, 'AMOXYCILLIN + FLUCLOXACILLIN', '10', '190927', '2', '0000-00-00 00:00:00'),
(143, '159', '', '2019-03-30', '2021-02-28', 'ZITHROMAX SYR', 43, 5, 5, 1000, 0, 2500, 'PFIZER', 13, 'AZITHROMYCIN', '9', '907005', '2', '0000-00-00 00:00:00'),
(144, '160', '', '2018-11-30', '2020-11-30', 'AUGMENTIN 228.5MG SYR', 42, 5, 5, 1000, 0, 1700, 'GSK', 5, 'AMOXYCILLIN CLAVULANATE POTASSIUM', '9', '861395', '2', '0000-00-00 00:00:00'),
(145, '8850678024219', '', '2019-05-03', '2021-05-03', 'CLINDAMYCIN 300MG TAB', 44, 4, 4, 1000, 0, 800, 'GPO', 13, 'CLINDAMYCIN', '', '625117', '2', '0000-00-00 00:00:00'),
(146, '161', '', '2018-01-30', '2022-03-30', 'CLARITHROMYCIN 500MG CAP', 44, 4, 4, 1000, 0, 800, 'PAUCO', 13, 'CLARITHROMYCIN', '1', '01', '2', '0000-00-00 00:00:00'),
(147, '162', '', '2018-08-30', '2020-08-30', 'ZINNAT 125MG SUSP', 42, 5, 5, 1000, 0, 2500, 'GSK', 5, 'CEFUROXIME', '9', 'KW5C', '2', '0000-00-00 00:00:00'),
(148, '162', '', '2018-07-30', '2022-06-30', 'FLUCAMED 50MG CAP', 44, 7, 7, 1000, 0, 900, 'DCF', 17, 'FLUCONAZOLE', '2', '350701', '2', '0000-00-00 00:00:00'),
(149, '163', '', '2019-04-30', '2022-04-30', 'ZINNAT 500MG TAB', 44, 4, 4, 1000, 0, 2900, 'GSK', 13, 'CEFUROXIME', '1', 'VL6U', '2', '0000-00-00 00:00:00'),
(150, '164', '', '2018-06-30', '2021-06-30', 'ZINNAT 250MG TAB', 44, 4, 4, 1000, 0, 2000, 'GSK', 5, 'CEFUROXIME', '1', '5E5L', '2', '0000-00-00 00:00:00'),
(151, '164', '', '2017-09-30', '2020-08-30', 'LEVOFLOXACIN 500MG TAB', 44, 4, 4, 1000, 0, 900, 'SJS', 4, 'LEVOFLOXACIN', '1', '1701', '2', '0000-00-00 00:00:00'),
(152, '165', '', '2018-04-30', '2022-03-30', 'CLARITHROMYCIN 500MG CAP', 44, 4, 4, 1000, 0, 800, 'PAUCO', 13, 'CLARITHROMYCIN', '1', '04', '2', '0000-00-00 00:00:00'),
(153, '166', '', '2018-02-28', '2021-01-30', 'ERYTHROMYCIN 500MG TAB', 44, 4, 4, 1000, 0, 2500, 'STRIDE', 13, 'ERYTHROMYCIN', '1', 'J1802003', '2', '0000-00-00 00:00:00'),
(154, '167', '', '2017-10-30', '2020-09-30', 'OFLOXACIN 400MG TAB', 44, 4, 4, 1000, 0, 1500, 'LONGERLIFE PHARM', 13, 'OFLOXACIN', '1', 'GT17348', '2', '0000-00-00 00:00:00'),
(155, 'UVIR11', '', '2018-01-30', '2021-01-30', 'VIREST 200MG TAB', 44, 4, 4, 1000, 0, 2150, 'HOVID', 13, 'ACICLOVIR', '1', 'BGO1685', '2', '0000-00-00 00:00:00'),
(156, 'UVIR12', '', '2019-03-30', '2022-02-28', 'VIREST 400MG TAB', 44, 4, 4, 1000, 0, 3000, 'HOVID', 13, 'ACICLOVIR', '', 'BK03596', '2', '0000-00-00 00:00:00'),
(157, '168', '', '2019-03-30', '2023-02-28', 'FLUCAMED 50MG SYR', 43, 5, 5, 1000, 0, 750, 'DRUGFIELD', 13, 'FLUCONAZOLE', '10', '45C0123', '2', '0000-00-00 00:00:00'),
(158, '170', '', '2016-10-30', '2020-10-30', 'ZITHROMAX 250MG TAB', 44, 4, 4, 1000, 4, 3900, 'PFIZER', 13, 'AZITHROMYCIN', '1', '633900', '2', '0000-00-00 00:00:00'),
(159, 'UDOX06', '', '2019-03-01', '2022-02-28', 'DOXYCAP', 44, 4, 4, 1000, 0, 1700, 'HOVID', 13, 'DOXYCYCLINE', '1', 'BK03675', '2', '0000-00-00 00:00:00'),
(160, '171', '', '2018-02-28', '2021-02-28', 'CETROXOL 500MG TAB', 44, 4, 4, 1000, 0, 1300, 'LYN-EDGE', 13, 'AZITHROMYCIN', '1', '180201', '2', '0000-00-00 00:00:00'),
(161, '6154000034375', '', '2019-07-30', '2022-07-30', 'AMPICLOX SYR', 43, 5, 5, 1000, 0, 300, 'EMZOR', 13, 'AMPICILLIN CLOXACILLIN', '9', '3393V', '2', '0000-00-00 00:00:00'),
(162, '6154000034368', '', '2020-01-30', '2023-01-30', 'FLAGYL SYR', 48, 5, 5, 1000, 0, 155, 'EMZOR', 13, 'METRONIDAZOLE', '10', '10202', '2', '0000-00-00 00:00:00'),
(163, '6154000034405', '', '2019-03-30', '2022-03-30', 'SEPTRIM SYR', 43, 5, 5, 1000, 0, 155, 'EMZOR', 13, 'CO-TRIMOXAZOLE', '10', 'L820Y', '2', '0000-00-00 00:00:00'),
(164, '172', '', '2018-09-30', '2021-09-30', 'DICLOFENAC INJ', 24, 6, 6, 1000, 0, 180, 'CHRISNELB', 4, 'DICLOFENAC SODIUM', '7', '180933', '2', '0000-00-00 00:00:00'),
(165, '173', '', '2019-03-30', '2022-03-30', 'DEXAMETHASONE INJECTION', 46, 6, 6, 1000, 0, 350, '', 13, 'DEXAMETHASONE', '7', '190314', '2', '0000-00-00 00:00:00'),
(166, '174', '', '2018-05-30', '2021-04-30', 'HYDRALAZINE INJECTION', 57, 6, 6, 1000, 0, 1000, 'ZAHIDI', 13, 'HYDRALAZINE HYDROCHLORIDE', '7', 'HH-1801', '2', '0000-00-00 00:00:00'),
(167, '175', '', '2019-01-30', '2022-01-30', 'BUSCOPAN 20MG INJ', 46, 6, 6, 1000, 0, 600, '', 13, 'HYOSCINE BUTYLBROMIDE', '7', '190108', '2', '0000-00-00 00:00:00'),
(168, '176', '', '2018-01-30', '2021-01-30', 'VITAMIN K INJ', 54, 6, 6, 1000, 0, 700, 'NTMC', 13, 'MENADIONE SODIUM BISULPHITE', '7', '180102', '2', '0000-00-00 00:00:00'),
(169, '177', '', '2018-09-30', '2021-09-30', 'LACGATIL INJ', 0, 6, 6, 1000, 0, 1000, '', 13, 'CHLOPROMAZINE', '7', '180936', '2', '0000-00-00 00:00:00'),
(170, '178', '', '2018-05-30', '2021-05-30', 'MAXOLONE INJ', 46, 7, 6, 1000, 0, 200, 'CHUPET', 13, 'METOCLOPRAMIDE HYDROCHLORIDE', '7', '180501', '2', '0000-00-00 00:00:00'),
(171, '179', '', '2019-07-30', '2022-07-30', 'LASIX INJ 20MG', 46, 6, 6, 1000, 0, 250, 'CHUPET', 13, 'FUROSEMIDE', '7', '190711', '2', '0000-00-00 00:00:00'),
(172, '180', '', '2019-02-28', '2022-01-30', 'PHENEGAN INJ', 46, 6, 6, 1000, 0, 180, 'NELB', 13, 'PROMETHAZINE', '7', '190217', '2', '0000-00-00 00:00:00'),
(173, '182', '', '2018-12-30', '2021-12-30', 'CIMETIDINE 200MG INJ', 46, 6, 6, 1000, 0, 500, 'CHUPET', 13, 'CIMETIDINE', '7', '181208', '2', '0000-00-00 00:00:00'),
(174, '5014124170346', '', '2020-01-30', '2021-05-30', 'POTASSIUM CHLORIDE INJ', 54, 6, 6, 1000, 0, 5500, 'MARTINDALE', 13, 'POTASSIUM', '7', '0097754', '2', '0000-00-00 00:00:00'),
(175, '5014124170391', '', '2019-01-30', '2022-01-30', 'SODIUM BICARBONATE INJECTION', 54, 6, 6, 1000, 0, 550, 'MARTINDALE', 13, 'SODIUM BICARBONATE', '7', '0106493', '2', '0000-00-00 00:00:00'),
(176, '183', '', '2019-06-30', '2022-05-30', 'DAKTACORT CREAM', 80, 8, 8, 1000, 8, 1600, 'JANSSEN', 13, 'MICONAZOLE NITRATE', '6', 'JFB4V00', '2', '0000-00-00 00:00:00'),
(177, '184', '', '2018-10-30', '2021-09-30', 'MYCOTEN CREAM NHIS', 80, 8, 8, 1000, 0, 180, 'JAWA', 12, 'CLOTRIMAZOLE', '5', '806K', '3', '0000-00-00 00:00:00'),
(178, '185', '', '2018-10-30', '2021-10-30', 'BONJELA CREAM', 82, 8, 8, 1000, 0, 250, '', 13, 'CHOLINE SALICYLATE', '5', 'M8258', '2', '0000-00-00 00:00:00'),
(179, '186', '', '2018-08-01', '2021-07-31', 'VIREST CREAM', 80, 8, 8, 1000, 0, 1250, 'HOVID', 13, 'ACICLOVIR', '5', 'BJ08079', '3', '0000-00-00 00:00:00'),
(180, '186', '', '2018-12-30', '2021-11-30', 'NIZORAL CREAM', 80, 8, 8, 1000, 0, 1300, 'JANSSEN', 13, 'KETACONAZOL', '5', 'IKB4200', '3', '0000-00-00 00:00:00'),
(181, '6156000127583', '', '2019-01-30', '2022-12-30', 'GENTAMICIN CREAM', 80, 8, 8, 1000, 0, 250, 'DCF', 13, 'GENTAMICIN', '5', '02A0122', '3', '0000-00-00 00:00:00'),
(182, '186', '', '2019-02-28', '2023-01-30', 'CHLORAMPHENICOL EYE OINTMENT', 82, 8, 8, 1000, 0, 90, 'DRUGFIELD', 13, 'CHLORAMPHENICOL', '6', '0780123', '3', '0000-00-00 00:00:00'),
(183, '188', '', '2019-05-30', '2024-04-30', 'AQUASULF OINTMENT', 80, 8, 8, 1000, 0, 150, '', 13, 'SULFUR OINTMENT', '6', '237', '3', '0000-00-00 00:00:00'),
(184, '190', '', '2018-10-30', '2021-09-30', 'BORNOUT CREAM', 81, 8, 8, 1000, 0, 200, 'JAWA', 13, 'SILVER SULPHADIAZINE', '5', '806B', '3', '0000-00-00 00:00:00'),
(185, '191', '', '2018-11-30', '2021-10-30', 'ENDIX G CREAM NHIS', 80, 8, 8, 1000, 0, 180, 'JAWA', 12, 'CLOTRIMAZOLE + BECLOMETHASONE', '5', '804P', '3', '0000-00-00 00:00:00'),
(186, '8850007400462', '', '2019-01-01', '2022-05-15', 'KY JELLY', 80, 8, 8, 1000, 0, 350, '', 13, '', '5', '19051', '3', '0000-00-00 00:00:00'),
(187, '333', '', '2019-03-01', '2022-02-28', 'COARTEM 20/120 NHIS', 34, 4, 4, 1000, 0, 350, 'FALMA ACT', 9, 'ARTEMETER/LUMEFANTRINE', '1', '02039', '2', '0000-00-00 00:00:00'),
(188, '334', '', '2018-10-01', '2021-09-30', 'COARTEM 80/480 NHIS', 34, 4, 4, 1000, 0, 400, 'FALMA ACT', 9, 'ARTEMETER/LUMEFANTRINE', '1', 'FN8006', '2', '0000-00-00 00:00:00'),
(189, '335', '', '2019-12-01', '2022-12-30', 'MALDOX SYR', 33, 9, 9, 1000, 0, 165, 'EMZOR', 13, 'SULFADOXINE+PYRIMETHAMINE', '9', 'LI288Y', '2', '0000-00-00 00:00:00'),
(190, '336', '', '2019-09-01', '2022-12-03', 'MALDOX TAB', 34, 4, 4, 1000, 0, 75, 'EMZOR', 13, 'SULFADOXINE+PYRIMETHAMINE', '1', 'YT125', '2', '0000-00-00 00:00:00'),
(191, 'UDIA77', '', '2018-10-01', '2021-09-30', 'DIABETMIN', 55, 4, 4, 1000, 0, 1800, 'HOVID', 20, 'METFORMIN HYDROCHLORIDE', '', 'BJ10604', '2', '0000-00-00 00:00:00'),
(192, '3582910029229', '', '2019-10-01', '2021-09-30', 'DAONIL', 55, 4, 4, 1000, 0, 2000, 'SANOFI', 13, 'GLIBENCLAMIDE', '1', '9RJ4C', '2', '0000-00-00 00:00:00'),
(193, '6156000067667', '', '2019-11-01', '2022-10-30', 'DAONIL NHIS', 55, 4, 4, 1000, 0, 1100, 'NGC', 4, 'GLIBENCLAMIDE', '1', 'FPL070619', '2', '0000-00-00 00:00:00'),
(194, '8906013144682', '', '2018-06-01', '2021-05-30', 'METALAZONE', 55, 4, 4, 1000, 0, 2000, 'CENTAUR', 4, 'METALAZONE', '1', 'MLT1804', '2', '0000-00-00 00:00:00'),
(195, '8699504010350', '', '2019-11-01', '2022-11-30', 'DIGOXIN', 55, 4, 4, 1000, 0, 650, 'NORVATIS', 13, 'DIGOKSIN', '', 'KD507', '2', '0000-00-00 00:00:00'),
(196, '338', '', '2019-12-01', '2023-12-30', 'SLOW K', 58, 4, 4, 1000, 0, 3500, 'ASTELLES PHARMA', 5, 'KCL', '1', '19FA013', '2', '0000-00-00 00:00:00'),
(197, '339', '', '2019-10-01', '2021-03-30', 'GALVESMET', 55, 4, 4, 1000, 0, 9000, 'NORVATIS', 13, 'VILDAGLIPTIN/METFORMIN HCL', '1', 'WLW16', '2', '0000-00-00 00:00:00'),
(198, 'UCAR01', '', '2018-06-01', '2021-05-31', 'CABIROID', 58, 4, 4, 1000, 0, 2500, 'HOVID', 13, 'CARBIMAZOLE', '1', 'BJ06522', '2', '0000-00-00 00:00:00'),
(199, '412', '', '2019-05-01', '2022-05-30', 'CYTOTEC 200MG TAB (MISOPROSTOL)', 40, 4, 4, 1000, 0, 4800, 'PFIZER', 13, 'MISOPROSTOL', '1', 'B16519', '2', '0000-00-00 00:00:00'),
(200, '213', '', '2019-03-01', '2024-02-28', 'DUPHASTON 10MG TAB', 40, 4, 4, 1000, 0, 2300, 'ABBOT', 13, 'DYDRGESTERONE/DIDROGESTERONA', '1', '358680', '2', '0000-00-00 00:00:00'),
(201, '210', '', '2019-07-01', '2022-06-30', 'PRIMOLOUT INJ', 41, 6, 6, 1000, 0, 300, 'LIFE SCI PHARMA', 4, 'HYDROXYPROGESTERONE', '7', 'SLC9001', '2', '0000-00-00 00:00:00'),
(202, '218', '', '2018-09-01', '2023-09-30', 'PRIMOLOUT N', 40, 4, 4, 1000, 0, 1700, 'BAYER', 4, 'NORETHIST', '1', 'R9MN', '2', '0000-00-00 00:00:00'),
(203, '1278', '', '2019-04-01', '2021-04-30', 'VENTOLIN INHALER', 72, 8, 6, 1000, 0, 1200, 'GSK', 5, '', '14', 'HD7C', '2', '0000-00-00 00:00:00'),
(204, '198', '', '2019-04-01', '2024-03-30', 'ZENTEL', 30, 4, 4, 1000, 0, 208, 'GSK', 13, 'ALBENDAZOLE', '1', '930371', '2', '0000-00-00 00:00:00'),
(205, '6156000052373', '', '2018-09-01', '2022-09-30', 'PYRANTRIN SYR', 29, 9, 9, 1000, 0, 425, 'NEIMETH', 13, 'PYRANTEL PAMOATE', '9', '80318004B', '2', '0000-00-00 00:00:00'),
(206, '563', '', '2019-09-01', '2022-08-30', 'LAMIVUDINE', 85, 4, 4, 1000, 0, 2000, 'JOPAN', 5, 'LAMIVUDINE', '1', '19092201', '2', '0000-00-00 00:00:00'),
(207, '8904093800160', '', '2019-03-01', '2022-02-28', 'LAMIVUDINE\\NEVERAPINE/ZIDOVUDINE', 85, 4, 4, 1000, 0, 2400, 'MYLAN', 5, 'LAMIVUDINE', '1', '3065162', '2', '0000-00-00 00:00:00'),
(208, '8904185501876', '', '2019-10-01', '2022-09-30', 'ERYTHROMYCIN SYR', 43, 5, 5, 1000, 0, 350, 'MAYDON', 15, 'ERYTHROMYCIN', '8', 'ER014', '2', '0000-00-00 00:00:00'),
(209, '6156000127590', '', '2020-01-30', '2023-12-30', 'NEUROGESIC CREAM', 80, 8, 8, 1000, 0, 430, 'DRUGFIELD', 17, 'METHYL SALICYLATE', '5', '103A0323', '3', '0000-00-00 00:00:00'),
(210, '8901397022083', '', '2018-02-28', '2022-07-30', 'MYCOTEN VAGINAL TAB NHIS', 44, 11, 11, 1000, 0, 280, 'TRANSGLOBE', 13, 'CLOTRIMAZOLE', '1', 'GE241', '2', '0000-00-00 00:00:00'),
(211, '6156000081311', '', '2020-01-30', '2023-12-30', 'MYCOTEN CREAM', 80, 8, 8, 1000, 0, 305, 'DRUGFIELD', 13, 'CLOTRIMAZOLE', '5', '04A0123', '3', '0000-00-00 00:00:00'),
(212, '195', '', '2019-02-28', '2022-01-30', 'QUADRICLEAR CREAM', 80, 8, 8, 1000, 0, 600, 'LYN-EDGE', 13, 'BETAMETHASONE DIPROPIONATE + GENTAMICIN SULPHATE +TOINAFTATE + CLIOQUINOL', '5', '1822B1924', '3', '0000-00-00 00:00:00'),
(213, '6156000127538', '', '2019-09-30', '2023-08-30', 'MYCOTEN VAGINAL TAB', 81, 4, 11, 1000, 0, 625, 'DRUGFIELD', 13, 'CLOTRIMAZOLE', '1', '05JO223', '2', '0000-00-00 00:00:00'),
(214, '197', '', '2018-03-30', '2022-03-30', 'TIOCOSID CREAM', 80, 8, 8, 1000, 0, 1200, 'NEIMETH', 13, 'TIOCONAZOLE', '5', '80491001', '3', '0000-00-00 00:00:00'),
(215, '7640128012245', '', '2018-09-30', '2021-09-30', 'ROCEPHIN INJ', 45, 6, 6, 1000, 0, 2950, 'ROCHE', 13, 'CEFTIAXONE', '7', 'B0465B03F0745', '2', '0000-00-00 00:00:00'),
(216, '200', '', '2019-01-30', '2021-01-30', 'ZINNAT 750MG INJECTION', 45, 6, 6, 1000, 0, 900, 'GSK', 13, 'CEFUROXIME', '18', 'BA12', '2', '0000-00-00 00:00:00'),
(217, '201', '', '2020-01-30', '2021-12-30', 'FLEMING 1.2G INJ NHIS', 45, 6, 6, 1000, 0, 650, 'AQUATIX', 18, 'AMOXYCILLIN CLAVULANATE POTASSIUM', '7', 'MB20004', '2', '0000-00-00 00:00:00'),
(218, '5600340530325', '', '2018-01-30', '2021-01-30', 'OCEXONE 1G INJECTION', 45, 6, 6, 1000, 0, 1700, 'SWIPHA', 13, 'CEFTRIAXONE', '7', '18R0380B', '2', '0000-00-00 00:00:00'),
(219, '202', '', '2017-12-30', '2020-11-30', 'CHLOROQUINE INJECTION', 35, 6, 6, 1000, 0, 160, 'ZONASON', 13, 'CHLOROQUINE PHOSPHATE', '18', 'V-7114', '2', '0000-00-00 00:00:00'),
(220, '8901040256025', '', '2019-09-30', '2021-08-30', 'FLEMING 1.2G INJECTION', 45, 6, 6, 1000, 0, 750, 'SANOFI', 13, 'AMOXYCILLIN CLAVULANATE POTASSIUM', '7', 'N190073', '2', '0000-00-00 00:00:00'),
(221, '8906041849542', '', '2018-06-30', '2022-05-30', 'ARTESUNATE 30MG INJ', 35, 6, 6, 1000, 0, 750, 'ZOLON', 3, 'ARTESUNATE', '7', 'EL8004', '2', '0000-00-00 00:00:00'),
(222, '8906041849542', '', '2018-06-30', '2022-05-30', 'ARTESUNATE 60MG INJ', 35, 6, 6, 1000, 0, 750, 'ZOLON', 3, 'ARTESUNATE', '7', 'EL8004', '2', '0000-00-00 00:00:00'),
(223, '203', '', '2019-06-30', '2022-05-30', 'PARACETAMOL INJECTION', 24, 6, 6, 1000, 0, 5500, 'DGF', 17, 'PARACETAMOL', '7', '73F0122', '2', '0000-00-00 00:00:00'),
(224, '204', '', '2018-10-30', '2023-10-30', 'GENTALEK INJECTION', 45, 6, 6, 1000, 0, 9000, 'LEK', 13, 'GENTAMICIN', '7', 'JK4416', '2', '0000-00-00 00:00:00'),
(225, '205', '', '2019-04-30', '2022-04-30', 'CALCIUM GLUCONATE INJECTION', 54, 6, 6, 1000, 0, 80, 'NWA', 13, 'CALCIUM GLUCONATE', '7', '190424', '2', '0000-00-00 00:00:00'),
(226, '206', '', '2019-06-30', '2023-05-30', 'TRAMADOL CAP', 24, 6, 4, 1000, 0, 35, 'MACDECH', 13, 'TRAMADOL', '7', 'CUF04', '2', '0000-00-00 00:00:00'),
(227, '206', '', '2018-06-30', '2021-05-31', 'PHENOBARBITAL 100MG INJECTION', 57, 6, 6, 1000, 6, 340, 'STEROP', 13, 'PHENOBARBITAL', '', '1801154', '2', '0000-00-00 00:00:00'),
(228, '7640128012580', '', '2020-02-28', '2022-02-28', 'VALIUM INJECTION', 57, 6, 6, 1000, 0, 4000, 'ROCHE', 13, 'DIAZEPAM', '', 'F1168F05', '2', '0000-00-00 00:00:00'),
(229, '207', '', '2019-05-30', '2024-05-30', 'LEXOTAN 3MG TAB', 58, 4, 4, 1000, 0, 550, 'SWIPHA', 13, 'BROMAZEPAM', '', 'L219159', '2', '0000-00-00 00:00:00'),
(230, '209', '', '2019-03-30', '2022-02-28', 'PETAZOCINE 30MG INJECTION (FORTWIN) NHIS', 24, 6, 6, 1000, 0, 1100, 'MERIT', 13, '', '7', '119070', '2', '0000-00-00 00:00:00'),
(231, '210', '', '2020-01-30', '2022-01-30', 'DIHYDROCODEINE 30MG TAB', 50, 4, 4, 1000, 0, 2600, 'ACTAVIS', 13, 'DIHYDROCODEINE', '1', 'DH1384', '2', '0000-00-00 00:00:00'),
(232, '5017007111122', '', '2019-10-30', '2020-10-30', 'AMITRIPTYLINE 25MG TAB', 58, 4, 4, 1000, 0, 400, 'TEVA', 13, 'AMITRIPTYLINE', '1', '16447717', '2', '0000-00-00 00:00:00'),
(233, '211', '', '2019-04-30', '2023-03-30', 'PENTAZOCINE 30MG INJECTION (FORTWIN)', 24, 6, 6, 1000, 0, 200, 'SUN PHARM', 13, 'PENTAZOCINE', '7', 'HHW0034', '2', '0000-00-00 00:00:00'),
(234, '08902396006883', '', '2019-08-30', '2022-07-30', 'TRAMADOL INJECTION', 24, 6, 6, 1000, 0, 2100, 'MERIT', 13, 'TRAMADOL', '7', '9EC051108', '2', '0000-00-00 00:00:00'),
(235, 'UPER04', '', '2019-02-01', '2022-01-31', 'PREDNISOLONE TAB', 62, 4, 4, 1000, 0, 1600, 'HOVID', 20, 'PREDNISOLONE', '1', 'BK02519', '2', '0000-00-00 00:00:00'),
(236, '6156000081236', '', '2019-01-01', '2022-12-30', 'CLOMID', 40, 4, 4, 1000, 0, 540, 'CARROT TOP', 14, 'CLOMIPHENE CITRATE', '1', 'G038009', '2', '0000-00-00 00:00:00'),
(237, '714', '', '2019-11-01', '2022-10-30', 'EVENING PRIMROSE', 40, 4, 4, 1000, 0, 1600, 'STRIDES', 4, 'EVENING PRIMROSE', '1', 'LI9K001', '2', '0000-00-00 00:00:00'),
(238, '8699786092761', '', '2019-04-01', '2022-04-30', 'CRESTOR 10MG', 55, 4, 4, 1000, 0, 3200, 'ASTRZENECA', 4, 'ROSUVASTATIN', '1', 'RA660', '2', '0000-00-00 00:00:00'),
(239, 'ULOR13', '', '2019-04-01', '2022-03-31', 'LORATYN', 68, 4, 4, 1000, 0, 2500, 'HOVID', 14, 'LORATADINE', '1', 'BKO4754', '2', '0000-00-00 00:00:00'),
(240, '5000124135669', '', '2018-06-01', '2021-09-30', 'VENTOLIN NEBULES 2.5MG', 0, 5, 4, 1000, 0, 1700, 'GSK', 13, 'SALBUTAMOL SULFATE', '14', 'XW0696', '2', '0000-00-00 00:00:00'),
(241, '5000124135706', '', '2019-01-01', '2022-01-30', 'VENTOLIN NEBUULES 5MG', 73, 5, 8, 1000, 0, 3600, 'GSK', 13, 'SALBUTAMOL SULFATE', '14', 'XN0396', '2', '0000-00-00 00:00:00'),
(242, '715', '', '2019-12-01', '2022-11-30', 'O R S SATCHET', 0, 11, 11, 1000, 0, 98, 'PINNACLE HEALTH', 13, 'ORA REHYDRATION SALT', '8', 'GP19767', '2', '0000-00-00 00:00:00'),
(243, '6223002641871', '', '2019-03-01', '2022-02-28', 'OTRIVINE NASAL DROP (CHILD)', 71, 5, 5, 1000, 0, 500, 'GSK', 13, 'XYLOMETAZOLINE HYDROCHLORIDE', '', 'Y0935', '2', '0000-00-00 00:00:00'),
(244, '6223002641864', '', '2019-07-01', '2022-06-30', 'OTRIVINE NASAL DROP (ADULT)', 71, 5, 5, 1000, 0, 400, 'GSK', 14, 'XYLOMETAZOLINE HYDROCHLORIDE', '', 'Y1372', '2', '0000-00-00 00:00:00'),
(245, '6156000081274', '', '2018-12-01', '2020-12-30', 'EVERGREEN(FERTIAID FOR WOMEN)', 40, 4, 4, 1000, 0, 6500, 'CONTRACT PHARMA', 13, 'SUPPLEMENT', '1', '184289', '2', '0000-00-00 00:00:00'),
(246, '6156000081267', '', '0000-00-00', '2021-03-31', 'EVERGREEN( FERTAID FOR MEN)', 40, 4, 4, 1000, 0, 6500, 'CONTRACT PHARMA', 13, 'SUPPLEMENT', '1', '184491', '2', '0000-00-00 00:00:00'),
(247, '712', '', '2018-01-01', '2022-10-30', 'DE[PO- PROVERA', 41, 6, 6, 1000, 0, 200, 'PFIZER', 4, 'MEDROXYPROGESTERONE', '7', 'N49944', '2', '0000-00-00 00:00:00'),
(248, '890430640322', '', '2019-08-01', '2022-07-30', 'VEGA 100', 65, 4, 4, 1000, 0, 80, 'SIGNATURE', 4, 'SILDENAFIL', '1', '96703', '2', '0000-00-00 00:00:00'),
(249, '719', '', '2019-08-01', '2021-07-30', 'SPERM BOOM', 66, 7, 7, 1000, 0, 2500, 'HEALTHY C', 13, 'SPERM BOOM', '2', 'SB005', '2', '0000-00-00 00:00:00'),
(250, '8906045940641', '', '2019-05-01', '2022-04-30', 'GENTLAB', 76, 5, 5, 1000, 0, 100, 'LABORATE', 13, 'GENRAMICIN', '17', '19GD16', '2', '0000-00-00 00:00:00'),
(251, '412', '', '2018-04-01', '0000-00-00', 'CHLORAMPHENICOL EYE DROP', 76, 5, 6, 1000, 0, 150, 'MCA', 13, '', '17', '180327', '2', '0000-00-00 00:00:00'),
(252, '812', '', '2019-01-01', '2022-01-30', 'MANIX TAB', 66, 7, 7, 1000, 0, 1950, 'WOCKHARDT', 13, 'MANIX', '2', 'WTL9003', '2', '0000-00-00 00:00:00'),
(253, '5012778001412', '', '2018-03-01', '2023-03-30', 'CEUROMOL EAR DROP', 76, 5, 5, 1000, 0, 2100, 'THORNTON ROSS LTD', 13, 'ARACHIS CHLOROBUTANOL', '17', 'XJ42', '2', '0000-00-00 00:00:00'),
(254, '8902396003233', '', '2019-03-01', '2022-02-28', 'DICLOFENAC EYEDROP', 76, 5, 5, 1000, 0, 500, 'BIOSPHERE', 13, 'DICLOFENAC SODIUM', '17', '9EA02076', '2', '0000-00-00 00:00:00'),
(255, '6156000132570', '', '2018-01-01', '2020-12-20', 'CIFLAXIN EYE DROP', 76, 5, 5, 1000, 0, 322, 'DRUGFIELD', 13, 'CIPROFLOXACIN', '17', '18750101', '2', '0000-00-00 00:00:00'),
(256, '6154000034009', '', '2019-08-01', '2022-08-30', 'ZOLAT SYR', 29, 5, 9, 1000, 0, 120, 'EM', 13, 'ALBENDAZOLE', '9', 'L8517', '2', '0000-00-00 00:00:00'),
(257, '6154000034016', '', '2019-04-01', '2024-04-30', 'ZOLAT TAB', 30, 4, 4, 1000, 0, 78, 'EMZOR', 13, 'ALBENDAZOLE', '1', '939Y', '2', '0000-00-00 00:00:00'),
(258, '286141', '', '2019-07-01', '2022-06-30', 'KEPPRA 500MG', 0, 4, 4, 1000, 0, 5400, 'GSK', 13, 'LEVETIRACETAM', '1', '', '2', '0000-00-00 00:00:00'),
(259, '8901149000192', '', '2017-08-01', '2021-07-30', 'WORMIN 100', 30, 4, 4, 1000, 0, 120, 'CADILA PHARMA', 4, 'MEBENDAZOILE', '1', 'A023E7017', '2', '0000-00-00 00:00:00'),
(260, '814', '', '2019-04-01', '2022-04-30', 'SINUFED TAB', 68, 4, 4, 1000, 0, 3500, 'SKG', 13, 'TRIPROLIDINE PSEUDOEPHEDRINE', '1', '1902', '2', '0000-00-00 00:00:00'),
(261, '169', '', '2019-03-01', '2022-02-28', 'ROTARIX', 91, 6, 6, 1000, 0, 6500, 'GSK', 10, 'ROTAVIRUS', '10', 'AROLC507AA', '2', '0000-00-00 00:00:00'),
(262, '1124', '', '2017-12-01', '2020-11-30', 'TWINRIX', 91, 6, 6, 1000, 0, 6500, 'GSK', 10, 'HEP A&B ANTIGEN', '18', 'PKJL12', '2', '0000-00-00 00:00:00'),
(263, '871', '', '2019-04-01', '2021-04-30', 'TYPHIM', 91, 6, 6, 970, 0, 4500, 'SANOFI', 10, 'TYPHOID', '18', 'R2A272M', '2', '0000-00-00 00:00:00'),
(264, '214', '', '2016-10-01', '2020-09-30', 'CEVARIX', 91, 6, 6, 1000, 0, 8900, 'GSK', 10, 'HUMAN PAPILLOMAVIRUS', '18', 'AHPVA319BK', '2', '0000-00-00 00:00:00'),
(265, '1245', '', '2019-10-01', '2021-09-30', 'VARILIX', 91, 6, 7, 1000, 0, 9000, 'GSK', 10, 'VARICELLA VACCINE', '18', 'A70CD391B', '2', '0000-00-00 00:00:00'),
(266, '1478', '', '2019-02-01', '2021-07-30', 'MMR', 91, 6, 6, 1000, 0, 3000, 'SERUM INSTITUTE', 3, 'MEASLES MUMPS & RUBELLA VACCINE', '18', '0139N021B', '2', '0000-00-00 00:00:00'),
(267, '6154000035761', '', '0000-00-00', '2020-11-26', 'MENINGOCOCCAL VACCINE', 91, 6, 6, 1000, 0, 6500, 'EMZOR', 3, 'GROUP ACYW135', '18', 'E201811012', '2', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `xray`
--

CREATE TABLE `xray` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `fee` int(255) NOT NULL,
  `nurse` int(11) NOT NULL,
  `category` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xray`
--

INSERT INTO `xray` (`id`, `name`, `fee`, `nurse`, `category`) VALUES
(1, 'SKULL AP', 3000, 0, '1'),
(2, 'SKULL AP/LAT', 6000, 0, '1'),
(3, 'CHEST PA', 3500, 0, '2'),
(4, 'CERVICAL (NECK) AP', 3000, 0, '1'),
(5, 'CERVICAL (NECK) AP / LAT', 6000, 0, '1'),
(6, 'MANDIBLE (2 VIEWS )', 6000, 0, '1'),
(7, 'PARANASAL SINUSES', 12000, 0, '1'),
(8, 'MAXILLA', 3000, 0, '1'),
(9, 'MASTOID  (3 VIEWS )', 15000, 0, '1'),
(10, 'TEMPORO MANDIBULAR JOINT  (1 VIEW)', 3000, 0, '1'),
(11, 'PITUITARY FOSSA', 5000, 0, '1'),
(12, 'NASAL BONE (2 VIEW)', 5000, 0, '1'),
(13, 'CHEST PA / LAT', 7000, 0, '2'),
(14, 'THORAXIC INLET', 3700, 0, '2'),
(15, 'THORAXIC VERTIBRAE PA/LAT', 7000, 0, '2'),
(16, 'SHOULDER AP', 3000, 0, '2'),
(17, 'SHOULDER AP / LAT', 5500, 0, '2'),
(18, 'SCAPULA PA / OBL', 4000, 0, '2'),
(19, 'CLAVICLE AP', 3000, 0, '2'),
(20, 'STERNO-CLAVICULAR JOINT AP', 3000, 0, '2'),
(21, 'STERNUM AP / OBL', 5000, 0, '2'),
(22, 'RIBS', 3000, 0, '2'),
(23, 'HSG', 16000, 0, '3'),
(24, 'BARIUM MEAL', 22000, 0, '3'),
(25, 'BARIUM MEAL & FOLLOW THROUGH', 22000, 0, '3'),
(26, 'BARIUM MEAL ENEMA', 22000, 0, '3'),
(27, 'IVU', 27000, 0, '3'),
(28, 'URETHOGRAM', 16000, 0, '3'),
(29, 'ANTEROGRADE CYSTOURETHOGRAM', 1500, 0, '3'),
(30, 'Chest (PA)', 5000, 0, '9'),
(31, 'Chest (LAT)', 5000, 0, '9'),
(32, 'Hand', 5000, 0, '9'),
(33, 'Wrist', 5000, 0, '9'),
(34, 'Forearm', 5000, 0, '9'),
(35, 'Elbow', 5000, 0, '9'),
(36, 'Humerus', 5000, 0, '9'),
(37, 'Shoulder', 5000, 0, '9'),
(38, 'Foot', 5000, 0, '9'),
(39, 'Ankle', 5000, 0, '9'),
(40, 'Tibia/Fibula ( LEG )', 5000, 0, '9'),
(41, 'Knee', 5000, 0, '9'),
(42, 'Thigh', 10000, 0, '9'),
(43, 'Pelvis', 8000, 0, '9'),
(44, 'Hip', 10000, 0, '9'),
(45, 'Cervical Spine ( C Spine )', 10000, 0, '9'),
(46, 'Thoracic Spine', 10000, 0, '9'),
(47, 'Lumbosacral Spine ( LSS )', 10000, 0, '9'),
(48, 'Skull', 10000, 0, '9'),
(49, 'Facial Bones', 10000, 0, '9'),
(50, 'Mandible', 15000, 0, '9'),
(51, 'Paranasal Sinus ( PNS )', 15000, 0, '9'),
(52, 'Post Nasal Space', 5000, 0, '9'),
(53, 'Temporal Bone ( MASTIOD )', 15000, 0, '9'),
(54, 'Soft Tissue Neck ( THORACIC IN LET )', 5000, 0, '9'),
(55, 'Kub', 5000, 0, '9'),
(56, 'Plain Abdomine ( ERECT & SPINE )', 10000, 0, '9'),
(57, 'H.S.G', 25000, 0, '10'),
(58, 'I.V.U', 35000, 0, '10'),
(59, 'Barium Swallow', 30000, 0, '10'),
(60, 'Barium Meal & Follow Through', 35000, 0, '10'),
(61, 'Bairum Emema', 35000, 0, '10'),
(62, 'Cystourethrogram', 30000, 0, '10'),
(63, 'Gastrogram', 30000, 0, '10'),
(64, 'Hands ( BOTH )', 10000, 0, '11'),
(65, 'Wrists ( BOTH )', 10000, 0, '11'),
(66, 'Forearm ( BOTH )', 10000, 0, '11'),
(67, 'Elbow ( BOTH )', 10000, 0, '11'),
(68, 'Humerus ( BOTH )', 10000, 0, '11'),
(69, 'Shoulder ( BOTH )', 10000, 0, '11'),
(70, 'Feet ( BOTH )', 10000, 0, '11'),
(71, 'Ankle ( BOTH )', 10000, 0, '11'),
(72, 'Legs ( BOTH )', 10000, 0, '11'),
(73, 'Knee ( BOTH )', 10000, 0, '11'),
(74, 'Thigh ( BOTH )', 20000, 0, '11'),
(75, 'Hips ( BOTH )', 20000, 0, '11'),
(76, 'E C G', 10000, 0, '11');

-- --------------------------------------------------------

--
-- Table structure for table `xray_requests`
--

CREATE TABLE `xray_requests` (
  `id` int(11) NOT NULL,
  `patient_id` int(20) NOT NULL,
  `appointment_id` int(20) NOT NULL,
  `link` longtext NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` longtext NOT NULL,
  `time_requested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xray_requests`
--

INSERT INTO `xray_requests` (`id`, `patient_id`, `appointment_id`, `link`, `name`, `type`, `time_requested`, `staff_id`) VALUES
(1, 1, 1, '5f2878fdd31a1', '64', '11', '2020-08-03 20:52:13', 2),
(2, 1, 1, '5f2878fdd31a1', '65', '11', '2020-08-03 20:52:14', 2),
(3, 9, 1, '5f60ded5c5c3c', '64', '11', '2020-09-15 15:33:41', 86),
(4, 9, 1, '5f60ded5c5c3c', '41', '9', '2020-09-15 15:33:41', 86),
(5, 9, 1, '5f60ded5c5c3c', '63', '10', '2020-09-15 15:33:41', 86),
(6, 9, 1, '5f61d5a782e19', '76', '11', '2020-09-16 09:06:47', 2),
(7, 9, 1, '5f61d5a782e19', '35', '9', '2020-09-16 09:06:47', 2),
(8, 11, 5, '5f61f9e75c706', '64', '11', '2020-09-16 11:41:27', 97),
(9, 3, 2, '5f62f153e80cb', '73', '11', '2020-09-17 05:17:07', 2),
(10, 2, 8, '5f630d10a8a0a', '73', '11', '2020-09-17 07:15:28', 2),
(11, 2, 22, '5f67b2b27aba7', '64', '11', '2020-09-20 19:51:14', 86),
(12, 3, 2, '5f6acdbfee8bc', '64', '11', '2020-09-23 04:23:27', 97);

-- --------------------------------------------------------

--
-- Table structure for table `xray_types`
--

CREATE TABLE `xray_types` (
  `xray_cat_id` int(200) NOT NULL,
  `category` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xray_types`
--

INSERT INTO `xray_types` (`xray_cat_id`, `category`) VALUES
(9, 'Conventional'),
(10, 'Special Investigations'),
(11, 'Bilateral Structures');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_balance`
--
ALTER TABLE `acc_balance`
  ADD PRIMARY KEY (`acc_balance_id`);

--
-- Indexes for table `acc_daily`
--
ALTER TABLE `acc_daily`
  ADD PRIMARY KEY (`acc_daily_id`);

--
-- Indexes for table `acc_month`
--
ALTER TABLE `acc_month`
  ADD PRIMARY KEY (`acc_month_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_stock`
--
ALTER TABLE `admin_stock`
  ADD PRIMARY KEY (`admin_stock_id`);

--
-- Indexes for table `admission_request`
--
ALTER TABLE `admission_request`
  ADD PRIMARY KEY (`admission_request_id`);

--
-- Indexes for table `admission_status`
--
ALTER TABLE `admission_status`
  ADD PRIMARY KEY (`admission_status_id`),
  ADD UNIQUE KEY `admission_status` (`admission_status`);

--
-- Indexes for table `antenatal`
--
ALTER TABLE `antenatal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `antenatal1`
--
ALTER TABLE `antenatal1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `antenatal_note`
--
ALTER TABLE `antenatal_note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `antenatal_record`
--
ALTER TABLE `antenatal_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ante_other_children`
--
ALTER TABLE `ante_other_children`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`bed_id`),
  ADD UNIQUE KEY `bed` (`bed`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed_types`
--
ALTER TABLE `bed_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_groups`
--
ALTER TABLE `blood_groups`
  ADD PRIMARY KEY (`blood_group_id`);

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_stock`
--
ALTER TABLE `blood_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_test`
--
ALTER TABLE `blood_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_test_group`
--
ALTER TABLE `blood_test_group`
  ADD PRIMARY KEY (`blood_test_group_id`);

--
-- Indexes for table `blood_test_result`
--
ALTER TABLE `blood_test_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `caf_accounts`
--
ALTER TABLE `caf_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `caf_sales_detail`
--
ALTER TABLE `caf_sales_detail`
  ADD PRIMARY KEY (`Sales_ID`);

--
-- Indexes for table `caf_stock`
--
ALTER TABLE `caf_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `caf_units`
--
ALTER TABLE `caf_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `capitations`
--
ALTER TABLE `capitations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_types`
--
ALTER TABLE `card_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_bill`
--
ALTER TABLE `company_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consulting_rooms`
--
ALTER TABLE `consulting_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_method`
--
ALTER TABLE `contact_method`
  ADD PRIMARY KEY (`contact_method_id`),
  ADD UNIQUE KEY `contact_method` (`contact_method`);

--
-- Indexes for table `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cost_types`
--
ALTER TABLE `cost_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_balance`
--
ALTER TABLE `credit_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_expense`
--
ALTER TABLE `daily_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispensing_chart`
--
ALTER TABLE `dispensing_chart`
  ADD PRIMARY KEY (`dispensing_chart_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_types`
--
ALTER TABLE `doctor_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`donor_id`);

--
-- Indexes for table `duty_check`
--
ALTER TABLE `duty_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_request`
--
ALTER TABLE `exam_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses_types`
--
ALTER TABLE `expenses_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_effects`
--
ALTER TABLE `extra_effects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_file`
--
ALTER TABLE `extra_file`
  ADD PRIMARY KEY (`extra_file_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `families`
--
ALTER TABLE `families`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hmo_lab_test`
--
ALTER TABLE `hmo_lab_test`
  ADD PRIMARY KEY (`lab_test_id`);

--
-- Indexes for table `hospital_info`
--
ALTER TABLE `hospital_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in-patients`
--
ALTER TABLE `in-patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_types`
--
ALTER TABLE `income_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurance_type`
--
ALTER TABLE `insurance_type`
  ADD PRIMARY KEY (`insurance_type_id`),
  ADD UNIQUE KEY `insurance_type` (`insurance_type`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_patient_payment`
--
ALTER TABLE `in_patient_payment`
  ADD PRIMARY KEY (`in_patient_payment_id`),
  ADD UNIQUE KEY `in_patient_payment` (`in_patient_payment`);

--
-- Indexes for table `in_sales`
--
ALTER TABLE `in_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ipd_food`
--
ALTER TABLE `ipd_food`
  ADD PRIMARY KEY (`ipd_food_id`);

--
-- Indexes for table `ipd_patients`
--
ALTER TABLE `ipd_patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labour`
--
ALTER TABLE `labour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_notifications`
--
ALTER TABLE `lab_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_result`
--
ALTER TABLE `lab_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_temps`
--
ALTER TABLE `lab_temps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_temp_name`
--
ALTER TABLE `lab_temp_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_test_type`
--
ALTER TABLE `lab_test_type`
  ADD PRIMARY KEY (`lab_test_type_id`),
  ADD UNIQUE KEY `lab_test_type` (`lab_test_type`);

--
-- Indexes for table `ledger_temp`
--
ALTER TABLE `ledger_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `morgue_beds`
--
ALTER TABLE `morgue_beds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `morgue_bed_types`
--
ALTER TABLE `morgue_bed_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `morgue_bills`
--
ALTER TABLE `morgue_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `morgue_charges`
--
ALTER TABLE `morgue_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `morgue_index`
--
ALTER TABLE `morgue_index`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_income`
--
ALTER TABLE `other_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_appointment`
--
ALTER TABLE `patient_appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_fluid`
--
ALTER TABLE `patient_fluid`
  ADD PRIMARY KEY (`patient_fluid_id`);

--
-- Indexes for table `patient_obs`
--
ALTER TABLE `patient_obs`
  ADD PRIMARY KEY (`patient_obs_id`);

--
-- Indexes for table `patient_scan_group`
--
ALTER TABLE `patient_scan_group`
  ADD PRIMARY KEY (`patient_scan_group_id`);

--
-- Indexes for table `patient_scan_result`
--
ALTER TABLE `patient_scan_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_test`
--
ALTER TABLE `patient_test`
  ADD PRIMARY KEY (`patient_test_id`);

--
-- Indexes for table `patient_test_group`
--
ALTER TABLE `patient_test_group`
  ADD PRIMARY KEY (`patient_test_group_id`);

--
-- Indexes for table `patient_test_result`
--
ALTER TABLE `patient_test_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_xray_group`
--
ALTER TABLE `patient_xray_group`
  ADD PRIMARY KEY (`patient_xray_group_id`);

--
-- Indexes for table `patient_xray_result`
--
ALTER TABLE `patient_xray_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`payment_type_id`),
  ADD UNIQUE KEY `payment_type` (`payment_type`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `percentage`
--
ALTER TABLE `percentage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharm_category`
--
ALTER TABLE `pharm_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharm_form`
--
ALTER TABLE `pharm_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharm_notifications`
--
ALTER TABLE `pharm_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharm_requests`
--
ALTER TABLE `pharm_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `pharm_sales_detail`
--
ALTER TABLE `pharm_sales_detail`
  ADD PRIMARY KEY (`Sales_ID`);

--
-- Indexes for table `pharm_stock`
--
ALTER TABLE `pharm_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharm_stock1`
--
ALTER TABLE `pharm_stock1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharm_suppliers`
--
ALTER TABLE `pharm_suppliers`
  ADD PRIMARY KEY (`Supplier_ID`);

--
-- Indexes for table `pharm_units`
--
ALTER TABLE `pharm_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharm_updates`
--
ALTER TABLE `pharm_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharm_usage`
--
ALTER TABLE `pharm_usage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `physiotherapy_requests`
--
ALTER TABLE `physiotherapy_requests`
  ADD PRIMARY KEY (`physiotherapy_id`);

--
-- Indexes for table `prechecklist`
--
ALTER TABLE `prechecklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescription_id`);

--
-- Indexes for table `prescription1`
--
ALTER TABLE `prescription1`
  ADD PRIMARY KEY (`prescription_id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `samples`
--
ALTER TABLE `samples`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scan`
--
ALTER TABLE `scan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scan_files`
--
ALTER TABLE `scan_files`
  ADD PRIMARY KEY (`extra_file_id`);

--
-- Indexes for table `scan_requests`
--
ALTER TABLE `scan_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scan_types`
--
ALTER TABLE `scan_types`
  ADD PRIMARY KEY (`scan_cat_id`);

--
-- Indexes for table `send_test`
--
ALTER TABLE `send_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_url`
--
ALTER TABLE `site_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `surgery_perm`
--
ALTER TABLE `surgery_perm`
  ADD PRIMARY KEY (`surgery_perm_id`);

--
-- Indexes for table `tariffs`
--
ALTER TABLE `tariffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_presc`
--
ALTER TABLE `temp_presc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_presc1`
--
ALTER TABLE `temp_presc1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `temp_presct`
--
ALTER TABLE `temp_presct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_test`
--
ALTER TABLE `temp_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `therapy_plans`
--
ALTER TABLE `therapy_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treatment_list`
--
ALTER TABLE `treatment_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors_log`
--
ALTER TABLE `visitors_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_stock`
--
ALTER TABLE `warehouse_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xray`
--
ALTER TABLE `xray`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xray_requests`
--
ALTER TABLE `xray_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `xray_types`
--
ALTER TABLE `xray_types`
  ADD PRIMARY KEY (`xray_cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `acc_balance`
--
ALTER TABLE `acc_balance`
  MODIFY `acc_balance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_daily`
--
ALTER TABLE `acc_daily`
  MODIFY `acc_daily_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_month`
--
ALTER TABLE `acc_month`
  MODIFY `acc_month_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_stock`
--
ALTER TABLE `admin_stock`
  MODIFY `admin_stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admission_request`
--
ALTER TABLE `admission_request`
  MODIFY `admission_request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admission_status`
--
ALTER TABLE `admission_status`
  MODIFY `admission_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `antenatal`
--
ALTER TABLE `antenatal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `antenatal1`
--
ALTER TABLE `antenatal1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `antenatal_note`
--
ALTER TABLE `antenatal_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `antenatal_record`
--
ALTER TABLE `antenatal_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ante_other_children`
--
ALTER TABLE `ante_other_children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bed`
--
ALTER TABLE `bed`
  MODIFY `bed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `bed_types`
--
ALTER TABLE `bed_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blood_groups`
--
ALTER TABLE `blood_groups`
  MODIFY `blood_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_stock`
--
ALTER TABLE `blood_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_test`
--
ALTER TABLE `blood_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `blood_test_group`
--
ALTER TABLE `blood_test_group`
  MODIFY `blood_test_group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_test_result`
--
ALTER TABLE `blood_test_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `caf_accounts`
--
ALTER TABLE `caf_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `caf_sales_detail`
--
ALTER TABLE `caf_sales_detail`
  MODIFY `Sales_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `caf_stock`
--
ALTER TABLE `caf_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `caf_units`
--
ALTER TABLE `caf_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `capitations`
--
ALTER TABLE `capitations`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `card_types`
--
ALTER TABLE `card_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_bill`
--
ALTER TABLE `company_bill`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consulting_rooms`
--
ALTER TABLE `consulting_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_method`
--
ALTER TABLE `contact_method`
  MODIFY `contact_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cost_types`
--
ALTER TABLE `cost_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `credit_balance`
--
ALTER TABLE `credit_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_expense`
--
ALTER TABLE `daily_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dispensing_chart`
--
ALTER TABLE `dispensing_chart`
  MODIFY `dispensing_chart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_types`
--
ALTER TABLE `doctor_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `duty_check`
--
ALTER TABLE `duty_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_request`
--
ALTER TABLE `exam_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses_types`
--
ALTER TABLE `expenses_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `in-patients`
--
ALTER TABLE `in-patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipd_patients`
--
ALTER TABLE `ipd_patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `morgue_beds`
--
ALTER TABLE `morgue_beds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `morgue_bed_types`
--
ALTER TABLE `morgue_bed_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `morgue_bills`
--
ALTER TABLE `morgue_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `morgue_charges`
--
ALTER TABLE `morgue_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `morgue_index`
--
ALTER TABLE `morgue_index`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_appointment`
--
ALTER TABLE `patient_appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_scan_group`
--
ALTER TABLE `patient_scan_group`
  MODIFY `patient_scan_group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_scan_result`
--
ALTER TABLE `patient_scan_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_test`
--
ALTER TABLE `patient_test`
  MODIFY `patient_test_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_test_group`
--
ALTER TABLE `patient_test_group`
  MODIFY `patient_test_group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_test_result`
--
ALTER TABLE `patient_test_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_xray_group`
--
ALTER TABLE `patient_xray_group`
  MODIFY `patient_xray_group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_xray_result`
--
ALTER TABLE `patient_xray_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharm_requests`
--
ALTER TABLE `pharm_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharm_stock`
--
ALTER TABLE `pharm_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=621;

--
-- AUTO_INCREMENT for table `pharm_stock1`
--
ALTER TABLE `pharm_stock1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pharm_suppliers`
--
ALTER TABLE `pharm_suppliers`
  MODIFY `Supplier_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharm_units`
--
ALTER TABLE `pharm_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pharm_updates`
--
ALTER TABLE `pharm_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pharm_usage`
--
ALTER TABLE `pharm_usage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `physiotherapy_requests`
--
ALTER TABLE `physiotherapy_requests`
  MODIFY `physiotherapy_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prechecklist`
--
ALTER TABLE `prechecklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription1`
--
ALTER TABLE `prescription1`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `samples`
--
ALTER TABLE `samples`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scan`
--
ALTER TABLE `scan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `scan_files`
--
ALTER TABLE `scan_files`
  MODIFY `extra_file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scan_requests`
--
ALTER TABLE `scan_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `scan_types`
--
ALTER TABLE `scan_types`
  MODIFY `scan_cat_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `send_test`
--
ALTER TABLE `send_test`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_url`
--
ALTER TABLE `site_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `surgery_perm`
--
ALTER TABLE `surgery_perm`
  MODIFY `surgery_perm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tariffs`
--
ALTER TABLE `tariffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_presc`
--
ALTER TABLE `temp_presc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `temp_presc1`
--
ALTER TABLE `temp_presc1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_presct`
--
ALTER TABLE `temp_presct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `temp_test`
--
ALTER TABLE `temp_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `therapy_plans`
--
ALTER TABLE `therapy_plans`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `treatments`
--
ALTER TABLE `treatments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `treatment_list`
--
ALTER TABLE `treatment_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `visitors_log`
--
ALTER TABLE `visitors_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wards`
--
ALTER TABLE `wards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `warehouse_stock`
--
ALTER TABLE `warehouse_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT for table `xray`
--
ALTER TABLE `xray`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `xray_requests`
--
ALTER TABLE `xray_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `xray_types`
--
ALTER TABLE `xray_types`
  MODIFY `xray_cat_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
