# Sistema de Gestión Académica - Paymon

🚀 **Prueba Técnica Desarrollada por Yohangel López**  
*Ingeniero Informático*  
📧 **Contacto:** [yohangel.lopez.yl@gmail.com](mailto:yohangel.lopez.yl@gmail.com)  
🔗 [LinkedIn](https://www.linkedin.com/in/yohangellopez)

---

## 📋 Descripción del Proyecto
Sistema web para la gestión de academias, cursos, matrículas y comunicaciones, desarrollado con **Laravel**, **Livewire**, **Alpine.js** y **Tailwind CSS**. Incluye:
- 🔐 Autenticación dual (Web + API con Sanctum).
- 📊 CRUD completo de academias y cursos.
- 💳 Procesamiento de pagos y matrículas.
- 📨 Envío de comunicados personalizados.

---

## 🛠️ Requisitos Técnicos
- PHP 8.1+
- Composer 2.5+
- Node.js 18+
- MySQL 8.0+

---

## 🚀 Instalación Paso a Paso

### 1. Clonar el Repositorio
```bash
git clone https://github.com/yohangellopez/school_paymon.git
cd school_paymon
```

### 2. Instalar Dependencias
```bash
composer install
npm install
```

### 3. Configurar Entorno
```bash
cp .env.example .env
php artisan key:generate
```

## Editar .env (Configurar base de datos):
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=paymon_db
DB_USERNAME=root
DB_PASSWORD=
```
### 4. Migrar Base de Datos
```bash
php artisan migrate --seed
```
### 5. Compilar Assets
```bash
npm run dev
```
### 6. Iniciar servidor
```bash
php artisan serve
```

👉 **Acceder al sistema:**  
http://localhost:8000  

👉 **Endpoints API principales:**  
- `GET /api/academies`  
- `POST /api/courses`  
- `GET /api/communications`  

---

## 🔐 Credenciales de Prueba  
### Usuario Administrador (Web)  
**Correo:** `admin@paymon.com`  
**Contraseña:** `password`