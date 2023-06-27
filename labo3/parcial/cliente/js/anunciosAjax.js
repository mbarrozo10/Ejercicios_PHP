import {Anuncio} from './anuncio.js';
import {crearTabla} from './tabla.js';
import {actualizarTabla} from './tabla.js';
const URL= "http://localhost:3000/anuncios";

const $seccionTabla= document.getElementById("selTabla");
const loader= document.getElementById("loader");
loader.classList.add("oculto");
let anuncios;
//const anuncios= [];


function GetAnuncios (url) {
  loader.classList.remove("oculto");
  const xhr = new XMLHttpRequest();
  xhr.addEventListener("readystatechange",()=>{
    if(xhr.readyState == 4){
      if(xhr.status >= 200 && xhr.status< 300){
         anuncios= JSON.parse(xhr.responseText);
         $seccionTabla.appendChild(crearTabla(anuncios));
         MapeadoPromedio();
      }else{
        console.error("Error: " + xhr.status + "-" + xhr.statusText);
      }

      loader.classList.add("oculto");
    }

  });
  xhr.open("GET", url)
  xhr.send();
}


//Seteo addevent para que guarde el manejador 

window.addEventListener('DOMContentLoaded', () => {
    const formulario = document.getElementById('formularioAlta');
    //anuncios= GetAnuncios(URL) || []; 
    GetAnuncios(URL);
   // formulario.txtId.maxlength = anuncios[anuncios.length - 1].id;
   // formulario.txtId.value = anuncios[anuncios.length - 1].id + 1;
    formulario.addEventListener('submit', Manejador);
    CargarSeccion();
  });

  function FiltrarTransaccion() {
    let filtrados = [];
    const seleccion = document.getElementById("Filtro");
  
    filtrados=   anuncios.filter((rta) => {
      if(seleccion.value == "Todos"){
        return true;
      }else return rta.transaccion == seleccion.value;
    });
  
    actualizarTabla($seccionTabla,filtrados);
  }
  const seleccion = document.getElementById("Filtro");
  seleccion.addEventListener("change",FiltrarTransaccion);
  
  function CargarSeccion(){
  const selectElement = document.getElementById("Filtro");
  
  const etranValues = [
    "Todos",
    "alquiler",
    "venta"
  ];
  etranValues.forEach(function(value) {
    var option = document.createElement("option");
    option.value = value;
    option.textContent = value;
    selectElement.appendChild(option);
  });
  
  selectElement.value = "Todos";
  }
  
  const checkboxes = document.querySelectorAll('#mapeado input[type="checkbox"]');
  console.log(checkboxes);
  checkboxes.forEach(e=> {e.addEventListener('change', filtrarAtributos) });
  
  function filtrarAtributos() {
    console.log('filtrar atributo');
    const checkboxes = document.querySelectorAll('#mapeado input[type="checkbox"]');
    let atributosSeleccionados = Array.from(checkboxes)
      .filter(checkbox => checkbox.checked)
      .map(checkbox => checkbox.name);
      if (!atributosSeleccionados.includes('id')) {
        let array=[];
        array.push('id');
        atributosSeleccionados.forEach(e =>{ array.push(e);});
        atributosSeleccionados = array;
      }
    
    const resultado = anuncios.map(obj => {
      const nuevoObjeto = {};
      atributosSeleccionados.forEach(atributo => {
        nuevoObjeto[atributo] = obj[atributo];
      });
      return nuevoObjeto;
    });
    actualizarTabla($seccionTabla, resultado);
  }
  
  
  function MapeadoPromedio(){
    let precios = [];
    
    precios = anuncios.map(e=> e.precio);
    
    var sumaPrecios = precios.reduce(function(total, precio) {
      return total + precio;
    }, 0)
  
    const txt= document.getElementById("promedio");
  
    txt.value= sumaPrecios;
  }
  
  



//Decido si voy a guardar o a modificar dependiendo del estado del boton (no es lo mejor)

