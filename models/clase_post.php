<?php

class post {


private $id,$titulo,$texto,$fecha,$idProducto;
private $comentarios=array();


function post($datos){

	//consulta en la base de datos para asignar las variables
	$this->id=$datos['id'];
	$this->titulo=$datos['tittle'];
	$this->texto=$datos['text'];
	$this->fecha=$datos['date'];
	$this->autor=$datos['author'];
	$this->idProducto=$datos['id_product'];

	$mysqli=Conectar::conexion();
	$consulta="SELECT * FROM comentarios WHERE idPost='".$this->id."'";
	$result=$mysqli->query($consulta);
	while($row=$result->fetch_array(MYSQLI_ASSOC)){
		$this->comentarios[]=new Comentario($row);
	}

}

public function getId(){
	return $this->id;
}



public function getTitulo(){
	return $this->titulo;
}

public function getTexto(){
	return $this->texto;
}

public function getFecha(){
	return $this->fecha;
}

public function getAutor(){

	return $this->autor;

}

public function getComentarios(){
	return $this->comentarios;
}

public function getIdProducto(){
	return $this->idProducto;
}


/* modificado */

public function insertaPost($titulo,$texto,$fecha,$autor,$idProducto,$voto){
	$mysqli=Conectar::conexion();
	$consulta="INSERT INTO posts VALUES('','".$titulo."','".$texto."','".$fecha."','".$autor."','".$idProducto."')";
	$consulta2="INSERT INTO votes VALUES('','".$idProducto."','".$voto."')";
	if( ($result=$mysqli->query($consulta)) && ($result2=$mysqli->query($consulta2)) ){
		echo "Reseña insertado correctamente";
	}
	else{
		echo "No se ha podido insertar la reseña";
	}
			
}

public function editaPost($titulo,$texto,$fecha,$autor,$idProducto,$idPost){
	$mysqli=Conectar::conexion();
	$consulta="UPDATE posts SET tittle = '".$titulo."', text= '".$texto."', date= '".$fecha."', author= '".$autor."', id_product= '".$idProducto."' WHERE id =".$idPost."";
    $result=$mysqli->query($consulta);
    echo "Tu post ha sido actualizado con éxito!";
	
	
	
}


public function eliminaPost($id){
	$mysqli=Conectar::conexion();
	$consulta="DELETE FROM posts WHERE id=' ".$id."'";
	$result=$mysqli->query($consulta);
	echo "La entrada se he eliminado correctamente";
}

//fecha 2011/11/15 --> 15 de noviembre de 2011 
public function formateaFecha($fecha){


		$array=explode("-",$fecha);
		$numeromes=$array[1];
		$dia=$array[2];
		$año=$array[0];

		if($numeromes<10){
			$numeromes=substr($numeromes,1);
		}

		$meses=array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");

		$mes=$meses[$numeromes-1];
		 
		$fecha=$dia . " de " . $mes ." de ".$año;

		return $fecha;

}



public function numeroLikes($idPost){
	$mysqli=Conectar::conexion();
	$consulta="SELECT COUNT(*) as numeroLikes FROM likes WHERE id_post=".$idPost."";
	$result=$mysqli->query($consulta);
	if($row=$result->fetch_array(MYSQLI_ASSOC)){
		$numeroLikes=$row['numeroLikes'];
			return $numeroLikes;
	}
			
}

public function yamegusta($idPost){
	$id=$idPost;
	$mysqli=Conectar::conexion();
	$consulta="SELECT * FROM likes WHERE id_post=".$idPost." AND id_author=".$_SESSION['login']->getId()."";
	$result=$mysqli->query($consulta);
	if($row=$result->fetch_array(MYSQLI_ASSOC)){
			echo '<a href="#" style="color:red" id="yamegusta" id_post="'.$id.'" id_autor="'.$_SESSION['login']->getNombre().'"><span class="glyphicon glyphicon-thumbs-up"></span>Me Gusta <span id="cantidad">('.post::numeroLikes($id).')</span></a>';
	}
	else{
		echo '<a href="#" id="megusta" id_post="'.$id.'" id_autor="'.$_SESSION['login']->getNombre().'"><span class="glyphicon glyphicon-thumbs-up"></span>Me Gusta <span id="cantidad">('.post::numeroLikes($id).')</span></a>';
	}
}

public function ultimosPosts($numero){

	$mysqli=Conectar::conexion();

	$consulta="SELECT * FROM posts ORDER BY id DESC limit ".$numero."";
	
	$result=$mysqli->query($consulta);

	while($row=$result->fetch_array(MYSQLI_ASSOC)) {
		echo "<hr>";
		echo "<h2>".$row['tittle']."</h2>";
		echo '<h4><span class="glyphicon glyphicon-time"></span> Post de <b>'.$row['author'].'</b>,  <span style="color:#23527c">'.
		post::formateaFecha($row['date']).'</span></h4>';
		echo '<h5 class="namCat" ><i class="fa">&#xf288;</i> Reseña de  <b>'. producto::obtenerProducto($row['id']).'</b></h5>';
		echo "<p>".$row['text']."</p>";
		//imprimimos comentarios
		$consulta2="SELECT * FROM comentarios WHERE idPost='".$row['id']."'";
		$result2=$mysqli->query($consulta2);

		$numeroComentarios=$result2->num_rows;
		echo "<hr>";	
		echo '<p><span class="badge">'.$numeroComentarios.'</span> Comentarios:</p><br>';
		while($row2=$result2->fetch_array(MYSQLI_ASSOC)){
			echo '<div class="col-sm-2 text-center">';
          echo '<img src="imagenes/imagen_usuario.png" class="img-circle" height="85" width="85" alt="Avatar">';
        echo '</div>';
        echo '<div class="col-sm-10">';
        echo '<h4><b>'.$row2['author'].'</b><small> dice: </small></h4>';
        echo '<p>'.$row2['text'].'</p>';
        echo '<hr>';
    	echo '</br>';
    	echo '</div>';
    	echo '</hr>';
  	 	}
	
	echo "<b><span>¿Quieres comentar o añadir un post como este? </span></b>";
	echo '<a href="index.php?blog"> Ir al blog </a>';
}

}

}

?>