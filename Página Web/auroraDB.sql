-- Creación de la base de datos aurora
CREATE DATABASE IF NOT EXISTS aurora;
USE aurora;

-- 1. Tabla: usuarios_medicos
-- Almacena la información de los profesionales que usan la aplicación [cite: 26, 40]
CREATE TABLE usuarios_medicos (
    userID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Espacio para hash de seguridad
    nombre VARCHAR(100) NOT NULL,
    apellido1 VARCHAR(100) NOT NULL,
    apellido2 VARCHAR(100),
    acl ENUM('Administrador', 'Medico', 'Tecnico') NOT NULL DEFAULT 'Medico'
) ENGINE=InnoDB;

-- 2. Tabla: pacientes
-- Almacena los datos de los sujetos de estudio [cite: 40, 57]
CREATE TABLE pacientes (
    pacienteID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido1 VARCHAR(100) NOT NULL,
    apellido2 VARCHAR(100),
    telefono VARCHAR(25), -- Cambiado a VARCHAR para evitar pérdida de ceros
    fecha_de_nacimiento DATE NOT NULL,
    direccion VARCHAR(255)
) ENGINE=InnoDB;

-- 3. Tabla: medicos_pacientes (Relación N:M "Atiende")
-- Tabla asociativa que vincula médicos con sus pacientes asignados
CREATE TABLE medicos_pacientes (
    userID INT UNSIGNED NOT NULL,
    pacienteID INT UNSIGNED NOT NULL,
    fecha_inicio_tratamiento DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (userID, pacienteID),
    FOREIGN KEY (userID) REFERENCES usuarios_medicos(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (pacienteID) REFERENCES pacientes(pacienteID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- 4. Tabla: sesiones
-- Almacena los datos de las mediciones de señales EEG [cite: 27, 40, 55]
CREATE TABLE sesiones (
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