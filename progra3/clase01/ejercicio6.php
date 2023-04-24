<?php

/* Aplicación No 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado. */

$vec = array();
$prom=0;
for($i=0; $i<5;$i++){
    $random= rand(0,10);
    $vec[$i]= $random;
    $prom+=$random;
}
$prom= $prom/5;

if($prom>6)
echo "el promedio es mayor a 6";
else if($prom<6)
echo "el promedio es menor a 6";
else
echo "el promedio es 6";

?>