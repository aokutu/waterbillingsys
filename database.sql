-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 17, 2026 at 10:02 AM
-- Server version: 11.4.9-MariaDB-cll-lve-log
-- PHP Version: 8.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TEST`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts1`
--

CREATE TABLE `accounts1` (
  `id` int(11) NOT NULL,
  `client` text DEFAULT NULL,
  `class` text DEFAULT NULL,
  `account` text DEFAULT NULL,
  `meternumber` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `idnumber` text NOT NULL,
  `user` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date2` date NOT NULL,
  `id2` text DEFAULT NULL,
  `email` float DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `avg` text NOT NULL,
  `avgunit` int(11) NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `clientemail` text NOT NULL,
  `plotnumber` text NOT NULL,
  `deposit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts2`
--

CREATE TABLE `accounts2` (
  `id` int(11) NOT NULL,
  `client` text DEFAULT NULL,
  `class` text DEFAULT NULL,
  `account` text DEFAULT NULL,
  `meternumber` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `idnumber` text NOT NULL,
  `user` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date2` date NOT NULL,
  `id2` text DEFAULT NULL,
  `email` float DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `avg` text NOT NULL,
  `avgunit` int(11) NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `clientemail` text NOT NULL,
  `plotnumber` text NOT NULL,
  `deposit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts3`
--

CREATE TABLE `accounts3` (
  `id` int(11) NOT NULL,
  `client` text DEFAULT NULL,
  `class` text DEFAULT NULL,
  `account` text DEFAULT NULL,
  `meternumber` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `idnumber` text NOT NULL,
  `user` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date2` date NOT NULL,
  `id2` text DEFAULT NULL,
  `email` float DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `avg` text NOT NULL,
  `avgunit` int(11) NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `clientemail` text NOT NULL,
  `plotnumber` text NOT NULL,
  `deposit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts4`
--

CREATE TABLE `accounts4` (
  `id` int(11) NOT NULL,
  `client` text DEFAULT NULL,
  `class` text DEFAULT NULL,
  `account` text DEFAULT NULL,
  `meternumber` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `idnumber` text NOT NULL,
  `user` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date2` date NOT NULL,
  `id2` text DEFAULT NULL,
  `email` float DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `avg` text NOT NULL,
  `avgunit` int(11) NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `clientemail` text NOT NULL,
  `plotnumber` text NOT NULL,
  `deposit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts5`
--

CREATE TABLE `accounts5` (
  `id` int(11) NOT NULL,
  `client` text DEFAULT NULL,
  `class` text DEFAULT NULL,
  `account` text DEFAULT NULL,
  `meternumber` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `idnumber` text NOT NULL,
  `user` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date2` date NOT NULL,
  `id2` text DEFAULT NULL,
  `email` float DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `avg` text NOT NULL,
  `avgunit` int(11) NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `clientemail` text NOT NULL,
  `plotnumber` text NOT NULL,
  `deposit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts6`
--

CREATE TABLE `accounts6` (
  `id` int(11) NOT NULL,
  `client` text DEFAULT NULL,
  `class` text DEFAULT NULL,
  `account` text DEFAULT NULL,
  `meternumber` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `idnumber` text NOT NULL,
  `user` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date2` date NOT NULL,
  `id2` text DEFAULT NULL,
  `email` float DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `avg` text NOT NULL,
  `avgunit` int(11) NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `clientemail` text NOT NULL,
  `plotnumber` text NOT NULL,
  `deposit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts7`
--

CREATE TABLE `accounts7` (
  `id` int(11) NOT NULL,
  `client` text DEFAULT NULL,
  `class` text DEFAULT NULL,
  `account` text DEFAULT NULL,
  `meternumber` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `idnumber` text NOT NULL,
  `user` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date2` date NOT NULL,
  `id2` text DEFAULT NULL,
  `email` float DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `avg` text NOT NULL,
  `avgunit` int(11) NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `clientemail` text NOT NULL,
  `plotnumber` text NOT NULL,
  `deposit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts8`
--

CREATE TABLE `accounts8` (
  `id` int(11) NOT NULL,
  `client` text DEFAULT NULL,
  `class` text DEFAULT NULL,
  `account` text DEFAULT NULL,
  `meternumber` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `idnumber` text NOT NULL,
  `user` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date2` date NOT NULL,
  `id2` text DEFAULT NULL,
  `email` float DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `avg` text NOT NULL,
  `avgunit` int(11) NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `clientemail` text NOT NULL,
  `plotnumber` text NOT NULL,
  `deposit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts9`
--

CREATE TABLE `accounts9` (
  `id` int(11) NOT NULL,
  `client` text DEFAULT NULL,
  `class` text DEFAULT NULL,
  `account` text DEFAULT NULL,
  `meternumber` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `idnumber` text NOT NULL,
  `user` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date2` date NOT NULL,
  `id2` text DEFAULT NULL,
  `email` float DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `avg` text NOT NULL,
  `avgunit` int(11) NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `clientemail` text NOT NULL,
  `plotnumber` text NOT NULL,
  `deposit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts10`
--

CREATE TABLE `accounts10` (
  `id` int(11) NOT NULL,
  `client` text DEFAULT NULL,
  `class` text DEFAULT NULL,
  `account` text DEFAULT NULL,
  `meternumber` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `idnumber` text NOT NULL,
  `user` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date2` date NOT NULL,
  `id2` text DEFAULT NULL,
  `email` float DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `avg` text NOT NULL,
  `avgunit` int(11) NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `clientemail` text NOT NULL,
  `plotnumber` text NOT NULL,
  `deposit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts100`
--

CREATE TABLE `accounts100` (
  `id` int(11) NOT NULL,
  `client` text DEFAULT NULL,
  `class` text DEFAULT NULL,
  `account` text DEFAULT NULL,
  `meternumber` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `idnumber` text NOT NULL,
  `user` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date2` date NOT NULL,
  `id2` text DEFAULT NULL,
  `email` float DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `avg` text NOT NULL,
  `avgunit` int(11) NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `clientemail` text NOT NULL,
  `plotnumber` text NOT NULL,
  `deposit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accountsstatus`
--

CREATE TABLE `accountsstatus` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `status` text NOT NULL,
  `class` text NOT NULL,
  `zone` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adjustment`
--

CREATE TABLE `adjustment` (
  `id` int(11) NOT NULL,
  `item` text NOT NULL,
  `description` text NOT NULL,
  `quantity` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advancedsalary`
--

CREATE TABLE `advancedsalary` (
  `id` int(11) NOT NULL,
  `idnumber` text NOT NULL,
  `staffname` text NOT NULL,
  `transaction` text NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balance1`
--

CREATE TABLE `balance1` (
  `account` text NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balance2`
--

CREATE TABLE `balance2` (
  `account` text NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balance3`
--

CREATE TABLE `balance3` (
  `id` bigint(20) NOT NULL,
  `account` text NOT NULL,
  `previous` int(11) NOT NULL,
  `current` int(11) NOT NULL,
  `consumtion` int(11) NOT NULL,
  `bill` float NOT NULL,
  `balbf` float NOT NULL,
  `totalbill` int(11) NOT NULL,
  `date` date NOT NULL,
  `billid` text NOT NULL,
  `date2` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `BALANCEREPORT`
--

CREATE TABLE `BALANCEREPORT` (
  `ID` bigint(20) NOT NULL,
  `COMPANY` text DEFAULT NULL,
  `ZONE` text DEFAULT NULL,
  `ACCOUNT` text DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `PREVIOUS` float DEFAULT NULL,
  `CURRENT` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `BILL`
--

CREATE TABLE `BILL` (
  `ACCOUNT` text DEFAULT NULL,
  `AMOUNT` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills1`
--

CREATE TABLE `bills1` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `current` float DEFAULT NULL,
  `previous` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `billed` float NOT NULL,
  `units` float DEFAULT NULL,
  `deduction` float NOT NULL,
  `commission` double NOT NULL,
  `charges` double DEFAULT NULL,
  `metercharges` double DEFAULT NULL,
  `refuse` float DEFAULT NULL,
  `status` text DEFAULT NULL,
  `meterstatus` text NOT NULL,
  `accountstatus` text NOT NULL,
  `class` text NOT NULL,
  `reciept` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills2`
--

CREATE TABLE `bills2` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `current` float DEFAULT NULL,
  `previous` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `billed` float NOT NULL,
  `units` float DEFAULT NULL,
  `deduction` float NOT NULL,
  `commission` double NOT NULL,
  `charges` double DEFAULT NULL,
  `metercharges` double DEFAULT NULL,
  `refuse` float DEFAULT NULL,
  `status` text DEFAULT NULL,
  `meterstatus` text NOT NULL,
  `accountstatus` text NOT NULL,
  `class` text NOT NULL,
  `reciept` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills3`
--

CREATE TABLE `bills3` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `current` float DEFAULT NULL,
  `previous` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `billed` float NOT NULL,
  `units` float DEFAULT NULL,
  `deduction` float NOT NULL,
  `commission` double NOT NULL,
  `charges` double DEFAULT NULL,
  `metercharges` double DEFAULT NULL,
  `refuse` float DEFAULT NULL,
  `status` text DEFAULT NULL,
  `meterstatus` text NOT NULL,
  `accountstatus` text NOT NULL,
  `class` text NOT NULL,
  `reciept` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills4`
--

CREATE TABLE `bills4` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `current` float DEFAULT NULL,
  `previous` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `billed` float NOT NULL,
  `units` float DEFAULT NULL,
  `deduction` float NOT NULL,
  `commission` double NOT NULL,
  `charges` double DEFAULT NULL,
  `metercharges` double DEFAULT NULL,
  `refuse` float DEFAULT NULL,
  `status` text DEFAULT NULL,
  `meterstatus` text NOT NULL,
  `accountstatus` text NOT NULL,
  `class` text NOT NULL,
  `reciept` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills5`
--

CREATE TABLE `bills5` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `current` float DEFAULT NULL,
  `previous` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `billed` float NOT NULL,
  `units` float DEFAULT NULL,
  `deduction` float NOT NULL,
  `commission` double NOT NULL,
  `charges` double DEFAULT NULL,
  `metercharges` double DEFAULT NULL,
  `refuse` float DEFAULT NULL,
  `status` text DEFAULT NULL,
  `meterstatus` text NOT NULL,
  `accountstatus` text NOT NULL,
  `class` text NOT NULL,
  `reciept` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills6`
--

CREATE TABLE `bills6` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `current` float DEFAULT NULL,
  `previous` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `billed` float NOT NULL,
  `units` float DEFAULT NULL,
  `deduction` float NOT NULL,
  `commission` double NOT NULL,
  `charges` double DEFAULT NULL,
  `metercharges` double DEFAULT NULL,
  `refuse` float DEFAULT NULL,
  `status` text DEFAULT NULL,
  `meterstatus` text NOT NULL,
  `accountstatus` text NOT NULL,
  `class` text NOT NULL,
  `reciept` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills7`
--

CREATE TABLE `bills7` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `current` float DEFAULT NULL,
  `previous` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `billed` float NOT NULL,
  `units` float DEFAULT NULL,
  `deduction` float NOT NULL,
  `commission` double NOT NULL,
  `charges` double DEFAULT NULL,
  `metercharges` double DEFAULT NULL,
  `refuse` float DEFAULT NULL,
  `status` text DEFAULT NULL,
  `meterstatus` text NOT NULL,
  `accountstatus` text NOT NULL,
  `class` text NOT NULL,
  `reciept` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills8`
--

CREATE TABLE `bills8` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `current` float DEFAULT NULL,
  `previous` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `billed` float NOT NULL,
  `units` float DEFAULT NULL,
  `deduction` float NOT NULL,
  `commission` double NOT NULL,
  `charges` double DEFAULT NULL,
  `metercharges` double DEFAULT NULL,
  `refuse` float DEFAULT NULL,
  `status` text DEFAULT NULL,
  `meterstatus` text NOT NULL,
  `accountstatus` text NOT NULL,
  `class` text NOT NULL,
  `reciept` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills9`
--

CREATE TABLE `bills9` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `current` float DEFAULT NULL,
  `previous` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `billed` float NOT NULL,
  `units` float DEFAULT NULL,
  `deduction` float NOT NULL,
  `commission` double NOT NULL,
  `charges` double DEFAULT NULL,
  `metercharges` double DEFAULT NULL,
  `refuse` float DEFAULT NULL,
  `status` text DEFAULT NULL,
  `meterstatus` text NOT NULL,
  `accountstatus` text NOT NULL,
  `class` text NOT NULL,
  `reciept` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills10`
--

CREATE TABLE `bills10` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `current` float DEFAULT NULL,
  `previous` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `billed` float NOT NULL,
  `units` float DEFAULT NULL,
  `deduction` float NOT NULL,
  `commission` double NOT NULL,
  `charges` double DEFAULT NULL,
  `metercharges` double DEFAULT NULL,
  `refuse` float DEFAULT NULL,
  `status` text DEFAULT NULL,
  `meterstatus` text NOT NULL,
  `accountstatus` text NOT NULL,
  `class` text NOT NULL,
  `reciept` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills100`
--

CREATE TABLE `bills100` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `current` float DEFAULT NULL,
  `previous` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `billed` float NOT NULL,
  `units` float DEFAULT NULL,
  `deduction` float NOT NULL,
  `commission` double NOT NULL,
  `charges` double DEFAULT NULL,
  `metercharges` double DEFAULT NULL,
  `refuse` float DEFAULT NULL,
  `status` text DEFAULT NULL,
  `meterstatus` text NOT NULL,
  `accountstatus` text NOT NULL,
  `class` text NOT NULL,
  `reciept` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billsanalysis`
--

CREATE TABLE `billsanalysis` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `class` text NOT NULL,
  `billed` float NOT NULL,
  `totalcharges` float NOT NULL,
  `meterrent` float NOT NULL,
  `consumtion` float NOT NULL,
  `meterstatus` text NOT NULL,
  `accountstatus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE `channels` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `lattitude` text NOT NULL,
  `longitude` text NOT NULL,
  `weight` int(11) NOT NULL,
  `color` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `CHARGES`
--

CREATE TABLE `CHARGES` (
  `id` int(11) NOT NULL,
  `class` text NOT NULL,
  `minunits` int(11) NOT NULL,
  `maxunits` int(11) NOT NULL,
  `charges` float NOT NULL,
  `rate` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `sender` text NOT NULL,
  `message` text NOT NULL,
  `recipient` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clientmetersreg`
--

CREATE TABLE `clientmetersreg` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `serialnumber` text NOT NULL,
  `size` text DEFAULT NULL,
  `account` text NOT NULL,
  `status` text DEFAULT NULL,
  `zone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clientquotations`
--

CREATE TABLE `clientquotations` (
  `id` int(11) NOT NULL,
  `serialnumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `quantity` float NOT NULL,
  `price` float NOT NULL,
  `amount` float NOT NULL,
  `account` text NOT NULL,
  `names` text NOT NULL,
  `contact` text NOT NULL,
  `plotnumber` text NOT NULL,
  `location` text NOT NULL,
  `preparer` text NOT NULL,
  `status` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clock`
--

CREATE TABLE `clock` (
  `id` int(11) NOT NULL,
  `lockdate` date NOT NULL,
  `currentdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consumeranalysis`
--

CREATE TABLE `consumeranalysis` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL,
  `connected` int(11) NOT NULL,
  `billed` float NOT NULL,
  `meterrent` float NOT NULL,
  `consumtion` float NOT NULL,
  `revenue` float NOT NULL,
  `running` int(11) NOT NULL,
  `estimate` int(11) NOT NULL,
  `meterstatus` text NOT NULL,
  `accountstatus` text NOT NULL,
  `class` text DEFAULT NULL,
  `nonactive` int(11) NOT NULL,
  `totalconnection` int(11) NOT NULL,
  `totalcharges` float NOT NULL,
  `totalrevenue` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contactsupload`
--

CREATE TABLE `contactsupload` (
  `account` text NOT NULL,
  `contact` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currentcharges`
--

CREATE TABLE `currentcharges` (
  `account` text NOT NULL,
  `name` text NOT NULL,
  `currentreading` text NOT NULL,
  `charges` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `damages`
--

CREATE TABLE `damages` (
  `id` int(11) NOT NULL,
  `idnumber` int(11) NOT NULL,
  `name` text NOT NULL,
  `transaction` text NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `damagesregistry`
--

CREATE TABLE `damagesregistry` (
  `id` int(11) NOT NULL,
  `idnumber` int(11) NOT NULL,
  `name` text NOT NULL,
  `amount` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `debtpay`
--

CREATE TABLE `debtpay` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `amount` float NOT NULL,
  `details` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `debtregistry`
--

CREATE TABLE `debtregistry` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `initialbal` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `currentbal` int(11) NOT NULL,
  `installment` int(11) NOT NULL,
  `date` date NOT NULL,
  `date2` date NOT NULL,
  `regdate` date NOT NULL,
  `zone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposituploads`
--

CREATE TABLE `deposituploads` (
  `transaction` text DEFAULT NULL,
  `credit` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `zone` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `session` text NOT NULL,
  `action` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financearchive`
--

CREATE TABLE `financearchive` (
  `account` text NOT NULL,
  `zone` text NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `archived` date NOT NULL,
  `transaction` text NOT NULL,
  `meternumber` text NOT NULL,
  `consumsion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gatepass`
--

CREATE TABLE `gatepass` (
  `id` int(11) NOT NULL,
  `serialnumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `issuenote` int(10) UNSIGNED ZEROFILL NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `quantity` float NOT NULL,
  `issuer` text NOT NULL,
  `issuertitle` text NOT NULL,
  `receiver` text NOT NULL,
  `receivertitle` text NOT NULL,
  `transporter` text NOT NULL,
  `transportertitle` text NOT NULL,
  `vehicle` text NOT NULL,
  `vehiclenumber` text NOT NULL,
  `pointofuse` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `category` text NOT NULL,
  `itemcode` text NOT NULL,
  `minstocklevel` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `price` float NOT NULL,
  `bprice` float NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itemcategories`
--

CREATE TABLE `itemcategories` (
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lastrecieptnumber`
--

CREATE TABLE `lastrecieptnumber` (
  `lastnumber` bigint(7) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `localpurchaseorders`
--

CREATE TABLE `localpurchaseorders` (
  `id` int(11) NOT NULL,
  `serialnumber` int(10) NOT NULL,
  `supplier` text NOT NULL,
  `reffnumber` text NOT NULL,
  `contractreff` text NOT NULL,
  `contractdate` date NOT NULL,
  `requisitionreff` text NOT NULL,
  `requisitiondate` date NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `price` double NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lpos`
--

CREATE TABLE `lpos` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL,
  `serialnumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `price` float NOT NULL,
  `quantity` float NOT NULL,
  `amount` float NOT NULL,
  `supplier` text NOT NULL,
  `tendernumber` text NOT NULL,
  `contractnumber` text NOT NULL,
  `contractdate` date NOT NULL,
  `requisitionnumber` text NOT NULL,
  `requisitiondate` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mapping`
--

CREATE TABLE `mapping` (
  `id` int(11) NOT NULL,
  `lattitude` text NOT NULL,
  `longitude` text NOT NULL,
  `account` text NOT NULL,
  `client` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeterbill1`
--

CREATE TABLE `mastermeterbill1` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `current` float NOT NULL,
  `previous` float NOT NULL,
  `units` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeterbill2`
--

CREATE TABLE `mastermeterbill2` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `current` float NOT NULL,
  `previous` float NOT NULL,
  `units` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeterbill3`
--

CREATE TABLE `mastermeterbill3` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `current` float NOT NULL,
  `previous` float NOT NULL,
  `units` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeterbill4`
--

CREATE TABLE `mastermeterbill4` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `current` float NOT NULL,
  `previous` float NOT NULL,
  `units` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeterbill5`
--

CREATE TABLE `mastermeterbill5` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `current` float NOT NULL,
  `previous` float NOT NULL,
  `units` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeterbill6`
--

CREATE TABLE `mastermeterbill6` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `current` float NOT NULL,
  `previous` float NOT NULL,
  `units` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeterbill7`
--

CREATE TABLE `mastermeterbill7` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `current` float NOT NULL,
  `previous` float NOT NULL,
  `units` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeterbill8`
--

CREATE TABLE `mastermeterbill8` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `current` float NOT NULL,
  `previous` float NOT NULL,
  `units` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeterbill9`
--

CREATE TABLE `mastermeterbill9` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `current` float NOT NULL,
  `previous` float NOT NULL,
  `units` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeterbill10`
--

CREATE TABLE `mastermeterbill10` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `current` float NOT NULL,
  `previous` float NOT NULL,
  `units` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeterbill100`
--

CREATE TABLE `mastermeterbill100` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `current` float NOT NULL,
  `previous` float NOT NULL,
  `units` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeters1`
--

CREATE TABLE `mastermeters1` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `serialnumber` text NOT NULL,
  `location` text NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `reading` float NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeters2`
--

CREATE TABLE `mastermeters2` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `serialnumber` text NOT NULL,
  `location` text NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `reading` float NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeters3`
--

CREATE TABLE `mastermeters3` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `serialnumber` text NOT NULL,
  `location` text NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `reading` float NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeters4`
--

CREATE TABLE `mastermeters4` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `serialnumber` text NOT NULL,
  `location` text NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `reading` float NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeters5`
--

CREATE TABLE `mastermeters5` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `serialnumber` text NOT NULL,
  `location` text NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `reading` float NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeters6`
--

CREATE TABLE `mastermeters6` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `serialnumber` text NOT NULL,
  `location` text NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `reading` float NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeters7`
--

CREATE TABLE `mastermeters7` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `serialnumber` text NOT NULL,
  `location` text NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `reading` float NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeters8`
--

CREATE TABLE `mastermeters8` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `serialnumber` text NOT NULL,
  `location` text NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `reading` float NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeters9`
--

CREATE TABLE `mastermeters9` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `serialnumber` text NOT NULL,
  `location` text NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `reading` float NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeters10`
--

CREATE TABLE `mastermeters10` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `serialnumber` text NOT NULL,
  `location` text NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `reading` float NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mastermeters100`
--

CREATE TABLE `mastermeters100` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `serialnumber` text NOT NULL,
  `location` text NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `reading` float NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meters1`
--

CREATE TABLE `meters1` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `serialnumber` text NOT NULL,
  `size` text DEFAULT NULL,
  `account` text NOT NULL,
  `status` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meters2`
--

CREATE TABLE `meters2` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `serialnumber` text NOT NULL,
  `size` text DEFAULT NULL,
  `account` text NOT NULL,
  `status` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meters3`
--

CREATE TABLE `meters3` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `serialnumber` text NOT NULL,
  `size` text DEFAULT NULL,
  `account` text NOT NULL,
  `status` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meters4`
--

CREATE TABLE `meters4` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `serialnumber` text NOT NULL,
  `size` text DEFAULT NULL,
  `account` text NOT NULL,
  `status` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meters5`
--

CREATE TABLE `meters5` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `serialnumber` text NOT NULL,
  `size` text DEFAULT NULL,
  `account` text NOT NULL,
  `status` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meters6`
--

CREATE TABLE `meters6` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `serialnumber` text NOT NULL,
  `size` text DEFAULT NULL,
  `account` text NOT NULL,
  `status` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meters7`
--

CREATE TABLE `meters7` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `serialnumber` text NOT NULL,
  `size` text DEFAULT NULL,
  `account` text NOT NULL,
  `status` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meters8`
--

CREATE TABLE `meters8` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `serialnumber` text NOT NULL,
  `size` text DEFAULT NULL,
  `account` text NOT NULL,
  `status` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meters9`
--

CREATE TABLE `meters9` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `serialnumber` text NOT NULL,
  `size` text DEFAULT NULL,
  `account` text NOT NULL,
  `status` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meters10`
--

CREATE TABLE `meters10` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `serialnumber` text NOT NULL,
  `size` text DEFAULT NULL,
  `account` text NOT NULL,
  `status` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meters100`
--

CREATE TABLE `meters100` (
  `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `serialnumber` text NOT NULL,
  `size` text DEFAULT NULL,
  `account` text NOT NULL,
  `status` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metertrail`
--

CREATE TABLE `metertrail` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `account` text NOT NULL,
  `activity` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newbill`
--

CREATE TABLE `newbill` (
  `identity` text NOT NULL,
  `account` text NOT NULL,
  `units` float NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonwaterbills1`
--

CREATE TABLE `nonwaterbills1` (
  `account` text NOT NULL,
  `meternumber` text NOT NULL,
  `name` text NOT NULL,
  `amount` double NOT NULL,
  `date` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonwaterbills2`
--

CREATE TABLE `nonwaterbills2` (
  `account` text NOT NULL,
  `meternumber` text NOT NULL,
  `name` text NOT NULL,
  `amount` double NOT NULL,
  `date` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonwaterbills3`
--

CREATE TABLE `nonwaterbills3` (
  `account` text NOT NULL,
  `meternumber` text NOT NULL,
  `name` text NOT NULL,
  `amount` double NOT NULL,
  `date` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonwaterbills4`
--

CREATE TABLE `nonwaterbills4` (
  `account` text NOT NULL,
  `meternumber` text NOT NULL,
  `name` text NOT NULL,
  `amount` double NOT NULL,
  `date` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonwaterbills5`
--

CREATE TABLE `nonwaterbills5` (
  `account` text NOT NULL,
  `meternumber` text NOT NULL,
  `name` text NOT NULL,
  `amount` double NOT NULL,
  `date` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonwaterbills6`
--

CREATE TABLE `nonwaterbills6` (
  `account` text NOT NULL,
  `meternumber` text NOT NULL,
  `name` text NOT NULL,
  `amount` double NOT NULL,
  `date` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonwaterbills7`
--

CREATE TABLE `nonwaterbills7` (
  `account` text NOT NULL,
  `meternumber` text NOT NULL,
  `name` text NOT NULL,
  `amount` double NOT NULL,
  `date` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonwaterbills8`
--

CREATE TABLE `nonwaterbills8` (
  `account` text NOT NULL,
  `meternumber` text NOT NULL,
  `name` text NOT NULL,
  `amount` double NOT NULL,
  `date` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonwaterbills9`
--

CREATE TABLE `nonwaterbills9` (
  `account` text NOT NULL,
  `meternumber` text NOT NULL,
  `name` text NOT NULL,
  `amount` double NOT NULL,
  `date` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonwaterbills10`
--

CREATE TABLE `nonwaterbills10` (
  `account` text NOT NULL,
  `meternumber` text NOT NULL,
  `name` text NOT NULL,
  `amount` double NOT NULL,
  `date` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonwaterbills100`
--

CREATE TABLE `nonwaterbills100` (
  `account` text NOT NULL,
  `meternumber` text NOT NULL,
  `name` text NOT NULL,
  `amount` double NOT NULL,
  `date` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offline`
--

CREATE TABLE `offline` (
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `E` text NOT NULL,
  `F` text NOT NULL,
  `G` text NOT NULL,
  `H` text NOT NULL,
  `I` text NOT NULL,
  `J` text NOT NULL,
  `K` text NOT NULL,
  `L` text NOT NULL,
  `M` text NOT NULL,
  `N` text NOT NULL,
  `O` text NOT NULL,
  `P` text NOT NULL,
  `Q` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `opentable1`
--

CREATE TABLE `opentable1` (
  `id` int(11) NOT NULL,
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `E` text NOT NULL,
  `F` text NOT NULL,
  `G` text NOT NULL,
  `H` text NOT NULL,
  `J` text NOT NULL,
  `K` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outbox`
--

CREATE TABLE `outbox` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `contact` text NOT NULL,
  `message` text NOT NULL,
  `status` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `PAYMENT`
--

CREATE TABLE `PAYMENT` (
  `ACCOUNT` text DEFAULT NULL,
  `AMOUNT` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentcode`
--

CREATE TABLE `paymentcode` (
  `code` text NOT NULL,
  `name` text NOT NULL,
  `effect` text NOT NULL,
  `dbcode` text NOT NULL,
  `charges` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productionmeters`
--

CREATE TABLE `productionmeters` (
  `id` int(11) NOT NULL,
  `refferencenumber` text NOT NULL,
  `location` text NOT NULL,
  `reading` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchasesrequisition`
--

CREATE TABLE `purchasesrequisition` (
  `id` int(11) NOT NULL,
  `serialnumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `item` text NOT NULL,
  `quantity` float NOT NULL,
  `units` text NOT NULL,
  `prevbalance` int(11) NOT NULL,
  `price` float NOT NULL,
  `value` float NOT NULL,
  `purpose` text NOT NULL,
  `requester` text NOT NULL,
  `requestertitle` text NOT NULL,
  `checker` text NOT NULL,
  `checkertitle` text NOT NULL,
  `confirmer` text NOT NULL,
  `confirmertitle` text NOT NULL,
  `approver` text NOT NULL,
  `approvertitle` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotationrequests`
--

CREATE TABLE `quotationrequests` (
  `id` int(11) NOT NULL,
  `serialnumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `quantity` float NOT NULL,
  `supplier` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reciept`
--

CREATE TABLE `reciept` (
  `id` int(11) NOT NULL,
  `item` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `quantity` text DEFAULT NULL,
  `total` text DEFAULT NULL,
  `refference` int(6) UNSIGNED ZEROFILL NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repairs`
--

CREATE TABLE `repairs` (
  `id` int(11) NOT NULL,
  `location` text NOT NULL,
  `long` text NOT NULL,
  `latt` text NOT NULL,
  `ticket` text NOT NULL,
  `status` text NOT NULL,
  `damages` text NOT NULL,
  `reportdate` date NOT NULL,
  `completiondate` date NOT NULL,
  `technician` text NOT NULL,
  `materials` text NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `account` bigint(20) NOT NULL,
  `credit` float NOT NULL,
  `debit` float NOT NULL,
  `cubic` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `REPORT1`
--

CREATE TABLE `REPORT1` (
  `ACCOUNT` text DEFAULT NULL,
  `CREDIT` float DEFAULT NULL,
  `DEBIT` float DEFAULT NULL,
  `CUBIC` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requisition`
--

CREATE TABLE `requisition` (
  `id` int(11) NOT NULL,
  `serialnumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `itemcode` text NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `quantity` float NOT NULL,
  `value` float NOT NULL,
  `purpose` text NOT NULL,
  `requisitioner` text NOT NULL,
  `requisitionertitle` text NOT NULL,
  `authorizer` text NOT NULL,
  `authorizertitle` text NOT NULL,
  `issuer` text NOT NULL,
  `issuertitle` text NOT NULL,
  `approver` text NOT NULL,
  `approvertitle` text NOT NULL,
  `status` text NOT NULL,
  `transactionreff` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `revenue`
--

CREATE TABLE `revenue` (
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `E` text NOT NULL,
  `F` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `item` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `quantity` text DEFAULT NULL,
  `total` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE `search` (
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `E` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` bigint(20) NOT NULL,
  `account` text NOT NULL,
  `previous` float NOT NULL,
  `current` float NOT NULL,
  `consumtion` float NOT NULL,
  `bill` float NOT NULL,
  `balbf` float NOT NULL,
  `totalbill` float NOT NULL,
  `date` date NOT NULL,
  `billid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `idnumber` int(11) NOT NULL,
  `name` text NOT NULL,
  `amount` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statement`
--

CREATE TABLE `statement` (
  `A` text DEFAULT NULL,
  `B` text DEFAULT NULL,
  `C` text DEFAULT NULL,
  `D` text DEFAULT NULL,
  `E` text DEFAULT NULL,
  `F` text DEFAULT NULL,
  `G` text DEFAULT NULL,
  `H` text DEFAULT NULL,
  `I` text NOT NULL,
  `transaction` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statushistory1`
--

CREATE TABLE `statushistory1` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `meter` text NOT NULL,
  `status` text NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statushistory2`
--

CREATE TABLE `statushistory2` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `meter` text NOT NULL,
  `status` text NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statushistory3`
--

CREATE TABLE `statushistory3` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `meter` text NOT NULL,
  `status` text NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statushistory4`
--

CREATE TABLE `statushistory4` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `meter` text NOT NULL,
  `status` text NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statushistory5`
--

CREATE TABLE `statushistory5` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `meter` text NOT NULL,
  `status` text NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statushistory6`
--

CREATE TABLE `statushistory6` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `meter` text NOT NULL,
  `status` text NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statushistory7`
--

CREATE TABLE `statushistory7` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `meter` text NOT NULL,
  `status` text NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statushistory8`
--

CREATE TABLE `statushistory8` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `meter` text NOT NULL,
  `status` text NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statushistory9`
--

CREATE TABLE `statushistory9` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `meter` text NOT NULL,
  `status` text NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statushistory10`
--

CREATE TABLE `statushistory10` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `meter` text NOT NULL,
  `status` text NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statushistory100`
--

CREATE TABLE `statushistory100` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `meter` text NOT NULL,
  `status` text NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statustrail`
--

CREATE TABLE `statustrail` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `zone` text NOT NULL,
  `status` text NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `id` int(11) NOT NULL,
  `itemcode` text NOT NULL,
  `item` text DEFAULT NULL,
  `locality` text NOT NULL,
  `units` text NOT NULL,
  `quantity` float DEFAULT NULL,
  `unitprice` float NOT NULL,
  `price` float NOT NULL,
  `batchnumber` text DEFAULT NULL,
  `expire` date DEFAULT NULL,
  `ordernumber` text NOT NULL,
  `invoicenumber` text DEFAULT NULL,
  `vouchernumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `supplier` text DEFAULT NULL,
  `department` text NOT NULL,
  `delivery` text NOT NULL,
  `deliverydesignation` text NOT NULL,
  `receipient` text NOT NULL,
  `receipientdesignation` text NOT NULL,
  `stockbalance` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stockout`
--

CREATE TABLE `stockout` (
  `id` int(11) NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `quantity` float NOT NULL,
  `transactionreff` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplierpayment`
--

CREATE TABLE `supplierpayment` (
  `id` int(11) NOT NULL,
  `supplier` text NOT NULL,
  `paymode` text NOT NULL,
  `payrefference` text NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `supplier` text DEFAULT NULL,
  `boxaddress` text NOT NULL,
  `phonenumber` text NOT NULL,
  `email` text NOT NULL,
  `balance` text NOT NULL,
  `debit` float NOT NULL,
  `credit` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket` int(4) UNSIGNED ZEROFILL NOT NULL,
  `account` text NOT NULL,
  `contact` text NOT NULL,
  `complain` text NOT NULL,
  `category` text NOT NULL,
  `assign` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `access` text NOT NULL,
  `logged` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wateraccounts`
--

CREATE TABLE `wateraccounts` (
  `transaction` text DEFAULT NULL,
  `credit` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wateraccounts1`
--

CREATE TABLE `wateraccounts1` (
  `id` int(11) NOT NULL,
  `transaction` text DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `linked` text NOT NULL,
  `recieptnumber` text NOT NULL,
  `recieptdate` date NOT NULL,
  `paypoint` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wateraccounts2`
--

CREATE TABLE `wateraccounts2` (
  `id` int(11) NOT NULL,
  `transaction` text DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `linked` text NOT NULL,
  `recieptnumber` text NOT NULL,
  `recieptdate` date NOT NULL,
  `paypoint` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wateraccounts3`
--

CREATE TABLE `wateraccounts3` (
  `id` int(11) NOT NULL,
  `transaction` text DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `linked` text NOT NULL,
  `recieptnumber` text NOT NULL,
  `recieptdate` date NOT NULL,
  `paypoint` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wateraccounts4`
--

CREATE TABLE `wateraccounts4` (
  `id` int(11) NOT NULL,
  `transaction` text DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `linked` text NOT NULL,
  `recieptnumber` text NOT NULL,
  `recieptdate` date NOT NULL,
  `paypoint` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wateraccounts5`
--

CREATE TABLE `wateraccounts5` (
  `id` int(11) NOT NULL,
  `transaction` text DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `linked` text NOT NULL,
  `recieptnumber` text NOT NULL,
  `recieptdate` date NOT NULL,
  `paypoint` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wateraccounts6`
--

CREATE TABLE `wateraccounts6` (
  `id` int(11) NOT NULL,
  `transaction` text DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `linked` text NOT NULL,
  `recieptnumber` text NOT NULL,
  `recieptdate` date NOT NULL,
  `paypoint` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wateraccounts7`
--

CREATE TABLE `wateraccounts7` (
  `id` int(11) NOT NULL,
  `transaction` text DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `linked` text NOT NULL,
  `recieptnumber` text NOT NULL,
  `recieptdate` date NOT NULL,
  `paypoint` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wateraccounts8`
--

CREATE TABLE `wateraccounts8` (
  `id` int(11) NOT NULL,
  `transaction` text DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `linked` text NOT NULL,
  `recieptnumber` text NOT NULL,
  `recieptdate` date NOT NULL,
  `paypoint` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wateraccounts9`
--

CREATE TABLE `wateraccounts9` (
  `id` int(11) NOT NULL,
  `transaction` text DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `linked` text NOT NULL,
  `recieptnumber` text NOT NULL,
  `recieptdate` date NOT NULL,
  `paypoint` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wateraccounts10`
--

CREATE TABLE `wateraccounts10` (
  `id` int(11) NOT NULL,
  `transaction` text DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `linked` text NOT NULL,
  `recieptnumber` text NOT NULL,
  `recieptdate` date NOT NULL,
  `paypoint` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wateraccounts100`
--

CREATE TABLE `wateraccounts100` (
  `id` int(11) NOT NULL,
  `transaction` text DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `linked` text NOT NULL,
  `recieptnumber` text NOT NULL,
  `recieptdate` date NOT NULL,
  `paypoint` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `waterbillingrates`
--

CREATE TABLE `waterbillingrates` (
  `id` int(11) NOT NULL,
  `class` text NOT NULL,
  `rate` float NOT NULL,
  `standingcharges` float NOT NULL,
  `commission` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `waterflow`
--

CREATE TABLE `waterflow` (
  `flow` text NOT NULL,
  `inflow` text NOT NULL,
  `outflow` int(11) NOT NULL,
  `collection` float NOT NULL,
  `revenue` float NOT NULL,
  `billed` float NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `zone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `waterproduction`
--

CREATE TABLE `waterproduction` (
  `id` int(11) NOT NULL,
  `refferencenumber` text NOT NULL,
  `location` text NOT NULL,
  `previous` float NOT NULL,
  `current` float NOT NULL,
  `units` float NOT NULL,
  `chlorine` float NOT NULL,
  `price` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `XXX`
--

CREATE TABLE `XXX` (
  `ACCOUNT` text DEFAULT NULL,
  `CLASS` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `zone` text NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts1`
--
ALTER TABLE `accounts1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts2`
--
ALTER TABLE `accounts2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts3`
--
ALTER TABLE `accounts3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts4`
--
ALTER TABLE `accounts4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts5`
--
ALTER TABLE `accounts5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts6`
--
ALTER TABLE `accounts6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts7`
--
ALTER TABLE `accounts7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts8`
--
ALTER TABLE `accounts8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts9`
--
ALTER TABLE `accounts9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts10`
--
ALTER TABLE `accounts10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts100`
--
ALTER TABLE `accounts100`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accountsstatus`
--
ALTER TABLE `accountsstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adjustment`
--
ALTER TABLE `adjustment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advancedsalary`
--
ALTER TABLE `advancedsalary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balance3`
--
ALTER TABLE `balance3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `BALANCEREPORT`
--
ALTER TABLE `BALANCEREPORT`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `bills1`
--
ALTER TABLE `bills1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills2`
--
ALTER TABLE `bills2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills3`
--
ALTER TABLE `bills3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills4`
--
ALTER TABLE `bills4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills5`
--
ALTER TABLE `bills5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills6`
--
ALTER TABLE `bills6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills7`
--
ALTER TABLE `bills7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills8`
--
ALTER TABLE `bills8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills9`
--
ALTER TABLE `bills9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills10`
--
ALTER TABLE `bills10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills100`
--
ALTER TABLE `bills100`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billsanalysis`
--
ALTER TABLE `billsanalysis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CHARGES`
--
ALTER TABLE `CHARGES`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientmetersreg`
--
ALTER TABLE `clientmetersreg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clock`
--
ALTER TABLE `clock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumeranalysis`
--
ALTER TABLE `consumeranalysis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `damages`
--
ALTER TABLE `damages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `damagesregistry`
--
ALTER TABLE `damagesregistry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debtpay`
--
ALTER TABLE `debtpay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debtregistry`
--
ALTER TABLE `debtregistry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposituploads`
--
ALTER TABLE `deposituploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gatepass`
--
ALTER TABLE `gatepass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeterbill1`
--
ALTER TABLE `mastermeterbill1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeterbill2`
--
ALTER TABLE `mastermeterbill2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeterbill3`
--
ALTER TABLE `mastermeterbill3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeterbill4`
--
ALTER TABLE `mastermeterbill4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeterbill5`
--
ALTER TABLE `mastermeterbill5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeterbill6`
--
ALTER TABLE `mastermeterbill6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeterbill7`
--
ALTER TABLE `mastermeterbill7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeterbill8`
--
ALTER TABLE `mastermeterbill8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeterbill9`
--
ALTER TABLE `mastermeterbill9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeterbill10`
--
ALTER TABLE `mastermeterbill10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeterbill100`
--
ALTER TABLE `mastermeterbill100`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeters1`
--
ALTER TABLE `mastermeters1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeters2`
--
ALTER TABLE `mastermeters2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeters3`
--
ALTER TABLE `mastermeters3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeters4`
--
ALTER TABLE `mastermeters4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeters5`
--
ALTER TABLE `mastermeters5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeters6`
--
ALTER TABLE `mastermeters6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeters7`
--
ALTER TABLE `mastermeters7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeters8`
--
ALTER TABLE `mastermeters8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeters9`
--
ALTER TABLE `mastermeters9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeters10`
--
ALTER TABLE `mastermeters10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastermeters100`
--
ALTER TABLE `mastermeters100`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters1`
--
ALTER TABLE `meters1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters2`
--
ALTER TABLE `meters2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters3`
--
ALTER TABLE `meters3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters4`
--
ALTER TABLE `meters4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters5`
--
ALTER TABLE `meters5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters6`
--
ALTER TABLE `meters6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters7`
--
ALTER TABLE `meters7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters8`
--
ALTER TABLE `meters8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters9`
--
ALTER TABLE `meters9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters10`
--
ALTER TABLE `meters10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters100`
--
ALTER TABLE `meters100`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metertrail`
--
ALTER TABLE `metertrail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nonwaterbills1`
--
ALTER TABLE `nonwaterbills1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nonwaterbills2`
--
ALTER TABLE `nonwaterbills2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nonwaterbills3`
--
ALTER TABLE `nonwaterbills3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nonwaterbills4`
--
ALTER TABLE `nonwaterbills4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nonwaterbills5`
--
ALTER TABLE `nonwaterbills5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nonwaterbills6`
--
ALTER TABLE `nonwaterbills6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nonwaterbills7`
--
ALTER TABLE `nonwaterbills7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nonwaterbills8`
--
ALTER TABLE `nonwaterbills8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nonwaterbills9`
--
ALTER TABLE `nonwaterbills9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nonwaterbills10`
--
ALTER TABLE `nonwaterbills10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nonwaterbills100`
--
ALTER TABLE `nonwaterbills100`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opentable1`
--
ALTER TABLE `opentable1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outbox`
--
ALTER TABLE `outbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productionmeters`
--
ALTER TABLE `productionmeters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reciept`
--
ALTER TABLE `reciept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repairs`
--
ALTER TABLE `repairs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisition`
--
ALTER TABLE `requisition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search`
--
ALTER TABLE `search`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statement`
--
ALTER TABLE `statement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statushistory1`
--
ALTER TABLE `statushistory1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statushistory2`
--
ALTER TABLE `statushistory2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statushistory3`
--
ALTER TABLE `statushistory3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statushistory4`
--
ALTER TABLE `statushistory4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statushistory5`
--
ALTER TABLE `statushistory5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statushistory6`
--
ALTER TABLE `statushistory6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statushistory7`
--
ALTER TABLE `statushistory7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statushistory8`
--
ALTER TABLE `statushistory8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statushistory9`
--
ALTER TABLE `statushistory9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statushistory10`
--
ALTER TABLE `statushistory10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statushistory100`
--
ALTER TABLE `statushistory100`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statustrail`
--
ALTER TABLE `statustrail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockout`
--
ALTER TABLE `stockout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplierpayment`
--
ALTER TABLE `supplierpayment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wateraccounts`
--
ALTER TABLE `wateraccounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wateraccounts1`
--
ALTER TABLE `wateraccounts1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wateraccounts2`
--
ALTER TABLE `wateraccounts2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wateraccounts3`
--
ALTER TABLE `wateraccounts3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wateraccounts4`
--
ALTER TABLE `wateraccounts4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wateraccounts5`
--
ALTER TABLE `wateraccounts5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wateraccounts6`
--
ALTER TABLE `wateraccounts6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wateraccounts7`
--
ALTER TABLE `wateraccounts7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wateraccounts8`
--
ALTER TABLE `wateraccounts8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wateraccounts9`
--
ALTER TABLE `wateraccounts9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wateraccounts10`
--
ALTER TABLE `wateraccounts10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wateraccounts100`
--
ALTER TABLE `wateraccounts100`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waterbillingrates`
--
ALTER TABLE `waterbillingrates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waterproduction`
--
ALTER TABLE `waterproduction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts1`
--
ALTER TABLE `accounts1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts2`
--
ALTER TABLE `accounts2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts3`
--
ALTER TABLE `accounts3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts4`
--
ALTER TABLE `accounts4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts5`
--
ALTER TABLE `accounts5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts6`
--
ALTER TABLE `accounts6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts7`
--
ALTER TABLE `accounts7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts8`
--
ALTER TABLE `accounts8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts9`
--
ALTER TABLE `accounts9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts10`
--
ALTER TABLE `accounts10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts100`
--
ALTER TABLE `accounts100`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accountsstatus`
--
ALTER TABLE `accountsstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adjustment`
--
ALTER TABLE `adjustment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advancedsalary`
--
ALTER TABLE `advancedsalary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balance3`
--
ALTER TABLE `balance3`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BALANCEREPORT`
--
ALTER TABLE `BALANCEREPORT`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills1`
--
ALTER TABLE `bills1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills2`
--
ALTER TABLE `bills2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills3`
--
ALTER TABLE `bills3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills4`
--
ALTER TABLE `bills4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills5`
--
ALTER TABLE `bills5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills6`
--
ALTER TABLE `bills6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills7`
--
ALTER TABLE `bills7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills8`
--
ALTER TABLE `bills8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills9`
--
ALTER TABLE `bills9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills10`
--
ALTER TABLE `bills10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills100`
--
ALTER TABLE `bills100`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billsanalysis`
--
ALTER TABLE `billsanalysis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CHARGES`
--
ALTER TABLE `CHARGES`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clientmetersreg`
--
ALTER TABLE `clientmetersreg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clock`
--
ALTER TABLE `clock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consumeranalysis`
--
ALTER TABLE `consumeranalysis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `damages`
--
ALTER TABLE `damages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `damagesregistry`
--
ALTER TABLE `damagesregistry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debtpay`
--
ALTER TABLE `debtpay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debtregistry`
--
ALTER TABLE `debtregistry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposituploads`
--
ALTER TABLE `deposituploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gatepass`
--
ALTER TABLE `gatepass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeterbill1`
--
ALTER TABLE `mastermeterbill1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeterbill2`
--
ALTER TABLE `mastermeterbill2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeterbill3`
--
ALTER TABLE `mastermeterbill3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeterbill4`
--
ALTER TABLE `mastermeterbill4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeterbill5`
--
ALTER TABLE `mastermeterbill5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeterbill6`
--
ALTER TABLE `mastermeterbill6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeterbill7`
--
ALTER TABLE `mastermeterbill7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeterbill8`
--
ALTER TABLE `mastermeterbill8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeterbill9`
--
ALTER TABLE `mastermeterbill9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeterbill10`
--
ALTER TABLE `mastermeterbill10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeterbill100`
--
ALTER TABLE `mastermeterbill100`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeters1`
--
ALTER TABLE `mastermeters1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeters2`
--
ALTER TABLE `mastermeters2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeters3`
--
ALTER TABLE `mastermeters3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeters4`
--
ALTER TABLE `mastermeters4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeters5`
--
ALTER TABLE `mastermeters5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeters6`
--
ALTER TABLE `mastermeters6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeters7`
--
ALTER TABLE `mastermeters7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeters8`
--
ALTER TABLE `mastermeters8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeters9`
--
ALTER TABLE `mastermeters9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeters10`
--
ALTER TABLE `mastermeters10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastermeters100`
--
ALTER TABLE `mastermeters100`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meters1`
--
ALTER TABLE `meters1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meters2`
--
ALTER TABLE `meters2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meters3`
--
ALTER TABLE `meters3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meters4`
--
ALTER TABLE `meters4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meters5`
--
ALTER TABLE `meters5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meters6`
--
ALTER TABLE `meters6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meters7`
--
ALTER TABLE `meters7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meters8`
--
ALTER TABLE `meters8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meters9`
--
ALTER TABLE `meters9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meters10`
--
ALTER TABLE `meters10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meters100`
--
ALTER TABLE `meters100`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metertrail`
--
ALTER TABLE `metertrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonwaterbills1`
--
ALTER TABLE `nonwaterbills1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonwaterbills2`
--
ALTER TABLE `nonwaterbills2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonwaterbills3`
--
ALTER TABLE `nonwaterbills3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonwaterbills4`
--
ALTER TABLE `nonwaterbills4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonwaterbills5`
--
ALTER TABLE `nonwaterbills5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonwaterbills6`
--
ALTER TABLE `nonwaterbills6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonwaterbills7`
--
ALTER TABLE `nonwaterbills7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonwaterbills8`
--
ALTER TABLE `nonwaterbills8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonwaterbills9`
--
ALTER TABLE `nonwaterbills9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonwaterbills10`
--
ALTER TABLE `nonwaterbills10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonwaterbills100`
--
ALTER TABLE `nonwaterbills100`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opentable1`
--
ALTER TABLE `opentable1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outbox`
--
ALTER TABLE `outbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productionmeters`
--
ALTER TABLE `productionmeters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reciept`
--
ALTER TABLE `reciept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repairs`
--
ALTER TABLE `repairs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requisition`
--
ALTER TABLE `requisition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `search`
--
ALTER TABLE `search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statement`
--
ALTER TABLE `statement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statushistory1`
--
ALTER TABLE `statushistory1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statushistory2`
--
ALTER TABLE `statushistory2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statushistory3`
--
ALTER TABLE `statushistory3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statushistory4`
--
ALTER TABLE `statushistory4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statushistory5`
--
ALTER TABLE `statushistory5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statushistory6`
--
ALTER TABLE `statushistory6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statushistory7`
--
ALTER TABLE `statushistory7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statushistory8`
--
ALTER TABLE `statushistory8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statushistory9`
--
ALTER TABLE `statushistory9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statushistory10`
--
ALTER TABLE `statushistory10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statushistory100`
--
ALTER TABLE `statushistory100`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statustrail`
--
ALTER TABLE `statustrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stockout`
--
ALTER TABLE `stockout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplierpayment`
--
ALTER TABLE `supplierpayment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wateraccounts`
--
ALTER TABLE `wateraccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wateraccounts1`
--
ALTER TABLE `wateraccounts1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wateraccounts2`
--
ALTER TABLE `wateraccounts2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wateraccounts3`
--
ALTER TABLE `wateraccounts3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wateraccounts4`
--
ALTER TABLE `wateraccounts4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wateraccounts5`
--
ALTER TABLE `wateraccounts5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wateraccounts6`
--
ALTER TABLE `wateraccounts6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wateraccounts7`
--
ALTER TABLE `wateraccounts7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wateraccounts8`
--
ALTER TABLE `wateraccounts8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wateraccounts9`
--
ALTER TABLE `wateraccounts9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wateraccounts10`
--
ALTER TABLE `wateraccounts10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wateraccounts100`
--
ALTER TABLE `wateraccounts100`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `waterbillingrates`
--
ALTER TABLE `waterbillingrates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `waterproduction`
--
ALTER TABLE `waterproduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
