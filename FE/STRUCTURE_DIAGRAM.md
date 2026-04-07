# 📁 Sơ đồ Cấu trúc Thư mục - FE_EchoKids

```
FE_EchoKids/
│
├── 📄 index.html                    # Trang chính
├── 📄 indexx.html                   # File trang (có thể là bản sao)
├── 📄 package.json                  # Cấu hình npm, dependencies
├── 📄 README.md                     # Tài liệu hướng dẫn
├── 📄 vite.config.js                # Cấu hình Vite build tool
│
├── 📁 public/                        # Thư mục tài nguyên tĩnh
│   ├── 📄 vite.svg                  # Logo Vite
│   │
│   ├── 📁 Admin/                    # Module Admin Dashboard
│   │   ├── 📁 app/                  # Trang ứng dụng Admin
│   │   │   ├── 📄 email-compose.html    # Trang soạn email
│   │   │   ├── 📄 index-email.html      # Trang danh sách email
│   │   │   └── 📄 index.html            # Trang chính Admin
│   │   │
│   │   ├── 📁 css/                  # Stylesheet Admin
│   │   │   ├── 📄 ajax-loader.gif
│   │   │   ├── 📄 animate.css
│   │   │   ├── 📄 bootstrap.min.css
│   │   │   ├── 📄 calender.css
│   │   │   ├── 📄 Chart.min.css
│   │   │   ├── 📄 developer.css
│   │   │   ├── 📄 dripicons.css
│   │   │   ├── 📄 Ecommerce.css
│   │   │   ├── 📄 EcommerceResponsive.css
│   │   │   ├── 📄 floatingbutton.css
│   │   │   ├── 📄 fontawesome.css
│   │   │   ├── 📄 ionicons.min.css
│   │   │   ├── 📄 line-awesome.min.css
│   │   │   ├── 📄 magnific-popup.css
│   │   │   ├── 📄 owl.carousel.min.css
│   │   │   ├── 📄 remixicon.css
│   │   │   ├── 📄 responsive.css
│   │   │   ├── 📄 select2.min.css
│   │   │   ├── 📄 slick-theme.css
│   │   │   ├── 📄 slick.css
│   │   │   ├── 📄 spacer.css
│   │   │   ├── 📄 style.css
│   │   │   ├── 📄 swiper-bundle.min.css
│   │   │   ├── 📄 table.css
│   │   │   ├── 📄 typography-dark.css
│   │   │   ├── 📄 typography-rtl.css
│   │   │   ├── 📄 typography.css
│   │   │   └── 📄 variable.css
│   │   │
│   │   ├── 📁 fonts/                # Font files cho Admin
│   │   │   ├── 🔤 Icon Font Files (Dripicons, FontAwesome, etc.)
│   │   │   ├── 🔤 Line Awesome
│   │   │   ├── 🔤 Remix Icon
│   │   │   └── 🔤 Ionicons
│   │   │
│   │   ├── 📁 fullcalendar/         # Thư viện lịch FullCalendar
│   │   │
│   │   └── 📁 images/               # Hình ảnh Admin
│   │       └── [Các file ảnh]
│   │
│   └── 📁 Client/                   # Module Client (Người dùng)
│       ├── 📁 css/                  # Stylesheet Client
│       │   └── [Các file CSS]
│       │
│       ├── 📁 images/               # Hình ảnh Client
│       │   └── [Các file ảnh]
│       │
│       ├── 📁 js/                   # JavaScript Client
│       │   └── [Các file JS]
│       │
│       └── 📁 lib/                  # Các thư viện hỗ trợ
│           └── [Các file thư viện]
│
└── 📁 src/                          # Mã nguồn Vue.js
    ├── 📄 App.vue                   # Component chính
    ├── 📄 main.js                   # Entry point Vue.js
    ├── 📄 style.css                 # Stylesheet global
    │
    ├── 📁 assets/                   # Tài nguyên dự án
    │   ├── 📄 css_js_template.txt   # Template CSS/JS
    │   └── 📁 scss/                 # SCSS stylesheets
    │       └── [Các file SCSS]
    │
    ├── 📁 components/               # Vue components
    │   ├── 📄 list_page.txt         # Template trang danh sách
    │   ├── 📁 Admin/                # Components cho Admin
    │   │   └── [Các component Admin]
    │   │
    │   └── 📁 Client/               # Components cho Client
    │       └── [Các component Client]
    │
    ├── 📁 layout/                   # Layout components
    │   ├── 📁 components/           # Component layout
    │   │   └── [Các component layout]
    │   │
    │   └── 📁 wrapper/              # Wrapper layout
    │       └── [Các wrapper]
    │
    └── 📁 router/                   # Vue Router
        ├── 📄 checkAdmin.js         # Middleware kiểm tra Admin
        ├── 📄 checkClient.js        # Middleware kiểm tra Client
        └── 📄 index.js              # Cấu hình routing chính
```

---

## 📊 Phân tích cấu trúc

### **Khu vực Chính:**

| Thư mục | Mục đích |
|---------|---------|
| **root/** | Cấu hình dự án (vite, npm, html) |
| **public/** | Tài nguyên tĩnh (HTML, CSS, JS template) |
| **src/** | Mã nguồn Vue.js (Components, Router) |

### **Module Admin & Client:**

- **Admin/**: Dashboard quản lý
  - `app/`: Các trang HTML
  - `css/`: Styling (Bootstrap, FontAwesome, etc.)
  - `fonts/`: Icon fonts
  - `images/`: Hình ảnh giao diện
  - `fullcalendar/`: Thư viện lịch

- **Client/**: Giao diện người dùng
  - `css/`, `images/`, `js/`, `lib/`

### **Vue.js Source (src/):**

- **Components/**: Các component Vue (Admin & Client)
- **Layout/**: Cấu trúc layout trang
- **Router/**: Định tuyến với middleware xác thực
- **Assets/**: Tài nguyên SCSS, template

---

## 🔧 Công nghệ sử dụng:

- **Build Tool**: Vite
- **Framework**: Vue.js
- **UI Framework**: Bootstrap
- **Icons**: FontAwesome, Ionicons, Line Awesome, Remix Icon, Dripicons
- **Charts**: Chart.js
- **Calendar**: FullCalendar
- **Carousel**: Owl Carousel, Swiper

---

## 📝 Ghi chú:

- File `indexx.html` có thể là bản sao hoặc file tạm, cần kiểm tra
- Tách biệt rõ ràng giữa Admin (quản lý) và Client (người dùng)
- Sử dụng Route middleware để bảo vệ các trang theo quyền hạn

