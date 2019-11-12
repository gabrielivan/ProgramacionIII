<?php

namespace App\Models\ORM;


use App\Models\ORM\encargado;
use App\Models\IApiControler;
use App\Models;
use App\Models\AutentificadorJWT;

include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';
include_once __DIR__ . '/encargado.php';



class encargadosControler {
    
    public function altaEncargado($request,$response,$args){

        $datos = $request->getParsedBody();
        
        $encargado = new encargado();
        $encargado->nombre = $datos["nombre"];
        $encargado->apellido = $datos["apellido"];
        $encargado->rol = $datos["rol"];
        $encargado->clave = $datos["clave"];
        $encargado->usuario = $datos["usuario"];
        $encargado->save();
        
        $newResponse = $response->withJson($encargado
        ->where('usuario',$datos["usuario"])
        ->where('clave',$datos["clave"])
        ->select(array('nombre','apellido','usuario'))->get()); 

        return $newResponse;

    }

    public function bajaEncargado($request,$response,$args){
        
        $body = $request->getParams();
        
        $encargado = encargado::where('usuario','=',$body["usuario"])->delete();
        if($encargado){
            $mensaje=["mensaje"=>"Se dio de baja el usuario"];
            $newResponse = $response->withJson($mensaje,200);
        }else{
            $mensaje=["mensaje"=>"No se encontro el usuario ingresado"];
            $newResponse = $response->withJson($mensaje,200);
        }
                
        return $newResponse;
    }

    public function traerEncargados($request, $response, $args){
        $todosLosEncargados = encargado::all();
        $newResponse = $response->withJson($todosLosEncargados, 200);  
        return $newResponse;
    }
    
}
