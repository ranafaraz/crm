-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2020 at 02:03 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dexdevs_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_head`
--

CREATE TABLE `acc_head` (
  `acc_head_id` int(12) NOT NULL,
  `acc_head_acc_nature_id` int(12) NOT NULL,
  `acc_head_caption` varchar(50) NOT NULL,
  `acc_head_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_head`
--

INSERT INTO `acc_head` (`acc_head_id`, `acc_head_acc_nature_id`, `acc_head_caption`, `acc_head_desc`) VALUES
(1, 2, 'Electricity Bill', ''),
(2, 1, 'Student Fee', ''),
(3, 2, 'Monthly Salary', ''),
(4, 1, 'IC (School) - Monthly Subscription', 'School Management System'),
(5, 1, 'IC (College) - Monthly Subscription', ''),
(6, 1, 'IC (School) - Annual Subscription', 'Institute on Cloud - School Version'),
(7, 1, 'IC (College) - Annual Subscription', ''),
(8, 1, 'IC (School) - Lump Sum Package', ''),
(9, 1, 'IC (College) - Lump Sum Package', ''),
(12, 1, 'IC (Madarassa) - Monthlly Subscription', ''),
(13, 1, 'IC (Madarassa) - Annual Subscription', '');

-- --------------------------------------------------------

--
-- Table structure for table `acc_nature`
--

CREATE TABLE `acc_nature` (
  `acc_nature_id` int(12) NOT NULL,
  `acc_nature_name` varchar(20) NOT NULL,
  `acc_nature_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_nature`
--

INSERT INTO `acc_nature` (`acc_nature_id`, `acc_nature_name`, `acc_nature_desc`) VALUES
(1, 'Income', ''),
(2, 'Expense', '');

-- --------------------------------------------------------

--
-- Table structure for table `acc_transaction`
--

CREATE TABLE `acc_transaction` (
  `acc_trans_id` int(12) NOT NULL,
  `acc_trans_branch_id` int(12) NOT NULL,
  `acc_trans_acc_head_id` int(12) NOT NULL,
  `acc_trans_narration` text NOT NULL,
  `acc_trans_amount` int(11) NOT NULL,
  `acc_trans_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_transaction`
--

INSERT INTO `acc_transaction` (`acc_trans_id`, `acc_trans_branch_id`, `acc_trans_acc_head_id`, `acc_trans_narration`, `acc_trans_amount`, `acc_trans_date`) VALUES
(1, 1, 2, 'Web Development Course Fee.\r\nCollected from Mr. Waqas.\r\n\r\nNote: Its Dummy Date.', 15000, '2020-02-01'),
(2, 1, 1, 'Head Office Electricity Bill. Against Meter Number: 1223432432 MEPCO.\r\n\r\nFor the month of February 2', 10000, '2020-02-29');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(12) NOT NULL,
  `branch_org_id` int(12) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `branch_manager` varchar(50) NOT NULL,
  `branch_contact` varchar(20) NOT NULL,
  `branch_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_org_id`, `branch_name`, `branch_manager`, `branch_contact`, `branch_address`) VALUES
(1, 1, 'Dexter\'s Laboratory', 'Anas Shafqat', '03000000000', 'Gulshan.e.Nasir, Rahim Yar Khan');

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `b_id` int(12) NOT NULL,
  `b_branch_id` int(12) NOT NULL,
  `b_b_type_id` int(12) NOT NULL,
  `b_b_status_id` int(12) NOT NULL,
  `b_b_nature_id` int(12) NOT NULL,
  `b_city_id` int(12) NOT NULL,
  `b_referral_id` int(12) DEFAULT NULL,
  `b_name` varchar(100) NOT NULL,
  `b_owner` varchar(100) NOT NULL,
  `b_contact` varchar(50) NOT NULL,
  `b_address` varchar(100) NOT NULL,
  `b_email` varchar(50) NOT NULL,
  `b_ntn` varchar(10) NOT NULL,
  `b_logo` varchar(100) NOT NULL,
  `b_no_of_emp` int(6) NOT NULL,
  `b_since` varchar(10) NOT NULL,
  `b_no_of_branches` int(4) NOT NULL,
  `b_deal_with_referral` varchar(100) DEFAULT NULL,
  `b_comments` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`b_id`, `b_branch_id`, `b_b_type_id`, `b_b_status_id`, `b_b_nature_id`, `b_city_id`, `b_referral_id`, `b_name`, `b_owner`, `b_contact`, `b_address`, `b_email`, `b_ntn`, `b_logo`, `b_no_of_emp`, `b_since`, `b_no_of_branches`, `b_deal_with_referral`, `b_comments`) VALUES
(2, 1, 1, 2, 4, 1, NULL, 'ABC Learning High School, Rahim yar Khan', 'Miss Robina Ghauri', '03300000000', 'XYZ', 'info@abclhs.edu.pk', '88668', 'Logo.jpg', 50, '2000', 2, 'None', 'Platinum Client. Paying 15000 Per Month'),
(3, 1, 1, 2, 4, 1, NULL, 'Eshna Public School, Rahim Yar Khan', 'Mr. X', '2343242343', 'osaaasddadaa ajdoasj aosdoas', 'eshna@email.com', '33432', 'dexdevs (2).png', 30, '1990', 1, 'None', 'Silver Client. Paying 5000 Per Month.'),
(4, 1, 2, 2, 4, 1, NULL, 'Brookfield College', 'Shahzad Qayyum &amp; 3 other partners', '03333333333', 'Canal Road', 'info@brookfield.edu.pk', '88668', 'Untitled1 - Copy.png', 30, '2016', 1, 'None', 'None'),
(5, 1, 1, 1, 4, 1, NULL, 'JTN', 'Majid', '03000000', 'Near nursery ground, trust colony', 'unknow', '00000', 'dexdevs 512x512(1).jpg', 0, '0', 3, 'None', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `business_nature`
--

CREATE TABLE `business_nature` (
  `b_nature_id` int(12) NOT NULL,
  `b_nature_caption` varchar(50) NOT NULL,
  `b_nature_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_nature`
--

INSERT INTO `business_nature` (`b_nature_id`, `b_nature_caption`, `b_nature_desc`) VALUES
(1, 'Manufacturing Company', ''),
(2, 'Merchandising Setup', ''),
(3, 'Service Provider', ''),
(4, 'Educational Institute', '');

-- --------------------------------------------------------

--
-- Table structure for table `business_status`
--

CREATE TABLE `business_status` (
  `business_status_id` int(12) NOT NULL,
  `business_status_caption` varchar(30) NOT NULL COMMENT 'Audience or Client'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_status`
