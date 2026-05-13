# Sample Sales Database Project

This project uses the Sample Sales Data dataset from Kaggle to create a normalized relational database and a simple web application for interacting with the data.

Kaggle dataset: https://www.kaggle.com/datasets/kyanyoga/sample-sales-data

## Current Project Status

This README is an initial setup guide for the preprocessing and SQL import process. It will be updated later as the web application and final documentation are completed.

## Tools Used

- Python
- pandas
- MySQL / MariaDB
- XAMPP
- phpMyAdmin

## Python Setup

Install the required Python libraries using:

```bash
pip install -r requirements.txt
```

The `requirements.txt` file currently includes:

```text
pandas
```

## Important Paths

- Original CSV: `database/original_csv/sales_data_sample.csv`
- Preprocessing scripts: `database/preprocessing/`
- Normalized CSV outputs: `database/processed_csv/`
- Generated SQL files: `database/sql/`

## Running the Preprocessing Scripts

Run the Python scripts from the root folder of the repository.

The scripts should be run in this order:

```bash
python database/preprocessing/preprocess_customer_side.py
python database/preprocessing/preprocess_orders_side.py
python database/preprocessing/generate_sql.py
```

### Script Purpose

`preprocess_customer_side.py`

Generates the customer-related normalized CSV files:

```text
address.csv
customer.csv
contact.csv
domestic_customer.csv
international_customer.csv
```

`preprocess_orders_side.py`

Generates the order and product-related normalized CSV files:

```text
product_line.csv
product.csv
orders.csv
order_line.csv
```

`generate_sql.py`

Reads the processed CSV files and generates SQL files for creating and inserting data into the database tables.

## XAMPP / MySQL Setup

This project uses XAMPP to run MySQL locally.

To use the database locally:

1. Open XAMPP Control Panel.
2. Start Apache.
3. Start MySQL.
4. Open phpMyAdmin in the browser:

```text
http://localhost/phpmyadmin
```

5. Create a new database.

Recommended database name:

```text
sample_sales_db
```

## SQL Import Order

The SQL files must be imported in the correct order because of foreign key dependencies.

Import them in this order:

```text
1. Address.sql
2. Customer.sql
3. Contact.sql
4. DomesticCustomer.sql
5. InternationalCustomer.sql
6. Product_Line.sql
7. Product.sql
8. Orders.sql
9. Order_Line.sql
```

## Basic Validation Queries

After importing the SQL files into MySQL, run these queries to confirm the tables were created and populated correctly:

```sql
SELECT COUNT(*) FROM Address;
SELECT COUNT(*) FROM Customer;
SELECT COUNT(*) FROM Contact;
SELECT COUNT(*) FROM DomesticCustomer;
SELECT COUNT(*) FROM InternationalCustomer;
SELECT COUNT(*) FROM Product_Line;
SELECT COUNT(*) FROM Product;
SELECT COUNT(*) FROM Orders;
SELECT COUNT(*) FROM Order_Line;
```

Expected row counts:

```text
Address: 92
Customer: 92
Contact: 92
DomesticCustomer: 35
InternationalCustomer: 57
Product_Line: 7
Product: 109
Orders: 307
Order_Line: 2823
```

## Notes

- The original CSV is kept unchanged in `database/original_csv/`.
- The normalized CSV files are generated into `database/processed_csv/`.
- The SQL files are generated into `database/sql/`.
- The web application portion of the project will be added later.
