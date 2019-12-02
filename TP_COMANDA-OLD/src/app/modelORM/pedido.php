<?php  
namespace App\Models\ORM;
 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class pedido extends \Illuminate\Database\Eloquent\Model{  
    
    protected $idEstadoPedido;
    protected $codigoMesa;
    protected $idEncargado;
    protected $nombreCliente;
    protected $tiempo;
    protected $imagen;
}
