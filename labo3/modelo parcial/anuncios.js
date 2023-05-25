import {anuncios as lista} from './listaAnuncios.js';
import {Anuncio} from './anuncio.js';
import {crearTabla} from './tabla.js';
import {actualizarTabla} from './tabla.js';

const $seccionTabla= document.getElementById('selTabla');
$seccionTabla.appendChild(crearTabla(JSON.parse(localStorage.getItem('anuncios'))));
localStorage.setItem('anuncios', JSON.stringify(lista));


//window.addEventListener('DOMContentLoaded', cargarDatos);

// function cargarDatos() {
//   const url = 'datos.json';

//   const request = new XMLHttpRequest();
//   request.open('GET', url, true);
//   request.onload = function () {
//     if (request.readyState === 4 && request.status === 200) {
//       const datosJSON = JSON.parse(request.responseText);
//       const personas = convertirAPersonas(datosJSON);
//       mostrarPersonas(personas);
//     }
//   };
//   request.send();
// }

// function convertirAPersonas(datosJSON) {
//   const personas = [];
//   for (const datos of datosJSON) {
//     const Anuncio = new Persona(datos.titulo, datos.descripcion, datos.precio);
//     personas.push(Anuncio);
//   }
//   return personas;
// }

window.addEventListener('DOMContentLoaded', () => {
    const formulario = document.getElementById('formularioAlta');
    formulario.addEventListener('submit', guardarAnuncio);
  });

  function guardarAnuncio(event) {
    event.preventDefault();
    
    const titulo = document.getElementById('txtTitulo').value;
    const descripcion = document.getElementById('txtDescripcion').value; ;
    const precio = parseInt(document.getElementById('txtPrecio').value);
    const cantBa = parseInt(document.getElementById('txtCantBaños').value);
    const cantAutos = parseInt(document.getElementById('txtCantAutos').value);
    const cantDormitorios= parseInt(document.getElementById('txtDormitorios').value)
    const transacciones = document.getElementsByName('transcaccion');
    let transaccion= false;
    transacciones.forEach(element => {
        if(element.checked) {
            transaccion= element.value;
        }
    });
    const Anun = new Anuncio(titulo, descripcion, precio, transaccion,cantBa,cantAutos, cantDormitorios);
    
    AgregarAnuncio(Anun);

    alert('Anuncio guardada correctamente');
  }



    function AgregarAnuncio(Anuncio) {

    const anuncios= JSON.parse(localStorage.getItem('anuncios')) || [];
    anuncios.push(Anuncio);
    console.log(anuncios);
    localStorage.setItem('anuncios', JSON.stringify(anuncios));
    actualizarTabla($seccionTabla,anuncios); 
  }


