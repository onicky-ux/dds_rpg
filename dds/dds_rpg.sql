-- Deleta o banco de dados se ele já existir
DROP DATABASE IF EXISTS dds_rpg;

-- Criação do banco de dados
CREATE DATABASE dds_rpg CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Seleciona o banco de dados
USE dds_rpg;

-- Criação da tabela de usuários
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);

-- Criação da tabela de personagens
CREATE TABLE personagens (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    idade INT,
    genero VARCHAR(20),
    aparencia TEXT,
    historia TEXT,
    raca VARCHAR(50),
    habilidade1 TEXT,
    habilidade2 TEXT,
    habilidade3 TEXT,
    poder1 TEXT,
    poder2 TEXT,
    poder_unico TEXT,
    arma_descricao TEXT,
    arma_poder TEXT,
    pet_aparencia TEXT,
    pet_poder TEXT
);
