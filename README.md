# 📦 InvenTrack - Smart Inventory & Borrowing Management System

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.0-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
</p>

## 📋 About InvenTrack

**InvenTrack** is a web-based inventory and item borrowing management system designed to efficiently manage item loans and returns. Equipped with QR Code features for item tracking, PDF reports, and data export to Excel.

> 💡 This project was created for Internship purposes

## ✨ Key Features

### 👤 User Features
- **User Dashboard**: View available items for borrowing
- **Item Borrowing**: Submit item borrowing requests
- **Borrowing History**: View borrowing history with various statuses
- **PDF Receipt**: Download borrowing proof in PDF format
- **Real-time Status**: Track borrowing status (Pending, Approved, Borrowed, Returned, Rejected)

### 👨‍💼 Admin Features
- **Admin Dashboard**: System statistics overview (Total Items, Users, Borrowings, etc.)
- **Item Management**: 
  - CRUD items with photos, manufacturer, model, serial number, and asset tag
  - Smart QR Code generation (Priority: Asset Tag > Serial Number > Auto Generate)
  - Print QR Code
  - Stock management with movement tracking
  - Hide/Show items from user dashboard
  - Auto-fill form from existing items
  - Unique validation for serial numbers and asset tags
- **Category Management**: 
  - Create, edit, and delete item categories
  - Centralized category management page
- **User Management**: CRUD users with role management (Admin/User)
- **Borrowing Management**: 
  - Approve/Reject borrowing requests with reason
  - QR Scanner for item pickup and return validation
  - QR Scanner for item identification
  - Admin can directly return items without waiting for user request
  - Prevent duplicate borrowing requests
  - Support multiple users borrowing same item (for items with stock > 1)
  - View borrowing details with complete history
- **Notification System**:
  - Real-time notifications for admins and users
  - Mark all as read functionality
  - Auto-notification for borrowing status changes
- **Movement History**: Track all item movements (in/out) with detailed information
- **Export Data**: Export data to Excel or PDF (Items, Users, Borrowings, Movements)
## 🛠️ Tech Stack

- **Framework**: Laravel 12.0
- **PHP**: 8.2+
- **Database**: MySQL/PostgreSQL
- **Frontend**: 
  - Tailwind CSS
  - Alpine.js (via Laravel Breeze)
- **Packages**:
  - `barryvdh/laravel-dompdf` - Generate PDF
  - `maatwebsite/excel` - Export to Excel
  - `simplesoftwareio/simple-qrcode` - Generate QR Code
  - `laravel/breeze` - Authentication

## 📦 Installation

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL/PostgreSQL
- Node.js & NPM

### Installation Steps

1. **Clone Repository**
   ```bash
   git clone https://github.com/Amee30/InvenTrack-Internship-Project.git
   cd InvenTrack-Internship-Project
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   
   Edit file `.env` and set your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=inventrack
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run Migration & Seeder**
   ```bash
   php artisan migrate --seed
   ```

6. **Storage Link**
   ```bash
   php artisan storage:link
   ```

7. **Build Assets**
   ```bash
   npm run dev
   # or for production
   npm run build
   ```

8. **Run Application**
   ```bash
   php artisan serve
   ```

   Your app is running at `http://localhost:8000`
   

9. **Set Up Scheduler (Optional)**

   To enable automatic cancellation of unpicked borrowings after 1 day, set up the Laravel scheduler:
   - For local development, run:
     ```bash
     php artisan schedule:work
     ```
   - For production, add the following cron entry:
     ```cron
     * * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
     ```

## 👥 Default Credentials

After seeding the database, you can use the following default credentials to log in:

**Admin:**
- Email: `admin@example.com`
- Password: `password`

**User:**
- Email: `user@example.com`
- Password: `password`

## 📁 Database Structure

