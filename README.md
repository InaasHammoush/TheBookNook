# 📚 TheBookNook - Book Lovers' Forum

**TheBookNook** is a Laravel-based community forum tailored for book enthusiasts. Users can register, participate in discussions, and interact with each other around their favorite books. It allows users to create threads, post comments, bookmark content, and interact with genres (categories). Admin users can manage all users, promote/demote user roles, and moderate content. Email verification is enforced, and the application includes a clean dashboard experience for both users and admins.

---

## 🚀 Features

- User authentication (login, registration, password reset)
- Email verification upon registration
- Role-based access control (admin/user)
- Admin dashboard with user management:
  - Promote/demote users
  - Delete users
  - Search and filter users
- Thread creation, editing, and deletion
- Commenting system with editing/deletion
- Bookmarking threads
- Search threads by keywords
- Genre-based categorization
- **Book association with threads**: While creating a thread, users can choose a relevant book from a searchable list powered by the **Google Books API**. Selected book details (title, author, and cover image) are displayed in the thread.

---

## ⚙️ Used Technologies:
- Laravel 
- Google Books API
- MySQL
- Aiven

---

## 🛠️ Project Setup Instructions

 Assumptions:
 - PHP ≥ 8.1
 - Composer installed
 - Node.js + npm installed
 - MySQL or other DB is available

If you don't have them installed, check the following links for instructions:
 
 **PHP and composer:**
 https://laravel.com/docs/12.x/installation

 **Node.js and npm:**
 https://docs.npmjs.com/downloading-and-installing-node-js-and-npm


Follow these steps to set up and run the Laravel project locally:

### 1. Clone the Repository
```bash
git clone https://github.com/InaasHammoush/TheBookNook.git
cd your-laravel-project
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Copy Environment File
```bash
cp .env.example .env
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Migrations
```bash
php artisan migrate
```
### 6. Install Node Dependencies
```bash
npm install
```

### 7. Build Frontend Assets
```bash
npm run dev
```

### 8. Serve the Application
```bash
php artisan serve
```
Visit: `http://127.0.0.1:8000`

---

## 📧 Email Verification Setup
To enable email verification, configure your `.env` mail settings. Example with Gmail:
```env
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email_username
MAIL_PASSWORD=your_email_password
MAIL_FROM_ADDRESS="no-reply@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---


Enjoy using and contributing to the forum app!

