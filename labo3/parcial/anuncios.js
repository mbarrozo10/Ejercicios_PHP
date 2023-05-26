import{anuncios as lista} from './listaAnuncios.js';
import {Anuncio} from './anuncio.js';
import {crearTabla} from './tabla.js';
import {actualizarTabla} from './tabla.js';
localStorage.setItem('anuncios', JSON.stringify(lista));
const $seccionTabla= document.getElementById('selTabla');
$seccionTabla.appendChild(crearTabla(JSON.parse(localStorage.getItem('anuncios'))));
let anuncios= JSON.parse(localStorage.getItem('anuncios')) || [];


//Seteo addevent para que guarde el manejador 

window.addEventListener('DOMContentLoaded', () => {
    const formulario = document.getElementById('formularioAlta');
    formulario.txtId.maxlength = anuncios[anuncios.length - 1].id;
    formulario.txtId.value = anuncios[anuncios.length - 1].id + 1;
    formulario.addEventListener('submit', Manejador);
   
  });


//Decido si voy a guardar o a modificar dependiendo del estado del boton (no es lo mejor)

function Manejador(event) {
  event.preventDefault();
  const formulario = document.getElementById('formularioAlta');
  if(formulario.btnMod.disabled) {
    GuardarAnuncio();
    }
  else {
    ModificarAnuncio(formulario);
  }
  }



//Event listener para detectar si apreto en la tabla
window.addEventListener("click", (e) => {
  if(e.target.matches("td")){
      
      const id = e.target.parentElement.dataset.id;
      const anuncioSeleccionado = anuncios.find((anun) => anun.id==id);
      CargarDatosSeleccionado(anuncioSeleccionado);
  }
});

//Genero el objeto anuncio y verifico sus valores
function GuardarAnuncio() {
  const id= parseInt(document.getElementById('txtId').value);
  const titulo = document.getElementById('txtTitulo').value;
  const descripcion = document.getElementById('txtDescripcion').value; ;
  const precio = parseInt(document.getElementById('txtPrecio').value);
  const cantBa = parseInt(document.getElementById('txtCantBaños').value);
  const cantAutos = parseInt(document.getElementById('txtCantAutos').value);
  const cantDormitorios= parseInt(document.getElementById('txtDormitorios').value)
  const transacciones = document.getElementsByName('transaccion');
  let transaccion= false;
  transacciones.forEach(element => {
      if(element.checked) {
          transaccion= element.value;
      }
  });
  if(id != undefined && titulo !="" && cantBa !=undefined && cantAutos !=undefined && cantDormitorios !=undefined && cantDormitorios !=undefined){
    const Anun = new Anuncio(id,titulo, transaccion, descripcion, precio, cantBa,cantAutos, cantDormitorios);
    AgregarAnuncio(Anun);
    LimpiarFormulario(id+1);
   
  }else{
    alert("Algun campo esta vacio");
  }

}

//Agrego el anuncio al array y actualizo el localstorage y la tabla
function AgregarAnuncio(Anuncio) {
  anuncios.push(Anuncio);
  console.log(anuncios);
  localStorage.setItem('anuncios', JSON.stringify(anuncios));
  actualizarTabla($seccionTabla,anuncios); 
}

//Carga los datos de la tabla al formulario
function CargarDatosSeleccionado(anuncioSeleccionado){
    const formulario = document.getElementById('formularioAlta');
    formulario.txtId.value= anuncioSeleccionado.id;
    formulario.txtTitulo.value= anuncioSeleccionado.titulo;
    formulario.txtDescripcion.value= anuncioSeleccionado.descripcion;
    formulario.txtPrecio.value= anuncioSeleccionado.precio;
    formulario.txtCantBaños.value= anuncioSeleccionado.numBan;
    formulario.txtCantAutos.value= anuncioSeleccionado.numEstacionamiento;
    formulario.txtDormitorios.value= anuncioSeleccionado.numDormitorios;
    formulario.btnMod.disabled=false;
    formulario.btnGuardar.disabled=true;
    formulario.btnBorrar.disabled=false;
    formulario.btnBorrar.addEventListener('click',() => {BorrarAnuncio(anuncioSeleccionado, formulario)});
    
}

//Limpia el formulario
function LimpiarFormulario(id) {
  document.getElementById('txtId').value = id;
  document.getElementById('txtTitulo').value = "";
  document.getElementById('txtDescripcion').value = "";
  document.getElementById('txtPrecio').value = "";
  document.getElementById('txtCantBaños').value = "";
  document.getElementById('txtCantAutos').value = "";
  document.getElementById('txtDormitorios').value = "";
}

//Modifica el anuncio seleccionado en la tabla
function ModificarAnuncio(formulario) {
    anuncios.find((anun) => {
      if(anun.id===parseInt(formulario.txtId.value) ){
        console.log("encontre la modific");
        anun.titulo= formulario.txtTitulo.value;
        anun.descripcion= formulario.txtDescripcion.value;
        anun.precio= formulario.txtPrecio.value;
        anun.numBan= formulario.txtCantBaños.value;
        anun.numEstacionamiento= formulario.txtCantAutos.value;
        anun.numDormitorios= formulario.txtDormitorios.value;
        localStorage.setItem('anuncios', JSON.stringify(anuncios));
        
      }
    }
    )
    actualizarTabla($seccionTabla,anuncios);
    LimpiarFormulario(anuncios[anuncios.length - 1].id + 1);
    formulario.btnMod.disabled=true;
    formulario.btnGuardar.disabled=false;
    formulario.btnBorrar.disabled=true;
}

//Borra el anuncio seleccionado en la tabla
function BorrarAnuncio(anuncioBorrar, formulario){
  let anunciosNuevo= [];
  anuncios.forEach((anun) => {
      if(anun.id!==anuncioBorrar.id){
        anunciosNuevo.push(anun);
      }
    });
  anuncios= anunciosNuevo;
  localStorage.setItem('anuncios', JSON.stringify(anuncios));
  actualizarTabla($seccionTabla,anunciosNuevo);
  console.log(anunciosNuevo);
  LimpiarFormulario(anunciosNuevo[anunciosNuevo.length - 1].id + 1)
  formulario.btnMod.disabled=true;
  formulario.btnGuardar.disabled=false;
  formulario.btnBorrar.disabled=true;
}
