<?php

$operador="/";
$opUno=1;
$opDos=0;

switch($operador){
    case "+":
        $suma= $opDos+ $opUno;
        echo "El resultado es : $suma";
        break;
    case "-":
        $suma= $opUno- $opDos;
        echo "El resultado es : $suma";
        break;
    case "*":
        $suma= $opDos* $opUno;
        echo "El resultado es : $suma";
        break;
    case "/":
        if($opDos!=0){
            $suma= $opUno/ $opDos;
            echo "El resultado es : $suma";
        }else{
            echo "No se puede dividir en 0";
        }
        break;
    default:
    echo "algo salio mal";
    break;
}



?>