# TaskPilot

# ✅ TaskPilot — Simple Laravel Task Management App

**TaskPilot** is a lightweight task management system built using **Laravel** and **SQLite**, offering CRUD operations, advanced filtering with DataTables, and Excel export capabilities. It's designed for developers or teams looking for a basic but extendable task tracking solution.

---

## 🚀 Features

- ✅ Create, view, edit, and delete tasks
- 🔍 Search, sort & paginate tasks using **DataTables** (AJAX)
- 📁 Export tasks to:
  - Excel (`.xlsx`)
  - CSV (`.csv`)
- 💾 Database: **SQLite** (easy setup)

---

## 🛠️ Tech Stack

- **Framework:** Laravel 12
- **Database:** SQLite
- **Exporting:** Laravel Excel (`maatwebsite/excel`)
- **Frontend Enhancements:** DataTables (jQuery-based)

---

## 📦 Installation

```bash
git clone https://github.com/yourusername/taskpilot.git
cd taskpilot

# Install dependencies
composer install

# Create environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Set SQLite DB path in `.env`
touch database/database.sqlite
```
- Edit .env and set:

```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```
---

## 🚀 Run the Application
```bash
php artisan migrate
php artisan db:seed

php artisan serve
```

Visit `http://localhost:8000` in your browser.

---

## License and collaboration
This project is licensed under the [MIT License](./LICENSE).  
Feel free to fork and contribute to this project.
