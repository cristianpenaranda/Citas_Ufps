<?php

class HorarioDTO{
    
    private $id;
    private $fecha;
    private $inicio;
    private $fin;
    private $funcionario;
    
    function __construct($id, $fecha, $inicio, $fin, $funcionario) {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->inicio = $inicio;
        $this->fin = $fin;
        $this->funcionario = $funcionario;
    }

    function getId() {
        return $this->id;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getInicio() {
        return $this->inicio;
    }

    function getFin() {
        return $this->fin;
    }

    function getFuncionario() {
        return $this->funcionario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    function setFin($fin) {
        $this->fin = $fin;
    }

    function setFuncionario($funcionario) {
        $this->funcionario = $funcionario;
    }   

}

