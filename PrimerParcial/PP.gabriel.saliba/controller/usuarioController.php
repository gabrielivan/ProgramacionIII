<?php
class UsuarioController
{
    public $usuariosDao; //se crea un usuariosDao para luego poder usar las funciones del GenericDao

    public function __construct()
    {
        $this->usuariosDao = new GenericDao('./usuarios.txt'); //instancia usuariosDao con el constructor del GenericDao pasandole el archivo de usuario
    }

    
    //Carga un usuario en el archivo de usuarios
    function cargarUsuario($nombre, $legajo, $email, $clave, $fotoUno, $fotoDos) 
    {
        //Valido que el usuario que se desea cargar no existe en el archivo de usuarios   
        $usuarioExistente = $this->usuariosDao->getObjectByKeyCaseInsensitive("legajo", $legajo); //busca el usuario por el email recibido por parametro, en el archivo de usuarios
        if (is_null($usuarioExistente)) { 
            $tmpNameUno = $fotoUno["tmp_name"]; //obtiene el nombre temporal de la foto recibida por parametro
            $extensionUno = pathinfo($fotoUno["name"], PATHINFO_EXTENSION); // obtiene la extencion de la foto recibida por parametro
            $filenameUno = "./imagenes/" . $legajo . "." . $extensionUno; 
            $tmpNameDos = $fotoDos["tmp_name"]; 
            $extensionDos = pathinfo($fotoDos["name"], PATHINFO_EXTENSION); 
            $filenameDos = "./imagenes/" . $legajo . "." . $extensionDos; 
            $rtaUno = move_uploaded_file($tmpNameUno, $filenameUno);
            $rtaDos = move_uploaded_file($tmpNameDos, $filenameDos);
            if ($rtaUno === true && $rtaDos === true) {
                $usuario = new Usuario($nombre, $legajo, $email, $clave, $filenameUno, $filenameDos); //se crea un usuario con los datos recibidos por parametro
                $rta = $this->usuariosDao->guardar($usuario); //se guarda dicho usuario
                if ($rta === true) {
                    echo 'Se cargo el alumno ' . $usuario->nombre . " " . $usuario->email;
                } else {
                    echo 'Hubo un error al guardar';
                }
            } else {
                echo 'Hubo un error con las fotos';
            }
        } else {
            echo "No se puede cargar el usuario";
        }
    }

    //Trae todos los alumnos que coincidan con el apellido recibido por parametro, del archivo de alumnos
    function consultarUsuario($legajo, $clave)
    {
         return $this->usuariosDao->getObjecsByTwoKeyCaseInsensitive("legajo", $legajo, "clave", $clave);
    }

    function consultarUsuarioDos($legajo)
    {
         return $this->usuariosDao->getObjectByKeyCaseInsensitive("legajo", $legajo);
    }

    //Trae todos los alumnos que coincidan con el apellido recibido por parametro, del archivo de alumnos
    function consultarUsuarios()
    {
        return $this->usuariosDao->listar();
    }

