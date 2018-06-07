<?php
require_once('models/clase_usuario.php');
require_once('models/clase_post.php');
require_once('models/clase_comentario.php');
require_once('models/clase_producto.php');
session_start();
$mysqli=Conectar::conexion();
require_once("usuarios_controller.php");
require_once("contacto.php");
require_once("verificacion.php");
require_once("posts_controller.php");
require_once("products_controller.php");


require_once("views/vista_principal.html");
?>