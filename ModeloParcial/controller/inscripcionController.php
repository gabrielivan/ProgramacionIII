<?php
class InscripcionController
{
    public $inscripcionesDao; //se crea un inscripcionesDao para luego poder usar las funciones del GenericDao
    public $materiasDao; //se crea un materiasDao para luego poder usar las funciones del GenericDao

    public function __construct()
    {
        $this->inscripcionesDao = new GenericDao('./inscripciones.txt'); //instancia inscripcionesDao con el constructor del GenericDao pasandole el archivo de inscripciones
        $this->materiasDao = new GenericDao('./materias.txt'); //instancia materiasDao con el constructor del GenericDao pasandole el archivo de materias
        $this->alumnosDao = new GenericDao('./alumnos.txt'); //instancia alumnosDao con el constructor del GenericDao pasandole el archivo de alumnos
    }

    //Inscribe un alumno en el archivo de inscripciones
    function inscribirAlumno($nombreAlumno, $apellidoAlumno, $emailAlumno, $nombreMateria, $codigoMateria) {
        //Valido que la materia exista mediante el codigo del la materia recibido por parametro
        $materiaObtenida = $this->materiasDao->getObjectByKeyCaseInsensitive("codigo", $codigoMateria);
        //Valido que el alumno exista mediante el email del alumno recibido por parametro
        $alumnoObtenido = $this->alumnosDao->getObjectByKeyCaseInsensitive("email", $emailAlumno);
        
        if(!is_null($alumnoObtenido) && !is_null($materiaObtenida) && $materiaObtenida->cupo > 0){
            $inscripcion = new Inscripcion($alumnoObtenido->nombre, $alumnoObtenido->apellido, $alumnoObtenido->email, $materiaObtenida->nombre, $materiaObtenida->codigo); //crea la inscripcion apartir de los campos de la materia obtenida y el alumno obtenido
            $rta = $this->inscripcionesDao->guardar($inscripcion); //Guarda la inscripcion
            if ($rta === true) {
                //materia con cupo restado
                $cupoRestado = $materiaObtenida->cupo - 1;
                $materiaAux = new Materia($materiaObtenida->nombre, $materiaObtenida->codigo,  (string)$cupoRestado, $materiaObtenida->aula); //crea una materia con el cupo restado
                $rta = $this->materiasDao->modificar("codigo",$codigoMateria, $materiaAux); //modifica la materia con el cupo ya restado
                if($rta === true)
                {
                    echo 'Se inscribio el alumno';
                }
                else
                {
                    echo 'Hubo un error al restar el cupo de la materia';
                }
            } else {
                echo 'Hubo un error al inscribir el alumno';
            }
        }
        else
        {
            echo 'Hubo un error al inscribir el alumno  ';
        }
    }
    
    //Lista todas las inscripciones del archivo inscripciones
    function mostrarInscripciones(){
        $rta = $this->inscripcionesDao->listar();
        if ($rta !== null) {
            echo $rta;
        } else {
            echo 'Hubo un error al mostrar la informacion';
        }
    }

    //Lista las inscripciones apartir de un filtro recibido por el $GET
    function mostrarInscripcionesFiltro($GET){
        $rta = "";
        if(array_key_exists("codigoMateria", $GET) && !array_key_exists("apellidoAlumno", $GET))//pregunta si el filtro que recibiste es por codigo de la materia y no por apellido (ya que no se puede filtrar por 2 campos a la ves)
        {
            $rta = "Alumnos filtrados por materia\n" . $this->inscripcionesDao->getObjtecsByKeyCaseInsensitive("codigoMateria", $GET["codigoMateria"]); //Obtiene todas las inscripciones por ese codigo de la materia recibido en el $GET
        }
        elseif(array_key_exists("apellidoAlumno", $GET) && !array_key_exists("codigoMateria", $GET)) //pregunta si el filtro que recibiste es por apellido y no por codigo de la materia (ya que no se puede filtrar por 2 campos a la ves)
        {
            $rta = "Alumnos filtrados por apellido\n" . $this->inscripcionesDao->getObjtecsByKeyCaseInsensitive("apellidoAlumno", $GET["apellidoAlumno"]);
        }
        elseif(array_key_exists("apellidoAlumno", $GET) && array_key_exists("codigoMateria", $GET)) //pregunta si el filtro que recibiste es por codigo de la materia y por apellido (ya que no se puede filtrar por 2 campos a la ves da error)
        {
            $rta = "no se pueden filtrar los campos apellido y materia juntos";
        }

        echo $rta;
    }
}