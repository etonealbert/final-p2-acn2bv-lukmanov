<?php
session_start();

if (isset($_GET['tema'])) {
    $_SESSION['tema'] = $_GET['tema'];
}

$tema_actual = isset($_SESSION['tema']) ? $_SESSION['tema'] : 'oscuro';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stranger Things - Catálogo de Personajes</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="tema-<?php echo $tema_actual; ?>">
    <header>
        <div class="contenedor">
            <h1>🔦 STRANGER THINGS</h1>
            <p class="subtitulo">Catálogo de Personajes</p>
            <div class="info-autor">
                <p><strong>Autor:</strong> Albert Lukmanov | <strong>Email:</strong> albert.lukmanov@davinci.edu.ar</p>
                <p><strong>Comisión:</strong> ACN2BV | <strong>Materia:</strong> Programación Web II | <strong>Profesor:</strong> Sergio Daniel Medina</p>
            </div>
        </div>
    </header>

    <nav class="barra-controles">
        <div class="contenedor">
            <div class="controles-tema">
                <button onclick="cambiarTema('claro')" class="btn-tema <?php echo $tema_actual === 'claro' ? 'activo' : ''; ?>">☀️ Claro</button>
                <button onclick="cambiarTema('oscuro')" class="btn-tema <?php echo $tema_actual === 'oscuro' ? 'activo' : ''; ?>">🌙 Oscuro</button>
            </div>
            <button onclick="mostrarModalAgregar()" class="btn-principal">➕ Agregar Personaje</button>
        </div>
    </nav>

    <main class="contenedor">
        <section class="filtros">
            <div class="campo-busqueda">
                <input type="text" id="busqueda" placeholder="🔍 Buscar por nombre..." onkeyup="aplicarFiltros()">
            </div>
            <div class="campo-filtro">
                <select id="filtro-rol" onchange="aplicarFiltros()">
                    <option value="Todos">Todos los roles</option>
                    <option value="Niños">Niños</option>
                    <option value="Adolescentes">Adolescentes</option>
                    <option value="Adultos">Adultos</option>
                    <option value="Villanos">Villanos</option>
                </select>
            </div>
        </section>

        <section id="lista-personajes" class="lista-personajes">
            <div class="cargando">Cargando personajes...</div>
        </section>

        <section id="paginacion" class="paginacion">
        </section>
    </main>

    <div id="modal-personaje" class="modal">
        <div class="modal-contenido">
            <span class="modal-cerrar" onclick="cerrarModal()">&times;</span>
            <h2 id="modal-titulo">Agregar Personaje</h2>
            <form id="form-personaje" onsubmit="guardarPersonaje(event)">
                <input type="hidden" id="personaje-id" name="id">
                
                <div class="campo-formulario">
                    <label for="personaje-nombre">Nombre *</label>
                    <input type="text" id="personaje-nombre" name="nombre" required minlength="2" maxlength="100" placeholder="Ej: Eleven">
                </div>

                <div class="campo-formulario">
                    <label for="personaje-rol">Rol *</label>
                    <select id="personaje-rol" name="rol" required>
                        <option value="">Seleccionar rol</option>
                        <option value="Niños">Niños</option>
                        <option value="Adolescentes">Adolescentes</option>
                        <option value="Adultos">Adultos</option>
                        <option value="Villanos">Villanos</option>
                    </select>
                </div>

                <div class="campo-formulario">
                    <label for="personaje-temporada">Temporada *</label>
                    <input type="number" id="personaje-temporada" name="temporada" required min="1" max="5" placeholder="1-5">
                </div>

                <div class="campo-formulario">
                    <label for="personaje-descripcion">Descripción *</label>
                    <textarea id="personaje-descripcion" name="descripcion" required minlength="10" maxlength="500" rows="4" placeholder="Descripción del personaje..."></textarea>
                </div>

                <div class="campo-formulario">
                    <label for="personaje-imagen">URL de Imagen</label>
                    <input type="url" id="personaje-imagen" name="imagen_url" maxlength="255" placeholder="https://ejemplo.com/imagen.jpg">
                </div>

                <div class="botones-formulario">
                    <button type="button" class="btn-secundario" onclick="cerrarModal()">Cancelar</button>
                    <button type="submit" class="btn-principal">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <div class="contenedor">
            <p>&copy; 2024 Proyecto Final - Programación Web II</p>
            <p>Albert Lukmanov - Comisión ACN2BV</p>
        </div>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>

