# 🚀 Quick Start Guide - Sales Data Web Application

## Complete Setup in 5 Minutes

### Step 1: Start XAMPP (1 minute)
1. Open **XAMPP Control Panel**
2. Click **Start** next to Apache
3. Click **Start** next to MySQL
4. Wait for both to show green "Running" status

### Step 2: Copy Files (1 minute)
Copy the project folder to XAMPP's web directory:
- **From:** `Sample_Sales_Data` folder
- **To:** `C:\xampp\htdocs\`

**Result:** You should have `C:\xampp\htdocs\Sample_Sales_Data\`

### Step 3: Automatic Database Setup (2 minutes)
1. Open your browser
2. Go to: **http://localhost/Sample_Sales_Data/src/setup.php**
3. Wait for the setup to complete (imports all tables automatically)
4. Click **"Go to Application"** button

### Step 4: Explore the Application (1 minute)
You're done! The application is now running at:
**http://localhost/Sample_Sales_Data/src/**

---

## 📋 What You Can Do Now

### View Dashboard
- See real-time database statistics
- Check connection status
- Access quick navigation

### Browse E/R Diagram
- Click "E/R Diagram" in navigation
- View high-resolution database design
- Download diagram as PNG or PDF

### Explore Schema
- Click "Database Schema" in navigation
- Read detailed table descriptions
- See all attributes and relationships

### View Data
- Click "View Data" in navigation
- Select any table from dropdown
- Browse actual records in the database

---

## 🔧 Alternative: Manual Setup

If automatic setup fails:

### 1. Create Database Manually
1. Go to: **http://localhost/phpmyadmin**
2. Click **"New"** in left sidebar
3. Enter name: `sales_data`
4. Click **"Create"**

### 2. Import SQL Files (in this order!)
Click "Import" tab and import each file:
1. `database/sql/Address.sql`
2. `database/sql/Customer.sql`
3. `database/sql/Contact.sql`
4. `database/sql/DomesticCustomer.sql`
5. `database/sql/InternationalCustomer.sql`
6. `database/sql/Product_Line.sql`
7. `database/sql/Product.sql`
8. `database/sql/Orders.sql`
9. `database/sql/Order_Line.sql`

### 3. Access Application
Go to: **http://localhost/Sample_Sales_Data/src/**

---

## ❓ Common Issues & Solutions

### Issue: "Connection failed" error
**Solution:**
- Check MySQL is running (green in XAMPP)
- Refresh the page
- Verify database name is `sales_data`

### Issue: "404 Not Found"
**Solution:**
- Verify Apache is running (green in XAMPP)
- Check folder is in `C:\xampp\htdocs\Sample_Sales_Data\`
- Try: http://localhost/Sample_Sales_Data/src/index.php

### Issue: E/R Diagram not showing
**Solution:**
- Copy `diagram` folder to: `C:\xampp\htdocs\Sample_Sales_Data\diagram\`
- Check file exists: `Sample Sales ER Diagram.png`

### Issue: No data in tables
**Solution:**
- Go to phpMyAdmin
- Select `sales_data` database
- Check if tables exist
- If not, run import again

---

## 📱 Access Points

| Feature | URL |
|---------|-----|
| Main Application | http://localhost/Sample_Sales_Data/src/ |
| Automated Setup | http://localhost/Sample_Sales_Data/src/setup.php |
| phpMyAdmin | http://localhost/phpmyadmin |
| XAMPP Dashboard | http://localhost |

---

## 📊 Database Information

**Database Name:** `sales_data`

**Tables (9 total):**
- Address (92 rows)
- Customer (92 rows)
- Contact (92 rows)
- DomesticCustomer (35 rows)
- InternationalCustomer (57 rows)
- Product_Line (7 rows)
- Product (109 rows)
- Orders (307 rows)
- Order_Line (2,823 rows)

**Total Records:** 3,514

---

## 🎯 Next Steps

After setup is complete, you can:

1. **Explore the data** - Use the data viewer to browse tables
2. **Study the schema** - Understand the database design
3. **Analyze relationships** - Review the E/R diagram
4. **Run custom queries** - Use phpMyAdmin for SQL queries
5. **Extend the application** - Add new features in PHP

---

## 💡 Tips

- **Bookmark** the main URL for quick access
- **Keep XAMPP running** while using the application
- **Check statistics** on homepage to verify data integrity
- **Use View Data** to explore relationships between tables
- **Download diagrams** for offline reference

---

## 📖 More Information

- **Full Documentation:** See [README.md](README.md)
- **Web App Details:** See [src/README.md](src/README.md)
- **Database Schema:** Check "Database Schema" page in the app

---

## ✅ Verification Checklist

Before using the application, verify:

- [ ] XAMPP Apache is running (green status)
- [ ] XAMPP MySQL is running (green status)
- [ ] Files are in `C:\xampp\htdocs\Sample_Sales_Data\`
- [ ] Database `sales_data` exists in phpMyAdmin
- [ ] All 9 tables are imported
- [ ] Application loads at http://localhost/Sample_Sales_Data/src/
- [ ] Connection status shows green checkmark

If all items are checked, you're ready to go! 🎉

---

**Need Help?**
- Check the Troubleshooting section above
- Review full documentation in README.md
- Verify XAMPP installation and configuration
