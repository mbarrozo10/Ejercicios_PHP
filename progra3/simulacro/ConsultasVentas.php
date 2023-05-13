<?php

$con = mysqli_connect("localhost", "root","","bdsimu");
$query= "SELECT SUM(cantidad) FROM ventas";

$rta= mysqli_query($con,$query);

$datos= mysqli_fetch_row($rta);

echo "a-La cantidad es " . $datos[0];
$con->close();
?>