--

INSERT INTO `business_status` (`business_status_id`, `business_status_caption`) VALUES
(1, 'Targeted Audience'),
(2, 'Client');

-- --------------------------------------------------------

--
-- Table structure for table `business_type`
--

CREATE TABLE `business_type` (
  `business_type_id` int(12) NOT NULL,
  `business_type_name` varchar(30) NOT NULL,
  `business_type_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_type`
--

INSERT INTO `business_type` (`business_type_id`, `business_type_name`, `business_type_desc`) VALUES
(1, 'School', ''),
(2, 'College', '');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(12) NOT NULL,
  `city_tehsil_id` int(12) NOT NULL,
  `city_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_tehsil_id`, `city_name`) VALUES
(1, 1, 'Rahim Yar Khan');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(12) NOT NULL,
  `country_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'Pakistan'),
(2, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `cus_support`
--

CREATE TABLE `cus_support` (
  `cus_sup_id` int(12) NOT NULL,
  `cus_sup_branch_id` int(12) NOT NULL,
  `cus_sup_emp_id` int(12) NOT NULL COMMENT 'cus_sup_',
  `cus_sup_query` text NOT NULL,
  `cus_sup_screen_shots` text NOT NULL,
  `cus_sup_date` datetime NOT NULL,
  `cus_sup_status` enum('Pending','In Progress','Accomplished','Cannot be Entertained') NOT NULL,
  `cus_sup_comments` text NOT NULL,
  `cus_sup_resolved_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(12) NOT NULL,
  `designation_caption` varchar(50) NOT NULL,
  `designation_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_caption`, `designation_desc`) VALUES
(1, 'CEO', ''),
(2, 'Branch Manager', ''),
(3, 'Project Manager', ''),
(4, 'Marketing Manager', ''),
(5, 'Personal Assistant', ''),
(6, 'Software Engineer', ''),
(7, 'Web Master', ''),
(8, 'Marketer', ''),
(9, 'Sales Manager', ''),
(10, 'Sales Officer', ''),
(11, 'Customer Care Representative', ''),
(12, 'Legal Adviser', ''),
(13, 'WordPress Developer', ''),
(14, 'Internee', ''),
(15, 'Graphic Designer', '');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` int(12) NOT NULL,
  `district_division_id` int(12) NOT NULL,
  `district_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `district_division_id`, `district_name`) VALUES
(1, 1, 'Rahim Yar Khan');

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `division_id` int(12) NOT NULL,
  `division_state_id` int(12) NOT NULL,
  `division_name` varchar(50) NOT NULL,
  `division_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`division_id`, `division_state_id`, `division_name`, `division_desc`) VALUES
(1, 1, 'Bahawalpur', '');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(12) NOT NULL,
  `emp_branch_id` int(12) NOT NULL,
  `emp_designation_id` int(12) NOT NULL,
  `emp_city_id` int(12) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_father` varchar(50) NOT NULL,
  `emp_cnic` varchar(16) NOT NULL,
  `emp_address` varchar(100) NOT NULL,
  `emp_contact` varchar(20) NOT NULL,
  `emp_email` varchar(50) NOT NULL,
  `emp_photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_branch_id`, `emp_designation_id`, `emp_city_id`, `emp_name`, `emp_father`, `emp_cnic`, `emp_address`, `emp_contact`, `emp_email`, `emp_photo`) VALUES
