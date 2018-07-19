<?php
    header( 'Content-Type: text/html;charset=utf-8' );
    $localhost="http://127.0.0.1/";
    $usuario="root";
    $clave="";
    $baseDatos="cuidado";
    function ejecutarSQLCommand($commando){
        $mysqli = new mysqli("127.0.0.1", "root", "", "cuidado") or die('No se pudo conectar a la db'.mysqli_error());
        //$enlace=mysqli_connect("127.0.0.1", "root", "") or die('No se pudo conectar a la db'.mysqli_error());
        /* check connection */
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
        if ($mysqli->multi_query($commando)) {
             if ($resultset = $mysqli->store_result()) {
                while ($row = $resultset->fetch_array(MYSQLI_BOTH)) {
                    
                }
                $resultset->free();
             }
        }
        $mysqli->close();
    }

    function getSQLResultSet($commando){
        $mysqli = new mysqli("127.0.0.1", "root", "", "cuidado") or die('No se pudo conectar a la db'.mysqli_error());
        //$mysqli = new mysqli("localhost", "root", "", "cuidado");
        /* check connection */
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
        if ($mysqli->multi_query($commando)) {
            return $mysqli->store_result();
        }
        $mysqli->close();
    }

?>