<?php

require_once ('Devoluciones.php');
require_once ('Cupon.php');

$cupones= json_decode(file_get_contents('cupones.json'));
$devoluciones = json_decode(file_get_contents('devoluciones.json')); 

// A
echo 'Devoluciones: <br />';
foreach ($devoluciones as $devolucion) {
    echo "ID: " . $devolucion->id . " || ";
    echo "Fecha: " . $devolucion->fecha . " || ";
    echo "ID de Venta: " . $devolucion->idVenta . " || ";
    echo "Causa: " . $devolucion->causa . " || ";
    foreach ($cupones as $cup){
        if($cup->id === $devolucion->idCupon) echo "ID de Cupón: " . $cup->id. "||". $cup->estado  . " || ";
    }
    
    echo "<br>";
}


//B
echo 'Cupones: <br />';
foreach ($cupones as $cu){
    echo "ID de Cupón: " . $cup->id. "||". $cup->estado  . " || ";
}

?>