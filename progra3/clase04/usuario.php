<?php
class Usuario{
    
    public $nombre;
    public $clave;
    public $mail;
    public $id;
    public $fechaDeRegistro;


    public function __construct($nombre,$clave,$mail){
        $this->nombre=$nombre;
        $this->clave=$clave;
        $this->mail=$mail;
        $this->id= rand(0,100000);
        $this->fechaDeRegistro= date('Y-m-d H:i:s');
    }

    static function GuardarJson($usuario, $usuarios){
        $archivo='usuarios.json';
        if(file_exists($archivo)){
            $usuarios= json_decode(file_get_contents($archivo),true);
        }
        if(!in_array($usuario,$usuarios)){
            array_push($usuarios,$usuario);
            file_put_contents($archivo, json_encode($usuarios));
            return true;
        }else{
            echo "El usuario ya esta agregado";
            return false;
        }
    }

    static function GuardarFotos($foto, $usuario){
        if(isset($foto)){
            $ruta='Usuario/fotos/' . $usuario->id ."-" .$usuario->nombre. ".png";
            move_uploaded_file($foto['tmp_name'],$ruta);
        }
    }

    static function LeerJson(){
        $archivo= "usuarios.json";;
        if(file_exists($archivo)){
            $jsonString= file_get_contents($archivo);
            $usuarios= json_decode($jsonString);
            return $usuarios;
        }
        else{
            echo "No existe el archivo";
        }
    }


    static function ConseguirUsuario($usuarios, $id){
        foreach($usuarios as $user){
            if($user->id==$id){
                return $user;
            }
        }
        return null;
    }
}


?>