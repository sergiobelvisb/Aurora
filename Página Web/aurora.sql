-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2026 at 12:22 PM
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
-- Database: `aurora`
--

-- --------------------------------------------------------

--
-- Table structure for table `hospitales`
--

CREATE TABLE `hospitales` (
  `hospitalID` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitales`
--

INSERT INTO `hospitales` (`hospitalID`, `nombre`, `ubicacion`) VALUES
(1, 'Hospital Universitario La Paz', 'Madrid'),
(2, 'Hospital 12 de Octubre', 'Madrid'),
(3, 'Hospital General Universitario Gregorio Marañón', 'Madrid'),
(4, 'Hospital Clínico San Carlos', 'Madrid'),
(5, 'Hospital Universitario Ramón y Cajal', 'Madrid'),
(6, 'Hospital Fundación Jiménez Díaz', 'Madrid'),
(7, 'Hospital Universitario La Princesa', 'Madrid'),
(8, 'Hospital Puerta de Hierro Majadahonda', 'Madrid'),
(9, 'Hospital Universitario HM Sanchinarro', 'Madrid'),
(10, 'Hospital Quirónsalud Madrid', 'Madrid'),
(11, 'Hospital Ruber Internacional', 'Madrid'),
(12, 'Hospital Infanta Sofía', 'Madrid'),
(13, 'Hospital Infanta Leonor', 'Madrid'),
(14, 'Hospital Rey Juan Carlos', 'Madrid'),
(15, 'Hospital Universitari i Politècnic La Fe', 'Comunidad Valenciana'),
(16, 'Hospital Clínico Universitario de Valencia', 'Comunidad Valenciana'),
(17, 'Hospital General Universitario de Valencia', 'Comunidad Valenciana'),
(18, 'Hospital Universitario Doctor Peset', 'Comunidad Valenciana'),
(19, 'Hospital IMED Valencia', 'Comunidad Valenciana'),
(20, 'Hospital Quirónsalud Valencia', 'Comunidad Valenciana'),
(21, 'Hospital General Universitario de Alicante', 'Comunidad Valenciana'),
(22, 'Hospital Universitario de Sant Joan d\'Alacant', 'Comunidad Valenciana'),
(23, 'Hospital IMED Elche', 'Comunidad Valenciana'),
(24, 'Hospital General Universitario de Castellón', 'Comunidad Valenciana'),
(25, 'Hospital Vithas Valencia 9 de Octubre', 'Comunidad Valenciana'),
(37, 'Hospital Clínic de Barcelona', 'Cataluña'),
(38, 'Hospital Universitari Vall d\'Hebron', 'Cataluña'),
(39, 'Hospital de la Santa Creu i Sant Pau', 'Cataluña'),
(40, 'Hospital del Mar', 'Cataluña'),
(41, 'Hospital Universitari de Bellvitge', 'Cataluña'),
(42, 'Hospital Universitari Germans Trias i Pujol', 'Cataluña'),
(43, 'Hospital Quirónsalud Barcelona', 'Cataluña'),
(44, 'Hospital Universitari Arnau de Vilanova', 'Cataluña'),
(45, 'Hospital Universitari Joan XXIII', 'Cataluña'),
(46, 'Hospital Universitari de Girona Doctor Josep Trueta', 'Cataluña'),
(47, 'Hospital Sant Joan de Déu', 'Cataluña');

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
--

CREATE TABLE `pacientes` (
  `pacienteID` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `edad` int(255) NOT NULL,
  `DNI` varchar(255) NOT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `fecha_de_nacimiento` date NOT NULL,
  `medicoID` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sesiones`
--

CREATE TABLE `sesiones` (
  `sesionID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `pacienteID` int(10) UNSIGNED NOT NULL,
  `fecha_hora_inicio` datetime NOT NULL,
  `fecha_hora_fin` datetime NOT NULL,
  `notas_medicas` varchar(255) DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  `datos_eeg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_medicos`
--

CREATE TABLE `usuarios_medicos` (
  `userID` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `acl` enum('Administrador','Medico','Tecnico') NOT NULL DEFAULT 'Medico',
  `fotodeperfil` varchar(255) NOT NULL DEFAULT 'default.png',
  `hospitalID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios_medicos`
--

INSERT INTO `usuarios_medicos` (`userID`, `email`, `username`, `password`, `nombre`, `acl`, `fotodeperfil`, `hospitalID`) VALUES
(1, 'adminAurora@gmail.com', 'adminAuroraDB', '$2y$10$t0NnIKg28Wp9HRUreWB.iu4HDP1GH9CkGrLxD1ES/sRL98QXGOt0m', 'Admin Aurora', 'Administrador', 'adminAuroraDB.png', 2),
(2, 'sergiobelvisb@gmail.com', 'SergioBelvis', '$2y$10$Z83jHqzQYRcW2frxzdbwmODZqvblZUa.YmAyAbJT86mscbwzLS3cC', 'Sergio Belvis Barba', 'Medico', 'SergioBelvis.png', 2),
(3, 'dravegrizales@gmail.com', 'DamiemRave', '$2y$10$B58ilkcUBu1YrAqmVOmEMeLHWZYFKr38jQfq6oSeO4yWb12NT.5cq', 'Damiem Rave', 'Medico', 'DamiemRave.png', 1),
(4, 'bricamhi@gmail.com', 'Brian', '$2y$10$I2mD3w9G3OlqS9pxx4FhWuVsrJ8fa1vSSHZqW.8td7AU5i/syaoIS', 'Brian Camba Hipólito', 'Medico', 'Brian.png', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hospitales`
--
ALTER TABLE `hospitales`
  ADD PRIMARY KEY (`hospitalID`);

--
-- Indexes for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`pacienteID`),
  ADD KEY `fk_pacientes_medico` (`medicoID`);

--
-- Indexes for table `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`sesionID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `pacienteID` (`pacienteID`);

--
-- Indexes for table `usuarios_medicos`
--
ALTER TABLE `usuarios_medicos`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_hospitalID` (`hospitalID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hospitales`
--
ALTER TABLE `hospitales`
  MODIFY `hospitalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `pacienteID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `sesionID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios_medicos`
--
ALTER TABLE `usuarios_medicos`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `fk_pacientes_medico` FOREIGN KEY (`medicoID`) REFERENCES `usuarios_medicos` (`userID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `sesiones_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `usuarios_medicos` (`userID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sesiones_ibfk_2` FOREIGN KEY (`pacienteID`) REFERENCES `pacientes` (`pacienteID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuarios_medicos`
--
ALTER TABLE `usuarios_medicos`
  ADD CONSTRAINT `fk_hospitalID` FOREIGN KEY (`hospitalID`) REFERENCES `hospitales` (`hospitalID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
