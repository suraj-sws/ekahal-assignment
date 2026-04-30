<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Ekahal Assignment

A Laravel 12 application for user authentication, dashboard reporting, product management, and account administration.

## Project Overview

This project includes:
- User registration and login.
- Session-based access control with middleware.
- A dashboard showing active product counts and account summary.
- Product management with fetch, add, activate/deactivate, delete, and search operations.
- Account management for admin users, including listing and deletion.

## Features

- Authentication: login and registration with password hashing.
- Admin-only account management.
- Products CRUD support:
  - Add new products with title, description, price, and availability date.
  - Activate or deactivate products.
  - Delete products.
  - Search and server-side pagination for products.
- Dashboard metrics for active products and total accounts.

## Tech Stack

- PHP 8.2
- Laravel Framework 12.x
- MySQL / MariaDB (via XAMPP or local database)
- Vite + Tailwind CSS
- Axios for AJAX requests

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL / MariaDB or SQLite
- XAMPP or another PHP web server

### Setup Steps

1. Open a terminal and navigate to the project directory:

   ```powershell
   cd d:\xampp\htdocs\ekahal-assignment
   ```

2. Install PHP dependencies:

   ```powershell
   composer install
   ```

3. Install JavaScript dependencies:

   ```powershell
   npm install
   ```

4. Copy the environment file and configure the database connection:

   ```powershell
   copy .env.example .env
   ```

5. Update `.env` with your database settings, for example:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ekahal_assignment
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Generate the application key:

   ```powershell
   php artisan key:generate
   ```

7. Run database migrations:

   ```powershell
   php artisan migrate
   ```

8. Build frontend assets for development:

   ```powershell
   npm run dev
   ```

9. Start the Laravel development server (optional):

   ```powershell
   php artisan serve
   ```

### XAMPP Notes

If you are using XAMPP, place the project in `htdocs` and ensure Apache and MySQL are running. You can access the app in your browser at:

- `http://127.0.0.1:8000` if using `php artisan serve`
- or `http://localhost/ekahal-assignment/public` if using Apache with XAMPP

## Database Schema

### `users`
- `id`
- `name`
- `email`
- `password`
- `role` (`user` or `admin`)
- timestamps

### `products`
- `id`
- `title`
- `description`
- `price`
- `date_available`
- `created_by`
- `status` (active / inactive)
- timestamps

## Routes Overview

- `/` or `/login` - login page
- `/register` - user registration
- `/authenticate` - login form submission
- `/registration` - register form submission
- `/dashboard` - authenticated dashboard
- `/logout` - logout
- `/products/*` - product management routes
- `/accounts/*` - admin account management routes

## Notes

- Only authenticated users can access `/dashboard`, `/products`, and `/accounts`.
- Only users with the `admin` role can access account management and delete accounts.
- Product status toggles are handled via AJAX endpoints.

## License

This project is released under the MIT License.
