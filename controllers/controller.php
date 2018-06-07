<?php

require_once("models/clase_usuario.php");
session_start();

$mysqli=Conectar::conexion();


if(isset($_POST['insertar'])){

	if($_POST['nombre']!=''||$_POST['email']!=''||$_POST['pass']!=''){
		Usuario::insertarUsuario($_POST['nombre'],$_POST['email'],$_POST['pass']);
	}

	else echo "No puedes insertar un usuario nulo,crack";


}


$consulta="SELECT * FROM usuarios";
$result=$mysqli->query($consulta);
while($row=$result->fetch_array(MYSQLI_ASSOC)){
	$lista_usuarios[]=new Usuario($row);
}


require_once("views/vista_principal.html");


?>