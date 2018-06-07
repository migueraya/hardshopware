<?php

class producto {

private $id,$nombre,$precio,$categoria,$imagen,$votos;
/*NUEVO*/
function producto($datos){
	
	$this->id=$datos['id'];
	$this->nombre=$datos['name'];
	$this->precio=$datos['price'];
	$this->categoria=$datos['category'];
	$this->imagen=$datos['image'];
	$this->votos=producto::calcularMedia($datos['id']);
	$this->ventas=$datos['sales'];

}


public function getId(){
	return $this->id;
}

public function getNombre(){
	return $this->nombre;
}

public function getPrecio(){
	return $this->precio;
}

public function getCategoria(){
	return $this->categoria;
}

public function getImagen(){
	return $this->imagen;
}

public function getVotos(){
	return $this->votos;
}

public function getVentas(){
	return $this->ventas;
}

public function imprimeImagen($imagen){
	echo "<img src='".$imagen."' alt='producto' height='42' width='42'>";
}


public function insertaProducto($nombre,$precio,$categoria,$imagen){
	
	$mysqli=Conectar::conexion();
	$consulta="INSERT INTO products VALUES('','".$nombre."','".$precio."','".$categoria."','".$imagen."','','')";
	$result=$mysqli->query($consulta);
	echo "El producto se ha añadido correctamente";
}

public function obtenerProductos(){
	$mysqli=Conectar::conexion();
	$consulta="SELECT * FROM products";
	$result=$mysqli->query($consulta);
 
	while($row=$result->fetch_array(MYSQLI_ASSOC)){
    	$lista_productos[]=new producto($row);
    }

}
//funcion para imprimir el nombre y la categoria del producto al que pertenece cada reseña
public function obtenerProducto($idProducto){
	$mysqli=Conectar::conexion();
	$consulta="SELECT * FROM products WHERE id=".$idProducto."";
	$result=$mysqli->query($consulta);
	$row=$result->fetch_array(MYSQLI_ASSOC);
    $nombre=$row['name'];
    $categoria=$row['category'];

    $resultado=$nombre." en ".$categoria;
    return $resultado;

}



public function eliminaProducto($id){
	$mysqli=Conectar::conexion();
	$consulta="DELETE FROM products WHERE id=' ".$id."'";
	$result=$mysqli->query($consulta);
	echo "El producto se he eliminado correctamente";
}


/* nuevo */
public function calcularMedia($idProducto){
	$mysqli=Conectar::conexion();
	$consulta="SELECT * FROM votes WHERE id_producto=".$idProducto."";
	$result=$mysqli->query($consulta);
	$contador=0;
	$sumaVotos=0;
	while($row=$result->fetch_array(MYSQLI_ASSOC)){
		$contador++;
		$sumaVotos+=$row['voto'];
	}
	$media=$sumaVotos/$contador;
	return $media;

}


}

?>