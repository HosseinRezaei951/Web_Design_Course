-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 24, 2019 at 08:27 PM
-- Server version: 8.0.14
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barber_shop`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addAdmin` (IN `newUsername` VARCHAR(100), IN `newPassword` VARCHAR(100), IN `newName` VARCHAR(100), IN `newFamily` VARCHAR(100), IN `newPhoneNumber` VARCHAR(11), IN `newPhoto` VARCHAR(100))  NO SQL
INSERT INTO `admin`(`Username`, `Pass`, `Name`, `Family`, `PhoneNumber`,`Photo`) VALUES (newUsername,newPassword,newName,newFamily,newPhoneNumber,newPhoto)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addBarberShop` (IN `newLicenseNumber` VARCHAR(20), IN `newName` VARCHAR(50), IN `newPhoneNumber` VARCHAR(11), IN `newPhoto` VARCHAR(100), IN `newLogo` VARCHAR(100), IN `newAddress` VARCHAR(250))  NO SQL
INSERT INTO `barbershop`(`LicenseNumber`, `Name`, `PhoneNumber`, `Photo`, `Logo`,`Address`) VALUES (newLicenseNumber,newName,newPhoneNumber,newPhoto,newLogo,newAddress)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addCostumer` (IN `newUsername` VARCHAR(100), IN `newPassword` VARCHAR(100), IN `newPhoneNumber` VARCHAR(11), IN `newName` VARCHAR(100), IN `newFamily` VARCHAR(100))  NO SQL
INSERT INTO `costumers`(`Username`, `Pass`, `PhoneNumber`, `Name`, `Family`) VALUES (newUsername,newPassword,newPhoneNumber,newName,newFamily)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addModel` (IN `name` VARCHAR(50), IN `category` VARCHAR(50), IN `price` INT, IN `photo` VARCHAR(100), IN `description` VARCHAR(250))  NO SQL
BEGIN
	INSERT INTO `models`(`Name`, `category`, `Price`, `Photo`, `Description`) 		VALUES (name,category,price,photo,description);
    SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addReservation` (IN `username` VARCHAR(50), IN `newTime` VARCHAR(19), IN `modelID` INT, IN `newDescription` VARCHAR(250))  NO SQL
BEGIN
	DECLARE number DECIMAL(10,2) DEFAULT 0;
	SELECT COUNT(Moment) INTO number FROM `reservation_times`;
    IF number>0 THEN
		INSERT INTO `reservations`(`Costumer`, `Moment`, `Model_ID`, 				`Description`) VALUES (username,newTime,modelID,newDescription);
    	DELETE FROM reservation_times WHERE Moment=newTime;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addReservationHistory` (IN `inputUsername` VARCHAR(50), IN `inputTime` VARCHAR(19), IN `modelID` INT, IN `newDescription` VARCHAR(250))  NO SQL
INSERT INTO `reservations_history`(`Costumer`,`Moment`,`Model_ID`,`Description`)VALUES(inputUsername,inputTime,modelID,newDescription)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addReservationNoModel` (IN `username` VARCHAR(50), IN `newTime` VARCHAR(19), IN `newDescription` VARCHAR(250))  NO SQL
BEGIN DECLARE number DECIMAL(10,2) DEFAULT 0; SELECT COUNT(Moment) INTO number FROM `reservation_times`; IF number>0 THEN INSERT INTO `reservations`(`Costumer`, `Moment`, `Description`) VALUES (username,newTime,newDescription); DELETE FROM reservation_times WHERE Moment=newTime; END IF; END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addReservationTime` (IN `newTime` VARCHAR(19))  NO SQL
BEGIN
	DECLARE number DECIMAL(10,2) DEFAULT 0;
	SELECT COUNT(Moment) INTO number FROM `reservation_times` WHERE 			`reservation_times`.`Moment`=newTime;
    IF number=0 THEN
    	set number=0;
        SELECT COUNT(Moment) INTO number FROM `reservations` WHERE 					`reservations`.`Moment`=newTime;
        IF number=0 THEN
			INSERT INTO `reservation_times`(`Moment`) VALUES (newTime);
            SELECT true;
        ELSE
        	SELECT false;
        END IF;
    ELSE
    	SELECT false;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addWorkSample` (IN `newModelName` VARCHAR(50), IN `newPhoto` VARCHAR(100), IN `newDescription` VARCHAR(250))  NO SQL
BEGIN
	INSERT INTO `work_samples`(`ModelName`,`Photo`, `Description`) VALUES 		(newModelName,newPhoto,newDescription);
    SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cancelReservation` (IN `username` VARCHAR(100), IN `inputTime` VARCHAR(19))  BEGIN
  DELETE FROM `reservations` WHERE Costumer=username and Moment=inputTime;
  INSERT INTO `reservation_times`(`Moment`) VALUES (inputTime);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkAdminUserPass` (IN `u` VARCHAR(100), IN `p` VARCHAR(100))  NO SQL
