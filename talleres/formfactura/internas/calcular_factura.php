<style>
    .fuente3 {
	font-family: 'Anton', sans-serif;
    }
    .fuente4 {
        font-family: 'Lobster', cursive;
    }
    .fuente5 {
        font-family: 'Pacifico', cursive;
    }
    .fuente6 {
        font-family: 'Shadows Into Light', cursive;
    }
    .fuente7 {
        font-family: 'Dancing Script', cursive;
    }
    .fuente8 {
        font-family: 'Kaushan Script', cursive;
    }
    .fuente9 {
        font-family: 'Great Vibes', cursive;
    }
    h2 {
        text-align: center;
        text-transform: uppercase;
        /*para MAYUSCULA*/
        font-family: 'Josefin Slab';
    }
    .cliente {
        width: 100%; /*ancho*/
        text-align: justify;
        color: #527103;
        background-color: #D7F28F;
        margin: 20px 40px 0px 40px; /*afuera*/
        padding: 1em 1em; /*dentro*/
        border-top-right-radius: 20px;
        border-top-left-radius: 20px;
        box-sizing: border-box;
    }
    
    .cliente h2 {
        text-shadow: 3px 3px 4px #000;
        font-size: 2em;
        box-sizing: border-box;
    }
    .cliente input, .cliente select, .tipouser select {
        text-align: center;
    }

    .actividades {
        width: 100%;
        background-color: #B6973E;
        color: #000;
        text-align: justify;
        margin: 0px 40px 0px 40px; /*afuera*/
        padding: 1em 1em; /*dentro*/
        box-sizing: border-box;
        /*FFE9A9*/
    }
    .cuenta {
        width: 100%;
        background-color: #669999;
        color: #000;
        text-align: justify;
        margin: 0px 40px 0px 40px; /*afuera*/
        padding: 1em 1em; /*dentro*/
        border-bottom-right-radius: 20px;
        border-bottom-left-radius: 20px;
        box-sizing: border-box;
        /*FFE9A9*/
    }
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    .tabtalleres {
        
    }
    /*Colores*/
    .azul {
        color: #01579B;
    }
    .verde {
        color: #109D59;
    }
    .negro {
        color: #000000;
    }
    .blanco {
        color: #FFFFFF;
    }
    /*Esfectos texto*/
    .negrita {
        font-weight: bold;
    }
    /*Bordes*/
    .sinbordes {
        border: 0px solid #FFF;
    }
    .borde{
        border-radius: 20px;
        background-color: #000000;
        color: #017CFF;
    }
    .borde2{
        border-left-color: #000000;
        border-left-style: dashed;
        border-left-width: 1px;
        border-right-color: #000000;
        border-right-style: dashed;
        border-right-width: 1px;
    }

    .borde3{
        border-radius: 20px;
        background-color: #000000;
        color: #FFFFFF;
    }
    .der {
        text-align: right;
    }
    .izq {
        text-align: left;
    }
</style>

<?php
//header('Content-type: text/css; charset:UTF-8');
extract($_POST);

//include("css/estilos.css");
// algoritmo para calcular la edad
$tiempo = strtotime($fecha_nacimiento);
$ahora = time();
$edad = ($ahora-$tiempo)/(60*60*24*365.25);

//Subtotal
$subtotal=0;
//costo evento
$costo_evento=100;
//costos
$v_curso=80;
$v_taller=10;
//Descuento segun el tipo de usuario
$desc[0]=0.10; //Prof
$desc[1]=0.20; //Est
$desc[2]=0.00; //Est
$valor_curso = 0;
$valor_taller = 0;
$descaplicado=0;

//Tipo usuario
$usr[0]="Docente";
$usr[1]="Estudiante";
$usr[2]="Externo";

// Comprobar curso inscrito
if (isset($curso) && !empty($curso)) {
    $valor_curso += $v_curso;
}

// Comprobar talleres inscritos
$talleres;
if (isset($talleres) && !empty($talleres)) {
    //echo $talleres;
    $talleres = $_POST['talleres'];
	for ($i=0; $i<count($talleres); $i++) {
	    // echo $talleres[$i]."<br>";
	    $valor_taller += $v_taller;
	}
}

$subtotal = $costo_evento;
$subtotal += $valor_curso;
$subtotal += $valor_taller;

$descaplicado = $desc[$tipo-1];
$descaplicado = $subtotal * $descaplicado;

$valor_pago = $subtotal - $descaplicado;
echo "<h2 class='fuente3'>FACTURA</h2><br>";
echo '<div class="cliente">';
echo '<p class="negro fuente4">Cliente: <span class="negrita azul">'. $apellidos .', '. $nombres. "</span></p>";
echo '<p class="negro fuente5">Cedula: <span class="azul">'. $cedula .'</span></p>';
echo '<p class="negro fuente6">Edad: <span class="azul">'. floor($edad).'</span></p>';
echo '<p class="negro fuente7">Tipo de Usuario: <span class="azul">' .$usr[$tipo-1].'</span></p>';
echo "</div>";
echo '<div class="actividades">';
echo '<table class="negro fuente8" style="width:100%"><tr><th colspan="2">Detalle</th><th>Costo</th></tr>';
echo "<tr><td>Inscripcion</td><td>" .$costo_evento. "</td></tr>";
echo "<tr><td>" .$curso . "</td><td>" .$v_curso."</td></tr>";

for ($i=0; $i<count($talleres); $i++) {
    //echo $talleres[$i]."\t" .$v_taller. "<br>";
    print '<tr><td>' .$talleres[$i]. '</td><td>' .$v_taller.'</td></tr>';
}
echo "</table></div>";
echo '<div class="cuenta">';
echo '<table class="sinbordes negro fuente9" style="width:100%">';
echo '<tr><td class="der">Subtotal:</td><td class="izq">' .$subtotal. '</td></tr>';
echo '<tr><td class="der">Descuento ('. $desc[$tipo-1]*100 .'%)</td><td class="izq">' .$descaplicado.'</td></tr>';
echo '<tr><td class="der">Valor a pagar:</td><td class="izq">' .$valor_pago.'</td></tr>';
echo "</table></div>";
echo "</div>";
?>
