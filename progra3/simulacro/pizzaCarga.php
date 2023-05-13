<?php
class PizzaCarga{

    static function GuardarJson($pizza, $listaDePizzas){
        require_once("Pizza.php");
        $archivo='pizza.json';
        $retorno="No se pudo hacer";
        if(file_exists($archivo)){
            $listaDePizzas= json_decode(file_get_contents($archivo));
        }

        if(!$pizza->ComprobarProducto($listaDePizzas)){
            array_push($listaDePizzas,$pizza);
            $retorno= "Ingresado";
        }else{
            $retorno= "Actualizado";
        }
        file_put_contents($archivo, json_encode($listaDePizzas));
        return $retorno;
    }

    static function GuardarFoto($pizza, $foto){
        if(isset($foto)){
            $ruta= 'ImagenesDePizza/'. $pizza->tipo .$pizza->sabor . ".png";
            move_uploaded_file($foto['tmp_name'],$ruta);
        }
    }
}
?>