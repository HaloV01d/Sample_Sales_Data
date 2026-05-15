<div class="card">
    <h2>Welcome to Sales Data Management System</h2>
    <p>This web application provides comprehensive access to the sales database, including E/R diagrams, relational schema documentation, and data viewing capabilities.</p>
    
    <div class="alert alert-info mt-20">
        <strong>ℹ️ About This System:</strong> This is an academic database project demonstrating normalized relational database design for a sales management system. The system tracks customers, orders, products, and related entities with proper relational integrity.
    </div>

    <h3>Database Overview</h3>
    <p>The Sales Data Management System contains the following key components:</p>

    <div class="feature-grid">
        <div class="feature-card" onclick="location.href='index.php?page=er-diagram'">
            <h3>📊 E/R Diagram</h3>
            <p>View the Entity-Relationship diagram showing the conceptual database design and relationships between entities.</p>
        </div>

        <div class="feature-card" onclick="location.href='index.php?page=schema'">
            <h3>🗂️ Database Schema</h3>
            <p>Explore detailed relational schema with complete attribute descriptions, data types, and constraints for all tables.</p>
        </div>

        <div class="feature-card" onclick="location.href='index.php?page=data'">
            <h3>📋 View Data</h3>
            <p>Browse actual data stored in the database tables with an interactive table viewer.</p>
        </div>
    </div>
</div>

<div class="card">
    <h2>Database Statistics</h2>
    <?php
    try {
        $conn = getDBConnection();
        
        // Get table counts
        $tables = [
            'Customer' => 'Customers',
            'Orders' => 'Orders',
            'Order_Line' => 'Order Lines',
            'Product' => 'Products',
            'Product_Line' => 'Product Lines',
            'Address' => 'Addresses',
            'Contact' => 'Contacts',
            'DomesticCustomer' => 'Domestic Customers',
            'InternationalCustomer' => 'International Customers'
        ];
        
        echo '<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-top: 20px;">';
        
        foreach ($tables as $table => $label) {
            $result = $conn->query("SELECT COUNT(*) as count FROM $table");
            if ($result) {
                $row = $result->fetch_assoc();
                $count = $row['count'];
                echo '<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 8px; text-align: center;">';
                echo '<div style="font-size: 2rem; font-weight: bold;">' . $count . '</div>';
                echo '<div style="font-size: 0.9rem; opacity: 0.9;">' . $label . '</div>';
                echo '</div>';
            }
        }
        
        echo '</div>';
        
        $conn->close();
    } catch (Exception $e) {
        echo '<div class="alert alert-error">Unable to fetch statistics: ' . $e->getMessage() . '</div>';
        echo '<p><strong>Note:</strong> Make sure you have created the database and imported the SQL files. See instructions below.</p>';
    }
    ?>
</div>

<div class="card">
    <h2>Setup Instructions</h2>
    <ol style="line-height: 2;">
        <li><strong>Start XAMPP:</strong> Launch XAMPP Control Panel and start Apache and MySQL services.</li>
        <li><strong>Create Database:</strong> Open phpMyAdmin (http://localhost/phpmyadmin) and create a new database named <span class="highlight">sales_data</span>.</li>
        <li><strong>Import SQL Files:</strong> In phpMyAdmin, select the <span class="highlight">sales_data</span> database and import all SQL files from the <code>database/sql/</code> folder in the correct order:
            <ul style="margin-top: 10px;">
                <li>1. Address.sql</li>
                <li>2. Customer.sql</li>
                <li>3. Contact.sql</li>
                <li>4. DomesticCustomer.sql</li>
                <li>5. InternationalCustomer.sql</li>
                <li>6. Product_Line.sql</li>
                <li>7. Product.sql</li>
                <li>8. Orders.sql</li>
                <li>9. Order_Line.sql</li>
            </ul>
        </li>
        <li><strong>Configure Connection:</strong> If needed, update database credentials in <code>config.php</code>.</li>
        <li><strong>Access Application:</strong> Navigate to <a href="http://localhost/Sample_Sales_Data/src/" target="_blank">http://localhost/Sample_Sales_Data/src/</a></li>
    </ol>
</div>
