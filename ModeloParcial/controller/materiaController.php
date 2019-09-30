<?php
class MateriaController
{
    public $materiasDao; //se crea un materiasDao para luego poder usar las funciones del GenericDao

    public function __construct()
    {
        $this->materiasDao = new GenericDao('./materias.txt'); //instancia materiasDao con el constructor del GenericDao pasandole el archivo de materias
    }

    //carga una materia apartir de los parametros recibidos
    function cargarMateria($nombre, $codigo, $cupo, $aula) {                           
        $materiaExistente = $this->materiasDao->getObjectByKeyCaseInsensitive("codigo", $codigo); //se fija que la materia exista para luego poder preguntar que sea null ya que si no es null no poder cargar la misma materia 
        if (is_null($materiaExistente)) { // si es null esta ok!
            $materia = new Materia($nombre, $codigo, $cupo, $aula); //se genera una nueva materia
            $this->materiasDao->guardar($materia); //se guarda la materia
            echo 'Se cargo la materia ' . $materia->nombre;
        } else {
            echo 'Hubo un error al guardar';
        }
    }
    
}