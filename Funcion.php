<?php

class Funcion{
    private $nombre;
    private $horario;
    private $duracion;
    private $precio;

    public function __construct($nombre, $horaInicio, $minutosInicio, $duracion, $precio)
    {
     $this->nombre = $nombre;
     $this->horario = array(
         'hora' => $horaInicio,
         'minutos' => $minutosInicio
     );
     $this->duracion = $duracion;
     $this->precio = $precio;   
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function getHorario(){
        return $this->horario;
    }
    public function getDuracion(){
        return $this->duracion;
    }
    public function getPrecio(){
        return $this->precio;
    }

    public function setNombre($n){
        $this->nombre = $n;
    }
    public function setHorario($h){
        $this->horario = $h;
    }
    public function setDuracion($d){
        $this->duracion = $d;
    }
    public function setPrecio($p){
        $this->precio = $p;
    }

    public function modificar($new_name, $new_precio){
        $this->setNombre($new_name);
        $this->setPrecio($new_precio);
    }

    public function __toString()
    {
        $h = $this->getHorario();
        return  "NOMBRE DE LA FUNCIÓN: '".$this->getNombre()."' \n".
                "PRECIO DE LA FUNCIÓN: $".$this->getPrecio()."\n".
                "HORA INICIO: ".$h['hora'].":".$h['minutos']."hs \n".
                "DURACIÓN DE LA FUNCIÓN: ".$this->getDuracion()." MINUTOS \n";
    }


}

?>