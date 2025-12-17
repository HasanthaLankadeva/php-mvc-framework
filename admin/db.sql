-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2023 at 07:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sktechnicalfabrics`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `id` int(10) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `username`, `password`, `email`, `type`, `created_at`) VALUES
(1, 'hasantha', '$2y$10$UYlnQwzqf4aYqyWUj1iW/eTW1auGLcqJsiFb9F8ABaAi8PtT/iJ2u', 'hasantha88@gmail.com', 'super-admin', '2023-07-09 14:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(10) NOT NULL,
  `lanID` varchar(10) DEFAULT NULL,
  `module` varchar(200) NOT NULL,
  `itemID` int(10) NOT NULL,
  `attachment` varchar(5000) NOT NULL,
  `attTitle` varchar(1000) DEFAULT NULL,
  `attDes` text DEFAULT NULL,
  `alt` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `lanID`, `module`, `itemID`, `attachment`, `attTitle`, `attDes`, `alt`) VALUES
(5, 'en', 'module_home_page', 4382, 'img/uploads/banner-1.jpg', 'Revolutionizing fabrics to meet the demands of our current world', '', ''),
(6, 'en', 'module_home_page', 4382, 'img/uploads/banner-2.jpg', 'Revolutionizing fabrics to meet the demands of our current world', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `rowOrder` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `module` varchar(100) DEFAULT NULL,
  `categoryTitle` varchar(100) DEFAULT NULL,
  `categoryKey` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `rowOrder`, `status`, `module`, `categoryTitle`, `categoryKey`) VALUES
(1, 0, 'published', 'module_metadata', 'Home Page', 'page_home'),
(2, 0, 'published', 'module_metadata', 'About Us Page', 'page_about'),
(3, 0, 'published', 'module_metadata', 'Products Page', 'page_products'),
(4, 0, 'published', 'module_metadata', 'Events Page', 'page_events'),
(5, 0, 'published', 'module_metadata', 'Contact Ue Page', 'page_contact');

-- --------------------------------------------------------

--
-- Table structure for table `module_about`
--

CREATE TABLE `module_about` (
  `id` int(10) NOT NULL,
  `rowOrder` int(10) NOT NULL,
  `status` varchar(100) NOT NULL,
  `itemID` int(10) NOT NULL,
  `lanID` varchar(10) NOT NULL,
  `itemTitle` varchar(500) DEFAULT NULL,
  `itemImage` varchar(200) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `contentOne` text DEFAULT NULL,
  `contentTwo` text DEFAULT NULL,
  `lineOne` varchar(1000) DEFAULT NULL,
  `lineTwo` varchar(1000) DEFAULT NULL,
  `lineThree` varchar(1000) DEFAULT NULL,
  `lineFour` varchar(1000) DEFAULT NULL,
  `lineFive` varchar(1000) DEFAULT NULL,
  `lineSix` varchar(1000) DEFAULT NULL,
  `lineSeven` varchar(1000) DEFAULT NULL,
  `lineEight` varchar(1000) DEFAULT NULL,
  `lineNine` varchar(1000) DEFAULT NULL,
  `lineTen` varchar(1000) DEFAULT NULL,
  `lineEleven` varchar(500) DEFAULT NULL,
  `lineTwelve` varchar(500) DEFAULT NULL,
  `lineThirteen` varchar(500) DEFAULT NULL,
  `lineFourteen` varchar(500) DEFAULT NULL,
  `lineFifteen` varchar(500) DEFAULT NULL,
  `itemKey` varchar(500) DEFAULT NULL,
  `itemCategory` varchar(500) DEFAULT NULL,
  `mapping` varchar(100) NOT NULL,
  `attachments` mediumtext DEFAULT NULL,
  `startDate` varchar(20) NOT NULL,
  `endDate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_about`
--

INSERT INTO `module_about` (`id`, `rowOrder`, `status`, `itemID`, `lanID`, `itemTitle`, `itemImage`, `content`, `contentOne`, `contentTwo`, `lineOne`, `lineTwo`, `lineThree`, `lineFour`, `lineFive`, `lineSix`, `lineSeven`, `lineEight`, `lineNine`, `lineTen`, `lineEleven`, `lineTwelve`, `lineThirteen`, `lineFourteen`, `lineFifteen`, `itemKey`, `itemCategory`, `mapping`, `attachments`, `startDate`, `endDate`) VALUES
(0, 0, 'published', 1806, 'en', 'About Us', 'img/uploads/about.jpg', '<p>SK Technical Fabrics and Finishes explores the intersection between fashion and technology. The company uses modern technologies to create high-performance clothing that is functional and kind to the environment.&nbsp;</p>\r\n<p>Research and development is the core of our company and we use science and innovative engineering to create new products that align with customer demands in a changing environment. Our company offers unique market-ready product offerings. In addition to products, we also provide our R&amp;D facilities to assist clients in researching and developing new technologies.</p>\r\n<p>SK Technical Fabrics and Finishes is a vertically integrated company with SK Weaving and provides a one-stop shop from fabrics to finished garments.&nbsp;</p>\r\n<p>Over the last three decades, the SK Group of Companies has built a reputation of quality and trust with major retailers in the EU and North America.</p>', '<ul>\r\n<li>Hemp</li>\r\n<li>Hemp/Linen Blends</li>\r\n<li>Viscose Dobbies and Jacquards</li>\r\n<li>Viscose/Cotton Blend Fabrics</li>\r\n</ul>', '<ul>\r\n<li>Viscose/Cotton/Linen Blend Fabrics 100%</li>\r\n<li>Modal, Viscose/Cotton Yarn Dyes, Viscose</li>\r\n<li>Satins, Viscose, Cotton Crepe Fabrics</li>\r\n<li>Bamboo Fabrics</li>\r\n</ul>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `module_events`
--

CREATE TABLE `module_events` (
  `id` int(10) NOT NULL,
  `rowOrder` int(10) NOT NULL,
  `status` varchar(100) NOT NULL,
  `itemID` int(10) NOT NULL,
  `lanID` varchar(10) NOT NULL,
  `itemTitle` varchar(500) DEFAULT NULL,
  `itemImage` varchar(200) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `contentOne` text DEFAULT NULL,
  `contentTwo` text DEFAULT NULL,
  `lineOne` varchar(1000) DEFAULT NULL,
  `lineTwo` varchar(1000) DEFAULT NULL,
  `lineThree` varchar(1000) DEFAULT NULL,
  `lineFour` varchar(1000) DEFAULT NULL,
  `lineFive` varchar(1000) DEFAULT NULL,
  `lineSix` varchar(1000) DEFAULT NULL,
  `lineSeven` varchar(1000) DEFAULT NULL,
  `lineEight` varchar(1000) DEFAULT NULL,
  `lineNine` varchar(1000) DEFAULT NULL,
  `lineTen` varchar(1000) DEFAULT NULL,
  `lineEleven` varchar(500) DEFAULT NULL,
  `lineTwelve` varchar(500) DEFAULT NULL,
  `lineThirteen` varchar(500) DEFAULT NULL,
  `lineFourteen` varchar(500) DEFAULT NULL,
  `lineFifteen` varchar(500) DEFAULT NULL,
  `itemKey` varchar(500) DEFAULT NULL,
  `itemCategory` varchar(500) DEFAULT NULL,
  `mapping` varchar(100) NOT NULL,
  `attachments` mediumtext DEFAULT NULL,
  `startDate` varchar(20) NOT NULL,
  `endDate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_events`
--

INSERT INTO `module_events` (`id`, `rowOrder`, `status`, `itemID`, `lanID`, `itemTitle`, `itemImage`, `content`, `contentOne`, `contentTwo`, `lineOne`, `lineTwo`, `lineThree`, `lineFour`, `lineFive`, `lineSix`, `lineSeven`, `lineEight`, `lineNine`, `lineTen`, `lineEleven`, `lineTwelve`, `lineThirteen`, `lineFourteen`, `lineFifteen`, `itemKey`, `itemCategory`, `mapping`, `attachments`, `startDate`, `endDate`) VALUES
(0, 0, 'published', 3592, 'en', 'THE JOURNEY TO CARBON NEUTRALITY', 'img/uploads/FFFSP-Day-One-Slider1.jpg', '<p>Our 2023 Focus Topic that will stretch across our 3 editions this year is The Journey to Carbon Neutrality&mdash;discussing the metrics, formulas, agencies and theories to quantify and measure the CO2 emissions for the fabrics used in our industry.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '2023-07-18', '2023-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `module_home_page`
--

CREATE TABLE `module_home_page` (
  `id` int(10) NOT NULL,
  `rowOrder` int(10) NOT NULL,
  `status` varchar(100) NOT NULL,
  `itemID` int(10) NOT NULL,
  `lanID` varchar(10) NOT NULL,
  `itemTitle` varchar(500) DEFAULT NULL,
  `itemImage` varchar(200) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `contentOne` text DEFAULT NULL,
  `contentTwo` text DEFAULT NULL,
  `lineOne` varchar(1000) DEFAULT NULL,
  `lineTwo` varchar(1000) DEFAULT NULL,
  `lineThree` varchar(1000) DEFAULT NULL,
  `lineFour` varchar(1000) DEFAULT NULL,
  `lineFive` varchar(1000) DEFAULT NULL,
  `lineSix` varchar(1000) DEFAULT NULL,
  `lineSeven` varchar(1000) DEFAULT NULL,
  `lineEight` varchar(1000) DEFAULT NULL,
  `lineNine` varchar(1000) DEFAULT NULL,
  `lineTen` varchar(1000) DEFAULT NULL,
  `lineEleven` varchar(500) DEFAULT NULL,
  `lineTwelve` varchar(500) DEFAULT NULL,
  `lineThirteen` varchar(500) DEFAULT NULL,
  `lineFourteen` varchar(500) DEFAULT NULL,
  `lineFifteen` varchar(500) DEFAULT NULL,
  `itemKey` varchar(500) DEFAULT NULL,
  `itemCategory` varchar(500) DEFAULT NULL,
  `mapping` varchar(100) NOT NULL,
  `attachments` mediumtext DEFAULT NULL,
  `startDate` varchar(20) NOT NULL,
  `endDate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_home_page`
--

INSERT INTO `module_home_page` (`id`, `rowOrder`, `status`, `itemID`, `lanID`, `itemTitle`, `itemImage`, `content`, `contentOne`, `contentTwo`, `lineOne`, `lineTwo`, `lineThree`, `lineFour`, `lineFive`, `lineSix`, `lineSeven`, `lineEight`, `lineNine`, `lineTen`, `lineEleven`, `lineTwelve`, `lineThirteen`, `lineFourteen`, `lineFifteen`, `itemKey`, `itemCategory`, `mapping`, `attachments`, `startDate`, `endDate`) VALUES
(0, 0, 'published', 4382, 'en', 'About Us', '', '<p>SK Technical Fabrics and Finishes explores the intersection between fashion and technology. The company uses modern technologies to create high-performance clothing that is functional and kind to the environment. Research and development is the core of our company and we use science and innovative engineering to create new products that align with customer demands in a changing environment.</p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `module_metadata`
--

CREATE TABLE `module_metadata` (
  `id` int(10) NOT NULL,
  `rowOrder` int(10) NOT NULL,
  `status` varchar(100) NOT NULL,
  `itemID` int(10) NOT NULL,
  `lanID` varchar(10) NOT NULL,
  `itemTitle` varchar(500) DEFAULT NULL,
  `itemImage` varchar(200) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `contentOne` text DEFAULT NULL,
  `contentTwo` text DEFAULT NULL,
  `lineOne` varchar(1000) DEFAULT NULL,
  `lineTwo` varchar(1000) DEFAULT NULL,
  `lineThree` varchar(1000) DEFAULT NULL,
  `lineFour` varchar(1000) DEFAULT NULL,
  `lineFive` varchar(1000) DEFAULT NULL,
  `lineSix` varchar(1000) DEFAULT NULL,
  `lineSeven` varchar(1000) DEFAULT NULL,
  `lineEight` varchar(1000) DEFAULT NULL,
  `lineNine` varchar(1000) DEFAULT NULL,
  `lineTen` varchar(1000) DEFAULT NULL,
  `lineEleven` varchar(500) DEFAULT NULL,
  `lineTwelve` varchar(500) DEFAULT NULL,
  `lineThirteen` varchar(500) DEFAULT NULL,
  `lineFourteen` varchar(500) DEFAULT NULL,
  `lineFifteen` varchar(500) DEFAULT NULL,
  `itemKey` varchar(500) DEFAULT NULL,
  `itemCategory` varchar(500) DEFAULT NULL,
  `mapping` varchar(100) NOT NULL,
  `attachments` mediumtext DEFAULT NULL,
  `startDate` varchar(20) NOT NULL,
  `endDate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_metadata`
--

INSERT INTO `module_metadata` (`id`, `rowOrder`, `status`, `itemID`, `lanID`, `itemTitle`, `itemImage`, `content`, `contentOne`, `contentTwo`, `lineOne`, `lineTwo`, `lineThree`, `lineFour`, `lineFive`, `lineSix`, `lineSeven`, `lineEight`, `lineNine`, `lineTen`, `lineEleven`, `lineTwelve`, `lineThirteen`, `lineFourteen`, `lineFifteen`, `itemKey`, `itemCategory`, `mapping`, `attachments`, `startDate`, `endDate`) VALUES
(0, 0, 'published', 9297, 'en', 'SK Technical Fabrics - Home', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'page_home', '', NULL, '', ''),
(0, 0, 'published', 1574, 'en', 'SK Technical Fabrics - About Us', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'page_about', '', NULL, '', ''),
(0, 0, 'published', 4266, 'en', 'SK Technical Fabrics - Our Products', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'page_products', '', NULL, '', ''),
(0, 0, 'published', 8841, 'en', 'SK Technical Fabrics - Events', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'page_events', '', NULL, '', ''),
(0, 0, 'published', 2459, 'en', 'SK Technical Fabrics - Contact Us', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', ''),
(0, 0, 'published', 5640, 'en', 'SK Technical Fabrics - Contact Us', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'page_contact', '', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `module_products`
--

CREATE TABLE `module_products` (
  `id` int(10) NOT NULL,
  `rowOrder` int(10) NOT NULL,
  `status` varchar(100) NOT NULL,
  `itemID` int(10) NOT NULL,
  `lanID` varchar(10) NOT NULL,
  `itemTitle` varchar(500) DEFAULT NULL,
  `itemImage` varchar(200) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `contentOne` text DEFAULT NULL,
  `contentTwo` text DEFAULT NULL,
  `lineOne` varchar(1000) DEFAULT NULL,
  `lineTwo` varchar(1000) DEFAULT NULL,
  `lineThree` varchar(1000) DEFAULT NULL,
  `lineFour` varchar(1000) DEFAULT NULL,
  `lineFive` varchar(1000) DEFAULT NULL,
  `lineSix` varchar(1000) DEFAULT NULL,
  `lineSeven` varchar(1000) DEFAULT NULL,
  `lineEight` varchar(1000) DEFAULT NULL,
  `lineNine` varchar(1000) DEFAULT NULL,
  `lineTen` varchar(1000) DEFAULT NULL,
  `lineEleven` varchar(500) DEFAULT NULL,
  `lineTwelve` varchar(500) DEFAULT NULL,
  `lineThirteen` varchar(500) DEFAULT NULL,
  `lineFourteen` varchar(500) DEFAULT NULL,
  `lineFifteen` varchar(500) DEFAULT NULL,
  `itemKey` varchar(500) DEFAULT NULL,
  `itemCategory` varchar(500) DEFAULT NULL,
  `mapping` varchar(100) NOT NULL,
  `attachments` mediumtext DEFAULT NULL,
  `startDate` varchar(20) NOT NULL,
  `endDate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_products`
--

INSERT INTO `module_products` (`id`, `rowOrder`, `status`, `itemID`, `lanID`, `itemTitle`, `itemImage`, `content`, `contentOne`, `contentTwo`, `lineOne`, `lineTwo`, `lineThree`, `lineFour`, `lineFive`, `lineSix`, `lineSeven`, `lineEight`, `lineNine`, `lineTen`, `lineEleven`, `lineTwelve`, `lineThirteen`, `lineFourteen`, `lineFifteen`, `itemKey`, `itemCategory`, `mapping`, `attachments`, `startDate`, `endDate`) VALUES
(1, 0, 'published', 1924, 'en', 'StingOFF (™) Mosquito Repellent Fabric', 'img/uploads/pexels-photo-2070676.jpeg', '<p>StingOFF was created to provide an alternative to the current market mosquito repellent clothing which is 100% plant based without compromising on the performance.</p>', '<p>StingOFF was created to provide an alternative to the current market mosquito repellent clothing which is 100% plant based without compromising on the performance.</p>\n<p>Our finish combined with the 3D technology we use for application on fabrics makes sure that the finish does not touch the skin of the wearer as it is coated on the outside of the fabric.</p>\n<h3><strong>StingOFF fabrics are applicable for all outdoor activities</strong></h3>\n<p>StingOFF can be used for garments used in a variety of industries: Hiking, Camping Gear, and a variety of sports clothing ranging from Golf to Pickleball. to Soccer and Tennis</p>\n<h3><strong>How StingOFF keeps the mosquitos away?</strong></h3>\n<p>StingOFF is odorless for humans but mosquitoes have a 2000x smell sense than humans. Using this, SKTFF built a new innovative technology which is effective in a way that doesn&rsquo;t let mosquitoes near you. While the current technologies available in the market work as a contact repellent, StingOFF works directly on the insect&rsquo;s cuticle. StingOFF does this by dehydrating mosquitos and unlike many chemical insecticides such as current market offerings: Permethrin and DEET which act on the insects\' nervous systems.</p>\n<h3><strong>Why is StingOFF more effective than current market offerings?</strong></h3>\n<p>StingOFF is superior to current market offerings as it does not use DEET or Permethrin but an environmentally friendly, plant-based formulation.</p>\n<p>StingOFF is made using Geraniol as the active ingredient (CAS no. 106-24-1). Geraniol has remarkable properties with a subtle balance between performance, environmental friendliness and health. Geraniol is present in numerous fruits, vegetables, spices and essential oils and its properties&rsquo; versatility means that it can be found in many sectors: perfumes, food. Geraniol is also part of EPA exempted list of chemicals and can be used without needing the approval of EPA.</p>\n<p>Geraniol in its raw state is less effective than most neurotoxic chemical substances like DEET and Permethrin. But SKTFF has developed a formulation technology that increases the properties of Geraniol by ten fold while preserving the health and environmental benefits of Geraniol.</p>\n<h3><strong>Our testing proved after 30 washes an efficacy rate of 90% was retained</strong></h3>\n<p>StingOFF treated fabric was tested on an array of fabrics ranging from cotton to nylon to hemp and these results proved that this treatment is applicable on all fabrics.</p>\n<p>Efficacy rate is the amount of mosquitos repelled under the WHO certified hand in cage test. This test involves using 80 - 100 malaria mosquitos who are released in a cage and studying how they are landing or repelling off the treated fabric. Our testing was certified by multiple third party labs to confirm the effectiveness of our StingOFF treated fabric.</p>\n<p>Our overall efficacy and protection for fabrics ranging from cotton, viscose, polyester and hemp (and mixed blends) was above 96%. Some samples were tested after 10, 30, 50 washes followed AATCC-61 washing standard. Afterward, they were tested again using the &lsquo;Arm in Cage&rsquo; Test and efficacy and protection were above 90% for all samples.</p>', '', 'stingoff-mosquito-repellent-fabric', 'http://localhost/sktechnicalfabrics/admin/img/uploads/product1_image1.PNG', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', ''),
(2, 0, 'published', 6144, 'en', 'Graph-X (™) Temperature Controlled Fabric', 'img/uploads/pexels-photo-2070676.jpeg', '<p><span style=\"font-weight: 400;\">Graph-X was created to help customers have their own perfect personal temperature around their bodies and enjoy the outdoors comfortably.</span></p>', '<p><span style=\"font-weight: 400;\">Graph-X was created to help customers have their own perfect personal temperature around their bodies and enjoy the outdoors comfortably.</span></p>\r\n<p><span style=\"font-weight: 400;\">Graphene has properties that allow temperature control based on whether you feel hot or cold. </span><span style=\"font-weight: 400;\">Graphene is an extremely effective heat conductor material. It works to personalize climate control. The finish allows heat to dissipate to help to cool you down when hot. When it is cold, the heat is retained.</span></p>\r\n<h3><strong>Graph-X fabrics are applicable for all extreme weather activities&nbsp;</strong></h3>\r\n<p><span style=\"font-weight: 400;\">Textiles with self-thermoregulation can be useful for garments used in a variety of industries: Sportswear, Sleepwear and Protection Garments for workers in extreme conditions.&nbsp;</span></p>\r\n<h3><strong>Why is Graph-X more effective than current market offerings?</strong></h3>\r\n<p><span style=\"font-weight: 400;\">Current Market offerings in textiles have microencapsulated PCM; one of the biggest disadvantages of micro-encapsulated PCM is when they are applied during the manufacturing process they stain the fabric and after curing these leave a permanent mark on the fabric.&nbsp;</span></p>\r\n<p><span style=\"font-weight: 400;\">To offer an alternative without compromising on performance SK Technical Fabrics and Finishes came up with a graphene finish. Graph-X exhibits superior thermal conductivity and is an excellent material for thermal management.</span></p>\r\n<h3><strong>How Graph-X controls and sustains your body temperature?</strong></h3>\r\n<p><span style=\"font-weight: 400;\"><img src=\"/sktechnicalfabrics/admin/img/uploads/producttwo_image3.jpg\" />At the heart of it all is our enhanced water soluble vesicular patented technology with micellar properties, acting through (a) Process and (b) Formulation.</span></p>\r\n<p><span style=\"font-weight: 400;\">The micellar matrices used are 100% from the plant extracts characterized in the formulation for optimal loading of the hydrophobic plant extracts into the core.</span></p>\r\n<p><span style=\"font-weight: 400;\">The Process involves pushing the water insoluble plant -based extracts into the hydrophobic core of a micellar matrix with hydrophilic outer ring.</span></p>\r\n<p><span style=\"font-weight: 400;\">The hydrophilic surface readily dissolves in water thus binding the hydrophobic ingredients tightly into the water solution. The Graphene is layered in the micellar matrices.</span></p>', '', 'graph-x-temperature-controlled-fabric', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', ''),
(3, 0, 'published', 5004, 'en', 'Tick Repellent Fabric', 'img/uploads/pexels-photo-2070676.jpeg', '<p><span style=\"font-weight: 400;\">Our Tick Repellent Finish was created for your favorite pets - large and small. The 100% natural plant based finish allows your pet to enjoy the outdoors without the worry of insect bites. Our natural plant-based formulation also ensures they are not breathing in harmful chemicals such as DEET or Permethrin which are harmful.</span></p>', '<p>Our Tick Repellent Finish was created for your favorite pets - large and small. The 100% natural plant based finish allows your pet to enjoy the outdoors without the worry of insect bites. Our natural plant-based formulation also ensures they are not breathing in harmful chemicals such as DEET or Permethrin which are harmful.</p>\r\n<p>Our finish lasts up to 70 washes on all fabrics.</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', '', 'tick-repellent-fabric', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', ''),
(4, 0, 'published', 3766, 'en', 'Application Technology', 'img/uploads/pexels-photo-2070676.jpeg', '<p><span style=\"font-weight: 400;\">SK Technical Fabrics and Finishes has developed a 3D finishing technique using state of the art non-topical application preserving fabric bulk and loft which opens up a separate face and back finish application. This gives the fabric dual functionality, which allows it to apply functional finishes.</span></p>', '<p><span style=\"font-weight: 400;\">This reduces the chemical usage by 50% and requires 30% less drying time than traditional padding method without any compromise on performance of the fabric</span><strong>.</strong></p>', '', 'application-technology', 'http://localhost/sktechnicalfabrics/admin/img/uploads/application-technology.m4v', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_products`
--
ALTER TABLE `module_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `module_products`
--
ALTER TABLE `module_products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
