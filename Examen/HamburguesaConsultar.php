<?php

class HamburguesaConsultar{

    static function LeerJson(){
        $archivo= "hamburguesa.json";
        if(file_exists($archivo)){
            $jsonString= file_get_contents($archivo);
            $ListaDeHamburguesas= json_decode($jsonString);
            return $ListaDeHamburguesas;
        }
        else{
            echo "No existe el archivo";
        }
    }

    static function ComprobarProducto($ListaDeHamburguesas, $Hamburguesa){
        foreach($ListaDeHamburguesas as $pro){
            if($pro->nombre == $Hamburguesa->nombre && $pro->tipo == $Hamburguesa->tipo ){
                return true;
            }
        }
        return false;
    }

}


?>