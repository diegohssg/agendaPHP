CREATE DATABASE agenda_db;
USE agenda_db;
CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    cliente VARCHAR(255) NOT NULL,
    data_inicio_visita DATETIME NOT NULL,
    data_fim_visita DATETIME NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    status VARCHAR(20) NOT NULL
);