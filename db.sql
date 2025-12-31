
-- column active = true or false in table user

CREATE DATABASE khatriii

    CREATE TABLE users (
        id INT AUTO_ENCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL UNIQUE,
        passowrd VARCHAR(255) NOT NULL,
        create_at DATETIME DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE roles (
        id_user INT NOT NULL UNIQUE,
        first_name VARCHAR(50),
        role ENUM('reader','author','admin') NOT NULL DEFAULT 'reader'
    );

    CREATE TABLE articles (
        id INT AUTO_ENCREMENT PRIMARY KEY,
        id_user INT NOT NULL,
        title VARCHAR(100) NOT NULL,
        name_author VARCHAR(50),
        content LONGTEXT NOT NULL,
        create_at DATETIME NOT NULL,
        category ENUM('history','philosophy','science') NOT NULL
    );

    CREATE TABLE commentaires (
        id INT AUTO_ENCREMENT PRIMARY KEY,
        id_article INT NOT NULL,
        id_reader INT NOT NULL,
        content TEXT NOT NULL,
        create_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    );

    CREATE TABLE likes (
        id INT AUTO_ENCREMENT PRIMARY KEY,
        id_article INT NOT NULL,
        id_reader INT NOT NULL,
    );

