<?php
	session_start();
	include_once "../config/conexion.php";
	$link = conexion();

	$strSQL = "SELECT * FROM regiones order by ID_REGION asc";
	$result = mysqli_query($link,$strSQL) or die (mysqli_error($link));
	$rtnNombre="";

		$rtnNombre.='<option value="">SELECCIONE REGION..</option>';
		while($row = mysqli_fetch_array($result))
		{
          $rtnNombre.='<option value="'.$row['ID_REGION'].'">'. utf8_encode($row['NOMBRE_REGION']).'</option>';	
		}

echo $rtnNombre;