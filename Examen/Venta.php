<?php
class Venta{
    public $id;
    public $nombre;
    public $mail;
    public $tipo;
    public $aderezo;
    public $cantidad;
    public $fecha;
    public $precio;

    public function __construct ($nombre,$tipo,$precio,$aderezo="",$mail=0,$cantidad=1){
        $this->nombre= $nombre;
        $this->mail= $mail;
        $this->tipo= $tipo;
        $this->cantidad=$cantidad;
        $this->aderezo= $aderezo;
        $this->precio= $precio;
        $this->id= rand(1,10000);
        $this->fecha= date("Y-m-d");
    }



}
?>