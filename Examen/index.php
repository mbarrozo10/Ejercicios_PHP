<?php

if($_SERVER['REQUEST_METHOD']==='POST'){
    require_once("Hamburguesa.php");
    switch($_POST['action']){
        case 'Carga':
            require_once("HamburguesaCarga.php");
        
            $ListaDeHamburguesas= array();
            $Hamburguesa= new Hamburguesa($_POST['nombre'],$_POST['tipo'],$_POST['aderezo'],$_POST['precio'], $_POST['cantidad']);
            echo HamburguesaCarga::GuardarJson($Hamburguesa,$ListaDeHamburguesas);
            HamburguesaCarga::GuardarFoto($Hamburguesa,$_FILES['foto']);
            break;
        case 'Consultar':
            require_once("HamburguesaConsultar.php");
            $ListaDeHamburguesas= HamburguesaConsultar:: LeerJson();
            $Hamburguesa= new Hamburguesa($_POST['nombre'],$_POST['tipo']);
            if(HamburguesaConsultar::ComprobarProducto($ListaDeHamburguesas,$Hamburguesa)){
                echo "Si hay";
            }else{
                echo "no hay";
            }
            break;
        case 'AltaVenta':
            require_once("AltaVenta.php");
            $mail= $_POST['mail'];
            $nombre=$_POST['nombre'];
            $tipo = $_POST['tipo'];
            $foto = $_FILES['foto'];
            $cantidad= $_POST['cantidad'];
            $aderezo= $_POST['aderezo'];
            AltaVenta::Vender($mail,$nombre,$tipo,$foto,$cantidad,$aderezo);
        }
    }else if($_SERVER['REQUEST_METHOD']==='GET'){
        include("ConsultasVenta.php");
    }else if($_SERVER['REQUEST_METHOD']==='PUT'){
        include("ModificarVenta.php");

    }else if($_SERVER['REQUEST_METHOD']==='DELETE'){
         include ("BorrarVenta.php");
    }
    


?>