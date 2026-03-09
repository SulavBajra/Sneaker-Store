# Sneaker-Store Backend

Laravel backend for the Sneaker-Store project.

This backend appears to be a Laravel app with modern frontend tooling (Vite + Inertia/Vue dependencies are present in `backend/package.json`).

---

## Requirements

- PHP (version compatible with the Laravel version used in this repo)
- Composer
- Node.js (for Vite / frontend assets in the Laravel app)
- A database:
  - Default `.env.example` uses `DB_CONNECTION=sqlite`

Optional (if you use Docker):
- Docker + Docker Compose (a `compose.yaml` exists in this folder)

---

## Setup (local)

### 1) Install PHP dependencies

```bash
cd backend
composer install
```

### 2) Environment configuration

Copy the example environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 3) Database

#### Option A: SQLite (default)
Your `.env.example` defaults to:

- `DB_CONNECTION=sqlite`

Make sure the SQLite database file exists (commonly `backend/database/database.sqlite`):

```bash
touch database/database.sqlite
```

Then run migrations:

```bash
php artisan migrate
```

#### Option B: MySQL/Postgres
Update `.env` with your DB settings (host, port, username, password, database name), then:

```bash
php artisan migrate
```

---

## Running the app (local)

### Terminal 1: Laravel server

```bash
php artisan serve
```

By default, Laravel serves on:

- http://127.0.0.1:8000

### Terminal 2: Vite dev server (assets)

```bash
npm install
npm run dev
```

---

## Useful commands

### PHP / Laravel

```bash
php artisan migrate
php artisan migrate:fresh --seed
php artisan route:list
php artisan tinker
```

### Node / Vite (see `backend/package.json` scripts)

```bash
npm run dev
npm run build
npm run lint
npm run format
npm run types:check
```

---

## Docker (optional)

A `compose.yaml` file exists in `backend/`. If you want to run via Docker, review and adjust it for your environment, then run:

```bash
docker compose up --build
```

(Exact services/ports depend on the `compose.yaml` configuration.)

---

## Environment variables

The template is in:

- `backend/.env.example`

At minimum you will usually need:

- `APP_KEY` (generated via `php artisan key:generate`)
- Database settings (`DB_CONNECTION`, etc.)

---

## Troubleshooting

### `APP_KEY` is missing
Run:

```bash
php artisan key:generate
```

### Assets not updating / Vite issues
Make sure you’re running:

```bash
npm install
npm run dev
```

---

## License

Add a `LICENSE` file if you plan to distribute this project.
