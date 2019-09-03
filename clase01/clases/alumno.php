<?php
    REQUIRE_ONCE 'persona.php';

    class Alumno extends Persona
    {
        public $legajo;
        public $cuatrimestre;

        public function __construct($nombre, $dni, $legajo, $cuatrimestre)
        {
            $this->nombre = $nombre;
            $this->dni = $dni;
            $this->legajo = $legajo;
            $this->cuatrimestre = $cuatrimestre;
        }
    }
?>