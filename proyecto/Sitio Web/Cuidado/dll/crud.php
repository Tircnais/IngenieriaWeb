<?php
    include("mysql.php");
    $miconexion = new DB_mysql;
    //$miconexion->conectar("cuidado", "127.0.0.1", "root", "");
    echo "<script>alert('CRUD PHP')</script>";
    extract($_POST);
    $nombre = $nombre;
    $apellido = $apellido;
    $u = $usuario;
    $c = $clave;
    $correo = $correo;
    if ($uid == "add"){
        //agregar
        $sqlinsert = 'INSERT INTO usuarios (nombre, apellido, usuario, clave, correo) VALUES ("'.$nombre.'", "'.$apellido.'", "'.$u.'", "'.$c.'", "'.$correo.'")';
        $miconexion->consulta($sqlinsert);
        //echo $sqlinsert;
    } else {
        switch ($accion) {
            case "update":
                $sqledit = 'UPDATE usuarios SET nombre="'.$nombre.'", apellido="'.$apellido.'", usuario="'.$u.'", clave="'.$c.'", correo="'.$correo.'" WHERE uid="'.$uid.'"';
                //echo $sqledit;
                $miconexion->consulta($sqledit);
                break;
            case "delete":
                //eliminar
                $sqldelete = 'DELETE FROM usuarios WHERE uid='.$uid;
                $miconexion->consulta($sqldelete);
                break;
        }
    }
    
?>
