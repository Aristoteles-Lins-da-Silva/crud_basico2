CREATE DATABASE banco_academia;

USE banco_academia;


CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    matricula VARCHAR(50) NOT NULL UNIQUE,
    data_nascimento DATE NOT NULL,
    contato VARCHAR(100) NOT NULL,
    peso    FLOAT(10,2) NOT NULL,
    altura FLOAT(1,2) NOT NULL,
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);