import pandas as pd
from pathlib import Path

# ============================================================
# Paths
# ============================================================

input_dir = Path("database/processed_csv")
output_dir = Path("database/sql")
output_dir.mkdir(parents=True, exist_ok=True)

# ============================================================
# Load normalized CSV files
# ============================================================

address_table = pd.read_csv(input_dir / "address.csv")
customer_table = pd.read_csv(input_dir / "customer.csv")
contact_table = pd.read_csv(input_dir / "contact.csv")
domestic_customer = pd.read_csv(input_dir / "domestic_customer.csv")
international_customer = pd.read_csv(input_dir / "international_customer.csv")

product_line_table = pd.read_csv(input_dir / "product_line.csv")
product_table = pd.read_csv(input_dir / "product.csv")
orders_table = pd.read_csv(input_dir / "orders.csv")
order_line_table = pd.read_csv(input_dir / "order_line.csv")

# Keep column names consistent with the SQL table definitions
address_table.columns = address_table.columns.str.upper()
customer_table.columns = customer_table.columns.str.upper()
contact_table.columns = contact_table.columns.str.upper()
domestic_customer.columns = domestic_customer.columns.str.upper()
international_customer.columns = international_customer.columns.str.upper()

product_line_table.columns = product_line_table.columns.str.upper()
product_table.columns = product_table.columns.str.upper()
orders_table.columns = orders_table.columns.str.upper()
order_line_table.columns = order_line_table.columns.str.upper()

# ============================================================
# Helper to format SQL values
# ============================================================

def sql_literal(value):
    if pd.isna(value):
        return "NULL"
    return "'" + str(value).replace("'", "''") + "'"

# ============================================================
# Export Address to SQL
# ============================================================

address_sql_output = output_dir / "Address.sql"

with open(address_sql_output, "w", encoding="utf-8") as f:
    f.write(
        "CREATE TABLE Address (\n"
        "    ADDRESS_ID INT PRIMARY KEY,\n"
        "    ADDRESSLINE1 VARCHAR(255),\n"
        "    ADDRESSLINE2 VARCHAR(255),\n"
        "    CITY VARCHAR(100),\n"
        "    STATE VARCHAR(100),\n"
        "    POSTALCODE VARCHAR(20),\n"
        "    COUNTRY VARCHAR(100),\n"
        "    TERRITORY VARCHAR(50)\n"
        ");\n\n"
    )

    for _, row in address_table.iterrows():
        columns_str = ", ".join(address_table.columns)
        values_str = ", ".join(sql_literal(row[col]) for col in address_table.columns)
        f.write(f"INSERT INTO Address ({columns_str}) VALUES ({values_str});\n")

# ============================================================
# Export Customer to SQL
# ============================================================

customer_sql_output = output_dir / "Customer.sql"

with open(customer_sql_output, "w", encoding="utf-8") as f:
    f.write(
        "CREATE TABLE Customer (\n"
        "    CUSTOMER_ID INT PRIMARY KEY,\n"
        "    CUSTOMERNAME VARCHAR(255),\n"
        "    PHONE VARCHAR(50),\n"
        "    ADDRESS_ID INT,\n"
        "    FOREIGN KEY (ADDRESS_ID) REFERENCES Address(ADDRESS_ID)\n"
        ");\n\n"
    )

    for _, row in customer_table.iterrows():
        columns_str = ", ".join(customer_table.columns)
        values_str = ", ".join(sql_literal(row[col]) for col in customer_table.columns)
        f.write(f"INSERT INTO Customer ({columns_str}) VALUES ({values_str});\n")

# ============================================================
# Export Contact to SQL
# ============================================================

contact_sql_output = output_dir / "Contact.sql"

with open(contact_sql_output, "w", encoding="utf-8") as f:
    f.write(
        "CREATE TABLE Contact (\n"
        "    CONTACT_ID INT PRIMARY KEY,\n"
        "    CONTACTFIRSTNAME VARCHAR(100),\n"
        "    CONTACTLASTNAME VARCHAR(100),\n"
        "    CUSTOMER_ID INT,\n"
        "    FOREIGN KEY (CUSTOMER_ID) REFERENCES Customer(CUSTOMER_ID)\n"
        ");\n\n"
    )

    for _, row in contact_table.iterrows():
        columns_str = ", ".join(contact_table.columns)
        values_str = ", ".join(sql_literal(row[col]) for col in contact_table.columns)
        f.write(f"INSERT INTO Contact ({columns_str}) VALUES ({values_str});\n")

# ============================================================
# Export DomesticCustomer to SQL
# ============================================================

domestic_sql_output = output_dir / "DomesticCustomer.sql"

with open(domestic_sql_output, "w", encoding="utf-8") as f:
    f.write(
        "CREATE TABLE DomesticCustomer (\n"
        "    CUSTOMER_ID INT PRIMARY KEY,\n"
        "    FOREIGN KEY (CUSTOMER_ID) REFERENCES Customer(CUSTOMER_ID)\n"
        ");\n\n"
    )

    for _, row in domestic_customer.iterrows():
        columns_str = ", ".join(domestic_customer.columns)
        values_str = ", ".join(sql_literal(row[col]) for col in domestic_customer.columns)
        f.write(f"INSERT INTO DomesticCustomer ({columns_str}) VALUES ({values_str});\n")

