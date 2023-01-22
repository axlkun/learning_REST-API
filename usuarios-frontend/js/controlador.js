var usuarios = [];
const url = '../../api_basica/usuarios-backend/api/usuarios.php';
var usuarioSeleccionado;

function obtenerUsuarios() {
    axios({
        method: 'GET',
        url: url,
        responseType: 'json'
    }).then(res => {
        console.log(res.data);
        this.usuarios = res.data;
        llenarTabla();
    }).catch(error => {
        console.error(error);
    });
}

obtenerUsuarios();

function llenarTabla() {
    document.querySelector('#tablaUsuarios tbody').innerHTML = '';
    for (let i = 0; i < usuarios.length; i++) {
        document.querySelector('#tablaUsuarios tbody').innerHTML +=
            `
        <tr>
            <td>${usuarios[i].nombre}</td>
            <td>${usuarios[i].apellido}</td>
            <td>${usuarios[i].fechaNacimiento}</td>
            <td>${usuarios[i].genero}</td>
            <td><button type="button" onclick="eliminar(${i})">X</button>
            <button type="button" onclick="seleccionar(${i})">Editar</button>
            </td>
        </tr>
        `;
    }
}

function eliminar(indice) {
    console.log('Eliminando elemento con el indice: ' + indice);
    axios({
        method: 'DELETE',
        url: url + `?id=${indice}`,
        responseType: 'json'
    }).then(res => {
        console.log(res.data);
        // this.usuarios = res.data;
        obtenerUsuarios();

    }).catch(error => {
        console.error(error);
    });
}

function guardar() {
    document.getElementById('btn-guardar').disabled = true;
    document.getElementById('btn-guardar').innerHTML = "Guardando..."
    let usuario = {
        nombre: document.getElementById('nombre').value,
        apellido: document.getElementById('apellido').value,
        fechaNacimiento: document.getElementById('fechaNacimiento').value,
        genero: document.querySelector('input[name="genero"]:checked').value
    }

    console.log('Usuario a guardar: ', usuario);

    axios({
        method: 'POST',
        url: url,
        responseType: 'json',
        data: usuario
    }).then(res => {
        console.log(res.data);
        // this.usuarios = res.data;
        obtenerUsuarios();
        limpiar();
        document.getElementById('btn-guardar').disabled = false;
        document.getElementById('btn-guardar').innerHTML = "Guardar"

    }).catch(error => {
        console.error(error);
    });
}

function limpiar() {
    document.getElementById('nombre').value = null;
    document.getElementById('apellido').value = null;
    document.getElementById('fechaNacimiento').value = null;
    document.querySelector('input[name="genero"]:checked').checked = null;
    document.getElementById('btn-guardar').style.display = 'inline';
    document.getElementById('btn-actualizar').style.display = 'none';
}

function seleccionar(indice) {
    usuarioSeleccionado = indice;
    console.log('Actualizar registro: ', indice);

    axios({
        method: 'GET',
        url: url + `?id=${indice}`,
        responseType: 'json',
    }).then(res => {
        console.log(res.data);
        // this.usuarios = res.data;
        document.getElementById('nombre').value = res.data.nombre;
        document.getElementById('apellido').value = res.data.apellido;
        document.getElementById('fechaNacimiento').value = res.data.fechaNacimiento;
        document.querySelector('input[name="genero"][value="' + res.data.genero + '"]').checked = true;
        document.getElementById('btn-guardar').style.display = 'none';
        document.getElementById('btn-actualizar').style.display = 'inline';

    }).catch(error => {
        console.error(error);
    });
}

function actualizar(){
    document.getElementById('btn-actualizar').disabled = true;
    document.getElementById('btn-actualizar').innerHTML = "Actualizando..."
    let usuario = {
        nombre: document.getElementById('nombre').value,
        apellido: document.getElementById('apellido').value,
        fechaNacimiento: document.getElementById('fechaNacimiento').value,
        genero: document.querySelector('input[name="genero"]:checked').value
    }

    console.log('Usuario a actualizar: ', usuario);

    axios({
        method: 'PUT',
        url: url + `?id=${usuarioSeleccionado}`,
        responseType: 'json',
        data: usuario
    }).then(res => {
        console.log(res.data);
        // this.usuarios = res.data;
        obtenerUsuarios();
        limpiar();
        document.getElementById('btn-actualizar').disabled = false;
    document.getElementById('btn-actualizar').innerHTML = "Actualizar"

    }).catch(error => {
        console.error(error);
    });
}