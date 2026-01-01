


CREATE DATABASE KHATRiii

    CREATE TABLE users (
        id INT AUTO_ENCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL UNIQUE,
        passowrd VARCHAR(255) NOT NULL,
        role ENUM('reader','author','admin') NOT NULL DEFAULT 'reader',
        active BOOLEAN DEFAULT FALSE,
        count_report INT DEFAULT 0,
        start_report DATETIME,
        end_report DATETIME,
        create_at DATETIME DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE articles (
        id INT AUTO_ENCREMENT PRIMARY KEY,
        id_user INT NOT NULL,
        title VARCHAR(100) NOT NULL,
        content LONGTEXT NOT NULL,
        create_at DATETIME NOT NULL,
        FOREIGN KEY (id_user) REFERENCES users(id)
    );

    CREATE TABLE categories (
        id INT AUTO_ENCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL
    );

    CREATE TABLE article_categorie (
        id_article INT NOT NULL,
        id_categorie INT NOT NULL,
        PRIMARY KEY (id_article,id_categorie),
        FOREIGN KEY (id_article) REFERENCES articles (id),
        FOREIGN KEY (id_categorie) REFERENCES categories (id)
    );

    CREATE TABLE commentaires (
        id INT AUTO_ENCREMENT PRIMARY KEY,
        id_article INT NOT NULL,
        id_reader INT NOT NULL,
        content TEXT NOT NULL,
        create_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_article) REFERENCES articles (id),
        FOREIGN KEY (id_reader) REFERENCES users (id)
    );

    CREATE TABLE like_article (
        id_article INT NOT NULL,
        id_reader INT NOT NULL,
        PRIMARY KEY (id_article,id_reader),
        FOREIGN KEY (id_article) REFERENCES articles (id),
        FOREIGN KEY (id_reader) REFERENCES users (id)
    );

    CREATE TABLE like_commentaire (
        id_reader INT NOT NULL,
        id_article INT NOT NULL,
        id_commentaire INT NOT NULL,
        PRIMARY KEY (id_commentaire, id_reader),
        FOREIGN KEY (id_reader) REFERENCES users(id),
        FOREIGN KEY (id_article) REFERENCES articles(id),
        FOREIGN KEY (id_commentaire) REFERENCES commentaires(id)
    );


    --     history 
    --     philosophy 
    --     science 
    --     other 