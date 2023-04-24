<?php

/*Aplicación No 13 (Invertir palabra)
Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán: 1 si la palabra
pertenece a algún elemento del listado.
0 en caso contrario.*/ 

function VerificarPalabra($palabra, $max){
    if(strlen($palabra)<= $max){
        switch($palabra){
            case 'Recuperatorio':
                return 1;
                break;
            case 'Parcial':
                return 1;
                break;
            case 'Programacion':
                return 1;
                break;
            default:
                return 0;
                break;
        }
    }else{
        return "La palabra excede el maximo";
    }
}

echo VerificarPalabra("Programacion",16);

?>