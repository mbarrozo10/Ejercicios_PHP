<?php
require_once("usuario.php");
require_once("producto.php");
class Venta{

    public $nombreUsuario;
    public $codigoProducto;
    public $nombreProducto;
    public $idUsuario;

    function __construct($nombreU,$nombreP,$codigoP,$idU){
         $this->nombreUsuario=$nombreU;
         $this->codigoProducto=$codigoP;
         $this->nombreProducto= $nombreP;
         $this->idUsuario=$idU;
    }


    static function GuardarJson($venta, $ventas){
        $archivo='ventas.json';
        if(file_exists($archivo)){
            $ventas= json_decode(file_get_contents($archivo));
        }
        array_push($ventas,$venta);
        file_put_contents($archivo, json_encode($ventas));
    }


}



?>