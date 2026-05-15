# 📊 Sample Sales Database Project

A data engineering project that transforms raw sales data from Kaggle into a normalized relational database with a web interface.

**Dataset Source:** [Sample Sales Data on Kaggle](https://www.kaggle.com/datasets/kyanyoga/sample-sales-data)

---

## 📋 Table of Contents

- [Overview](#overview)
- [Project Structure](#project-structure)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
  - [Step 1: Data Preprocessing](#step-1-data-preprocessing)
  - [Step 2: Database Setup](#step-2-database-setup)
  - [Step 3: SQL Import](#step-3-sql-import)
  - [Step 4: Validation](#step-4-validation)
- [Web Application](#web-application)
- [Database Schema](#database-schema)
- [Technologies](#technologies)
- [Project Status](#project-status)

---

## 🎯 Overview


This project demonstrates end-to-end data engineering practices by:
- **Extracting** sales data from a raw CSV file
- **Transforming** it into a normalized relational schema


```bash
pip install -r requirements.txt
```

**Dependencies:**
- `pandas>=2.2.0` - Data manipulation and CSV processing

---

## 🔧 Usage

### Step 1: Data Preprocessing

Run the preprocessing scripts **in order** from the project root directory:

#### 1️⃣ Process Customer Data dependencies
└── README.md
```

---

## ✅ Prerequisites

Before starting, ensure you have the following installed:

- **Python 3.8+** ([Download](https://www.python.org/downloads/))
- **XAMPP** ([Download](https://www.apachefriends.org/)) or any MySQL server
- **Git** (optional, for cloning the repository)

---

## 🚀 Installation

### 1. Clone or Download the Repository

```bash
git clone <repository-url>
cd Sample_Sales_Data
```

### 2. Install Python Dependencies

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


```bash
python database/preprocessing/preprocess_customer_side.py
```

**Generates:**
- `address.csv` - Customer addresses
- `customer.csv` - Customer master records
- `contact.csv` - Contact information
- `domestic_customer.csv` - US-based customers
- `international_customer.csv` - International customers

#### 2️⃣ Process Orders and Products

```bash
python database/preprocessing/preprocess_orders_side.py
```

**Generates:**
- `product_line.csv` - Product categories
- `product.csv` - Product catalog
- `orders.csv` - Order headers
- `order_line.csv` - Order line items

#### 3️⃣ Generate SQL Statementscally:

1. Open XAMPP Control Panel.
2. Start Apache.
3. Start MySQL.
4. Open phpMyAdmin in the browser:

```text
http://localhost/phpmyadmin
```

5. Create a new database.


```bash
python database/preprocessing/generate_sql.py
```

**Generates:**
- SQL files for table creation and data insertion in `database/sql/`

---

### Step 2: Database Setup

#### Using XAMPP

1. **Launch XAMPP Control Panel**
2. **Start Apache** and **MySQL** services
3. **Open phpMyAdmin** in your browser:
   ```


```bash
mysql -u root -p


| Order | SQL File                     | Description                |
|-------|------------------------------|----------------------------|
| 1     | `Address.sql`                | Customer addresses         |
| 2     | `Customer.sql`               | Customer master table      |
| 3     | `Contact.sql`                | Contact information        |
| 4     | `DomesticCustomer.sql`       | US customers               |
| 5     | `InternationalCustomer.sql`  | International customers    |
| 6     | `Product_Line.sql`           | Product categories         |
| 7     | `Product.sql`                | Product catalog            |
| 8     | `Orders.sql`                 | Order headers              |
| 9     | `Order_Line.sql`             | Order line items           |

**Via phpMyAdmin:** Use the Import tab for each file in order.



```sql
SELECT COUNT(*) FROM Address;              -- Expected: 92
SELECT COUNT(*) FROM Customer;             -- Expected: 92
SELECT COUNT(*) FROM Contact;              -- Expected: 92
SELECT COUNT(*) FROM DomesticCustomer;     -- Expected: 35
SELECT COUNT(*) FROM InternationalCustomer;-- Expected: 57
SELECT COUNT(*) FROM Product_Line;         -- Expected: 7
SELECT COUNT(*) FROM Product;              -- Expected: 109
SELECT COUNT(*) FROM Orders;               -- Expected: 307
SELECT COUNT(*) FROM Order_Line;           -- Expected: 2823
```

**Expected Row Counts:**

| Table                    | Expected Rows |
|--------------------------|---------------|
| Address                  | 92            |
| Customer                 | 92            |
| Contact                  | 92            |
| DomesticCustomer         | 35            |
| InternationalCustomer    | 57            |
| Product_Line             | 7             |
| Product                  | 109           |
| Orders                   | 307           |
| Order_Line               | 2,823         |

✅ If all counts match, your database is successfully set up!

---

## 🌐 Web Application

A comprehensive PHP web application is included to visualize and interact with the database through a user-friendly interface.

### Features

- 📊 **E/R Diagram Viewer** - Display and download Entity-Relationship diagrams
- 🗂️ **Database Schema Documentation** - Complete attribute descriptions with data types and constraints
- 📋 **Interactive Data Browser** - View and search data from all tables
- 🔌 **XAMPP Integration** - Direct connection to MySQL database with status monitoring
- 📱 **Responsive Design** - Mobile-friendly interface with modern styling

### Quick Start

#### Option 1: Automatic Setup (Recommended)

1. **Copy web application to XAMPP:**
   ```bash
   # Copy the entire project to XAMPP's htdocs folder
   cp -r Sample_Sales_Data C:\xampp\htdocs\
   ```

2. **Start XAMPP services:**
   - Launch XAMPP Control Panel
   - Start Apache and MySQL

3. **Run automated setup:**
   - Navigate to: `http://localhost/Sample_Sales_Data/src/setup.php`
   - The script will automatically create the database and import all tables
   - Click "Go to Application" when complete

4. **Access the application:**
   - URL: `http://localhost/Sample_Sales_Data/src/`

#### Option 2: Manual Setup

If you've already created the database manually (following steps in previous section):

1. **Deploy web files:**
   ```bash
   # Copy to XAMPP directory
   cp -r src C:\xampp\htdocs\Sample_Sales_Data\
   cp -r diagram C:\xampp\htdocs\Sample_Sales_Data\
   ```

2. **Configure database connection (if needed):**
   - Edit `src/config.php`
   - Update credentials if you changed MySQL defaults:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');  // Add password if set
   define('DB_NAME', 'sales_data');
   ```

3. **Access the application:**
   - URL: `http://localhost/Sample_Sales_Data/src/`

### Application Structure

```
src/
├── index.php          # Main entry point with navigation
├── config.php         # Database configuration
├── setup.php          # Automated setup script
├── styles.css         # Responsive CSS styling
├── .htaccess          # Apache configuration
├── README.md          # Detailed web app documentation
└── pages/
    ├── home.php       # Dashboard with statistics
    ├── er_diagram.php # E/R diagram viewer
    ├── schema.php     # Schema documentation
    └── view_data.php  # Interactive data browser
```

### Screenshots & Features

#### Dashboard
- Real-time database statistics
- Quick access to all features
- Connection status monitoring
- Setup instructions and troubleshooting

#### E/R Diagram Viewer
- High-resolution diagram display
- Detailed relationship explanations
- Download options (PNG/PDF)
- Entity and constraint documentation

#### Schema Documentation
- All 9 tables with complete descriptions
- Attribute details with data types
- Primary and foreign key indicators
- Relationship summary

#### Data Browser
- Select any table from dropdown
- View up to 100 rows per table
- Column information display
- SQL query information
- Responsive table design

### Troubleshooting

**Connection Failed:**
- Ensure MySQL is running in XAMPP
- Verify database name is exactly `sales_data`
- Check credentials in `config.php`

**E/R Diagram Not Showing:**
- Verify `diagram/` folder is in correct location
- Check image file exists: `diagram/Sample Sales ER Diagram.png`

**No Data Displaying:**
- Confirm all SQL files were imported
- Check import order was followed
- Verify tables exist in `sales_data` database

**404 Error:**
- Check Apache is running
- Verify folder structure: `C:\xampp\htdocs\Sample_Sales_Data\src\`
- Clear browser cache

For more details, see [src/README.md](src/README.md)

---

## 🗄️ Database Schema

The database follows a normalized relational design with the following entities:

- **Customer Module:** Address, Customer, Contact, DomesticCustomer, InternationalCustomer
- **Product Module:** Product_Line, Product
- **Order Module:** Orders, Order_Line

*Detailed ER diagrams coming soon in the `diagram/` folder.*

### 🔗 Dependencias Funcionales

Las siguientes dependencias funcionales definen las relaciones entre atributos:

| Determinante | → | Dependientes |
|--------------|---|--------------|
| `CUSTOMER_ID` | → | CUSTOMERNAME, PHONE, ADDRESS_ID |
| `CONTACT_ID` | → | CONTACTFIRSTNAME, CONTACTLASTNAME, CUSTOMER_ID |
| `ADDRESS_ID` | → | ADDRESSLINE1, ADDRESSLINE2, CITY, STATE, POSTALCODE, COUNTRY, TERRITORY |
| `ORDERNUMBER` | → | ORDERDATE, QTR_ID, MONTH_ID, YEAR_ID, CUSTOMER_ID |
| `(ORDERNUMBER, ORDERLINENUMBER)` | → | QUANTITYORDERED, PRICEEACH, SALES, PRODUCTCODE, DEALSIZE |
| `PRODUCTCODE` | → | MSRP, PRODUCTLINE_ID |
| `PRODUCTLINE_ID` | → | PRODUCTLINE_NAME |
| `CUSTOMER_ID (Domestic)` | → | CUSTOMER_ID |
| `CUSTOMER_ID (International)` | → | CUSTOMER_ID |

### 🔒 Restricciones del Modelo

#### 1. Restricciones de Integridad de Entidad
- ✅ Todas las claves primarias (PK) deben ser **únicas y no nulas**
- ✅ Ninguna tabla puede tener registros duplicados en su clave primaria
- **Ejemplo:** `CUSTOMER_ID` es único en `CUSTOMER`

#### 2. Restricciones de Integridad Referencial
- ✅ Las claves foráneas (FK) deben existir previamente en la tabla referenciada
- **Ejemplo:** `CUSTOMER.ADDRESS_ID` debe existir en `ADDRESS(ADDRESS_ID)`

#### 3. Restricciones de Cardinalidad
- 📌 Un cliente puede tener **múltiples contactos**
- 📌 Un cliente puede realizar **múltiples órdenes**
- 📌 Una orden puede aparecer en **múltiples líneas de productos**
- 📌 Un producto puede aparecer en **múltiples órdenes**
- 📌 Una línea de producto puede contener **múltiples productos**
- 📌 Cada cliente pertenece solamente a **una subcategoría**:
  - `DOMESTIC_CUSTOMER`
  - `INTERNATIONAL_CUSTOMER`

#### 4. Restricciones de Herencia
La herencia `CUSTOMER` y sus subtipos es:
- ⚠️ **Completa:** Todo cliente debe pertenecer a un subtipo
- ⚠️ **Disjunta:** Un cliente no puede ser doméstico e internacional al mismo tiempo

#### 5. Restricciones de Dominio
Restricciones de valores válidos:

| Campo | Restricción |
|-------|-------------|
| `QUANTITYORDERED` | > 0 |
| `SALES` | ≥ 0 |
| `PRICEEACH` | ≥ 0 |
| `MSRP` | ≥ 0 |
| `STATUS` | Valores válidos: "SHIPPED", "CANCELLED", "RESOLVED", "ON HOLD", "In PROCESS" |
| `COUNTRY`, `CITY`, `STATE` | Valores tipo texto válidos |

### 📐 Normalización: 3NF y BCNF

Las tablas del modelo fueron normalizadas hasta **Tercera Forma Normal (3NF)**, ya que cada tabla cumple con las siguientes condiciones:

1. ✅ Todos los atributos contienen **valores atómicos** (1NF)
2. ✅ No existen **dependencias parciales** en las tablas con claves primarias simples (2NF)
3. ✅ No existen **dependencias transitivas** entre atributos no primarios (3NF)

Además, las tablas también pueden considerarse en **Forma Normal de Boyce-Codd (BCNF)**, ya que en cada dependencia funcional identificada, el determinante es una clave primaria o una clave candidata.

#### Análisis por Tabla

<details>
<summary><strong>CUSTOMER</strong> ✅ 3NF/BCNF</summary>

- **PK:** `customer_id`
- **FD:** `customer_id → customername, phone, address_id`
- **Estado:** Está en 3NF y BCNF porque `customer_id` determina todos los atributos
</details>

<details>
<summary><strong>CONTACT</strong> ✅ 3NF/BCNF</summary>

- **PK:** `contact_id`
- **FD:** `contact_id → contactfirstname, contactlastname, customer_id`
- **Estado:** Está en 3NF y BCNF
</details>

<details>
<summary><strong>ADDRESS</strong> ✅ 3NF/BCNF</summary>

- **PK:** `address_id`
- **FD:** `address_id → addressline1, addressline2, city, state, postalcode, country, territory`
- **Estado:** Está en 3NF y BCNF
</details>

<details>
<summary><strong>ORDERS</strong> ✅ 3NF/BCNF</summary>

- **PK:** `ordernumber`
- **FD:** `ordernumber → orderdate, status, qtr_id, month_id, year_id, customer_id`
- **Estado:** Está en 3NF y BCNF
</details>

<details>
<summary><strong>ORDER_LINE</strong> ✅ 3NF/BCNF</summary>

- **PK compuesta:** `(ordernumber, orderlinenumber)`
- **FD:** `(ordernumber, orderlinenumber) → quantityordered, priceeach, sales, productcode, dealsize`
- **Estado:** Está en 3NF y BCNF porque los atributos dependen de la clave completa
</details>

<details>
<summary><strong>PRODUCT</strong> ✅ 3NF/BCNF</summary>

- **PK:** `productcode`
- **FD:** `productcode → msrp, productline_id`
- **Estado:** Está en 3NF y BCNF
</details>

<details>
<summary><strong>PRODUCT_LINE</strong> ✅ 3NF/BCNF</summary>

- **PK:** `productline_id`
- **FD:** `productline_id → productline_name`
- **Estado:** Está en 3NF y BCNF
</details>

<details>
<summary><strong>DOMESTIC_CUSTOMER</strong> ✅ 3NF/BCNF</summary>

- **PK/FK:** `customer_id`
- **Estado:** Está en 3NF y BCNF porque solo contiene la clave del subtipo
</details>

<details>
<summary><strong>INTERNATIONAL_CUSTOMER</strong> ✅ 3NF/BCNF</summary>

- **PK/FK:** `customer_id`
- **Estado:** Está en 3NF y BCNF porque solo contiene la clave del subtipo
</details>

---

## 🛠️ Technologies

| Technology  | Purpose                          |
|-------------|----------------------------------|
| Python 3.x  | Data preprocessing and ETL       |
| pandas      | Data manipulation                |
| MySQL       | Relational database              |
| XAMPP       | Local development environment    |
| phpMyAdmin  | Database management interface    |

---

## 📌 Project Status

**Current Phase:** Database setup and data preprocessing ✅

**Coming Soon:**
- [ ] Web application frontend
- [ ] REST API for data access
- [ ] Database relationship diagrams
- [ ] Advanced query examples
- [ ] Performance optimization documentation

---

## 📝 Notes

- The original CSV remains unchanged in `database/original_csv/`
- All transformations are reproducible by re-running the Python scripts
- The preprocessing scripts handle data cleaning, normalization, and deduplication
- Foreign key constraints ensure referential integrity

---

## 📄 License

This project is for educational purposes. The dataset is provided by Kaggle under their terms of use.

---

**Happy Data Engineering! 🚀**
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
