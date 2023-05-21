<?php

require_once("Venta.php");

parse_str(file_get_contents("php://input"),$datos);
$ventas= array();

if(file_exists("Ventas.json")){
    $ventas = json_decode(file_get_contents("Ventas.json"));
    foreach($ventas as $venta){
        if($venta->id == $datos['nroPedido']){
            $venta->cantidad += $datos['cantidad'];
            $venta->mail = $datos['mail'];
            $venta->tipo= $datos['tipo'];
            $venta->aderezo= $datos['aderezo'];
           echo "Se modifico la venta";
    }
    file_put_contents("Ventas.json", json_encode($ventas));
}
}else{
    echo "no se encontro el archivo";
}

?>