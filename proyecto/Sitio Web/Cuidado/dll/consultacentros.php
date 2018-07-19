<?php
    include("mysql.php");
    $miconexion = new DB_mysql;
    /*identificacion de error y texto de error*/
    $Errno = 0;
    $Error = "";
    $enlace=0;
    $Consulta_ID;
    $BaseDatos="cuidado";
    $servidor="127.0.0.1";
    $usuario="root";
    $clave="";
    $sql = "SELECT * FROM centros limit 10";
    $enlace=mysqli_connect($servidor, $usuario, $clave) or die('No se pudo conectar a la db'.mysqli_error());
    if(!$enlace){
        $Error="Ha fallado la conexion";
        return 0;
    }
    //mysqli_select_db($link,$db_name) or die ('No se puede seleccionar la base de datos');
    if(!mysqli_select_db($enlace, $BaseDatos)){
        $Error="Imposible abrir la base de datos";
        return 0;
    }
    $Consulta_ID=consulta($sql, $enlace);
    verapp($Consulta_ID);
    
    /*
    if($resultset=getSQLResultSet("SELECT * FROM centros")){
        //create array
        $resultarray = array();
        while($row = $resultset->fetch_array(MYSQLI_NUM)){
            $resultarray[] = $row;
        }
        echo json_encode($resultarray);
    }else{
        echo "no entro";
    }
    */
    function consulta($sql="", $enlace){
        if($sql==""){
            $Error="NO hay ninguna sentencia sql";
            return 0;
        }
        /*Ejecutar la cunsulta*/
        $Consulta_ID=mysqli_query($enlace, $sql);
        if(!$Consulta_ID){
            //AKI ver el error
            $Errno=mysql_errno();
            //$Errno="error";
        }
        return $Consulta_ID;
    }
    /*retorna el numero de campos de la consulta*/
    function numcampos(){
        return mysqli_num_fields($Consulta_ID);
    }
    /*retorna de campos de la consulta*/
    function numregistros(){
        //VISTA en pantalla
        return mysqli_num_rows($Consulta_ID);
    }

    /*nombre de los campos*/
    function nombrecampo($numcampos){
        //mysql_field_name
        return mysqli_fetch_field_direct($Consulta_ID, $numcampos);
    }
    
    function verapp($Consulta_ID){
        $resultarray = array();
        while ($row=mysqli_fetch_array($Consulta_ID, MYSQLI_ASSOC)) {
            //$numcampos = numcampos();
            $a = array();
            $numcampos = mysqli_num_fields($Consulta_ID);
            for ($i=1; $i < $numcampos; $i++) {
                $campo = mysqli_fetch_field_direct($Consulta_ID, $i);
                //$campo = nombrecampo($i);
                $campo = $campo->name;
                // || $campo == "Latitud" || $campo == "Longitud"
                if ($campo == "nombre" || $campo == "Latitud" || $campo == "Longitud"){
                    $campo = utf8_encode($row[$campo]);
                    //$a["nombre"]=$campo;
                    array_push($a, $campo);
                    //echo $campo."<br>";
                    //$resultarray[]=$campo;
                }
                /*
                if ($campo == "Latitud"){
                    $campo = utf8_encode($row[$campo]);
                    $a["Latitud"]=$campo;
                }
                if ($campo == "Longitud"){
                    $campo = utf8_encode($row[$campo]);
                    $a["Longitud"]=$campo;
                }
                */
            }
            array_push($resultarray, $a);
            /*
            foreach($resultarray as $campo){
                array_push($resultarray, $campo);
            }
            */
        }
        //echo $resultarray;
        echo json_encode($resultarray);
        //echo "longitud:\t".sizeof($resultarray);
        $Consulta_ID->close();
        //comentar si hay fallo
    }
    
?>
