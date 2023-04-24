<?php

/*
Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.*/

$var = array('color'=>'','marca'=>'','trazo'=>'','precio'=>'');

$var['color']= 'negro';
$var['marca']= 'bic';
$var['trazo']= '??';
$var['precio']= '20000';

foreach($var as $i=> $x){
    echo "$i => $x <br/>";
}

$var['color']= 'roja';
$var['marca']= 'pichuflito';
$var['trazo']= '??';
$var['precio']= '10000';

foreach($var as $i=> $x){
    echo "$i => $x <br/>";
}

$var['color']= 'blanca';
$var['marca']= '??';
$var['trazo']= '??';
$var['precio']= '400';

foreach($var as $i=> $x){
    echo "$i => $x <br/>";
}
?>