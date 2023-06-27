import {Heroes} from './heroes.js';
import {Superheroe} from './superheroe.js';
import {armas} from './armas.js';
import {crearTabla} from './tabla.js';
import {actualizarTabla} from './tabla.js';

localStorage.setItem('Armas', JSON.stringify(armas));
const $seccionTabla= document.getElementById("selTabla");
let listaHeroes= JSON.parse(localStorage.getItem('Heroes')) || Heroes;
let flag=true;
let indice=0;
localStorage.setItem('Heroes', JSON.stringify(listaHeroes));

const armasHeroes= JSON.parse(localStorage.getItem('Armas'));

$seccionTabla.appendChild(crearTabla(JSON.parse(localStorage.getItem('Heroes'))));
window.addEventListener('DOMContentLoaded', () => {

    const formulario = document.getElementById('formularioAlta');

    armasHeroes.forEach((x) => {
      const opcion = document.createElement('option');
      opcion.value = x;
      opcion.text= x;
      formulario.arma.appendChild(opcion);
    });
    formulario.addEventListener('submit', Manejador);
   
  });



//Decido si voy a guardar o a modificar dependiendo del estado del boton (no es lo mejor)

function Manejador(event) {
  event.preventDefault();
  const formulario = document.getElementById('formularioAlta');
  if(flag) {
    GuardarAnuncio();
  }
  else {
    ModificarAnuncio(formulario);
  }
  }

const personajes = document.getElementById('personajes');
const home= document.getElementById('home');
const homefooter= document.getElementById('homefoot');
const personajeFoot= document.getElementById('personajesfoot');
personajes.addEventListener('click', function(event) {
  event.preventDefault();
  window.location.href = './principal.html';
});

homefooter.addEventListener('click', function(event) {
  event.preventDefault();
  window.location.href = './index.html';
});

personajeFoot.addEventListener('click', function(event) {
  event.preventDefault();
  window.location.href = './principal.html';
});
home.addEventListener('click', function(event) {
  event.preventDefault();
  window.location.href = './index.html';
});



//Event listener para detectar si apreto en la tabla
window.addEventListener("click", (e) => {
  if(e.target.matches("td")){
      
      const id = e.target.parentElement.dataset.id;
      indice= id;
      const anuncioSeleccionado = listaHeroes
    .find((personaje) => personaje.id==id);
      CargarDatosSeleccionado(anuncioSeleccionado);
  }

});

//Genero el objeto anuncio y verifico sus valores
function GuardarAnuncio() {
  const id= generarId();
  const alias= document.getElementById('txtDescripcion').value;
  const nombre = document.getElementById('txtTitulo').value;
  const fuerza= document.getElementById('fuerza').value;
  const indice= document.getElementById('arma').selectedIndex;
  let arma;
  for(const key in armasHeroes){
    if(key== indice){
      arma= armasHeroes[key];
    }

  }
  const transacciones = document.getElementsByName('transaccion');
  let transaccion= false;
  transacciones.forEach(element => {
      if(element.checked) {
          transaccion= element.value;
      }
  });
  if(nombre !="" && fuerza !=undefined && arma !=""){
    const personaje = new Superheroe(parseInt(id),nombre,fuerza,alias,transaccion,arma);
    AgregarAnuncio(personaje);
    LimpiarFormulario(id+1);
   
  }else{
    alert("Algun campo esta vacio");
  }

}

//Agrego el anuncio al listaHeroes y actualizo el localstorage y la tabla
function AgregarAnuncio(Anuncio) {
  listaHeroes
.push(Anuncio);
  console.log(listaHeroes
  );
  actualizarTabla($seccionTabla,listaHeroes
  ); 
}

//Carga los datos de la tabla al formulario
function CargarDatosSeleccionado(anuncioSeleccionado){
    const formulario = document.getElementById('formularioAlta');
    formulario.txtTitulo.value= anuncioSeleccionado.nombre;
    formulario.txtDescripcion.value= anuncioSeleccionado.alias;
    formulario.fuerza.value= anuncioSeleccionado.fuerza;
    flag=false;
    for(const key in armasHeroes){
      
        if(armasHeroes[key]== anuncioSeleccionado.arma){
          formulario.arma.selectedIndex= key;
        }
    }
    
    if(anuncioSeleccionado.transaccion == "venta")
        {
            document.getElementById('rTransaccionVenta').checked = true;
          
        }else
        {
          
            document.getElementById('rTransaccionAlquiler').checked = true;
        }
    formulario.btnGuardar.value= "Modificar";
    formulario.btnBorrar.disabled=false;
    formulario.btnCancelar.disabled=false;
    formulario.btnBorrar.addEventListener('click',() => {BorrarAnuncio(anuncioSeleccionado, formulario)});
    formulario.btnCancelar.addEventListener('click',() => {
      LimpiarFormulario(0);
    formulario.btnGuardar.value="Guardar";
    formulario.btnBorrar.disabled=true;
    formulario.btnCancelar.disabled=true;
    })
    
}

function generarId()
{
    let id;
    for(var i = 0; i < listaHeroes
    .length; i++)
    {
        if(i == (listaHeroes
        .length - 1))
        {
            id = listaHeroes
          [i].id;
        }
    }
    return id + 1;
}

//Limpia el formulario
function LimpiarFormulario(id) {
  flag=true;
  localStorage.setItem('Heroes', JSON.stringify(listaHeroes
  ));
  document.getElementById('txtTitulo').value = "";
  document.getElementById('txtDescripcion').value = "";
}

//Modifica el anuncio seleccionado en la tabla
function ModificarAnuncio(formulario) {
    listaHeroes
  .find((personaje) => {
      if(personaje.id===parseInt(indice) ){
        personaje.nombre= formulario.txtTitulo.value;
        personaje.alias= formulario.txtDescripcion.value;
        personaje.fuerza= document.getElementById('fuerza').value;
        const indice= document.getElementById('arma').selectedIndex;
        let arma;
        for(const key in armasHeroes){
          if(key== indice){
            arma= armasHeroes[key];
          }

        }
        const transacciones = document.getElementsByName('transaccion');
        let transaccion= false;
        transacciones.forEach(element => {
            if(element.checked) {
                transaccion= element.value;
            }
        });
        personaje.editorial= transaccion;
        personaje.arma= arma;
        flag=true;
      }
    }
    )
    actualizarTabla($seccionTabla,listaHeroes
    );
    LimpiarFormulario(listaHeroes
    [listaHeroes
    .length - 1].id + 1);
    
    formulario.btnGuardar.value="Guardar";
    formulario.btnBorrar.disabled=true;
}

//Borra el anuncio seleccionado en la tabla
function BorrarAnuncio(anuncioBorrar, formulario){
  let anunciosNuevo= [];
  flag=true;
  listaHeroes
.forEach((personaje) => {
      if(personaje.id!==anuncioBorrar.id){
        anunciosNuevo.push(personaje);
      }
    });
  listaHeroes
= anunciosNuevo;
  actualizarTabla($seccionTabla,anunciosNuevo);
  console.log(anunciosNuevo);
  LimpiarFormulario(anunciosNuevo[anunciosNuevo.length - 1].id + 1)
  
  formulario.btnGuardar.value="Guardar";
  formulario.btnBorrar.disabled=true;
}
