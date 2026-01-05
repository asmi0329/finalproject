# Nepal Rates Dashboard

A comprehensive Laravel application for tracking and managing market rates in Nepal, including fuel prices, foreign exchange rates, metal prices, weather data, and electricity tariffs.

## 🚀 Quick Start

### Prerequisites
- PHP 8.2+
- Composer
- Node.js 18+
- NPM

### Installation

1. **Clone or copy the project**
```bash
cd nepal_rates
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Setup environment**
```bash
copy .env.example .env
php artisan key:generate
```

4. **Setup database**
```bash
php artisan migrate
php artisan db:seed
```

5. **Build assets**
```bash
npm run build
```

6. **Start server**
```bash
php artisan serve
```

Visit: `http://localhost:8000`

## 📖 Full Documentation

For complete setup instructions, troubleshooting, and deployment guide, see [SETUP.md](SETUP.md)

## 🔑 Default Credentials

- **Admin**: `admin@neparates.com` / `password`
- **User**: `user@neparates.com` / `password`

## ✨ Features

### Admin Panel
- Fuel Price Management
- FX Rate Management (NRB Format)
- Metal Price Management
- Weather Snapshot Management
- Electricity Tariff Management
- User Management & Approval

### User Dashboard
- Real-time Market Data
- Location-based Search
- FX Rates Display
- Fuel Prices (NOC)
- Gold/Silver Bullion Prices
- Weather Information
- Metal Price Calculator

## 🎨 Design

Modern emerald/teal color scheme with gradient effects, responsive layout, and professional UI/UX.

## 📦 Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Blade Templates, Alpine.js, Tailwind CSS
- **Database**: SQLite (default) / MySQL
- **Build Tools**: Vite

## 📝 License

MIT License

---

For detailed setup instructions, see [SETUP.md](SETUP.md)
