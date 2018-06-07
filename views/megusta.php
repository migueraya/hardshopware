<?php
$mysqli=Conectar::conexion();

//$id_post = (int)$_POST["id_post"];
//$id_autor = (int)$_POST["id_autor"];
$proceso = array("error"=>false,"msj_error"=>"","yagusta"=>false,"cantidad"=>0);

//verificamos que los parametros esten correctos
if (empty($id_post) || empty($id_autor)) {
$proceso["error"] = true;
$proceso["msj_error"] = "Ocurrio un error, por favor intentalo de nuevo";
echo json_encode($proceso);
exit();
}

// ya dio me gusta?, indiquemosle al usuario
$yagusto = mysql_query("SELECT COUNT(*) FROM `likes` WHERE id_author=$autor_id AND id_post=$id_post");

if ($yagusto > 0) {
$proceso["error"] = true;
$proceso["msj_error"] = "Ya te gusta esta publicacion";
echo json_encode($proceso);
exit();
}

//Almacenamos el nuevo ME GUSTA
 $consulta_ajax = mysql_query("INSERT INTO `likes` (id_author,id_post) VALUES($id_autor,$id_post");

if ($consulta_ajax) {
$proceso["cantidad"] = mysql_query("SELECT COUNT(*) FROM `likes` WHERE id_post=$id_post");
echo json_encode($proceso);
exit();
}








?>