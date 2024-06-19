USE turnos_db;
-- Crear tabla de usuarios
CREATE TABLE usuarios (
    cedula VARCHAR(20) PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    telefono VARCHAR(100),
    password VARCHAR(255),
    rol VARCHAR(10) DEFAULT 'user'
);

-- Crear tabla de servicios
CREATE TABLE servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

CREATE TABLE cajeros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    empleado VARCHAR(100) UNIQUE
);

-- Crear tabla de turnos
CREATE TABLE turnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    servicio_id INT,
    usuario_cedula VARCHAR(20),
    numero INT,
    cajero_id INT,
    estado VARCHAR(50) DEFAULT 'pendiente',
    FOREIGN KEY (servicio_id) REFERENCES servicios(id),
    FOREIGN KEY (usuario_cedula) REFERENCES usuarios(cedula)
);


INSERT INTO cajeros (id, nombre, empleado) VALUES
(1, 'Caja R', 'Brayan Cabrera'),
(2, 'Caja C', 'Maria Paz'),
(3, 'Caja A', 'Carlos Males');

INSERT INTO servicios (nombre) VALUES
('Retiros'),
('Consignacion'),
('Atencion al Cliente');

INSERT INTO usuarios (cedula, nombre, correo, telefono, password, rol)
VALUES ('000', 'admin', 'admin@example.com', '555-1234','123456', 'admin');