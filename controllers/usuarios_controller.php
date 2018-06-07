<?php
 
if(isset($_GET['salir'])){
    unset($_SESSION['login']);
}
 
 
if(isset($_POST['login'])){
    $yo=new Usuario($_POST['usuarioLogin'],md5($_POST['contraseñaLogin']));
    if($yo->conectado()) $_SESSION['login']=$yo;
    else { 
    	header('Location: views/formulario_login.html');
    	echo "Tus datos son incorrectos.";
     }
}
 
 
 if(isset($_POST['registrar'])){
 	
 		$contraseña=md5($_POST['contraseña']);
 		$usuario=$_POST['usuario'];
 		$email=$_POST['email'];
 		Usuario::registraUsuario($usuario,$contraseña,$email);
 }

//comprobación de la contraseña provisional(intentar hacerlo en jquery)
if(isset($_POST['editarCredenciales'])){
	
	if($_POST['contraseña']==$_POST['repiteContraseña']){
		$contraseña=$_POST['contraseña'];
 		$usuario=$_POST['usuario'];
 		$email=$_POST['email'];
 		Usuario::editaUsuario($usuario,$contraseña,$email);
	}


}



 
?>