### Tables
- `users` - User Data (admin & user)
- `barangs` - Item Data (with manufacturer, model, serial_number, asset_tag, is_hidden)
- `categories` - Category Management
- `borrowings` - Borrowing Data (with reject_reason)
- `barang_movements` - Item Movement History (in/out tracking)
- `notifications` - Real-time System Notifications

## 🎯 How To Use

### For Users:
1. Log in to the system
2. Browse available items on the dashboard (hidden items won't be shown)
3. Click "Borrow Now" to submit a borrowing request
4. Wait for admin approval
5. Check borrowing status and receive notifications in real-time
6. If status is Waiting Pickup, go to the item pickup location
7. Request return when finished using the item
8. Download borrowing receipt in PDF format

### For Admin:
1. Log in as admin
2. Manage items with advanced features:
   - Add items with manufacturer, model, serial number, and asset tag
   - Auto-fill form from existing items
   - Generate unique QR codes (auto or from asset tag/serial number)
   - Hide items from user dashboard
   - Track stock and movement history
3. Manage categories from dedicated settings page
4. Approve/reject borrowing requests with custom rejection reasons
5. Use QR Scanner for three modes:
   - **Pickup Mode**: Validate item pickup by scanning QR code
   - **Return Mode**: Validate item return or admin can directly return items
   - **Identify Mode**: Scan QR code to quickly find and view item details
6. Monitor all item movements with detailed tracking
7. Manage user accounts and roles
8. Export comprehensive reports to Excel or PDF
9. Print QR codes and borrowing receipts
10. Receive notifications for all borrowing activities

## 📸 Screenshots

### User Dashboard
Displays a list of available items for borrowing with stock and status information to manage borrowing requests with status tracking.
<img src="public/Images/userdashboard_preview.png">

### Admin Dashboard and Borrowing Management
Overview of system statistics with charts, quick actions, and a table of borrower lists.
<img src="public/Images/dashboard_preview.png">

### Item Management
Shows a list of items with CRUD features, QR Code generation, and stock management.
<img src="public/Images/barangsindex_preview.png">

### QR Code Scanner with Multiple Modes
Advanced QR scanner with three modes:
- **Pickup Mode**: Validate item pickup by scanning QR code
- **Return Mode**: Validate item return or admin can directly return items
- **Identify Mode**: Quickly find item details by scanning QR code
<img src="public/Images/qrscanner_preview.png">

### Item Movement History
Tracking item movements with detailed information on borrowing and returning.
<img src="public/Images/itemmovementsindex_preview.png">

### Export Data
Export item, user, borrowing, and item movement data to Excel or PDF format for reporting.
<img src="public/Images/export_preview.png">

and many more...

## 🔐 Security Features

- Authentication with Laravel Breeze
- Role-based Access Control (Admin/User)
- CSRF Protection
- XSS Protection
- SQL Injection Prevention
- Password Hashing
- Unique validation for serial numbers and asset tags
- Borrowing duplicate prevention
- Stock validation to prevent over-borrowing

## 📱 Responsive Design

This application is built with a responsive design using Tailwind CSS, ensuring optimal user experience across various devices:
- Desktop (1920px+)
- Laptop (1024px - 1919px)
- Tablet (768px - 1023px)
- Mobile (< 768px)

## 📝 License

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Developer

Developed with ❤️ by Darma

## 📧 Contact
- Email: darmaputra2017@gmail.com
- GitHub: [@Amee30](https://github.com/Amee30)
- Project Link: [InvenTrack](https://github.com/Amee30/InvenTrack-Internship-Project)

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
- [Alpine.js](https://alpinejs.dev) - Lightweight JavaScript framework
- [Simple QR Code](https://www.simplesoftware.io) - QR Code generator
- [DomPDF](https://github.com/dompdf/dompdf) - PDF generator
- [Laravel Excel](https://laravel-excel.com) - Excel export/import

---

**TL;DR**: Some variables and parts of the code documentation are written in Indonesian. Sorry about that.

---

<p align="center">
  Made with ❤️ using Laravel
</p>
