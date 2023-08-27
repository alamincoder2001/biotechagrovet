-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2022 at 12:37 AM
-- Server version: 10.3.36-MariaDB-log-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dewbxcak_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `Acc_SlNo` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `Acc_Code` varchar(50) NOT NULL,
  `Acc_Tr_Type` varchar(25) DEFAULT NULL,
  `Acc_Name` varchar(200) NOT NULL,
  `Acc_Type` varchar(50) NOT NULL,
  `Acc_Description` varchar(255) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assets`
--

CREATE TABLE `tbl_assets` (
  `as_id` int(11) NOT NULL,
  `as_date` date DEFAULT NULL,
  `as_name` varchar(50) DEFAULT NULL,
  `as_sp_name` varchar(100) DEFAULT NULL,
  `as_qty` int(11) DEFAULT NULL,
  `as_rate` decimal(10,2) DEFAULT NULL,
  `as_amount` decimal(10,2) DEFAULT NULL,
  `buy_or_sale` enum('buy','sale') NOT NULL DEFAULT 'buy',
  `valuation` decimal(20,2) DEFAULT 0.00,
  `unit_valuation` decimal(20,2) DEFAULT 0.00,
  `as_note` text DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `branchid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank_accounts`
--

CREATE TABLE `tbl_bank_accounts` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(250) NOT NULL,
  `account_number` varchar(250) NOT NULL,
  `account_type` varchar(200) NOT NULL,
  `bank_name` varchar(250) NOT NULL,
  `branch_name` varchar(250) DEFAULT NULL,
  `initial_balance` float NOT NULL,
  `description` varchar(2000) NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_datetime` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank_transactions`
--

CREATE TABLE `tbl_bank_transactions` (
  `transaction_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_type` varchar(10) NOT NULL,
  `amount` float NOT NULL,
  `note` varchar(500) DEFAULT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_datetime` datetime NOT NULL,
  `branch_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_SiNo` int(11) NOT NULL,
  `ProductCategory_SlNo` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `status` char(2) NOT NULL,
  `brand_branchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brunch`
--

