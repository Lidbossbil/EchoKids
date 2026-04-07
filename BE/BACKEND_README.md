# 🔧 EchoKids Backend - Hướng dẫn Phát triển

## 📋 Mục lục

1. [Giới thiệu](#giới-thiệu)
2. [Yêu cầu Hệ thống](#yêu-cầu-hệ-thống)
3. [Cài đặt & Chạy](#cài-đặt--chạy)
4. [Cấu trúc Dự án](#cấu-trúc-dự-án)
5. [Cơ sở Dữ liệu](#cơ-sở-dữ-liệu)
6. [API Endpoints](#api-endpoints)
7. [Authentication](#authentication)

---

## 🎯 Giới thiệu

**EchoKids Backend** là máy chủ được xây dựng với **Laravel PHP**, cung cấp:
- ✅ RESTful APIs cho tất cả chức năng
- ✅ Xác thực & phân quyền người dùng
- ✅ Quản lý bài học, từ vựng
- ✅ Quản lý bài luyện tập & kết quả
- ✅ Tích hợp AI service
- ✅ Thống kê & giám sát

---

## 💻 Yêu cầu Hệ thống

- **PHP**: v8.0 trở lên
- **Composer**: Latest version
- **MySQL**: v5.7 trở lên hoặc MariaDB
- **Node.js** (Optional): Cho asset compilation

---

## 🚀 Cài đặt & Chạy

### 1. Clone/Download Dự án
```bash
cd BE_EchoKids
```

### 2. Cài đặt Dependencies
```bash
composer install
```

### 3. Copy File Cấu hình
```bash
cp .env.example .env
```

### 4. Tạo App Key
```bash
php artisan key:generate
```

### 5. Cấu hình Database
Chỉnh sửa file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=echokids
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Chạy Migrations
```bash
php artisan migrate
```

### 7. Seed Database (Optional)
```bash
php artisan db:seed
```

### 8. Chạy Development Server
```bash
php artisan serve
```
Server chạy trên: `http://127.0.0.1:8000`

---

## 📁 Cấu trúc Dự án

```
BE_EchoKids/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php              # Xác thực
│   │   │   ├── LessonController.php            # Bài học
│   │   │   ├── VocabularyController.php        # Từ vựng
│   │   │   ├── PracticeController.php          # Luyện tập
│   │   │   ├── UserController.php              # Người dùng
│   │   │   ├── TeacherController.php           # Giáo viên
│   │   │   ├── AdminController.php             # Admin
│   │   │   ├── StatisticsController.php        # Thống kê
│   │   │   ├── AIController.php                # AI
│   │   │   └── Controller.php                  # Base controller
│   │   ├── Middleware/
│   │   │   ├── Authenticate.php
│   │   │   ├── Admin.php
│   │   │   ├── Teacher.php
│   │   │   ├── CORS.php
│   │   │   └── ...
│   │   └── Requests/
│   │       ├── LoginRequest.php
│   │       ├── RegisterRequest.php
│   │       ├── CreateLessonRequest.php
│   │       └── ...
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── Lesson.php
│   │   ├── Vocabulary.php
│   │   ├── Practice.php
│   │   ├── Progress.php
│   │   ├── Teacher.php
│   │   └── ...
│   │
│   ├── Services/
│   │   ├── AuthService.php
│   │   ├── LessonService.php
│   │   ├── PracticeService.php
│   │   ├── AIService.php                     # Gọi AI API
│   │   └── StatisticsService.php
│   │
│   ├── Events/
│   ├── Listeners/
│   ├── Jobs/                                 # Queue jobs
│   ├── Mail/
│   ├── Policies/                             # Authorization
│   ├── Providers/
│   │   └── AppServiceProvider.php
│   └── Exceptions/
│
├── bootstrap/
│   ├── app.php
│   └── providers.php
│
├── config/
│   ├── app.php                              # Cấu hình chung
│   ├── auth.php                             # Xác thực
│   ├── database.php                         # Database
│   ├── mail.php                             # Email
│   ├── queue.php                            # Queue
│   ├── session.php                          # Session
│   ├── cache.php                            # Cache
│   ├── filesystems.php                      # Storage
│   └── logging.php                          # Logging
│
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2024_01_01_000001_create_lessons_table.php
│   │   ├── 2024_01_02_000002_create_vocabularies_table.php
│   │   ├── 2024_01_03_000003_create_practices_table.php
│   │   ├── 2024_01_04_000004_create_progress_table.php
│   │   └── ...
│   │
│   ├── factories/
│   │   ├── UserFactory.php
│   │   ├── LessonFactory.php
│   │   └── ...
│   │
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       ├── LessonSeeder.php
│       └── ...
│
├── public/
│   ├── index.php                            # Entry point
│   ├── robots.txt
│   └── favicon.ico
│
├── resources/
│   ├── views/                               # Blade templates (email)
│   ├── css/
│   ├── js/
│   └── ...
│
├── routes/
│   ├── web.php                              # Web routes
│   ├── api.php                              # API routes
│   └── console.php
│
├── storage/
│   ├── app/
│   │   ├── public/                         # Public uploads
│   │   └── private/
│   ├── framework/
│   ├── logs/
│   └── ...
│
├── tests/
│   ├── Feature/
│   │   ├── AuthTest.php
│   │   ├── LessonTest.php
│   │   └── ...
│   ├── Unit/
│   └── TestCase.php
│
├── .env                                     # Environment variables
├── .env.example                             # Template .env
├── artisan                                  # Laravel CLI
├── composer.json
├── composer.lock
├── phpunit.xml                              # Testing config
└── README.md
```

---

## 🗄️ Cơ sở Dữ liệu

### Entity-Relationship Diagram

```
┌─────────────────┐
│     Users       │
├─────────────────┤
│ id (PK)         │
│ name            │
│ email (UNIQUE)  │
│ password        │
│ role            │◄─────────────┐
│ avatar          │              │
│ created_at      │              │
│ updated_at      │              │
└─────────────────┘              │
        │                         │
        │ 1:N                     │
        │                         │
┌─────────────────┐         ┌──────────────┐
│    Lessons      │         │   Teachers   │
├─────────────────┤         ├──────────────┤
│ id (PK)         │         │ id (PK)      │
│ title           │         │ user_id (FK) │
│ description     │         │ subject      │
│ teacher_id (FK) │────────►│ created_at   │
│ difficulty      │         │ updated_at   │
│ topic           │         └──────────────┘
│ created_at      │
│ updated_at      │
└─────────────────┘
        │
        │ 1:N
        │
┌──────────────────┐
│  Vocabularies    │
├──────────────────┤
│ id (PK)          │
│ lesson_id (FK)   │────────► Lesson
│ word             │
│ image_url        │
│ pronunciation_   │
│   audio_url      │
│ created_at       │
│ updated_at       │
└──────────────────┘

┌────────────────────┐
│    Practices       │
├────────────────────┤
│ id (PK)            │
│ user_id (FK)       │────► User
│ lesson_id (FK)     │────► Lesson
│ audio_file_url     │
│ score (0-100)      │
│ errors (JSON)      │
│ feedback           │
│ practice_date      │
│ created_at         │
│ updated_at         │
└────────────────────┘

┌──────────────────┐
│     Progress     │
├──────────────────┤
│ id (PK)          │
│ user_id (FK)     │────► User
│ lesson_id (FK)   │────► Lesson
│ completed        │
│ total_practices  │
│ average_score    │
│ last_practice_dt │
│ created_at       │
│ updated_at       │
└──────────────────┘
```

### Migrations

#### Users Table
```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->enum('role', ['guest', 'user', 'teacher', 'admin'])->default('user');
    $table->string('avatar')->nullable();
    $table->boolean('is_active')->default(true);
    $table->rememberToken();
    $table->timestamps();
});
```

#### Lessons Table
```php
Schema::create('lessons', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('description');
    $table->foreignId('teacher_id')->constrained('users');
    $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('medium');
    $table->string('topic');
    $table->integer('order')->default(0);
    $table->timestamps();
});
```

#### Vocabularies Table
```php
Schema::create('vocabularies', function (Blueprint $table) {
    $table->id();
    $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete();
    $table->string('word');
    $table->string('image_url')->nullable();
    $table->string('pronunciation_audio_url')->nullable();
    $table->text('meaning')->nullable();
    $table->integer('order')->default(0);
    $table->timestamps();
});
```

#### Practices Table
```php
Schema::create('practices', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete();
    $table->string('audio_file_url');
    $table->integer('score')->nullable();
    $table->json('errors')->nullable();
    $table->text('feedback')->nullable();
    $table->timestamp('practice_date');
    $table->timestamps();
});
```

#### Progress Table
```php
Schema::create('progress', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete();
    $table->boolean('completed')->default(false);
    $table->integer('total_practices')->default(0);
    $table->decimal('average_score', 5, 2)->nullable();
    $table->timestamp('last_practice_date')->nullable();
    $table->unique(['user_id', 'lesson_id']);
    $table->timestamps();
});
```

---

## 🔌 API Endpoints

### Authentication (`/api/auth`)

#### Đăng nhập
```http
POST /api/auth/login
Content-Type: application/json

{
  "email": "user@example.com",
  "password": "password"
}

Response:
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": { ... },
    "token": "Bearer token..."
  }
}
```

#### Đăng ký
```http
POST /api/auth/register
Content-Type: application/json

{
  "name": "John Doe",
  "email": "user@example.com",
  "password": "password",
  "password_confirmation": "password",
  "role": "user"
}

Response:
{
  "success": true,
  "message": "Registration successful",
  "data": { ... }
}
```

#### Lấy User Hiện tại
```http
GET /api/auth/me
Authorization: Bearer {token}

Response:
{
  "success": true,
  "data": { ... }
}
```

#### Đăng xuất
```http
POST /api/auth/logout
Authorization: Bearer {token}

Response:
{
  "success": true,
  "message": "Logged out successfully"
}
```

---

### Lessons (`/api/lessons`)

#### Lấy tất cả bài học
```http
GET /api/lessons?page=1&limit=10&difficulty=easy&topic=animals

Response:
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Animals",
      "description": "...",
      "difficulty": "easy",
      "topic": "animals",
      "teacher": { ... },
      "created_at": "..."
    }
  ],
  "pagination": { ... }
}
```

#### Lấy chi tiết bài học
```http
GET /api/lessons/:id

Response:
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Animals",
    "description": "...",
    "difficulty": "easy",
    "topic": "animals",
    "vocabularies": [
      {
        "id": 1,
        "word": "dog",
        "image_url": "...",
        "pronunciation_audio_url": "..."
      }
    ],
    "teacher": { ... }
  }
}
```

#### Tạo bài học (Teacher)
```http
POST /api/lessons
Authorization: Bearer {token}
Content-Type: application/json

{
  "title": "Animals",
  "description": "Learn animals in English",
  "difficulty": "easy",
  "topic": "animals",
  "vocabularies": [
    {
      "word": "dog",
      "meaning": "An animal",
      "image_url": "...",
      "pronunciation_audio_url": "..."
    }
  ]
}

Response:
{
  "success": true,
  "message": "Lesson created successfully",
  "data": { ... }
}
```

#### Cập nhật bài học (Teacher)
```http
PUT /api/lessons/:id
Authorization: Bearer {token}
Content-Type: application/json

{ ... }

Response:
{
  "success": true,
  "message": "Lesson updated successfully"
}
```

#### Xóa bài học (Teacher/Admin)
```http
DELETE /api/lessons/:id
Authorization: Bearer {token}

Response:
{
  "success": true,
  "message": "Lesson deleted successfully"
}
```

---

### Vocabularies (`/api/vocabularies`)

#### Lấy từ vựng theo bài học
```http
GET /api/lessons/:lessonId/vocabularies

Response:
{
  "success": true,
  "data": [ ... ]
}
```

#### Thêm từ vựng (Teacher)
```http
POST /api/vocabularies
Authorization: Bearer {token}
Content-Type: application/json

{
  "lesson_id": 1,
  "word": "cat",
  "meaning": "A domestic animal",
  "image_url": "...",
  "pronunciation_audio_url": "..."
}

Response:
{
  "success": true,
  "message": "Vocabulary added successfully"
}
```

---

### Practices (`/api/practices`)

#### Nộp bài luyện tập
```http
POST /api/practices
Authorization: Bearer {token}
Content-Type: multipart/form-data

{
  "lesson_id": 1,
  "audio_file": <binary audio file>
}

Response:
{
  "success": true,
  "message": "Practice submitted successfully",
  "data": {
    "id": 1,
    "status": "processing",
    "message": "Your practice is being evaluated by AI"
  }
}
```

#### Lấy kết quả bài luyện tập
```http
GET /api/practices/:id
Authorization: Bearer {token}

Response:
{
  "success": true,
  "data": {
    "id": 1,
    "user_id": 1,
    "lesson_id": 1,
    "score": 85,
    "errors": {
      "pronunciation": [...],
      "stress": [...],
      "intonation": [...]
    },
    "feedback": "Good pronunciation overall...",
    "practice_date": "..."
  }
}
```

#### Lấy lịch sử luyện tập
```http
GET /api/users/:userId/practices?limit=10

Response:
{
  "success": true,
  "data": [ ... ],
  "pagination": { ... }
}
```

---

### Progress (`/api/progress`)

#### Lấy tiến độ người dùng
```http
GET /api/progress
Authorization: Bearer {token}

Response:
{
  "success": true,
  "data": {
    "total_lessons": 10,
    "completed_lessons": 5,
    "average_score": 82.5,
    "lessons": [
      {
        "lesson_id": 1,
        "title": "Animals",
        "completed": true,
        "average_score": 85
      }
    ]
  }
}
```

---

### Statistics (`/api/statistics`)

#### Admin: Lấy thống kê hệ thống (Admin)
```http
GET /api/admin/statistics
Authorization: Bearer {token}

Response:
{
  "success": true,
  "data": {
    "total_users": 150,
    "active_users": 120,
    "total_lessons": 50,
    "total_practices": 2000,
    "average_score": 78.5,
    "daily_stats": [ ... ],
    "topic_stats": [ ... ]
  }
}
```

---

### AI Service (`/api/ai`)

#### Gọi AI chấm điểm
```http
POST /api/ai/evaluate
Authorization: Bearer {token}
Content-Type: multipart/form-data

{
  "practice_id": 1,
  "audio_file": <binary>,
  "reference_audio": "..."
}

Response:
{
  "success": true,
  "data": {
    "score": 85,
    "errors": {
      "pronunciation_errors": [...],
      "stress_errors": [...],
      "intonation_errors": [...]
    },
    "feedback": "..."
  }
}
```

---

## 🔐 Authentication

### JWT Token

Hệ thống sử dụng JWT (JSON Web Tokens) để xác thực.

#### Header yêu cầu
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGc...
```

#### Tạo token
```php
// AuthController.php
$token = auth('api')->attempt([
    'email' => $request->email,
    'password' => $request->password
]);
```

#### Kiểm tra quyền
```php
// Middleware
public function handle($request, Closure $next)
{
    if (!auth('api')->check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    return $next($request);
}
```

---

## 🔍 Model Relationships

### User Model
```php
class User extends Model
{
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'teacher_id');
    }
    
    public function practices()
    {
        return $this->hasMany(Practice::class);
    }
    
    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
}
```

### Lesson Model
```php
class Lesson extends Model
{
    public function teacher()
    {
        return $this->belongsTo(User::class);
    }
    
    public function vocabularies()
    {
        return $this->hasMany(Vocabulary::class);
    }
    
    public function practices()
    {
        return $this->hasMany(Practice::class);
    }
}
```

### Practice Model
```php
class Practice extends Model
{
    protected $casts = [
        'errors' => 'array'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
```

---

## 🚀 Tối ưu hóa

### Eager Loading
```php
// Controller
$lessons = Lesson::with('teacher', 'vocabularies')
    ->paginate(10);
```

### Caching
```php
// Services
$lessons = Cache::remember('lessons', 60, function () {
    return Lesson::all();
});
```

### Query Optimization
```php
// Chỉ lấy field cần thiết
$users = User::select('id', 'name', 'email')->get();
```

---

## 🧪 Testing

### Feature Test
```php
// tests/Feature/AuthTest.php
class AuthTest extends TestCase
{
    public function test_user_can_login()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ]);
        
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token']]);
    }
}
```

### Unit Test
```php
// tests/Unit/PracticeTest.php
class PracticeTest extends TestCase
{
    public function test_practice_score_calculation()
    {
        $practice = Practice::factory()->create(['score' => 85]);
        $this->assertEquals(85, $practice->score);
    }
}
```

---

## 📧 Email Configuration

### .env
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@echokids.com
```

### Sending Email
```php
Mail::to($user->email)->send(new NotificationMail($data));
```

---

## 🎯 Deployment

### Chuẩn bị Production
```bash
# Cache config & routes
php artisan config:cache
php artisan route:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev

# Build frontend assets
npm run build
```

### Deploy
```bash
# SSH vào server
ssh user@server.com

# Pull code
git pull origin main

# Install dependencies
composer install

# Run migrations
php artisan migrate --force

# Restart services
sudo systemctl restart echokids
```

---

## 🔧 Troubleshooting

### Database connection error
```bash
# Kiểm tra .env
php artisan config:cache

# Kiểm tra kết nối
php artisan tinker
> DB::connection()->getPDO()
```

### Permission error
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

### Clear cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## 📚 Tài liệu Tham khảo

- [Laravel Docs](https://laravel.com/docs)
- [Laravel API](https://laravel.com/api)
- [MySQL Docs](https://dev.mysql.com/doc/)

---

## 👥 Đóng góp

Để đóng góp, vui lòng tạo pull request hoặc báo cáo issue.

---

**Cập nhật lần cuối**: 19/03/2026  
**Phiên bản**: 1.0