SELECT * FROM `admin` WHERE Username=u AND Pass=p$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkCostumerUserPass` (IN `u` VARCHAR(100), IN `p` VARCHAR(100))  NO SQL
SELECT * FROM `costumers` WHERE Username=u AND Pass=p$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteAdmin` (IN `u` VARCHAR(100))  NO SQL
DELETE FROM `admin` WHERE Username = u$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteCostumer` (IN `u` VARCHAR(100))  NO SQL
DELETE FROM `costumers` WHERE Username=u$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteModel` (IN `oldID` INT)  NO SQL
DELETE FROM `models` WHERE ID=oldID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteModelByName` (IN `oldName` VARCHAR(50))  NO SQL
DELETE FROM `models` WHERE Name=oldName$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteReservation` (IN `username` VARCHAR(100), IN `oldTime` VARCHAR(19))  NO SQL
DELETE FROM `reservations` WHERE Costumer=username and Moment=oldTime$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteReservationHistory` (IN `username` VARCHAR(100), IN `oldTime` VARCHAR(19))  NO SQL
DELETE FROM `reservations_history` WHERE Costumer=username and Moment=oldTime$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteReservationTime` (IN `oldTime` VARCHAR(19))  NO SQL
DELETE FROM `reservation_times` WHERE Moment=oldTime$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteWorkSample` (IN `oldID` INT)  NO SQL
DELETE FROM `work_samples` WHERE ID=oldID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAdminInfo` ()  NO SQL
SELECT * FROM `admin`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllModels` ()  NO SQL
SELECT * FROM `models`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllReservationCostumer` ()  NO SQL
SELECT * FROM reservations  INNER JOIN costumers on reservations.Costumer=costumers.Username ORDER BY reservations.Moment$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllReservationHistory` ()  NO SQL
SELECT * FROM `reservations_history` ORDER BY Moment$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllReservationHistoryCustomer` ()  NO SQL
SELECT * FROM reservations_history  INNER JOIN costumers on reservations_history.Costumer=costumers.Username ORDER BY reservations_history.Moment$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllReservations` ()  NO SQL
SELECT * FROM `reservations` ORDER BY reservations.Moment$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllReservationTimes` ()  NO SQL
SELECT * FROM `reservation_times` ORDER BY Moment$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllUsers` ()  NO SQL
SELECT * FROM `costumers`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllWorkSamples` ()  NO SQL
SELECT * FROM `work_samples`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getBarberShopInfo` ()  NO SQL
SELECT * FROM `barbershop`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getReservationHistoryByDate` (IN `beginTime` VARCHAR(19), IN `endTime` VARCHAR(19))  NO SQL
SELECT * from `reservations_history` WHERE `reservations_history`.`Moment` >= beginTime AND `reservations_history`.`Moment` <= endTime ORDER BY reservations_history.Moment$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getReservationsCostumerByDate` (IN `beginTime` VARCHAR(19), IN `endTime` VARCHAR(19))  NO SQL
SELECT * from `reservations` INNER JOIN costumers ON costumers.Username=reservations.Costumer WHERE `reservations`.`Moment` >= beginTime AND `reservations`.`Moment` <= endTime ORDER BY reservations.Moment$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getReservationsHistoryCostumerByDate` (IN `beginTime` VARCHAR(19), IN `endTime` VARCHAR(19))  NO SQL
SELECT * from `reservations_history` INNER JOIN costumers on costumers.Username=reservations_history.Costumer WHERE `reservations_history`.`Moment` >= beginTime AND `reservations_history`.`Moment` <= endTime ORDER BY reservations_history.Moment$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getReservationTimesByDate` (IN `beginTime` VARCHAR(19), IN `endTime` VARCHAR(19))  NO SQL
SELECT * from `reservation_times` WHERE `reservation_times`.`Moment` >= beginTime AND `reservation_times`.`Moment` <= endTime ORDER BY reservation_times.Moment$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getResevationByDate` (IN `beginTime` VARCHAR(19), IN `endTime` VARCHAR(19))  NO SQL
SELECT * from `reservations` WHERE `reservations`.`Moment` >= beginTime AND `reservations`.`Moment` <= endTime ORDER BY reservations.Moment$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `isAdminExist` (IN `u` VARCHAR(100))  NO SQL
SELECT * FROM `admin` WHERE Username=u$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `isCostumerExist` (IN `u` VARCHAR(100))  NO SQL
SELECT * FROM `costumers` WHERE username = u$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateAdmin` (IN `inputUsername` VARCHAR(100), IN `newPassword` VARCHAR(100), IN `newName` VARCHAR(100), IN `newFamily` VARCHAR(100), IN `newPhoneNumber` VARCHAR(11), IN `newPhoto` VARCHAR(100))  NO SQL
UPDATE `admin` SET `Pass`=newPassword,`Name`=newName,`Family`=newFamily,`PhoneNumber`=newPhoneNumber,`Photo`=newPhoto WHERE Username = inputUsername$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateBarberShop` (IN `inputLicenseNumber` VARCHAR(20), IN `newName` VARCHAR(50), IN `newPhoneNumber` VARCHAR(11), IN `newPhoto` VARCHAR(100), IN `newLogo` VARCHAR(100), IN `newAddress` VARCHAR(250), IN `newLicenseNumber` VARCHAR(20))  NO SQL
UPDATE `barbershop` SET `Name`=newName,`PhoneNumber`=newPhoneNumber,`Photo`=newPhoto,`Logo`=newLogo, `Address`=newAddress, `LicenseNumber`=newLicenseNumber WHERE LicenseNumber = inputLicenseNumber$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateCostumer` (IN `inputUsername` VARCHAR(100), IN `newPassword` VARCHAR(100), IN `newPhoneNumber` VARCHAR(11), IN `newName` VARCHAR(50), IN `newFamily` VARCHAR(50))  NO SQL
UPDATE `costumers` SET `Pass`=newPassword,`PhoneNumber`=newPhoneNumber,`Name`=newName,`Family`=newFamily WHERE Username=inputUsername$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateModel` (IN `inputID` INT, IN `newName` VARCHAR(50), IN `newCategory` VARCHAR(50), IN `newPrice` INT, IN `newPhoto` VARCHAR(100), IN `newDescription` VARCHAR(250))  NO SQL
UPDATE `models` SET `Name`=newName,`Category`=newCategory,`Price`=newPrice,`Photo`=newPhoto,`Description`=newDescription WHERE ID=inputID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateModelByName` (IN `oldName` VARCHAR(50), IN `newName` VARCHAR(50), IN `newCategory` VARCHAR(50), IN `newPrice` INT, IN `newPhoto` VARCHAR(100), IN `newDescription` VARCHAR(250))  NO SQL
UPDATE `models` SET `Name`=newName,`Category`=newCategory,`Price`=newPrice,`Photo`=newPhoto,`Description`=newDescription WHERE Name=oldName$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateReservation` (IN `oldUsername` VARCHAR(100), IN `oldTime` VARCHAR(19), IN `newCostumer` VARCHAR(100), IN `newTime` VARCHAR(19), IN `newModelID` INT, IN `newDescription` VARCHAR(250))  NO SQL
UPDATE `reservations` SET `Costumer`=newCostumer,`Moment`=newTime,`Model_ID`=newModelID,`Description`=newDescription WHERE Costumer=oldUsername AND Moment=oldTime$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateReservationHistory` (IN `oldUsername` VARCHAR(100), IN `oldTime` VARCHAR(19), IN `newCostumer` VARCHAR(100), IN `newTime` VARCHAR(19), IN `newModelID` INT, IN `newDescription` VARCHAR(250))  NO SQL
UPDATE `reservations_history` SET `Costumer`=newCostumer,`Moment`=newTime,`Model_ID`=newModelID,`Description`=newDescription WHERE Costumer=oldUsername AND Moment=oldTime$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateReservationTime` (IN `oldTime` VARCHAR(19), IN `newTime` VARCHAR(19))  NO SQL
UPDATE `reservation_times` SET `Moment`=newTime WHERE Moment=oldTime$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateWorkSample` (IN `inputID` INT, IN `newModelName` VARCHAR(50), IN `newPhoto` VARCHAR(100), IN `newDescription` VARCHAR(250))  NO SQL
UPDATE `work_samples` SET `ModelName`=newModelName,`Photo`=newPhoto,`Description`=newDescription WHERE ID=inputID$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Pass` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Family` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `PhoneNumber` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Username`, `Pass`, `Name`, `Family`, `PhoneNumber`, `Photo`) VALUES
('admin', '36fc444666ebb46037c2a6e5571bed1e868509608460e31ffbfb25bc8715d764', '09199585648', 'Hossein', 'Rezaei', 'http://localhost/Project/uploads/admin/photo/img_5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `barbershop`
--

CREATE TABLE `barbershop` (
  `LicenseNumber` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `PhoneNumber` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Logo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Address` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `barbershop`
--

INSERT INTO `barbershop` (`LicenseNumber`, `Name`, `PhoneNumber`, `Photo`, `Logo`, `Address`) VALUES
('123457', 'Gheychi', '09123456789', 'http://localhost/Project/uploads/barbershop/photo/img_1.jpg', 'http://localhost/Project/uploads/barbershop/logo/favicon.png', 'IASBS, 444 Prof. Yousef Sobouti Blvd.,Zanjan, Iran');

-- --------------------------------------------------------

--
-- Table structure for table `costumers`
--

CREATE TABLE `costumers` (
  `Username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Pass` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `PhoneNumber` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Family` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `costumers`
--

INSERT INTO `costumers` (`Username`, `Pass`, `PhoneNumber`, `Name`, `Family`) VALUES
('admin', '36fc444666ebb46037c2a6e5571bed1e868509608460e31ffbfb25bc8715d764', '09199585648', 'Hossein', 'Rezaei'),
('hossein951', 'ec81c9e832651cf616e9df65890defb5235f9935a8995ce6f311227196f67cb4', '09330828818', 'Hossein', 'Rezaei');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `Price` int(11) NOT NULL,
  `Photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `Description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`ID`, `Name`, `Category`, `Price`, `Photo`, `Description`) VALUES
(12, 'German', 'Head', 10000, 'http://localhost/Project/uploads/models/img_5.jpg', 'Some test ... '),
(13, 'France', 'Head', 20000, 'http://localhost/Project/uploads/models/person_3.jpg', 'Some test ... '),
(14, 'Latina', 'Bear', 5000, 'http://localhost/Project/uploads/models/person_4.jpg', 'Some test ... ');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `Costumer` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Moment` timestamp NOT NULL,
  `Model_ID` int(11) DEFAULT NULL,
  `Description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`Costumer`, `Moment`, `Model_ID`, `Description`) VALUES
