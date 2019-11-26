<?php

namespace App\Models\ORM;

use App\Models\ORM\User;
use App\Models\ORM\Ingreso;
use App\Models\ORM\Egreso;
use App\Models\IApiControler;
use App\Models\AutentificadorJWT;

include_once __DIR__ . '/user.php';
include_once __DIR__ . '/ingreso.php';
include_once __DIR__ . '/egreso.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';
include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class userController implements IApiControler
{
  public function Beinvenida($request, $response, $args)
  {
    $response->getBody()->write("GET => Bienvenido!!! ,a UTN FRA SlimFramework");

    return $response;
  }

  public function TraerTodos($request, $response, $args)
  {
    $todosLosUsers = user::all();
    $newResponse = $response->withJson($todosLosUsers, 200);
    return $newResponse;
  }
  public function TraerUno($request, $response, $args)
  {
    //complete el codigo
    $newResponse = $response->withJson("sin completar", 200);
    return $newResponse;
  }

  public function CargarUno($request, $response, $args)
  {
    $arrayDeParametros = $request->getParsedBody();
    $arrayArchivos = $request->getUploadedFiles();

    if (
      array_key_exists("email", $arrayDeParametros) && array_key_exists("clave", $arrayDeParametros)
      && array_key_exists("legajo", $arrayDeParametros) && array_key_exists("fotoUno", $arrayArchivos)
      && array_key_exists("fotoDos", $arrayArchivos) && !User::where('legajo', '=', $arrayDeParametros["legajo"])->exists()) {

        $user = new User;
        $user->email = $arrayDeParametros["email"];
        $user->legajo = $arrayDeParametros["legajo"];
        $user->clave = $arrayDeParametros["clave"];
        //Foto Uno
        $extension = $arrayArchivos["fotoUno"]->getClientFilename();
        $extension = explode(".", $extension);
        $filenameUno = "./images/users/" . $user->email . "1." . $extension[1];
        $arrayArchivos["fotoUno"]->moveTo($filenameUno);

        //Foto Dos
        $extension = $arrayArchivos["fotoDos"]->getClientFilename();
        $extension = explode(".", $extension);
        $filenameDos = "./images/users/" . $user->email . "2." . $extension[1];
        $arrayArchivos["fotoDos"]->moveTo($filenameDos);


        $user->save();

        $userAMostrar = User::find($user->id);
        unset($userAMostrar["clave"]);
        unset($userAMostrar["created_at"]);
        unset($userAMostrar["updated_at"]);
        $newResponse = $response->withJson($userAMostrar, 200);
    } 
    return $newResponse;
  }
  public function BorrarUno($request, $response, $args)
  {
    //complete el codigo
    $newResponse = $response->withJson("sin completar", 200);
    return $newResponse;
  }

  public function ModificarUno($request, $response, $args)
  {
    //complete el codigo
    $newResponse = $response->withJson("sin completar", 200);
    return   $newResponse;
  }

  public function IniciarSesion($request, $response)
  {
    $arrayDeParametros = $request->getParsedBody();
    $user = User::where('legajo', '=', $arrayDeParametros["legajo"])
      ->select("users.id", "email", "legajo", "clave")
      ->get()
      ->toArray();
    $emailValido = strcasecmp($user[0]["email"],$arrayDeParametros["email"]);
    $claveValida = strcasecmp($user[0]["clave"],$arrayDeParametros["clave"]);

    if (count($user) == 1 && $claveValida == 0  && $emailValido == 0) {
      unset($user[0]["clave"]);
      $token = AutentificadorJWT::CrearToken($user[0]);
      $newResponse = $response->withJson($token, 200);
    } else {
      $newResponse = $response->withJson("Ocurrio un error al generar el token", 200);
    }
    return $newResponse;
  }

  public function ingresoUsuario($request, $response, $args)
  {
      $token = $request->getHeader("token")[0];
      $data = AutentificadorJWT::ObtenerData($token);
      $ingreso = new Ingreso;
      $ingreso->usuario = $data->email;
      $ingreso->hora = $fecha = date('H:i:s', $request->getServerParam('REQUEST_TIME'));

      //Asi obtengo el ultimo Ingreso::where("usuario", "=", $data->email)->latest('created_at')->get()->first()->toArray();
      $contadorIngresos = Ingreso::where("usuario", "=", $data->email)->select('created_at')->get()->toArray();
      $contadorEgresos = Egreso::where("usuario", "=", $data->email)->select('created_at')->get()->toArray();
      if(count($contadorEgresos) == count($contadorIngresos))
      {
        $ingreso->save();
        $newResponse = $response->withJson("Usuario ingresado correctamente", 200);
      }
      else
      {
        $newResponse = $response->withJson("El usuario ya tiene una sesion iniciada", 200);
      }
      return $newResponse;  
      
  }
  public function egresoUsuario($request, $response, $args)
  {
      $token = $request->getHeader("token")[0];
      $data = AutentificadorJWT::ObtenerData($token);
      $egreso = new Egreso;
      $egreso->usuario = $data->email;
      $egreso->hora = $fecha = date('H:i:s', $request->getServerParam('REQUEST_TIME'));
      //Asi obtengo el ultimo Ingreso::where("usuario", "=", $data->email)->latest('created_at')->get()->first()->toArray();
      $contadorIngresos = Ingreso::where("usuario", "=", $data->email)->select('created_at')->get()->toArray();
      $contadorEgresos = Egreso::where("usuario", "=", $data->email)->select('created_at')->get()->toArray();
      //No se puede egresar un usuario si no existe un ingreso previo o si la cantidad de ingresos es menor a la de egresos
      if(count($contadorIngresos) == 0 || count($contadorIngresos) <= count($contadorEgresos))
      {
        $newResponse = $response->withJson("No se puede egresar el usuario", 200);
      }
      else{
        $egreso->save();
        $newResponse = $response->withJson("Usuario egresado correctamente", 200);
      }
      return $newResponse;  
      
    }

    public function traerTodosLosIngresos($request, $response, $args)
    {
        $token = $request->getAttribute('tokenEnviado');
        $data = AutentificadorJWT::ObtenerData($token);
        var_dump($data);
     
        if($data->legajo <= 100)
        {
            $usuarios = Ingreso::distinct()->get(["usuario"])->toArray();
            if($usuarios != null)
            {
                for($i=0;$i<count($usuarios);$i++)
                {
                    $ingresos = Ingreso::where("usuario","=", $usuarios[$i]["usuario"])
                    ->select("usuario","created_at")
                    ->orderBy("created_at","desc")
                    ->first()
                    ->toArray();
                    $ultimosIngresos[] = $ingresos;
                }
                $newResponse = $response->withJson($ultimosIngresos, 200);
            }
            else{
                $newResponse = $response->withJson("No hay ingresos", 200);
            }
        }
        else
        {
            $newResponse = $response->withJson("Esta accion solo la puede cumplir un Admin", 200);
        }
        return $newResponse;
    }

}
