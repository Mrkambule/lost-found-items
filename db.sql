
-- Create database (you can change the DB name)
CREATE DATABASE IF NOT EXISTS lostfound_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lostfound_db;

-- Items table (both lost and found)
CREATE TABLE IF NOT EXISTS items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  type ENUM('lost','found') NOT NULL,
  name VARCHAR(255) NOT NULL,
  category VARCHAR(100) NOT NULL,
  description TEXT,
  location VARCHAR(255),
  date_when DATE,
  date_reported TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  photo_path VARCHAR(255),
  reporter_name VARCHAR(100),
  reporter_email VARCHAR(150),
  status ENUM('open','claimed','returned') DEFAULT 'open'
) ENGINE=InnoDB;

-- Admins table (DEMO: password stored in plaintext for simplicity; change to password_hash in production)
CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE NOT NULL,
  password_plain VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Default admin user (username: admin, password: admin123)
INSERT IGNORE INTO admins (username, password_plain) VALUES ('admin', 'admin123');
