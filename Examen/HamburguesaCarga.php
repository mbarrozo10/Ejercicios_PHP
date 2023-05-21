<?php
class HamburguesaCarga{

    static function GuardarJson($hamburguesa, $listaHamburguesa){
        require_once("Hamburguesa.php");
        $archivo='hamburguesa.json';
        $retorno="No se pudo hacer";
        if(file_exists($archivo)){
            $listaHamburguesa= json_decode(file_get_contents($archivo));
        }

        if(!$hamburguesa->ComprobarProducto($listaHamburguesa)){
            array_push($listaHamburguesa,$hamburguesa);
            $retorno= "Ingresado";
        }else{
            $retorno= "Actualizado";
        }
        file_put_contents($archivo, json_encode($listaHamburguesa));
        return $retorno;
    }

    static function GuardarFoto($hamburguesa, $foto){
        if(isset($foto)){
            $ruta= 'ImagenesDeHamburguesa/2023/'. $hamburguesa->tipo .$hamburguesa->nombre . ".png";
            move_uploaded_file($foto['tmp_name'],$ruta);
        }
    }
}
?>