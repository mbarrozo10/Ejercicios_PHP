<?php
// Aplicación No 26 (RealizarVenta)
// Archivo: RealizarVenta.php
// método:POST
// Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
// POST .
// Verificar que el usuario y el producto exista y tenga stock.
// crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). carga
// los datos necesarios para guardar la venta en un nuevo renglón.
// Retorna un :
// “venta realizada”Se hizo una venta
// “no se pudo hacer“si no se pudo hacer
// Hacer los métodos necesaris en las clases
require_once("usuario.php");
require_once("producto.php");
require_once("venta.php");

$producto=$_POST['codigo'];
$idUsuario=$_POST['usuario'];
$cantidad=$_POST['cantidad'];

$ventas= array();
$productos=json_decode(file_get_contents("productos.json"));
$usuarios= Usuario::LeerJson();
$usuario= Usuario::ConseguirUsuario($usuarios,$idUsuario);

$archivo='productos.json';
$producto=null;
$venta;
$id=rand(1,10000);
foreach($productos as $prod){
    if($prod->codigo==$producto){
        $producto= $prod;
        break;
    }
}
if($producto !=null && $usuario!=null){
    $venta= new Venta($usuario->nombre,$producto->nombre,$producto->codigo,$usuario->id);
    Venta::GuardarJson($venta,$ventas);
    echo "Venta Realizada";
}else{
    echo "No se pudo hacer";
}

?>