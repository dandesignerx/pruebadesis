<?php
function limpiar_signos($cadena){
        
        //Reemplazamos la A y a
        $cadena = str_replace(
        array("'"),
        array(''),
        $cadena
        );
 
        //
        $cadena = str_replace(
        array('+'),array(''),
        $cadena );

        return $cadena;
}
?>