    function modificarUsuario($POST, $FILES) //El post se usa para obtener los datos del alumno y el files para los datos de la foto
    {
            $usuarioAModificar = $this->usuariosDao->getObjectByKeyCaseInsensitive("legajo", $POST["legajo"]); //obtiene el alumno que se desea modificar mediante la key email y el value de ese email ej: "gaby@gmail.com"
            if(!is_null($usuarioAModificar)) // si se obtuvo
            {
                /// Me guardo el valor actual de todas la claves del usuario, si el usuario deseará modificarlas, se pisaran.
                $nombreAux = $usuarioAModificar->nombre;
                $emailAux = $usuarioAModificar->email;
                $claveAux = $usuarioAModificar->clave;
                $fotoUnoAux = $usuarioAModificar->fotoUno;
                $fotoDosAux = $usuarioAModificar->fotoDos;
                $rta = true;
                $rtaDos = true;
                
                //pregunta si en el POST que se recibio por parametro contiene la key "apellido" para verificar si es lo que se quiere modificar y ademas pregunta si el apellido del alumno obtenido por email es distinto del apellido que hay en el POST
                if (array_key_exists("nombre", $POST) && $nombreAux != $POST["nombre"]) { 
                    $nombreAux = $POST["nombre"]; //pisa el apellido del alumno obtenido con el apellido recibido en POST
                }
                //pregunta si en el POST que se recibio por parametro contiene la key "nombre" para verificar si es lo que se quiere modificar y ademas pregunta si el nombre del alumno obtenido por email es distinto del nombre que hay en el POST
                if (array_key_exists("email", $POST) && $emailAux != $POST["email"]) {
                    $emailAux = $POST["email"];//pisa el nombre del alumno obtenido con el nombre recibido en POST
                }
                if (array_key_exists("clave", $POST) && $claveAux != $POST["clave"]) {
                    $claveAux = $POST["clave"];//pisa el nombre del alumno obtenido con el nombre recibido en POST
                }

                if (array_key_exists("fotoUno", $FILES) || array_key_exists("fotoDos", $FILES)) {
                    $fechaBkp = date("d-m-Y_H_i");// Me guardo la hora actual
                    $array = explode(".", $usuarioAModificar->fotoUno); //transformo en un array todo lo que este separado por un punto
                    $rutaParaBkp = "./imagenes/backUpFotos/" . 
                    $usuarioAModificar->legajo . $fechaBkp . "." . end($array);//Genero la ruta para almacenar la foto de backup
                    //Backup Imagen
                    rename($usuarioAModificar->fotoUno, $rutaParaBkp);// Hago backup de la foto
                    //Modificacion
                    $tmpName = $FILES["fotoUno"]["tmp_name"];
                    $extension = pathinfo($_FILES["fotoUno"]["name"], PATHINFO_EXTENSION);
                    $fotoAux = "./imagenes/" . $POST["legajo"] . "." . $extension; // Cambio el nombre de la foto y coloco email.extension
                    $rta = move_uploaded_file($tmpName, $fotoAux);

                    $fechaBkpDos = date("d-m-Y_H_i");// Me guardo la hora actual
                    $arrayDos = explode(".", $usuarioAModificar->fotoDos); //transformo en un array todo lo que este separado por un punto
                    $rutaParaBkpDos = "./imagenes/backUpFotos/" . 
                    $usuarioAModificar->legajo . $fechaBkpDos . "." . end($arrayDos);//Genero la ruta para almacenar la foto de backup
                    //Backup Imagen
                    rename($usuarioAModificar->fotoDos, $rutaParaBkpDos);// Hago backup de la foto
                    //Modificacion
                    $tmpNameDos = $FILES["fotoDos"]["tmp_name"];
                    $extensionDos = pathinfo($_FILES["fotoDos"]["name"], PATHINFO_EXTENSION);
                    $fotoAuxDos = "./imagenes/" . $POST["legajo"] . "." . $extensionDos; // Cambio el nombre de la foto y coloco email.extension
                    $rtaDos = move_uploaded_file($tmpNameDos, $fotoAuxDos);
                } 
                if($rta === true || $rtaDos === true)
                {
                    $usuarioAux = new Usuario($nombreAux, $POST["legajo"], $emailAux, $claveAux, $fotoUnoAux, $fotoDosAux); //se crea un nuevo alumno con los datos ya modificados
                    $rta = $this->usuariosDao->modificar("legajo", $POST["legajo"], $usuarioAux);
                    $rtaDos = $rta;
                    if($rta || $rtaDos)
                    {
                        echo "Modificacion realizada";
                    }
                    else{
                        echo "No se pudo realizar la modificacion";
                    }
                }
                else
                {
                    echo "Hubo un problema con la foto";
                }
            }
            else{
                echo "No se encontro el alumno";
            }
                
    }

}
