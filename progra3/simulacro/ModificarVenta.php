<?php
class Modifica{

static function ModificarBd($pedido,$mail,$tipo,$sabor,$cantidad){

    $con = mysqli_connect("localhost", "root","","bdsimu");
    $stmt = $con->prepare("UPDATE ventas SET fecha= '1998-11-10' where pedido=? and email=? and tipo=? and sabor=? and cantidad=?");
    $stmt->bind_param("isssi",$pedido,$mail,$tipo,$sabor,$cantidad);
    $stmt->execute();
    $con->close();
    echo "se modifico ok";
}
}
?>