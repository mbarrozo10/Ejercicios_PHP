<?php
class AltaVenta{
    static function Vender($mail,$nombre,$tipo,$foto,$cantidad,$aderezo){
    require_once("Hamburguesa.php");
    require_once("HamburguesaConsultar.php");
    require_once("Venta.php");
    require_once("Cupon.php");
    $Hamburguesa= new Hamburguesa($nombre,$tipo);
    $ListaHamburguesas= HamburguesaConsultar::LeerJson();
    if(HamburguesaConsultar::ComprobarProducto($ListaHamburguesas,$Hamburguesa)){
        foreach($ListaHamburguesas as $pro){
            if($pro->nombre == $Hamburguesa->nombre && $pro->tipo== $Hamburguesa->tipo ){
               if($pro->cantidad >= $cantidad){
                    $venta = new Venta($nombre,$tipo,$pro->precio*$cantidad,$aderezo,$mail,$cantidad);

                    if(isset($_POST['cupon'])){
                        self::VerificarCupon($venta);
                    }
                    $ventas= array();
                    if(file_exists("Ventas.json")){
                        $ventas= json_decode(file_get_contents("Ventas.json"),true);   
                    }
                    array_push($ventas,$venta);
                    $pro->cantidad-=$cantidad;
                    file_put_contents("Hamburguesa.json", json_encode($ListaHamburguesas));
                    AltaVenta::GuardarVenta($mail,$cantidad,$ventas);
                    AltaVenta::GuardarFoto($mail,$cantidad,$Hamburguesa,$foto);
            }else{
                echo "No hay cantidad suficientes de hamburguesas para esta transaccion";
                break;
            }
            }
        }
    }
}

    static function VerificarCupon ($venta){
        $cupones= json_decode(file_get_contents("cupones.json"));
        $flag= false;
        foreach($cupones as $cupon){
            if($cupon->id == $_POST['cupon'] && $cupon->estado == "Vigente"){
                $venta->precio -= $venta->precio * 0.10;
                $cupon->estado = "Usado" ;
                $flag=true;
            }
        }
        if(!$flag){
            echo "No se encuentra tu copon o no esta vigente";
        }
        file_put_contents("cupones.json", json_encode($cupones));	
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