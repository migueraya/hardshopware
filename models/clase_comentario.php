<?php

class Comentario{

private $autor,$texto;

function Comentario($datos){

	$this->autor=$datos['author'];
	$this->texto=$datos['text'];
}

public function getAutor(){
	return $this->autor;
}

public function getComentario(){
	return $this->texto;
}

public function insertarComentario($idPost,$comentario,$autor){
	$mysqli=Conectar::conexion();
        $consulta="INSERT into comentarios VALUES (NULL, '".$idPost."',  '".$comentario."',  '".$autor."')";
    $result=$mysqli->query($consulta);    
}

public function eliminaComentario($idPost){
	$mysqli=Conectar::conexion();
	$consulta="DELETE FROM comentarios WHERE idPost='".$idPost."'";
	$result=$mysqli->query($consulta);
}

}
?>