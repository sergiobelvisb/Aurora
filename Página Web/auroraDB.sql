-- 1. Crear el usuario adminAuroraDB y darle permisos
CREATE USER IF NOT EXISTS 'adminAuroraDB'@'%' IDENTIFIED BY 'adminAuroraDB';

-- Crear la base de datos aurora
CREATE DATABASE IF NOT EXISTS aurora;

-- Otorgar todos los permisos del usuario sobre la base de datos aurora
GRANT ALL PRIVILEGES ON aurora.* TO 'adminAuroraDB'@'%';

-- Aplicar los cambios de permisos
FLUSH PRIVILEGES;

-- Seleccionar la base de datos para trabajar
USE aurora;

-- 2. Tabla: usuarios_medicos
CREATE TABLE IF NOT EXISTS usuarios_medicos (
    userID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Espacio para hash de seguridad
    nombre VARCHAR(100) NOT NULL,
    apellido1 VARCHAR(100) NOT NULL,
    apellido2 VARCHAR(100),
    acl ENUM('Administrador', 'Medico', 'Tecnico') NOT NULL DEFAULT 'Medico'
) ENGINE=InnoDB;

-- 3. Tabla: pacientes
CREATE TABLE IF NOT EXISTS pacientes (
    pacienteID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido1 VARCHAR(100) NOT NULL,
    apellido2 VARCHAR(100),
    telefono VARCHAR(25), -- Cambiado a VARCHAR para evitar pérdida de ceros
    fecha_de_nacimiento DATE NOT NULL,
    direccion VARCHAR(255)
) ENGINE=InnoDB;

-- 4. Tabla: medicos_pacientes
CREATE TABLE IF NOT EXISTS medicos_pacientes (
    userID INT UNSIGNED NOT NULL,
    pacienteID INT UNSIGNED NOT NULL,
    fecha_inicio_tratamiento DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (userID, pacienteID),
    FOREIGN KEY (userID) REFERENCES usuarios_medicos(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (pacienteID) REFERENCES pacientes(pacienteID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- 5. Tabla: sesiones
CREATE TABLE IF NOT EXISTS sesiones (
    sesionID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    userID INT UNSIGNED NOT NULL,
    pacienteID INT UNSIGNED NOT NULL,
    fecha_hora_inicio DATETIME NOT NULL,
    fecha_hora_fin DATETIME NOT NULL,
    notas_medicas VARCHAR(255),
    duracion TIME, -- Formato HH:MM:SS para legibilidad
    datos_eeg VARCHAR(255), -- Suficiente para muestras de ~30 caracteres en defensa
    FOREIGN KEY (userID) REFERENCES usuarios_medicos(userID) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (pacienteID) REFERENCES pacientes(pacienteID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

