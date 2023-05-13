<?php

if($_SERVER['REQUEST_METHOD']==='POST'){
    require_once("Pizza.php");
    require_once("pizzaConsultar.php");

    $mail= $_POST['mail'];
    $sabor=$_POST['sabor'];
    $tipo = $_POST['tipo'];
    $foto = $_FILES['foto'];
    $cantidad= $_POST['cantidad'];
    $pizza= new Pizza($sabor,$tipo);
    $pizzas= PizzaConsultar::LeerJson();
    if(PizzaConsultar::ComprobarProducto($pizzas,$pizza)){
        foreach($pizzas as $pro){
            if($pro->sabor == $pizza->sabor && $pro->tipo == $pizza->tipo ){
                $pro->cantidad-=$cantidad;
                file_put_contents("pizza.json", json_encode($pizzas));
                CargarBD($mail,$cantidad,$pizza);
                GuardarFoto($mail,$cantidad,$pizza,$foto);
         
                echo "todo salio ok ";
            }
        }
    }

    
}


function CargarBD($mail,$cantidad,$pizza){

    $con = mysqli_connect("localhost", "root","","bdsimu");
    if (!$con) {
        echo "algo salio mal";
      }else{
        $fecha=date('Y-m-d H:i:s');
        $pedido= rand(1,1000);
        $stmt = $con->prepare("INSERT INTO ventas (fecha,pedido,email,tipo,sabor,cantidad) VALUES (?, ?,?,?,?,?)");
        $stmt->bind_param("disssi",$fecha ,$pedido,$mail,$pizza->tipo, $pizza->sabor, $cantidad);
        $stmt->execute();
        $con->close();
      }

}

function GuardarFoto($mail,$cantidad,$pizza, $foto){
    if(isset($foto)){
        $usuario= explode("@",$mail);
        $fecha=date('Y-m-d');
        $ruta= 'Imagenes/'."10" . $pizza->tipo .$pizza->sabor.$usuario[0].$fecha . ".png";
        move_uploaded_file($foto['tmp_name'],$ruta);
    }
}

?>