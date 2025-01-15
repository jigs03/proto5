CREATE DATABASE smartdegreeupnm;

USE smartdegreeupnm;

CREATE TABLE files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uploader_role ENUM('Staf PPAP', 'Staf PAP', 'admin') NOT NULL,
    name VARCHAR(255) NOT NULL,
    path VARCHAR(255) NOT NULL,
    target_role ENUM('admin', 'Staf PPAP', 'Staf PAP', 'all') NOT NULL,
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE files ADD COLUMN is_deleted TINYINT(1) DEFAULT 0;


