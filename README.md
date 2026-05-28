# OmniManage

OmniManage is a robust, modern, and scalable Laravel 12.x application built to manage Categories, Products, and Blog Posts. It features a premium, responsive UI powered by **Tailwind CSS v4** and **Alpine.js**, along with enterprise-level backend practices including Soft Deletes, automated Garbage Collection, and secure Error Logging.

## 🚀 Key Features

- **Modern Tech Stack:** Laravel 12.x, PHP 8.2+, Tailwind CSS v4, and Alpine.js.
- **Complete CRUD Systems:** Manage Categories, Products (with image uploads), and Posts.
- **Soft Deletes & Data Recovery:** Accidental deletions can be recovered. Data integrity is maintained.
- **Automated Garbage Collection:** Includes a scheduled background task (`CleanDeletedProducts`) to automatically clean up orphaned product images 30 days after deletion, saving disk space.
- **Premium Frontend Architecture:** Clean, component-based Blade architecture (`<x-primary-button>`, `<x-modal>`, etc.) eliminating Tailwind class duplication.
- **Security & Performance:** N+1 Query prevention, secure logging mechanisms, and defensive programming against soft-deleted relations.

---

## 🛠️ Requirements

Before starting, ensure your local environment meets the following requirements:

- **PHP:** 8.2 or higher
- **Composer:** Version 2.x
- **Node.js & NPM:** Latest LTS version
- **Database:** SQLite (Default) or MySQL

---

## 💻 Installation Guide

Follow these steps to get the project up and running on your local machine:

**1. Clone the repository**

```bash
git clone <repository-url>
cd OmniManage
```

**2. Install PHP Dependencies**

```bash
composer install
```

**3. Install Frontend Dependencies**

```bash
npm install
```

**4. Environment Configuration**
Copy the example environment file and generate your application key:

```bash
cp .env.example .env
php artisan key:generate
```

**5. Configure the Database**
By default, the project uses SQLite. Make sure your `.env` contains:

```env
DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database.sqlite
```

_(If using MySQL, update `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` accordingly)._

**6. Run Migrations & Seeders**
Set up the database structure and populate it with initial dummy data:

```bash
php artisan migrate --seed
```

**7. Create Storage Link**
**Crucial Step:** You must link the storage directory to make uploaded product images publicly accessible:

```bash
php artisan storage:link
```

**8. Compile Frontend Assets**
Compile the Tailwind CSS and Alpine.js assets:

```bash
npm run build
# Or use `npm run dev` for hot-reloading during development
```

**9. Start the Development Server**

```bash
php artisan serve
```

The application will be accessible at `http://localhost:8000`.

---

## ⚙️ Maintenance & Background Tasks

### Garbage Collection (Clean Deleted Products)

This project uses Soft Deletes for Products. When a product is deleted, its image remains on the disk for 30 days. To clean up old images and permanently delete the database records, a custom Artisan command is scheduled.

You can run this cleanup manually at any time:

```bash
php artisan app:clean-deleted-products
```

_(In a production environment, ensure you have configured Laravel's Scheduler by adding `php artisan schedule:run` to your server's Cron tab)._

---

## 🛡️ License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
