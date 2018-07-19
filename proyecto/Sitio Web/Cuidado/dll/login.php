<?php
    include("mysql.php");
    $miconexion = new DB_mysql;
	//$miconexion->conectar("cuidado", "127.0.0.1", "root", "");
    echo "<script>alert('Login PHP')</script>";
    extract($_POST);
    //echo $usuario;
    //echo $clave;
    $u = $usuario;
    $c = $clave;
    echo $u.", ".$c."<br>";
    $Consulta_ID;
	if(isset($u) && isset($c)){
        $enlace=mysqli_connect("127.0.0.1", "root", "") or die('No se pudo conectar a la db'.mysqli_error());
        $sql="SELECT usuario, correo, clave  FROM usuarios WHERE usuario = '".$u."' OR correo= '".$u."' AND clave = '".$c."'";
        echo $sql;
        $Consulta_ID=mysqli_query($enlace, $sql);
        echo $Consulta_ID;
        if(!$Consulta_ID){
            //AKI ver el error
            $Errno=mysql_errno();
        }
        $user="";
        $corre="";
        $password="";
        while ($row=mysqli_fetch_array($Consulta_ID, MYSQLI_ASSOC)) {
            $user=$row['usuario'];
            $correo=$row['correo'];
            $password=$row['clave'];
            echo $user.", ".$password;
        }
        if ($u == $user && $c == $password) {
            echo "<script>alert('Usuario y Contraseña correctos..')</script>";
            echo "<script>location.href='sidebar-left.php'</script>";
        }else{
            echo "<script>alert('Usuario y Contraseña incorrectos...')</script>";
            echo "<script>location.href='../signin.html'</script>";
        }
    }
    
?>

