<?php
// UserController.php - The Controller component handling user operations
// This connects the User model with the view

require_once 'User.php';
require_once 'config.php';

class UserController {
    private $user;
    private $db;
    
    // Constructor - initializes the controller with database connection
    public function __construct() {
        // Create database connection
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        // Check connection
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
        
        // Create User model instance
        $this->user = new User($this->db);
    }
    
    // Method to search for users
    public function searchUsers($keyword) {
        // Use the model to perform the search
        $result = $this->user->searchUsers($keyword);
        
        // Create an array to hold the results
        $users = [];
        
        // Loop through results and add to array
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        
        // Return the results
        return $users;
    }
    
    // Method to get a user by ID
    public function getUserById($id) {
        if ($this->user->getUserById($id)) {
            // Return user details as an associative array
            return [
                'id' => $this->user->getId(),
                'username' => $this->user->getUsername(),
                'password' => $this->user->getPassword(),
                'url' => $this->user->getUrl()
            ];
        }
        
        return null;
    }
    
    // Close database connection when done
    public function __destruct() {
        $this->db->close();
    }
}
?>