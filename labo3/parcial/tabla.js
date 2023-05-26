
//Metodo generar tabla exportado para poder usarse en anuncios
export const crearTabla = (data) => {
    if(!Array.isArray(data)) return null;

    const tabla = document.createElement('tabla');
    tabla.appendChild(CrearCabecera());
    tabla.appendChild(CrearCuerpo(data));

    return tabla;
}

//Crea la cabecera, puede hacerse dinamicamente pero no quiero <3
const CrearCabecera = () => {
    const thead = document.createElement("thead"),
    headrow= document.createElement("tr");
    
    const thId= document.createElement("th");
    const thTitulo= document.createElement("th");
    const thtrans= document.createElement("th");
    const thDesc=   document.createElement("th");
    const thPrecio= document.createElement("th");
    const thCantB=   document.createElement("th");
    const thEst=   document.createElement("th");
    const thDor= document.createElement("th");
    
    thId.textContent = "Id";
    thTitulo.textContent = "Titulo ";
    thtrans.textContent = "Transaccion ";
    thDesc.textContent = "Descripcion ";
    thPrecio.textContent = "Precio ";
    thCantB.textContent = "Cantidad Baños";
    thEst.textContent = "Estacionamientos";
    thDor.textContent = "Dormitorios";

    headrow.appendChild(thId);
    headrow.appendChild(thTitulo);
    headrow.appendChild(thtrans);
    headrow.appendChild(thDesc);
    headrow.appendChild(thPrecio);
    headrow.appendChild(thCantB);
    headrow.appendChild(thEst);
    headrow.appendChild(thDor);

    thead.appendChild(headrow);

    return thead;
};

//Crea el cuerpo de la tabla con los datos pasados
const CrearCuerpo= (data) => {
    const tbody = document.createElement("tbody");

    data.forEach(element => {
        const tr= document.createElement("tr");
        for(const key in element) {
            if(key ==="id"){
                tr.dataset.id=element[key];
            }
            const td= document.createElement("td");
            td.textContent = element[key];
          
            tr.appendChild(td);

        }
        tbody.appendChild(tr);
    });
    return tbody;
}

//Actualiza la tabla, exporto para poder usarla cuando la necesito
export const actualizarTabla= (contenedor, data) => {
    while(contenedor.hasChildNodes()) {
      contenedor.removeChild(contenedor.lastChild);
    }
    contenedor.appendChild(crearTabla(data));
  }


