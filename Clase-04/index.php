<?php
    INCLUDE './clases/alumno.php';
    INCLUDE './clases/genericDao.php';
    $request = ($_SERVER['REQUEST_METHOD']);
    $dao = new GenericDao('./texto.txt');

    switch($request){
        case "POST" : 
            switch($_POST["case"]){
                case "alta" :
                    if(isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["legajo"]) && isset($_FILES["imagen"])) {
                    $tmpName = $_FILES["imagen"]["tmp_name"];
                    $extension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
                    $filename = "./imagenes/".$_POST["legajo"].".".$extension;
                    $rta = move_uploaded_file($tmpName, $filename);
                    if($rta == true) {
                        $alumno = new Alumno($_POST["nombre"], $_POST["apellido"], $_POST["legajo"], $filename);
                        $dao->guardar($alumno);
                        echo 'Saved';
                    }
                    else {
                        echo 'Something went wrong';
                    }  
                }
                break;

                case "modificacion" :
                    if (isset($_POST["legajo"]) && isset($_FILES["imagen"])) {
                    $tmpName = $_FILES["imagen"]["tmp_name"];
                    $extension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
                    $filename = "./imagenes/".$_POST["legajo"].".".$extension;
                    $rta = move_uploaded_file($tmpName, $filename);
                    if($rta == true) {
                        $dao->modificar("legajo", $_POST["legajo"],"imagen", $filename);
                        echo 'Modified';
                    }
                    else {
                        echo 'Something went wrong';
                    }  
                }
                break;

                case "borrar" :
                    if(isset($_POST["legajo"])){
                        $dao->borrar("legajo", $_POST["legajo"]);
                    }
                    break;
            }

        case "GET" : 
            echo $dao->listar();
            break;
    }
?>