('admin', '2019-12-25 05:30:00', 13, '13215'),
('admin', '2019-12-25 06:30:00', 13, 'Some test ... '),
('admin', '2019-12-25 07:30:00', 13, 'asdasdas'),
('admin', '2019-12-26 08:30:00', 13, 'Jooon ... ♥');

-- --------------------------------------------------------

--
-- Table structure for table `reservations_history`
--

CREATE TABLE `reservations_history` (
  `Costumer` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Moment` timestamp NOT NULL,
  `Model_ID` int(11) DEFAULT NULL,
  `Description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_times`
--

CREATE TABLE `reservation_times` (
  `Moment` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_samples`
--

CREATE TABLE `work_samples` (
  `ID` int(11) NOT NULL,
  `ModelName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `Photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `work_samples`
--

INSERT INTO `work_samples` (`ID`, `ModelName`, `Photo`, `Description`) VALUES
(10, 'Model 1', 'http://localhost/Project/uploads/worksamples/img_5.jpg', 'Some test ... '),
(11, 'Model 2', 'http://localhost/Project/uploads/worksamples/img_7.jpg', 'Some test ... '),
(12, 'Model 3', 'http://localhost/Project/uploads/worksamples/person_3.jpg', 'Some test ... '),
(13, 'Model 4', 'http://localhost/Project/uploads/worksamples/person_1.jpg', 'Some test ... ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `barbershop`
--
ALTER TABLE `barbershop`
  ADD PRIMARY KEY (`LicenseNumber`);

--
-- Indexes for table `costumers`
--
ALTER TABLE `costumers`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`Costumer`,`Moment`),
  ADD KEY `reservation_model_ID` (`Model_ID`);

--
-- Indexes for table `reservations_history`
--
ALTER TABLE `reservations_history`
  ADD PRIMARY KEY (`Costumer`,`Moment`),
  ADD KEY `history_model_ID` (`Model_ID`);

--
-- Indexes for table `reservation_times`
--
ALTER TABLE `reservation_times`
  ADD PRIMARY KEY (`Moment`);

--
-- Indexes for table `work_samples`
--
ALTER TABLE `work_samples`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `work_samples`
--
ALTER TABLE `work_samples`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservation_model_ID` FOREIGN KEY (`Model_ID`) REFERENCES `models` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_username` FOREIGN KEY (`Costumer`) REFERENCES `costumers` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations_history`
--
ALTER TABLE `reservations_history`
  ADD CONSTRAINT `history_costumer` FOREIGN KEY (`Costumer`) REFERENCES `costumers` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_model_ID` FOREIGN KEY (`Model_ID`) REFERENCES `models` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `history` ON SCHEDULE EVERY 1 DAY STARTS '2019-12-25 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN

INSERT INTO `reservations_history`(`Costumer`,`Moment`,`Model_ID`,`Description`) SELECT * FROM `reservations` WHERE `reservations` <= CURRENT_TIMESTAMP;
DELETE FROM `reservations` WHERE `reservations`.`Moment` <= CURRENT_TIMESTAMP;
DELETE FROM `reservation_times` WHERE `reservation_times`.`Moment` <= CURRENT_TIMESTAMP;

END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
