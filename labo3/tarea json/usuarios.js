var request = new XMLHttpRequest();
request.open('GET', 'usuarios.json', true);

request.onreadystatechange = function() {
    if (request.readyState === 4) {
var jsonText = request.responseText;

var usuarios = JSON.parse(jsonText);

var tabla = document.getElementById('Tabla');

var cuerpoTabla = tabla.getElementsByTagName('tbody')[0];
usuarios.forEach(function(x) {
    var fila = cuerpoTabla.insertRow();
    var celdaId = fila.insertCell();
    celdaId.textContent = x.id;

    var celdaNombre = fila.insertCell();
    celdaNombre.textContent = x.first_name;

    var celdaApellido = fila.insertCell();
    celdaApellido.textContent = x.last_name;

    var celdaEmail = fila.insertCell();
    celdaEmail.textContent = x.email;

    var celdaGenero = fila.insertCell();
    celdaGenero.textContent = x.gender;
        });
    }   
};
request.send();
    
