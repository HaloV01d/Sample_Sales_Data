<?php
/**
 * Sales Data Management System
 * Main Dashboard Page
 */

require_once 'config.php';

// Test database connection
$connectionStatus = testConnection();

// Get page parameter
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Data Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <h1 class="nav-title">Sales Data Management System</h1>
            <ul class="nav-menu">
                <li><a href="index.php?page=home" class="<?php echo $page == 'home' ? 'active' : ''; ?>">Home</a></li>
                <li><a href="index.php?page=er-diagram" class="<?php echo $page == 'er-diagram' ? 'active' : ''; ?>">E/R Diagram</a></li>
                <li><a href="index.php?page=schema" class="<?php echo $page == 'schema' ? 'active' : ''; ?>">Database Schema</a></li>
                <li><a href="index.php?page=data" class="<?php echo $page == 'data' ? 'active' : ''; ?>">View Data</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Connection Status Banner -->
        <div class="alert <?php echo $connectionStatus['success'] ? 'alert-success' : 'alert-error'; ?>">
            <strong><?php echo $connectionStatus['success'] ? '✓' : '✗'; ?></strong>
            <?php echo $connectionStatus['message']; ?>
        </div>

        <?php
        // Include the appropriate page content
        switch($page) {
            case 'er-diagram':
                include 'pages/er_diagram.php';
                break;
            case 'schema':
                include 'pages/schema.php';
                break;
            case 'data':
                include 'pages/view_data.php';
                break;
            case 'home':
            default:
                include 'pages/home.php';
                break;
        }
        ?>
    </div>

    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> Sales Data Management System. Database project for academic purposes.</p>
    </footer>
</body>
</html>
