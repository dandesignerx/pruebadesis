<?php
	session_start();
	include_once "../config/conexion.php";
	$link = conexion();

	$strSQL = "SELECT * FROM candidatos order by id asc";
	$result = mysqli_query($link,$strSQL) or die (mysqli_error($link));
	$rtnNombre="";

		$rtnNombre.='<option value="">SELECCIONE CANDIDATO..</option>';
		while($row = mysqli_fetch_array($result))
		{
          $rtnNombre.='<option value="'.$row['NOMBRE'].'">'. $row['NOMBRE'].'</option>';	
		}

echo $rtnNombre;