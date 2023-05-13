<?php

class PizzaConsultar{

    static function LeerJson(){
        $archivo= "pizza.json";
        if(file_exists($archivo)){
            $jsonString= file_get_contents($archivo);
            $pizzas= json_decode($jsonString);
            return $pizzas;
        }
        else{
            echo "No existe el archivo";
        }
    }

    static function ComprobarProducto($pizzas, $pizza){
        foreach($pizzas as $pro){
            if($pro->sabor == $pizza->sabor || $pro->tipo == $pizza->tipo ){
                return true;
            }
        }
        return false;
    }

}


?>