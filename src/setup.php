<?php
/**
 * Database Setup Script
 * Run this script once to automatically create the database and import all tables
 */

// Configuration
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'sales_data';
$port = 3306;

// SQL files to import in order
$sqlFiles = [
    '../database/sql/Address.sql',
    '../database/sql/Customer.sql',
    '../database/sql/Contact.sql',
    '../database/sql/DomesticCustomer.sql',
    '../database/sql/InternationalCustomer.sql',
    '../database/sql/Product_Line.sql',
    '../database/sql/Product.sql',
    '../database/sql/Orders.sql',
    '../database/sql/Order_Line.sql'
];

$results = [];
$errors = [];

// Step 1: Connect to MySQL (without database)
try {
    $conn = new mysqli($host, $user, $pass, '', $port);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    $results[] = "✓ Successfully connected to MySQL server";
    
    // Step 2: Create database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8 COLLATE utf8_general_ci";
    if ($conn->query($sql) === TRUE) {
        $results[] = "✓ Database '$dbname' created or already exists";
    } else {
        throw new Exception("Error creating database: " . $conn->error);
    }
    
    // Step 3: Select the database
    $conn->select_db($dbname);
    $results[] = "✓ Selected database '$dbname'";
    
    // Step 4: Import SQL files
    foreach ($sqlFiles as $index => $file) {
        $fileName = basename($file);
        
        if (!file_exists($file)) {
            $errors[] = "✗ File not found: $fileName";
            continue;
        }
        
        $sql = file_get_contents($file);
        
        if ($sql === false) {
            $errors[] = "✗ Could not read file: $fileName";
            continue;
        }
        
        // Split SQL file into individual statements
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        
        $successCount = 0;
        $errorCount = 0;
        
        foreach ($statements as $statement) {
            if (empty($statement)) continue;
            
            if ($conn->query($statement) === TRUE) {
                $successCount++;
            } else {
                $errorCount++;
                if ($errorCount <= 3) { // Only show first 3 errors per file
                    $errors[] = "  Error in $fileName: " . $conn->error;
                }
            }
        }
        
        if ($errorCount == 0) {
            $results[] = "✓ Imported $fileName ($successCount statements)";
        } else {
            $results[] = "⚠ Imported $fileName with errors ($successCount successful, $errorCount failed)";
        }
    }
    
    $results[] = "✓ Database setup completed!";
    
    $conn->close();
    
} catch (Exception $e) {
    $errors[] = "✗ Fatal error: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup - Sales Data System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        h1 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 2rem;
        }
        
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }
        
        .results, .errors {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            max-height: 400px;
            overflow-y: auto;
        }
        
        .results {
            border-left: 4px solid #28a745;
        }
        
        .errors {
            border-left: 4px solid #dc3545;
        }
        
        .results h2 {
            color: #28a745;
            margin-bottom: 15px;
        }
        
        .errors h2 {
            color: #dc3545;
            margin-bottom: 15px;
        }
        
        .results ul, .errors ul {
            list-style: none;
            padding: 0;
        }
        
        .results li, .errors li {
            padding: 8px;
            margin: 5px 0;
            background: white;
            border-radius: 5px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
        }
        
        .success {
            color: #28a745;
        }
        
        .error {
            color: #dc3545;
        }
        
        .warning {
            color: #ffc107;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: transform 0.3s ease;
            margin-top: 20px;
        }
        
        .btn:hover {
            transform: scale(1.05);
        }
        
        .warning-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        
        .info-box {
            background: #d1ecf1;
            border-left: 4px solid #17a2b8;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🗄️ Database Setup</h1>
        <p class="subtitle">Automated database creation and SQL import tool</p>
        
        <?php if (empty($errors) || count($results) > 1): ?>
            <div class="results">
                <h2>✓ Setup Results</h2>
                <ul>
                    <?php foreach ($results as $result): ?>
                        <li><?php echo htmlspecialchars($result); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <h2>✗ Errors Encountered</h2>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div class="warning-box">
                <strong>⚠️ Troubleshooting:</strong>
                <ul style="margin-top: 10px; padding-left: 20px;">
                    <li>Make sure XAMPP MySQL service is running</li>
                    <li>Verify SQL files exist in the correct location</li>
                    <li>Check MySQL credentials in this file</li>
                    <li>Try importing files manually via phpMyAdmin</li>
                </ul>
            </div>
        <?php else: ?>
            <div class="info-box">
                <strong>✓ Setup Complete!</strong><br>
                Your database has been successfully created and populated with data.
                You can now access the main application.
            </div>
        <?php endif; ?>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="index.php" class="btn">Go to Application →</a>
        </div>
        
        <div style="margin-top: 40px; padding-top: 20px; border-top: 2px solid #e9ecef;">
            <h3 style="color: #667eea; margin-bottom: 15px;">Manual Setup Alternative</h3>
            <p style="line-height: 1.8; color: #666;">
                If the automatic setup fails, you can manually create the database:<br><br>
                1. Open <a href="http://localhost/phpmyadmin" target="_blank" style="color: #667eea;">phpMyAdmin</a><br>
                2. Create a new database named <code style="background: #f0f0f0; padding: 2px 8px; border-radius: 3px;">sales_data</code><br>
                3. Import each SQL file from <code style="background: #f0f0f0; padding: 2px 8px; border-radius: 3px;">database/sql/</code> folder in order<br>
                4. Refresh this page or go to the application
            </p>
        </div>
    </div>
</body>
</html>
