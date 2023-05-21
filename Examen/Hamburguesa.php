<?php
class Hamburguesa{
    public $id;
    public $nombre;
    public $precio;
    public $tipo;
    public $aderezo;
    public $cantidad;


    public function __construct ($nombre,$tipo,$aderezo="",$precio=0,$cantidad=1){
        $this->nombre= $nombre;
        $this->precio= $precio;
        $this->tipo= $tipo;
        $this->cantidad=$cantidad;
        $this->aderezo= $aderezo;
        $this->id= rand(1,10000);
    }


    
    function ComprobarProducto($ListaHamburguesas){
        foreach($ListaHamburguesas as $pro){
            if($pro->nombre == $this->nombre && $pro->tipo == $this->tipo ){
                $pro->cantidad++;
                $pro->precio=$this->precio;
                return true;
            }
        }
        return false;
    }


}
?>