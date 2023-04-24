<?php
    require_once("Auto.php");
class Garage{


private $razonSocial;
private $precioPorHora;
private $autos;

function __construct($razonSocial, $precioPorHora= 0){
    $this->razonSocial= $razonSocial;
    $this->precioPorHora= $precioPorHora;
    $this->autos= array();
}

function MostrarGarage(){
    echo "Nombre del garage: ". $this->razonSocial . "<br/>". 
    "Precio por hora: ". $this->precioPorHora . "<br/> Autos: <br/>";
    foreach($this->autos as $auto){
        Auto::MostrarAuto($auto);
    }
}

function Equals($auto){
    $comparacion= false;
    foreach($this->autos as $autoDos){
        if($autoDos== $auto){
            $comparacion=true;
        }
    }

    return $comparacion;
}

function Add ($auto){
    if($this->Equals($auto)==false){
        array_push($this->autos,$auto);
    }
    else{
        echo "El auto ya esta en el garaje <br/>";
    }
}

function Remove($auto){
    if($this->Equals($auto)){
        $key= array_search($auto,$this->autos);
        unset($this->autos[$key]);
    }else{
        echo "El auto no esta en el garaje <br/>";
    }
}

}
?>