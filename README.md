# Riyadh Amaken

A Laravel-based content management application with a web admin panel and REST API. Built with Laravel 12, Laravel Sanctum for API authentication, and Tailwind CSS for the UI.

## Features

- **Web authentication**: Register, login, logout with session-based auth; throttled login/register (5 attempts per minute).
- **Admin dashboard**: Overview with counts and quick links for Sliders, Categories, Gallery, Activities, Events, and Users.
- **Content management**: Full CRUD for Sliders, Categories, Gallery, Activities, Events, and Users via the admin panel.
- **Settings**: Site Name and Contact Email managed from Admin → Settings.
- **REST API**: Token-based auth (Laravel Sanctum); all resource endpoints protected except `POST /api/register` and `POST /api/login`.
- **Postman collection**: Ready-to-import collection for testing the API (see [postman/README.md](postman/README.md)).

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm (for frontend assets)
- MySQL, PostgreSQL, or SQLite

## Installation

1. **Clone and install dependencies**

   ```bash
   git clone <repository-url> Riyadh-amaken
   cd Riyadh-amaken
   composer install
   ```

2. **Environment**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Edit `.env`: set `DB_*` (and optionally `APP_URL`, `APP_NAME`). `APP_NAME` is set to "Riyadh Amaken" by default.

3. **Database**

   ```bash
   php artisan migrate
   ```

4. **Frontend assets**

   ```bash
   npm install
   npm run build
   ```

   For development: `npm run dev` (Vite).

5. **Run the app**

   ```bash
   php artisan serve
   ```

   Web: [http://127.0.0.1:8000](http://127.0.0.1:8000).  
   API base: [http://127.0.0.1:8000/api](http://127.0.0.1:8000/api).

## Web Routes

| Route | Description |
|-------|-------------|
| `GET /` | Redirects: guests → login; authenticated → admin dashboard |
| `GET /login` | Login form (guests only) |
| `POST /login` | Login (throttle: 5/min) |
| `GET /register` | Registration form (guests only) |
| `POST /register` | Register (throttle: 5/min) |
| `POST /logout` | Logout (auth required) |
| `GET /admin` | Dashboard (auth required) |
| `/admin/sliders`, `/admin/categories`, `/admin/gallery`, `/admin/activities`, `/admin/events`, `/admin/users` | CRUD (auth required) |
| `GET/PUT /admin/settings` | Settings (auth required) |

After login or register, users are redirected to the admin dashboard.

## API Routes

**Public (no token):**

- `POST /api/register` — Register; returns user + token.
- `POST /api/login` — Login; returns user + token.

**Protected (send `Authorization: Bearer {token}`):**

- `POST /api/logout` — Revoke current token.
- `GET /api/user` — Current user.
- `GET/POST /api/sliders`, `GET/PUT/DELETE /api/sliders/{id}`
- `GET/POST /api/categories`, `GET/PUT/DELETE /api/categories/{id}`
- `GET/POST /api/gallery`, `GET/PUT/DELETE /api/gallery/{id}`
- `GET/POST /api/activities`, `GET/PUT/DELETE /api/activities/{id}`
- `GET/POST /api/events`, `GET/PUT/DELETE /api/events/{id}`
- `GET/POST /api/users`, `GET/PUT/DELETE /api/users/{id}`
- `GET /api/settings`, `PUT /api/settings`

Without a valid token, protected endpoints return `401 Unauthorized` with JSON `{ "success": false, "message": "Unauthenticated." }`.

## API Authentication Flow

1. Call `POST /api/register` or `POST /api/login` with credentials.
2. From the response, take `data.token`.
3. Send it in the header: `Authorization: Bearer <token>` for all other API requests.
4. Call `POST /api/logout` to revoke the token.

See [postman/README.md](postman/README.md) for using the Postman collection and variables (`base_url`, `auth_token`, etc.).

## Tech Stack

- **Backend**: Laravel 12, Laravel Sanctum 4.x
- **Frontend**: Blade, Tailwind CSS 4, Vite 7
- **Database**: Eloquent ORM; migrations for `users`, `personal_access_tokens`, `settings`, and content tables

## Project Structure (high level)

- `app/Http/Controllers/Auth/` — Web login, register, logout.
- `app/Http/Controllers/Admin/` — Dashboard, CRUD for content and users, settings.
- `app/Http/Controllers/Api/` — API auth and resource controllers.
- `resources/views/auth/` — Login and register views (split layout, validation UI).
- `resources/views/admin/` — Dashboard and CRUD views.
- `routes/web.php` — Web routes; `routes/api.php` — API routes.
- `postman/` — Postman collection and API docs.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
