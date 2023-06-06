<?php
class Cupon{
    public $id;
    public $fechaInicio;
    public $estado;

    public function __construct($id, $fechaInicio){
        $this->id = $id;
        $this->fechaInicio = $fechaInicio;
        $this->RevisarEstado();
    }

    public function RevisarEstado() {
        if ($this->estado!= "Usado") {
            $fecha =new DateTime();
            $diferencia= $this->fechaInicio->diff($fecha);
            $dias= $diferencia->days;
            if ($dias >=3){
                $this->estado="Vencido";
            }else{
                $this->estado="Vigente";
            }
        }
    }

}


?>