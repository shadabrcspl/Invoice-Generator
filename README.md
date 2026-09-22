# Cod Xpert Invoices ⚡

> **Statutory-Compliant Foreign Currency Invoicing, GST LUT Exemption & Real-Time Forex Variance Platform for Global Exporters.**  
> *Engineered & Maintained by [CodXpert](https://codxpert.com/).*

[![CodXpert](https://img.shields.io/badge/Maintained%20by-CodXpert-0066FF?style=flat-square&logo=googlechrome&logoColor=white)](https://codxpert.com/)
[![Website](https://img.shields.io/badge/Official%20Site-codxpert.com-10B981?style=flat-square)](https://codxpert.com/)
[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=flat-square&logo=php)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat-square&logo=bootstrap)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/License-Proprietary-blue.svg?style=flat-square)](#)

---

## 🌟 Key Features

- **GST LUT 0% IGST Export Billing:** Automatic injection of statutory Letter of Undertaking (LUT) declarations pursuant to Rule 96A of CGST Rules 2017 / Section 16 of the IGST Act.
- **Multi-Currency Engine:** Real-time exchange rate sync via ExchangeRate-API (USD, AED, EUR, GBP, AUD, CAD) with manual override capabilities to lock exact invoice-date rates.
- **Forex Variance & FIRC / e-BRC Reconciliation:** Logs exact bank liquidation dates, realized INR values, and automatically accounts for realized Forex gains or losses with FIRC reference numbers.
- **Monthly GSTR-1 Tax Portal Export:** One-click CSV generation pre-formatted for direct Chartered Accountant and GST portal filing.
- **Business Expense & Input Tax Credit (ITC) Tracker:** Digital receipt uploads with automatic tax breakdown and Excel exports.
- **Custom Per-User SMTP Mailer:** Isolated, domain-verified SMTP delivery with AES-256 encrypted credentials and dispatch audit logs.
- **DPDP Act 2023 Compliant:** Full data privacy compliance with digital consent logging, encryption at rest, and audit trails.
- **DomPDF Generation:** Pixel-perfect export invoices with statutory watermarks and tax breakdown tables.

---

## 🏗️ Tech Stack

- **Backend:** Laravel 10 (PHP 8.2+)
- **Frontend:** Bootstrap 5.3, Space Grotesk & Plus Jakarta Sans typography, Vanilla ES6 JavaScript
- **Database:** MySQL 8.0+
- **PDF Engine:** Barryvdh DomPDF
- **Exchange Rates:** ExchangeRate-API integration with automated daily cron sync

---

## 🚀 Quick Setup & Installation

### 1. Clone the Repository
```bash
git clone https://github.com/shadabrcspl/Invoice-Generator.git
cd Invoice-Generator
```

### 2. Install Dependencies
```bash
composer install
npm install && npm run build
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

Configure your `.env` database and API credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=invoice_codxpert
DB_USERNAME=your_username
DB_PASSWORD=your_password

EXCHANGERATE_API_KEY=your_exchangerate_api_key
EXCHANGERATE_API_URL=https://v6.exchangerate-api.com/v6
```

### 4. Run Migrations & Seeders
```bash
php artisan migrate --seed
```

### 5. Storage Link & Exchange Rates
```bash
php artisan storage:link
php artisan exchange-rates:fetch
```

### 6. Scheduled Tasks (Crontab)
To keep daily exchange rates and payment reminders synchronized:
```bash
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

---

## 🔒 Security & Secrets Safeguard

- All sensitive secrets (`.env`, database credentials, SMTP keys, API tokens) are strictly excluded from version control via `.gitignore`.
- User SMTP passwords stored in the database are encrypted using `AES-256-CBC` via Laravel's Crypt encrypter.

---

## 🏢 About CodXpert

**CodXpert Invoices** is designed and engineered by **[CodXpert](https://codxpert.com/)**, an enterprise web & software engineering firm specializing in high-performance digital products, API architectures, and statutory fintech systems.

- **Website:** [https://codxpert.com/](https://codxpert.com/)
- **Solutions:** Enterprise Web Apps, Custom Invoicing Platforms, Forex & Cloud Integrations
- **Inquiries:** [support@codxpert.com](mailto:support@codxpert.com)

---

© 2026 [CodXpert](https://codxpert.com/). All rights reserved.

