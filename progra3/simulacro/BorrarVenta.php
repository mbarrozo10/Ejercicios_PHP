<?php
class Borrar{

static function Borrar($pedido){

    $con = mysqli_connect("localhost", "root","","bdsimu");
    $stmt = $con->prepare("DELETE FROM ventas where pedido=? ");
    $stmt->bind_param("i",$pedido);
    $stmt->execute();
    $con->close();
    echo "se borro ok";
}
}
?>