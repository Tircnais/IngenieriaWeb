<?php
    //include("config.php");
    /*
	$link = mysqli_connect($host, $user, $pass) or die('No se pudo conectar a la db'.mysqli_error());
	mysqli_select_db($link,$db_name) or die ('No se puede seleccionar la base de datos');
	$enlace = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	if ($enlace) {
		echo "string1244";
	}
    
    $uid=$_GET['uid'];
    $mensaje = "";
    if ($uid == "")
        $mensaje .= '<script name="accion">alert("ID SELECCIONADO '.$uid.'") </script>';
    */
    class DB_mysql{
        /*variables de conexoion*/
        var $BaseDatos;
        var $Servidor;
        var $Usuario;
        var $Clave;

        /*identificacion de error y texto de error*/
        var $Errno = 0;
        var $Error = "";

        /*identificacion de conexion y consulta*/
        var $enlace=0;
        var $Consulta_ID;

        /*constructor de la clase*/
        function DB_mysql($db="", $host="", $user="", $pass=""){
            $this->BaseDatos=$db;
            $this->Servidor=$host;
            $this->Usuario=$user;
            $this->Clave=$pass;
            
            //$this->conectar($db, $host, $user, $pass);
        }

        /*conexion al servidor de db*/
        function conectar($db, $host, $user, $pass){
            if($db != "")$this->BaseDatos=$db;
            if($host != "")$this->Servidor=$host;
            if($user != "")$this->Usuario=$user;
            if($pass != "")$this->Clave=$pass;
            /*conectar al servidor*/
            $this->enlace=mysqli_connect($this->Servidor, $this->Usuario, $this->Clave) or die('No se pudo conectar a la db'.mysqli_error());
            if(!$this->enlace){
                $this->Error="Ha fallado la conexion";
                return 0;
            }
            
            //mysqli_select_db($link,$db_name) or die ('No se puede seleccionar la base de datos');
            if(!mysqli_select_db($this->enlace, $this->BaseDatos)){
                $this->Error="Imposible abrir la base de datos";
                return 0;
            }
            return $this->enlace;
        }

        function consulta($sql=""){
            if($sql==""){
                $this->Error="NO hay ninguna sentencia sql";
                return 0;
            }
            /*Ejecutar la cunsulta*/
            $this->Consulta_ID=mysqli_query($this->enlace, $sql);
            if(!$this->Consulta_ID){
                //AKI ver el error
                $this->Errno=mysql_errno();
                //$this->Errno="error";
            }
            return $this->Consulta_ID;
        }

        /*retorna el numero de campos de la consulta*/
        function numcampos(){
            return mysqli_num_fields($this->Consulta_ID);
        }

        /*retorna de campos de la consulta*/
        function numregistros(){
            //VISTA en pantalla
            echo mysqli_num_rows($this->Consulta_ID);
            return mysqli_num_rows($this->Consulta_ID);
        }

        /*nombre de los campos*/
        function nombrecampo($numcampos){
            //mysql_field_name
            return mysqli_fetch_field_direct($this->Consulta_ID, $numcampos);
        }

        function verconsulta(){
            echo "<table class='table table-bordered'>";
            echo "<tr>";
            for ($i=1; $i < $this->numcampos() ; $i++) {
                $campo = $this->nombrecampo($i);
                $campo = $campo->name;
                echo "<th class='success text-center'>".ucwords($campo)."</th>";
            }
            echo "</tr>";
            while ($row=mysqli_fetch_array($this->Consulta_ID, MYSQLI_ASSOC)) {
                echo "<tr>";
                for ($i=1; $i < $this->numcampos(); $i++) {
                    $campo = $this->nombrecampo($i);
                    $campo = $campo->name;
                    echo "<td class='info'>".utf8_encode($row[$campo])."</td>";
                    //utf8_encode MANEJO de caracteres especiales
                }
                echo "</tr>";
            }
            echo "</table>";
            $this->Consulta_ID->close();
            //comentar si hay fallo
        }
        
        function ver(){
            while ($row=mysqli_fetch_array($this->Consulta_ID, MYSQLI_ASSOC)) {
                $centro ="";
                for ($i=1; $i < $this->numcampos(); $i++) {
                    $campo = $this->nombrecampo($i);
                    $campo = $campo->name;
                    //utf8_encode MANEJO de caracteres especiales
                    switch($campo){
                        case "TituloRuta":
                            echo utf8_encode($row[$campo])."<br><br>";
                            break;
                        case "nombre":
                            $centro = utf8_encode($row[$campo]);
                            break;
                        case "direccion":
                            echo $centro.", ".utf8_encode($row[$campo])."<br><br>";
                            break;
                        case "nombreC":
                            echo utf8_encode($row[$campo])."<br><br>";
                            break;
                    }
                }
            }
            $this->Consulta_ID->close();
            //comentar si hay fallo
        }
        
        function crudUsuarios(){
            echo "<table class='table table-bordered'>";
            echo "<tr>";
            for ($i=1; $i < $this->numcampos() ; $i++) {
                $campo = $this->nombrecampo($i);
                $campo = $campo->name;
                echo "<th class='success'>".ucwords($campo)."</th>";
            }
            echo "<th class='success'>EDITAR</th>";
            echo "<th class='success'>ELIMINAR</th>";
            echo "</tr>";
            while ($row=mysqli_fetch_array($this->Consulta_ID, MYSQLI_ASSOC)) {
                echo "<tr>";
                for ($i=1; $i < $this->numcampos(); $i++) { 
                    $campo = $this->nombrecampo($i);
                    $campo = $campo->name;
                    echo "<td>".$row[$campo]."</td>";
                    //echo "<td><input class='form-control input-sm' type='text' name='dato' id='datoU".$row["uid"]."' value='".$row[$campo]."' disabled='disabled'><input type='hidden' id='".$row["uid"]."' value='".$row[$campo]."'/></td>";
                    $j= $this->numcampos() - 1;
                    if($i == $j){
                        echo "<td><button id='".$row["uid"]."' type='button' class='btn btn-warning btn-xs-1 btn-block' data-toggle='modal' data-target='#myModal".$row["uid"]."' ><span id='iconoU' class='icon-pencil2'></span></button></td>";
                        echo "<td><button id='crud' type='button' class='btn btn-danger btn-xs-1 btn-block'><input type='hidden' name='uid' value=".$row['uid']."><input type='hidden' name='accion' value='delete'/><span id='icono' class='icon-bin'></span></button></td>";
                    }
                }
                echo "</tr>";
                echo "<div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' id='myModal".$row['uid']."' aria-hidden='true'><div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h4 class='modal-title text-center' id='myModalLabel'>Editar</h4></div><div class='modal-body'><form method='POST' action='dll/crud.php'><div class='form-group'>";
                for ($i=1; $i < $this->numcampos(); $i++) { 
                    $campo = $this->nombrecampo($i);
                    $campo = $campo->name;
                    echo "<label for='".$campo."".$row['uid']."'>".ucwords($campo)."</label><input class='form-control input-sm' id='".$campo."".$row['uid']."' name='".$campo."' value='".$row[$campo]."'><br>";
                }
                echo "</div><button type='submit' class='btn btn-primary center-block' data-dismiss='modal'><input type='hidden' name='uid' value='".$row["uid"]."'><input type='hidden' name='accion' value='update'>ACTUALIZAR</button></form></div></div></div></div>";
            }
            echo "</table>";
            //comentar si hay fallo
        }
        
        
        function crudCategorias(){
            echo "<table class='table table-bordered'>";
            echo "<tr>";
            for ($i=1; $i < ($this->numcampos()-1); $i++) {
                $campo = $this->nombrecampo($i);
                $campo = $campo->name;
                echo "<th class='success'>".ucwords($campo)."</th>";
            }
            echo "<th class='success'>EDITAR</th>";
            echo "<th class='success'>ELIMINAR</th>";
            echo "</tr>";
            while ($row=mysqli_fetch_array($this->Consulta_ID, MYSQLI_ASSOC)) {
                echo "<tr>";
                for ($i=1; $i < ($this->numcampos()-1); $i++) { 
                    $campo = $this->nombrecampo($i);
                    $campo = $campo->name;
                    echo "<td>".$row[$campo]."</td>";
                    $j= $this->numcampos() - 2;
                    if($i == $j){
                        echo "<td><button id='".$row["idC"]."' type='button' class='btn btn-warning btn-xs-1 btn-block' data-toggle='modal' data-target='#modalCat".$row["idC"]."' ><span id='iconoU' class='icon-pencil2'></span></button></td>";
                        echo "<td><button id='crud' type='button' class='btn btn-danger btn-xs-1 btn-block'><input type='hidden' name='uid' value=".$row['idC']."><input type='hidden' name='accion' value='delete'/><span id='icono' class='icon-bin'></span></button></td>";
                    }
                }
                echo "</tr>";
                echo "<div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' id='modalCat".$row['idC']."' aria-hidden='true'><div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h4 class='modal-title text-center' id='myModalLabel'>Editar</h4></div><div class='modal-body'><form method='POST' action='dll/crud.php'><div class='form-group'>";
                for ($i=1; $i < $this->numcampos(); $i++) { 
                    $campo = $this->nombrecampo($i);
                    $campo = $campo->name;
                    echo "<label for='".$campo."".$row['idC']."'>".ucwords($campo)."</label><input class='form-control input-sm' id='".$campo."".$row['idC']."' name='".$campo."' value='".$row[$campo]."'><br>";
                }
                echo "</div><button type='submit' class='btn btn-primary center-block' data-dismiss='modal'><input type='hidden' name='uid' value='".$row["idC"]."'><input type='hidden' name='accion' value='update'>ACTUALIZAR</button></form></div></div></div></div>";
            }
            echo "</table>";
            //$this->Consulta_ID->close();
        }
        
        function crudCentros(){
            echo "<table class='table table-bordered'>";
            echo "<tr>";
            for ($i=3; $i < $this->numcampos() ; $i++) {
                $campo = $this->nombrecampo($i);
                $campo = $campo->name;
                echo "<th class='success'>".ucwords($campo)."</th>";
            }
            echo "<th class='success'>EDITAR</th>";
            echo "<th class='success'>ELIMINAR</th>";
            echo "</tr>";
            while ($row=mysqli_fetch_array($this->Consulta_ID, MYSQLI_ASSOC)) {
                echo "<tr>";
                for ($i=3; $i < $this->numcampos(); $i++) { 
                    $campo = $this->nombrecampo($i);
                    $campo = $campo->name;
                    echo "<td>".ucwords($row[$campo])."</td>";
                    $j= $this->numcampos() - 1;
                    if($i == $j){
                        echo "<td><button id='".$row["idCentro"]."' type='button' class='btn btn-warning btn-xs-1 btn-block' data-toggle='modal' data-target='#modalCentro".$row["idCentro"]."' ><span id='iconoU' class='icon-pencil2'></span></button></td>";
                        echo "<td><button id='crud' type='button' class='btn btn-danger btn-xs-1 btn-block'><input type='hidden' name='uid' value=".$row['idCentro']."><input type='hidden' name='accion' value='delete'/><span id='icono' class='icon-bin'></span></button></td>";
                    }
                }
                echo "</tr>";
                echo "<div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' id='modalCentro".$row['idCentro']."' aria-hidden='true'><div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h4 class='modal-title text-center' id='myModalLabel'>Editar</h4></div><div class='modal-body'><form method='POST' action='dll/crud.php'><div class='form-group'>";
                for ($i=1; $i < $this->numcampos(); $i++) { 
                    $campo = $this->nombrecampo($i);
                    $campo = $campo->name;
                    echo "<label for='".$campo."".$row['idCentro']."'>".ucwords($campo)."</label><input class='form-control input-sm' id='".$campo."".$row['idCentro']."' name='".$campo."' value='".$row[$campo]."'><br>";
                }
                echo "</div><button type='submit' class='btn btn-primary center-block' data-dismiss='modal'><input type='hidden' name='idCentro' value='".$row["idCentro"]."'><input type='hidden' name='accion' value='update'>ACTUALIZAR</button></form></div></div></div></div>";
            }
            echo "</table>";
            $this->Consulta_ID->close();
            //comentar si hay fallo
        }
        
        
        function crudRutas(){
            echo "<table class='table table-bordered'>";
            echo "<tr>";
            for ($i=2; $i < $this->numcampos() ; $i++) {
                $campo = $this->nombrecampo($i);
                $campo = $campo->name;
                echo "<th class='success'>".ucwords($campo)."</th>";
            }
            echo "<th class='success'>EDITAR</th>";
            echo "<th class='success'>ELIMINAR</th>";
            echo "</tr>";
            while ($row=mysqli_fetch_array($this->Consulta_ID, MYSQLI_ASSOC)) {
                echo "<tr>";
                for ($i=2; $i < $this->numcampos(); $i++) { 
                    $campo = $this->nombrecampo($i);
                    $campo = $campo->name;
                    echo "<td>".ucwords($row[$campo])."</td>";
                    $j= $this->numcampos() - 1;
                    if($i == $j){
                        echo "<td><button id='".$row["idRuta"]."' type='button' class='btn btn-warning btn-xs-1 btn-block' data-toggle='modal' data-target='#modalRuta".$row["idRuta"]."' ><span id='iconoU' class='icon-pencil2'></span></button></td>";
                        echo "<td><button id='crud' type='button' class='btn btn-danger btn-xs-1 btn-block'><input type='hidden' name='uid' value=".$row['idRuta']."><input type='hidden' name='accion' value='delete'/><span id='icono' class='icon-bin'></span></button></td>";
                    }
                }
                echo "</tr>";
                echo "<div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' id='modalRuta".$row['idRuta']."' aria-hidden='true'><div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h4 class='modal-title text-center' id='myModalLabel'>Editar</h4></div><div class='modal-body'><form method='POST' action='dll/crud.php'><div class='form-group'>";
                for ($i=1; $i < $this->numcampos(); $i++) { 
                    $campo = $this->nombrecampo($i);
                    $campo = $campo->name;
                    echo "<label for='".$campo."".$row['idRuta']."'>".ucwords($campo)."</label><input class='form-control input-sm' id='".$campo."".$row['idRuta']."' name='".$campo."' value='".$row[$campo]."'><br>";
                }
                echo "</div><button type='submit' class='btn btn-primary center-block' data-dismiss='modal'><input type='hidden' name='idCentro' value='".$row["idRuta"]."'><input type='hidden' name='accion' value='update'>ACTUALIZAR</button></form></div></div></div></div>";
            }
            echo "</table>";
            $this->Consulta_ID->close();
            //comentar si hay fallo
        }
        function crudParadas(){
            echo "<table class='table table-bordered'>";
            echo "<tr>";
            for ($i=1; $i < $this->numcampos() ; $i++) {
                $campo = $this->nombrecampo($i);
                $campo = $campo->name;
                echo "<th class='success'>".ucwords($campo)."</th>";
            }
            echo "<th class='success'>EDITAR</th>";
            echo "<th class='success'>ELIMINAR</th>";
            echo "</tr>";
            while ($row=mysqli_fetch_array($this->Consulta_ID, MYSQLI_ASSOC)) {
                echo "<tr>";
                for ($i=1; $i < $this->numcampos(); $i++) { 
                    $campo = $this->nombrecampo($i);
                    $campo = $campo->name;
                    //echo $campo;
                    echo "<td>".ucwords($row[$campo])."</td>";
                    $j= $this->numcampos() - 1;
                    if($i == $j){
                        echo "<td><button id='".$row["idParada"]."' type='button' class='btn btn-warning btn-xs-1 btn-block' data-toggle='modal' data-target='#modalParada".$row["idParada"]."' ><span id='iconoU' class='icon-pencil2'></span></button></td>";
                        echo "<td><button id='crud' type='button' class='btn btn-danger btn-xs-1 btn-block'><input type='hidden' name='uid' value=".$row['idParada']."><input type='hidden' name='accion' value='delete'/><span id='icono' class='icon-bin'></span></button></td>";
                    }
                }
                echo "</tr>";
                echo "<div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' id='modalParada".$row['idParada']."' aria-hidden='true'><div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h4 class='modal-title text-center' id='myModalLabel'>Editar</h4></div><div class='modal-body'><form method='POST' action='dll/crud.php'><div class='form-group'>";
                for ($i=1; $i < $this->numcampos(); $i++) { 
                    $campo = $this->nombrecampo($i);
                    $campo = $campo->name;
                    echo "<label for='".$campo."".$row['idParada']."'>".ucwords($campo)."</label><input class='form-control input-sm' id='".$campo."".$row['idParada']."' name='".$campo."' value='".$row[$campo]."'><br>";
                }
                echo "</div><button type='submit' class='btn btn-primary center-block' data-dismiss='modal'><input type='hidden' name='idCentro' value='".$row["idParada"]."'><input type='hidden' name='accion' value='update'>ACTUALIZAR</button></form></div></div></div></div>";
            }
            echo "</table>";
            $this->Consulta_ID->close();
            //comentar si hay fallo
        }
        
    }
?>