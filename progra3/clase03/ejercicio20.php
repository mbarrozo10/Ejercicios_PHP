<?php
/* Aplicación No 20 BIS (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario*/ 

require_once("usuario.php");

//$usuario1= new Usuario("pepe","1234","lalal@gmail.com");
//$usuario2= new Usuario("pepe2","12344","lalal3@gmail.com");

//$usuarios= array($usuario1,$usuario2);

//Usuario::GuardarUsuarios($usuarios);
$usuarios=Usuario:: LeerUsuarios();

if($_SERVER['REQUEST_METHOD']==='POST'){
    $nombre=$_POST['nombre'];
    $clave=$_POST['clave'];
    $email=$_POST['email'];
    $usuario=new Usuario($nombre,$clave,$email);

    if(!array_search($usuario,$usuarios)){
        array_push($usuarios,$usuario);
    }else{
        echo "Este usuario ya esta agregado";
    }
}


Usuario::GuardarUsuarios($usuarios);


?>