# ============================================================
# Export InternationalCustomer to SQL
# ============================================================

international_sql_output = output_dir / "InternationalCustomer.sql"

with open(international_sql_output, "w", encoding="utf-8") as f:
    f.write(
        "CREATE TABLE InternationalCustomer (\n"
        "    CUSTOMER_ID INT PRIMARY KEY,\n"
        "    FOREIGN KEY (CUSTOMER_ID) REFERENCES Customer(CUSTOMER_ID)\n"
        ");\n\n"
    )

    for _, row in international_customer.iterrows():
        columns_str = ", ".join(international_customer.columns)
        values_str = ", ".join(sql_literal(row[col]) for col in international_customer.columns)
        f.write(f"INSERT INTO InternationalCustomer ({columns_str}) VALUES ({values_str});\n")

# ============================================================
# Export Product_Line to SQL
# ============================================================

product_line_sql_output = output_dir / "Product_Line.sql"

with open(product_line_sql_output, "w", encoding="utf-8") as f:
    f.write(
        "CREATE TABLE Product_Line (\n"
        "    PRODUCTLINE_ID INT PRIMARY KEY,\n"
        "    PRODUCTLINE_NAME VARCHAR(100)\n"
        ");\n\n"
    )

    for _, row in product_line_table.iterrows():
        columns_str = ", ".join(product_line_table.columns)
        values_str = ", ".join(sql_literal(row[col]) for col in product_line_table.columns)
        f.write(f"INSERT INTO Product_Line ({columns_str}) VALUES ({values_str});\n")

# ============================================================
# Export Product to SQL
# ============================================================

product_sql_output = output_dir / "Product.sql"

with open(product_sql_output, "w", encoding="utf-8") as f:
    f.write(
        "CREATE TABLE Product (\n"
        "    PRODUCTCODE VARCHAR(50) PRIMARY KEY,\n"
        "    MSRP DECIMAL(10,2),\n"
        "    PRODUCTLINE_ID INT,\n"
        "    FOREIGN KEY (PRODUCTLINE_ID) REFERENCES Product_Line(PRODUCTLINE_ID)\n"
        ");\n\n"
    )

    for _, row in product_table.iterrows():
        columns_str = ", ".join(product_table.columns)
        values_str = ", ".join(sql_literal(row[col]) for col in product_table.columns)
        f.write(f"INSERT INTO Product ({columns_str}) VALUES ({values_str});\n")

# ============================================================
# Export Orders to SQL
# ============================================================

orders_sql_output = output_dir / "Orders.sql"

with open(orders_sql_output, "w", encoding="utf-8") as f:
    f.write(
        "CREATE TABLE Orders (\n"
        "    ORDERNUMBER INT PRIMARY KEY,\n"
        "    ORDERDATE DATE,\n"
        "    STATUS VARCHAR(50),\n"
        "    QTR_ID INT,\n"
        "    MONTH_ID INT,\n"
        "    YEAR_ID INT,\n"
        "    CUSTOMER_ID INT,\n"
        "    FOREIGN KEY (CUSTOMER_ID) REFERENCES Customer(CUSTOMER_ID)\n"
        ");\n\n"
    )

    for _, row in orders_table.iterrows():
        columns_str = ", ".join(orders_table.columns)
        values_str = ", ".join(sql_literal(row[col]) for col in orders_table.columns)
        f.write(f"INSERT INTO Orders ({columns_str}) VALUES ({values_str});\n")

# ============================================================
# Export Order_Line to SQL
# ============================================================

order_line_sql_output = output_dir / "Order_Line.sql"

with open(order_line_sql_output, "w", encoding="utf-8") as f:
    f.write(
        "CREATE TABLE Order_Line (\n"
        "    ORDERNUMBER INT,\n"
        "    ORDERLINENUMBER INT,\n"
        "    QUANTITYORDERED INT,\n"
        "    PRICEEACH DECIMAL(10,2),\n"
        "    SALES DECIMAL(10,2),\n"
        "    PRODUCTCODE VARCHAR(50),\n"
        "    DEALSIZE VARCHAR(50),\n"
        "    PRIMARY KEY (ORDERNUMBER, ORDERLINENUMBER),\n"
        "    FOREIGN KEY (ORDERNUMBER) REFERENCES Orders(ORDERNUMBER),\n"
        "    FOREIGN KEY (PRODUCTCODE) REFERENCES Product(PRODUCTCODE)\n"
        ");\n\n"
    )

    for _, row in order_line_table.iterrows():
        columns_str = ", ".join(order_line_table.columns)
        values_str = ", ".join(sql_literal(row[col]) for col in order_line_table.columns)
        f.write(f"INSERT INTO Order_Line ({columns_str}) VALUES ({values_str});\n")

print("\nFiles created successfully:")
print("SQL:", address_sql_output)
print("SQL:", customer_sql_output)
print("SQL:", contact_sql_output)
print("SQL:", domestic_sql_output)
print("SQL:", international_sql_output)
print("SQL:", product_line_sql_output)
print("SQL:", product_sql_output)
print("SQL:", orders_sql_output)
print("SQL:", order_line_sql_output)