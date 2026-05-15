<?php
// Get selected table from query parameter
$selectedTable = isset($_GET['table']) ? $_GET['table'] : 'Customer';

// Define available tables with their display names
$tables = [
    'Address' => 'Address',
    'Customer' => 'Customer',
    'Contact' => 'Contact',
    'DomesticCustomer' => 'Domestic Customer',
    'InternationalCustomer' => 'International Customer',
    'Product_Line' => 'Product Line',
    'Product' => 'Product',
    'Orders' => 'Orders',
    'Order_Line' => 'Order Line'
];

// Sanitize table name to prevent SQL injection
if (!array_key_exists($selectedTable, $tables)) {
    $selectedTable = 'Customer';
}
?>

<div class="card">
    <h2>View Database Data</h2>
    <p>Browse the actual data stored in the database tables. Select a table from the dropdown below to view its contents.</p>

    <div class="table-selector">
        <label for="tableSelect">Select Table:</label>
        <select id="tableSelect" name="table" onchange="window.location.href='index.php?page=data&table=' + this.value">
            <?php foreach ($tables as $value => $label): ?>
                <option value="<?php echo $value; ?>" <?php echo $selectedTable == $value ? 'selected' : ''; ?>>
                    <?php echo $label; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="card">
    <h2><?php echo $tables[$selectedTable]; ?> Data</h2>
    
    <?php
    try {
        $conn = getDBConnection();
        
        // Get data from selected table
        $query = "SELECT * FROM $selectedTable LIMIT 100";
        $result = $conn->query($query);
        
        if ($result && $result->num_rows > 0) {
            // Get column names
            $fields = $result->fetch_fields();
            
            echo '<div style="overflow-x: auto;">';
            echo '<table class="data-table">';
            echo '<thead><tr>';
            
            // Display column headers
            foreach ($fields as $field) {
                echo '<th>' . htmlspecialchars($field->name) . '</th>';
            }
            echo '</tr></thead>';
            
            echo '<tbody>';
            
            // Display data rows
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                foreach ($row as $value) {
                    // Handle NULL values
                    if ($value === null) {
                        echo '<td style="color: #999; font-style: italic;">NULL</td>';
                    } else {
                        echo '<td>' . htmlspecialchars($value) . '</td>';
                    }
                }
                echo '</tr>';
            }
            
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            
            // Display row count
            echo '<div class="alert alert-info mt-20">';
            echo '<strong>Total Rows:</strong> ' . $result->num_rows;
            if ($result->num_rows >= 100) {
                echo ' (Showing first 100 rows)';
            }
            echo '</div>';
            
        } else {
            echo '<div class="alert alert-error">No data found in the selected table or table is empty.</div>';
        }
        
        // Get total count
        $countQuery = "SELECT COUNT(*) as total FROM $selectedTable";
        $countResult = $conn->query($countQuery);
        if ($countResult) {
            $countRow = $countResult->fetch_assoc();
            echo '<div class="alert alert-info">';
            echo '<strong>Total Records in ' . $tables[$selectedTable] . ':</strong> ' . $countRow['total'];
            echo '</div>';
        }
        
        $conn->close();
        
    } catch (Exception $e) {
        echo '<div class="alert alert-error">';
        echo '<strong>Error:</strong> Unable to retrieve data from the database.<br>';
        echo 'Error message: ' . htmlspecialchars($e->getMessage());
        echo '</div>';
        echo '<div class="alert alert-info mt-20">';
        echo '<strong>Troubleshooting Tips:</strong>';
        echo '<ul style="margin-top: 10px; padding-left: 20px;">';
        echo '<li>Make sure XAMPP MySQL service is running</li>';
        echo '<li>Verify that the database "sales_data" exists in phpMyAdmin</li>';
        echo '<li>Ensure all SQL files have been imported correctly</li>';
        echo '<li>Check database credentials in config.php</li>';
        echo '</ul>';
        echo '</div>';
    }
    ?>
</div>

<?php if (isset($conn)): ?>
<div class="card">
    <h2>Query Information</h2>
    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; font-family: 'Courier New', monospace;">
        <strong>SQL Query:</strong><br>
        <code style="color: #667eea;">SELECT * FROM <?php echo $selectedTable; ?> LIMIT 100</code>
    </div>
    
    <h3 style="margin-top: 20px;">Column Information</h3>
    <?php
    try {
        $conn = getDBConnection();
        $infoQuery = "DESCRIBE $selectedTable";
        $infoResult = $conn->query($infoQuery);
        
        if ($infoResult) {
            echo '<table class="data-table">';
            echo '<thead><tr>';
            echo '<th>Column Name</th>';
            echo '<th>Data Type</th>';
            echo '<th>Null</th>';
            echo '<th>Key</th>';
            echo '<th>Default</th>';
            echo '<th>Extra</th>';
            echo '</tr></thead>';
            echo '<tbody>';
            
            while ($info = $infoResult->fetch_assoc()) {
                echo '<tr>';
                echo '<td><strong>' . htmlspecialchars($info['Field']) . '</strong></td>';
                echo '<td>' . htmlspecialchars($info['Type']) . '</td>';
                echo '<td>' . htmlspecialchars($info['Null']) . '</td>';
                echo '<td>' . htmlspecialchars($info['Key']) . '</td>';
                echo '<td>' . ($info['Default'] !== null ? htmlspecialchars($info['Default']) : '<span style="color: #999;">NULL</span>') . '</td>';
                echo '<td>' . htmlspecialchars($info['Extra']) . '</td>';
                echo '</tr>';
            }
            
            echo '</tbody>';
            echo '</table>';
        }
        
        $conn->close();
    } catch (Exception $e) {
        echo '<div class="alert alert-error">Unable to retrieve column information.</div>';
    }
    ?>
</div>
<?php endif; ?>
