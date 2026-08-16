🌐 **Language:** **English** | [Versión en Español](README.md) 

🐾 Veterinary Management SystemA web application for comprehensive veterinary clinic management. It allows users to manage medical appointments, customer and pet profiles, a product catalog with an interactive shopping cart, and a fully functional contact form.

🚀 Key Features
👤 User Management (CRUD): Account registration, traditional login, social authentication (Google & Facebook), and profile updates.

🐶 Pet Management (CRUD): Add, edit, view, and delete pets associated with each customer.

📅 Appointment Scheduling (CRUD): Book, reschedule, view, and cancel veterinary appointments.

🛒 Product Catalog & Shopping Cart: Filterable stock browser by categories (food, beds, toys, carriers, etc.), interactive shopping cart, and purchase history.

📩 Direct Contact Form: Functional Web3Forms integration delivering user messages directly to Gmail.

⚡ High Performance & Accessibility: Code optimized according to Google PageSpeed standards (Core Web Vitals, semantic HTML5, and ARIA accessibility standards).

🛠️ Tech Stack

- Backend

PHP / Laravel: Core framework for business logic and routing.

Livewire: Server-driven reactive components for dynamic interfaces.

- Frontend

Alpine.js (^3.14.9): Lightweight reactivity for client-side interactions.

Tailwind CSS (^3.1.0): Utility-first CSS framework.

Flatpickr (^4.6.13): Dynamic date picker for appointment booking.

Sass (^1.87.0): CSS preprocessor for custom styling.

Axios (^1.6.4): HTTP client for asynchronous requests.

- Build Tools

Vite (^5.4.19): Ultra-fast module bundler with official Livewire plugin.

- Database

PostgreSQL: Cloud-hosted with Neon Serverless Postgres.

- Deployment

Render: Hosting platform for the web application.

📋 PrerequisitesPHP >= 8.2ComposerNode.js (v18 or higher) & NPMA Neon DB account (PostgreSQL)

## ⚡ PageSpeed Benchmarks & Web Vitals Audit

This project was optimized to meet the web quality standards required by **Google PageSpeed Insights**.

| Metric | Result | Status |
| :--- | :---: | :---: |
| **Performance (Desktop)** | **100%** | 🟢 Perfect |
| **Accessibility (a11y)** | **100%** | 🟢 Perfect |
| **Best Practices** | **100%** | 🟢 Perfect |
| **SEO** | **100%** | 🟢 Perfect |
| **Agentic Navigation (AI Compatibility)** | **2 / 2** | 🟢 Full WCAG |

> 🔗 **[View Official Audit & Live Report on Google PageSpeed Insights](https://pagespeed.web.dev/analysis/https-veterinaria-laravel-onrender-com/9300m6lhxc?form_factor=desktop)**

### 📷 Captura de Auditoría (PageSpeed)

[![PageSpeed Audit Score](./public/readMeImagenes/pagespeed-report-values.png)](https://pagespeed.web.dev/analysis/https-veterinaria-laravel-onrender-com/9300m6lhxc?form_factor=desktop)

[![PageSpeed Audit Score](./public/readMeImagenes/pagespeed-report-metrics.png)](https://pagespeed.web.dev/analysis/https-veterinaria-laravel-onrender-com/9300m6lhxc?form_factor=desktop)

🌍 Deployment (Production)
Deployment Database: Hosted on Neon, leveraging SSL connections and automatic PostgreSQL 

scaling.Web Application: Hosted on Render, configured to execute asset building on deploy (npm run build) along with route and configuration caching (php artisan config:cache & php artisan route:cache).

⚙️ Local SetupClone the repository:Bashgit clone https://github.com/your-username/your-repo.git
cd your-repo
Install PHP and JavaScript dependencies:Bashcomposer install
npm install
Configure environment variables:Copy the example environment file and set your database/service credentials:Bashcp .env.example .env
Generate application key:Bashphp artisan key:generate
Run database migrations:Bashphp artisan migrate
Compile assets and start the local development server:Bash# In terminal 1:
npm run dev

# In terminal 2:
php artisan serve
🔑 Environment Variables (.env)Make sure to include the following keys in your .env file:Fragmento de códigoAPP_NAME="VeterinaryClinic"
APP_ENV=local
APP_URL=http://localhost:8000

# PostgreSQL database connection on Neon
DB_CONNECTION=pgsql
DB_HOST=your-neon-host.neon.tech
DB_PORT=5432
DB_DATABASE=your_database
DB_USERNAME=your_neon_user
DB_PASSWORD=your_neon_password

# Web3Forms API Key for the contact form
WEB3FORMS_ACCESS_KEY=your-access-key

# OAuth Credentials (Optional)
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
FACEBOOK_CLIENT_ID=your-facebook-client-id
FACEBOOK_CLIENT_SECRET=your-facebook-client-secret