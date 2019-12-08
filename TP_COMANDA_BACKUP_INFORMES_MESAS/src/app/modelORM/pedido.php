<?php  
namespace App\Models\ORM;
 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class Pedido extends \Illuminate\Database\Eloquent\Model{
    protected $idEstadoPedido;
    protected $codigoMesa;
    protected $productos;
    protected $idEncargado;
    protected $nombreCliente;
    protected $imagen;
    protected $tiempo;

}
