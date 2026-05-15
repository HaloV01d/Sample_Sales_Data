# Sales Data Web Application - Setup Guide

## Overview
This is a PHP web application designed to run on XAMPP that provides comprehensive access to the sales database, including E/R diagrams, relational schema documentation, and data viewing capabilities.

## Features
- 📊 **E/R Diagram Viewer**: Display the Entity-Relationship diagram
- 🗂️ **Database Schema Documentation**: Complete attribute descriptions for all tables
- 📋 **Data Viewer**: Interactive browser for all database tables
- 🔌 **XAMPP Integration**: Direct connection to MySQL database

## Prerequisites
- **XAMPP** installed (includes Apache and MySQL)
- **Web Browser** (Chrome, Firefox, Edge, etc.)
- **PHP 7.0+** (included with XAMPP)

## Installation Steps

### Step 1: Install XAMPP

#### 1.1 Download XAMPP
1. Open your web browser
2. Go to: [https://www.apachefriends.org](https://www.apachefriends.org)
3. Click the **Download** button for Windows
4. Choose the latest version with PHP 7.0 or higher
5. Save the installer (e.g., `xampp-windows-x64-8.2.12-0-VS16-installer.exe`)

#### 1.2 Install XAMPP
1. **Run the installer** as Administrator (right-click → "Run as administrator")
2. If Windows Firewall prompts, click **"Allow access"**
3. Click **"Next"** through the installation wizard
4. **Installation Directory**: Use default `C:\xampp` (recommended)
   - ⚠️ **Important**: If you choose a different path, remember it for later steps
5. Uncheck "Learn more about Bitnami" (optional)
6. Click **"Next"** → **"Next"** → **"Install"**
7. Wait for installation to complete (may take 5-10 minutes)
8. Click **"Finish"**

#### 1.3 Verify XAMPP Installation
1. Check that `C:\xampp` folder exists
2. Inside you should see folders: `apache`, `mysql`, `php`, `htdocs`, etc.

---

### Step 2: Start XAMPP Services

#### 2.1 Launch XAMPP Control Panel
1. Press **Windows Key** on keyboard
2. Type: `xampp control panel`
3. Click **"XAMPP Control Panel"** (orange icon)
   - Alternative: Navigate to `C:\xampp` → Double-click `xampp-control.exe`

#### 2.2 Start Apache (Web Server)
1. Locate the **Apache** row in the Control Panel
2. Click the **"Start"** button next to Apache
3. Wait 3-5 seconds
4. **Success indicators**:
   - Button changes to green **"Stop"**
   - Background turns light green
   - Port numbers appear: `80`, `443`
   - Logs show: `Apache started [Port 80]`

**⚠️ Troubleshooting**: If Apache won't start (stays red):
- **Problem**: Port 80 is already in use (often by Skype, IIS, or another web server)
- **Solution Option 1**: Close the conflicting application
- **Solution Option 2**: Change Apache port
  - Click **"Config"** → **"httpd.conf"**
  - Find: `Listen 80` → Change to: `Listen 8080`
  - Save and close file
  - Start Apache again
  - Access URLs using: `http://localhost:8080` instead of `http://localhost`

#### 2.3 Start MySQL (Database Server)
1. Locate the **MySQL** row in the Control Panel
2. Click the **"Start"** button next to MySQL
3. Wait 3-5 seconds
4. **Success indicators**:
   - Button changes to green **"Stop"**
   - Background turns light green
   - Port number appears: `3306`
   - Logs show: `MySQL started [Port 3306]`

#### 2.4 Verify Services Are Running
- **Both Apache and MySQL should show green**
- Keep XAMPP Control Panel open (minimize if needed)

---

### Step 3: Create the Database

#### 3.1 Open phpMyAdmin
1. Open your web browser (Chrome, Firefox, Edge)
2. In the address bar, type: `http://localhost/phpmyadmin`
3. Press **Enter**
4. You should see the phpMyAdmin interface with:
   - Orange/tan navigation bar at top
   - Database list on the left sidebar
   - Welcome screen in center

**⚠️ Troubleshooting**: Can't access phpMyAdmin?
- Check Apache is running (green in XAMPP Control Panel)
- Check MySQL is running (green in XAMPP Control Panel)
- Try: `http://127.0.0.1/phpmyadmin`
- Clear browser cache (Ctrl + Shift + Delete)

#### 3.2 Create New Database
1. Look at the **left sidebar** in phpMyAdmin
2. Click on **"New"** at the very top (has a database icon)
3. In the **"Database name"** field, type exactly: `sales_data`
   - ⚠️ **Important**: Use lowercase, with underscore (not space or dash)
4. From the **"Collation"** dropdown, select: `utf8_general_ci`
   - You can type `utf8` to quickly find it
5. Click the blue **"Create"** button
6. **Success**: You'll see `sales_data` appear in the left sidebar
7. Click on **`sales_data`** in the sidebar to select it

---

### Step 4: Import SQL Data Files

**⚠️ CRITICAL**: Import files **in this exact order** to avoid foreign key errors!

#### 4.1 Navigate to Import Tab
1. Make sure **`sales_data`** database is selected (highlighted in left sidebar)
2. Click on the **"Import"** tab at the top of the page

#### 4.2 Import Each SQL File (In Order)

**File 1: Address.sql**
1. Click **"Choose File"** button
2. Navigate to your project folder: `Sample_Sales_Data\database\sql\`
3. Select **`Address.sql`**
4. Click **"Open"**
5. Scroll down and click the blue **"Go"** button (bottom right)
6. Wait for the green success message: "Import has been successfully finished, 92 queries executed"
7. **Verify**: Click "Structure" tab, you should see the `address` table

**File 2: Customer.sql**
1. Click **"Import"** tab again
2. Click **"Choose File"**
3. Select **`Customer.sql`**
4. Click **"Go"**
5. Wait for success: "92 queries executed"

**File 3: Contact.sql**
1. Import **`Contact.sql`** using same steps
2. Success: "92 queries executed"

**File 4: DomesticCustomer.sql**
1. Import **`DomesticCustomer.sql`**
2. Success: "35 queries executed"

**File 5: InternationalCustomer.sql**
1. Import **`InternationalCustomer.sql`**
2. Success: "57 queries executed"

**File 6: Product_Line.sql**
1. Import **`Product_Line.sql`**
2. Success: "7 queries executed"

**File 7: Product.sql**
1. Import **`Product.sql`**
2. Success: "109 queries executed"

**File 8: Orders.sql**
1. Import **`Orders.sql`**
2. Success: "307 queries executed"

**File 9: Order_Line.sql** (Last one!)
1. Import **`Order_Line.sql`**
2. Success: "2823 queries executed"

#### 4.3 Verify All Tables Were Created
1. Click on **`sales_data`** in the left sidebar
2. You should see **9 tables** listed:
   - address (92 rows)
   - contact (92 rows)
   - customer (92 rows)
   - domestic_customer (35 rows)
   - international_customer (57 rows)
   - order_line (2823 rows)
   - orders (307 rows)
   - product (109 rows)
   - product_line (7 rows)
3. **Total rows**: 3,514 records

---

### Step 5: Deploy Web Application Files

You have **two methods** to copy files to XAMPP. Choose the one you're comfortable with.

#### Method A: Using File Explorer (Manual - Recommended for Beginners)

**5A.1 Create Destination Folder**
1. Open **File Explorer** (Windows Key + E)
2. Navigate to: `C:\xampp\htdocs\`
3. Right-click in empty space → **"New"** → **"Folder"**
4. Name it: `Sample_Sales_Data`
5. Press **Enter**

**5A.2 Copy the `src` Folder**
1. Navigate to your project location (e.g., `C:\Users\YourName\Documents\Development\Sample_Sales_Data\`)
2. Find the **`src`** folder
3. **Right-click** on `src` → **"Copy"**
4. Navigate to: `C:\xampp\htdocs\Sample_Sales_Data\`
5. **Right-click** in empty space → **"Paste"**
6. **Verify**: You should now have: `C:\xampp\htdocs\Sample_Sales_Data\src\`

**5A.3 Copy the `diagram` Folder**
1. Go back to your project folder: `Sample_Sales_Data\`
2. Find the **`diagram`** folder (contains `Sample Sales ER Diagram.png`)
3. **Right-click** on `diagram` → **"Copy"**
4. Navigate to: `C:\xampp\htdocs\Sample_Sales_Data\`
5. **Right-click** → **"Paste"**
6. **Verify**: You should now have: `C:\xampp\htdocs\Sample_Sales_Data\diagram\`

**5A.4 Optional: Copy `database` Folder**
1. Copy the **`database`** folder using same method
2. Paste it to: `C:\xampp\htdocs\Sample_Sales_Data\`
3. This allows the setup.php script to work (optional, since database is already created)

#### Method B: Using PowerShell (Automated - Faster)

**5B.1 Open PowerShell**
1. Press **Windows Key**
2. Type: `powershell`
3. **Right-click** on "Windows PowerShell" → **"Run as administrator"**
4. Click **"Yes"** on UAC prompt

**5B.2 Navigate to Your Project Folder**
```powershell
cd "C:\Users\YourName\Documents\Development\Sample_Sales_Data"
```
⚠️ Replace `YourName` with your actual Windows username

**5B.3 Run Copy Commands**
```powershell
# Create destination folder
New-Item -Path "C:\xampp\htdocs\Sample_Sales_Data" -ItemType Directory -Force

# Copy src folder
Copy-Item -Path ".\src" -Destination "C:\xampp\htdocs\Sample_Sales_Data\" -Recurse -Force

# Copy diagram folder
Copy-Item -Path ".\diagram" -Destination "C:\xampp\htdocs\Sample_Sales_Data\" -Recurse -Force

# Copy database folder (optional)
Copy-Item -Path ".\database" -Destination "C:\xampp\htdocs\Sample_Sales_Data\" -Recurse -Force
```

**5B.4 Verify Copy Completed**
```powershell
Get-ChildItem "C:\xampp\htdocs\Sample_Sales_Data"
```
You should see: `database`, `diagram`, `src`

#### 5.6 Verify Final Folder Structure
Your `C:\xampp\htdocs\Sample_Sales_Data\` should contain:

```
C:\xampp\htdocs\Sample_Sales_Data\
├── diagram\
│   └── Sample Sales ER Diagram.png
├── database\
│   ├── sql\
│   │   ├── Address.sql
│   │   ├── Customer.sql
│   │   └── ... (all 9 SQL files)
│   └── processed_csv\
│       └── ... (CSV files)
└── src\
    ├── index.php
    ├── config.php
    ├── styles.css
    ├── setup.php
    └── pages\
        ├── home.php
        ├── er_diagram.php
        ├── schema.php
        └── view_data.php
```

---

### Step 6: Configure Database Connection (Usually Not Needed)

**99% of the time you can skip this step!** The default settings work for standard XAMPP installations.

#### When You NEED to Edit Configuration:
- You set a MySQL password during XAMPP installation
- You changed the MySQL port from 3306
- You used a different database name
- MySQL is on a different server

#### 6.1 How to Edit config.php
1. Navigate to: `C:\xampp\htdocs\Sample_Sales_Data\src\`
2. **Right-click** on `config.php` → **"Open with"** → Choose **Notepad** or **Visual Studio Code**
3. Find these lines:

```php
define('DB_HOST', 'localhost');    // MySQL host - change if remote
define('DB_USER', 'root');         // MySQL username - change if you created a user
define('DB_PASS', '');             // MySQL password - add your password here
define('DB_NAME', 'sales_data');   // Database name - must match step 3
define('DB_PORT', '3306');         // MySQL port - change if you modified it
```

4. **Example**: If you set MySQL password to `mypassword123`:
   ```php
   define('DB_PASS', 'mypassword123');
   ```

5. Press **Ctrl + S** to save
6. Close the editor

---

### Step 7: Access Your Web Application

#### 7.1 Open Application in Browser
1. Open your **web browser** (Chrome, Firefox, Edge, Safari)
2. In the address bar, type **exactly**:
   ```
   http://localhost/Sample_Sales_Data/src/
   ```
   or
   ```
   http://localhost/Sample_Sales_Data/src/index.php
   ```
3. Press **Enter**

#### 7.2 What You Should See
✅ **Success Screen**:
- Purple gradient background
- Navigation bar with 4 links: Home, E/R Diagram, Database Schema, View Data
- Green checkmark: "✓ Successfully connected to database: sales_data"
- Three feature cards: View E/R Diagram, Explore Database Schema, Browse Data
- Database statistics showing row counts for all 9 tables

❌ **Error Screen**:
- Red error box with connection failed message
- See troubleshooting section below

#### 7.3 Test Each Feature

**Test 1: Home Page**
- Should show database statistics:
  - Customers: 92
  - Domestic Customers: 35
  - International Customers: 57
  - Orders: 307
  - Order Lines: 2823
  - Products: 109
  - Product Lines: 7
  - Addresses: 92
  - Contacts: 92

**Test 2: E/R Diagram**
1. Click **"E/R Diagram"** in navigation
2. Should display the entity-relationship diagram image
3. Shows entities: Customer, Address, Contact, Orders, Order_Line, Product, Product_Line
4. Includes relationship explanations and cardinalities

**Test 3: Database Schema**
1. Click **"Database Schema"** in navigation
2. Should display detailed documentation of all 9 tables
3. Each table shows:
   - Table name and description
   - All attributes with data types
   - Primary keys (yellow badges)
   - Foreign keys (blue badges)
   - Detailed descriptions of each column

**Test 4: View Data**
1. Click **"View Data"** in navigation
2. Select different tables from dropdown (e.g., "customer", "orders", "product")
3. Should display actual data rows from selected table
4. Shows column names, data types, and row count

---

### Step 8: Bookmark and Use

#### 8.1 Create Browser Bookmark
1. While on the application homepage
2. Press **Ctrl + D** (or click star icon in address bar)
3. Name it: "Sales Data Application"
4. Save in your bookmarks bar

#### 8.2 Starting the Application Later
**Every time you want to use the application:**

1. **Start XAMPP Services**:
   - Open XAMPP Control Panel
   - Start Apache (if not running)
   - Start MySQL (if not running)

2. **Open Browser**:
   - Go to: `http://localhost/Sample_Sales_Data/src/`
   - Or click your bookmark

3. **When Done**:
   - You can leave XAMPP running
   - Or stop services in XAMPP Control Panel to free resources

## Application Structure

```
src/
├── index.php           # Main entry point and navigation
├── config.php          # Database configuration
├── styles.css          # CSS styling
└── pages/
    ├── home.php        # Homepage with statistics
    ├── er_diagram.php  # E/R diagram viewer
    ├── schema.php      # Database schema documentation
    └── view_data.php   # Interactive data browser
```

## Usage Guide

### Home Page
- View database statistics
- Quick access to all features
- Setup instructions and troubleshooting

### E/R Diagram
- View the Entity-Relationship diagram
- Understand entity relationships
- Download diagram in PNG or PDF format

### Database Schema
- Detailed documentation of all tables
- Complete attribute descriptions
- Data types and constraints
- Foreign key relationships

### View Data
- Select any table from dropdown
- Browse actual data stored in database
- View column information
- See table structure details

---

## Troubleshooting Guide

### Problem 1: "Connection failed" Error (Red Box on Homepage)

**Symptoms:**
- Red error box: "Connection failed: [error message]"
- Application doesn't show database statistics

**Solutions (try in order):**

**A. Check MySQL is Running**
1. Open XAMPP Control Panel
2. Look at MySQL row - should be green with "Stop" button
3. If it's not green:
   - Click **"Start"** next to MySQL
   - Wait 5 seconds
   - Check logs for errors

**B. Verify Database Exists**
1. Go to: `http://localhost/phpmyadmin`
2. Check left sidebar for **`sales_data`** database
3. If missing:
   - Go back to **Step 3** (Create Database)
   - Create the database
   - Re-import all SQL files (Step 4)

**C. Check Database Connection Settings**
1. Open: `C:\xampp\htdocs\Sample_Sales_Data\src\config.php`
2. Verify settings match your XAMPP:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');        // Empty by default
   define('DB_NAME', 'sales_data');
   define('DB_PORT', '3306');
   ```

**D. Test MySQL Connection**
1. Go to: `http://localhost/phpmyadmin`
2. If phpMyAdmin doesn't load, MySQL isn't running properly
3. In XAMPP Control Panel:
   - Click **"Logs"** next to MySQL
   - Look for error messages (port conflicts, access denied, etc.)

---

### Problem 2: E/R Diagram Image Not Displaying

**Symptoms:**
- Broken image icon on E/R Diagram page
- Empty space where diagram should be

**Solutions:**

**A. Verify Image File Exists**
1. Open File Explorer
2. Navigate to: `C:\xampp\htdocs\Sample_Sales_Data\diagram\`
3. Look for file: `Sample Sales ER Diagram.png`
4. If missing:
   - Go back to your project folder
   - Copy the `diagram` folder to: `C:\xampp\htdocs\Sample_Sales_Data\`

**B. Check File Name Exactly**
- File MUST be named: `Sample Sales ER Diagram.png` (with spaces)
- Case-sensitive on some systems
- Must be PNG format (not JPG, PDF, etc.)

**C. Verify Path in Code**
1. Open: `C:\xampp\htdocs\Sample_Sales_Data\src\pages\er_diagram.php`
2. Find the image tag (around line 20):
   ```php
   <img src="../diagram/Sample Sales ER Diagram.png" ...>
   ```
3. Path should be: `../diagram/Sample Sales ER Diagram.png`

---

### Problem 3: "No data showing" in View Data Tab

**Symptoms:**
- Tables appear empty
- Row count shows 0
- "No records found" message

**Solutions:**

**A. Verify Data Was Imported**
1. Go to: `http://localhost/phpmyadmin`
2. Click on **`sales_data`** database in left sidebar
3. Check row counts for each table:
   - address: 92 rows
   - customer: 92 rows
   - contact: 92 rows
   - domestic_customer: 35 rows
   - international_customer: 57 rows
   - product_line: 7 rows
   - product: 109 rows
   - orders: 307 rows
   - order_line: 2823 rows

**B. Re-import SQL Files**
If any table is empty or missing:
1. Go back to **Step 4** (Import SQL Files)
2. Delete the problematic table in phpMyAdmin:
   - Click on table name
   - Click "Operations" tab
   - Scroll down and click "Delete the table (DROP)"
3. Re-import that specific SQL file
4. Maintain the import order for dependent tables

---

### Problem 4: "404 Not Found" Error

**Symptoms:**
- Browser shows: "Object not found!"
- Error 404 when accessing `http://localhost/Sample_Sales_Data/src/`

**Solutions:**

**A. Check Apache is Running**
1. Open XAMPP Control Panel
2. Apache should be green with "Stop" button
3. If not running, click **"Start"**

**B. Verify Folder Path**
1. Open File Explorer
2. Navigate to: `C:\xampp\htdocs\`
3. Verify folder structure:
   ```
   C:\xampp\htdocs\
   └── Sample_Sales_Data\
       ├── src\
       │   ├── index.php  ← This file MUST exist
       │   ├── config.php
       │   └── ...
       └── diagram\
   ```

**C. Check URL Exactly**
- Correct: `http://localhost/Sample_Sales_Data/src/`
- Correct: `http://localhost/Sample_Sales_Data/src/index.php`
- Wrong: `http://localhost/src/` (missing folder)
- Wrong: `http://localhost/Sample_Sales_Data/` (missing src/)

**D. Clear Browser Cache**
1. Press **Ctrl + Shift + Delete**
2. Select "Cached images and files"
3. Click **"Clear data"**
4. Try accessing the URL again

---

### Problem 5: Apache Won't Start (Port Conflict)

**Symptoms:**
- Click "Start" for Apache, but it stays stopped
- Red color in XAMPP Control Panel
- Log shows: "Port 80 in use by..."

**Solutions:**

**A. Find What's Using Port 80**
1. Open PowerShell as Administrator
2. Run:
   ```powershell
   Get-Process -Id (Get-NetTCPConnection -LocalPort 80).OwningProcess | Select-Object ProcessName, Id
   ```
3. Common culprits:
   - **Skype**: Tools → Options → Advanced → Connection → Uncheck "Use port 80"
   - **IIS (Internet Information Services)**: Control Panel → Turn Windows features on/off → Uncheck IIS
   - **VMware**: VMware Workstation → Edit → Preferences → Shared VMs → Disable

**B. Change Apache Port**
1. In XAMPP Control Panel, click **"Config"** (next to Apache)
2. Select **"httpd.conf"**
3. Find line: `Listen 80`
4. Change to: `Listen 8080`
5. Save and close
6. Click **"Config"** again → **"httpd-ssl.conf"**
7. Find line: `Listen 443`
8. Change to: `Listen 4433`
9. Save and close
10. Start Apache
11. **Access application using**: `http://localhost:8080/Sample_Sales_Data/src/`

---

### Problem 6: MySQL Won't Start

**Symptoms:**
- MySQL stays red/stopped in XAMPP Control Panel
- Error message about port 3306

**Solutions:**

**A. Check Port 3306**
1. Another MySQL service might be running
2. Open PowerShell as Administrator:
   ```powershell
   Get-Process -Id (Get-NetTCPConnection -LocalPort 3306).OwningProcess | Select-Object ProcessName, Id
   ```
3. Stop the conflicting service

**B. Check MySQL Logs**
1. In XAMPP Control Panel, click **"Logs"** next to MySQL
2. Look for specific error messages
3. Common issues:
   - Corrupted database files
   - Missing data directory
   - Permission errors

**C. Reset MySQL**
1. In XAMPP Control Panel, click **"Config"** → **"my.ini"**
2. Backup this file first!
3. Or try uninstalling and reinstalling XAMPP

---

### Problem 7: Blank White Page

**Symptoms:**
- Page loads but shows completely blank white screen
- No content, no error messages

**Solutions:**

**A. Enable Error Display**
1. Open: `C:\xampp\htdocs\Sample_Sales_Data\src\.htaccess`
2. Find line: `php_flag display_errors On`
3. Make sure it says `On` (not `Off`)
4. Refresh the page - you should now see error messages

**B. Check PHP Errors**
1. Open: `C:\xampp\php\php.ini`
2. Find: `display_errors = Off`
3. Change to: `display_errors = On`
4. Save file
5. Restart Apache in XAMPP Control Panel

**C. Check File Syntax**
1. Open: `C:\xampp\htdocs\Sample_Sales_Data\src\index.php`
2. Look for:
   - Missing `<?php` opening tag
   - Unclosed quotes `"` or `'`
   - Missing semicolons `;`
3. If you see an error, fix it and refresh

---

### Problem 8: "Forbidden - You don't have permission"

**Symptoms:**
- Error 403: "Access forbidden!"
- "You don't have permission to access this resource"

**Solutions:**

**A. Check .htaccess File**
1. Navigate to: `C:\xampp\htdocs\Sample_Sales_Data\src\`
2. Look for `.htaccess` file (note the dot at start)
3. If it has deny rules, remove or comment them out

**B. Check Apache Configuration**
1. Open: `C:\xampp\apache\conf\httpd.conf`
2. Find section with `<Directory "C:/xampp/htdocs">`
3. Make sure it includes:
   ```apache
   Options Indexes FollowSymLinks
   AllowOverride All
   Require all granted
   ```
4. Save and restart Apache

**C. Check File Permissions**
1. Right-click on: `C:\xampp\htdocs\Sample_Sales_Data\`
2. Properties → Security tab
3. Make sure your user has "Read & execute" permissions

---

### Problem 9: Slow Performance / Page Takes Long to Load

**Solutions:**

**A. Increase PHP Limits**
1. Open: `C:\xampp\htdocs\Sample_Sales_Data\src\.htaccess`
2. Adjust values:
   ```apache
   php_value max_execution_time 300
   php_value memory_limit 256M
   ```

**B. Optimize Queries**
- View Data page loads all 2823 order_line records
- This is normal for the large table
- Wait 3-5 seconds for initial load

**C. Clear Browser Cache**
1. Press **Ctrl + Shift + Delete**
2. Clear cached data
3. Reload page

---

## Additional Resources

### Useful Links
- **XAMPP Documentation**: [https://www.apachefriends.org/docs/](https://www.apachefriends.org/docs/)
- **PHP Manual**: [https://www.php.net/manual/](https://www.php.net/manual/)
- **MySQL Documentation**: [https://dev.mysql.com/doc/](https://dev.mysql.com/doc/)
- **phpMyAdmin Guide**: [https://docs.phpmyadmin.net/](https://docs.phpmyadmin.net/)

### Quick Reference Commands

**PowerShell Commands:**
```powershell
# Check if XAMPP services are running
Get-Process httpd, mysqld

# Copy files to htdocs
Copy-Item -Path ".\src" -Destination "C:\xampp\htdocs\Sample_Sales_Data\" -Recurse -Force

# Check what's using port 80
Get-NetTCPConnection -LocalPort 80

# View file contents
Get-Content "C:\xampp\htdocs\Sample_Sales_Data\src\config.php"
```

**Important File Locations:**
```
C:\xampp\                           # XAMPP root
C:\xampp\htdocs\                   # Web files go here
C:\xampp\apache\conf\httpd.conf    # Apache configuration
C:\xampp\mysql\bin\my.ini          # MySQL configuration
C:\xampp\php\php.ini               # PHP configuration
C:\xampp\apache\logs\error.log     # Apache error logs
C:\xampp\mysql\data\               # MySQL databases
```

---

## Frequently Asked Questions (FAQ)

### Q1: Do I need to keep XAMPP running all the time?
**A:** No. You only need Apache and MySQL running when you want to use the application. You can:
- Stop services when not in use (saves computer resources)
- Start them again whenever you need the application
- Set XAMPP services to auto-start if you use it frequently

### Q2: Can I access this from another computer on my network?
**A:** Yes! To make it accessible to others on your local network:
1. Find your computer's IP address:
   - Open PowerShell: `ipconfig`
   - Look for "IPv4 Address" (e.g., 192.168.1.100)
2. On another computer, use: `http://192.168.1.100/Sample_Sales_Data/src/`
3. Make sure Windows Firewall allows Apache (port 80)

⚠️ **Security Note**: This is for local network only. Don't expose XAMPP to the internet without proper security measures!

### Q3: How do I add more data to the database?
**Option A: Using phpMyAdmin (Easy)**
1. Go to: `http://localhost/phpmyadmin`
2. Select `sales_data` database
3. Click on a table (e.g., `customer`)
4. Click **"Insert"** tab
5. Fill in the form
6. Click **"Go"**

**Option B: Import CSV (For bulk data)**
1. Prepare CSV file matching table structure
2. In phpMyAdmin, select table
3. Click **"Import"** tab
4. Choose your CSV file
5. Click **"Go"**

### Q4: Can I modify the design/colors?
**A:** Yes! Edit: `C:\xampp\htdocs\Sample_Sales_Data\src\styles.css`

**Change Colors:**
```css
/* Find this section and change hex colors */
background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
```

Popular color combinations:
- Blue/Teal: `#00c6ff 0%, #0072ff 100%`
- Green: `#56ab2f 0%, #a8e063 100%`
- Orange/Red: `#f46b45 0%, #eea849 100%`
- Dark: `#232526 0%, #414345 100%`

### Q5: How do I backup my database?
1. Go to: `http://localhost/phpmyadmin`
2. Click on **`sales_data`** in left sidebar
3. Click **"Export"** tab at top
4. Select **"Quick"** export method
5. Format: **SQL**
6. Click **"Go"**
7. Save the file (e.g., `sales_data_backup_2026-05-14.sql`)

**To Restore Later:**
1. Create database: `sales_data`
2. Click **"Import"** tab
3. Choose your backup file
4. Click **"Go"**

### Q6: Can I use this for my school project?
**A:** Absolutely! This is designed for educational purposes. You can:
- Customize the design
- Add new features
- Modify the database structure
- Present it in class
- Include it in your portfolio

**Academic Use Tips:**
- Take screenshots for your report
- Document your modifications
- Explain the E/R diagram in your presentation
- Describe the normalization process

### Q7: What if I want to start over completely?
**Full Reset:**
1. **Delete Database:**
   - Go to phpMyAdmin
   - Click `sales_data`
   - Click "Operations" → "Delete the database"
2. **Delete Files:**
   - Delete: `C:\xampp\htdocs\Sample_Sales_Data\`
3. **Start Fresh:**
   - Follow all installation steps again (Step 1-7)

### Q8: Can I deploy this to a real web server?
**A:** Yes, but you'll need:
1. **Web Hosting** with PHP and MySQL support
2. **Update config.php** with hosting credentials:
   ```php
   define('DB_HOST', 'your-host.com');
   define('DB_USER', 'your_username');
   define('DB_PASS', 'your_password');
   define('DB_NAME', 'your_database_name');
   ```
3. **Security Improvements:**
   - Set strong MySQL password
   - Add user authentication
   - Use HTTPS (SSL certificate)
   - Implement prepared statements
   - Add input validation

⚠️ Current version is for **development/learning only**, not production-ready!

---

## Common Workflows

### Workflow 1: Daily Use
```
1. Start XAMPP → Start Apache & MySQL
2. Open browser → http://localhost/Sample_Sales_Data/src/
3. Work with application
4. When done → Stop services in XAMPP (optional)
```

### Workflow 2: Making Code Changes
```
1. Edit files in: C:\xampp\htdocs\Sample_Sales_Data\src\
2. Save changes (Ctrl + S)
3. Refresh browser (F5 or Ctrl + R)
4. Changes appear immediately (no restart needed)
```

### Workflow 3: Testing on Multiple Devices
```
1. Start XAMPP services
2. Find your IP: ipconfig in PowerShell
3. On phone/tablet: http://YOUR-IP/Sample_Sales_Data/src/
4. Verify responsive design works
```

### Workflow 4: Creating Presentation Materials
```
1. Open application in browser
2. Navigate to E/R Diagram page
3. Press F11 for fullscreen
4. Take screenshots (Windows + Shift + S)
5. Use in PowerPoint/presentation
6. Export database schema from phpMyAdmin for documentation
```

### Workflow 5: Updating Database Structure
```
1. Design new table/modify existing
2. Create SQL file with changes
3. Go to phpMyAdmin
4. Run SQL query or import file
5. Update PHP code if needed (pages/*.php)
6. Test in browser
```

---

## Performance Tips

### Make Application Faster:

**1. Enable PHP Opcache**
- Edit: `C:\xampp\php\php.ini`
- Find: `opcache.enable=0`
- Change to: `opcache.enable=1`
- Restart Apache

**2. Limit Data Display**
- In `view_data.php`, change:
  ```php
  SELECT * FROM $table LIMIT 100
  ```
  to:
  ```php
  SELECT * FROM $table LIMIT 50
  ```

**3. Add Pagination**
- Modify queries to use LIMIT and OFFSET
- Add Previous/Next buttons

**4. Index Database Columns**
- In phpMyAdmin, add indexes to frequently queried columns
- Example: Add index on `customer.CUSTOMERNAME`

---
- PHP/MySQL integration
- Web application development

## License

This project is for educational purposes.
