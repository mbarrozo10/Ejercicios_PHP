<?php

class Usuario{
   public $nombre;
   public $clave;
   public $mail;

    function __construct($nombre,$clave,$mail){
        if($nombre!="" && $clave!="" && $mail != ""){
            $this->nombre= $nombre;
            $this->clave= $clave;
            $this->mail=$mail;
        }
        else{
            echo "Algun campo esta vacio";
        }
    }


    static function GuardarUsuarios($usuarios){
        $archivo = fopen("usuarios.csv","w");
        foreach($usuarios as $user){
            $string = $user->nombre . "," . $user->clave. "," . $user->mail . ";";
            fwrite($archivo,$string);
        }
        fclose($archivo);
    }

    static function LeerUsuarios(){
        $archivo = fopen("usuarios.csv","r");
        $usuarios= array();
        while(!feof($archivo)){
            $lectura= fgets($archivo);
            $datos= explode(";",$lectura);
            foreach($datos as $string){ 
                $dato = explode(",",$string);
                if(count($dato)>1){
                    $usuario = new Usuario($dato[0],$dato[1],$dato[2]);
                    array_push($usuarios, $usuario);
                }
            }
        }
        fclose($archivo);
        return $usuarios;
    }
}


?>