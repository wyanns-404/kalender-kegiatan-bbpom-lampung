# 📆 Kalender Kegiatan BBPOM Bandar Lampung

![Kalender Demo](https://github.com/wyanns-404/wyanns-404.github.io/blob/main/publicAssets/img/kalender-bbpom/Screenshot%20Kalender%20Kegiatan%20BBPOM%20di%20Bandar%20Lampung.png?raw=true)

**Kalender Kegiatan** adalah sistem manajemen kegiatan berbasis kalender interaktif untuk BBPOM Bandar Lampung. Dibangun menggunakan Laravel, FullCalendar.js, dan Filament Admin.

---

## 🚀 Installation

### 1. Clone repository:
```sh
git clone https://github.com/wyanns-404/kalender-kegiatan-bbpom-lampung.git kalender-kegiatan-bbpom-lampung && cd kalender-kegiatan-bbpom-lampung
```

### 2. Install PHP dependencies:

```sh
composer install
```

### 3. Install NPM dependencies:

```sh
npm install
```

### 4. Setup configuration:

```sh
cp .env.example .env
```

### 5. Generate application key:

```sh
php artisan key:generate
```

### 6. Run database migrations:

```sh
php artisan migrate
```

### 7. Seed the database:

```sh
php artisan db:seed
```

### 8. Run the dev server:

```sh
composer run dev
```

---

## ✅ Access the Admin Dashboard

Buka aplikasi di browser:

```
http://localhost:8000/admin
```

Login menggunakan kredensial berikut:

* **Username:** `wayan@example.com`
* **Password:** `11111111`

---

## 🗂️ Features to Explore

### 📅 Main Calendar

* Month View
* Week View
* Day View
* List View
* Event Click → Modal with Event Details
* Upcoming Events Display
* Real-time Time Indicator
* Private Content in Modal (Visible to Staff Only)
* Event CRUD (Admin Only)
* Event Visibility Settings (Admin Only)

---

## ⚙️ Tech Stack

### 🧠 Backend
- **Laravel 12** – Framework PHP modern untuk pengembangan web
- **Filament 3** – Admin Panel yang ringan dan fleksibel untuk Laravel
- **PHP 8.2** – Bahasa pemrograman backend yang digunakan
- **MySQL / MariaDB** – Sistem manajemen basis data relasional

### 🎨 Frontend
- **FullCalendar.js** – Kalender interaktif (dayGrid, timeGrid, list, interaction)
- **Tailwind CSS 4** – Utilitas CSS modern untuk styling cepat dan responsif
- **Vite** – Bundler cepat untuk frontend modern

---
