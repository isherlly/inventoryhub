# QUICK START GUIDE

## **First Time Setup** (Do This Now!)

### **Step 1: Generate Sample Data**
```bash
cd c:\xampp\htdocs\karume-yii2
php yii seed/all
```

This creates:
- 10 sample products
- 5 sample customers  
- 150+ sample sales (last 30 days)

### **Step 2: Access Dashboard**
```
http://localhost/karume-yii2/backend
```

Login with your credentials

### **Step 3: Explore the System**
- Click **Dashboard** - See current business metrics
- Click **Products** - View sample products
- Click **Sales** - View sample sales data
- Click **Reports** - View various reports
- Click **Forecasting** - See predictions

---

## **How the System Works**

### **Flow Chart**
```
1. Add Products
   ↓
2. Buy from Suppliers
   ↓
3. Stock Increases
   ↓
4. Sell to Customers
   ↓
5. Stock Decreases + Profit Increases
   ↓
6. View Reports & Forecasts
```

### **Daily Workflow**
```
Morning:
- Check Dashboard
- Check Alerts

During Day:
- Record Each Sale
- Record Any Expenses

Evening:
- Review Daily Report
- Plan Tomorrow
```

### **Weekly Workflow**
```
Friday:
- View Weekly Report
- Check Sales Trends
- Review Demand Forecast
- Plan next week's purchases
```

### **Monthly Workflow**
```
Month-End:
- View Monthly Report
- Check Profit & Loss
- Review Product Analysis
- Plan next month inventory
```

---

## **Main Features**

### **1. Inventory Management**
- Track all products
- Stock levels
- Profit margins
- Low stock alerts

### **2. Sales Tracking**
- Record every sale
- Auto-calculate profit
- Customer tracking
- Sales history

### **3. Supplier Management**
- Track suppliers
- Record purchases
- Auto-update stock

### **4. Expense Tracking**
- Record all expenses
- Categorize expenses
- See impact on profit

### **5. Staff Management**
- Employee information
- Salary tracking
- Contact details

### **6. Reports**
- Daily, Weekly, Monthly, Yearly
- Product Analysis
- Inventory Value
- Sales Trends
- Profit & Loss

### **7. Forecasting**
- Demand Forecast (what will sell)
- Sales Forecast (revenue prediction)
- Stock Forecast (what will run out)

---

## **Key Metrics to Monitor**

### **Daily**
- Today's Revenue
- Today's Profit
- Low Stock Items

### **Weekly**
- Weekly Revenue
- Weekly Profit
- Top Selling Products

### **Monthly**
- Monthly Revenue
- Monthly Profit
- Expenses
- Net Profit

### **Products**
- Profit Margin %
- Stock Level
- Average Daily Sales

---

## **Tips for Success**

### **✅ DO**
- Record EVERY sale immediately
- Record ALL purchases
- Track ALL expenses
- Check alerts daily
- Use forecasting before ordering
- Review reports weekly

### **❌ DON'T**
- Estimate sales (record actual)
- Forget to update stock
- Mix personal & business expenses
- Ignore low stock alerts
- Over-order without forecast
- Skip monthly reviews

---

## **Common Shortcuts**

### **Quick Links**
- Dashboard: Click "Dashboard" in menu
- Add Product: Products → Create
- Record Sale: Sales → Create
- View Reports: Reports menu
- Check Forecast: Forecasting menu

---

## **Need Help?**

### **Check the Full Manual**
Open: `USER_MANUAL.md` in this folder

### **Common Issues**

**"Where's my data?"**
- Check if you ran the seed: `php yii seed/all`
- Data is stored in MySQL database

**"Stock didn't update"**
- Stock updates when you save sale
- Check if sale was actually saved

**"Forecast seems wrong"**
- Forecast needs at least 7 days of data
- More data = more accurate

---

**Start using it now! The more data you enter, the better the system works for you! 🚀**
