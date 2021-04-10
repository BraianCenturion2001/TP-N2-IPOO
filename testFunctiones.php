<?php

include 'Funcion.php';

$nombre = "EL ZORRO";
$hInicio = 20; //hora inicio
$mInicio = 45; //minutos inicio
$duracion = 45; //la duración es en minutos, esto se remarca en el __toString de la clase
$precio = 150;

$objFuncion = new Funcion($nombre, $hInicio, $mInicio, $duracion, $precio);

echo $objFuncion;

?>