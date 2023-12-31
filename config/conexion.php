<?php
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', 1); // coloca 0 si no deseas que aparezcan los errores también en el navegador
ini_set("log_errors", 1); // con esta línea estamos diciendo que queremos crear un nuevo archivo de errores
ini_set("error_log",  "../log/php_error_log"); // con esta línea le decimos a PHP donde queremos que se guarde ese archivo, lo recomendado es que sea al lado del archivo index.php

function conexion(){

$link = new mysqli("localhost","root","","desis");
if ($link -> connect_errno) {
  echo "Fallo al conectar con MySQL: " . $link -> connect_error;
  exit();
}

$link->set_charset("utf8");

return $link;
}


?>