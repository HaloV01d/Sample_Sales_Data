<div class="card">
    <h2>Relational Database Schema</h2>
    <p>Complete documentation of all tables, attributes, data types, and constraints in the Sales Data Management System.</p>
</div>

<!-- Address Table -->
<div class="card">
    <div class="table-schema">
        <h3>📍 Address</h3>
        <p><strong>Description:</strong> Stores physical address information for customers including street addresses, city, state, postal code, country, and territory.</p>
        
        <h4>Attributes:</h4>
        <ul class="attributes-list">
            <li>
                <div>
                    <strong>ADDRESS_ID</strong>
                    <span class="key-indicator">PRIMARY KEY</span>
                    <div class="attribute-type">Unique identifier for each address</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
            <li>
                <div>
                    <strong>ADDRESSLINE1</strong>
                    <div class="attribute-type">Primary address line (street address)</div>
                </div>
                <span class="attribute-type">VARCHAR(255)</span>
            </li>
            <li>
                <div>
                    <strong>ADDRESSLINE2</strong>
                    <div class="attribute-type">Secondary address line (apartment, suite, etc.) - Optional</div>
                </div>
                <span class="attribute-type">VARCHAR(255)</span>
            </li>
            <li>
                <div>
                    <strong>CITY</strong>
                    <div class="attribute-type">City name</div>
                </div>
                <span class="attribute-type">VARCHAR(100)</span>
            </li>
            <li>
                <div>
                    <strong>STATE</strong>
                    <div class="attribute-type">State or province name</div>
                </div>
                <span class="attribute-type">VARCHAR(100)</span>
            </li>
            <li>
                <div>
                    <strong>POSTALCODE</strong>
                    <div class="attribute-type">ZIP or postal code</div>
                </div>
                <span class="attribute-type">VARCHAR(20)</span>
            </li>
            <li>
                <div>
                    <strong>COUNTRY</strong>
                    <div class="attribute-type">Country name</div>
                </div>
                <span class="attribute-type">VARCHAR(100)</span>
            </li>
            <li>
                <div>
                    <strong>TERRITORY</strong>
                    <div class="attribute-type">Geographic territory (e.g., EMEA, APAC) - Optional</div>
                </div>
                <span class="attribute-type">VARCHAR(50)</span>
            </li>
        </ul>
    </div>
</div>

<!-- Customer Table -->
<div class="card">
    <div class="table-schema">
        <h3>👥 Customer</h3>
        <p><strong>Description:</strong> Central table storing customer information including name, phone, and address reference. This is the parent table for DomesticCustomer and InternationalCustomer specializations.</p>
        
        <h4>Attributes:</h4>
        <ul class="attributes-list">
            <li>
                <div>
                    <strong>CUSTOMER_ID</strong>
                    <span class="key-indicator">PRIMARY KEY</span>
                    <div class="attribute-type">Unique identifier for each customer</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
            <li>
                <div>
                    <strong>CUSTOMERNAME</strong>
                    <div class="attribute-type">Full name or company name of the customer</div>
                </div>
                <span class="attribute-type">VARCHAR(255)</span>
            </li>
            <li>
                <div>
                    <strong>PHONE</strong>
                    <div class="attribute-type">Contact phone number (various international formats)</div>
                </div>
                <span class="attribute-type">VARCHAR(50)</span>
            </li>
            <li>
                <div>
                    <strong>ADDRESS_ID</strong>
                    <span class="key-indicator foreign-key">FOREIGN KEY</span>
                    <div class="attribute-type">References Address(ADDRESS_ID) - Customer's physical address</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
        </ul>
    </div>
</div>

<!-- Contact Table -->
<div class="card">
    <div class="table-schema">
        <h3>📞 Contact</h3>
        <p><strong>Description:</strong> Stores contact person information for each customer, including first name and last name.</p>
        
        <h4>Attributes:</h4>
        <ul class="attributes-list">
            <li>
                <div>
                    <strong>CONTACT_ID</strong>
                    <span class="key-indicator">PRIMARY KEY</span>
                    <div class="attribute-type">Unique identifier for each contact</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
            <li>
                <div>
                    <strong>CONTACTFIRSTNAME</strong>
                    <div class="attribute-type">First name of the contact person</div>
                </div>
                <span class="attribute-type">VARCHAR(100)</span>
            </li>
            <li>
                <div>
                    <strong>CONTACTLASTNAME</strong>
                    <div class="attribute-type">Last name of the contact person</div>
                </div>
                <span class="attribute-type">VARCHAR(100)</span>
            </li>
            <li>
                <div>
                    <strong>CUSTOMER_ID</strong>
                    <span class="key-indicator foreign-key">FOREIGN KEY</span>
                    <div class="attribute-type">References Customer(CUSTOMER_ID) - Associated customer</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
        </ul>
    </div>
