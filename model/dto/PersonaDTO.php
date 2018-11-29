<?php

class PersonaDTO{
    
    private $documento;
    private $nombre;
    private $telefono;
    private $correo;
    
    function __construct($documento, $nombre, $telefono, $correo) {
        $this->documento = $documento;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->correo = $correo;
    }

    function getDocumento() {
        return $this->documento;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getCorreo() {
        return $this->correo;
    }

    function setDocumento($documento) {
        $this->documento = $documento;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }
    
}

