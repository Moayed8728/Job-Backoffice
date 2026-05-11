# Job Backoffice

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MariaDB](https://img.shields.io/badge/MariaDB-Database-003545?style=for-the-badge&logo=mariadb&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-UI-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-Frontend-646CFF?style=for-the-badge&logo=vite&logoColor=white)

**Job Backoffice** is the administrative web application for the TalentConnect job platform ecosystem. It gives administrators and company owners a secure workspace for managing companies, job categories, job vacancies, users, applications, and operational analytics.

The project is built with Laravel 12 and follows a traditional server-rendered back-office architecture using Blade, Tailwind CSS, Laravel Breeze authentication, role-based middleware, validated form requests, relational database constraints, and a shared private domain package for reusable TalentConnect models and business logic.

## Table of Contents

- [Overview](#overview)
- [Core Features](#core-features)
- [Architecture](#architecture)
- [Workflow](#workflow)
- [Technology Stack](#technology-stack)
- [Engineering Concepts](#engineering-concepts)
- [Project Structure](#project-structure)
- [Environment Requirements](#environment-requirements)
- [Installation](#installation)
- [Environment Configuration](#environment-configuration)
- [Usage](#usage)
- [Testing and Quality](#testing-and-quality)
- [Engineering Decisions](#engineering-decisions)
- [Future Improvements](#future-improvements)
- [Contributing](#contributing)
- [License](#license)

## Overview

Job Backoffice centralizes administrative operations for a recruitment platform. Instead of managing job data directly in the database or through disconnected tools, the application provides authenticated dashboards and CRUD workflows for the main platform entities:

| Area | Purpose |
| --- | --- |
| Dashboard | Shows platform-level or company-specific analytics. |
| Companies | Manages employer profiles and company owner accounts. |
| Job Categories | Organizes vacancies by business domain or role family. |
| Job Vacancies | Creates, updates, archives, and restores job listings. |
| Job Applications | Reviews applicants, resume details, AI-generated scores, feedback, and statuses. |
| Users | Allows administrators to manage platform users and restore archived records. |
| Profile | Lets authenticated users maintain their account information and password. |

The application is designed for two primary roles:

- **Admin**: Full back-office access to companies, categories, users, jobs, applications, and global analytics.
- **Company Owner**: Scoped access to their company profile, their job vacancies, their applications, and company-specific analytics.

## Core Features

- 🔐 Authentication powered by Laravel Breeze.
- 🧭 Role-based access control for admins and company owners.
- 📊 Dashboard analytics for active users, total jobs, total applications, most-applied jobs, and conversion rates.
- 🏢 Company management with linked owner account creation.
- 🗂 Job category management.
- 💼 Job vacancy management with company and category relationships.
- 📝 Application review with status updates.
- ♻️ Soft-delete archive and restore flows for key resources.
- ✅ Dedicated Form Request classes for validation and user-friendly error messages.
- 🧩 Shared domain package integration through Composer.
- 🎨 Server-rendered Blade UI styled with Tailwind CSS and Alpine.js.
- 🧪 Pest/Laravel test setup for authentication, profile, feature, and unit tests.

## Architecture

The project follows Laravel's MVC structure with clear separation between HTTP routing, controller actions, request validation, views, database schema, and shared domain models.

```text
Browser
  |
  v
Laravel Web Routes
  |
  v
Auth + Role Middleware
  |
  v
Controllers
  |
  v
Form Requests -> Validation
  |
  v
Shared Domain Models / Eloquent
  |
  v
MariaDB Database
  |
  v
Blade + Tailwind Views
```

### High-Level Components

| Component | Responsibility |
| --- | --- |
| `routes/web.php` | Defines authenticated admin and company-owner route groups. |
| `app/Http/Controllers` | Handles dashboard, CRUD, profile, and authentication workflows. |
| `app/Http/Requests` | Encapsulates validation rules for create/update actions. |
| `app/Http/Middleware/RoleMiddleware.php` | Restricts route access by user role. |
| `resources/views` | Blade templates for dashboards, entities, auth screens, layouts, and components. |
| `database/migrations` | Defines users, sessions, companies, categories, jobs, resumes, applications, cache, and analytics fields. |
| `database/seeders` | Loads initial demo data from JSON files and creates sample platform records. |
| `job/shared` | Private Composer package that provides shared domain models and reusable platform logic. |

## Workflow

1. A user authenticates through the Laravel Breeze login flow.
2. Route middleware verifies the user's role before allowing access.
3. The controller loads the relevant resource scope:
   - Admin users can access platform-wide records.
   - Company owners are limited to records related to their company.
4. Form Request classes validate incoming create and update operations.
5. Eloquent models persist changes to the relational database.
6. Soft-deleted records remain archived and can be restored from archive views.
7. Blade templates render the management interface with Tailwind CSS styling.

## Technology Stack

| Category | Technologies |
| --- | --- |
| Backend | PHP 8.2+, Laravel 12 |
| Frontend | Blade, Tailwind CSS, Alpine.js |
| Build Tooling | Vite, Laravel Vite Plugin, PostCSS, Autoprefixer |
| Database | MariaDB, Laravel Migrations, Eloquent ORM |
| Authentication | Laravel Breeze |
| Authorization | Custom role middleware |
| Validation | Laravel Form Requests |
| Testing | Pest, Pest Laravel Plugin, PHPUnit runtime |
| Developer Tools | Composer, npm, Laravel Pint, Laravel Pail, Laravel Sail, Tinker |
| Data Seeding | Faker, JSON seed data |
| Shared Logic | Private Composer package: `job/shared` |

## Engineering Concepts

- **MVC architecture** for predictable request handling and maintainable feature boundaries.
- **Role-based access control** to separate admin and company-owner responsibilities.
- **Server-side validation** using dedicated Form Request classes.
- **Soft deletes** for archive/restore workflows instead of destructive record removal.
- **Relational modeling** with UUID primary keys and foreign key constraints.
- **Scoped queries** to limit company-owner views to their own company data.
- **Reusable shared package design** to keep domain models consistent across the TalentConnect ecosystem.
- **Dashboard aggregation** with Eloquent counts, relationship queries, and computed conversion metrics.
- **Progressive frontend enhancement** with Blade-rendered pages, Tailwind utilities, and Alpine.js.
- **Testable Laravel structure** with feature tests around auth/profile behavior and Pest configuration.

## Project Structure

```text
.
├── app/
│   ├── Http/
│   │   ├── Controllers/       # Dashboard, CRUD, profile, and auth controllers
│   │   ├── Middleware/        # Role-based access middleware
│   │   └── Requests/          # Form Request validation classes
│   ├── Providers/             # Laravel service providers
│   └── View/Components/       # Blade layout components
├── bootstrap/                 # Laravel bootstrap and middleware registration
├── config/                    # Application, auth, cache, database, mail, queue, session config
├── database/
│   ├── data/                  # JSON seed data for jobs and applications
│   ├── migrations/            # Database schema definitions
│   └── seeders/               # Demo/initial data seeders
├── public/                    # Public entry point and compiled frontend assets
├── resources/
│   ├── css/                   # Tailwind entry stylesheet
│   ├── js/                    # Vite JavaScript entry points
│   └── views/                 # Blade pages, layouts, auth screens, and components
├── routes/                    # Web, auth, and console routes
├── storage/                   # Logs, cache, compiled views, and local files
├── tests/                     # Pest feature and unit tests
├── composer.json              # PHP dependencies and Laravel scripts
├── package.json               # Frontend dependencies and Vite scripts
└── vite.config.js             # Laravel Vite configuration
```

## Environment Requirements

Install the following before running the project:

- PHP **8.2 or newer**
- Composer
- Node.js and npm
- MariaDB or a compatible MySQL database
- Git
- Access to the private `job/shared` Composer package repository

Recommended local PHP extensions:

- `pdo_mysql`
- `mbstring`
- `openssl`
- `tokenizer`
- `xml`
- `ctype`
- `json`
- `fileinfo`

## Installation

Clone the repository and install dependencies:

```bash
git clone <repository-url>
cd Job-Backoffice-main
composer install
npm install
```

Create the environment file and generate the app key:

```bash
cp .env.example .env
php artisan key:generate
```

Create a local database, then update `.env` with your local connection details.

Run migrations and seed optional demo data:

```bash
php artisan migrate
php artisan db:seed
```

Build frontend assets for production:

```bash
npm run build
```

Or run the development servers:

```bash
composer run dev
```

The `composer run dev` script starts the Laravel server, queue listener, and Vite dev server together.

## Environment Configuration

Use placeholder values in documentation and shared examples. Never commit real credentials, tokens, private hosts, or production secrets.

```env
APP_NAME="Job Backoffice"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=<local-app-url>

DB_CONNECTION=mariadb
DB_HOST=<database-host>
DB_PORT=<database-port>
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database

MAIL_MAILER=log
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="${APP_NAME}"

VITE_APP_NAME="${APP_NAME}"
```

Security notes:

- Keep `.env` out of version control.
- Use strong unique credentials for every environment.
- Rotate credentials before deployment if they were ever shared locally.
- Store production secrets in the hosting provider's secret manager or environment configuration.

## Usage

Start the local application:

```bash
php artisan serve
npm run dev
```

Then open the local Laravel URL in your browser.

Common development commands:

| Command | Purpose |
| --- | --- |
| `php artisan migrate` | Run database migrations. |
| `php artisan db:seed` | Seed demo records from JSON data. |
| `php artisan migrate:fresh --seed` | Rebuild the local database with seeded records. |
| `npm run dev` | Start Vite for local frontend development. |
| `npm run build` | Compile production frontend assets. |
| `php artisan test` | Run the Laravel/Pest test suite. |
| `vendor/bin/pint` | Format PHP code using Laravel Pint. |
| `php artisan tinker` | Inspect or create local data interactively. |

After seeding, create or verify an administrator account locally before testing protected pages. Do not reuse demo credentials in shared or production environments.

## Testing and Quality

The project includes Pest tests for authentication, password confirmation, email verification, password reset, profile updates, and example unit/feature coverage.

Run the test suite:

```bash
php artisan test
```

Format PHP code:

```bash
vendor/bin/pint
```

For production readiness, run:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

## Engineering Decisions

- **Shared package dependency**: Domain models are provided through `job/shared` so the back office and other TalentConnect services can use the same model contracts and relationships.
- **Blade-first UI**: Server-rendered pages keep the admin interface simple, fast, and maintainable without adding SPA complexity.
- **Role middleware**: Access rules are enforced at the route level, reducing repeated authorization checks inside views.
- **Form Request validation**: Each resource has dedicated request classes, keeping controllers focused on orchestration.
- **Soft deletes**: Archiving protects operational data from accidental permanent deletion while supporting restoration workflows.
- **UUID primary keys**: UUIDs reduce predictability of identifiers and support safer cross-service data merging.
- **Database-backed sessions, queue, and cache**: The default local configuration keeps setup straightforward while remaining compatible with production service upgrades.

## Challenges Solved

- Built separate admin and company-owner workflows on top of the same domain entities.
- Scoped company-owner data access so employers only manage their own jobs and applications.
- Modeled job applications with resume references, AI-generated score fields, feedback, and lifecycle statuses.
- Added dashboard metrics that summarize operational activity without requiring a separate analytics service.
- Kept shared platform logic centralized through Composer instead of duplicating models across applications.

## Future Improvements

- Add policy classes for more granular authorization beyond route-level role checks.
- Add search, filtering, and sorting for large company, user, job, and application datasets.
- Expand automated tests around authorization boundaries and archive/restore flows.
- Add audit logs for sensitive administrative actions.
- Add queue-backed notifications for application status changes.
- Add export functionality for reports and recruiting analytics.
- Introduce API endpoints for approved integrations with the public TalentConnect platform.
- Add observability with structured logs, metrics, and error tracking.
- Move cache, queue, and sessions to Redis for higher scale deployments.
- Add CI pipelines for tests, formatting, static analysis, and build verification.

## Contributing

Contributions should keep the codebase secure, readable, and consistent with Laravel conventions.

1. Create a feature branch from the main development branch.
2. Keep changes focused and avoid unrelated refactors.
3. Add or update tests for behavior changes.
4. Run `php artisan test` before opening a pull request.
5. Run `vendor/bin/pint` before submitting PHP changes.
6. Never commit `.env`, credentials, tokens, database dumps, private URLs, or generated secrets.
7. Document new environment variables in `.env.example` using placeholder values only.

Recommended pull request checklist:

- [ ] The change is scoped and easy to review.
- [ ] Validation, authorization, and error handling were considered.
- [ ] Tests were added or updated where appropriate.
- [ ] No sensitive information is included.
- [ ] Setup or usage documentation was updated if behavior changed.

## License

This project is currently documented as an internal TalentConnect back-office application.

The repository's `composer.json` declares the base project license as **MIT**. Confirm the final distribution license with the project owner before publishing, redistributing, or using this project outside its intended organization.
