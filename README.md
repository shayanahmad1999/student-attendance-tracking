# Laravel Project Setup

This README will guide you through setting up and running the Laravel project locally.

## Prerequisites

Ensure the following tools are installed on your system:
🔧 Tech Stack:

-   PHP >= 8.3
-   Laravel = 12
-   Livewire = 3
-   Composer
-   Node.js >= 24.x
-   NPM >= 8.x
-   MySQL or any supported database

## Installation & Setup

Follow the steps below to get started:

```bash
# Clone the repository
git clone https://github.com/shayanahmad1999/student-attendance-tracking.git
cd folder_name

# Install PHP dependencies
composer install

# Initialize and install Node.js dependencies
npm install

# Build frontend assets
npm run build

# Run the development server (optional during setup)
npm run dev

# Copy and set up the environment configuration
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate --seed

# setup index.php in the public folder
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// student-attendance-tracking change this into your folder project name
if (file_exists($maintenance = __DIR__ . '/../../student-attendance-tracking/storage/framework/maintenance.php')) {
    require $maintenance;
}

// student-attendance-tracking change this into your folder project name
require __DIR__ . '/../../student-attendance-tracking/vendor/autoload.php';

// student-attendance-tracking change this into your folder project name
/** @var Application $app */
$app = require_once __DIR__ . '/../../student-attendance-tracking/bootstrap/app.php';

$app->handleRequest(Request::capture());

# Run the development server again
php artisan serve
npm run dev

```
