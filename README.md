# 🏪 Business Inventory & Management System

A complete business management system for shops, warehouses, and trading businesses built with **Yii2 Framework** and **MySQL**.

---

## 🎯 **What This System Does**

### **Core Features**
- ✅ **Inventory Management** - Track all products, stock levels, profit margins
- ✅ **Sales Tracking** - Record every transaction with automatic profit calculation
- ✅ **Supplier Management** - Track suppliers and purchases
- ✅ **Expense Tracking** - Record all business expenses
- ✅ **Staff Management** - Employee information and salary tracking
- ✅ **Stock Alerts** - Automatic alerts when stock is low
- ✅ **Reports** - Daily, Weekly, Monthly, Yearly reports
- ✅ **Forecasting** - Predict what will sell, stock levels, and revenue
- ✅ **Analytics** - Product analysis, profit & loss, sales trends
- ✅ **Export** - CSV export of data

---

## 📊 **Key Metrics Tracked**

### **For Each Product**
- Cost price vs Selling price
- Profit per unit and total profit
- Stock quantity and minimum level
- Sales volume
- Profit margin percentage

### **For Business**
- Daily/Weekly/Monthly/Yearly revenue
- Total profit
- Operating expenses
- Net profit
- Inventory value
- Top performing products

---

## 🚀 **Getting Started**

### **Prerequisites**
- XAMPP or similar (Apache, MySQL, PHP 7.4+)
- Composer

### **Installation**

1. **Copy project to XAMPP folder**
```bash
cd C:\xampp\htdocs
# Paste the karume-yii2 folder here
```

2. **Install dependencies**
```bash
cd karume-yii2
composer install
```

3. **Create database**
```bash
# Database name: inventory
# Can create in phpMyAdmin
```

4. **Run migrations**
```bash
php yii migrate
```

5. **Generate sample data (optional)**
```bash
php yii seed/all
```

6. **Access the system**
```
http://localhost/karume-yii2/backend
```

---

## 📁 **Project Structure**

```
karume-yii2/
├── backend/                    # Admin dashboard
│   ├── controllers/           # Business logic (Products, Sales, Reports, etc.)
│   ├── views/                 # UI templates
│   └── web/                   # Public accessible folder
├── common/                    # Shared code
│   ├── models/               # Database models (Product, Sale, Purchase, etc.)
│   └── config/               # Common configuration
├── console/                  # Command-line scripts
│   ├── controllers/          # Commands (Seed data)
│   └── migrations/           # Database migrations
├── vendor/                   # PHP libraries (Yii2, etc.)
└── README.md                 # This file
```

---

## 🗄️ **Database Tables**

| Table | Purpose |
|-------|---------|
| `products` | All items you sell |
| `sales` | Every transaction |
| `customers` | Customer information |
| `suppliers` | Supplier information |
| `purchases` | Stock purchases from suppliers |
| `expenses` | Business expenses (rent, utilities, etc.) |
| `staff` | Employee information |
| `customer_credits` | Money owed by customers |
| `stock_alerts` | Low stock notifications |
| `user` | System users/accounts |

---

## 📊 **Dashboard Overview**

The main dashboard shows:
```
┌─────────────────────────────────────┐
│   TODAY'S REVENUE    │   TODAY'S PROFIT   │
│      ₦X,XXX,XXX      │    ₦XXX,XXX      │
├─────────────────────────────────────┤
│  MONTHLY REVENUE │ MONTHLY PROFIT   │
│   ₦XX,XXX,XXX    │  ₦X,XXX,XXX    │
├─────────────────────────────────────┤
│  YEARLY REVENUE  │  YEARLY PROFIT   │
│   ₦XX,XXX,XXX    │  ₦XX,XXX,XXX    │
├─────────────────────────────────────┤
│  ACTIVE ALERTS   │  TOTAL PRODUCTS  │
│      X Items     │      X Items     │
└─────────────────────────────────────┘
```

---

## 🎨 **Menu Structure**

```
📊 Dashboard
📦 Products (Create, View, Edit, Delete)
💰 Sales (Record sales)
📥 Purchases (Track purchases from suppliers)
🏭 Suppliers (Manage suppliers)
💸 Expenses (Track business expenses)
👥 Staff (Employee management)
⚠️  Alerts (Low stock warnings)

📈 Reports
  ├─ Daily Report
  ├─ Weekly Report
  ├─ Monthly Report
  ├─ Yearly Report
  ├─ Product Analysis
  ├─ Inventory Value
  ├─ Sales Trends
  └─ Profit & Loss

🔮 Forecasting
  ├─ Demand Forecast (What will sell)
  ├─ Sales Forecast (Revenue prediction)
  └─ Stock Forecast (What will run out)
```

---

## 💡 **Example Workflow**

### **Day 1: Setup**
1. Add products: Rice (₦5,000 cost, ₦7,000 selling), Beans, etc.
2. Set minimum stock levels for each product
3. Record initial stock quantities

### **Day 2: Buy from Supplier**
1. Go to **Purchases** → Record purchase
2. Select supplier, product, quantity, price
3. **Stock automatically increases!**

### **Day 3: Sell to Customer**
1. Go to **Sales** → Record sale
2. Select product, customer, quantity
3. **Stock automatically decreases, Profit automatically calculated!**

