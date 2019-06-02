<?php
 if($_SERVER['REQUEST_METHOD']=='POST'){
     $clave = sha1(rand(0000,9999).rand(00,99));
     $nombre = htmlentities($_POST['nombreNuevaImagen']);
     $ruta = $_FILES['enlaceNuevaImagen']['tmp_name'];
     $imagen = $_FILES['enlaceNuevaImagen']['name'];

     if($ruta != ''){
        $info = pathinfo($imagen);
        $tamanio = getimagesize($ruta);
        $width = $tamanio[0];
        $heigth = $tamanio[1];
          
        if($info['extension'] == 'jpg' || $info['extension'] == 'JPG' || $info['extension'] == 'jpeg' || $info['extension'] == 'JPEG'){
         $imagenSubida = imagecreatefromjpeg($ruta);
         $imagenConvertida = imagecreatetruecolor($width,$heigth);
         imagecopyresampled($imagenConvertida,$imagenSubida,0,0,0,0,$width,$heigth,$width,$heigth);
         $copia = 'view/presentacion/archivos/'.$clave.'.jpg';
         imagejpeg($imagenConvertida,$copia);
        }else if($info['extension'] == 'png' || $info['extension'] == 'PNG'){
            $imagenSubida = imagecreatefrompng($ruta);
            $imagenConvertida = imagecreatetruecolor($width,$heigth);
            imagecopyresampled($imagenConvertida,$imagenSubida,0,0,0,0,$width,$heigth,$width,$heigth);
            $copia = 'view/presentacion/archivos/'.$clave.'.png';
            imagepng($imagenConvertida,$copia);
        }
     }
 }
 echo $copia;
 require_once $_SERVER["DOCUMENT_ROOT"].'/Citas_Ufps/model/conexion.php';
 $conexion = Conexion::crearConexion();
 $consulta = $conexion->prepare('INSERT INTO imagenes_anuncios (nombre,archivo) VALUES (?,?)');
 $consulta->bindParam(1, $nombre, PDO::PARAM_STR);
 $consulta->bindParam(2, $copia, PDO::PARAM_STR);
 $consulta->execute();
 header("location:administrador_imagenes");
?>