function Manejador(event) {
  event.preventDefault();
  const formulario = document.getElementById('formularioAlta');
  if(formulario.btnMod.disabled) {
    GuardarAnuncio();
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
  const xhr = new XMLHttpRequest();
  xhr.addEventListener("readystatechange",()=>{
    if(xhr.readyState == 4){
      if(xhr.status >= 200 && xhr.status< 300){
         anuncios= JSON.parse(xhr.responseText);
         actualizarTabla($seccionTabla,anuncios); 
      }else{
        console.error("Error: " + xhr.status + "-" + xhr.statusText);
      }

      loader.classList.add("oculto");
    }

  });
  xhr.open("POST", URL)
  xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

  xhr.send(JSON.stringify(Anuncio));
  // actualizarTabla($seccionTabla,anuncios); 
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
    if(anuncioSeleccionado.transaccion == "venta")
        {
            document.getElementById('rTransaccionVenta').checked = true;
            document.getElementById('rTransaccionAlquiler').checked = false;
        }else
        {
            document.getElementById('rTransaccionVenta').checked = false;
            document.getElementById('rTransaccionAlquiler').checked = true;
        }
    formulario.btnMod.disabled=false;
    formulario.btnGuardar.disabled=true;
    formulario.btnBorrar.disabled=false;
    formulario.btnCancelar.disabled=false;
    console.log(anuncioSeleccionado);
    formulario.btnBorrar.addEventListener('click',() => {BorrarAnuncio(anuncioSeleccionado, formulario);});
    formulario.btnMod.addEventListener('click',() => {
      anuncioSeleccionado.id = formulario.txtId.value;
      anuncioSeleccionado.titulo= formulario.txtTitulo.value;
      anuncioSeleccionado.descripcion =formulario.txtDescripcion.value;
      anuncioSeleccionado.precio =formulario.txtPrecio.value;
      anuncioSeleccionado.numBan = formulario.txtCantBaños.value;
      anuncioSeleccionado.numEstacionamiento =formulario.txtCantAutos.value;
      anuncioSeleccionado.numDormitorios =formulario.txtDormitorios.value;
      const transacciones = document.getElementsByName('transaccion');
      let transaccion;
      transacciones.forEach(element => {
        if(element.checked) {
            transaccion= element.value;
        }
    });
    anuncioSeleccionado.transaccion = transaccion;
      ModificarAnuncio(formulario, anuncioSeleccionado);});
    formulario.btnCancelar.addEventListener('click',() => {
      LimpiarFormulario(0);
      formulario.btnMod.disabled=true;
    formulario.btnGuardar.disabled=false;
    formulario.btnBorrar.disabled=true;
    formulario.btnCancelar.disabled=true;
    })
    
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
function ModificarAnuncio(formulario, anuncio) {
  const xhr = new XMLHttpRequest();
  xhr.addEventListener("readystatechange",()=>{
    if(xhr.readyState == 4){
      console.log("volvi");
      loader.classList.add("oculto");
    }
  });
  xhr.open("PUT", URL + "/" + anuncio.id)
  xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

  xhr.send(JSON.stringify(anuncio));

  actualizarTabla($seccionTabla,anuncios);
  LimpiarFormulario(anuncios[anuncios.length - 1].id + 1);
  formulario.btnMod.disabled=true;
  formulario.btnGuardar.disabled=false;
  formulario.btnBorrar.disabled=true;
      // anuncios.find((anun) => {
    //   if(anun.id===parseInt(formulario.txtId.value) ){
    //     console.log("encontre la modific");
    //     anun.titulo= formulario.txtTitulo.value;
    //     anun.descripcion= formulario.txtDescripcion.value;
    //     anun.precio= formulario.txtPrecio.value;
    //     anun.numBan= formulario.txtCantBaños.value;
    //     anun.numEstacionamiento= formulario.txtCantAutos.value;
    //     anun.numDormitorios= formulario.txtDormitorios.value;
    //     localStorage.setItem('anuncios', JSON.stringify(anuncios));
        
    //   }
    // }
    // )

}

//Borra el anuncio seleccionado en la tabla
function BorrarAnuncio(anuncioBorrar, formulario) {
  loader.classList.remove("oculto");
  actualizarTabla($seccionTabla,[]);
  const xhr = new XMLHttpRequest();
  xhr.addEventListener("readystatechange",()=>{
    if(xhr.readyState == 4){
      if(xhr.status >= 200 && xhr.status< 300){
         anuncios= JSON.parse(xhr.responseText);
      }else{
        console.error("Error: " + xhr.status + "-" + xhr.statusText);
      }
      loader.classList.add("oculto");
    }
  });
  xhr.open("DELETE", URL + "/" + anuncioBorrar.id);
  xhr.send();
  formulario.btnMod.disabled=true;
  formulario.btnGuardar.disabled=false;
  formulario.btnBorrar.disabled=true;
}
