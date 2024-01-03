CREATE TABLE corsi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome varchar(50) NOT NULL,
    materia varchar(50) NOT NULL,
    posti_disponibili INT NOT NULL
);

CREATE TABLE IF NOT EXISTS materie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);