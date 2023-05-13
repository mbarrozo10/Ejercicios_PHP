<?php
class Producto{

 
    public $id;
    public $codigo;
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;
    


    function __construct ($codigo,$nombre,$tipo,$precio,$stock=1){
        $this->codigo= $codigo;
        $this->nombre=$nombre;
        $this->tipo=$tipo;
        $this->stock= $stock;
        $this-> precio= $precio;
        $this->id= rand(1,10000);
    }

    static function GuardarJson($producto, $listaDeProductos){
        $archivo='productos.json';
        $retorno="No se pudo hacer";
        if(file_exists($archivo)){
            $listaDeProductos= json_decode(file_get_contents($archivo));
        }
  

        if(!$producto->ComprobarProducto($listaDeProductos)){
            array_push($listaDeProductos,$producto);
            $retorno= "Ingresado";
        }else{
            $retorno= "Actualizado";
        }
        file_put_contents($archivo, json_encode($listaDeProductos));
        return $retorno;
    }

    
    function ComprobarProducto($productos){
        foreach($productos as $pro){
            if($pro->codigo == $this->codigo){
                $pro->stock++;
                return true;
            }
        }
        return false;
    }

    

    

}


?>