<?php 

$consulta="SELECT * FROM posts";
$result=$mysqli->query($consulta);
 
while($row=$result->fetch_array(MYSQLI_ASSOC)){
    	$lista_post[]=new post($row);
    }


//consultas personalizadas para el blog 

   if(isset($_POST['ordenar'])&& isset($_POST['ascdesc']) ){
   		$orden1=$_POST['ordenarPosts'];
   		$orden2=$_POST['ascdesc'];
   		$consulta="SELECT * FROM posts ORDER BY ".$orden1 ." ". $orden2."";
   		echo $consulta;
   		$result=$mysqli->query($consulta);
		while($row=$result->fetch_array(MYSQLI_ASSOC)){
    		$posts_ordenados[]=new post($row);

    	}
 
   } 



if(isset($_POST['postearAdmin'])){

	$consulta="SELECT id FROM products WHERE name ='".$_POST['selectProducto']."'";
	$result=$mysqli->query($consulta);
	$row=$result->fetch_array(MYSQLI_ASSOC);
		$idProducto=$row['id'];
		post::insertaPost($_POST['tituloAdmin'],$_POST['textoAdmin'],$_POST['fechaAdmin'],$_POST['autorAdmin'],$idProducto,$_POST['votoAdmin']);
		
}


if(isset($_POST['comentar'])){
	Comentario::insertarComentario($_POST['idPost'],$_POST['comentario'],$_POST['autorComentario']);
}

//eliminar post desde administración
if(isset($_GET['admin']) && isset($_GET['eliminaPost']) ){
	post::eliminaPost($_GET['eliminaPost']);
	//también eliminamos los comentarios asociados a ese post
	Comentario::eliminaComentario($_GET['eliminaPost']);
}
//eliminar post desde el perfil
if(isset($_GET['perfil']) && isset($_GET['eliminaPost']) ){
	post::eliminaPost($_GET['eliminaPost']);
	//también eliminamos los comentarios asociados a ese post
	Comentario::eliminaComentario($_GET['eliminaPost']);
}
//editar post
if(isset($_POST['actualizarPost'])){
	$consulta="SELECT id FROM products WHERE name ='".$_POST['selectProducto']."'";
	$result=$mysqli->query($consulta);
	$row=$result->fetch_array(MYSQLI_ASSOC);
		$idProducto=$row['id'];
		post::editaPost($_POST['titulo'],$_POST['texto'],$_POST['fecha'],$_POST['autor'],$idProducto,$_POST['idPost']);
}
//obtenemos todos los posts
$consulta="SELECT * FROM posts";
$result=$mysqli->query($consulta);
 
while($row=$result->fetch_array(MYSQLI_ASSOC)){
    	$lista_post[]=new post($row);
    }

?>