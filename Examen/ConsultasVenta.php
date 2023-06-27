<?php

require_once("Venta.php");

$contadorHamburguesas = 0;
$email=$_GET["mail"];
$tipo= $_GET["tipo"];
$primerFecha= $_GET["primerFecha"];
$segundaFecha= $_GET["segundaFecha"];
$fecha =$_GET["fecha"];
if($fecha >= date("Y-m-d")){
   // $fecha= date("Y-m-d", strtotime('-1 day') );
}

echo $fecha;
echo $primerFecha;
echo $segundaFecha;
if(file_exists("Ventas.json")){
    // Punto E
    $ventas= json_decode(file_get_contents("Ventas.json"));
    echo "</br>E </br> ";
    echo "Ventas de hamburguesas con aderezo ketchup: </br> ";
    foreach($ventas as $venta){
        if($venta->aderezo=="ketchup"){
            echo $venta->id  . " " . $venta->nombre . " " . $venta->mail . " " . $venta->tipo . " " . $venta->cantidad . " "  . $venta->fecha .  "</br>";
        }
        
    }
    


// ejercicio A


echo "</br>A </br> ";
   
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
else{
    echo "No se vendio nada todavia";
}
// B
echo "</br>B </br> ";
if($primerFecha!=0 && $segundaFecha != 0){
    $arrayOrdenado= array();
    foreach($ventas as $venta){
        if($venta->fecha > $primerFecha && $venta->fecha <= $segundaFecha){
            array_push($arrayOrdenado, $venta);
        }
    }
    $compararNombres= function($primerNombre,$segundoNombre){
        return strcmp($primerNombre->nombre, $segundoNombre->nombre);
    };
    usort($arrayOrdenado, $compararNombres);
    foreach($arrayOrdenado as $venta){
        echo $venta->id  . " " . $venta->nombre . " " . $venta->mail . " " . $venta->tipo . " " . $venta->cantidad . " "  . $venta->fecha .  "</br>";
    }
}else{
    echo "Algo salio mal";
}

// C

echo "</br>C </br> ";


$ventasFiltradas = array_filter($ventas, function ($venta) use ($email) 
{
    return $venta->mail == $email;
}); 
echo "listado de ventas de un usuario ingresado <br>";
foreach ($ventasFiltradas as $v) {

    echo "Venta: " . $v->id . 'Cantidad: ' . $v->cantidad. 'nombre: '. $v->nombre . ", Usuario: " . $v->mail . "<br>";
}
// D
echo "</br>D </br> ";

$ventasFiltradas = array_filter($ventas, function ($venta) use ($tipo) 
{
    return $venta->tipo == $tipo;
});
echo "listado de ventas de un tipo ingresado <br>";
foreach ($ventasFiltradas as $v) 
{
    echo "Venta: " . $v->id . ", tipo: " . $v->tipo . "<br>";
}
}
?>