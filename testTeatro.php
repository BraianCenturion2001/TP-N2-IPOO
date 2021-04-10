<?php

include 'Teatro.php';
include 'Funcion.php';

echo "Ingrese el nombre del Teatro: ";
$nombre = trim(fgets(STDIN));
echo "Ingrese la dirección del Teatro: ";
$direccion =  trim(fgets(STDIN));
echo "Ingrese cuantas funciones desea cargar: ";
$cantFunciones = trim(fgets(STDIN));

$coleccionFunciones = array();
//ARREGLO AUXILIAR QUE ME SERVIRA PARA VERIFICAR QUE LOS HORARIOS DE LAS NUEVAS FUNCIONES NO SEA IGUALES
$coleccionHorariosAux[] = array('hora' => 0, 'minutos' => 0, 'duracion' => 0);

//EN ESTE FOR SE CREAN LAS FUNCIONES
for ($i=0; $i<$cantFunciones; $i++){
    echo "INGRESE EL NOMBRE DE LA FUNCIÓN: ";
    $nombreFuncion = trim(fgets(STDIN));
    echo "INGRESE EL PRECIO DE LA FUNCIÓN: ";
    $precioFuncion = trim(fgets(STDIN));
    echo "INGRESE LA DURACIÓN DE LA FUNCIÓN (MINUTOS): ";
    $duracionFuncion = trim(fgets(STDIN));

    //ENTRAMOS A UNA REPETITIVA PARA VERIFICAR QUE EL HORARIO NO COINCIDA CON UNO YA ESTABLECIDO
    do{
        $existe=false;
        echo "Ingrese el Horario de Entrada: \n";
        echo "Hora: ";
        $horaInicio = trim(fgets(STDIN));
        echo "Minutos: ";
        $minInicio = trim(fgets(STDIN));

        $horarioASegundos = ($horaInicio*3600)+($minInicio*60);

        //VERIFICAMOS SI NO HAY UN HORARIO IGUAL AL INGRESADO
        for ($a=0; $a<(count($coleccionHorariosAux)); $a++){
            $inicioFuncion = ($coleccionHorariosAux[$a]['hora']*3600) + ($coleccionHorariosAux[$a]['minutos']*60);
            if ($horarioASegundos==$inicioFuncion){
                $existe = true;
            }
        }

        //SI EL HORARIO ES EL MISMO DEBERÁ INGRESAR OTRO
        if ($existe){
            echo "HORARIO NO DISPONIBLE, POR FAVOR ELIJA OTRO \n";
        } else {
            echo "HORARIO DISPONIBLE, LA FUNCIÓN '".$nombreFuncion."' HA SIDO AÑADIDA CON ÉXITO \n";
            //SI EL HORARIO ESTA BIEN AÑADIMOS EL NUEVO HORARIO AL ARREGLO AUXILIAR, SOLO ME INTERESA EL HORARIO, NO LA FUNCION
            $horarioNuevo = array('hora'=>$horaInicio, 'minutos'=>$minInicio, 'duracion'=>$duracionFuncion);
            array_push($coleccionHorariosAux, $horarioNuevo);
            //CREAMOS LA NUEVA FUNCION Y DE PASO LA AÑADIMOS A LA COLECCION DE FUNCIONES
            $funcion = new Funcion($nombreFuncion, $horaInicio, $minInicio, $duracionFuncion, $precioFuncion);
            array_push($coleccionFunciones, $funcion);
        }
    }while($existe);

    echo "------------------------------------------------ \n";

}

//CREAMOS EL TEATRO CON SUS FUNCIONES
$teatro = new Teatro($nombre, $direccion, $coleccionFunciones);


//MENÚ PRINCIPAL
$respuesta = "SI";
while ($respuesta=="SI"){
    echo "----------------------MENÚ---------------------- \n";
    echo "1. CAMBIAR NOMBRE DEL TEATRO \n";
    echo "2. CAMBIAR DIRECCIÓN DEL TEATRO \n";
    echo "3. MODIFICAR NOMBRE Y PRECIO DE UNA FUNCIÓN \n";
    echo "4. VER INFORMACIÓN DEL TEATRO Y SUS FUNCIONES \n";
    $opcion = trim(fgets(STDIN));
    if ($opcion==1){
        echo "INGRESE EL NUEVO NOMBRE PARA EL TEATRO: ";
        $nuevo_nombre = trim(fgets(STDIN));
        $teatro->cambiarNombre($nuevo_nombre);
        echo "NOMBRE ACTUALIZADO \n";
        echo $teatro;
    } elseif ($opcion==2){
        echo "INGRESE LA NUEVA DIRECCIÓN PARA EL TEATRO: ";
        $nueva_dire = trim(fgets(STDIN));
        $teatro->cambiarDireccion($nueva_dire);
        echo "DIRECCIÓN ACTUALIZADA \n";
        echo $teatro;
    } elseif ($opcion==3){
        echo "INGRESE QUE FUNCIÓN DESEA MODIFICAR: (".count($coleccionFunciones).") ";
        $eleccion = trim(fgets(STDIN));
        //TRAEMOS EL ARREGLO DE FUNCIONES
        $coleFunciones = $teatro->getArregloFunciones();
        //TRAEMOS LA FUNCION QUE PIDIO EL USUARIO
        $funcionAModificar = $coleFunciones[($eleccion - 1)];
        echo "INGRESE EL NUEVO NOMBRE PARA LA FUNCIÓN ".$eleccion." :";
        $nuevo_nombre_f = trim(fgets(STDIN));
        echo "INGRESE EL NUEVO PRECIO PARA LA FUNCIÓN ".$eleccion." :";
        $nuevo_precio_f = trim(fgets(STDIN));
        //SETEAMOS LOS VALORES DE LA FUNCIÓN
        $funcionAModificar->modificar($nuevo_nombre_f, $nuevo_precio_f);
    } elseif ($opcion==4){
        echo "---------------------TEATRO--------------------- \n";
        echo $teatro;
        for ($i=0; $i<count($coleccionFunciones); $i++){
            echo "---------------------FUNCION ".($i + 1)."--------------------- \n";
            echo $coleccionFunciones[$i];
        }
    } else {
        echo "OPCIÓN INCORRECTA!!! \n";
    }
    echo "DESEA CONTINUAR? (SI/NO) :";
    $respuesta = trim(fgets(STDIN));
}
?>