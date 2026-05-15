<?php
/**
 * Database Configuration for XAMPP
 * 
 * Default XAMPP MySQL Settings:
 * - Host: localhost
 * - Username: root
 * - Password: (empty by default)
 * - Port: 3306
 */

// Database configuration constants
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sales_data');
define('DB_PORT', '3306');

/**
 * Get database connection
 * 
 * @return mysqli Database connection object
 * @throws Exception if connection fails
 */
function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset to utf8
    $conn->set_charset("utf8");
    
    return $conn;
}

/**
 * Test database connection
 * 
 * @return array Status array with 'success' boolean and 'message' string
 */
function testConnection() {
    try {
        $conn = getDBConnection();
        $result = [
            'success' => true,
            'message' => 'Successfully connected to database: ' . DB_NAME
        ];
        $conn->close();
        return $result;
    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => 'Connection failed: ' . $e->getMessage()
        ];
    }
}
?>
