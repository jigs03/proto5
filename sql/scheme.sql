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
    uploader_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(100),
    size INT,
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    role_access ENUM('admin', 'Staf PPAP', 'Staf PAP', 'all') NOT NULL,
    FOREIGN KEY (uploader_id) REFERENCES users(id)
);

);
ALTER TABLE files ADD role_access ENUM('admin', 'Staf PPAP', 'Staf PAP', 'all') NOT NULL;
