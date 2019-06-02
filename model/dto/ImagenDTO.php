
<?php

class ImagenDTO{
    
    private $id;
    private $nombre;
    private $archivo;
    
    function __construct($id, $nombre, $archivo) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->archivo = $archivo;
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getArchivo() {
        return $this->archivo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setArchivo($archivo) {
        $this->archivo = $archivo;
    }

}

