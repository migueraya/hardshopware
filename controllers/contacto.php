<?php

//cuando envian algo por el formulario de contacto
if(isset($_POST['enviarContacto'])){
	$consulta="INSERT INTO contacto VALUES('','".$_POST['nombreContacto']."','".$_POST['emailContacto']."','".$_POST['comentarioContacto']."')";
	if($result=$mysqli->query($consulta)){
		echo "<span style='text-align:center'>Gracias por contactar con nosotros, tus opiniones son importantes para HardShopWare</span>";
	}


}

?>