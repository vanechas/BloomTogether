# 🌷 Bloom Together — Mental Health Journal

> A web-based mental health journal designed to support emotional well-being through daily journaling, mood tracking, and an interactive digital garden.

Bloom Together is a web-based mental health journaling platform developed as a Web Programming final project at **BINUS University**.

The platform combines journaling with an interactive garden system, allowing users to record their daily thoughts and moods while visualizing their journaling progress through a growing digital garden.

---

## ✨ Overview

Mental health is an important aspect of everyday life, especially for teenagers, university students, and young adults who experience academic, social, and career-related pressures.

Bloom Together was developed to make journaling more accessible, engaging, and enjoyable. Instead of simply storing journal entries, the application transforms journaling activity into a visual experience through its **garden system**, where flowers grow based on the user's journaling activity.

The application also provides social interaction through a **friend list**, allowing users to connect with other users and view their friends' gardens.

---

## 🎯 Objectives

Bloom Together was developed to:

- Provide a practical platform for daily journaling
- Help users track and understand their moods
- Encourage consistent journaling through visual progress
- Provide an interactive digital garden experience
- Facilitate social interaction through a friend system
- Provide an accessible and user-friendly mental health journaling experience

---

## 🌱 Main Features

### 🔐 Authentication

Users can create and manage their accounts through:

- Register
- Login
- Logout
- Forgot Password

The application separates public, guest, and authenticated routes using Laravel middleware.

### 📝 Daily Journaling

Users can create journal entries containing:

- Journal date
- Mood
- Journal content

Supported mood options:

- Very Sad
- Sad
- Neutral
- Happy
- Very Happy

Journal entries are validated before being stored in the database. Users can only create entries for the current date or previous dates.

### 😊 Mood Tracking

Each journal entry contains a mood value, allowing users to record their emotional state alongside their daily reflections.

The available mood categories are:

```text
very-sad
sad
neutral
happy
very-happy
```

### 🌷 Interactive Garden

The Garden system visualizes the user's journaling progress.

Flowers are displayed based on the user's journaling activity, turning journal consistency into a visual representation of progress.

Users can also navigate their garden based on dates and view garden progress associated with their journal entries.

### 👥 Friend List

Bloom Together includes a social feature that allows users to:

- Send friend requests
- Accept friend requests
- Decline friend requests
- Cancel sent requests
- View their friends
- View a friend's garden

Friend relationships are managed through the `friendships` database table.

### 👤 Profile

Users can view and update their profile information.

The profile page also provides journal activity statistics, including:

- Total journal entries
- Current streak
- Longest streak

### 🏠 Home Dashboard

The Home page provides an overview of the user's activity and displays their **three most recent journal entries**.

---

## 🛠️ Tech Stack

| Technology | Purpose |
|---|---|
| **Laravel** | Backend framework |
| **PHP 8.2** | Backend programming language |
| **HTML** | Web structure |
| **CSS** | Styling |
| **JavaScript** | Frontend interaction |
| **Bootstrap** | UI framework |
| **Blade** | Laravel templating engine |
| **MySQL** | Database |
| **Vite** | Frontend asset build tool |
| **Docker** | Containerization |
| **Railway** | Deployment & hosting |

The project follows the **Model–View–Controller (MVC)** architecture provided by Laravel.

---

## 🏗️ Architecture

Bloom Together follows Laravel's MVC architecture:

```text
User
 │
 ▼
Routes
 │
 ▼
Controller
 │
 ├── Model ───► MySQL Database
 │
 ▼
Blade View
 │
 ▼
User Interface
```

This structure separates application logic, data management, and presentation, making the project easier to maintain and extend.

---

## 📂 Project Structure

The project follows the standard Laravel structure:

```text
bloom-together/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   │
│   ├── Models/
│   └── Policies/
│
├── database/
│   └── migrations/
│
├── public/
│   ├── css/
│   ├── bootstrap/
│   └── ...
│
├── resources/
│   └── views/
│       ├── layouts/
│       ├── partials/
│       └── ...
│
├── routes/
│   └── web.php
│
├── Dockerfile
├── package.json
├── composer.json
└── vite.config.js
```

### Important Directories

#### `app/Http/Controllers/`

Contains controllers responsible for handling requests and application logic.

Examples:

- `LandingController`
- `HomeController`
- `JournalController`
- `GardenController`
- `ProfileController`
- `FriendController`

#### `app/Models/`

Contains Eloquent models representing the application's database entities.

#### `database/migrations/`

Contains migration files used to define and manage database schemas.

#### `resources/views/`

Contains Blade templates used to render the application's user interface.

#### `public/`

Contains public assets such as CSS, JavaScript, images, and Bootstrap resources.

#### `routes/web.php`

Contains the application's web routes.

---

## 🧭 Routing

Routes are divided into three main groups.

### Public Routes

Accessible without authentication:

```text
/
 /about
```

### Guest Routes

Accessible to users who are not authenticated:

```text
/login
/register
/forgot-password
```

### Authenticated Routes

Accessible only after login:

```text
/home
/journal
/garden
/profile
/friendlist
```

Additional authenticated actions include:

```text
POST   /journal
DELETE /journal/{entry}

PATCH  /profile

POST   /friendlist/request
POST   /friendlist/{friendship}/accept
DELETE /friendlist/{friendship}/decline
DELETE /friendlist/{friendship}/cancel

GET    /friendlist/{friend}/garden
```

Laravel's `auth` and `guest` middleware are used to control access to these routes.

---

## 🗄️ Database

Bloom Together uses **MySQL** as its relational database.

The main database entities are:

```text
users
  │
  ├── journal_entries
  │
  └── friendships
```

### Users

Stores user account and profile information.

Main attributes include:

- `id`
- `first_name`
- `last_name`
- `email`
- `password`
- `date_of_birth`
- `gender`
- `email_verified_at`
- timestamps

Passwords are stored using Laravel's password hashing mechanism.

### Journal Entries

Stores users' daily journal entries.

```text
journal_entries
├── id
├── user_id
├── entry_date
├── mood
├── content
└── timestamps
```

The `mood` field uses predefined values:

```text
very-sad
sad
neutral
happy
very-happy
```

Each journal entry belongs to a user through `user_id`.

### Friendships

Stores relationships and friend requests between users.

```text
friendships
├── id
├── user_id
├── friend_id
├── status
└── timestamps
```

Supported friendship statuses:

```text
pending
accepted
declined
```

The table also enforces a unique combination of `user_id` and `friend_id`.

---

## 🖥️ Views

The application uses Laravel Blade templates.

Main views include:

```text
landing.blade.php
about.blade.php
home.blade.php
journal.blade.php
garden.blade.php
friendlist.blade.php
profile.blade.php
```

The project also uses reusable layouts and partial components to avoid duplicated UI code.

Examples include:

```text
layouts/app.blade.php
partials/
```

Reusable components include elements such as the navbar, garden calendar, and pixel-style visual elements.

---

## 🎨 Styling & Assets

Frontend assets are organized inside the `public/` directory.

```text
public/
├── css/
│   └── app.css
│
└── bootstrap/
```

Blade's `asset()` helper is used to load public assets into the application.

---

## 🐳 Docker

Bloom Together uses Docker for deployment.

The Dockerfile uses a **multi-stage build** consisting of a frontend stage and a backend stage.

### Frontend Stage

```text
Node.js 18
    ↓
npm ci
    ↓
Vite
    ↓
npm run build
    ↓
public/build
```

### Backend Stage

```text
PHP 8.2
    ↓
Composer
    ↓
Laravel
    ↓
PHP Artisan Server
    ↓
Port 8000
```

The Docker configuration installs the required PHP extensions, Composer dependencies, and production frontend assets.

---

## 🚀 Deployment

Bloom Together is deployed using **Railway** with GitHub integration.

The deployment setup consists of:

```text
GitHub Repository
       │
       ▼
    Railway
       │
       ├── Laravel Application
       │
       └── MySQL Service
```

Environment variables required by the application, including database configuration, are managed through Railway's **Variables** settings.

### 🌐 Live Website

The deployed application is available at:

**https://bloomtogether-production.up.railway.app**

---

## 💻 Local Development

### 1. Clone the Repository

```bash
git clone <repository-url>
cd <project-folder>
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
```

### 4. Create Environment File

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Configure MySQL

Update the database configuration in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 7. Run Database Migrations

```bash
php artisan migrate
```

### 8. Build Frontend Assets

For production:

```bash
npm run build
```

For development:

```bash
npm run dev
```

### 9. Start Laravel

```bash
php artisan serve
```

The application will be available at:

```text
http://127.0.0.1:8000
```

---

## 📊 Data Gathering

Before development, the team conducted a data gathering process to understand users' perceptions and expectations toward mental health journaling.

The survey involved **24 respondents**.

The collected responses covered:

- Respondent demographics
- Awareness of mental health journals
- Perceptions of journaling
- Previous journaling habits
- Preferred journaling formats
- Expected benefits
- Important features
- Main obstacles to journaling
- Suggestions for digital mental health journals

The results indicated that respondents generally viewed mental health journaling positively, while privacy, simplicity, ease of use, and engaging features were important considerations.

These findings were used as a basis for designing the Bloom Together features.

---

## 🎓 Academic Project

This project was developed as a final project for the **Web Programming** course at:

**BINUS University**  
Computer Science  
Odd Semester 2025

### Team — Kelompok 5

- Amanda Sugito
- Asyifa Izzatil Isma
- Vanessa Santoso

**Lecturer:**  
Rani Puspita, S.Kom., M.Kom

---

## 📌 Project Scope

Bloom Together focuses on providing a journaling platform with:

- Daily journaling
- Mood tracking
- Interactive garden visualization
- Friend management
- Friend garden viewing
- Profile management
- Authentication
- Journal activity statistics

The project is intended as a web-based academic project and does not replace professional mental health services.

---

## 🔮 Future Development

Potential improvements identified in the project documentation include strengthening data privacy and security and expanding the application's capabilities in future development.

---

## 🌷 Bloom Together

**Write your feelings.**  
**Track your mood.**  
**Watch your garden grow.**
