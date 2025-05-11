<?php
// User.php - The Model component containing our User class
// This follows OOP principles with encapsulation of properties

class User {
    // Private properties according to requirements
    private $id;
    private $username;
    private $password;
    private $url;
    
    // Database connection
    private $conn;
    
    // Constructor - initializes database connection
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Getters and setters for each property
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function setUsername($username) {
        $this->username = $username;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getUrl() {
        return $this->url;
    }
    
    public function setUrl($url) {
        $this->url = $url;
    }
    
    // Method to search for users based on username
    public function searchUsers($keyword) {
        // Prepare SQL statement with placeholder for search term
        // Using prepared statements prevents SQL injection
        $query = "SELECT * FROM users WHERE username LIKE ?";
        $stmt = $this->conn->prepare($query);
        
        // Check if statement preparation failed
        if (!$stmt) {
            throw new Exception("Database error: " . $this->conn->error);
        }
        
        // Add wildcards for partial matching
        $searchTerm = "%" . $keyword . "%";
        $stmt->bind_param("s", $searchTerm);
        
        // Execute query
        if (!$stmt->execute()) {
            throw new Exception("Query execution failed: " . $stmt->error);
        }
        
        $result = $stmt->get_result();
        
        // Return the result set
        return $result;
    }
    
    // Method to get a single user by ID
    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // Set object properties
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->password = $row['password'];
            $this->url = $row['url'];
            
            return true;
        }
        
        return false;
    }
}
?>