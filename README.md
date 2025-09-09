# Note

The file `public/sql/sample.sql` has been added for testing purposes. If something does not work on your end, you can use this SQL file to help troubleshoot or set up the database. (admin@test.com:password)

# Job Test: Laravel Secure Login & User Dashboard (Practical Coding Test)

## Overview

This project is a secure PHP-based Login and Registration System built with Laravel 12 featuring a user dashboard with full CRUD (Create, Read, Update, Delete) functionality. It demonstrates modern best practices, including:

-   User authentication with sessions
-   Secure database interaction using both Eloquent ORM and raw PDO with prepared statements
-   XSS, CSRF, and SQL injection protection
-   Password hashing and validation
-   Client-side and server-side form validation
-   User-friendly error handling
-   Tailwind CSS for UI

## Features

-   **User Registration & Login**: Secure registration and login with session-based authentication.
-   **User Dashboard**: View, create, update, and delete user records (CRUD).
-   **PDO Integration**: All authentication and user CRUD operations are also implemented using raw PDO with prepared statements for demonstration.
-   **Security**: XSS protection, CSRF tokens, password hashing, and session timeout.
-   **Validation**: Robust server-side validation and enhanced JavaScript client-side validation.
-   **Error Handling**: Friendly error messages for validation and authentication issues.

## Setup Instructions

### 1. Clone the Repository

```
git clone https://github.com/yourusername/job-test.git
cd job-test
```

### 2. Install Dependencies

```
composer install
```

### 3. Configure Environment

-   Copy `.env.example` to `.env` and update your database credentials:

```
cp .env.example .env
```

-   Set `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` in `.env`.

### 4. Generate Application Key

```
php artisan key:generate
```

### 5. Run Migrations

```
php artisan migrate
```

### 6. Serve the Application

```
composer run dev
```

Visit [http://localhost:8000](http://localhost:8000) in your browser.

## Database Structure

-   See `database/migrations/0001_01_01_000000_create_users_table.php` for the `users` table and related tables.
-   You can also export the structure with:

```
php artisan schema:dump
```

## File Structure Highlights

-   `app/Http/Controllers/AuthController.php`: Handles registration and login (Eloquent & PDO).
-   `app/Http/Controllers/UserController.php`: Handles user CRUD (Eloquent & PDO).
-   `app/Helpers/PdoUser.php`: Raw PDO helper for secure SQL operations.
-   `resources/views/auth/`: Login and registration forms.
-   `resources/views/dashboard/`: User dashboard and CRUD forms.
-   `routes/web.php`: Route definitions and middleware.

## Security Best Practices

-   **SQL Injection**: All raw SQL uses prepared statements.
-   **XSS**: All user input is sanitized and output is escaped.
-   **CSRF**: All forms use CSRF tokens.
-   **Password Hashing**: Uses `password_hash`/`Hash::make` and `password_verify`/`Hash::check`.
-   **Session Management**: Custom middleware for session timeout and secure handling.

## Author

-   [Royland](https://github.com/roylandvp)
