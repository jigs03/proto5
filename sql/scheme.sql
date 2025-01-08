CREATE DATABASE smartdegreeupnm;

USE smartdegreeupnm;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'Staf PPAP', 'Staf PAP') NOT NULL
);

CREATE TABLE files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uploader_role ENUM('Staf PPAP', 'Staf PAP', 'admin') NOT NULL,
    name VARCHAR(255) NOT NULL,
    path VARCHAR(255) NOT NULL,
    target_role ENUM('admin', 'Staf PPAP', 'Staf PAP', 'all') NOT NULL,
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



