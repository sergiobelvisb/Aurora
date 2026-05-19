-- =========================================================
-- Aurora DB - AWS RDS Compatible + Laravel Sessions
-- =========================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `aurora`;

CREATE DATABASE `aurora`
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE `aurora`;

-- =========================================================
-- Tabla hospitales
-- =========================================================

DROP TABLE IF EXISTS `hospitales`;

CREATE TABLE `hospitales` (
  `hospitalID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  PRIMARY KEY (`hospitalID`)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

-- =========================================================
-- Tabla usuarios_medicos
-- =========================================================

DROP TABLE IF EXISTS `usuarios_medicos`;

CREATE TABLE `usuarios_medicos` (
  `userID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `hospitalID` int UNSIGNED DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `fotodeperfil` varchar(255) DEFAULT 'default.png',
  `acl` enum('Administrador','Medico','Tecnico') NOT NULL DEFAULT 'Medico',

  PRIMARY KEY (`userID`),
  UNIQUE KEY `uk_email` (`email`),
  UNIQUE KEY `uk_username` (`username`),
  KEY `idx_hospitalID` (`hospitalID`),

  CONSTRAINT `fk_usuarios_hospital`
    FOREIGN KEY (`hospitalID`)
    REFERENCES `hospitales` (`hospitalID`)
    ON DELETE SET NULL
    ON UPDATE CASCADE

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

-- =========================================================
-- Tabla pacientes
-- =========================================================

DROP TABLE IF EXISTS `pacientes`;

CREATE TABLE `pacientes` (
  `pacienteID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `fecha_de_nacimiento` date NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `userID` int UNSIGNED NOT NULL,

  PRIMARY KEY (`pacienteID`),
  KEY `fk_pacientes_usuarios_medicos` (`userID`),

  CONSTRAINT `fk_pacientes_usuarios_medicos`
    FOREIGN KEY (`userID`)
    REFERENCES `usuarios_medicos` (`userID`)
    ON DELETE CASCADE

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

-- =========================================================
-- Tabla sesiones médicas
-- =========================================================

DROP TABLE IF EXISTS `sesiones`;

CREATE TABLE `sesiones` (
  `sesionID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID` int UNSIGNED NOT NULL,
  `pacienteID` int UNSIGNED NOT NULL,
  `fecha_hora_inicio` datetime NOT NULL,
  `fecha_hora_fin` datetime DEFAULT NULL,
  `notas_medicas` text,
  `duracion` int UNSIGNED DEFAULT NULL,
  `datos_eeg` LONGTEXT,

  PRIMARY KEY (`sesionID`),
  KEY `idx_userID` (`userID`),
  KEY `idx_pacienteID` (`pacienteID`),

  CONSTRAINT `fk_sesiones_paciente`
    FOREIGN KEY (`pacienteID`)
    REFERENCES `pacientes` (`pacienteID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,

  CONSTRAINT `fk_sesiones_usuario`
    FOREIGN KEY (`userID`)
    REFERENCES `usuarios_medicos` (`userID`)
    ON DELETE CASCADE

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

-- =========================================================
-- Laravel Sessions Table
-- SESSION_DRIVER=database
-- =========================================================

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,

  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

-- =========================================================
-- Laravel Cache Table
-- CACHE_STORE=database
-- =========================================================

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,

  PRIMARY KEY (`key`)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

-- =========================================================
-- Laravel Cache Locks
-- =========================================================

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,

  PRIMARY KEY (`key`)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

-- =========================================================
-- Datos hospitales
-- =========================================================

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
(14, 'Hospital Rey Juan Carlos', 'Madrid');


COMMIT;
