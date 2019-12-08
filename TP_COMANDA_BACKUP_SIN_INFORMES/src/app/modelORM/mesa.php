<?php  
namespace App\Models\ORM;
 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class Mesa extends \Illuminate\Database\Eloquent\Model{
    protected $codigoMesa;
    protected $idEstadoMesa;
}
