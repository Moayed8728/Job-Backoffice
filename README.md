# Job Backoffice

1. Introduction

    Job Backoffice is the administrative panel for the TalentConnect ecosystem. It allows administrators to manage job listings, users, and application data.

2. Tech Stack

    1. Laravel 12
    2. PHP 8.3+
    3. MariaDB
    4. Shared internal package: job/shared

3. Architecture

    1. Connects to the same database as TalentConnect.
    2. Uses shared business logic from job/shared package.
    3. Manages jobs, employers, and platform data.

4. Installation

    1. Clone the repository.
    2. Run composer install.
    3. Copy .env.example to .env.
    4. Configure database credentials.
    5. Run php artisan key:generate.
    6. Run php artisan migrate.
    7. Run php artisan serve.

5. Shared Package

    1. This project depends on job/shared.
    2. Business logic and shared models are centralized.
    3. Composer manages the shared dependency.

6. Development Notes

    1. Ensure bootstrap/cache exists and is writable.
    2. Ensure storage directories are writable.
    3. Ensure database container is running.

7. License

    Internal project for TalentConnect ecosystem.
