# Backend Gachala

Backend API para el sistema de gestión de Gachala, desarrollado con Laravel 8.

## Requisitos Previos

- PHP >= 7.3
- Composer
- MySQL >= 8.0
- Node.js y NPM (para desarrollo)

## Instalación

1. Clonar el repositorio:
```bash
git clone [URL_DEL_REPOSITORIO]
cd backend-gachala
```

2. Instalar dependencias:
```bash
composer install
```

3. Configurar el archivo .env:
```bash
cp .env.example .env
```

4. Configurar las variables de entorno en el archivo .env:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gachala_db
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

5. Generar la clave de la aplicación:
```bash
php artisan key:generate
```

6. Ejecutar las migraciones:
```bash
php artisan migrate
```

7. (Opcional) Ejecutar los seeders:
```bash
php artisan db:seed
```

## Estructura del Proyecto

```
backend-gachala/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # Controladores de la API
│   │   └── Middleware/     # Middleware de autenticación y validación
│   │   
│   ├── Models/             # Modelos de la base de datos
│   └── Services/           # Servicios de negocio
├── config/                 # Archivos de configuración
├── database/
│   ├── migrations/         # Migraciones de la base de datos
│   └── seeders/           # Seeders para datos de prueba
├── routes/
│   └── api.php            # Definición de rutas de la API
└── tests/                 # Pruebas automatizadas
```

## API Endpoints

### Autenticación
- `POST /api/auth/login` - Iniciar sesión
- `POST /api/auth/logout` - Cerrar sesión
- `POST /api/auth/refresh` - Refrescar token

### Usuarios
- `GET /api/users` - Listar usuarios
- `POST /api/users` - Crear usuario
- `GET /api/users/{id}` - Obtener usuario
- `PUT /api/users/{id}` - Actualizar usuario
- `DELETE /api/users/{id}` - Eliminar usuario

### Beneficiarios
- `GET /api/beneficiaries` - Listar beneficiarios
- `POST /api/beneficiaries` - Crear beneficiario
- `GET /api/beneficiaries/{id}` - Obtener beneficiario
- `PUT /api/beneficiaries/{id}` - Actualizar beneficiario
- `DELETE /api/beneficiaries/{id}` - Eliminar beneficiario

### Programas
- `GET /api/programs` - Listar programas
- `POST /api/programs` - Crear programa
- `GET /api/programs/{id}` - Obtener programa
- `PUT /api/programs/{id}` - Actualizar programa
- `DELETE /api/programs/{id}` - Eliminar programa

## Desarrollo

1. Iniciar el servidor de desarrollo:
```bash
php artisan serve
```

2. Ejecutar las pruebas:
```bash
php artisan test
```

## Despliegue

### Despliegue en Render

1. Crear una cuenta en [Render](https://render.com)
2. Conectar el repositorio de GitHub
3. Crear un nuevo Web Service
4. Configurar las variables de entorno en Render:
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://tu-app.onrender.com
   DB_CONNECTION=mysql
   DB_HOST=tu-host
   DB_PORT=3306
   DB_DATABASE=tu-database
   DB_USERNAME=tu-usuario
   DB_PASSWORD=tu-contraseña
   ```

## Funcionalidades Principales

### Gestión de Usuarios
- Registro y autenticación de usuarios
- Roles y permisos
- Gestión de perfiles

### Gestión de Beneficiarios
- Registro de beneficiarios
- Asignación a programas
- Seguimiento de beneficios

### Gestión de Programas
- Creación y administración de programas
- Asignación de beneficiarios
- Control de recursos

## Seguridad

- Autenticación mediante JWT
- Validación de datos
- Protección CSRF
- Sanitización de inputs

## Contribución

1. Fork el proyecto
2. Crear una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

## Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.
