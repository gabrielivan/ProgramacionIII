<?php  
namespace App\Models\ORM;
 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class pedido_producto extends \Illuminate\Database\Eloquent\Model{ 
    protected $idPedido;
    protected $idProducto;
    protected $table = 'productos_pedidos';

}

?>