# ☕ Dwijaya Coffee — Online Coffee Shop Ordering System

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/UI-Bootstrap_5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![Midtrans](https://img.shields.io/badge/Payment-Midtrans-002855?style=for-the-badge)

> Web-based ordering system built with **Laravel** for **Dwijaya Coffee**, a local coffee shop. Customers browse the menu, fill a cart, and pay online through the **Midtrans** payment gateway, while admins manage products and orders and the owner monitors sales through charts and PDF reports.

---

## 📌 Project Overview

Dwijaya Coffee needed a digital channel for orders and promotion. This system lets customers order without visiting the shop, and every transaction is stored automatically so the business can manage its menu, orders, and sales reports in one place.

The project was built as a semester 4 group project in partnership with Dwijaya Coffee and was deployed for about a year, during which it was tried out by the café's owner.

---

## 🚀 Key Features

### 🛒 Customer
- Register and log in.
- Browse the menu and catalog with category filter and search.
- Add products to a cart (stored in the browser), change quantities, and remove items.
- Check out and pay online with **Midtrans Snap**.

### 🧑‍🍳 Admin
- Dashboard.
- Manage product categories (with active/inactive status).
- Manage products: name, category, image, price, and active status.
- View order details and update order status (*Pending, Processing, Completed, Canceled*).

### 📈 Owner
- Dashboard.
- Sales report page.
- Sales chart with search filter (Chart.js).
- Download the sales report as **PDF** (DomPDF).
- Manage user accounts.

### 🔐 Roles

| Role | Access |
| :--- | :--- |
| **Owner** | Dashboard, sales report, sales chart, PDF report, user management |
| **Admin** | Dashboard, categories, products, orders |
| **Customer** | Menu, catalog, cart, checkout & payment |

---

## 🛠️ Technology Stack

| Component | Technology | Purpose |
| :--- | :--- | :--- |
| **Framework** | [Laravel 11](https://laravel.com/) (PHP 8.2) | Web application |
| **Database** | MySQL | Data storage |
| **Views** | Blade, [Bootstrap 5](https://getbootstrap.com/), Bootstrap Icons | User interface |
| **Payment Gateway** | [Midtrans](https://midtrans.com/) (`midtrans/midtrans-php`, Snap) | Online payment |
| **PDF** | [DomPDF](https://github.com/barryvdh/laravel-dompdf) | Sales report export |
| **Charts** | [Chart.js](https://www.chartjs.org/) | Sales chart |
| **Authentication** | Laravel Fortify, custom role middleware (`CheckUserType`) | Login and role-based access |

---

## 🌐 System Architecture

```text
Customer ──► Menu & Catalog ──► Cart ──► Checkout ──► Midtrans Snap payment
                                                          │
                                                          ▼
                                            Order saved (status: Pending)
                                                          │
Admin ──────────────────────────────► Process order ──► Processing ──► Completed
                                                          │
Owner ─────────────────────────────► Sales report, chart, and PDF export
```

---

## 📁 Project Structure

```text
app/
├── Http/
│   ├── Controllers/       # Auth, Catalog, Category, Chart, Customer, Dashboard,
│   │                      # Laporan (reports), Midtrans, Order, PDF, Product, User
│   └── Middleware/        # CheckUserType (role-based access)
└── Models/                # User, Category, Product, Order, OrderDetail, Transaction, DetailTransaksi
database/
├── migrations/            # users, categories, products, orders, order_details
└── seeders/               # Admin account and default categories
resources/views/
├── auth/                  # Login & register
├── customer/              # Home, about, menu, catalog, cart
├── category/ products/    # Admin product management
├── order/                 # Order list, detail, status update
├── laporan/ chart.blade.php download.blade.php  # Owner reports
└── user/                  # User management
routes/web.php             # Web routes grouped by role
```

---

## ⚙️ Installation & Setup

### Prerequisites
- PHP 8.2+ and Composer
- Node.js & npm
- MySQL / MariaDB
- A [Midtrans](https://dashboard.midtrans.com/) account (sandbox is fine for testing)

### Steps
```bash
git clone https://github.com/Aldidwiirawan/coffeeshop.git
cd coffeeshop
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Create a MySQL database (for example `coffeeshop`), fill in `.env`, then run:
```bash
php artisan migrate --seed
php artisan storage:link
```
The seeder creates an admin account (`admin@example.com`) and default categories. **Change its password after the first login.** New registrations become customers; to create an owner, set `usertype` to `owner` for that user in the `users` table.

---

## 🔐 Environment Variables

| Variable | Description |
| :--- | :--- |
| `DB_CONNECTION` | `mysql` |
| `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | MySQL connection |
| `MIDTRANS_SERVER_KEY` | Midtrans server key |
| `MIDTRANS_CLIENT_KEY` | Midtrans client key |
| `MIDTRANS_IS_PRODUCTION` | `false` for sandbox, `true` for production |

> ⚠️ Never commit the `.env` file or your Midtrans keys.

---

## ▶️ How to Run

```bash
php artisan serve
```
Open `http://127.0.0.1:8000`. Log in as admin, or register a new account to order as a customer.

---

## 👨‍💻 Author

Semester 4 group project (team of four) in partnership with Dwijaya Coffee.

**Aldi Dwi Irawan** — team lead; worked across all parts of the system
- GitHub: [@Aldidwiirawan](https://github.com/Aldidwiirawan)
- Portfolio: [aldidwiirawan.vercel.app](https://aldidwiirawan.vercel.app)
- Email: aldidwiirawan2004@gmail.com

Team member: Sheva Adrian ([@Sheva1012](https://github.com/Sheva1012))
