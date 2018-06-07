<?php

if(isset($_GET['activar'])){
	$consulta="SELECT * FROM usuarios WHERE email='".$_GET['activar']."'";
	$result=$mysqli->query($consulta);
	if($row=$result->fetch_array(MYSQLI_ASSOC)){
		if($row['activated']=="true") echo "¡UPS! Tu cuenta ya estaba activada";
		else{
			$query="UPDATE usuarios SET activated='true' WHERE id=".$row['id']."";
			$result=$mysqli->query($query);
			echo "Gracias por verificar tu cuenta, ".$row['user']."";
		}
		
	}
}



?>