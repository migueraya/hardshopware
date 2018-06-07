<?php
require_once("../bd.php");
$mysqli=Conectar::conexion();


$id_post=$_REQUEST["postid"];
$nombre_autor=$_REQUEST["autorid"];



//cogemos el id del autor del like a partir de su nombre
$consulta="SELECT * FROM usuarios WHERE user='".$nombre_autor."'";
$result=$mysqli->query($consulta);
if($row=$result->fetch_array(MYSQLI_ASSOC)){
	$id_autor=$row['id'];
}

// ya dio me gusta?, indiquemosle al usuario
$consulta="SELECT COUNT(*) as tienelike FROM likes WHERE id_author=".$id_autor." AND id_post=".$id_post."";
$result = $mysqli->query($consulta);
if($row=$result->fetch_array(MYSQLI_ASSOC)){
	if($row['tienelike']>0){
		echo "ya existe";
		die();	
	}
	else {
		//Almacenamos el nuevo ME GUSTA
		$consulta_ajax ="INSERT INTO `likes` (id_author,id_post) VALUES($id_autor,$id_post)";
		$result=$mysqli->query($consulta_ajax);
		if ($result) {
			$consultaCantidad="SELECT COUNT(*) as cantidad FROM likes WHERE id_post=".$id_post."";
			$result = $mysqli->query($consultaCantidad);
			$row=$result->fetch_array(MYSQLI_ASSOC);
			$cantidad=$row['cantidad']-1;
			echo $cantidad;
			exit();
		}

	}
}	




?>