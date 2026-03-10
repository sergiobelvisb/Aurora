-- Eliminar la base de datos si ya existe
DROP DATABASE IF EXISTS `aurora`;
CREATE DATABASE `aurora` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `aurora`;

-- Eliminar usuario si ya existe
DROP USER IF EXISTS 'adminAuroraDB'@'localhost';
CREATE USER 'adminAuroraDB'@'localhost' IDENTIFIED BY 'adminAuroraDB';

-- Dar todos los privilegios al usuario sobre la base de datos aurora
GRANT ALL PRIVILEGES ON `aurora`.* TO 'adminAuroraDB'@'localhost';
FLUSH PRIVILEGES;

-- --------------------------------------------------------
-- Table structure for table `hospitales`
-- --------------------------------------------------------

CREATE TABLE `hospitales` (
  `hospitalID` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  PRIMARY KEY (`hospitalID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar hospitales
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
-- Table structure for table `pacientes`
-- --------------------------------------------------------

CREATE TABLE `pacientes` (
  `pacienteID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `fecha_de_nacimiento` date NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pacienteID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for table `sesiones`
-- --------------------------------------------------------

CREATE TABLE `sesiones` (
  `sesionID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID` int(10) UNSIGNED NOT NULL,
  `pacienteID` int(10) UNSIGNED NOT NULL,
  `fecha_hora_inicio` datetime NOT NULL,
  `fecha_hora_fin` datetime NOT NULL,
  `notas_medicas` varchar(255) DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  `datos_eeg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sesionID`),
  KEY `userID` (`userID`),
  KEY `pacienteID` (`pacienteID`),
  CONSTRAINT `sesiones_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `usuarios_medicos` (`userID`) ON UPDATE CASCADE,
  CONSTRAINT `sesiones_ibfk_2` FOREIGN KEY (`pacienteID`) REFERENCES `pacientes` (`pacienteID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for table `usuarios_medicos`
-- --------------------------------------------------------

CREATE TABLE `usuarios_medicos` (
  `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `acl` enum('Administrador','Medico','Tecnico') NOT NULL DEFAULT 'Medico',
  `hospitalID` int(11) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_hospitalID` (`hospitalID`),
  CONSTRAINT `fk_hospitalID` FOREIGN KEY (`hospitalID`) REFERENCES `hospitales` (`hospitalID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Insertar usuario administrador
-- --------------------------------------------------------
INSERT INTO `usuarios_medicos` (`email`, `username`, `password`, `nombre`, `apellido1`, `apellido2`, `acl`, `hospitalID`)
VALUES ('admin@aurora.com', 'adminAuroraDB', SHA2('adminAuroraDB', 256), 'Admin', 'Aurora', '', 'Administrador', NULL);