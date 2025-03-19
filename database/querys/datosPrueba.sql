-- Insertar 10 Veterinarios
INSERT INTO veterinarios (nombreVete, correo, especialidad, telefono, created_at, updated_at) VALUES
('Carlos Pérez', 'carlos.perez@vet.com', 'Cirugía', '3101234567', NOW(), NOW()),
('María López', 'maria.lopez@vet.com', 'Dermatología', '3129876543', NOW(), NOW()),
('Juan Rodríguez', 'juan.rodriguez@vet.com', 'Oftalmología', '3155678910', NOW(), NOW()),
('Ana Gómez', 'ana.gomez@vet.com', 'Ortopedia', '3165432189', NOW(), NOW()),
('Pedro Ramírez', 'pedro.ramirez@vet.com', 'Cardiología', '3116784321', NOW(), NOW()),
('Luis Herrera', 'luis.herrera@vet.com', 'Medicina Interna', '3187651234', NOW(), NOW()),
('Sofía Martínez', 'sofia.martinez@vet.com', 'Neurología', '3193216789', NOW(), NOW()),
('Andrés Torres', 'andres.torres@vet.com', 'Odontología', '3172345678', NOW(), NOW()),
('Elena Castro', 'elena.castro@vet.com', 'Anestesiología', '3145678912', NOW(), NOW()),
('Jorge Ruiz', 'jorge.ruiz@vet.com', 'Nutrición', '3136784325', NOW(), NOW());

-- Insertar 20 Mascotas
INSERT INTO mascotas (nomMascota, edadMascota, colorMascota, tipoMascota, created_at, updated_at) VALUES
('Max', 3, 'Negro', 'Perro', NOW(), NOW()),
('Luna', 2, 'Blanco', 'Gato', NOW(), NOW()),
('Rocky', 4, 'Marrón', 'Perro', NOW(), NOW()),
('Milo', 1, 'Gris', 'Gato', NOW(), NOW()),
('Bella', 5, 'Dorado', 'Perro', NOW(), NOW()),
('Simba', 3, 'Naranja', 'Gato', NOW(), NOW()),
('Nala', 2, 'Beige', 'Perro', NOW(), NOW()),
('Coco', 6, 'Negro', 'Gato', NOW(), NOW()),
('Bruno', 4, 'Marrón y Blanco', 'Perro', NOW(), NOW()),
('Toby', 2, 'Blanco y Negro', 'Gato', NOW(), NOW()),
('Zeus', 5, 'Gris y Blanco', 'Perro', NOW(), NOW()),
('Sasha', 3, 'Negro y Marrón', 'Gato', NOW(), NOW()),
('Duke', 2, 'Blanco', 'Perro', NOW(), NOW()),
('Leo', 1, 'Negro', 'Gato', NOW(), NOW()),
('Rex', 4, 'Marrón Oscuro', 'Perro', NOW(), NOW()),
('Felix', 2, 'Gris Claro', 'Gato', NOW(), NOW()),
('Chester', 3, 'Dorado', 'Perro', NOW(), NOW()),
('Mia', 2, 'Negro y Blanco', 'Gato', NOW(), NOW()),
('Thor', 5, 'Gris y Marrón', 'Perro', NOW(), NOW()),
('Olivia', 1, 'Blanco', 'Gato', NOW(), NOW());

-- Insertar 20 Dueños con relación a mascotas
INSERT INTO duenos (nombre, idMascota, celular, direccion, correo, ciudad, created_at, updated_at) VALUES
('Carlos Mendoza', 1, '3201234567', 'Calle 123', 'carlos.mendoza@example.com', 'Bogotá', NOW(), NOW()),
('Andrea López', 2, '3219876543', 'Avenida 45', 'andrea.lopez@example.com', 'Medellín', NOW(), NOW()),
('Juan Ramírez', 3, '3225678910', 'Carrera 10', 'juan.ramirez@example.com', 'Cali', NOW(), NOW()),
('Paula Torres', 4, '3235432189', 'Calle 90', 'paula.torres@example.com', 'Barranquilla', NOW(), NOW()),
('Ricardo Herrera', 5, '3246784321', 'Carrera 15', 'ricardo.herrera@example.com', 'Cartagena', NOW(), NOW()),
('Luisa Gómez', 6, '3257651234', 'Diagonal 78', 'luisa.gomez@example.com', 'Pereira', NOW(), NOW()),
('Andrés Castro', 7, '3263216789', 'Calle 33', 'andres.castro@example.com', 'Bucaramanga', NOW(), NOW()),
('Mariana Rojas', 8, '3272345678', 'Calle 50', 'mariana.rojas@example.com', 'Santa Marta', NOW(), NOW()),
('Fernando Ruiz', 9, '3285678912', 'Calle 22', 'fernando.ruiz@example.com', 'Ibagué', NOW(), NOW()),
('Elena Márquez', 10, '3296784325', 'Avenida 100', 'elena.marquez@example.com', 'Manizales', NOW(), NOW()),
('Oscar Pérez', 11, '3307651234', 'Carrera 50', 'oscar.perez@example.com', 'Villavicencio', NOW(), NOW()),
('Valeria Jiménez', 12, '3313216789', 'Diagonal 40', 'valeria.jimenez@example.com', 'Cúcuta', NOW(), NOW()),
('Julián Soto', 13, '3322345678', 'Calle 77', 'julian.soto@example.com', 'Neiva', NOW(), NOW()),
('Diana Moreno', 14, '3335678912', 'Carrera 20', 'diana.moreno@example.com', 'Pasto', NOW(), NOW()),
('Esteban Vargas', 15, '3346784325', 'Calle 60', 'esteban.vargas@example.com', 'Tunja', NOW(), NOW()),
('Camila Ortega', 16, '3357651234', 'Avenida 70', 'camila.ortega@example.com', 'Montería', NOW(), NOW()),
('Hugo Cárdenas', 17, '3363216789', 'Diagonal 88', 'hugo.cardenas@example.com', 'Valledupar', NOW(), NOW()),
('Natalia Fajardo', 18, '3372345678', 'Carrera 5', 'natalia.fajardo@example.com', 'Armenia', NOW(), NOW()),
('Sebastián Medina', 19, '3385678912', 'Calle 99', 'sebastian.medina@example.com', 'Popayán', NOW(), NOW()),
('Gabriela Álvarez', 20, '3396784325', 'Carrera 18', 'gabriela.alvarez@example.com', 'Riohacha', NOW(), NOW());
