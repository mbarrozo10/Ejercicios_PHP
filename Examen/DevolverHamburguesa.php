<?php

require_once ("Cupon.php");
require_once("Devoluciones.php");
require_once ("Venta.php");
$idPedido= $_POST["id"];
$fotoCliente= $_FILES['foto'];
$causa= $_POST["causa"];
$ventas= json_decode(file_get_contents("Ventas.json"));
$flag = false;
foreach ($ventas as $ven){
    if($ven->id == $idPedido){
        $cupones= GenerarArray("cupones.json");
        $devoluciones= GenerarArray("devoluciones.json");

        $idCupon=rand(1,1000);
        $fecha= date("Y-m-d");
        $date= new DateTime($fecha);

        $devolucion= new Devolucion(rand(1,1000),$fecha, $ven->id, $causa,$idCupon);
        $cupon = new Cupon ($idCupon, $date, $causa);
        array_push($cupones,$cupon);
        array_push($devoluciones, $devolucion);
       
        GuardarFoto($devolucion, $fotoCliente);
        file_put_contents("cupones.json", json_encode($cupones));
        file_put_contents("devoluciones.json", json_encode($devoluciones));
        $flag= false;
        echo "Se entrego un cupon, disuclpe las molestias";
        break;
    }else{
        $flag=true;
    }
}
$nuevoArray= array();
foreach($ventas as $ven){
    if($ven->id != $idPedido){
        array_push($nuevoArray,$ven);
    }
}
file_put_contents("Ventas.json", json_encode($nuevoArray));


if($flag){
    echo "no hay ningun pedido";
}


 function GenerarArray($archivo) {
    if(file_exists($archivo)){
        $array= json_decode(file_get_contents($archivo));
    }else{
        $array= array();
    }
    return $array;
}

 function GuardarFoto($devolucion, $foto){
    if(isset($foto)){
        $ruta= 'FotosDevoluciones/' . $devolucion->id .$devolucion->causa . $devolucion->idVenta .$devolucion->fecha . ".png";
        move_uploaded_file($foto['tmp_name'],$ruta);
    }
}

?>