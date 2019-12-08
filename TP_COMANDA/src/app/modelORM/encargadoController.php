<?php

namespace App\Models\ORM;


use App\Models\ORM\Encargado;
use App\Models\IApiControler;
use App\Models\AutentificadorJWT;

include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';
include_once __DIR__ . '/encargado.php';



class encargadoController {
    
    public function altaEncargado($request,$response,$args){

        $datos = $request->getParsedBody();
        
        $encargado = new Encargado();
        $encargado->nombre = $datos["nombre"];
        $encargado->apellido = $datos["apellido"];
        $encargado->idRol = $datos["idRol"];
        $encargado->clave = $datos["clave"];
        $encargado->usuario = $datos["usuario"];
        $encargado->save();
        
        $newResponse = $response->withJson($encargado
        ->where('usuario',$datos["usuario"])
        ->where('clave',$datos["clave"])
        ->select(array('nombre','apellido','usuario'))->get()); 

        return $newResponse;

    }

    public function modificarEncargado($request, $response, $args)
    {
        $arrayDeParametros = $request->getParsedBody();
        $id = null;
        $encargado = null;
        $contador = 0;
        
        if (array_key_exists("id", $arrayDeParametros)) {
            $id = $arrayDeParametros['id'];
            $encargado = Encargado::find($id); //obtuve el encargado.
        }
        if($id != null && $encargado != null){ //pregunto si mandaron bien el id y si se encontro el encargado.
            
            if (array_key_exists("nombre", $arrayDeParametros)) {
                $encargado->nombre = $arrayDeParametros["nombre"];
                $contador++;
            }
            if (array_key_exists("apellido", $arrayDeParametros)) {
                $encargado->apellido = $arrayDeParametros["apellido"];
                $contador++;
            }
            if (array_key_exists("usuario", $arrayDeParametros)) {
                $encargado->usuario = $arrayDeParametros["usuario"];
                $contador++;
            }
            if (array_key_exists("idRol", $arrayDeParametros)) {
                $encargado->idRol = $arrayDeParametros["idRol"];
                $contador++;  
            }
            if (array_key_exists("clave", $arrayDeParametros)) {
                $encargado->clave = $arrayDeParametros["clave"];
                $contador++;
            }
            if ($contador > 0 && $contador <= 5) {
                $encargado->save();
                $newResponse = $response->withJson('Se ha modificado el usuario: ' . $encargado->usuario, 200);
            } 
        }
        else if ($id == null) {
            $newResponse = $response->withJson('Introduzca un id valido', 200);
          } 
          else if ($id != null && $encargado == null) {
            $newResponse = $response->withJson("No hay un encargado con el id ingresado", 200);
          } 
          else {
            $newResponse = $response->withJson("No hubo modificaciones ", 200);
          }
        return $newResponse;
    }

    public function bajaEncargado($request,$response,$args){
        
        $parametros = $request->getParsedBody();
 
        $encargado = Encargado::where('usuario','=',$parametros["usuario"])->delete();
        
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
        $todosLosEncargados = Encargado::all();
        $newResponse = $response->withJson($todosLosEncargados, 200);  
        return $newResponse;
    }

    public function traerUnEncargado($request, $response, $args)
    {
        $id = $args["id"];
        $encargado = Encargado::find($id);
        
        if($encargado != null)
        {
            $newResponse = $response->withJson($encargado, 200);
        }
        else
        {
            $newResponse = $response->withJson("No existe el encargado", 200);
        }
        return $newResponse;
    }
    
    public function iniciarSesion($request, $response)
    {
        $arrayDeParametros = $request->getParsedBody();
        $encargado = Encargado::where('usuario', '=', $arrayDeParametros["usuario"])
            ->join('roles', 'encargados.idRol', 'roles.id')
            ->select("encargados.id","nombre", "apellido", "usuario", "clave", "idRol", "cargo")
            ->get()
            ->toArray();
        if (count($encargado) == 1 && $encargado[0]["clave"] == $arrayDeParametros["clave"]) {
            unset($encargado[0]["clave"]);
            $token = AutentificadorJWT::CrearToken($encargado[0]);
            $newResponse = $response->withJson($token, 200);
        } else {
            $newResponse = $response->withJson("Nop", 200);
        }
        return $newResponse;
    }

    /////////////////////////////////INFORMES////////////////////////////////////////////

    public function traerOperacionesDeTodosLosEncargados($request, $response, $args){
        $OperacionesDeTodosLosEncargados = Log::all();
        $newResponse = $response->withJson($OperacionesDeTodosLosEncargados, 200);  
        return $newResponse;
    }
}
