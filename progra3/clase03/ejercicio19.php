<?php

require_once("..\clase02\Auto.php");

$autos= Auto::LeerCsv("..\clase02\Autos.csv");



$autos[2]->AgregarImpuestos(1500);
$autos[3]->AgregarImpuestos(1500);
$autos[4]->AgregarImpuestos(1500);

echo Auto::Add($autos[0], $autos[1]);

if($autos[0]->Equals($autos[1])){
    echo "El auto 1 y 2 son iguales";
}else{
    echo "Los autos 1 y 2 no son iguales";
}
if($autos[0]->Equals($autos[4])){
    echo "Los autos 1 y 5 son iguales";
}else{
    echo "Los autos 1 y 5 no sson iguales";
}

Auto::MostrarAuto($autos[1]);
Auto::MostrarAuto($autos[2]);
Auto::MostrarAuto($autos[4]);



?>