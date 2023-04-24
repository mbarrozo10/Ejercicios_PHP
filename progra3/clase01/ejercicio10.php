<?php
/*Aplicación No 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.*/

$vector= array();
$lapicera = array('color'=>'negro','marca'=>'asd','trazo'=>'???','precio'=>'300');
$lapiceraDos = array('color'=>'blanco','marca'=>'3w','trazo'=>'ee','precio'=>'10');
$lapiceraTres = array('color'=>'pepe','marca'=>'ffff','trazo'=>'adasdasd','precio'=>'1000');

$vector[0]=$lapicera;
$vector[1]=$lapiceraDos;
$vector[2]=$lapiceraTres;

foreach($vector as $vectores){
    foreach($vectores as $x => $i){
        echo "$x => $i <br/>";
    }
}

?>