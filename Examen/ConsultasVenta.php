<?php

require_once("Venta.php");
$fecha =$_GET["fecha"];

if(file_exists("Ventas.json")){
    $ventas= json_decode(file_get_contents("Ventas.json"));
    echo "Ventas de hamburguesas con aderezo ketchup: </br> ";
  foreach($ventas as $venta){
      if($venta->aderezo=="ketchup"){
          echo $venta->id  . " " . $venta->nombre . " " . $venta->mail . " " . $venta->tipo . " " . $venta->cantidad . " "  . $venta->fecha .  "</br>";
      }

    }
$contadorHamburguesas = 0;
if($fecha != 0)
{
    foreach($ventas as $v)
    {
        if($v->fecha == $fecha)
        {
            $contadorHamburguesas += $v->cantidad;
        }
    }

    echo "Las hamburguesas vendidas el día " . $fecha . " fueron " . $contadorHamburguesas . "<br/>";
}
}  
else{
    echo "No se vendio nada todavia";
}

$email=$_GET["mail"];

$ventasFiltradas = array_filter($ventas, function ($venta) use ($email) 
{
    return $venta->mail == $email;
}); 
echo "listado de ventas de un usuario ingresado. <br>";
foreach ($ventasFiltradas as $v) {

    echo "Venta: " . $v->id . 'Cantidad: ' . $v->cantidad. 'nombre: '. $v->nombre . ", Usuario: " . $v->mail . "<br>";
}
$tipo= $_GET["tipo"];

$ventasFiltradas = array_filter($ventas, function ($venta) use ($tipo) 
{
    return $venta->tipo == $tipo;
});
echo "listado de ventas de un tipo ingresado <br>";
foreach ($ventasFiltradas as $v) 
{
    echo "Venta: " . $v->id . ", tipo: " . $v->tipo . "<br>";
}

?>