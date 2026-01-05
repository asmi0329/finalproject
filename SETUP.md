# Nepal Rates Dashboard - Setup Guide

Complete guide for setting up the Nepal Rates Dashboard on a new machine.

---

## 📋 System Requirements

### Required Software
- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Node.js**: 18.x or higher
- **NPM**: Latest version
- **Database**: MySQL 8.0+ or SQLite (included)
- **Web Server**: Apache/Nginx (optional, PHP built-in server works)

### Optional Tools
- Git (for version control)
- VS Code or your preferred IDE

---

## 🚀 Quick Setup (5 Steps)

### Step 1: Copy Project Files
Transfer the entire `nepal_rates` folder to your new laptop.

### Step 2: Install PHP Dependencies
```bash
cd nepal_rates
composer install
```

### Step 3: Install Node Dependencies
```bash
npm install
```

### Step 4: Configure Environment
```bash
# Copy the example environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

### Step 5: Setup Database & Build Assets
```bash
# Run database migrations
php artisan migrate

# Seed database with sample data (optional)
php artisan db:seed

# Build frontend assets
npm run build
```

### Step 6: Start the Application
```bash
# Start development server
php artisan serve
```

Visit: `http://localhost:8000`

---

## 🔧 Detailed Setup Instructions

### 1. Environment Configuration

Edit the `.env` file with your settings:

```env
APP_NAME="Nepal Rates Dashboard"
APP_ENV=local
APP_KEY=base64:... # Generated automatically
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
# Option A: SQLite (Default - No setup needed)
DB_CONNECTION=sqlite
# DB_DATABASE=database/database.sqlite

# Option B: MySQL (If you prefer MySQL)
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=nepal_rates
# DB_USERNAME=root
# DB_PASSWORD=
```

### 2. Database Setup

#### Using SQLite (Recommended for Development)
SQLite database is already included in `database/database.sqlite`. Just run migrations:
```bash
php artisan migrate
```

#### Using MySQL
1. Create a database:
```sql
CREATE DATABASE nepal_rates;
```

2. Update `.env` with MySQL credentials
3. Run migrations:
```bash
php artisan migrate
```

### 3. Create Admin User

After migration, create an admin account:

**Option A: Using Database Seeder**
```bash
php artisan db:seed --class=DatabaseSeeder
```
This creates:
- Admin: `admin@neparates.com` / `password`
- Test User: `user@neparates.com` / `password`

**Option B: Manual Registration**
1. Visit `http://localhost:8000/register`
2. Register a new account
3. Manually update the database:
```sql
UPDATE users SET role = 'admin', is_approved = 1 WHERE email = 'your@email.com';
```

### 4. Build Frontend Assets

**For Development:**
```bash
npm run dev
```

**For Production:**
```bash
npm run build
```

---

## 🎯 Running the Application

### Development Mode
```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Watch for asset changes (optional)
npm run dev
```

### Production Mode
```bash
# Build assets
npm run build

# Serve with production server (Apache/Nginx)
# Or use Laravel's built-in server
php artisan serve --host=0.0.0.0 --port=8000
```

---

## 👥 User Roles & Access

### Admin Account
- **Email**: `admin@neparates.com`
- **Password**: `password`
- **Access**: Full CRUD operations on all data

### Regular User Account
- **Email**: `user@neparates.com`
- **Password**: `password`
- **Access**: View-only dashboard (requires admin approval)

### User Approval Workflow
1. New users register at `/register`
2. Admin approves users from Admin Panel → User Management
3. Approved users can access the dashboard

---

## 📁 Project Structure

```
nepal_rates/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/               # Database models
│   └── Middleware/           # Custom middleware
├── database/
│   ├── migrations/           # Database migrations
│   ├── seeders/             # Database seeders
│   └── database.sqlite      # SQLite database file
├── resources/
│   ├── views/               # Blade templates
│   ├── css/                 # CSS files
│   └── js/                  # JavaScript files
├── routes/
│   └── web.php              # Web routes
├── public/                  # Public assets
├── .env                     # Environment configuration
├── composer.json            # PHP dependencies
└── package.json             # Node dependencies
```