</div>

<!-- DomesticCustomer Table -->
<div class="card">
    <div class="table-schema">
        <h3>🏠 DomesticCustomer</h3>
        <p><strong>Description:</strong> Specialization of Customer representing customers located within the United States. This implements the ISA relationship in the E/R diagram.</p>
        
        <h4>Attributes:</h4>
        <ul class="attributes-list">
            <li>
                <div>
                    <strong>CUSTOMER_ID</strong>
                    <span class="key-indicator">PRIMARY KEY</span>
                    <span class="key-indicator foreign-key">FOREIGN KEY</span>
                    <div class="attribute-type">References Customer(CUSTOMER_ID) - Inherits from Customer</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
        </ul>
        <p style="margin-top: 15px;"><em>Note: This table uses single-table inheritance pattern where the CUSTOMER_ID serves as both primary key and foreign key to the parent Customer table.</em></p>
    </div>
</div>

<!-- InternationalCustomer Table -->
<div class="card">
    <div class="table-schema">
        <h3>🌍 InternationalCustomer</h3>
        <p><strong>Description:</strong> Specialization of Customer representing customers located outside the United States. This implements the ISA relationship in the E/R diagram.</p>
        
        <h4>Attributes:</h4>
        <ul class="attributes-list">
            <li>
                <div>
                    <strong>CUSTOMER_ID</strong>
                    <span class="key-indicator">PRIMARY KEY</span>
                    <span class="key-indicator foreign-key">FOREIGN KEY</span>
                    <div class="attribute-type">References Customer(CUSTOMER_ID) - Inherits from Customer</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
        </ul>
        <p style="margin-top: 15px;"><em>Note: This table uses single-table inheritance pattern where the CUSTOMER_ID serves as both primary key and foreign key to the parent Customer table.</em></p>
    </div>
</div>

<!-- Product_Line Table -->
<div class="card">
    <div class="table-schema">
        <h3>📦 Product_Line</h3>
        <p><strong>Description:</strong> Categorizes products into distinct product lines (e.g., Classic Cars, Motorcycles, Planes, Ships, etc.).</p>
        
        <h4>Attributes:</h4>
        <ul class="attributes-list">
            <li>
                <div>
                    <strong>PRODUCTLINE_ID</strong>
                    <span class="key-indicator">PRIMARY KEY</span>
                    <div class="attribute-type">Unique identifier for each product line</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
            <li>
                <div>
                    <strong>PRODUCTLINE_NAME</strong>
                    <div class="attribute-type">Name of the product category (e.g., "Classic Cars", "Motorcycles")</div>
                </div>
                <span class="attribute-type">VARCHAR(100)</span>
            </li>
        </ul>
    </div>
</div>

