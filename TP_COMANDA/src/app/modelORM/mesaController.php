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
            $newResponse = $mesaLibre->codigoMesa;
            self::cambiarEstado($mesaLibre->codigoMesa, 1);
        }
        else
        {
            $newResponse = null;
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

    ////////////////////////////////INFORMES////////////////////////////////////////////
    public function traerMesaMasUsada($request, $response, $args)
    {
        $mesasIguales = false;
        $codigosMesa = [];
        $mayor = 0;
        $mesaMasUsada = "";
        $pedidos = Pedido::all();
        foreach ($pedidos as $pedido) {
            array_push($codigosMesa, $pedido->codigoMesa);
        }

        $valores = array_count_values($codigosMesa);
        
        foreach ($valores as $key => $value){
            if($value > $mayor){
                $mayor = $value;
                $mesaMasUsada = $key;
                $mesasIguales = false;
            }
            elseif($value == $mayor){
                $mesasIguales = true;
            }
        }
        if($mesasIguales == false){
            $newResponse = $response->withJson("La mesa mas usada es la: " .$mesaMasUsada, 200);
        }
        else{
            $newResponse = $response->withJson("No hay una mesa que se haya usado mas que la otra", 200);
        }
        return $newResponse;
    }

    public function traerMesaMenosUsada($request, $response, $args)
    {
        $mesasIguales = false;
        $primerVuelta = true;
        $codigosMesa = [];
        $menor = "";
        $mesaMenosUsada = "";
        $pedidos = Pedido::all();
        foreach ($pedidos as $pedido) {
            array_push($codigosMesa, $pedido->codigoMesa);
        }

        $valores = array_count_values($codigosMesa);
        
        foreach ($valores as $key => $value){
            if($value < $menor || $primerVuelta == true){
                $menor = $value;
                $mesaMenosUsada = $key;
                $primerVuelta = false;
                $mesasIguales = false;
            }
            elseif($value == $menor){
                $mesasIguales = true;
            }
        }
        if($mesasIguales == false){
            $newResponse = $response->withJson("La mesa menos usada es la: " .$mesaMenosUsada, 200);
        }
        else{
            $newResponse = $response->withJson("No hay una mesa que se haya usado menos que la otra", 200);
        }
        return $newResponse;
    }
    
    public function traerMesaConElMayorImporte($request, $response, $args)
    {
        $mesasIguales = false;
        $mayor = 0;
        $mesaQueMasFacturo = "";
        $tickets = Ticket::all();
        
        foreach ($tickets as $ticket) {
            if($ticket->precioTotal > $mayor){
                $mayor = $ticket->precioTotal;
                $mesaQueMasFacturo = $ticket->mesa;
                $mesasIguales = false;
            }
            elseif($ticket->precioTotal == $mayor){
                $mesasIguales = true;
            }
        }
        if($mesasIguales == false){
            $newResponse = $response->withJson("La mesa que mas facturo es la: " .$mesaQueMasFacturo. " y la cantidad es de: ".$mayor, 200);
        }
        else{
            $newResponse = $response->withJson("No hay una mesa que haya facturado mas que la otra", 200);
        }
        return $newResponse;
    }

    public function traerMesaConElMenorImporte($request, $response, $args)
    {
        $primerVuelta = true;
        $mesasIguales = false;
        $menor = "";
        $mesaQueMenosFacturo = "";
        $tickets = Ticket::all();
        
        foreach ($tickets as $ticket) {
            if($ticket->precioTotal < $menor || $primerVuelta == true){
                $menor = $ticket->precioTotal;
                $mesaQueMenosFacturo = $ticket->mesa;
                $mesasIguales = false;
                $primerVuelta = false;
            }
            elseif($ticket->precioTotal == $menor){
                $mesasIguales = true;
            }
        }
        if($mesasIguales == false){
            $newResponse = $response->withJson("La mesa que menos facturo es la: " .$mesaQueMenosFacturo. " y la cantidad es de: ".$menor, 200);
        }
        else{
            $newResponse = $response->withJson("No hay una mesa que haya facturado menos que la otra", 200);
        }
        return $newResponse;
    }

}
