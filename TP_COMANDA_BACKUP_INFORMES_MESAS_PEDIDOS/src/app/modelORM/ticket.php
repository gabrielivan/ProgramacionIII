<?php  
namespace App\Models\ORM;
 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class Ticket extends \Illuminate\Database\Eloquent\Model{
    protected $id;
    protected $precioTotal;
    protected $codigoPedido;
    protected $mesa;
    protected $encargado;

}
