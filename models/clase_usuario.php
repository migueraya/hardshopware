<?php
 
class Usuario{
     
    private $usuario, $id, $email, $activado;
    //la variable activado será verdadera cuando se verifique cada usuario con su email
 
    function Usuario($user, $pass){
        $mysqli=Conectar::conexion();
 
        $consulta="SELECT * FROM usuarios WHERE user ='".$user."'";
        $result=$mysqli->query($consulta);
        if($row=$result->fetch_array(MYSQLI_ASSOC)){
            if($pass==$row['pass']){
                $this->id=$row['id'];
                $this->usuario=$row['user'];
                $this->contraseña=$row['pass'];
                $this->email=$row['email'];
                $this->activado=$row['activated'];
            }
        }
    }
 
    public function getNombre(){
        return $this->usuario;
    }
 
    public function getId(){
        return $this->id;
    }

    public function getContraseña(){
        return $this->contraseña;
    }

    public function getEmail(){
        return $this->email;
    }


    public function conectado(){
        if ($this->id>0) return true;
        else return false;
    }

    public function activado(){
        if ($this->activado=="true") return true;
        else return false;
    }

 
    public function esAdmin(){
        if ($this->usuario == "admin") return true;
        else return false;
    }

    public function enviarCorreo($email,$usuario,$contraseña){
        $destinatario = $email;
        $titulo = "Bienvenido a HardShopWare";
        $mensaje = '
        ¡Gracias por registrarte en HardShopWare!
        Tus credenciales:

        ------------------------
        Usuario: '.$usuario.'
        ------------------------
         
        Haz click en este link para activar tu cuenta:
        http://localhost/hardshopware/index.php?activar='.$destinatario.'';

        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <hardshopware@admin.com>' . "\r\n";
        $headers .= 'Cc: hardshopware@admin.com' . "\r\n";

        mail($destinatario,$titulo,$mensaje,$headers);
    }

    public function enviarCorreoContacto($email,$usuario,$mensaje){
        $destinatario = "migue.raya98@gmail.com";
        $titulo = "Bienvenido a HardShopWare";
        $mensaje = '
        ¡Gracias por registrarte en HardShopWare!
        Tus credenciales:

        ------------------------
        Usuario: '.$usuario.'
        Contraseña: '.$contraseña.'
        ------------------------
         
        Haz click en este link para activar tu cuenta:
        http://localhost/hardshopware/index.php?activar='.$destinatario.'';

        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <hardshopware@admin.com>' . "\r\n";
        $headers .= 'Cc: hardshopware@admin.com' . "\r\n";

        mail($destinatario,$titulo,$mensaje,$headers);
    }




    public function registraUsuario($usuario,$contraseña,$email){

        $mysqli=Conectar::conexion();

        $consulta="SELECT * FROM usuarios WHERE user='".$usuario."' OR email='".$email."'";
        echo $consulta;
        $result=$mysqli->query($consulta);

        if($row=$result->fetch_array(MYSQLI_ASSOC)){
            header('Location: views/formulario_registro.html');
        }
        else{
                $consulta="INSERT INTO usuarios VALUES (NULL, '".$usuario."', '".$contraseña."','".$email."','' )";
                $result=$mysqli->query($consulta);
                //llamamos al metodo para enviar el correo
                Usuario::enviarCorreo($email,$usuario,$contraseña);
                echo "<h5>Te has registrado correctamente, activa tu cuenta desde tu correo electrónico</h5";
            
            }


    }


    public function editaUsuario($usuario,$contraseña,$email){

        $mysqli=Conectar::conexion();

        $consulta="SELECT * FROM usuarios WHERE user='".$usuario."' AND email='".$email."'";
        $result=$mysqli->query($consulta);

        if($row=$result->fetch_array(MYSQLI_ASSOC)){
            echo "Este usuario ya existe.";
        }
        else{
                $consulta="UPDATE usuarios SET user = '".$usuario."', pass= '".$contraseña."', email= '".$email."' WHERE id =".$_SESSION['login']->getId()." ";
                $result=$mysqli->query($consulta);
                echo "Tus credenciales han sido cambiadas con éxito!";
            }


    }


    public function totalPosts($nombreusuario){

        $mysqli=Conectar::conexion();
        $consulta="SELECT COUNT(*) AS numeroPosts FROM posts WHERE author='".$nombreusuario."'";
        $result=$mysqli->query($consulta);
        if($row=$result->fetch_array(MYSQLI_ASSOC)){
            return $row['numeroPosts'];
        }


    }

     public function totalComentarios($nombreusuario){

        $mysqli=Conectar::conexion();
        $consulta="SELECT COUNT(*) AS numeroComentarios FROM comentarios WHERE author='".$nombreusuario."'";
        $result=$mysqli->query($consulta);
        if($row=$result->fetch_array(MYSQLI_ASSOC)){
            return $row['numeroComentarios'];
        }


    }

    public function totalLikes($idusuario){

        $mysqli=Conectar::conexion();
        $consulta="SELECT COUNT(*) AS numeroLikes FROM likes WHERE id_author='".$idusuario."'";
        $result=$mysqli->query($consulta);
        if($row=$result->fetch_array(MYSQLI_ASSOC)){
            return $row['numeroLikes'];
        }


    }

}
 
?>