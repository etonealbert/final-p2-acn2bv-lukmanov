# 🔦 Stranger Things - Catálogo de Personajes

Sistema web de gestión de personajes de la serie Stranger Things, desarrollado con PHP, MySQL, JavaScript y AJAX.

---

## 📋 Datos del Proyecto

### **1. Datos del estudiante**

* **Nombre:** Albert Lukmanov
* **ID académico:** 2734049210
* **Email:** albert.lukmanov@davinci.edu.ar

### **2. Datos de cursada**

* **Materia:** Programación Web II
* **Comisión:** ACN2BV
* **Profesor:** Sergio Daniel Medina
* **Modalidad:** Noche "BV" – Segundo cuatrimestre

### **3. Repositorio del Proyecto**

* **URL:** https://github.com/usuario/final-p2-acn2bv-lukmanov

---

## 📝 Descripción del Proyecto

Este proyecto es una aplicación web completa que permite gestionar un catálogo de personajes de la serie Stranger Things. Los usuarios pueden:

- ✅ Ver listado completo de personajes
- ✅ Buscar personajes por nombre
- ✅ Filtrar personajes por rol (Niños, Adolescentes, Adultos, Villanos)
- ✅ Agregar nuevos personajes
- ✅ Editar personajes existentes
- ✅ Eliminar personajes
- ✅ Navegar con paginación
- ✅ Cambiar entre tema claro y oscuro

---

## 🚀 Tecnologías Utilizadas

- **Backend:** PHP 7.4+
- **Base de Datos:** MySQL 5.7+
- **Frontend:** HTML5, CSS3, JavaScript (ES6+)
- **AJAX:** Fetch API
- **Biblioteca Externa:** SweetAlert2 (notificaciones)
- **Arquitectura:** REST API con JSON

---

## 📦 Estructura de Archivos

```
final-p2-acn2bv-lukmanov/
├── index.php          # Página principal
├── api.php            # API REST con endpoints CRUD
├── conexion.php       # Conexión a base de datos
├── scripts.js         # Lógica JavaScript y AJAX
├── style.css          # Estilos CSS responsive
├── database.sql       # Script SQL de instalación
└── README.md          # Documentación
```

---

## 💾 Instalación y Configuración

### **Requisitos Previos**

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx) o XAMPP/WAMP
- Navegador web moderno

### **Paso 1: Clonar o descargar el repositorio**

```bash
git clone https://github.com/usuario/final-p2-acn2bv-lukmanov.git
cd final-p2-acn2bv-lukmanov
```

### **Paso 2: Configurar la base de datos**

1. Iniciar el servidor MySQL
2. Abrir phpMyAdmin o cliente MySQL
3. Ejecutar el archivo `database.sql`:

```bash
mysql -u root -p < database.sql
```

O desde phpMyAdmin:
- Ir a la pestaña "SQL"
- Copiar y pegar el contenido de `database.sql`
- Hacer clic en "Continuar"

### **Paso 3: Configurar la conexión a la base de datos**

Editar el archivo `conexion.php` si es necesario:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'stranger_things_db');
```

### **Paso 4: Iniciar el servidor**

**Con XAMPP/WAMP:**
- Copiar el proyecto a la carpeta `htdocs` (XAMPP) o `www` (WAMP)
- Iniciar Apache y MySQL
- Abrir en navegador: `http://localhost/final-p2-acn2bv-lukmanov/`

**Con PHP incorporado:**
```bash
php -S localhost:8000
```
Abrir en navegador: `http://localhost:8000/`

---

## 🎮 Uso de la Aplicación

### **Listado de Personajes**

Al cargar la página, se muestran automáticamente todos los personajes almacenados en la base de datos.

### **Búsqueda y Filtros**

- **Búsqueda:** Escribir en el campo de búsqueda para filtrar por nombre
- **Filtro por rol:** Seleccionar un rol del desplegable (Niños, Adolescentes, Adultos, Villanos, Todos)

### **Agregar Personaje**

1. Hacer clic en el botón "➕ Agregar Personaje"
2. Completar el formulario:
   - Nombre (obligatorio)
   - Rol (obligatorio)
   - Temporada (1-5, obligatorio)
   - Descripción (obligatorio)
   - URL de imagen (opcional)
3. Hacer clic en "Guardar"

### **Editar Personaje**

1. Hacer clic en el botón "✏️ Editar" de la tarjeta del personaje
2. Modificar los campos deseados
3. Hacer clic en "Guardar"

### **Eliminar Personaje**

