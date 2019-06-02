<?php

class PersonaDTO{
    
    private $documento;
    private $nombre;
    private $telefono;
    private $correo;
    private $clave;
    
    function __construct($documento, $nombre, $telefono, $correo, $clave) {
        $this->documento = $documento;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->clave = $clave;
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

    function getClave() {
        return $this->clave;
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
    function setClave($correo) {
        $this->clave = $clave;
    }
    
}

