<?php
class Pizza{
    public $id;
    public $sabor;
    public $precio;
    public $tipo;
    public $cantidad;


    public function __construct ($sabor,$tipo,$precio=0,$cantidad=1){
        $this->sabor= $sabor;
        $this->precio= $precio;
        $this->tipo= $tipo;
        $this->cantidad=$cantidad;
        $this->id= rand(1,10000);
    }

   

    function ComprobarProducto($pizzas){
        foreach($pizzas as $pro){
            if($pro->sabor == $this->sabor && $pro->tipo == $this->tipo ){
                $pro->cantidad++;
                $pro->precio=$this->precio;
                return true;
            }
        }
        return false;
    }
}




?>