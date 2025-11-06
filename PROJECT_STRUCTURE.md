# Project Structure Documentation

## Overview

This Laravel Task List application follows standard Laravel conventions and best practices.

## Directory Structure

### `/app` - Application Core

**`/app/Http/Controllers`**
- `Controller.php` - Base controller class
- `TaskController.php` - Handles all task-related operations (CRUD)

**`/app/Models`**
- `Task.php` - Task model with fillable fields and casts
- `User.php` - User model (for future authentication)

**`/app/Http/Middleware`**
- Authentication, CSRF protection, cookie encryption, etc.

**`/app/Providers`**
- `AppServiceProvider.php` - Application service provider
- `RouteServiceProvider.php` - Route service provider

### `/config` - Configuration Files

All Laravel configuration files:
- `app.php` - Application configuration
- `database.php` - Database configuration (SQLite)
- `session.php` - Session configuration (file-based)
- `view.php` - View configuration
- `cache.php`, `logging.php`, `mail.php`, etc.

### `/database` - Database

**`/database/migrations`**
- `2024_01_01_000001_create_tasks_table.php` - Creates tasks table
- `2025_11_05_102631_create_sessions_table.php` - Sessions table (not used, file sessions)

**`/database/database.sqlite`** - SQLite database file

### `/resources/views` - Blade Templates

**`/resources/views/layouts`**
- `app.blade.php` - Main layout with styles and structure

**`/resources/views/tasks`**
- `index.blade.php` - Task list view

### `/routes` - Route Definitions

- `web.php` - Web routes (all task routes)
- `api.php` - API routes (empty, for future use)
- `console.php` - Console commands

### `/public` - Public Assets

- `index.php` - Application entry point
- `.htaccess` - Apache rewrite rules

### `/storage` - Storage

- `/storage/framework/cache` - Compiled views cache
- `/storage/framework/sessions` - Session files
- `/storage/logs` - Application logs

## File Organization Principles

1. **Separation of Concerns**
   - Controllers handle HTTP requests
   - Models handle data logic
   - Views handle presentation

2. **Laravel Conventions**
   - Follows Laravel naming conventions
   - Uses Eloquent ORM for database operations
   - Implements RESTful routing

3. **Clean Code**
   - Clear method names
   - Proper validation
   - Consistent formatting

## Key Files

### TaskController.php
Contains four main methods:
- `index()` - Display all tasks
- `store()` - Create new task
- `update()` - Toggle task completion
- `destroy()` - Delete task

### Task.php Model
- Defines fillable fields: `name`, `done`
- Casts `done` to boolean

### Routes
All routes use resourceful naming:
- `tasks.index`, `tasks.store`, `tasks.update`, `tasks.destroy`

## Best Practices Implemented

✅ MVC architecture
✅ RESTful routing
✅ Form validation
✅ CSRF protection
✅ Eloquent ORM
✅ Blade templating
✅ Proper error handling
✅ Clean code structure