CREATE TABLE `tbl_brunch` (
  `brunch_id` int(11) NOT NULL,
  `Brunch_name` varchar(250) NOT NULL,
  `Brunch_title` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `Brunch_address` text CHARACTER SET utf8mb4 NOT NULL,
  `Brunch_sales` varchar(1) NOT NULL COMMENT 'Wholesales = 1, Retail = 2',
  `add_date` date NOT NULL,
  `add_time` datetime NOT NULL,
  `add_by` char(50) NOT NULL,
  `update_by` char(50) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `is_production` varchar(10) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brunch`
--

INSERT INTO `tbl_brunch` (`brunch_id`, `Brunch_name`, `Brunch_title`, `Brunch_address`, `Brunch_sales`, `add_date`, `add_time`, `add_by`, `update_by`, `status`, `is_production`) VALUES
(1, 'Main Branch', 'Main Branch', 'Branch address here', '', '2022-10-18', '2022-10-18 10:47:56', '', 'Admin', 'a', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cashtransaction`
--

CREATE TABLE `tbl_cashtransaction` (
  `Tr_SlNo` int(11) NOT NULL,
  `Tr_Id` varchar(50) NOT NULL,
  `Tr_date` date NOT NULL,
  `Tr_Type` varchar(20) NOT NULL,
  `Tr_account_Type` varchar(50) NOT NULL,
  `Acc_SlID` int(11) NOT NULL,
  `Tr_Description` varchar(255) NOT NULL,
  `In_Amount` decimal(18,2) NOT NULL,
  `Out_Amount` decimal(18,2) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  `AddBy` varchar(100) NOT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `Tr_branchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checks`
--

CREATE TABLE `tbl_checks` (
  `id` int(20) UNSIGNED NOT NULL,
  `cus_id` int(20) DEFAULT NULL,
  `SM_id` int(20) UNSIGNED DEFAULT NULL,
  `bank_name` varchar(250) DEFAULT NULL,
  `branch_name` varchar(250) DEFAULT NULL,
  `check_no` varchar(250) DEFAULT NULL,
  `check_amount` decimal(18,2) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `check_date` timestamp NULL DEFAULT NULL,
  `remid_date` timestamp NULL DEFAULT NULL,
  `sub_date` timestamp NULL DEFAULT NULL,
  `note` varchar(250) DEFAULT NULL,
  `check_status` char(5) DEFAULT 'Pe' COMMENT 'Pe =Pending, Pa = Paid',
  `status` char(5) NOT NULL DEFAULT 'a',
  `created_by` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `branch_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_color`
--

CREATE TABLE `tbl_color` (
  `color_SiNo` int(11) NOT NULL,
  `color_name` varchar(100) NOT NULL,
  `status` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `Company_SlNo` int(11) NOT NULL,
  `Company_Name` varchar(150) NOT NULL,
  `Repot_Heading` text NOT NULL,
  `Company_Logo_org` varchar(250) NOT NULL,
  `Company_Logo_thum` varchar(250) NOT NULL,
  `Invoice_Type` int(11) NOT NULL,
  `Currency_Name` varchar(50) DEFAULT NULL,
  `Currency_Symbol` varchar(10) DEFAULT NULL,
  `SubCurrency_Name` varchar(50) DEFAULT NULL,
  `print_type` int(11) NOT NULL,
  `company_BrunchId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`Company_SlNo`, `Company_Name`, `Repot_Heading`, `Company_Logo_org`, `Company_Logo_thum`, `Invoice_Type`, `Currency_Name`, `Currency_Symbol`, `SubCurrency_Name`, `print_type`, `company_BrunchId`) VALUES
(1, 'Link-Up Technology Ltd.', 'Address and phone number here', 'erp1.jpeg', 'erp1.jpeg', 1, 'BDT', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE `tbl_country` (
  `Country_SlNo` int(11) NOT NULL,
  `CountryName` varchar(50) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_currentinventory`
--

CREATE TABLE `tbl_currentinventory` (
  `inventory_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_quantity` float NOT NULL,
  `purchase_return_quantity` float NOT NULL,
  `production_quantity` float NOT NULL,
  `sales_quantity` float NOT NULL,
  `sales_return_quantity` float NOT NULL,
  `damage_quantity` float NOT NULL,
  `transfer_from_quantity` float NOT NULL,
  `transfer_to_quantity` float NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_currentinventory`
--

INSERT INTO `tbl_currentinventory` (`inventory_id`, `product_id`, `purchase_quantity`, `purchase_return_quantity`, `production_quantity`, `sales_quantity`, `sales_return_quantity`, `damage_quantity`, `transfer_from_quantity`, `transfer_to_quantity`, `branch_id`) VALUES
(1, 1, 20, 0, 0, 2, 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `Customer_SlNo` int(11) NOT NULL,
  `Customer_Code` varchar(50) NOT NULL,
  `Customer_Name` varchar(150) NOT NULL,
  `Customer_Type` varchar(50) NOT NULL,
  `Customer_Phone` varchar(50) NOT NULL,
  `Customer_Mobile` varchar(15) NOT NULL,
  `Customer_Email` varchar(50) NOT NULL,
  `Customer_OfficePhone` varchar(50) NOT NULL,
  `Customer_Address` varchar(300) NOT NULL,
  `owner_name` varchar(250) DEFAULT NULL,
  `Country_SlNo` int(11) NOT NULL,
  `area_ID` int(11) NOT NULL,
  `Customer_Web` varchar(50) NOT NULL,
  `Customer_Credit_Limit` decimal(18,2) NOT NULL,
  `previous_due` decimal(18,2) NOT NULL,
  `image_name` varchar(1000) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `Customer_brunchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`Customer_SlNo`, `Customer_Code`, `Customer_Name`, `Customer_Type`, `Customer_Phone`, `Customer_Mobile`, `Customer_Email`, `Customer_OfficePhone`, `Customer_Address`, `owner_name`, `Country_SlNo`, `area_ID`, `Customer_Web`, `Customer_Credit_Limit`, `previous_due`, `image_name`, `status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `Customer_brunchid`) VALUES
(1, 'C00001', 'rayhan telecom', 'wholesale', '', '01707525292', '', '', 'katiadi', 'rayhan', 0, 1, '', '5000.00', '900.00', NULL, 'a', 'Admin', '2022-10-20 20:43:20', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_payment`
--

CREATE TABLE `tbl_customer_payment` (
  `CPayment_id` int(11) NOT NULL,
  `CPayment_date` date DEFAULT NULL,
  `CPayment_invoice` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `CPayment_customerID` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `CPayment_TransactionType` varchar(20) DEFAULT NULL,
  `CPayment_amount` decimal(18,2) DEFAULT NULL,
  `out_amount` float NOT NULL DEFAULT 0,
  `CPayment_Paymentby` varchar(50) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `CPayment_notes` varchar(225) CHARACTER SET latin1 DEFAULT NULL,
  `CPayment_brunchid` int(11) DEFAULT NULL,
  `CPayment_previous_due` float NOT NULL DEFAULT 0,
  `CPayment_Addby` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `CPayment_AddDAte` date DEFAULT NULL,
  `CPayment_status` varchar(1) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `CPayment_UpdateDAte` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_damage`
--

CREATE TABLE `tbl_damage` (
  `Damage_SlNo` int(11) NOT NULL,
  `Damage_InvoiceNo` varchar(50) NOT NULL,
  `Damage_Date` date NOT NULL,
  `Damage_Description` varchar(300) DEFAULT NULL,
  `status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `Damage_brunchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_damagedetails`
--

CREATE TABLE `tbl_damagedetails` (
  `DamageDetails_SlNo` int(11) NOT NULL,
  `Damage_SlNo` int(11) NOT NULL,
  `Product_SlNo` int(11) NOT NULL,
  `DamageDetails_DamageQuantity` float NOT NULL,
  `damage_rate` float NOT NULL,
  `damage_amount` float NOT NULL,
  `status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `Department_SlNo` int(11) NOT NULL,
  `Department_Name` varchar(50) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designation`
--

CREATE TABLE `tbl_designation` (
  `Designation_SlNo` int(11) NOT NULL,
  `Designation_Name` varchar(50) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `District_SlNo` int(11) NOT NULL,
  `District_Name` varchar(50) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'a',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`District_SlNo`, `District_Name`, `status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`) VALUES
(1, 'katiadi', 'a', 'Admin', '2022-10-20 20:42:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `Employee_SlNo` int(11) NOT NULL,
  `Designation_ID` int(11) NOT NULL,
  `Department_ID` int(11) NOT NULL,
  `Employee_ID` varchar(50) NOT NULL,
  `bio_id` varchar(50) DEFAULT NULL,
  `Employee_Name` varchar(150) NOT NULL,
  `Employee_JoinDate` date NOT NULL,
  `Employee_Gender` varchar(20) NOT NULL,
  `Employee_BirthDate` date NOT NULL,
  `Employee_NID` varchar(50) NOT NULL,
  `Employee_ContactNo` varchar(20) NOT NULL,
  `Employee_Email` varchar(50) NOT NULL,
  `Employee_MaritalStatus` varchar(50) NOT NULL,
  `Employee_FatherName` varchar(150) NOT NULL,
  `Employee_MotherName` varchar(150) NOT NULL,
  `Employee_PrasentAddress` text NOT NULL,
  `Employee_PermanentAddress` text NOT NULL,
  `Employee_Pic_org` varchar(250) NOT NULL,
  `Employee_Pic_thum` varchar(250) NOT NULL,
  `salary_range` int(11) NOT NULL,
  `Employee_Reference` text DEFAULT NULL,
  `status` char(10) NOT NULL DEFAULT 'a',
  `AddBy` varchar(50) NOT NULL,
  `AddTime` varchar(50) NOT NULL,
  `UpdateBy` varchar(50) NOT NULL,
  `UpdateTime` varchar(50) NOT NULL,
  `Employee_brinchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_payment`
--

CREATE TABLE `tbl_employee_payment` (
  `id` int(11) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `month_id` int(11) NOT NULL,
  `total_payment_amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `status` char(2) DEFAULT 'a',
  `saved_by` int(11) NOT NULL,
  `saved_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_payment_details`
--

CREATE TABLE `tbl_employee_payment_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `salary` decimal(20,2) NOT NULL DEFAULT 0.00,
  `benefit` decimal(20,2) NOT NULL DEFAULT 0.00,
  `deduction` decimal(20,2) NOT NULL DEFAULT 0.00,
  `net_payable` decimal(20,2) NOT NULL DEFAULT 0.00,
  `payment` decimal(20,2) NOT NULL DEFAULT 0.00,
  `comment` text DEFAULT NULL,
  `saved_by` int(11) UNSIGNED DEFAULT NULL,
  `saved_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` char(2) NOT NULL DEFAULT 'a',
  `branch_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense_head`
--

CREATE TABLE `tbl_expense_head` (
  `id` int(11) NOT NULL,
  `head_name` varchar(100) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `status` enum('a','d') DEFAULT 'a',
  `saved_by` int(11) DEFAULT NULL,
  `saved_datetime` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_investment_account`
--

CREATE TABLE `tbl_investment_account` (
  `Acc_SlNo` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `Acc_Code` varchar(50) NOT NULL,
  `Acc_Tr_Type` varchar(25) DEFAULT NULL,
  `Acc_Name` varchar(200) NOT NULL,
  `Acc_Type` varchar(50) NOT NULL,
  `Acc_Description` varchar(255) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_investment_transactions`
--

CREATE TABLE `tbl_investment_transactions` (
  `transaction_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_type` varchar(10) NOT NULL,
  `amount` float NOT NULL,
  `note` varchar(500) DEFAULT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_datetime` datetime NOT NULL,
  `branch_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loan_accounts`
--

CREATE TABLE `tbl_loan_accounts` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(500) NOT NULL,
  `account_number` varchar(250) NOT NULL,
  `account_type` varchar(200) NOT NULL,
  `bank_name` varchar(250) NOT NULL,
  `branch_name` varchar(250) DEFAULT NULL,
  `initial_balance` float NOT NULL,
  `description` varchar(2000) NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_datetime` datetime NOT NULL,
  `save_date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loan_transactions`
--

CREATE TABLE `tbl_loan_transactions` (
  `transaction_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_type` varchar(30) NOT NULL,
  `amount` float NOT NULL,
  `note` varchar(500) DEFAULT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_datetime` datetime NOT NULL,
  `branch_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_materialcategory`
--

CREATE TABLE `tbl_materialcategory` (
  `ProductCategory_SlNo` int(11) NOT NULL,
  `ProductCategory_Name` varchar(150) NOT NULL,
  `ProductCategory_Description` varchar(300) NOT NULL,
  `status` char(1) NOT NULL,
  `AddBy` varchar(50) NOT NULL,
  `AddTime` varchar(30) NOT NULL,
  `UpdateBy` varchar(50) NOT NULL,
  `UpdateTime` varchar(30) NOT NULL,
  `category_branchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_materials`
--

CREATE TABLE `tbl_materials` (
  `material_id` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `reorder_level` float NOT NULL,
  `purchase_rate` float NOT NULL,
  `unit_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material_damage`
--

CREATE TABLE `tbl_material_damage` (
  `damage_id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `damage_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'a',
  `added_by` int(11) NOT NULL,
  `added_datetime` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material_damage_details`
--

CREATE TABLE `tbl_material_damage_details` (
  `damage_details_id` int(11) NOT NULL,
  `damage_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `damage_quantity` float NOT NULL,
  `damage_rate` float NOT NULL DEFAULT 0,
  `damage_amount` float NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'a',
  `branch_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material_purchase`
--

CREATE TABLE `tbl_material_purchase` (
  `purchase_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `invoice_no` varchar(100) DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `purchase_for` int(11) NOT NULL,
  `sub_total` float DEFAULT NULL,
  `vat` float DEFAULT NULL,
  `transport_cost` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `paid` float DEFAULT NULL,
  `due` float DEFAULT NULL,
  `previous_due` float NOT NULL,
  `note` varchar(2000) NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL DEFAULT 'a',
  `branch_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material_purchase_details`
--

CREATE TABLE `tbl_material_purchase_details` (
  `purchase_detail_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `purchase_rate` float NOT NULL,
  `quantity` float NOT NULL,
  `total` float NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'a',
  `branch_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_month`
--

CREATE TABLE `tbl_month` (
  `month_id` int(11) NOT NULL,
  `month_name` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `Product_SlNo` int(11) NOT NULL,
  `Product_Code` varchar(50) NOT NULL,
  `Product_Name` varchar(150) NOT NULL,
  `ProductCategory_ID` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `size` varchar(11) NOT NULL DEFAULT 'na',
  `vat` float NOT NULL,
  `Product_ReOrederLevel` int(11) NOT NULL,
  `Product_Purchase_Rate` decimal(18,2) NOT NULL,
  `Product_SellingPrice` decimal(18,2) NOT NULL,
  `Product_MinimumSellingPrice` decimal(18,2) NOT NULL,
  `Product_WholesaleRate` decimal(18,2) NOT NULL,
  `one_cartun_equal` varchar(20) NOT NULL,
  `is_service` varchar(10) NOT NULL DEFAULT 'false',
  `Unit_ID` int(11) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  `AddBy` varchar(100) NOT NULL,
  `AddTime` varchar(30) NOT NULL,
  `UpdateBy` varchar(50) NOT NULL,
  `UpdateTime` varchar(30) NOT NULL,
  `Product_branchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`Product_SlNo`, `Product_Code`, `Product_Name`, `ProductCategory_ID`, `color`, `brand`, `size`, `vat`, `Product_ReOrederLevel`, `Product_Purchase_Rate`, `Product_SellingPrice`, `Product_MinimumSellingPrice`, `Product_WholesaleRate`, `one_cartun_equal`, `is_service`, `Unit_ID`, `status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `Product_branchid`) VALUES
(1, 'P00001', 'A10S LCD', 1, 0, 0, 'na', 0, 2, '1250.00', '1450.00', '0.00', '1400.00', '', 'false', 1, 'a', 'Admin', '2022-10-20 20:45:01', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productcategory`
--

CREATE TABLE `tbl_productcategory` (
  `ProductCategory_SlNo` int(11) NOT NULL,
  `ProductCategory_Name` varchar(150) NOT NULL,
  `ProductCategory_Description` varchar(300) NOT NULL,
  `status` char(1) NOT NULL,
  `AddBy` varchar(50) NOT NULL,
  `AddTime` varchar(30) NOT NULL,
  `UpdateBy` varchar(50) NOT NULL,
  `UpdateTime` varchar(30) NOT NULL,
  `category_branchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_productcategory`
--

INSERT INTO `tbl_productcategory` (`ProductCategory_SlNo`, `ProductCategory_Name`, `ProductCategory_Description`, `status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `category_branchid`) VALUES
(1, 'LCD', '', 'a', 'Admin', '2022-10-20 20:44:09', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productions`
--

CREATE TABLE `tbl_productions` (
  `production_id` int(11) NOT NULL,
  `production_sl` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `incharge_id` int(11) DEFAULT NULL,
  `shift` varchar(250) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `labour_cost` float NOT NULL,
  `material_cost` float NOT NULL,
  `other_cost` float NOT NULL,
  `total_cost` float NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'a',
  `branch_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_production_details`
--

CREATE TABLE `tbl_production_details` (
  `production_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `purchase_rate` float NOT NULL,
  `total` decimal(18,2) NOT NULL DEFAULT 0.00,
  `status` varchar(10) NOT NULL DEFAULT 'a',
  `branch_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_production_products`
--

CREATE TABLE `tbl_production_products` (
  `production_products_id` int(11) NOT NULL,
  `production_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `total` decimal(18,2) NOT NULL DEFAULT 0.00,
  `status` varchar(10) NOT NULL DEFAULT 'a',
  `branch_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchasedetails`
--

CREATE TABLE `tbl_purchasedetails` (
  `PurchaseDetails_SlNo` int(11) NOT NULL,
  `PurchaseMaster_IDNo` int(11) NOT NULL,
  `Product_IDNo` int(11) NOT NULL,
  `PurchaseDetails_TotalQuantity` float NOT NULL,
  `PurchaseDetails_Rate` decimal(18,2) NOT NULL,
  `purchase_cost` decimal(18,2) NOT NULL,
  `PurchaseDetails_Discount` decimal(18,2) NOT NULL,
  `PurchaseDetails_TotalAmount` decimal(18,2) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `PurchaseDetails_branchID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_purchasedetails`
--

INSERT INTO `tbl_purchasedetails` (`PurchaseDetails_SlNo`, `PurchaseMaster_IDNo`, `Product_IDNo`, `PurchaseDetails_TotalQuantity`, `PurchaseDetails_Rate`, `purchase_cost`, `PurchaseDetails_Discount`, `PurchaseDetails_TotalAmount`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `PurchaseDetails_branchID`) VALUES
(1, 1, 1, 20, '1250.00', '0.00', '0.00', '25000.00', 'a', 'Admin', '2022-10-20 20:45:41', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchasemaster`
--

CREATE TABLE `tbl_purchasemaster` (
  `PurchaseMaster_SlNo` int(11) NOT NULL,
  `Supplier_SlNo` int(11) NOT NULL,
  `Employee_SlNo` int(11) NOT NULL,
  `PurchaseMaster_InvoiceNo` varchar(50) NOT NULL,
  `PurchaseMaster_OrderDate` date NOT NULL,
  `PurchaseMaster_PurchaseFor` varchar(50) NOT NULL,
  `PurchaseMaster_Description` longtext NOT NULL,
  `PurchaseMaster_TotalAmount` decimal(18,2) NOT NULL,
  `PurchaseMaster_DiscountAmount` decimal(18,2) NOT NULL,
  `PurchaseMaster_Tax` decimal(18,2) NOT NULL,
  `PurchaseMaster_Freight` decimal(18,2) NOT NULL,
  `PurchaseMaster_SubTotalAmount` decimal(18,2) NOT NULL,
  `PurchaseMaster_PaidAmount` decimal(18,2) NOT NULL,
  `PurchaseMaster_DueAmount` decimal(18,2) NOT NULL,
  `previous_due` float DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `PurchaseMaster_BranchID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_purchasemaster`
--

INSERT INTO `tbl_purchasemaster` (`PurchaseMaster_SlNo`, `Supplier_SlNo`, `Employee_SlNo`, `PurchaseMaster_InvoiceNo`, `PurchaseMaster_OrderDate`, `PurchaseMaster_PurchaseFor`, `PurchaseMaster_Description`, `PurchaseMaster_TotalAmount`, `PurchaseMaster_DiscountAmount`, `PurchaseMaster_Tax`, `PurchaseMaster_Freight`, `PurchaseMaster_SubTotalAmount`, `PurchaseMaster_PaidAmount`, `PurchaseMaster_DueAmount`, `previous_due`, `status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `PurchaseMaster_BranchID`) VALUES
(1, 1, 0, '2022000001', '2022-10-20', '1', '', '25000.00', '0.00', '0.00', '0.00', '25000.00', '25000.00', '0.00', 0, 'a', 'Admin', '2022-10-20 20:45:41', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchasereturn`
--

CREATE TABLE `tbl_purchasereturn` (
  `PurchaseReturn_SlNo` int(11) NOT NULL,
  `PurchaseMaster_InvoiceNo` varchar(50) NOT NULL,
  `Supplier_IDdNo` int(11) NOT NULL,
  `PurchaseReturn_ReturnDate` date NOT NULL,
  `PurchaseReturn_ReturnAmount` decimal(18,2) NOT NULL,
  `PurchaseReturn_Description` varchar(300) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `PurchaseReturn_brunchID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchasereturndetails`
--

CREATE TABLE `tbl_purchasereturndetails` (
  `PurchaseReturnDetails_SlNo` int(11) NOT NULL,
  `PurchaseReturn_SlNo` int(11) NOT NULL,
  `PurchaseReturnDetailsProduct_SlNo` int(11) NOT NULL,
  `PurchaseReturnDetails_ReturnQuantity` float NOT NULL,
  `PurchaseReturnDetails_ReturnAmount` decimal(18,2) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `PurchaseReturnDetails_brachid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotaion_customer`
--

CREATE TABLE `tbl_quotaion_customer` (
  `quotation_customer_id` int(11) NOT NULL,
  `customer_name` char(50) NOT NULL,
  `contact_number` varchar(35) NOT NULL,
  `customer_address` text NOT NULL,
  `quation_customer_branchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_details`
--

CREATE TABLE `tbl_quotation_details` (
  `SaleDetails_SlNo` int(11) NOT NULL,
  `SaleMaster_IDNo` int(11) NOT NULL,
  `Product_IDNo` int(11) NOT NULL,
  `SaleDetails_TotalQuantity` float NOT NULL,
  `SaleDetails_Rate` decimal(18,2) NOT NULL,
  `SaleDetails_Discount` decimal(18,2) NOT NULL,
  `SaleDetails_Tax` decimal(18,2) NOT NULL,
  `SaleDetails_Freight` decimal(18,2) NOT NULL,
  `SaleDetails_TotalAmount` decimal(18,2) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `SaleDetails_BranchId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_master`
--

CREATE TABLE `tbl_quotation_master` (
  `SaleMaster_SlNo` int(11) NOT NULL,
  `SaleMaster_InvoiceNo` varchar(50) NOT NULL,
  `SaleMaster_customer_name` varchar(500) NOT NULL,
  `SaleMaster_customer_mobile` varchar(50) NOT NULL,
  `SaleMaster_customer_address` varchar(1000) NOT NULL,
  `SaleMaster_SaleDate` date NOT NULL,
  `SaleMaster_Description` longtext DEFAULT NULL,
  `SaleMaster_TotalSaleAmount` decimal(18,2) NOT NULL,
  `SaleMaster_TotalDiscountAmount` decimal(18,2) NOT NULL,
  `SaleMaster_TaxAmount` decimal(18,2) NOT NULL,
  `SaleMaster_Freight` decimal(18,2) NOT NULL,
  `SaleMaster_SubTotalAmount` decimal(18,2) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT 'a',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `SaleMaster_branchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_saledetails`
--

CREATE TABLE `tbl_saledetails` (
  `SaleDetails_SlNo` int(11) NOT NULL,
  `SaleMaster_IDNo` int(11) NOT NULL,
  `Product_IDNo` int(11) NOT NULL,
  `SaleDetails_TotalQuantity` float NOT NULL,
  `Purchase_Rate` decimal(18,2) DEFAULT NULL,
  `SaleDetails_Rate` decimal(18,2) NOT NULL,
  `SaleDetails_Discount` decimal(18,2) NOT NULL,
  `Discount_amount` decimal(18,2) DEFAULT NULL,
  `SaleDetails_Tax` decimal(18,2) NOT NULL,
  `SaleDetails_TotalAmount` decimal(18,2) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `SaleDetails_BranchId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_saledetails`
--

INSERT INTO `tbl_saledetails` (`SaleDetails_SlNo`, `SaleMaster_IDNo`, `Product_IDNo`, `SaleDetails_TotalQuantity`, `Purchase_Rate`, `SaleDetails_Rate`, `SaleDetails_Discount`, `Discount_amount`, `SaleDetails_Tax`, `SaleDetails_TotalAmount`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `SaleDetails_BranchId`) VALUES
(1, 1, 1, 2, '1250.00', '1400.00', '0.00', NULL, '0.00', '2800.00', 'a', 'Admin', '2022-10-20 20:46:53', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salereturn`
--

CREATE TABLE `tbl_salereturn` (
  `SaleReturn_SlNo` int(11) NOT NULL,
  `SaleMaster_InvoiceNo` varchar(50) NOT NULL,
  `SaleReturn_ReturnDate` date NOT NULL,
  `SaleReturn_ReturnAmount` decimal(18,2) NOT NULL,
  `SaleReturn_Description` varchar(300) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `SaleReturn_brunchId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_salereturn`
--

INSERT INTO `tbl_salereturn` (`SaleReturn_SlNo`, `SaleMaster_InvoiceNo`, `SaleReturn_ReturnDate`, `SaleReturn_ReturnAmount`, `SaleReturn_Description`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `SaleReturn_brunchId`) VALUES
(1, '220100001', '2022-10-20', '1400.00', '', 'a', 'Admin', '2022-10-20 20:48:49', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salereturndetails`
--

CREATE TABLE `tbl_salereturndetails` (
  `SaleReturnDetails_SlNo` int(11) NOT NULL,
  `SaleReturn_IdNo` int(11) NOT NULL,
  `SaleReturnDetailsProduct_SlNo` int(11) NOT NULL,
  `SaleReturnDetails_ReturnQuantity` float NOT NULL,
  `SaleReturnDetails_ReturnAmount` decimal(18,2) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `SaleReturnDetails_brunchID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_salereturndetails`
--

INSERT INTO `tbl_salereturndetails` (`SaleReturnDetails_SlNo`, `SaleReturn_IdNo`, `SaleReturnDetailsProduct_SlNo`, `SaleReturnDetails_ReturnQuantity`, `SaleReturnDetails_ReturnAmount`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `SaleReturnDetails_brunchID`) VALUES
(1, 1, 1, 1, '1400.00', 'a', 'Admin', '2022-10-20 20:48:49', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salesmaster`
--

CREATE TABLE `tbl_salesmaster` (
  `SaleMaster_SlNo` int(11) NOT NULL,
  `SaleMaster_InvoiceNo` varchar(50) NOT NULL,
  `SalseCustomer_IDNo` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `SaleMaster_SaleDate` date NOT NULL,
  `SaleMaster_Description` longtext DEFAULT NULL,
  `SaleMaster_SaleType` varchar(50) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT 'Cash',
  `SaleMaster_TotalSaleAmount` decimal(18,2) NOT NULL,
  `SaleMaster_TotalDiscountAmount` decimal(18,2) NOT NULL,
  `SaleMaster_TaxAmount` decimal(18,2) NOT NULL,
  `SaleMaster_Freight` decimal(18,2) DEFAULT 0.00,
  `SaleMaster_SubTotalAmount` decimal(18,2) NOT NULL,
  `SaleMaster_PaidAmount` decimal(18,2) NOT NULL,
  `SaleMaster_DueAmount` decimal(18,2) NOT NULL,
  `SaleMaster_Previous_Due` double(18,2) DEFAULT NULL,
  `Status` char(1) NOT NULL DEFAULT 'a',
  `is_service` varchar(10) NOT NULL DEFAULT 'false',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `SaleMaster_branchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_salesmaster`
--

INSERT INTO `tbl_salesmaster` (`SaleMaster_SlNo`, `SaleMaster_InvoiceNo`, `SalseCustomer_IDNo`, `employee_id`, `SaleMaster_SaleDate`, `SaleMaster_Description`, `SaleMaster_SaleType`, `payment_type`, `SaleMaster_TotalSaleAmount`, `SaleMaster_TotalDiscountAmount`, `SaleMaster_TaxAmount`, `SaleMaster_Freight`, `SaleMaster_SubTotalAmount`, `SaleMaster_PaidAmount`, `SaleMaster_DueAmount`, `SaleMaster_Previous_Due`, `Status`, `is_service`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `SaleMaster_branchid`) VALUES
(1, '220100001', 1, NULL, '2022-10-20', '', 'wholesale', 'Cash', '2800.00', '0.00', '0.00', '0.00', '2800.00', '1000.00', '1800.00', 900.00, 'a', 'false', 'Admin', '2022-10-20 20:46:53', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shifts`
--

CREATE TABLE `tbl_shifts` (
  `shift_id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shifts`
--

INSERT INTO `tbl_shifts` (`shift_id`, `name`) VALUES
(1, 'Day Shift');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms`
--

CREATE TABLE `tbl_sms` (
  `row_id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `sms_text` varchar(500) NOT NULL,
  `sent_by` int(11) NOT NULL,
  `sent_datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_settings`
--

CREATE TABLE `tbl_sms_settings` (
  `sms_enabled` varchar(50) NOT NULL DEFAULT 'false',
  `api_key` varchar(500) DEFAULT NULL,
  `sms_type` varchar(50) NOT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `bulk_url` varchar(1000) DEFAULT NULL,
  `url_2` varchar(1000) DEFAULT NULL,
  `bulk_url_2` varchar(1000) DEFAULT NULL,
  `sender_id` varchar(200) DEFAULT NULL,
  `sender_id_2` varchar(200) DEFAULT NULL,
  `user_id` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `country_code` varchar(20) DEFAULT NULL,
  `sender_name` varchar(200) NOT NULL,
  `sender_phone` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sms_settings`
--

INSERT INTO `tbl_sms_settings` (`sms_enabled`, `api_key`, `sms_type`, `url`, `bulk_url`, `url_2`, `bulk_url_2`, `sender_id`, `sender_id_2`, `user_id`, `password`, `country_code`, `sender_name`, `sender_phone`) VALUES
('false', 'C2003631601c03803cde57.82758523', 'unicode', 'http://esms.linktechbd.com/smsapi', 'http://esms.linktechbd.com/smsapimany', 'http://mshastra.com/sendurl.aspx', 'http://mshastra.com/sendurlcomma.aspx', 'Link-UpTech', 'BigTech Ltd', '20102047', 'BTL@432', '+880', 'Link-Up Technology', '01911-978897');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `Supplier_SlNo` int(11) NOT NULL,
  `Supplier_Code` varchar(50) NOT NULL,
  `Supplier_Name` varchar(150) NOT NULL,
  `Supplier_Type` varchar(50) NOT NULL,
  `Supplier_Phone` varchar(50) NOT NULL,
  `Supplier_Mobile` varchar(15) NOT NULL,
  `Supplier_Email` varchar(50) NOT NULL,
  `Supplier_OfficePhone` varchar(50) NOT NULL,
  `Supplier_Address` varchar(300) NOT NULL,
  `contact_person` varchar(250) DEFAULT NULL,
  `District_SlNo` int(11) NOT NULL,
  `Country_SlNo` int(11) NOT NULL,
  `Supplier_Web` varchar(150) NOT NULL,
  `previous_due` decimal(18,2) NOT NULL,
  `image_name` varchar(1000) DEFAULT NULL,
  `Status` char(1) NOT NULL DEFAULT 'a',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `Supplier_brinchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`Supplier_SlNo`, `Supplier_Code`, `Supplier_Name`, `Supplier_Type`, `Supplier_Phone`, `Supplier_Mobile`, `Supplier_Email`, `Supplier_OfficePhone`, `Supplier_Address`, `contact_person`, `District_SlNo`, `Country_SlNo`, `Supplier_Web`, `previous_due`, `image_name`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `Supplier_brinchid`) VALUES
(1, 'S00001', '', 'G', '', '', '', '', '', NULL, 0, 0, '', '0.00', NULL, 'a', 'Admin', '2022-10-20 20:45:41', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier_payment`
--

CREATE TABLE `tbl_supplier_payment` (
  `SPayment_id` int(11) NOT NULL,
  `SPayment_date` date DEFAULT NULL,
  `SPayment_invoice` varchar(20) DEFAULT NULL,
  `SPayment_customerID` varchar(20) DEFAULT NULL,
  `SPayment_TransactionType` varchar(25) DEFAULT NULL,
  `SPayment_amount` decimal(18,2) DEFAULT NULL,
  `SPayment_Paymentby` varchar(20) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `SPayment_notes` varchar(225) DEFAULT NULL,
  `SPayment_brunchid` int(11) DEFAULT NULL,
  `SPayment_status` varchar(2) DEFAULT NULL,
  `SPayment_Addby` varchar(100) DEFAULT NULL,
  `SPayment_AddDAte` date DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `SPayment_UpdateDAte` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transferdetails`
--

CREATE TABLE `tbl_transferdetails` (
  `transferdetails_id` int(11) NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `purchase_rate` decimal(18,2) NOT NULL DEFAULT 0.00,
  `total` decimal(18,2) NOT NULL DEFAULT 0.00
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transfermaster`
--

CREATE TABLE `tbl_transfermaster` (
  `transfer_id` int(11) NOT NULL,
  `transfer_date` date NOT NULL,
  `transfer_by` int(11) NOT NULL,
  `transfer_from` int(11) NOT NULL,
  `transfer_to` int(11) NOT NULL,
  `total_amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `note` varchar(500) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `added_datetime` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `Unit_SlNo` int(11) NOT NULL,
  `Unit_Name` varchar(150) NOT NULL,
  `status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`Unit_SlNo`, `Unit_Name`, `status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`) VALUES
(1, 'Pcs', 'a', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `User_SlNo` int(11) NOT NULL,
  `User_ID` varchar(50) NOT NULL,
  `FullName` varchar(150) NOT NULL,
  `User_Name` varchar(150) NOT NULL,
  `UserEmail` varchar(200) NOT NULL,
  `userBrunch_id` int(11) NOT NULL,
  `User_Password` varchar(50) NOT NULL,
  `UserType` varchar(50) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  `verifycode` int(11) NOT NULL,
  `image_name` varchar(1000) DEFAULT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `Brunch_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`User_SlNo`, `User_ID`, `FullName`, `User_Name`, `UserEmail`, `userBrunch_id`, `User_Password`, `UserType`, `status`, `verifycode`, `image_name`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `Brunch_ID`) VALUES
(1, 'U0001', 'Admin', 'admin', 'admin@host.com', 1, 'c4ca4238a0b923820dcc509a6f75849b', 'm', 'a', 1, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_access`
--

CREATE TABLE `tbl_user_access` (
  `access_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `access` text NOT NULL,
  `saved_by` int(11) NOT NULL,
  `saved_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_activity`
--

CREATE TABLE `tbl_user_activity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime DEFAULT NULL,
  `status` char(2) NOT NULL DEFAULT 'a',
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_activity`
--

INSERT INTO `tbl_user_activity` (`id`, `user_id`, `ip_address`, `login_time`, `logout_time`, `status`, `branch_id`) VALUES
(1, 1, '103.159.73.252', '2022-10-18 20:48:41', NULL, 'a', 1),
(2, 1, '103.228.202.22', '2022-10-18 20:49:04', '2022-10-18 20:49:18', 'a', 1),
(3, 1, '103.54.41.130', '2022-10-18 21:28:03', NULL, 'a', 1),
(4, 1, '103.138.145.106', '2022-10-19 11:07:58', NULL, 'a', 1),
(5, 1, '37.111.200.120', '2022-10-19 15:23:47', NULL, 'a', 1),
(6, 1, '103.159.73.252', '2022-10-19 15:25:39', NULL, 'a', 1),
(7, 1, '103.159.73.252', '2022-10-19 15:26:42', NULL, 'a', 1),
(8, 1, '103.116.167.225', '2022-10-20 17:52:28', NULL, 'a', 1),
(9, 1, '103.138.145.106', '2022-10-20 19:33:40', NULL, 'a', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`Acc_SlNo`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tbl_assets`
--
ALTER TABLE `tbl_assets`
  ADD PRIMARY KEY (`as_id`),
  ADD KEY `as_date` (`as_date`),
  ADD KEY `status` (`status`),
  ADD KEY `branchid` (`branchid`);

--
-- Indexes for table `tbl_bank_accounts`
--
ALTER TABLE `tbl_bank_accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tbl_bank_transactions`
--
ALTER TABLE `tbl_bank_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `transaction_date` (`transaction_date`),
  ADD KEY `transaction_type` (`transaction_type`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_SiNo`),
  ADD KEY `ProductCategory_SlNo` (`ProductCategory_SlNo`),
  ADD KEY `status` (`status`),
  ADD KEY `brand_branchid` (`brand_branchid`);

--
-- Indexes for table `tbl_brunch`
--
ALTER TABLE `tbl_brunch`
  ADD PRIMARY KEY (`brunch_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tbl_cashtransaction`
--
ALTER TABLE `tbl_cashtransaction`
  ADD PRIMARY KEY (`Tr_SlNo`),
  ADD KEY `Tr_Id` (`Tr_Id`),
  ADD KEY `Tr_date` (`Tr_date`),
  ADD KEY `Tr_Type` (`Tr_Type`),
  ADD KEY `Acc_SlID` (`Acc_SlID`),
  ADD KEY `status` (`status`),
  ADD KEY `Tr_branchid` (`Tr_branchid`);

--
-- Indexes for table `tbl_checks`
--
ALTER TABLE `tbl_checks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cus_id` (`cus_id`),
  ADD KEY `SM_id` (`SM_id`),
  ADD KEY `date` (`date`),
  ADD KEY `remid_date` (`remid_date`),
  ADD KEY `check_status` (`check_status`),
  ADD KEY `status` (`status`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_color`
--
ALTER TABLE `tbl_color`
  ADD PRIMARY KEY (`color_SiNo`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`Company_SlNo`),
  ADD KEY `Invoice_Type` (`Invoice_Type`),
  ADD KEY `print_type` (`print_type`),
  ADD KEY `company_BrunchId` (`company_BrunchId`);

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`Country_SlNo`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `tbl_currentinventory`
--
ALTER TABLE `tbl_currentinventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `transfer_from_quantity` (`transfer_from_quantity`),
  ADD KEY `transfer_to_quantity` (`transfer_to_quantity`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`Customer_SlNo`),
  ADD KEY `Customer_Code` (`Customer_Code`),
  ADD KEY `Customer_Mobile` (`Customer_Mobile`),
  ADD KEY `Customer_Type` (`Customer_Type`),
  ADD KEY `Country_SlNo` (`Country_SlNo`),
  ADD KEY `area_ID` (`area_ID`),
  ADD KEY `status` (`status`),
  ADD KEY `Customer_brunchid` (`Customer_brunchid`);

--
-- Indexes for table `tbl_customer_payment`
--
ALTER TABLE `tbl_customer_payment`
  ADD PRIMARY KEY (`CPayment_id`),
  ADD KEY `CPayment_date` (`CPayment_date`),
  ADD KEY `CPayment_invoice` (`CPayment_invoice`),
  ADD KEY `CPayment_customerID` (`CPayment_customerID`),
  ADD KEY `CPayment_TransactionType` (`CPayment_TransactionType`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `CPayment_brunchid` (`CPayment_brunchid`),
  ADD KEY `CPayment_status` (`CPayment_status`);

--
-- Indexes for table `tbl_damage`
--
ALTER TABLE `tbl_damage`
  ADD PRIMARY KEY (`Damage_SlNo`),
  ADD KEY `Damage_InvoiceNo` (`Damage_InvoiceNo`),
  ADD KEY `Damage_Date` (`Damage_Date`),
  ADD KEY `status` (`status`),
  ADD KEY `Damage_brunchid` (`Damage_brunchid`);

--
-- Indexes for table `tbl_damagedetails`
--
ALTER TABLE `tbl_damagedetails`
  ADD PRIMARY KEY (`DamageDetails_SlNo`),
  ADD KEY `Damage_SlNo` (`Damage_SlNo`),
  ADD KEY `Product_SlNo` (`Product_SlNo`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`Department_SlNo`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tbl_designation`
--
ALTER TABLE `tbl_designation`
  ADD PRIMARY KEY (`Designation_SlNo`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`District_SlNo`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`Employee_SlNo`),
  ADD KEY `Designation_ID` (`Designation_ID`),
  ADD KEY `Department_ID` (`Department_ID`),
  ADD KEY `Employee_ID` (`Employee_ID`),
  ADD KEY `status` (`status`),
  ADD KEY `Employee_brinchid` (`Employee_brinchid`);

--
-- Indexes for table `tbl_employee_payment`
--
ALTER TABLE `tbl_employee_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_date` (`payment_date`),
  ADD KEY `month_id` (`month_id`),
  ADD KEY `status` (`status`),
  ADD KEY `paymentBranch_id` (`branch_id`),
  ADD KEY `saved_by` (`saved_by`);

--
-- Indexes for table `tbl_employee_payment_details`
--
ALTER TABLE `tbl_employee_payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`) USING BTREE,
  ADD KEY `branch_id` (`branch_id`) USING BTREE,
  ADD KEY `payment_id` (`payment_id`) USING BTREE,
  ADD KEY `employee_id` (`employee_id`) USING BTREE,
  ADD KEY `saved_by` (`saved_by`) USING BTREE;

--
-- Indexes for table `tbl_expense_head`
--
ALTER TABLE `tbl_expense_head`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tbl_investment_account`
--
ALTER TABLE `tbl_investment_account`
  ADD PRIMARY KEY (`Acc_SlNo`),
  ADD KEY `status` (`status`) USING BTREE,
  ADD KEY `branch_id` (`branch_id`) USING BTREE,
  ADD KEY `Acc_Code` (`Acc_Code`) USING BTREE;

--
-- Indexes for table `tbl_investment_transactions`
--
ALTER TABLE `tbl_investment_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transaction_date` (`transaction_date`),
  ADD KEY `transaction_type` (`transaction_type`),
  ADD KEY `status` (`status`),
  ADD KEY `saved_by` (`saved_by`) USING BTREE,
  ADD KEY `account_id` (`account_id`) USING BTREE;

--
-- Indexes for table `tbl_loan_accounts`
--
ALTER TABLE `tbl_loan_accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `save_date` (`save_date`),
  ADD KEY `branch_id` (`branch_id`) USING BTREE,
  ADD KEY `status` (`status`);

--
-- Indexes for table `tbl_loan_transactions`
--
ALTER TABLE `tbl_loan_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `transaction_date` (`transaction_date`),
  ADD KEY `transaction_type` (`transaction_type`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `status` (`status`),
  ADD KEY `saved_by` (`saved_by`) USING BTREE;

--
-- Indexes for table `tbl_materialcategory`
--
ALTER TABLE `tbl_materialcategory`
  ADD PRIMARY KEY (`ProductCategory_SlNo`),
  ADD KEY `status` (`status`),
  ADD KEY `category_branchid` (`category_branchid`);

--
-- Indexes for table `tbl_materials`
--
ALTER TABLE `tbl_materials`
  ADD PRIMARY KEY (`material_id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `status` (`status`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_material_damage`
--
ALTER TABLE `tbl_material_damage`
  ADD PRIMARY KEY (`damage_id`),
  ADD UNIQUE KEY `invoice` (`invoice`),
  ADD KEY `damage_date` (`damage_date`),
  ADD KEY `status` (`status`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_material_damage_details`
--
ALTER TABLE `tbl_material_damage_details`
  ADD PRIMARY KEY (`damage_details_id`),
  ADD KEY `damage_id` (`damage_id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `status` (`status`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_material_purchase`
--
ALTER TABLE `tbl_material_purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD UNIQUE KEY `invoice_no` (`invoice_no`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `purchase_date` (`purchase_date`),
  ADD KEY `purchase_for` (`purchase_for`),
  ADD KEY `status` (`status`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_material_purchase_details`
--
ALTER TABLE `tbl_material_purchase_details`
  ADD PRIMARY KEY (`purchase_detail_id`),
  ADD KEY `purchase_id` (`purchase_id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `status` (`status`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_month`
--
ALTER TABLE `tbl_month`
  ADD PRIMARY KEY (`month_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`Product_SlNo`),
  ADD UNIQUE KEY `Product_Code` (`Product_Code`) USING BTREE,
  ADD KEY `ProductCategory_ID` (`ProductCategory_ID`),
  ADD KEY `is_service` (`is_service`),
  ADD KEY `Unit_ID` (`Unit_ID`),
  ADD KEY `status` (`status`),
  ADD KEY `Product_branchid` (`Product_branchid`);

--
-- Indexes for table `tbl_productcategory`
--
ALTER TABLE `tbl_productcategory`
  ADD PRIMARY KEY (`ProductCategory_SlNo`),
  ADD KEY `status` (`status`),
  ADD KEY `category_branchid` (`category_branchid`);

--
-- Indexes for table `tbl_productions`
--
ALTER TABLE `tbl_productions`
  ADD PRIMARY KEY (`production_id`),
  ADD UNIQUE KEY `production_sl` (`production_sl`),
  ADD KEY `date` (`date`),
  ADD KEY `incharge_id` (`incharge_id`),
  ADD KEY `shift` (`shift`),
  ADD KEY `status` (`status`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_production_details`
--
ALTER TABLE `tbl_production_details`
  ADD KEY `production_id` (`production_id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `status` (`status`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_production_products`
--
ALTER TABLE `tbl_production_products`
  ADD PRIMARY KEY (`production_products_id`),
  ADD KEY `production_id` (`production_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `status` (`status`) USING BTREE,
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_purchasedetails`
--
ALTER TABLE `tbl_purchasedetails`
  ADD PRIMARY KEY (`PurchaseDetails_SlNo`),
  ADD KEY `PurchaseMaster_IDNo` (`PurchaseMaster_IDNo`),
  ADD KEY `Product_IDNo` (`Product_IDNo`),
  ADD KEY `Status` (`Status`),
  ADD KEY `PurchaseDetails_branchID` (`PurchaseDetails_branchID`);

--
-- Indexes for table `tbl_purchasemaster`
--
ALTER TABLE `tbl_purchasemaster`
  ADD PRIMARY KEY (`PurchaseMaster_SlNo`),
  ADD KEY `Supplier_SlNo` (`Supplier_SlNo`),
  ADD KEY `Employee_SlNo` (`Employee_SlNo`),
  ADD KEY `PurchaseMaster_InvoiceNo` (`PurchaseMaster_InvoiceNo`),
  ADD KEY `PurchaseMaster_OrderDate` (`PurchaseMaster_OrderDate`),
  ADD KEY `status` (`status`),
  ADD KEY `PurchaseMaster_BranchID` (`PurchaseMaster_BranchID`);

--
-- Indexes for table `tbl_purchasereturn`
--
ALTER TABLE `tbl_purchasereturn`
  ADD PRIMARY KEY (`PurchaseReturn_SlNo`),
  ADD KEY `PurchaseMaster_InvoiceNo` (`PurchaseMaster_InvoiceNo`),
  ADD KEY `Supplier_IDdNo` (`Supplier_IDdNo`),
  ADD KEY `PurchaseReturn_ReturnDate` (`PurchaseReturn_ReturnDate`),
  ADD KEY `Status` (`Status`),
  ADD KEY `PurchaseReturn_brunchID` (`PurchaseReturn_brunchID`);

--
-- Indexes for table `tbl_purchasereturndetails`
--
ALTER TABLE `tbl_purchasereturndetails`
  ADD PRIMARY KEY (`PurchaseReturnDetails_SlNo`),
  ADD KEY `PurchaseReturn_SlNo` (`PurchaseReturn_SlNo`),
  ADD KEY `PurchaseReturnDetailsProduct_SlNo` (`PurchaseReturnDetailsProduct_SlNo`),
  ADD KEY `Status` (`Status`),
  ADD KEY `PurchaseReturnDetails_brachid` (`PurchaseReturnDetails_brachid`);

--
-- Indexes for table `tbl_quotaion_customer`
--
ALTER TABLE `tbl_quotaion_customer`
  ADD PRIMARY KEY (`quotation_customer_id`),
  ADD KEY `quation_customer_branchid` (`quation_customer_branchid`);

--
-- Indexes for table `tbl_quotation_details`
--
ALTER TABLE `tbl_quotation_details`
  ADD PRIMARY KEY (`SaleDetails_SlNo`),
  ADD KEY `SaleMaster_IDNo` (`SaleMaster_IDNo`),
  ADD KEY `Product_IDNo` (`Product_IDNo`),
  ADD KEY `Status` (`Status`),
  ADD KEY `SaleDetails_BranchId` (`SaleDetails_BranchId`);

--
-- Indexes for table `tbl_quotation_master`
--
ALTER TABLE `tbl_quotation_master`
  ADD PRIMARY KEY (`SaleMaster_SlNo`),
  ADD KEY `SaleMaster_InvoiceNo` (`SaleMaster_InvoiceNo`),
  ADD KEY `SaleMaster_SaleDate` (`SaleMaster_SaleDate`),
  ADD KEY `Status` (`Status`),
  ADD KEY `SaleMaster_branchid` (`SaleMaster_branchid`);

--
-- Indexes for table `tbl_saledetails`
--
ALTER TABLE `tbl_saledetails`
  ADD PRIMARY KEY (`SaleDetails_SlNo`),
  ADD KEY `SaleMaster_IDNo` (`SaleMaster_IDNo`),
  ADD KEY `Product_IDNo` (`Product_IDNo`),
  ADD KEY `Status` (`Status`),
  ADD KEY `SaleDetails_BranchId` (`SaleDetails_BranchId`);

--
-- Indexes for table `tbl_salereturn`
--
ALTER TABLE `tbl_salereturn`
  ADD PRIMARY KEY (`SaleReturn_SlNo`),
  ADD KEY `SaleMaster_InvoiceNo` (`SaleMaster_InvoiceNo`),
  ADD KEY `SaleReturn_ReturnDate` (`SaleReturn_ReturnDate`),
  ADD KEY `Status` (`Status`),
  ADD KEY `SaleReturn_brunchId` (`SaleReturn_brunchId`);

--
-- Indexes for table `tbl_salereturndetails`
--
ALTER TABLE `tbl_salereturndetails`
  ADD PRIMARY KEY (`SaleReturnDetails_SlNo`),
  ADD KEY `SaleReturn_IdNo` (`SaleReturn_IdNo`),
  ADD KEY `SaleReturnDetailsProduct_SlNo` (`SaleReturnDetailsProduct_SlNo`),
  ADD KEY `Status` (`Status`),
  ADD KEY `SaleReturnDetails_brunchID` (`SaleReturnDetails_brunchID`);

--
-- Indexes for table `tbl_salesmaster`
--
ALTER TABLE `tbl_salesmaster`
  ADD PRIMARY KEY (`SaleMaster_SlNo`),
  ADD KEY `SaleMaster_InvoiceNo` (`SaleMaster_InvoiceNo`),
  ADD KEY `SalseCustomer_IDNo` (`SalseCustomer_IDNo`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `SaleMaster_SaleDate` (`SaleMaster_SaleDate`),
  ADD KEY `Status` (`Status`),
  ADD KEY `is_service` (`is_service`),
  ADD KEY `SaleMaster_branchid` (`SaleMaster_branchid`);

--
-- Indexes for table `tbl_shifts`
--
ALTER TABLE `tbl_shifts`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indexes for table `tbl_sms`
--
ALTER TABLE `tbl_sms`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`Supplier_SlNo`),
  ADD KEY `Supplier_Code` (`Supplier_Code`),
  ADD KEY `Supplier_Mobile` (`Supplier_Mobile`),
  ADD KEY `District_SlNo` (`District_SlNo`),
  ADD KEY `Country_SlNo` (`Country_SlNo`),
  ADD KEY `Status` (`Status`),
  ADD KEY `Supplier_brinchid` (`Supplier_brinchid`);

--
-- Indexes for table `tbl_supplier_payment`
--
ALTER TABLE `tbl_supplier_payment`
  ADD PRIMARY KEY (`SPayment_id`),
  ADD KEY `SPayment_date` (`SPayment_date`),
  ADD KEY `SPayment_invoice` (`SPayment_invoice`),
  ADD KEY `SPayment_customerID` (`SPayment_customerID`),
  ADD KEY `SPayment_TransactionType` (`SPayment_TransactionType`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `SPayment_brunchid` (`SPayment_brunchid`),
  ADD KEY `SPayment_status` (`SPayment_status`);

--
-- Indexes for table `tbl_transferdetails`
--
ALTER TABLE `tbl_transferdetails`
  ADD PRIMARY KEY (`transferdetails_id`),
  ADD KEY `transfer_id` (`transfer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_transfermaster`
--
ALTER TABLE `tbl_transfermaster`
  ADD PRIMARY KEY (`transfer_id`),
  ADD KEY `transfer_date` (`transfer_date`),
  ADD KEY `transfer_from` (`transfer_from`),
  ADD KEY `transfer_to` (`transfer_to`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`Unit_SlNo`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`User_SlNo`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `User_Name` (`User_Name`),
  ADD KEY `User_Password` (`User_Password`),
  ADD KEY `UserType` (`UserType`),
  ADD KEY `status` (`status`),
  ADD KEY `Brunch_ID` (`Brunch_ID`);

--
-- Indexes for table `tbl_user_access`
--
ALTER TABLE `tbl_user_access`
  ADD PRIMARY KEY (`access_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_user_activity`
--
ALTER TABLE `tbl_user_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `Acc_SlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_assets`
--
ALTER TABLE `tbl_assets`
  MODIFY `as_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bank_accounts`
--
ALTER TABLE `tbl_bank_accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bank_transactions`
--
ALTER TABLE `tbl_bank_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_SiNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_brunch`
--
ALTER TABLE `tbl_brunch`
  MODIFY `brunch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cashtransaction`
--
ALTER TABLE `tbl_cashtransaction`
  MODIFY `Tr_SlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_checks`
--
ALTER TABLE `tbl_checks`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `color_SiNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `Company_SlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `Country_SlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_currentinventory`
--
ALTER TABLE `tbl_currentinventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `Customer_SlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_customer_payment`
--
ALTER TABLE `tbl_customer_payment`
  MODIFY `CPayment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_damage`
--
ALTER TABLE `tbl_damage`
  MODIFY `Damage_SlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_damagedetails`
--
ALTER TABLE `tbl_damagedetails`
  MODIFY `DamageDetails_SlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `Department_SlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_designation`
--
ALTER TABLE `tbl_designation`
  MODIFY `Designation_SlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `District_SlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `Employee_SlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_employee_payment`
--
ALTER TABLE `tbl_employee_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_employee_payment_details`
--
ALTER TABLE `tbl_employee_payment_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_expense_head`
--
ALTER TABLE `tbl_expense_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_investment_account`
--
ALTER TABLE `tbl_investment_account`
  MODIFY `Acc_SlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_investment_transactions`
--
ALTER TABLE `tbl_investment_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_loan_accounts`
--
ALTER TABLE `tbl_loan_accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_loan_transactions`
--
ALTER TABLE `tbl_loan_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_materialcategory`
--
ALTER TABLE `tbl_materialcategory`
  MODIFY `ProductCategory_SlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_materials`
--
ALTER TABLE `tbl_materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_material_damage`
--
ALTER TABLE `tbl_material_damage`
  MODIFY `damage_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_material_damage_details`
--
ALTER TABLE `tbl_material_damage_details`
  MODIFY `damage_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_material_purchase`
--
ALTER TABLE `tbl_material_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_material_purchase_details`
--
ALTER TABLE `tbl_material_purchase_details`
  MODIFY `purchase_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_month`
--
ALTER TABLE `tbl_month`
  MODIFY `month_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `Product_SlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_productcategory`
--
ALTER TABLE `tbl_productcategory`
  MODIFY `ProductCategory_SlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_productions`
--
ALTER TABLE `tbl_productions`
  MODIFY `production_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_production_products`
--
ALTER TABLE `tbl_production_products`
  MODIFY `production_products_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchasedetails`
--
ALTER TABLE `tbl_purchasedetails`
  MODIFY `PurchaseDetails_SlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_purchasemaster`
--
ALTER TABLE `tbl_purchasemaster`
  MODIFY `PurchaseMaster_SlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_purchasereturn`
--
ALTER TABLE `tbl_purchasereturn`
  MODIFY `PurchaseReturn_SlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchasereturndetails`
--
ALTER TABLE `tbl_purchasereturndetails`
  MODIFY `PurchaseReturnDetails_SlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quotaion_customer`
--
ALTER TABLE `tbl_quotaion_customer`
  MODIFY `quotation_customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quotation_details`
--
ALTER TABLE `tbl_quotation_details`
  MODIFY `SaleDetails_SlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quotation_master`
--
ALTER TABLE `tbl_quotation_master`
  MODIFY `SaleMaster_SlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_saledetails`
--
ALTER TABLE `tbl_saledetails`
  MODIFY `SaleDetails_SlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_salereturn`
--
ALTER TABLE `tbl_salereturn`
  MODIFY `SaleReturn_SlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_salereturndetails`
--
ALTER TABLE `tbl_salereturndetails`
  MODIFY `SaleReturnDetails_SlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_salesmaster`
--
ALTER TABLE `tbl_salesmaster`
  MODIFY `SaleMaster_SlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_shifts`
--
ALTER TABLE `tbl_shifts`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_sms`
--
ALTER TABLE `tbl_sms`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `Supplier_SlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_supplier_payment`
--
ALTER TABLE `tbl_supplier_payment`
  MODIFY `SPayment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transferdetails`
--
ALTER TABLE `tbl_transferdetails`
  MODIFY `transferdetails_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transfermaster`
--
ALTER TABLE `tbl_transfermaster`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `Unit_SlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `User_SlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user_access`
--
ALTER TABLE `tbl_user_access`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_activity`
--
ALTER TABLE `tbl_user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
