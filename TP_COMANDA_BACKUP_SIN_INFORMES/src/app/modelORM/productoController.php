<?php

namespace App\Models\ORM;

use App\Models\AutentificadorJWT;
use App\Models\ORM\Producto;

include_once __DIR__ . '/producto.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class productoController
{
    public function traerProductos($request, $response, $args)
    {
        $todosLosProductos = Producto::all();
        if(count($todosLosProductos) > 0) 
        {
            $newResponse = $response->withJson($todosLosProductos, 200);
        }
        else{
            $newResponse = $response->withJson("No hay ningun producto", 200);
        }
        return $newResponse;
    }
    public function traerUnProducto($request, $response, $args)
    {
        $id = $args["id"];
        $producto = Producto::find($id);
        if($producto != null)
        {
            $newResponse = $response->withJson($producto, 200);
        }
        else
        {
            $newResponse = $response->withJson("No existe el producto que quiere seleccionar con ese Id", 200);
        }
        return $newResponse;
    }

    public function altaProducto($request, $response, $args)
    {
        $arrayDeParametros = $request->getParsedBody();
        $nuevoProducto = new Producto;
        $nuevoProducto->descripcion = $arrayDeParametros["descripcion"];
        $nuevoProducto->precio = $arrayDeParametros["precio"];
        $nuevoProducto->idRol = $arrayDeParametros["idRol"];
        $nuevoProducto->tiempoPreparacion = $arrayDeParametros["tiempoPreparacion"];
        $nuevoProducto->save();
        $idProductoDadoDeAlta = $nuevoProducto->id;
        $newResponse = $response->withJson('El Producto: ' . $idProductoDadoDeAlta . ' fue dado de alta con existo.', 200);
        return $newResponse;
    }
    public function bajaProducto($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $id = $parametros['id'];
        $productoEncontrado = Producto::find($id);
        if($productoEncontrado != null)
        {
            $productoEncontrado->delete();
            $newResponse = $response->withJson('El Producto: ' . $id . ' fue dado de baja con existo.', 200);
        }
        else{
            $newResponse = $response->withJson('El producto que quiere borrar no existe', 200);
        }
        return $newResponse;
    }

    public function modificarProducto($request, $response, $args)
    {
        $arrayDeParametros = $request->getParsedBody();
        $id = null;
        $producto = null;
        $contador = 0;
        
        if (array_key_exists("id", $arrayDeParametros)) {
            $id = $arrayDeParametros['id'];
            $producto = Producto::find($id); //obtuve el producto.
        }
        if($id != null && $producto != null){ //pregunto si mandaron bien el id y si se encontro el producto.
            
            if (array_key_exists("descripcion", $arrayDeParametros)) {
                $producto->descripcion = $arrayDeParametros["descripcion"];
                $contador++;
            }
            if (array_key_exists("precio", $arrayDeParametros)) {
                $producto->precio = $arrayDeParametros["precio"];
                $contador++;
            }
            if (array_key_exists("idRol", $arrayDeParametros)) {
                $producto->idRol = $arrayDeParametros["idRol"];
                $contador++;
            }
            if (array_key_exists("tiempoPreparacion", $arrayDeParametros)) {
                $producto->tiempoPreparacion = $arrayDeParametros["tiempoPreparacion"];
                $contador++;  
            }
            if ($contador > 0 && $contador <= 4) {
                $producto->save();
                $newResponse = $response->withJson('Se ha modificado el producto: ' . $producto->descripcion . ' con existo.', 200);
            } 
        }
        else if ($id == null) {
            $newResponse = $response->withJson('Introduzca un id valido', 200);
          } 
          else if ($id != null && $producto == null) {
            $newResponse = $response->withJson("No hay un prodcuto con el id ingresado", 200);
          } 
          else {
            $newResponse = $response->withJson("No hubo modificaciones ", 200);
          }
        return $newResponse;
    }

}
