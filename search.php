<?php
// search.php - Handles AJAX search requests

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0); // Don't display errors directly

// Set content type to JSON
header('Content-Type: application/json');

// Try-catch block to catch any errors
try {
    // Include the controller
    require_once 'UserController.php';

    // Check if search keyword is provided
    if (isset($_GET['keyword'])) {
        // Get the search keyword
        $keyword = $_GET['keyword'];
        
        // Create controller instance
        $controller = new UserController();
        
        // Perform search
        $results = $controller->searchUsers($keyword);
        
        // Return the results as JSON
        echo json_encode($results);
    } else {
        // If no keyword provided, return empty array
        echo json_encode([]);
    }
} catch (Exception $e) {
    // Return error as JSON
    echo json_encode(['error' => $e->getMessage()]);
}
?>