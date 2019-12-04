<?php

namespace App\Models\ORM;
use App\Models\ORM\Producto;
use App\Models\ORM\pedido_producto;
// include_once __DIR__ . '/ticket_producto.php';

class pedido_productoController
{
    public function verPendientes($codigo,$encargadoID){
        if($encargadoID==5){
            $data=pedido_producto::join('productos','ticket_productos.producto','productos.id')
            ->join('roles','roles.id','productos.encargado')
            ->where('ticket_productos.estado','=','1')
            ->where('codigo','=',$codigo)
            ->get();    
        }else{
            $data=pedido_producto::join('productos','ticket_productos.producto','productos.id')
            ->join('roles','roles.id','productos.encargado')
            ->where('ticket_productos.estado','=','1')
            ->where('productos.encargado','=',$encargadoID)
            ->where('codigo','=',$codigo)
            //->select(array('codigo','descripcion','puesto'))
            ->get();
        }
        return $data;
    }
}
