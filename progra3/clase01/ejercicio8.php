<?php
/* Aplicación No 8 (Carga aleatoria)
Imprima los valores del vector asociativo siguiente usando la estructura de control foreach:
$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo'; */

$vec= array(1=>90, 30=>7,'e'=>99,'hola'=>'mundo');
//$vec[1]=>90;
//$vec[30]=>7;
//$vec['e']=>99;
//$vec['hola']=>'mundo';

foreach($vec as $i=> $x){
    echo "$i => $x <br/>";
}




?>