<?php
REQUIRE_ONCE 'clases/persona.php';
REQUIRE_ONCE 'clases/alumno.php';
REQUIRE_ONCE 'funciones.php';

    //Ejercicio 1
    $nombre = "";
    $apellido = "";

    echo "Ingrese su Nombre: ";
    echo "\nIngrese su Apellido: ";

    $nombre = "Gabriel";
    $apellido = "Saliba";

    echo "\n".$apellido.",".$nombre;

    //Ejercicio 2
    echo "\n\n";

    $x = -3;
    $y = 15;
    $resultadoFinal = $x + $y;

    echo "Resultado final: ".$resultadoFinal;

    //Ejercicio 3
    echo "\n\n";
    echo $x;
    echo "<br/>";
    echo $y;
    echo "<br/>";
    echo $resultadoFinal;

    //clase

    // $personaUno = new Persona("Gaby", 42118165);
    // var_dump($personaUno);
    // $personaUno->saludar();

    $alumnoUno = new Alumno("Gaby", 42118165, 1001, 3);
    var_dump($alumnoUno);
    $alumnoUno->saludar();
    
?>