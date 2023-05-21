<?php

if($_SERVER['REQUEST_METHOD']==='POST'){
    require_once("Pizza.php");
    require_once("pizzaCarga.php");

    $pizzas= array();
    $pizza= new Pizza($_POST['sabor'],$_POST['tipo'],$_POST['precio']);
    pizzaCarga::GuardarJson($pizza,$pizzas);
    pizzaCarga::GuardarFoto($pizza,$_FILES['foto']);
}else if($_SERVER['REQUEST_METHOD']==='GET'){
    require_once("Pizza.php");
    require_once("pizzaConsultar.php");
    $pizzas= PizzaConsultar:: LeerJson();
    $pizza= new Pizza($_GET['sabor'],$_GET['tipo']);
    //$pizza= new Pizza("peperoni",);
    if(PizzaConsultar::ComprobarProducto($pizzas,$pizza)){
        echo "Si hay";
    }else{
        echo "no hay";
    }
}else if($_SERVER['REQUEST_METHOD']==='PUT'){
    require_once("ModificarVenta.php");
    parse_str(file_get_contents("php://input"),$datos);
    $pedido= $datos['pedido'];
    $mail = $datos['mail'];
    $tipo = $datos['tipo'];
    $sabor= $datos['sabor'];
    $cantidad= $datos['cantidad'];
    Modifica::ModificarBd($pedido,$mail,$tipo,$sabor,$cantidad);

}else if($_SERVER['REQUEST_METHOD']==='DELETE'){
    require_once("BorrarVenta.php");
    parse_str(file_get_contents("php://input"),$datos);
    $pedido= $datos['pedido'];
    Borrar::Borrar($pedido);
}

?>

}else if($_SERVER['REQUEST_METHOD']==='PUT'){
    require_once("ModificarVenta.php");
    parse_str(file_get_contents("php://input"),$datos);
    $pedido= $datos['pedido'];
    $mail = $datos['mail'];
    $tipo = $datos['tipo'];
    $sabor= $datos['sabor'];
    $cantidad= $datos['cantidad'];
    Modifica::ModificarBd($pedido,$mail,$tipo,$sabor,$cantidad);

}else if($_SERVER['REQUEST_METHOD']==='DELETE'){
    require_once("BorrarVenta.php");
    parse_str(file_get_contents("php://input"),$datos);
    $pedido= $datos['pedido'];
    Borrar::Borrar($pedido);
}