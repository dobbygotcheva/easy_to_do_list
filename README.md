# Task List Web App

A simple Laravel + Blade task list application where users can add, mark as done, and delete tasks.

## ✨ Features

- ✅ Add new tasks
- ✅ Mark tasks as done/undone
- ✅ Delete tasks
- 🎨 Beautiful, modern UI with smooth animations
- 💾 SQLite database (easy to set up)

## 📁 Project Structure

```
untitled/
├── app/
│   ├── Console/              # Artisan commands
│   ├── Exceptions/           # Exception handlers
│   ├── Http/
│   │   ├── Controllers/      # TaskController, Controller
│   │   ├── Middleware/       # HTTP middleware
│   │   └── Kernel.php        # HTTP kernel
│   ├── Models/               # Task, User models
│   └── Providers/            # Service providers
├── bootstrap/
│   ├── app.php               # Application bootstrap
│   └── cache/                # Bootstrap cache
├── config/                   # Configuration files
├── database/
│   ├── migrations/           # Database migrations
│   └── database.sqlite      # SQLite database
├── public/
│   ├── index.php            # Entry point
│   └── .htaccess            # Apache rewrite rules
├── resources/
│   └── views/
│       ├── layouts/         # Blade layout templates
│       └── tasks/           # Task views
├── routes/
│   ├── web.php              # Web routes
│   ├── api.php              # API routes
│   └── console.php          # Console routes
├── storage/                 # Logs, cache, sessions
├── vendor/                  # Composer dependencies
├── .env                     # Environment configuration
├── .gitignore               # Git ignore rules
├── artisan                  # Artisan CLI
├── composer.json             # Composer dependencies
└── README.md                # This file
```

## 🚀 Installation

### Prerequisites

- PHP 8.1 or higher
- Composer
- SQLite extension for PHP

### Setup Steps

1. **Install dependencies:**
```bash
composer install
```

2. **Configure environment:**
The `.env` file should already be configured. If not, copy from `.env.example`:
```bash
cp .env.example .env
php artisan key:generate
```

3. **Create database:**
```bash
touch database/database.sqlite
```

4. **Run migrations:**
```bash
php artisan migrate
```

5. **Start development server:**
```bash
php artisan serve
```

6. **Visit the application:**
Open `http://localhost:8000` in your browser.

## 📊 Database Schema

### Tasks Table

| Column | Type | Description |
|--------|------|-------------|
| `id` | bigint | Primary key (auto-increment) |
| `name` | string(255) | Task name |
| `done` | boolean | Completion status (0 = not done, 1 = done) |
| `created_at` | timestamp | Creation timestamp |
| `updated_at` | timestamp | Last update timestamp |

## 🛣️ Routes

| Method | URI | Action | Description |
|--------|-----|--------|-------------|
| GET | `/` | TaskController@index | Display task list |
| POST | `/tasks` | TaskController@store | Create new task |
| PUT | `/tasks/{task}` | TaskController@update | Update task (toggle done status) |
| DELETE | `/tasks/{task}` | TaskController@destroy | Delete task |

## 🎨 Technologies Used

- **Backend:** Laravel 10.x
- **Frontend:** Blade Templates
- **Database:** SQLite
- **Styling:** Tailwind CSS (via CDN)

## 🔒 SSL/TLS Security

This application is configured with SSL/TLS encryption:

- ✅ **Force HTTPS** - All HTTP requests redirect to HTTPS
- ✅ **Secure Cookies** - Cookies only sent over HTTPS
- ✅ **HSTS Headers** - HTTP Strict Transport Security enabled
- ✅ **Security Headers** - Additional security headers configured
- ✅ **Proxy Support** - Works behind load balancers/reverse proxies

See `SSL_SETUP.md` for detailed SSL/TLS configuration instructions.

## 📝 Notes

- The app uses file-based sessions (configured in `.env`)
- All tasks are stored in SQLite database
- No authentication required - simple task list for demonstration
- The UI includes smooth animations and responsive design
- SSL/TLS encryption is enabled by default

## 🔧 Troubleshooting

If you encounter issues:

1. **Clear caches:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

2. **Check database permissions:**
```bash
chmod 664 database/database.sqlite
```

3. **Ensure storage is writable:**
```bash
chmod -R 775 storage bootstrap/cache
```

## 📄 License

This is a simple demonstration project. Feel free to use and modify as needed.

