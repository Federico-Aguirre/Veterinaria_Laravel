🌐 **Idioma:** **Español** | [English Version](README.en.md)

🐾 Sistema de Gestión Veterinaria
Aplicación web para la gestión integral de clínicas veterinarias. Permite el control de turnos médicos, administración de perfiles de clientes y mascotas, un catálogo de productos con carrito de compras y un formulario de contacto funcional.

🚀 Características Principales
👤 Gestión de Usuarios (CRUD): Registro e inicio de sesión tradicional y autenticación social (Google y Facebook), actualización de perfil de usuario.

🐶 Gestión de Mascotas (CRUD): Alta, edición, consulta y baja de las mascotas asociadas a cada cliente.

📅 Agendamiento de Turnos (CRUD): Solicitud, reprogramación, visualización y cancelación de turnos para atención veterinaria.

🛒 Catálogo de Productos y Carrito: Explorador de stock filtrable por categorías (alimentos, camas, juguetes, transportadoras, etc.), carrito de compras interactivo e historial de compras realizadas.

📩 Formulario de Contacto Directo: Integración funcional mediante Web3Forms con recepción de correos en Gmail.

⚡ Alto Rendimiento y Accesibilidad: Código optimizado según los estándares de Google PageSpeed (métricas Web Vitals, HTML5 semántico y estándares ARIA).

🛠️ Tecnologías Utilizadas

- Backend

PHP / Laravel: Framework principal para la lógica de negocio y enrutamiento.

Livewire: Componentes reactivos en el servidor para interfaces dinámicas.

- Frontend

Alpine.js (^3.14.9): Reactividad liviana para interacciones del cliente.

Tailwind CSS (^3.1.0): Framework de CSS orientado a utilidades.

Flatpickr (^4.6.13): Selector dinámico de fechas para la reserva de turnos.

Sass (^1.87.0): Preprocesador CSS para estilos personalizados.

Axios (^1.6.4): Cliente HTTP para solicitudes asíncronas.

- Herramientas de Build

Vite (^5.4.19): Empaquetador de módulos ultrarrápido con plugin oficial para Livewire.

- Base de Datos

PostgreSQL: Hospedada en la nube con Neon Serverless Postgres.

- Despliegue

Render: Plataforma de alojamiento para la aplicación web.

📋 Requisitos Previos
PHP >= 8.2

Composer

Node.js (v18 o superior) & NPM

🌍 Despliegue (Producción)
Base de Datos: Alojada en Neon DB (PostgreSQL), aprovechando la conexión segura por SSL y escalado automático de PostgreSQL.

Aplicación Web: Alojada en Render, configurada para ejecutar la compilación de assets en el deploy con npm run build y la caché de rutas/vistas mediante php artisan config:cache y php artisan route:cache.

⚙️ Instalación Local
Clonar el repositorio:

Bash
git clone https://github.com/tu-usuario/tu-repositorio.git
cd tu-repositorio
Instalar dependencias de PHP y JavaScript:

Bash
composer install
npm install
Configurar las variables de entorno:
Copia el archivo de ejemplo y ajusta tus credenciales de base de datos y servicios:

Bash
cp .env.example .env
Generar la clave de la aplicación:

Bash
php artisan key:generate
Ejecutar migraciones de la base de datos:

Bash
php artisan migrate
Compilar assets e iniciar el servidor de desarrollo:

Bash
# En una terminal:
npm run dev

# En otra terminal:
php artisan serve
🔑 Variables de Entorno (.env)
Asegúrate de incluir las siguientes variables clave en tu archivo .env:

Fragmento de código
APP_NAME="Veterinaria"
APP_ENV=local
APP_URL=http://localhost:8000

# Conexión a la base de datos PostgreSQL en Neon
DB_CONNECTION=pgsql
DB_HOST=tu-host-neon.neon.tech
DB_PORT=5432
DB_DATABASE=nombre_bd
DB_USERNAME=usuario_neon
DB_PASSWORD=password_neon

# Clave de Web3Forms para formulario de contacto
WEB3FORMS_ACCESS_KEY=tu-access-key

# Credenciales OAuth (Opcional)
GOOGLE_CLIENT_ID=tu-google-client-id
GOOGLE_CLIENT_SECRET=tu-google-client-secret
FACEBOOK_CLIENT_ID=tu-facebook-client-id
FACEBOOK_CLIENT_SECRET=tu-facebook-client-secret