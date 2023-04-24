<?php


require_once("usuario.php");

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


foreach($usuarios as $user){
    echo "<ul>
<li>". $user->nombre. "</li>
<li>".$user->clave . "</li>
<li>". $user->mail. "</li>
</ul>"
;
}
?>