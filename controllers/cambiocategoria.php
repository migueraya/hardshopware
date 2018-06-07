
<?php
require_once("../bd.php");
$mysqli=Conectar::conexion();

$categoria=$_REQUEST["categoria"];

$consulta="SELECT * FROM products WHERE category='".$categoria."'";
$result=$mysqli->query($consulta);
while($row=$result->fetch_array(MYSQLI_ASSOC)){
	$productos[]=$row['name'];
}

$productos=json_encode($productos);
echo $productos;



?>