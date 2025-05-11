<?php
// config.php - Database connection parameters

// Define constants for database connection
define('DB_HOST', 'localhost');
define('DB_USER', 'root');     // Change to your MySQL username
define('DB_PASS', '');         // Change to your MySQL password
define('DB_NAME', 'lab 10');  // Change to your database name

// You'll need to create a database and users table with this structure:
/*
CREATE DATABASE user_db;
USE user_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    url VARCHAR(255) NOT NULL
);

-- Add some sample data
INSERT INTO users (username, password, url) VALUES 
('danh', '123456', 'https://example.com/danh.jpg'),
('yukari', 'persona3', 'https://example.com/yukari.jpg'),
('junpei', 'stupei', 'https://example.com/junpei.jpg');
*/
?>