(1, 1, 1, 1, 'Rana Faraz Ahmed', 'Rana Naveed Ahmed', '333333333333', 'House # 8, Block E, Gulshan.e.Nasir', '03006999824', 'admin@ranafaraz.com', 'dp.png'),
(2, 1, 2, 1, 'Anas Shafqat', 'M. Shafqat', '3333333333333', 'Gulshan.e.Iqbal', '0333333333', 'manager@dexdevs.com', ''),
(3, 1, 4, 1, 'Muzamil Shah', 'Koi pta nai', '420', 'Jinnah Park', '03210323432', 'mm@dexdevs.com', ''),
(4, 1, 7, 1, 'Waleed Bin Naeem', 'M. Naeem', '3248232343234', 'Koo Kaaf', '03333333333', 'webmaster@dexdevs.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `followup`
--

CREATE TABLE `followup` (
  `followup_id` int(12) NOT NULL,
  `followup_branch_id` int(12) NOT NULL,
  `followup_business_id` int(12) NOT NULL,
  `followup_by_emp_id` int(12) NOT NULL COMMENT 'follow up by whom?',
  `followup_no_id` int(12) NOT NULL,
  `followup_date` datetime NOT NULL,
  `followup_comments` text NOT NULL,
  `followup_response` enum('+ve','-ve','Neutral','Unable to Judge','Failed to Approach') NOT NULL,
  `nxt_FU_date` datetime NOT NULL,
  `nxt_FU_plans` text NOT NULL,
  `current_FU_status` enum('Pending','Completed','In Progress','Client Signed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followup`
--

INSERT INTO `followup` (`followup_id`, `followup_branch_id`, `followup_business_id`, `followup_by_emp_id`, `followup_no_id`, `followup_date`, `followup_comments`, `followup_response`, `nxt_FU_date`, `nxt_FU_plans`, `current_FU_status`) VALUES
(1, 1, 2, 2, 1, '2020-02-01 00:00:00', '<p>asdns oasd oasjdo isjf sdjf0aj fj0ej f0wej f0wejf0 f0 jef e0 f0 nf024 nf0 43nf0 430fn</p>', '+ve', '2020-02-21 00:00:00', '<p>assndj donn fownf owen fowen fen wf823nf 082nf n2 f nf24 fn 43 8f9 43f04fn 083n f93n f9 n34f qfn3 nff</p>', 'Client Signed'),
(2, 1, 5, 2, 2, '2020-02-13 00:00:00', '<p>I, Anas, visited the school today. Principal was not available. </p>\r\n\r\n<p>I met coordinator. And droped the IC Package.</p>\r\n\r\n<p>Will visit school again to meet the principal.</p>', 'Neutral', '2020-02-15 11:00:00', '<p>Will meet the principal. </p>\r\n\r\n<p>Will encourage him to use our system - IC.</p>', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `followup_no`
--

CREATE TABLE `followup_no` (
  `followup_no_id` int(12) NOT NULL,
  `followup_no_caption` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followup_no`
--

INSERT INTO `followup_no` (`followup_no_id`, `followup_no_caption`) VALUES
(1, '1st'),
(2, '2nd'),
(3, '3rd'),
(4, '4th'),
(5, '5th'),
(6, '6th'),
(7, '7th'),
(8, '8th'),
(9, '9th'),
(10, '10th'),
(11, '11th'),
(12, '12th'),
(13, '13th'),
(14, '14th'),
(15, '15th'),
(16, '16th'),
(17, '17th'),
(18, '18th'),
(19, '19th'),
(20, '20th');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(12) NOT NULL,
  `invoice_branch_id` int(12) NOT NULL,
  `invoice_business_id` int(12) NOT NULL,
  `invoice_service_id` int(12) NOT NULL,
  `invoice_amount` int(12) NOT NULL,
  `invoice_issue_date` date NOT NULL,
  `invoice_due_date` date NOT NULL,
  `invoice_status` enum('Unpaid','Partially Paid','Paid') NOT NULL,
  `invoice_collected_amount` int(12) NOT NULL,
  `invoice_remaining_amount` int(12) NOT NULL,
  `invoice_collection_date` date NOT NULL,
  `invoice_content` varchar(1000) NOT NULL,
  `invoice_comments` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `invoice_branch_id`, `invoice_business_id`, `invoice_service_id`, `invoice_amount`, `invoice_issue_date`, `invoice_due_date`, `invoice_status`, `invoice_collected_amount`, `invoice_remaining_amount`, `invoice_collection_date`, `invoice_content`, `invoice_comments`) VALUES
(1, 1, 2, 1, 15000, '2020-02-01', '2020-02-10', 'Paid', 15000, 0, '2020-02-05', '<p>Monthly Subscription for IC</p>', '<p>khbfsdsbf wffkbibfl</p>'),
(2, 1, 3, 1, 15000, '2020-02-01', '2020-02-10', 'Unpaid', 0, 15000, '2020-02-15', '<p>Monthly Subscription for IC = 5000</p>\r\n\r\n<p>SMS Package (Non-Branded) = 1000</p>', '<p>0.20 Per SMS</p>');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `org_id` int(12) NOT NULL,
  `org_city_id` int(12) NOT NULL,
  `org_name` varchar(100) NOT NULL,
  `org_head_office` varchar(100) NOT NULL,
  `org_owner` varchar(50) NOT NULL,
  `org_contact_no` varchar(20) NOT NULL,
  `org_logo` varchar(200) NOT NULL,
  `org_bank_acc` varchar(20) NOT NULL,
  `org_ntn` varchar(20) NOT NULL,
  `org_email` varchar(30) NOT NULL,
  `org_website` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`org_id`, `org_city_id`, `org_name`, `org_head_office`, `org_owner`, `org_contact_no`, `org_logo`, `org_bank_acc`, `org_ntn`, `org_email`, `org_website`) VALUES
(1, 1, 'Dexterous Developers', 'Gulshan.e.Nasir, Rahim Yar Khan', 'Rana Faraz Ahmed', '03006999824', 'dexdevs 512x512.jpg', '302470237894', '394732', 'info@dexdevs.com', 'https://wwww.dexdevs.com');

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `quote_id` int(12) NOT NULL,
  `quote_branch_id` int(12) NOT NULL,
  `quote_business_id` int(12) NOT NULL,
  `quote_service_id` int(12) NOT NULL,
  `quote_issue_date` date NOT NULL,
  `quote_due_date` date NOT NULL,
  `quote_amount` int(12) NOT NULL,
  `quote_content` text NOT NULL,
  `quote_comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reference_letter`
--

CREATE TABLE `reference_letter` (
  `ref_letter_id` int(12) NOT NULL,
  `ref_letter_branch_id` int(12) NOT NULL,
  `ref_letter_to_whom` varchar(50) NOT NULL COMMENT 'receiver',
  `ref_letter_by_whom` varchar(50) NOT NULL COMMENT 'sender',
  `ref_letter_content` text NOT NULL,
  `ref_letter_scanned` varchar(100) NOT NULL,
  `ref_letter_date` date NOT NULL,
  `ref_letter_comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `referral_id` int(12) NOT NULL,
  `referral_branch_id` int(12) NOT NULL,
  `referral_name` varchar(50) NOT NULL,
  `referral_desc` varchar(200) NOT NULL,
  `referral_deal_signed` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referral`
--

INSERT INTO `referral` (`referral_id`, `referral_branch_id`, `referral_name`, `referral_desc`, `referral_deal_signed`) VALUES
(1, 1, 'Mr. Shahzad Qayyum', 'Principal Brookfield College, Rahim Yar Khan', 'None'),
(2, 1, 'Cpt. Zahid Aslam', 'Prof. Khawaja Fareed College, Rahim Yar Khan', 'None'),
(3, 1, 'Muzamil Shah', 'None', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(12) NOT NULL,
  `service_branch_id` int(12) NOT NULL,
  `service_caption` varchar(100) NOT NULL,
  `service_desc` varchar(500) NOT NULL,
  `service_logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_branch_id`, `service_caption`, `service_desc`, `service_logo`) VALUES
(1, 1, 'Institute on Cloud - School Version', '<p>A web based School Management System</p>', 'ic.png'),
(2, 1, 'Institute on Cloud (College Version)', '<p>College Management System</p>', 'ic(1).png');

-- --------------------------------------------------------

--
-- Table structure for table `services_availed_by_customer`
--

CREATE TABLE `services_availed_by_customer` (
  `sabc_id` int(12) NOT NULL,
  `sabc_branch_id` int(12) NOT NULL,
  `sabc_business_id` int(12) NOT NULL,
  `sabc_service_id` int(12) NOT NULL,
  `sabc_pkg` enum('Monthly','Yearly','Lump sum','Installments') NOT NULL,
  `sabc_amount` int(11) NOT NULL,
  `sabc_desc` varchar(1000) NOT NULL,
  `sabc_signed_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services_availed_by_customer`
--

INSERT INTO `services_availed_by_customer` (`sabc_id`, `sabc_branch_id`, `sabc_business_id`, `sabc_service_id`, `sabc_pkg`, `sabc_amount`, `sabc_desc`, `sabc_signed_on`) VALUES
(1, 1, 2, 1, 'Monthly', 15000, 'XYZ', '2019-08-01'),
(2, 1, 4, 2, 'Lump sum', 6000, '<p>None</p>', '2019-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `sms_api`
--

CREATE TABLE `sms_api` (
  `sms_api_id` int(12) NOT NULL,
  `sms_api_user` varchar(20) NOT NULL,
  `sms_api_pass` varchar(30) NOT NULL,
  `sms_api_url` varchar(100) NOT NULL,
  `sms_api_mask` varchar(10) NOT NULL,
  `sms_api_reg_date` date NOT NULL,
  `sms_api_expiry_date` date NOT NULL,
  `sms_api_total_sms` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_log`
--

CREATE TABLE `sms_log` (
  `sms_log_id` int(12) NOT NULL,
  `sms_log_branch_id` int(12) NOT NULL,
  `sms_log_sms_api_id` int(12) NOT NULL,
  `sms_log_message` varchar(1000) NOT NULL,
  `sms_log_to` text NOT NULL,
  `sms_log_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_package`
--

CREATE TABLE `sms_package` (
  `sms_pkg_id` int(12) NOT NULL,
  `sms_pkg_sms_api_id` int(12) NOT NULL,
  `sms_pkg_branch_id` int(12) NOT NULL,
  `sms_pkg_total_allowed_sms` int(10) NOT NULL,
  `sms_pkg_expiry_date` date NOT NULL,
  `sms_pkg_per_sms_cost` decimal(10,0) NOT NULL,
  `sms_pkg_deal_details` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_template`
--

CREATE TABLE `sms_template` (
  `sms_temp_id` int(12) NOT NULL,
  `sms_temp_branch_id` int(12) NOT NULL,
  `sms_temp_caption` varchar(20) NOT NULL,
  `sms_temp_msg` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_template`
--

INSERT INTO `sms_template` (`sms_temp_id`, `sms_temp_branch_id`, `sms_temp_caption`, `sms_temp_msg`) VALUES
(1, 1, 'IC - Promotion', ' ado ahhdso osshff ofosd fosdi fosdjf osdf sd fhsd fosdo fsd ufsdhufh sddfh ofhwehfpwunf9penfn892nfn29f 29 fbb9 f34 f9439fb 943b f4394 f43 f 34 f43f 34 f9b34 f913f 349fb 349b f`4fb 943bf93bf93bf 939bf');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(12) NOT NULL,
  `state_country_id` int(12) NOT NULL,
  `state_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_country_id`, `state_name`) VALUES
(1, 1, 'Punjab'),
(2, 1, 'Sindh');

-- --------------------------------------------------------

--
-- Table structure for table `tehsil`
--

CREATE TABLE `tehsil` (
  `tehsil_id` int(12) NOT NULL,
  `tehsil_district_id` int(12) NOT NULL,
  `tehsil_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tehsil`
--

INSERT INTO `tehsil` (`tehsil_id`, `tehsil_district_id`, `tehsil_name`) VALUES
(1, 1, 'Rahim Yar Khan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(12) NOT NULL,
  `user_branch_id` int(12) NOT NULL,
  `user_type_id` int(12) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_father` varchar(50) NOT NULL,
  `user_photo` text NOT NULL,
  `user_cnic` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_branch_id`, `user_type_id`, `user_name`, `user_password`, `user_email`, `user_father`, `user_photo`, `user_cnic`) VALUES
(1, 1, NULL, 'rana faraz', '*B06FC856E67532EC7688F0B4F2DA41990726BE86', 'admin@ranafaraz.com', 'Rana Naveed Ahmed', '', '32423423432423'),
(2, 1, NULL, 'dexdevs', 'dexdevs007', 'admin@ranafaraz.com', 'Rana Faraz', '', '1132323232'),
(3, 1, NULL, 'admin', '#?_Ey7Hn35xW/h7S', 'admin@dexdevs.com', 'Rana', 'dp(1).png', '12321321321'),
(4, 1, NULL, 'anas', '*F9BEB39D56DBBD0BFA34FEBAC633BD7279021091', 'admin@ranafaraz.com', 'xyz', '', '1132323232');

-- --------------------------------------------------------

--
-- Table structure for table `userlevelpermissions`
--

CREATE TABLE `userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(191) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlevelpermissions`
--

INSERT INTO `userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}acc_head', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}acc_nature', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}acc_transaction', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}branch', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}business', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}business_nature', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}business_status', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}business_type', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}city', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}country', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}cus_support', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}designation', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}district', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}division', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}employees', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}followup', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}followup_no', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}invoices', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}organization', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}quotation', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}reference_letter', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}referral', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}services', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}services_availed_by_customer', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}sms_api', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}sms_log', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}sms_package', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}sms_template', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}state', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}tehsil', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}user', 0),
(-2, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}user_type', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}acc_head', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}acc_nature', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}acc_transaction', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}branch', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}business', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}business_nature', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}business_status', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}business_type', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}city', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}country', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}cus_support', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}designation', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}district', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}division', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}employees', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}followup', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}followup_no', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}invoices', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}organization', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}quotation', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}reference_letter', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}referral', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}services', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}services_availed_by_customer', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}sms_api', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}sms_log', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}sms_package', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}sms_template', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}state', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}tehsil', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}user', 0),
(0, '{95D902CB-0C6D-412B-B939-09A42C7A8FBF}user_type', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userlevels`
--

CREATE TABLE `userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlevels`
--

INSERT INTO `userlevels` (`userlevelid`, `userlevelname`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(12) NOT NULL,
  `user_type_name` varchar(30) NOT NULL,
  `user_type_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`, `user_type_desc`) VALUES
(1, 'Super Admin', 'Can perform CRUD on Organizations + Branches and everything else.'),
(2, 'Administrator', 'Can Perform CRUD within a significant Branch.'),
(3, 'Data Entry Operator', 'Can Perform CR and Cannot Perform UD.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_head`
--
ALTER TABLE `acc_head`
  ADD PRIMARY KEY (`acc_head_id`),
  ADD KEY `acc_head_acc_nature_id` (`acc_head_acc_nature_id`);

--
-- Indexes for table `acc_nature`
--
ALTER TABLE `acc_nature`
  ADD PRIMARY KEY (`acc_nature_id`);

--
-- Indexes for table `acc_transaction`
--
ALTER TABLE `acc_transaction`
  ADD PRIMARY KEY (`acc_trans_id`),
  ADD KEY `acc_trans_acc_head_id` (`acc_trans_acc_head_id`),
  ADD KEY `acc_trans_branch_id` (`acc_trans_branch_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`),
  ADD KEY `branch_org_id` (`branch_org_id`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `b_branch_id` (`b_branch_id`),
  ADD KEY `b_b_nature_id` (`b_b_nature_id`),
  ADD KEY `b_b_status_id` (`b_b_status_id`),
  ADD KEY `b_b_type_id` (`b_b_type_id`),
  ADD KEY `b_city_id` (`b_city_id`),
  ADD KEY `b_referral_id` (`b_referral_id`);

--
-- Indexes for table `business_nature`
--
ALTER TABLE `business_nature`
  ADD PRIMARY KEY (`b_nature_id`);

--
-- Indexes for table `business_status`
--
ALTER TABLE `business_status`
  ADD PRIMARY KEY (`business_status_id`);

--
-- Indexes for table `business_type`
--
ALTER TABLE `business_type`
  ADD PRIMARY KEY (`business_type_id`),
  ADD KEY `business_type_name` (`business_type_name`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `city_tehsil_id` (`city_tehsil_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `cus_support`
--
ALTER TABLE `cus_support`
  ADD PRIMARY KEY (`cus_sup_id`),
  ADD KEY `cus_sup_branch_id` (`cus_sup_branch_id`),
  ADD KEY `cus_sup_emp_id` (`cus_sup_emp_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`),
  ADD KEY `district_division_id` (`district_division_id`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`division_id`),
  ADD KEY `division_ibfk_1` (`division_state_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `marketer_city` (`emp_city_id`),
  ADD KEY `employees_ibfk_1` (`emp_branch_id`),
  ADD KEY `emp_designation_id` (`emp_designation_id`);

--
-- Indexes for table `followup`
--
ALTER TABLE `followup`
  ADD PRIMARY KEY (`followup_id`),
  ADD KEY `followup_branch_id` (`followup_branch_id`),
  ADD KEY `followup_by_emp_id` (`followup_by_emp_id`),
  ADD KEY `followup_no_id` (`followup_no_id`);

--
-- Indexes for table `followup_no`
--
ALTER TABLE `followup_no`
  ADD PRIMARY KEY (`followup_no_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `invoice_business_id` (`invoice_business_id`),
  ADD KEY `invoice_service_id` (`invoice_service_id`),
  ADD KEY `invoice_branch_id` (`invoice_branch_id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`org_id`),
  ADD KEY `org_city_id` (`org_city_id`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`quote_id`),
  ADD KEY `quote_business_id` (`quote_business_id`),
  ADD KEY `quote_service_id` (`quote_service_id`),
  ADD KEY `quote_branch_id` (`quote_branch_id`);

--
-- Indexes for table `reference_letter`
--
ALTER TABLE `reference_letter`
  ADD PRIMARY KEY (`ref_letter_id`),
  ADD KEY `ref_letter_branch_id` (`ref_letter_branch_id`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`referral_id`),
  ADD KEY `referral_branch_id` (`referral_branch_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `service_branch_id` (`service_branch_id`);

--
-- Indexes for table `services_availed_by_customer`
--
ALTER TABLE `services_availed_by_customer`
  ADD PRIMARY KEY (`sabc_id`),
  ADD KEY `sabc_branch_id` (`sabc_branch_id`),
  ADD KEY `sabc_business_id` (`sabc_business_id`),
  ADD KEY `sabc_service_id` (`sabc_service_id`);

--
-- Indexes for table `sms_api`
--
ALTER TABLE `sms_api`
  ADD PRIMARY KEY (`sms_api_id`);

--
-- Indexes for table `sms_log`
--
ALTER TABLE `sms_log`
  ADD PRIMARY KEY (`sms_log_id`),
  ADD KEY `sms_log_branch_id` (`sms_log_branch_id`),
  ADD KEY `sms_log_sms_api_id` (`sms_log_sms_api_id`);

--
-- Indexes for table `sms_package`
--
ALTER TABLE `sms_package`
  ADD PRIMARY KEY (`sms_pkg_id`),
  ADD KEY `sms_pkg_sms_api_id` (`sms_pkg_sms_api_id`),
  ADD KEY `sms_pkg_branch_id` (`sms_pkg_branch_id`);

--
-- Indexes for table `sms_template`
--
ALTER TABLE `sms_template`
  ADD PRIMARY KEY (`sms_temp_id`),
  ADD KEY `sms_temp_branch_id` (`sms_temp_branch_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`),
  ADD KEY `state_country_id` (`state_country_id`);

--
-- Indexes for table `tehsil`
--
ALTER TABLE `tehsil`
  ADD PRIMARY KEY (`tehsil_id`),
  ADD KEY `tehsil_district_id` (`tehsil_district_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_branch_id` (`user_branch_id`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `userlevelpermissions`
--
ALTER TABLE `userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Indexes for table `userlevels`
--
ALTER TABLE `userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_head`
--
ALTER TABLE `acc_head`
  MODIFY `acc_head_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `acc_nature`
--
ALTER TABLE `acc_nature`
  MODIFY `acc_nature_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `acc_transaction`
--
ALTER TABLE `acc_transaction`
  MODIFY `acc_trans_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `b_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `business_nature`
--
ALTER TABLE `business_nature`
  MODIFY `b_nature_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `business_status`
--
ALTER TABLE `business_status`
  MODIFY `business_status_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `business_type`
--
ALTER TABLE `business_type`
  MODIFY `business_type_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cus_support`
--
ALTER TABLE `cus_support`
  MODIFY `cus_sup_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `district_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `division_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `followup`
--
ALTER TABLE `followup`
  MODIFY `followup_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `followup_no`
--
ALTER TABLE `followup_no`
  MODIFY `followup_no_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `org_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `quote_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reference_letter`
--
ALTER TABLE `reference_letter`
  MODIFY `ref_letter_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `referral_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services_availed_by_customer`
--
ALTER TABLE `services_availed_by_customer`
  MODIFY `sabc_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sms_api`
--
ALTER TABLE `sms_api`
  MODIFY `sms_api_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_log`
--
ALTER TABLE `sms_log`
  MODIFY `sms_log_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_package`
--
ALTER TABLE `sms_package`
  MODIFY `sms_pkg_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_template`
--
ALTER TABLE `sms_template`
  MODIFY `sms_temp_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tehsil`
--
ALTER TABLE `tehsil`
  MODIFY `tehsil_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acc_head`
--
ALTER TABLE `acc_head`
  ADD CONSTRAINT `acc_head_ibfk_1` FOREIGN KEY (`acc_head_acc_nature_id`) REFERENCES `acc_nature` (`acc_nature_id`);

--
-- Constraints for table `acc_transaction`
--
ALTER TABLE `acc_transaction`
  ADD CONSTRAINT `acc_transaction_ibfk_1` FOREIGN KEY (`acc_trans_acc_head_id`) REFERENCES `acc_head` (`acc_head_id`),
  ADD CONSTRAINT `acc_transaction_ibfk_2` FOREIGN KEY (`acc_trans_branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`branch_org_id`) REFERENCES `organization` (`org_id`);

--
-- Constraints for table `business`
--
ALTER TABLE `business`
  ADD CONSTRAINT `business_ibfk_1` FOREIGN KEY (`b_branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `business_ibfk_2` FOREIGN KEY (`b_b_nature_id`) REFERENCES `business_nature` (`b_nature_id`),
  ADD CONSTRAINT `business_ibfk_3` FOREIGN KEY (`b_b_status_id`) REFERENCES `business_status` (`business_status_id`),
  ADD CONSTRAINT `business_ibfk_4` FOREIGN KEY (`b_b_type_id`) REFERENCES `business_type` (`business_type_id`),
  ADD CONSTRAINT `business_ibfk_5` FOREIGN KEY (`b_city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `business_ibfk_6` FOREIGN KEY (`b_referral_id`) REFERENCES `referral` (`referral_id`),
  ADD CONSTRAINT `business_ibfk_7` FOREIGN KEY (`b_referral_id`) REFERENCES `referral` (`referral_id`);

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`city_tehsil_id`) REFERENCES `tehsil` (`tehsil_id`);

--
-- Constraints for table `cus_support`
--
ALTER TABLE `cus_support`
  ADD CONSTRAINT `cus_support_ibfk_1` FOREIGN KEY (`cus_sup_branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `cus_support_ibfk_2` FOREIGN KEY (`cus_sup_emp_id`) REFERENCES `employees` (`emp_id`);

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `district_ibfk_1` FOREIGN KEY (`district_division_id`) REFERENCES `division` (`division_id`);

--
-- Constraints for table `division`
--
ALTER TABLE `division`
  ADD CONSTRAINT `division_ibfk_1` FOREIGN KEY (`division_state_id`) REFERENCES `state` (`state_id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`emp_branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`emp_city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`emp_designation_id`) REFERENCES `designation` (`designation_id`);

--
-- Constraints for table `followup`
--
ALTER TABLE `followup`
  ADD CONSTRAINT `followup_ibfk_1` FOREIGN KEY (`followup_branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `followup_ibfk_2` FOREIGN KEY (`followup_by_emp_id`) REFERENCES `employees` (`emp_id`),
  ADD CONSTRAINT `followup_ibfk_3` FOREIGN KEY (`followup_no_id`) REFERENCES `followup_no` (`followup_no_id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`invoice_business_id`) REFERENCES `business` (`b_id`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`invoice_service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `invoices_ibfk_3` FOREIGN KEY (`invoice_branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `organization`
--
ALTER TABLE `organization`
  ADD CONSTRAINT `organization_ibfk_1` FOREIGN KEY (`org_city_id`) REFERENCES `city` (`city_id`);

--
-- Constraints for table `quotation`
--
ALTER TABLE `quotation`
  ADD CONSTRAINT `quotation_ibfk_1` FOREIGN KEY (`quote_business_id`) REFERENCES `business` (`b_id`),
  ADD CONSTRAINT `quotation_ibfk_2` FOREIGN KEY (`quote_service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `quotation_ibfk_3` FOREIGN KEY (`quote_branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `reference_letter`
--
ALTER TABLE `reference_letter`
  ADD CONSTRAINT `reference_letter_ibfk_1` FOREIGN KEY (`ref_letter_branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `referral`
--
ALTER TABLE `referral`
  ADD CONSTRAINT `referral_ibfk_1` FOREIGN KEY (`referral_branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`service_branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `services_availed_by_customer`
--
ALTER TABLE `services_availed_by_customer`
  ADD CONSTRAINT `services_availed_by_customer_ibfk_1` FOREIGN KEY (`sabc_branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `services_availed_by_customer_ibfk_2` FOREIGN KEY (`sabc_business_id`) REFERENCES `business` (`b_id`),
  ADD CONSTRAINT `services_availed_by_customer_ibfk_3` FOREIGN KEY (`sabc_service_id`) REFERENCES `services` (`service_id`);

--
-- Constraints for table `sms_log`
--
ALTER TABLE `sms_log`
  ADD CONSTRAINT `sms_log_ibfk_1` FOREIGN KEY (`sms_log_branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `sms_log_ibfk_2` FOREIGN KEY (`sms_log_sms_api_id`) REFERENCES `sms_api` (`sms_api_id`);

--
-- Constraints for table `sms_package`
--
ALTER TABLE `sms_package`
  ADD CONSTRAINT `sms_package_ibfk_1` FOREIGN KEY (`sms_pkg_branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `sms_package_ibfk_2` FOREIGN KEY (`sms_pkg_sms_api_id`) REFERENCES `sms_api` (`sms_api_id`);

--
-- Constraints for table `sms_template`
--
ALTER TABLE `sms_template`
  ADD CONSTRAINT `sms_template_ibfk_1` FOREIGN KEY (`sms_temp_branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `state_ibfk_1` FOREIGN KEY (`state_country_id`) REFERENCES `country` (`country_id`);

--
-- Constraints for table `tehsil`
--
ALTER TABLE `tehsil`
  ADD CONSTRAINT `tehsil_ibfk_1` FOREIGN KEY (`tehsil_district_id`) REFERENCES `district` (`district_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
