USE turnos_db;
-- Crear tabla de usuarios
CREATE TABLE usuarios (
    cedula VARCHAR(20) PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL.
    telefono INT
);

-- Crear tabla de servicios
CREATE TABLE servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

-- Crear tabla de turnos
CREATE TABLE turnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    servicio_id INT,
    usuario_cedula VARCHAR(20),
    numero INT,
    estado VARCHAR(50) DEFAULT 'pendiente',
    FOREIGN KEY (servicio_id) REFERENCES servicios(id),
    FOREIGN KEY (usuario_cedula) REFERENCES usuarios(cedula)
);

CREATE TABLE cajeros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    empleado VARCHAR(100) UNIQUE
);