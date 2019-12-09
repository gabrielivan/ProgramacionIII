<?php

namespace App\Models\ORM;

use App\Models\AutentificadorJWT;
use App\Models\ORM\Producto;
use App\Models\ORM\pedido_producto;
use App\Models\ORM\Roles;

include_once __DIR__ . '/pedido_producto.php';
include_once __DIR__ . '/producto.php';
include_once __DIR__ . '/roles.php';

class pedido_productoController
{
    public function verPedidosPendientes($request,$response,$args)
    {
        $arrayDeParametros = $request->getParams();
        $token = $request->getHeader('token');
        $token = AutentificadorJWT::ObtenerData($token[0]);
        $idEncargado = $token->idRol;
        $codigoPedido = $arrayDeParametros['codigoPedido'];

        $rol = Roles::select('cargo')->where('roles.id', '=', $idEncargado)->get()->toArray();
        $rol = $rol[0]["cargo"];
        if ($rol == "socio") {
            $data = pedido_producto::join('productos', 'productos_pedidos.idProducto', 'productos.id')
                ->join('roles', 'roles.id', 'productos.idRol')
                ->where('productos_pedidos.idEstadoProducto', '=', '1')
                ->where('codigoPedido', '=', $codigoPedido)
                ->select('codigoPedido', 'productos.descripcion', 'cargo')
                ->get();
        } else {
            $data = pedido_producto::join('productos', 'productos_pedidos.idProducto', 'productos.id')
                ->join('roles', 'roles.id', 'productos.idRol')
                ->where('productos_pedidos.idEstadoProducto', '=', '1')
                ->where('productos.idRol', '=', $idEncargado)
                ->where('codigoPedido', '=', $codigoPedido)
                ->select('codigoPedido', 'productos.descripcion', 'cargo')
                ->get();
        }
        $newResponse = $response->withJson($data, 200);  
        return $newResponse;
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