### **Day 7: Check Reports**
1. Go to **Reports** → **Weekly Report**
2. See total sales, profit, and trends

### **Day 30: Review**
1. Go to **Reports** → **Monthly Report**
2. Go to **Reports** → **Profit & Loss**
3. Check **Forecasting** for next month

---

## 🔮 **Forecasting Examples**

### **Demand Forecast**
```
Product: Rice
- Selling: 5 bags per day (average)
- Current stock: 40 bags
- Days remaining: 8 days
- Status: 🟡 RESTOCK SOON
- Action: Buy more within 3 days
```

### **Sales Forecast**
```
Last 60 days average: ₦500,000/day
Forecast next 30 days: ₦15,000,000
Forecast profit: ₦5,000,000
```

### **Stock Forecast**
```
Products running out in next 30 days:
1. Rice - 8 days (URGENT)
2. Beans - 15 days (Soon)
3. Flour - 45 days (Safe)
```

---

## 📊 **Reports Available**

| Report | Shows | Use When |
|--------|-------|----------|
| Daily | Today's sales & profit | End of day |
| Weekly | Week's performance | Friday |
| Monthly | Month's totals | Month-end |
| Yearly | Year's totals | Year-end |
| Product Analysis | Profit by product | Planning stock |
| Inventory Value | Total stock worth | Quarterly review |
| Sales Trends | 30-day performance | Spotting patterns |
| Profit & Loss | Complete income statement | Financial review |

---

## 🛠️ **Customization**

### **Change Business Name**
Edit: `backend/views/layouts/main.php`
```php
'brandLabel' => 'Your Business Name'
```

### **Change Currency**
All amounts shown in ₦ (Naira). To change:
Search for `₦` in views and replace with your currency symbol.

### **Add New Report**
1. Create action in `ReportsController`
2. Create view file in `backend/views/reports/`
3. Add menu item in layout

---

## 🔐 **Security Features**

- ✅ User authentication required
- ✅ All queries protected against SQL injection
- ✅ CSRF token protection
- ✅ Password hashing
- ✅ Session management

**Remember**: Change default password immediately!

---

## 📱 **Mobile Access**

System is **fully responsive**:
- Works on phones, tablets, desktops
- Touch-friendly interface
- Mobile-optimized views

Just access: `http://localhost/karume-yii2/backend` from your phone!

---

## 🚀 **Deploying to Live Server**

See: `DEPLOYMENT_GUIDE.md` for complete instructions

Quick summary:
1. Get domain name (₦2,000-5,000/year)
2. Get hosting (₦1,500-5,000/month)
3. Upload files via FTP
4. Update database config
5. Run migrations
6. Enable HTTPS

---

## 📚 **Documentation**

- **USER_MANUAL.md** - Complete user guide with examples
- **QUICK_START.md** - Get running in 5 minutes
- **DEPLOYMENT_GUIDE.md** - Deploy to live server

---

## 🆘 **Troubleshooting**

### **Blank page**
- Check PHP error logs
- Verify database connection
- Enable debug mode

### **Database error**
- Verify database exists
- Check credentials in `common/config/main-local.php`
- Run migrations: `php yii migrate`

### **Stock not updating**
- Verify sale was saved
- Check purchase was recorded
- Refresh page

### **Forecast incorrect**
- Need more history data (7+ days)
- Check sales are being recorded
- More data = more accurate

---

## 💰 **Total Cost of Ownership**

### **Setup (One-time)**
- Domain: ₦2,000-5,000
- Hosting setup: ₦0 (usually free)
- **Total: ₦2,000-5,000**

### **Monthly**
- Hosting: ₦1,500-5,000
- Domain renewal: ₦167-417/month (₦2,000-5,000/year)
- **Total: ₦1,667-5,417/month**

### **Return on Investment**
For a business making ₦500,000/month:
- System cost: ₦5,400/month (1.08% of revenue)
- **Can easily save 5-10% of revenue through better management**
- **Break-even: 1-2 weeks**

---

## 📈 **Features by Version**

### **v1.0 (Current)**
✅ Products, Sales, Purchases, Suppliers
✅ Expenses, Staff, Customers
✅ All Reports and Forecasting
✅ Stock Alerts
✅ Dashboard & Analytics

### **v2.0 (Planned)**
- Multi-user support with roles
- Barcode scanning
- Mobile app
- Integration with payment systems
- Advanced analytics & ML forecasting

---

## 🎓 **Learning Resources**

- **Yii2 Framework**: https://www.yiiframework.com/
- **Bootstrap**: https://getbootstrap.com/
- **MySQL**: https://www.mysql.com/

---

## 📄 **License**

This system is provided as-is for business use.

---

## 💬 **Support**

For issues or questions:
1. Check USER_MANUAL.md
2. Review error logs
3. Verify database connection
4. Check all migrations ran

---

**Built with ❤️ for business success!**

**Start tracking today and grow your business 🚀**

---

## **Quick Commands**

```bash
# Install dependencies
composer install

# Run migrations
php yii migrate

# Generate sample data
php yii seed/all

# Clear cache
php yii cache/flush

# Access backend
http://localhost/karume-yii2/backend
```

---

**Let's make your business management digital! 📊✨**
