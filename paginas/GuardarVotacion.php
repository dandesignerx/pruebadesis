<?php
session_start();
include_once "../config/conexion.php";
include_once "../paginas/Sanear.php";
$link = conexion();

// Datos a insertar
$opcion1 = isset($_POST['web']) ? $_POST['web'] : '';
$opcion2 = isset($_POST['tv']) ? $_POST['tv'] : '';
$opcion3 = isset($_POST['redes_sociales']) ? $_POST['redes_sociales'] : '';
$opcion4 = isset($_POST['Amigo']) ? $_POST['Amigo'] : '';
$idregion = $_POST['regiones'];
$region = '';
$lista = array($opcion1, $opcion2, $opcion3, $opcion4);
// Concatenar los datos con coma como separador
$comoseentero = implode(",", $lista);

// obtiene el nombre de la region
$sqle = "SELECT NOMBRE_REGION FROM regiones WHERE ID_REGION = '$idregion'";
$resp = $link->query($sqle);
while ($row = mysqli_fetch_array($resp) ) {
   $region = $row['NOMBRE_REGION']; 
}

$array = array( 
				"nombre"      => limpiar_signos($_POST['nomapellido']),
				"alias"       => limpiar_signos($_POST['alias']),
                "rut"  		  => $_POST['rut'],
                "email"       => limpiar_signos($_POST['email']),
                "region"      => $region,
                "comuna"      => $_POST['comunas'],
                "candidato"   => $_POST['candidatos'],
                "comoseentero" => $comoseentero,
                "fecha"        => date("Y-m-d H:i:s"));

// almacena datos
$sql  = "INSERT INTO votaciones";
$sql .= " (`".implode("`, `", array_keys($array))."`)";
$sql .= " VALUES ('".implode("', '", $array)."') ";
$result = $link->query($sql) or die(mysqli_error($link));
// Cerrar la conexión
$link->close();

if($result){
	echo "OK";
}else{
	echo "ERROR";
}