1. Hacer clic en el botón "🗑️ Eliminar" de la tarjeta del personaje
2. Confirmar la eliminación en el diálogo

### **Paginación**

- Usar los botones "⬅️ Anterior" y "Siguiente ➡️" para navegar entre páginas
- Se muestran 5 personajes por página

### **Cambiar Tema**

- Hacer clic en el botón "☀️ Claro" o "🌙 Oscuro" en la barra superior
- El tema seleccionado se guarda en la sesión

---

## 🎨 Características Implementadas

### **Funcionalidades Obligatorias**

✅ Base de datos MySQL con tabla de personajes  
✅ Al menos 12 registros iniciales  
✅ Listado dinámico de personajes  
✅ Búsqueda por nombre  
✅ Filtro por categoría/rol  
✅ Formulario de agregar con validaciones  
✅ API REST que retorna JSON  
✅ Carga de datos con AJAX (sin recargar página)  
✅ Selector de temas (claro/oscuro)  
✅ Validación frontend (HTML5)  
✅ Validación backend (PHP)  

### **Funcionalidades Extra (para nota 10)**

✅ **Persistencia total en MySQL** - Todas las operaciones se guardan en la base de datos  
✅ **CRUD completo con AJAX** - Crear, leer, actualizar y eliminar sin recargar  
✅ **Paginación** - 5 personajes por página con navegación  
✅ **Diseño responsive** - Funciona en móviles, tablets y escritorio  
✅ **SweetAlert2** - Notificaciones elegantes para acciones y errores  
✅ **Sesiones PHP** - El tema seleccionado persiste entre visitas  
✅ **Commits convencionales** - Historial de Git organizado  

---

## 🔧 API Endpoints

### **GET /api.php?accion=listar**
Lista personajes con filtros y paginación
```
Parámetros:
- busqueda: string (opcional)
- rol: string (opcional)
- pagina: int (default: 1)
- por_pagina: int (default: 5)
```

### **GET /api.php?accion=obtener&id={id}**
Obtiene un personaje específico

### **POST /api.php**
Crear o actualizar personaje
```
Parámetros:
- accion: "crear" | "actualizar"
- nombre: string (requerido)
- rol: string (requerido)
- temporada: int (requerido)
- descripcion: string (requerido)
- imagen_url: string (opcional)
- id: int (requerido para actualizar)
```

### **POST /api.php**
Eliminar personaje
```
Parámetros:
- accion: "eliminar"
- id: int (requerido)
```

---

## 🎓 Validaciones Implementadas

### **Frontend (HTML5)**
- Campos obligatorios: `required`
- Longitud mínima: `minlength`
- Longitud máxima: `maxlength`
- Rango de temporada: `min="1" max="5"`
- Formato URL: `type="url"`

### **Backend (PHP)**
- Verificación de campos vacíos con `empty()`
- Limpieza de datos con `trim()`
- Escape de caracteres especiales con `real_escape_string()`
- Validación de rangos numéricos
- Mensajes de error descriptivos en español

---

## 🎨 Temas Visuales

### **Tema Oscuro (default)**
- Fondo negro con acentos rojos
- Estilo inspirado en Stranger Things
- Alto contraste para mejor legibilidad

### **Tema Claro**
- Fondo blanco con elementos grises
- Diseño limpio y minimalista
- Mismo esquema de colores primarios

---

## 📱 Diseño Responsive

- **Desktop (>768px):** Layout de tarjetas en grid de 3-4 columnas
- **Tablet (768px):** Layout de 2 columnas
- **Mobile (<768px):** Layout de 1 columna
- Menús y controles adaptados a pantallas táctiles

---

## 🐛 Solución de Problemas

### **Error de conexión a la base de datos**
- Verificar que MySQL esté corriendo
- Revisar credenciales en `conexion.php`
- Confirmar que la base de datos `stranger_things_db` existe

### **No se muestran los personajes**
- Abrir consola del navegador (F12) y revisar errores
- Verificar que el archivo `database.sql` se ejecutó correctamente
- Revisar permisos del usuario de MySQL

### **El tema no se guarda**
- Verificar que las sesiones PHP estén habilitadas
- Comprobar permisos de escritura en el directorio de sesiones

---

## 📄 Licencia

Este proyecto es un trabajo académico para el curso de Programación Web II.

---

## 👨‍💻 Autor

**Albert Lukmanov**  
📧 albert.lukmanov@davinci.edu.ar  
🎓 Comisión ACN2BV - Programación Web II  
👨‍🏫 Prof. Sergio Daniel Medina

---

**Fecha de entrega:** Diciembre 2024

