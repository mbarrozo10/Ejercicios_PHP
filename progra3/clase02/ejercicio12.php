<?php
/*Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.*/

$palabra = "Hola";

function InvertirPalabra($parametro){
    return strrev($parametro);
}
 
echo InvertirPalabra($palabra);
?>