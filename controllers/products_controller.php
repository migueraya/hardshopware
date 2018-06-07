<?php



if(isset($_GET['salir'])){

      unset($_SESSION['carrito']);
}

if(!isset($_SESSION['carrito'])){
  $_SESSION['carrito']=array();
}


if(isset($_GET['comprar'])){
  array_push($_SESSION['carrito'], $_GET['comprar']);
}

print_r($_SESSION['carrito']);

if(isset($_GET['carrito']) && isset($_GET['quitar'])){
  $posicion=array_search($_GET['quitar'], $_SESSION['carrito']);
  unset($_SESSION['carrito'],$posicion);
}

//print_r($_SESSION['carrito']);


//añadir producto
if(isset($_POST['añadirProducto']) ){
	producto::insertaProducto($_POST['nombreProducto'],$_POST['precioProducto'],$_POST['categoriaProducto'],$_POST['imagenProducto']);
}

if(isset($_GET['admin']) && isset($_GET['eliminaProducto']) ){
	producto::eliminaProducto($_GET['eliminaProducto']);
	//también eliminamos los comentarios asociados a ese post

}



$consulta="SELECT * FROM products";
$result=$mysqli->query($consulta);

while($row=$result->fetch_array(MYSQLI_ASSOC)){
      $lista_productos[]=new producto($row);
    }


if(isset($_POST['ordenarProductos'])){
	if(isset($_POST['ordenarProducts'])&& isset($_POST['ascdesc']) ){
   		$orden1=$_POST['ordenarProducts'];
   		$orden2=$_POST['ascdesc'];
   		$consulta="SELECT * FROM products ORDER BY ".$orden1 ." ". $orden2."";
   		echo $consulta;
   		$result=$mysqli->query($consulta);
		while($row=$result->fetch_array(MYSQLI_ASSOC)){
    		$productos_ordenados[]=new producto($row);

    	}
 
   } 
}




?>