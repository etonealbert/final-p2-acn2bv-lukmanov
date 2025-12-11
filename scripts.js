let paginaActual = 1;
let totalPaginas = 1;
const personajesPorPagina = 5;
let timeoutBusqueda = null;

document.addEventListener('DOMContentLoaded', function() {
    cargarPersonajes();
});

function debounce(func, delay) {
    return function() {
        clearTimeout(timeoutBusqueda);
        timeoutBusqueda = setTimeout(func, delay);
    }
}

function cambiarTema(tema) {
    window.location.href = `?tema=${tema}`;
}

function aplicarFiltros() {
    paginaActual = 1;
    cargarPersonajes();
}

async function cargarPersonajes() {
    const contenedor = document.getElementById('lista-personajes');
    contenedor.innerHTML = '<div class="cargando">Cargando personajes...</div>';
    
    const busqueda = document.getElementById('busqueda').value;
    const rol = document.getElementById('filtro-rol').value;
    
    const params = new URLSearchParams({
        accion: 'listar',
        busqueda: busqueda,
        rol: rol,
        pagina: paginaActual,
        por_pagina: personajesPorPagina
    });

    try {
        const respuesta = await fetch(`api.php?${params.toString()}`);
        const datos = await respuesta.json();

        if (datos.exito) {
            mostrarPersonajes(datos.datos.personajes);
            totalPaginas = datos.datos.total_paginas;
            actualizarPaginacion(datos.datos);
        } else {
            mostrarError(datos.mensaje);
        }
    } catch (error) {
        mostrarError('Error al cargar personajes: ' + error.message);
    }
}

function mostrarPersonajes(personajes) {
    const contenedor = document.getElementById('lista-personajes');
    
    if (personajes.length === 0) {
        contenedor.innerHTML = '<div class="mensaje-vacio">No se encontraron personajes</div>';
        return;
    }

    contenedor.innerHTML = '';
    
    personajes.forEach(personaje => {
        const tarjeta = document.createElement('div');
        tarjeta.className = 'tarjeta-personaje';
        tarjeta.innerHTML = `
            <img src="${personaje.imagen_url || 'https://via.placeholder.com/300x400?text=' + encodeURIComponent(personaje.nombre)}" 
                 alt="${personaje.nombre}" 
                 class="tarjeta-imagen"
                 onerror="this.src='https://via.placeholder.com/300x400?text=' + encodeURIComponent('${personaje.nombre}')">
            <div class="tarjeta-contenido">
                <h3 class="tarjeta-titulo">${personaje.nombre}</h3>
                <span class="tarjeta-rol">${personaje.rol}</span>
                <p class="tarjeta-temporada">⏱️ Temporada ${personaje.temporada}</p>
                <p class="tarjeta-descripcion">${personaje.descripcion}</p>
                <div class="tarjeta-acciones">
                    <button class="btn-editar" onclick="editarPersonaje(${personaje.id})">✏️ Editar</button>
                    <button class="btn-eliminar" onclick="confirmarEliminar(${personaje.id}, '${personaje.nombre}')">🗑️ Eliminar</button>
                </div>
            </div>
        `;
        contenedor.appendChild(tarjeta);
    });
}

function actualizarPaginacion(datos) {
    const contenedor = document.getElementById('paginacion');
    
    if (datos.total_paginas <= 1) {
        contenedor.innerHTML = '';
        return;
    }

    contenedor.innerHTML = `
        <button class="btn-paginacion" onclick="cambiarPagina(${paginaActual - 1})" ${paginaActual === 1 ? 'disabled' : ''}>
            ⬅️ Anterior
        </button>
        <span class="info-paginacion">Página ${paginaActual} de ${datos.total_paginas}</span>
        <button class="btn-paginacion" onclick="cambiarPagina(${paginaActual + 1})" ${paginaActual === datos.total_paginas ? 'disabled' : ''}>
            Siguiente ➡️
        </button>
    `;
}

function cambiarPagina(nuevaPagina) {
    if (nuevaPagina < 1 || nuevaPagina > totalPaginas) return;
    paginaActual = nuevaPagina;
    cargarPersonajes();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function mostrarModalAgregar() {
    document.getElementById('modal-titulo').textContent = 'Agregar Personaje';
    document.getElementById('form-personaje').reset();
    document.getElementById('personaje-id').value = '';
    mostrarModal();
}

function mostrarModal() {
    document.getElementById('modal-personaje').classList.add('activo');
}

function cerrarModal() {
    document.getElementById('modal-personaje').classList.remove('activo');
    document.getElementById('form-personaje').reset();
}

window.onclick = function(evento) {
    const modal = document.getElementById('modal-personaje');
    if (evento.target === modal) {
        cerrarModal();
    }
}

document.addEventListener('keydown', function(evento) {
    if (evento.key === 'Escape') {
        cerrarModal();
    }
});

async function guardarPersonaje(evento) {
    evento.preventDefault();

    const formulario = evento.target;
    const datos = new FormData(formulario);
    
    const id = datos.get('id');
    const accion = id ? 'actualizar' : 'crear';
    datos.append('accion', accion);

    try {
        const respuesta = await fetch('api.php', {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();

        if (resultado.exito) {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: resultado.mensaje,
                confirmButtonColor: '#e50914'
            });
            cerrarModal();
            cargarPersonajes();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: resultado.mensaje,
                confirmButtonColor: '#e50914'
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al guardar: ' + error.message,
            confirmButtonColor: '#e50914'
        });
    }
}

async function editarPersonaje(id) {
    try {
        const respuesta = await fetch(`api.php?accion=obtener&id=${id}`);
        const resultado = await respuesta.json();

        if (resultado.exito) {
            const personaje = resultado.datos;
            
            document.getElementById('modal-titulo').textContent = 'Editar Personaje';
            document.getElementById('personaje-id').value = personaje.id;
            document.getElementById('personaje-nombre').value = personaje.nombre;
            document.getElementById('personaje-rol').value = personaje.rol;
            document.getElementById('personaje-temporada').value = personaje.temporada;
            document.getElementById('personaje-descripcion').value = personaje.descripcion;
            document.getElementById('personaje-imagen').value = personaje.imagen_url || '';
            
            mostrarModal();
        } else {
            mostrarError(resultado.mensaje);
        }
    } catch (error) {
        mostrarError('Error al cargar personaje: ' + error.message);
    }
}

function confirmarEliminar(id, nombre) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: `¿Deseas eliminar a ${nombre}? Esta acción no se puede deshacer.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e50914',
        cancelButtonColor: '#555',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((resultado) => {
        if (resultado.isConfirmed) {
            eliminarPersonaje(id);
        }
    });
}

async function eliminarPersonaje(id) {
    const datos = new FormData();
    datos.append('accion', 'eliminar');
    datos.append('id', id);

    try {
        const respuesta = await fetch('api.php', {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();

        if (resultado.exito) {
            Swal.fire({
                icon: 'success',
                title: '¡Eliminado!',
                text: resultado.mensaje,
                confirmButtonColor: '#e50914'
            });
            cargarPersonajes();
        } else {
            mostrarError(resultado.mensaje);
        }
    } catch (error) {
        mostrarError('Error al eliminar: ' + error.message);
    }
}

function mostrarError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: mensaje,
        confirmButtonColor: '#e50914'
    });
}

