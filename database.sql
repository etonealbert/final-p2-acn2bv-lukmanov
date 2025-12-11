-- Base de datos para proyecto Stranger Things
-- Autor: Albert Lukmanov
-- Materia: Programación Web II

CREATE DATABASE IF NOT EXISTS stranger_things_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE stranger_things_db;

DROP TABLE IF EXISTS personajes;

CREATE TABLE personajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    rol VARCHAR(50) NOT NULL,
    descripcion TEXT NOT NULL,
    temporada INT NOT NULL,
    imagen_url VARCHAR(255) DEFAULT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO personajes (nombre, rol, descripcion, temporada, imagen_url) VALUES
('Eleven', 'Niños', 'Jane Hopper, conocida como Eleven o Once, es una niña con poderes telequinéticos y telepáticos que escapó de un laboratorio secreto. Es la protagonista principal de la serie.', 1, 'https://via.placeholder.com/300x400?text=Eleven'),
('Mike Wheeler', 'Niños', 'Michael Wheeler es el líder del grupo de amigos y el novio de Eleven. Es leal, valiente y siempre está dispuesto a ayudar a sus amigos sin importar el peligro.', 1, 'https://via.placeholder.com/300x400?text=Mike'),
('Dustin Henderson', 'Niños', 'Dustin es el miembro más carismático del grupo, conocido por su sentido del humor y su inteligencia. Tiene cleidocraneal displasia, lo que le da su apariencia característica.', 1, 'https://via.placeholder.com/300x400?text=Dustin'),
('Lucas Sinclair', 'Niños', 'Lucas es el miembro más pragmático y escéptico del grupo. Es directo, valiente y siempre busca soluciones prácticas a los problemas sobrenaturales que enfrentan.', 1, 'https://via.placeholder.com/300x400?text=Lucas'),
('Will Byers', 'Niños', 'William Byers es el niño que desaparece en la primera temporada, desencadenando todos los eventos. Es sensible, artístico y tiene una conexión especial con el Mundo del Revés.', 1, 'https://via.placeholder.com/300x400?text=Will'),
('Nancy Wheeler', 'Adolescentes', 'Nancy es la hermana mayor de Mike, una estudiante inteligente y determinada que se convierte en investigadora de los misterios de Hawkins. Valiente y decidida.', 1, 'https://via.placeholder.com/300x400?text=Nancy'),
('Steve Harrington', 'Adolescentes', 'Steve comenzó como el típico chico popular, pero evolucionó hasta convertirse en el "padre" protector del grupo. Es carismático, valiente y tiene un gran corazón.', 1, 'https://via.placeholder.com/300x400?text=Steve'),
('Jonathan Byers', 'Adolescentes', 'Jonathan es el hermano mayor de Will, un fotógrafo talentoso e introvertido. Es sensible, protector de su familia y forma equipo con Nancy en sus investigaciones.', 1, 'https://via.placeholder.com/300x400?text=Jonathan'),
('Jim Hopper', 'Adultos', 'El jefe de policía de Hawkins, un hombre rudo con un pasado trágico. Se convierte en la figura paterna de Eleven y en el líder de la lucha contra las fuerzas del Mundo del Revés.', 1, 'https://via.placeholder.com/300x400?text=Hopper'),
('Joyce Byers', 'Adultos', 'La madre de Will y Jonathan, una mujer trabajadora y determinada que nunca se rinde. Su amor maternal y su intuición son fundamentales para salvar a sus hijos.', 1, 'https://via.placeholder.com/300x400?text=Joyce'),
('Demogorgon', 'Villanos', 'La primera criatura del Mundo del Revés que aparece en Hawkins. Es un depredador mortal sin rostro que caza a sus víctimas usando su sentido del olfato para detectar la sangre.', 1, 'https://via.placeholder.com/300x400?text=Demogorgon'),
('Vecna', 'Villanos', 'Henry Creel, también conocido como Uno, es el principal antagonista de la cuarta temporada. Un ser poderoso del Mundo del Revés que atormenta a sus víctimas con sus traumas.', 4, 'https://via.placeholder.com/300x400?text=Vecna');

