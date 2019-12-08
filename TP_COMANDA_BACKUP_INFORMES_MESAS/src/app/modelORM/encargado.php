<?php

namespace App\Models\ORM;
 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class Encargado extends \Illuminate\Database\Eloquent\Model {  
    protected $nombre;
    protected $apellido;
    protected $idRol;
    protected $clave;
    protected $usuario;
}
?>