<?php 
class Auto{
    private $color;
    private $precio;
    private $marca;
    private $fecha;


    function __construct ($marca,$color, $precio =0, $fecha=''){
        $this->marca= $marca;
        $this->precio=$precio;
        $this->color=$color;
        $this->fecha=$fecha;
    }

    function AgregarImpuestos($impuesto){
        $this->precio+=$impuesto;
    }

    static function MostrarAuto($auto){
        echo "Marca: ". $auto->marca. "<br/>"
        . "Precio: " . $auto->precio . "<br/>".
        "Color: " . $auto->color . "<br/>". 
        "Fecha: " . $auto->fecha . "<br/>";
    }

    function Equals($auto){
        return $this->marca== $auto->marca;
    }

    static function Add($autoUno, $autoDos){
        if($autoUno->marca == $autoDos->marca && $autoUno->color == $autoDos->color){
            if($autoUno->precio>0 && $autoDos->precio>0){
                return $autoUno->precio + $autoDos->precio;
            }
        }
        else{
            return "Los autos no coinciden en marca o color";
        }
    }

    
    function ObtenerColor(){
        return $this->color;
    }

    function ObtenerMarca(){
        return $this->marca;
    }
    
    function ObtenerPrecio(){
        return $this->precio;
    }

    function ObtenerFecha(){
        return $this->fecha;
    }

    static function GuardarCsv($autos){
        $archivo = fopen("Autos.csv","w");
        foreach($autos as $auto){
            $string = $auto->ObtenerMarca(). ",". $auto->ObtenerColor(). ",". $auto->ObtenerPrecio(). "," . $auto->ObtenerFecha();
            fwrite($archivo, $string );
        }
        fclose($archivo);
    }

    static function LeerCsv($archivo){
        $autos=array();
        $archivo = fopen($archivo,"r");
        while(!feof($archivo)){
            $lectura= fgets($archivo);
            $datos= explode(";",$lectura);
            foreach($datos as $string){ 
                $dato = explode(",",$string);
                if(count($dato)>1){
                    $auto = new Auto($dato[0],$dato[1],$dato[2], $dato[3]);
                    array_push($autos, $auto);
                }
            }
        }
        fclose($archivo);
        return $autos;
    }

}


?>