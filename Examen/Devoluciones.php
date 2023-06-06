<?php
class Devolucion{
    public $id;
    public $fecha;
    public $idVenta;
    public $causa;
    public $idCupon;
    public function __construct($id, $fecha, $idVenta, $causa, $idCupon){
        $this->id = $id;
        $this->fecha = $fecha;
        $this->idVenta = $idVenta;
        $this->causa = $causa;
        $this->idCupon = $idCupon;
    }


}


?>