---

## 🔑 Important Files to Transfer

### Essential Files
- ✅ **Entire project folder** (all files and folders)
- ✅ **database/database.sqlite** (if using SQLite)
- ✅ **.env** (copy and reconfigure on new machine)

### Files to Regenerate (Don't transfer)
- ❌ `vendor/` folder (run `composer install`)
- ❌ `node_modules/` folder (run `npm install`)
- ❌ `public/build/` folder (run `npm run build`)

---

## 🛠️ Troubleshooting

### Issue: "Class not found" errors
**Solution:**
```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

### Issue: "Mix manifest not found"
**Solution:**
```bash
npm install
npm run build
```

### Issue: "Permission denied" on storage
**Solution (Windows):**
```bash
# No action needed on Windows
```

**Solution (Linux/Mac):**
```bash
chmod -R 775 storage bootstrap/cache
```

### Issue: Database connection errors
**Solution:**
1. Check `.env` database settings
2. Ensure database exists (MySQL) or file exists (SQLite)
3. Run: `php artisan config:clear`

### Issue: "Application key not set"
**Solution:**
```bash
php artisan key:generate
```

### Issue: Views not updating
**Solution:**
```bash
php artisan view:clear
php artisan config:clear
```

---

## 🎨 Features Included

### Admin Features
- ✅ Fuel Price Management (CRUD)
- ✅ FX Rate Management (CRUD)
- ✅ Metal Price Management (CRUD)
- ✅ Weather Snapshot Management (CRUD)
- ✅ Electricity Tariff Management (CRUD)
- ✅ User Management & Approval
- ✅ Professional Admin Dashboard

### User Features
- ✅ Real-time Market Data Dashboard
- ✅ Location-based Search/Filter
- ✅ FX Rates (NRB Format)
- ✅ Fuel Prices (NOC)
- ✅ Gold/Silver Bullion Prices
- ✅ Weather Information
- ✅ Metal Price Calculator
- ✅ Responsive Design

### Design
- ✅ Modern Emerald/Teal Color Scheme
- ✅ Gradient Effects & Animations
- ✅ Mobile-Responsive Layout
- ✅ Professional UI/UX

---

## 📦 Backup & Transfer Checklist

### Before Transfer
- [ ] Stop the development server
- [ ] Export database (if using MySQL)
- [ ] Note any custom `.env` settings
- [ ] Document any manual configurations

### Files to Copy
- [ ] Entire project folder
- [ ] `.env` file (reconfigure on new machine)
- [ ] Database file (if SQLite)
- [ ] Any uploaded files in `storage/app`

### On New Machine
- [ ] Install PHP 8.2+
- [ ] Install Composer
- [ ] Install Node.js & NPM
- [ ] Copy project files
- [ ] Run `composer install`
- [ ] Run `npm install`
- [ ] Configure `.env`
- [ ] Run `php artisan key:generate`
- [ ] Run `php artisan migrate`
- [ ] Run `npm run build`
- [ ] Test: `php artisan serve`

---

## 🚀 Quick Commands Reference

```bash
# Clear all caches
php artisan optimize:clear

# Rebuild everything
composer install && npm install && npm run build

# Fresh database (WARNING: Deletes all data)
php artisan migrate:fresh --seed

# Start development
php artisan serve

# Watch for changes (separate terminal)
npm run dev
```

---

## 📞 Support

For issues or questions:
1. Check the troubleshooting section above
2. Review Laravel documentation: https://laravel.com/docs
3. Check error logs in `storage/logs/laravel.log`

---

## 🎉 You're All Set!

Your Nepal Rates Dashboard should now be running on your new laptop!

**Default Access:**
- URL: `http://localhost:8000`
- Admin: `admin@neparates.com` / `password`
- User: `user@neparates.com` / `password`

**Remember to:**
- Change default passwords in production
- Configure proper database credentials
- Set `APP_ENV=production` and `APP_DEBUG=false` for production
