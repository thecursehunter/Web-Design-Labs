<?php
// db_check.php - Checks if the database and tables are properly set up

// Include database configuration
require_once 'config.php';

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h2>Database Connection Check</h2>";
echo "<p>Connected to MySQL successfully!</p>";

// Check if database exists
$result = $conn->query("SHOW DATABASES LIKE '" . DB_NAME . "'");
if ($result->num_rows > 0) {
    echo "<p>Database '" . DB_NAME . "' exists.</p>";
    
    // Select the database
    $conn->select_db(DB_NAME);
    
    // Check if users table exists
    $result = $conn->query("SHOW TABLES LIKE 'users'");
    if ($result->num_rows > 0) {
        echo "<p>Table 'users' exists.</p>";
        
        // Check structure
        $result = $conn->query("DESCRIBE users");
        echo "<h3>Table Structure:</h3>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>{$row['Field']} - {$row['Type']}</li>";
        }
        echo "</ul>";
        
        // Check sample data
        $result = $conn->query("SELECT * FROM users LIMIT 5");
        echo "<h3>Sample Data:</h3>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Username</th><th>Password</th><th>URL</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['password']}</td>";
            echo "<td>{$row['url']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Table 'users' does not exist. Please run the SQL setup script:</p>";
        echo "<pre>
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
        </pre>";
    }
} else {
    echo "<p>Database '" . DB_NAME . "' does not exist. Please create it and run the setup script.</p>";
}

$conn->close();
?>