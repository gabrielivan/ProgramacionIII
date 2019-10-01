<?php
class Usuario
{
    public $nombre;
    public $legajo;
    public $email;
    public $clave;
    public $fotoUno;
    public $fotoDos;

    public function __construct($nombre, $legajo, $email, $clave, $fotoUno, $fotoDos)
    {
        $this->nombre = $nombre;
        $this->legajo = $legajo;
        $this->email = $email;
        $this->clave = $clave;
        $this->fotoUno = $fotoUno;
        $this->fotoDos = $fotoDos;
    }
}
