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

## 📄 Licencia

Este proyecto es un trabajo académico para el curso de Programación Web II.

---

## 👨‍💻 Autor

**Albert Lukmanov**  
📧 albert.lukmanov@davinci.edu.ar  
🎓 Comisión ACN2BV - Programación Web II  
👨‍🏫 Prof. Sergio Daniel Medina

---

**Fecha de entrega:** Diciembre 2025

