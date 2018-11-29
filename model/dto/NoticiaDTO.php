<?php

class NoticiaDTO{
    
    private $id;
    private $titulo;
    private $descripcion;
    private $fecha;
    private $administrador;
    private $funcionario;
    
    function __construct($id, $titulo, $descripcion, $fecha, $administrador, $funcionario) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->fecha = $fecha;
        $this->administrador = $administrador;
        $this->funcionario = $funcionario;
    }

    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getAdministrador() {
        return $this->administrador;
    }

    function getFuncionario() {
        return $this->funcionario;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setAdministrador($administrador) {
        $this->administrador = $administrador;
    }

    function setFuncionario($funcionario) {
        $this->funcionario = $funcionario;
    }
    
}

