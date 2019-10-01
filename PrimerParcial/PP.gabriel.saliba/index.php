<?php
include './clases/usuario.php';
include './controller/usuarioController.php';
include './clases/genericDao.php';

$request = ($_SERVER['REQUEST_METHOD']);
$usuarioController = new UsuarioController();

try {
    switch ($request) {
        case "POST":
            if (isset($_POST["case"])) {
                switch ($_POST["case"]) {
                    case "cargarUsuario":
                        if (isset($_POST["nombre"]) && isset($_POST["legajo"]) && isset($_POST["email"]) && isset($_POST["clave"]) && isset($_FILES["fotoUno"]) && isset($_FILES["fotoDos"])) {
                            $usuarioController->cargarUsuario($_POST["nombre"], $_POST["legajo"], $_POST["email"], $_POST["clave"], $_FILES["fotoUno"], $_FILES["fotoDos"]);
                        } else {
                            echo "Hubo un error en los datos enviados";
                        }
                        break;
                    
                    case "modificarUsuario":
                    if (isset($_POST["legajo"])) {
                        $usuarioController->modificarUsuario($_POST, $_FILES);
                    } else {
                        echo "Hubo un error en los datos enviados";
                    }
                    break;
                }
            } else {
                echo 'Indique el case correctamente';
            }
            break;
        case "GET":
            if (isset($_GET["case"])) {
                switch ($_GET["case"]) {
                    case "login":
                        if(true) {
                            echo $usuarioController->consultarUsuario($_GET["legajo"], $_GET["clave"]);
                        } else {
                            echo 'Indique el legajo y clave';
                        }
                        break;
                    case "verUsuarios":
                    if(true) {
                        echo $usuarioController->consultarUsuarios();
                    } else {
                        echo 'Error';
                    }
                    break;
                    
                    case "verUsuario":
                    if(true) {
                        echo $usuarioController->consultarUsuarioDos($_GET["legajo"]);
                    } else {
                        echo 'Error';
                    }
                    break;
                }
            } else {
                echo 'Indique el case correctamente';
            }
            break;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
