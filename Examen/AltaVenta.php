<?php
class AltaVenta{
    static function Vender($mail,$nombre,$tipo,$foto,$cantidad,$aderezo){
    require_once("Hamburguesa.php");
    require_once("HamburguesaConsultar.php");
    require_once("Venta.php");
    $Hamburguesa= new Hamburguesa($nombre,$tipo);
    $ListaHamburguesas= HamburguesaConsultar::LeerJson();
    if(HamburguesaConsultar::ComprobarProducto($ListaHamburguesas,$Hamburguesa)){
        foreach($ListaHamburguesas as $pro){
            if($pro->nombre == $Hamburguesa->nombre && $pro->tipo == $Hamburguesa->tipo ){
                $venta = new Venta($nombre,$tipo,$aderezo,$mail,$cantidad);
                $ventas= array();
                if(file_exists("Ventas.json")){
                    $ventas= json_decode(file_get_contents("Ventas.json"),true);   
                }
                array_push($ventas,$venta);
                $pro->cantidad-=$cantidad;
                file_put_contents("Hamburguesa.json", json_encode($ListaHamburguesas));
                AltaVenta::GuardarVenta($mail,$cantidad,$ventas);
                AltaVenta::GuardarFoto($mail,$cantidad,$Hamburguesa,$foto);
         
                echo "todo salio ok ";
            }
        }
    }
}

    static function GuardarVenta($mail,$cantidad,$Hamburguesa){
                file_put_contents('Ventas.json', json_encode($Hamburguesa));
                echo 'La venta se realizó con éxito! <br>';
    }
    
    static function GuardarFoto($mail,$cantidad,$Hamburguesa, $foto){
        if(isset($foto)){
            $usuario= explode("@",$mail);
            $fecha=date('Y-m-d');
            $ruta= 'ImagenesDeLaVenta/2023/' . $Hamburguesa->tipo .$Hamburguesa->nombre.$usuario[0].$fecha . ".png";
            move_uploaded_file($foto['tmp_name'],$ruta);
        }
    }
}
?>