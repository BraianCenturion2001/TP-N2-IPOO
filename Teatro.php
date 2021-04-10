<?php

class Teatro{
    private $nombre;
    private $direccion;
    private $arregloFunciones;

    public function __construct($name, $dire, $funciones){
        $this->nombre = $name;
        $this->direccion = $dire;
        $this->arregloFunciones = $funciones;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getArregloFunciones(){
        return $this->arregloFunciones;
    }

    public function setNombre($n){
        $this->nombre = $n;
    }
    public function setDireccion($d){
        $this->direccion = $d;
    }
    public function setArregloFunciones($a){
        $this->arregloFunciones = $a;
    }

    public function cambiarNombre($name){
        $this->setNombre($name);
    }
    public function cambiarDireccion($dire){
        $this->setDireccion($dire);
    }

    public function __toString()
    {
        return  "NOMBRE DEL TEATRO: ".$this->getNombre()."\n".
                "DIRECCIÓN DEL TEATRO: ".$this->getDireccion()."\n";
    }
}

?>