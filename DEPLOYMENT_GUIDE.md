# 🚀 DEPLOYMENT GUIDE

## **Deploying to Live Server**

### **Step 1: Get a Domain Name**
Options:
- Namecheap.com
- GoDaddy.com
- Hostinger.com
- Domain.com.ng (for Nigeria)

Cost: ₦2,000 - ₦10,000/year

### **Step 2: Get a Hosting Plan**
Requirements for this system:
- PHP 7.4+
- MySQL 5.7+
- SSL Certificate (HTTPS)
- Minimum 500MB storage
- 1GB+ RAM recommended

Recommended hosts:
- Hostinger (₦1,500/month)
- Bluehost (₦3,000/month)
- Hetzner (₦5,000/month)
- Local: Jiji.ng, Kijiji.com.ng

### **Step 3: Upload Files to Server**

1. **Download FileZilla** (free FTP client)
2. Get FTP credentials from hosting provider
3. Connect to FTP:
   - Host: ftp.yourdomain.com
   - Username: Your FTP user
   - Password: Your FTP password
4. Upload entire project to `/public_html/` folder

### **Step 4: Configure Database**

1. Create MySQL database on hosting panel
2. Update `common/config/main-local.php`:
```php
'db' => [
    'class' => \yii\db\Connection::class,
    'dsn' => 'mysql:host=YOUR_HOST;dbname=YOUR_DB',
    'username' => 'YOUR_USERNAME',
    'password' => 'YOUR_PASSWORD',
    'charset' => 'utf8',
],
```

3. Run migrations (via hosting control panel or SSH):
```bash
php yii migrate
php yii seed
```

### **Step 5: Set Permissions**

Required writable folders:
```
/backend/runtime (755)
/frontend/runtime (755)
/console/runtime (755)
/common/runtime (755)
```

Via FTP or SSH:
```bash
chmod -R 755 backend/runtime
chmod -R 755 frontend/runtime
chmod -R 755 console/runtime
chmod -R 755 common/runtime
```

### **Step 6: Enable HTTPS**

1. Request free SSL from hosting provider (usually included)
2. Redirect HTTP to HTTPS
3. Update config to use https://yourdomain.com

### **Step 7: Test Live Site**

1. Go to https://yourdomain.com/backend
2. Login with your credentials
3. Test all features
4. Verify database connection
5. Check file uploads work

### **Step 8: Backup Setup**

Create automatic backups:
1. Use hosting panel backup tool (daily)
2. Or use FTP to backup weekly
3. Keep 4 weeks of backups

### **Troubleshooting**

**Error: Class not found**
- Run: `php composer.phar install`

**Database connection error**
- Check database credentials in main-local.php
- Verify database exists

**Blank page**
- Check error logs
- Enable debug mode temporarily

---

## **MOBILE ACCESS**

The system is **already responsive** and works on phones!

Just go to: `https://yourdomain.com/backend` from any phone browser

---

## **ONGOING MAINTENANCE**

### **Daily**
- Check alerts for low stock
- Record sales

### **Weekly**
- Review sales reports
- Restock based on forecast

### **Monthly**
- Backup database
- Check for updates
- Review profit & loss

### **Quarterly**
- Review all settings
- Update server certificates
- Check disk space

---

## **SECURITY TIPS**

1. **Change default password** - Do it first day
2. **Enable HTTPS** - Always encrypt
3. **Regular backups** - 3-2-1 rule (3 copies, 2 types, 1 offsite)
4. **Update regularly** - Keep PHP/MySQL updated
5. **Limit access** - Only give credentials to trusted people
6. **Use strong passwords** - 12+ characters, mix of symbols

---

## **COST SUMMARY**

| Item | Cost | Frequency |
|------|------|-----------|
| Domain | ₦2,000-5,000 | Yearly |
| Hosting | ₦1,500-5,000 | Monthly |
| SSL (Free) | ₦0 | Included |
| **Total** | **₦1,500-5,000** | **Monthly** |

---

**Your business is now online! 🎉**
