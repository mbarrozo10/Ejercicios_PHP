<?php
switch($_SERVER['REQUEST_METHOD']){
    case 'POST':
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
                break;
            case 'Devolver':
                include("DevolverHamburguesa.php");
            }
        break;
        case 'GET':
            switch($_GET['Action']){
                case 'Ventas':
                    include("ConsultasVenta.php");
                    break;
                case 'Devoluciones':
                    include("ConsultasDevulociones.php");
                    break;
            }
            break;
        case 'PUT':
            include("ModificarVenta.php");
            break;
        case 'DELETE':
            include ("BorrarVenta.php");
            break;
    }

    

?>