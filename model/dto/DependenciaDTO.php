<?php

class DependenciaDTO{
    
    private $id;
    private $nombre;
    private $ubicacion;
    private $telefono;
    
    function __construct($id, $nombre, $ubicacion, $telefono) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ubicacion = $ubicacion;
        $this->telefono = $telefono;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getUbicacion() {
        return $this->ubicacion;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    
}

