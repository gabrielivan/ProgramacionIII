<?php

namespace App\Models\ORM;

use App\Models\AutentificadorJWT;
use App\Models\ORM\Mesa;


include_once __DIR__ . '/mesa.php';
include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';



use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class mesaController
{
    public function traerMesas($request, $response, $args)
    {
        $todasLasMesas = Mesa::all();
        if(count($todasLasMesas) > 0) 
        {
            $newResponse = $response->withJson($todasLasMesas, 200);
        }
        else{
            $newResponse = $response->withJson("No hay mesas", 200);
        }
        return $newResponse;
    }
    public function obtenerMesaLibre()
    {
        $mesaLibre = Mesa::where("idEstadoMesa", "=", "4")
        ->select("codigoMesa")
        ->first();
        
        if($mesaLibre != null)
        {
            $newResponse = 'La mesa: ' .$mesaLibre->codigoMesa. ' esta lista para usar';
            self::cambiarEstado($mesaLibre->codigoMesa, 1);
        }
        else
        {
            $newResponse = "En este momento no hay ninguna mesa dispomible";
        }
        return $newResponse;
    }
    public function cambiarEstado($codigoMesa, $nuevoEstado){
        $mesa=mesa::where('codigoMesa','=',$codigoMesa)->first();
        $mesa->idEstadoMesa=$nuevoEstado;
        $mesa->save();
    }
    public function traerUnaMesa($request, $response, $args)
    {
        $id = $args["id"];
        $mesa = Mesa::find($id);
        if(count((array)$mesa) > 0) 
        {
            $newResponse = $response->withJson($mesa, 200);
        }
        else{
            $newResponse = $response->withJson("No hay mesa con ese ID", 200);
        }
        return $newResponse;
    }

    public function altaMesa($request, $response, $args)
    {
        $mesa = new Mesa;
        $mesa->codigoMesa = " ";
        $mesa->idEstadoMesa = 4;
        $mesa->save();
        $mesa->codigoMesa = "MESA-".$mesa->id;
        $mesa->save();
        $newResponse = $response->withJson('Mesa ' . $mesa->codigoMesa. ' cargada', 200);
        return $newResponse;
    }
    public function bajaMesa($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $id = $parametros['id'];
        $mesaEncontrada = Mesa::find($id);
        
        if($mesaEncontrada != null)
        {
            $mesaEncontrada->delete();
            $newResponse = $response->withJson('La Mesa: ' . $id . ' fue dada de baja con existo.', 200);
        }
        else{
            $newResponse = $response->withJson('La Mesa que quiere borrar no existe', 200);
        }
        return $newResponse;
    }

    public function modificarMesa($request, $response, $args)
    {
        $arrayDeParametros = $request->getParsedBody();
        $id = null;
        $mesa = null;
        $contador = 0;
        
        if (array_key_exists("id", $arrayDeParametros)) {
            $id = $arrayDeParametros['id'];
            $mesa = Mesa::find($id); //obtuve la mesa.
        }
        if($id != null && $mesa != null){ //pregunto si mandaron bien el id y si se encontro la mesa.
            
            if (array_key_exists("codigoMesa", $arrayDeParametros)) {
                $mesa->codigoMesa = $arrayDeParametros["codigoMesa"];
                $contador++;
            }
            if (array_key_exists("idEstadoMesa", $arrayDeParametros)) {
                $mesa->idEstadoMesa = $arrayDeParametros["idEstadoMesa"];
                $contador++;
            }
            if ($contador > 0 && $contador <= 2) {
                $mesa->save();
                $newResponse = $response->withJson('Se ha modificado la mesa: ' . $mesa->codigoMesa . ' con existo.', 200);
            } 
        }
        else if ($id == null) {
            $newResponse = $response->withJson('Introduzca un id valido', 200);
          } 
          else if ($id != null && $mesa == null) {
            $newResponse = $response->withJson("No hay una mesa con el id ingresado", 200);
          } 
          else {
            $newResponse = $response->withJson("No hubo modificaciones ", 200);
          }
        return $newResponse;
    }
}
