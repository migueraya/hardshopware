<?php
 
if(isset($_GET['salir'])){
    unset($_SESSION['login']);
}
 
 
if(isset($_POST['login'])){
    $yo=new Usuario($_POST['usuarioLogin'],$_POST['contraseñaLogin']);
    if($yo->conectado()) $_SESSION['login']=$yo;
}
 
 
 if(isset($_POST['registrar'])){
 	
 	
 	//comprobación de la contraseña provisional(intentar hacerlo en jquery)
 	if($_POST['contraseñaRegistro']==$_POST['repiteContraseña']){
 		$contraseña=$_POST['contraseñaRegistro'];
 		$usuario=$_POST['usuarioRegistro'];
 		$email=$_POST['emailRegistro'];

 		Usuario::registraUsuario($usuario,$contraseña,$email);

 	}
 	else{
 		echo "Las contraseñas deben coincidir";
 	}


 	
 	

 }


 
?>