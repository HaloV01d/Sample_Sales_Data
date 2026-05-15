<div class="card">
    <h2>Entity-Relationship Diagram</h2>
    <p>The E/R diagram below illustrates the conceptual design of the Sales Data Management System, showing entities, attributes, and relationships between different components of the database.</p>
</div>

<div class="diagram-container">
    <?php
    $imagePath = '../diagram/Sample Sales ER Diagram.png';
    if (file_exists($imagePath)) {
        echo '<img src="' . $imagePath . '" alt="Sales Data E/R Diagram" />';
    } else {
        echo '<div class="alert alert-error">E/R Diagram image not found at: ' . $imagePath . '</div>';
        echo '<p>Please ensure the diagram file exists in the diagram folder.</p>';
    }
    ?>
    
    <div class="diagram-description">
        <h3>Diagram Components Explanation</h3>
        
        <div class="table-schema">
            <h4>🔷 Entities</h4>
            <p>The diagram contains the following main entities:</p>
            <ul style="list-style: disc; padding-left: 30px; line-height: 1.8;">
                <li><strong>Customer:</strong> Represents customers who place orders</li>
                <li><strong>DomesticCustomer / InternationalCustomer:</strong> Specialization of Customer entity</li>
                <li><strong>Address:</strong> Physical locations associated with customers</li>
                <li><strong>Contact:</strong> Contact persons for each customer</li>
                <li><strong>Orders:</strong> Purchase orders placed by customers</li>
                <li><strong>Order_Line:</strong> Individual line items within each order</li>
                <li><strong>Product:</strong> Items available for purchase</li>
                <li><strong>Product_Line:</strong> Categories of products</li>
            </ul>
        </div>

        <div class="table-schema">
            <h4>🔗 Relationships</h4>
            <ul style="list-style: disc; padding-left: 30px; line-height: 1.8;">
                <li><strong>Customer → Address:</strong> Many-to-One (each customer has one address)</li>
                <li><strong>Customer → Contact:</strong> One-to-Many (each customer can have multiple contacts)</li>
                <li><strong>Customer → Orders:</strong> One-to-Many (each customer can place multiple orders)</li>
                <li><strong>Orders → Order_Line:</strong> One-to-Many (each order contains multiple line items)</li>
                <li><strong>Order_Line → Product:</strong> Many-to-One (each line item references one product)</li>
                <li><strong>Product → Product_Line:</strong> Many-to-One (each product belongs to one product line)</li>
                <li><strong>Customer → DomesticCustomer/InternationalCustomer:</strong> ISA relationship (inheritance)</li>
            </ul>
        </div>

        <div class="table-schema">
            <h4>🔑 Key Constraints</h4>
            <ul style="list-style: disc; padding-left: 30px; line-height: 1.8;">
                <li>All entities have primary keys for unique identification</li>
                <li>Foreign keys maintain referential integrity between related tables</li>
                <li>The Customer entity uses a generalization/specialization hierarchy</li>
                <li>Composite primary key in Order_Line (ORDERNUMBER, ORDERLINENUMBER)</li>
            </ul>
        </div>
    </div>
</div>

<div class="card mt-20">
    <h2>Download Options</h2>
    <p>The E/R diagram is available in the following formats:</p>
    <ul style="line-height: 2;">
        <li><a href="../diagram/Sample Sales ER Diagram.png" download style="color: #667eea; font-weight: bold;">📥 Download PNG Image</a></li>
        <li><a href="../diagram/Sample Sales ER Diagram.pdf" download style="color: #667eea; font-weight: bold;">📥 Download PDF Document</a></li>
    </ul>
</div>
