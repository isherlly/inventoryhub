# 📚 BUSINESS MANAGEMENT SYSTEM - USER MANUAL

## **Table of Contents**
1. [Getting Started](#getting-started)
2. [Main Dashboard](#main-dashboard)
3. [Products Management](#products-management)
4. [Sales Management](#sales-management)
5. [Supplier Management](#supplier-management)
6. [Purchases](#purchases)
7. [Expenses Tracking](#expenses-tracking)
8. [Staff Management](#staff-management)
9. [Reports & Analytics](#reports--analytics)
10. [Forecasting](#forecasting)
11. [Alerts & Notifications](#alerts--notifications)
12. [Tips & Best Practices](#tips--best-practices)

---

## **Getting Started**

### **Logging In**
1. Go to: `http://localhost/karume-yii2/backend`
2. Enter your username and password
3. Click "Login"

### **Dashboard Overview**
The dashboard shows your business at a glance:
- **Today's Revenue** - Money made today
- **Today's Profit** - Pure profit made today
- **Monthly Performance** - This month's totals
- **Yearly Performance** - This year's totals
- **Stock Alerts** - Products running low
- **Top Products** - Best sellers by profit

---

## **Main Dashboard**

### **What You See**
```
📊 Dashboard displays:
├─ Today's Sales & Profit
├─ This Month's Summary
├─ This Year's Summary
├─ Low Stock Warnings
└─ Top 5 Profitable Products
```

### **Quick Actions**
- Click any report link to view details
- Check alerts daily for low stock
- Monitor profit trends

---

## **Products Management**

### **Adding a New Product**
1. Click **📦 Products** → **Create Product**
2. Fill in details:
   - **Product Name**: What you're selling (e.g., "Rice")
   - **Category**: Type of product (e.g., "Grains")
   - **Cost Price**: What you paid for it (₦5,000)
   - **Selling Price**: What you sell it for (₦7,000)
   - **Stock Quantity**: How many units you have (50)
   - **Min Stock Level**: Alert when stock drops below (5)
   - **Description**: Optional details
3. Click **Save**

### **Viewing Products**
- Click **📦 Products** to see all items
- Shows:
  - Current stock level
  - Cost vs selling price
  - Profit margin percentage
  - Low stock warnings

### **Editing Products**
1. Click product name
2. Click **Update**
3. Change details
4. Click **Save**

### **Why Minimum Stock Level Matters**
- Set it based on how fast you sell
- Example: If you sell 5 bags of rice daily, set minimum to 20 (4 days supply)
- System will alert you when stock reaches this level

---

## **Sales Management**

### **Recording a Sale**
1. Click **💰 Sales** → **Create Sale**
2. Select product from dropdown
3. Enter customer name (can be "Walk-in Customer" if anonymous)
4. Enter quantity sold
5. Cost Price and Selling Price auto-fill from product data
6. Click **Save Sale**

**Important**: Stock automatically updates when you save!

### **Viewing Sales History**
- Click **💰 Sales** to see all transactions
- Shows:
  - Product sold
  - Customer name
  - Quantity
  - Revenue made
  - Profit earned
  - Date & time

### **Understanding the Numbers**
```
If you sell 10 bags of Rice:
- Cost Price: ₦5,000 per bag
- Selling Price: ₦7,000 per bag
- Total Sale: ₦70,000 (10 × 7,000)
- Profit: ₦20,000 (10 × 2,000)
```

---

## **Supplier Management**

### **Adding a Supplier**
1. Click **🏭 Suppliers**
2. Click **Create Supplier**
3. Enter:
   - Supplier name
   - Contact person
   - Phone number
   - Email
   - Address
   - Payment terms (e.g., "Cash" or "30 days credit")
4. Click **Save**

### **Why Track Suppliers?**
- Know who supplies what
- Contact info readily available
- Track payment terms

---

## **Purchases**

### **Recording a Purchase**
1. Click **📥 Purchases** → **Create Purchase**
2. Select supplier
3. Select product
4. Enter:
   - Quantity purchased
   - Unit price paid
5. Total cost calculates automatically
6. Click **Save Purchase**

**Important**: Stock automatically increases when you record purchase!

### **Example**
```
Buying from Supplier:
- Supplier: "ABC Trading"
- Product: "Rice"
- Quantity: 100 bags
- Unit Price: ₦5,000
- Total Cost: ₦500,000
Result: Your rice stock increases by 100!
```

---

## **Expenses Tracking**

### **Recording an Expense**
1. Click **💸 Expenses** → **Create Expense**
2. Select expense type:
   - Rent
   - Utilities (water, electricity)
   - Transportation
   - Maintenance
   - Salary
   - Marketing
   - Other
3. Enter amount
4. Add description (optional)
5. Click **Save**

### **Why Track Expenses?**
- Know where your money goes
- Helps with profit calculations
- Important for tax records

---

## **Staff Management**

### **Adding an Employee**
1. Click **👥 Staff** → **Create Staff**
2. Enter:
   - Name
   - Position (e.g., "Sales Person", "Manager")
   - Phone
   - Email
   - Monthly salary
   - Hire date
3. Click **Save**

### **Tracking Employees**
- Easy access to staff contact info
- Salary records
- Employment history

---

## **Reports & Analytics**

### **1. Daily Report**
Shows sales for a specific day:
```
What it tells you:
- How many items sold today
- Total revenue today
- Total profit today
- Each transaction
```
**Use when**: End of each day to verify sales

### **2. Weekly Report**
Shows sales for the past week:
```
What it tells you:
- Best selling days
- Weekly total profit
- Weekly performance
```
**Use when**: Every Friday to review week performance

### **3. Monthly Report**
Shows entire month's sales:
```
What it tells you:
- Total sales this month
- Total profit this month
- All transactions
```
**Use when**: End of month for accounting

### **4. Yearly Report**
Shows entire year's sales:
```
What it tells you:
- Annual revenue
- Annual profit
- All transactions
```
**Use when**: Year-end reporting

### **5. Product Analysis**
Shows which products make most profit:
```
Tells you:
- Total profit per product
- Profit margin %
- Current stock
- Sales volume per product
```
**Use when**: Deciding what to stock more/less

### **6. Inventory Value Report**
Shows total value of all stock:
```
Tells you:
- How much money you spent on all products
- Current selling value of all stock
- Potential profit if you sell everything
```
**Use when**: Calculating business net worth

### **7. Sales Trends Report** (30 days)
Shows sales performance over time:
```
Tells you:
- Best selling days
- Slow days
- Average daily profit
- Patterns and trends
```
**Use when**: Spotting patterns

### **8. Profit & Loss Report**
Complete income statement:
```
Shows:
- Total Revenue
- Cost of Goods Sold
- Gross Profit
- All Expenses
- NET PROFIT (bottom line)
```
**Use when**: Monthly/quarterly financial review

---

## **Forecasting**

### **1. Demand Forecast (Next 30 Days)**
Predicts what will sell:
```
Shows per product:
- Average daily sales (from history)
- Expected sales next 30 days
- Days until stock runs out
- How much to restock
```
**How to use**:
1. Go to **Forecasting** → **Demand Forecast**
2. Look at "Days of Stock Remaining"
3. If 🔴 RED: Buy immediately!
4. If 🟡 YELLOW: Buy within a week
5. If 🟢 GREEN: You're fine

**Example**:
```
Rice:
- Selling 5 bags/day
- Current stock: 40 bags
- Days remaining: 8 days
- Action: Buy more within 3 days
```

### **2. Sales Forecast (Next 30 Days)**
Predicts future revenue:
```
Shows:
- Average daily revenue (from history)
- Expected revenue next 30 days
- Expected profit next 30 days
- Weekly breakdown
```
**How to use**:
1. Go to **Forecasting** → **Sales Forecast**
2. See what to expect next month
3. Plan expenses accordingly
4. Budget for new inventory

### **3. Stock Forecast (What Will Run Out)**
Warns which products will finish:
```
Shows per product:
- Days until stockout
- Recommended restock date
- Status: URGENT / Soon / Safe
```
**How to use**:
1. Check daily or weekly
2. 🔴 URGENT: Restock immediately (0-3 days)
3. 🟡 Soon: Restock this week (4-7 days)
4. 🟢 Safe: No urgency (8+ days)

---

## **Alerts & Notifications**

### **Stock Alerts**
When a product stock drops below minimum level:
1. Check **⚠️ Alerts** section
2. See which products are low
3. Buy more from suppliers
4. Mark alert as **Resolved** when restocked

---

## **Tips & Best Practices**

### **✅ Daily Checklist**
- [ ] Check **Alerts** for low stock items
- [ ] Record all sales
- [ ] Check **Dashboard** for today's profit
- [ ] Contact supplier if items are urgent

### **✅ Weekly Checklist**
- [ ] View **Weekly Report**
- [ ] Check **Sales Trends** for patterns
- [ ] Review **Demand Forecast** for next week
- [ ] Restock based on forecast

### **✅ Monthly Checklist**
- [ ] Run **Monthly Report**
- [ ] Check **Profit & Loss**
- [ ] Review **Product Analysis**
- [ ] Plan next month's inventory
- [ ] Record all expenses

### **✅ Setting Minimum Stock Levels**
Good rule of thumb:
- **Fast sellers** (sell 10/day): Set minimum to 50 (5 days)
- **Medium sellers** (sell 3/day): Set minimum to 15 (5 days)
- **Slow sellers** (sell 1/day): Set minimum to 5 (5 days)

### **✅ Using Forecasting Effectively**
1. Check **Demand Forecast** before ordering
2. Use **Sales Forecast** for financial planning
3. Use **Stock Forecast** to prevent stockouts
4. Adjust minimum stock levels based on forecast

### **✅ Tracking Profitability**
1. Check **Product Analysis** monthly
2. If profit margin is too low (< 20%), consider:
   - Raising selling price
   - Finding cheaper supplier
   - Discontinuing product
3. Focus stock on high-margin products

### **✅ Managing Expenses**
1. Record ALL expenses daily
2. Check **Profit & Loss** to see impact
3. Look for areas to reduce costs
4. Compare expenses month-to-month

---

## **Common Questions**

### **Q: How do I know if I'm making profit?**
A: Check the **Dashboard**:
- Today's Profit = Sales Price - Cost Price
- See detailed breakdown in **Daily Report**

### **Q: Why is my stock decreasing without sales?**
A: Check **Sales** - you may have recorded sales you forgot about

### **Q: When should I reorder?**
A: Use **Demand Forecast**:
- Don't wait until stock runs out
- Order when forecast shows 5-7 days remaining
- Add buffer for supplier delivery time

### **Q: How do I track money I'm owed?**
A: When selling on credit:
- Record the sale normally
- Track in **Customer Credits** (coming soon)
- Mark as paid when money arrives

### **Q: How accurate is forecasting?**
A: More accurate when:
- You have more history (data)
- Business is stable (not growing too fast)
- You track everything

---

## **Getting Help**

If something isn't working:
1. Check this manual first
2. Make sure you're in the right section
3. Verify data was saved (check list afterwards)
4. Contact system administrator

---

**Good luck with your business! 🚀**

Use this system daily and you'll have complete control over your inventory and profits!
