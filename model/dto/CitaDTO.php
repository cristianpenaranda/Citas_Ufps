<?php

class CitaDTO{
    
    private $id;
    private $turno;
    private $estado;
    private $horario;
    private $usuario;
    private $funcionario;
    
    function __construct($id, $turno, $estado, $horario, $usuario, $funcionario) {
        $this->id = $id;
        $this->turno = $turno;
        $this->estado = $estado;
        $this->horario = $horario;
        $this->usuario = $usuario;
        $this->funcionario = $funcionario;
    }
    
    function getId() {
        return $this->id;
    }

    function getTurno() {
        return $this->turno;
    }

    function getEstado() {
        return $this->estado;
    }

    function getHorario() {
        return $this->horario;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getFuncionario() {
        return $this->funcionario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTurno($turno) {
        $this->turno = $turno;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setHorario($horario) {
        $this->horario = $horario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setFuncionario($funcionario) {
        $this->funcionario = $funcionario;
    }

}

