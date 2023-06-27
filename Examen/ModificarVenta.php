<?php

require_once("Venta.php");
require_once("Hamburguesa.php");
parse_str(file_get_contents("php://input"),$datos);
$ventas= array();
$flag = false;
if(file_exists("Ventas.json")){
    if(verificarHamburguesa($datos['nombre'])){
        $ventas = json_decode(file_get_contents("Ventas.json"));
        foreach($ventas as $venta){
            if($venta->id == $datos['nroPedido']){
                modificarHamburguesa($datos['cantidad'], $datos['nombre'],$venta->nombre);
                $venta->cantidad = $datos['cantidad'];
                $venta->mail = $datos['mail'];
                $venta->tipo= $datos['tipo'];
                $venta->aderezo= $datos['aderezo'];
                $venta->nombre= $datos['nombre'];
                $flag=true;
               echo "Se modifico la venta";
        }
        
        file_put_contents("Ventas.json", json_encode($ventas));
    }
   
} else echo "No existe esa hamburguesa";
    if(!$flag){
        echo "No se encontro ningun pedido con ese id";
    }
}else{
    echo "no se encontro el archivo";
}

function modificarHamburguesa($cantidad, $nombreDescontar, $nombreAgregar){
    if(file_exists("hamburguesa.json")){
        $array= json_decode(file_get_contents("hamburguesa.json"));
        foreach($array as $ham){
            if($ham->nombre==$nombreAgregar){
                $ham->cantidad+= $cantidad;
            }
            else if($ham->nombre == $nombreDescontar){
                $ham->cantidad -= $cantidad;
            }
        }

        file_put_contents("hamburguesa.json",json_encode($array));
    }
}

function verificarHamburguesa($nombre){
    if(file_exists("hamburguesa.json")){
        $array= json_decode(file_get_contents("hamburguesa.json"));
        foreach($array as $ham){
            if($ham->nombre == $nombre) return true;
        }
    }
    return false;
}

?>