<?php
	session_start();
	include_once "../config/conexion.php";
	$link = conexion();

	$idregion = $_POST['idregion'];
	$strSQL = "SELECT * FROM comunas where ID_REGION = '$idregion' order by ID_COMUNA asc";
	$result = mysqli_query($link,$strSQL) or die (mysqli_error($link));
	$rtnNombre="";

		$rtnNombre.='<option value="">SELECCIONE COMUNA..</option>';
		while($row = mysqli_fetch_array($result))
		{
          $rtnNombre.='<option value="'.$row['NOMBRE_COMUNA'].'">'. utf8_encode($row['NOMBRE_COMUNA']).'</option>';	
		}

echo $rtnNombre;