<!-- Product Table -->
<div class="card">
    <div class="table-schema">
        <h3>🏷️ Product</h3>
        <p><strong>Description:</strong> Contains information about products available for sale, including product code, MSRP (Manufacturer's Suggested Retail Price), and product line classification.</p>
        
        <h4>Attributes:</h4>
        <ul class="attributes-list">
            <li>
                <div>
                    <strong>PRODUCTCODE</strong>
                    <span class="key-indicator">PRIMARY KEY</span>
                    <div class="attribute-type">Unique product identifier code</div>
                </div>
                <span class="attribute-type">VARCHAR(50)</span>
            </li>
            <li>
                <div>
                    <strong>MSRP</strong>
                    <div class="attribute-type">Manufacturer's Suggested Retail Price in USD</div>
                </div>
                <span class="attribute-type">DECIMAL(10,2)</span>
            </li>
            <li>
                <div>
                    <strong>PRODUCTLINE_ID</strong>
                    <span class="key-indicator foreign-key">FOREIGN KEY</span>
                    <div class="attribute-type">References Product_Line(PRODUCTLINE_ID) - Product category</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
        </ul>
    </div>
</div>

<!-- Orders Table -->
<div class="card">
    <div class="table-schema">
        <h3>🛒 Orders</h3>
        <p><strong>Description:</strong> Records customer orders with date, status, temporal information (quarter, month, year), and customer reference.</p>
        
        <h4>Attributes:</h4>
        <ul class="attributes-list">
            <li>
                <div>
                    <strong>ORDERNUMBER</strong>
                    <span class="key-indicator">PRIMARY KEY</span>
                    <div class="attribute-type">Unique identifier for each order</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
            <li>
                <div>
                    <strong>ORDERDATE</strong>
                    <div class="attribute-type">Date when the order was placed</div>
                </div>
                <span class="attribute-type">DATE</span>
            </li>
            <li>
                <div>
                    <strong>STATUS</strong>
                    <div class="attribute-type">Current status of the order (e.g., "Shipped", "Processing")</div>
                </div>
                <span class="attribute-type">VARCHAR(50)</span>
            </li>
            <li>
                <div>
                    <strong>QTR_ID</strong>
                    <div class="attribute-type">Quarter of the year (1-4) for reporting purposes</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
            <li>
                <div>
                    <strong>MONTH_ID</strong>
                    <div class="attribute-type">Month number (1-12) for reporting purposes</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
            <li>
                <div>
                    <strong>YEAR_ID</strong>
                    <div class="attribute-type">Year for reporting purposes</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
            <li>
                <div>
                    <strong>CUSTOMER_ID</strong>
                    <span class="key-indicator foreign-key">FOREIGN KEY</span>
                    <div class="attribute-type">References Customer(CUSTOMER_ID) - Customer who placed the order</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
        </ul>
    </div>
</div>

<!-- Order_Line Table -->
<div class="card">
    <div class="table-schema">
        <h3>📋 Order_Line</h3>
        <p><strong>Description:</strong> Represents individual line items within an order, detailing quantity, price, sales amount, product, and deal size. Uses a composite primary key.</p>
        
        <h4>Attributes:</h4>
        <ul class="attributes-list">
            <li>
                <div>
                    <strong>ORDERNUMBER</strong>
                    <span class="key-indicator">PRIMARY KEY (Composite)</span>
                    <span class="key-indicator foreign-key">FOREIGN KEY</span>
                    <div class="attribute-type">References Orders(ORDERNUMBER) - Associated order</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
            <li>
                <div>
                    <strong>ORDERLINENUMBER</strong>
                    <span class="key-indicator">PRIMARY KEY (Composite)</span>
                    <div class="attribute-type">Line item number within the order</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
            <li>
                <div>
                    <strong>QUANTITYORDERED</strong>
                    <div class="attribute-type">Number of units ordered for this line item</div>
                </div>
                <span class="attribute-type">INT</span>
            </li>
            <li>
                <div>
                    <strong>PRICEEACH</strong>
                    <div class="attribute-type">Unit price at the time of order</div>
                </div>
                <span class="attribute-type">DECIMAL(10,2)</span>
            </li>
            <li>
                <div>
                    <strong>SALES</strong>
                    <div class="attribute-type">Total sales amount for this line (QUANTITYORDERED × PRICEEACH)</div>
                </div>
                <span class="attribute-type">DECIMAL(10,2)</span>
            </li>
            <li>
                <div>
                    <strong>PRODUCTCODE</strong>
                    <span class="key-indicator foreign-key">FOREIGN KEY</span>
                    <div class="attribute-type">References Product(PRODUCTCODE) - Product ordered</div>
                </div>
                <span class="attribute-type">VARCHAR(50)</span>
            </li>
            <li>
                <div>
                    <strong>DEALSIZE</strong>
                    <div class="attribute-type">Size category of the deal (e.g., "Small", "Medium", "Large")</div>
                </div>
                <span class="attribute-type">VARCHAR(50)</span>
            </li>
        </ul>
    </div>
</div>

<div class="card">
    <h2>Relationship Summary</h2>
    <div class="table-schema">
        <h4>🔗 Foreign Key Relationships</h4>
        <ul style="list-style: disc; padding-left: 30px; line-height: 2;">
            <li><strong>Customer.ADDRESS_ID → Address.ADDRESS_ID</strong> (Many-to-One)</li>
            <li><strong>Contact.CUSTOMER_ID → Customer.CUSTOMER_ID</strong> (Many-to-One)</li>
            <li><strong>DomesticCustomer.CUSTOMER_ID → Customer.CUSTOMER_ID</strong> (One-to-One, ISA)</li>
            <li><strong>InternationalCustomer.CUSTOMER_ID → Customer.CUSTOMER_ID</strong> (One-to-One, ISA)</li>
            <li><strong>Product.PRODUCTLINE_ID → Product_Line.PRODUCTLINE_ID</strong> (Many-to-One)</li>
            <li><strong>Orders.CUSTOMER_ID → Customer.CUSTOMER_ID</strong> (Many-to-One)</li>
            <li><strong>Order_Line.ORDERNUMBER → Orders.ORDERNUMBER</strong> (Many-to-One)</li>
            <li><strong>Order_Line.PRODUCTCODE → Product.PRODUCTCODE</strong> (Many-to-One)</li>
        </ul>
    </div>
</div>
