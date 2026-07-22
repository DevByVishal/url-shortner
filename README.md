# URL Shortener - Local Setup Guide

## Requirements

- PHP 8.2 or higher
- Composer
- MySQL
- Node.js and npm
- Git

## 1. Clone the Project

```bash
git clone https://github.com/DevByVishal/url-shortner.git
cd url-shortner
```

## 2. Install PHP Dependencies

```bash
composer install
```

## 3. Create the Environment File

```bash
cp .env.example .env
```

On Windows, copy `.env.example` manually and rename it to `.env`.

## 4. Generate Application Key

```bash
php artisan key:generate
```

## 5. Configure MySQL

Create a MySQL database, for example:

```text
url_shortner
```

Update `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=url_shortner
DB_USERNAME=root
DB_PASSWORD=
```

Use your local MySQL credentials if different.

## 6. Run Migrations

```bash
php artisan migrate
```

## 8. Seed Required Data

Run:

```bash
php artisan db:seed
```

The application uses Spatie Laravel Permission.

The configured roles are:

- SuperAdmin
- Admin
- Member

Make sure the project's seeder/raw SQL setup creates the required roles and initial SuperAdmin account.

## 8. Clear Laravel Cache

```bash
php artisan optimize:clear
```

## 9. Start Laravel

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

## Roles and Permissions

### SuperAdmin

- Can manage companies.
- Can invite an Admin in a new company.
- Cannot create short URLs.
- Can see short URLs across all companies.

### Admin

- Belongs to a company.
- Can invite another Admin or Member in their own company.
- Can view Team Members belonging to their own company.
- Can create short URLs.
- Can see short URLs created in their own company.

### Member

- Belongs to a company.
- Cannot invite users.
- Can create short URLs.
- Can only see short URLs created by themselves.

## Invitation Flow

Current rules:

- SuperAdmin can invite an Admin in a new company.
- Admin can invite another Admin or Member in their own company.
- Member cannot access invitation functionality.

## Short URL Flow

Admin and Member can create short URLs.

SuperAdmin cannot create short URLs.

Short URLs are publicly resolvable and redirect to the original URL.

Example:

```text
http://127.0.0.1:8000/{short_code}
```

```

This prevents Members from accessing the Team Members page directly.

Use appropriate middleware for other protected routes according to the application's authorization rules.

## Common Commands

Clear Laravel caches:

```bash
php artisan optimize:clear
```

Run migrations:

```bash
php artisan migrate
```

Fresh migration:

```bash
php artisan migrate:fresh
```

Fresh migration with seeders:

```bash
php artisan migrate:fresh --seed
```

Start Laravel:

```bash
php artisan serve
```

## Recommended Development Startup

Terminal 1:

```bash
php artisan serve
```

Then visit:

```text
http://127.0.0.1:8000
```

## Troubleshooting

### Database connection error

Check `.env`:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=url_shortner
DB_USERNAME=root
DB_PASSWORD=
```

Make sure MySQL is running.

### Route/configuration changes are not reflected

```bash
php artisan optimize:clear
```

### Role middleware error

Make sure Spatie Laravel Permission is installed and configured, and the following roles exist:

```text
SuperAdmin
Admin
Member
```

Then run:

```bash
php artisan optimize:clear
```

## Project Stack

- Laravel 12
- PHP
- MySQL
- Blade
- Bootstrap 5
- Spatie Laravel Permission
- Vite
- Custom Authentication
