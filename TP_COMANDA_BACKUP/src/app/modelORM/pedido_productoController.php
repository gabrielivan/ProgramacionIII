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

    public function cambiarEstado($codigo, $encargadoID, $estadoInicial, $estadoactual)
    {
        $ret = false;
        $data = pedido_producto::where('idEstadoProducto', '=', $estadoInicial)
            ->where('codigoPedido', '=', $codigo)
            ->get();
        foreach ($data as $value) {
            $prod = Producto::where('id', '=', $value->idProducto)->first();
            if($encargadoID == 3)
            {
                $value->idEstadoProducto = $estadoactual;
                $value->save();
                $ret = true;  
            }
            else if ($prod->idRol == $encargadoID) {
                $value->idEstadoProducto = $estadoactual;
                $value->save();
                $ret = true;
            }
        }
        return $ret;
    }
}
