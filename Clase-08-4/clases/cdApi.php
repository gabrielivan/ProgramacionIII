<?php
class cdApi
{
    public $alumnoController;

    public function __construct()
    {
        $this->alumnoController = new AlumnoController();
    }

    
    public function controllerGet($request, $response, $args){ 
        $case = $args['case'];
        
        if(array_key_exists("campo", $args)){
            $campo = $args['campo'];
        }
        else{
            $campo = null;
        }

        switch($case){
            case "traerTodos":
                $this->traerTodos($request, $response, $args);
                break;
            case "traerUno":
                if($campo != null){
                    $this->traerUno($request, $response, $args, $campo);
                }
                else{
                    echo "Falta especificar el campo";
                }
                break;
            case "traerTodosExceptoUnCampo":
                if($campo != null){
                    $this->traerTodosExceptoUnCampo($request, $response, $args, $campo);
                }
                else{
                    echo "Falta especificar el campo";
                }
                break;
        }
    }

    public function controllerPost($request, $response, $args){ 
        $case = $args['case'];
        
        switch($case){
            case "cargarUno":
                $this->cargarUno($request, $response, $args);
                break;
                
            case "modificarUno":
                $this->modificarUno($request, $response, $args);
                break;
        }
    }
    
    
    
    public function traerTodos($request, $response, $args){ 
        $alumnos = $this->alumnoController->mostrarAlumnos();
        return $response->getbody()->write($alumnos);
    }

    public function traerTodosExceptoUnCampo($request, $response, $args, $campo){
        $campo = $campo; 
        $alumnos = $this->alumnoController->mostrarAlumnosExceptoUnCampo($campo);
        return $response->getbody()->write($alumnos);
    }
    
    public function traerUno($request, $response, $args, $campo){ 
        $apellido = $campo;
        $alumno = $this->alumnoController->consultarAlumno($apellido);
        return $response->getbody()->write(json_encode($alumno));
    }

    public function cargarUno($request, $response, $args){ 
        $arrayDeParametros = $request->getParsedBody();
        $nombre = $arrayDeParametros['nombre'];
        $apellido = $arrayDeParametros['apellido'];
        $email = $arrayDeParametros['email'];
        $archivos = $request->getUploadedFiles();
        $foto = $archivos['foto'];
        
        $rv = $this->alumnoController->cargarAlumno($nombre, $apellido, $email, $foto);
        return $response->getbody()->write($rv);
    }

    public function modificarUno($request, $response, $args){ 
        $archivos = $request->getUploadedFiles();
        $parametros = $request->getParsedBody(); 
        $rv = $this->alumnoController->modificarAlumno($archivos, $parametros);
        return $response->getbody()->write($rv);
    }

    public function borrarUno($request, $response, $args){ 
        $arrayDeParametros = $request->getParsedBody();
        $email = $arrayDeParametros['email'];
        $rv = $this->alumnoController->borrarAlumno($email);
        return $response->getbody()->write($rv);
    }


}