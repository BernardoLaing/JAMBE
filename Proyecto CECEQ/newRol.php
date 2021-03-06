<?php 
session_start();
require_once('utils.php');
require_once('model/rbac-utils.php');
?>
<?php
if(isset($_POST["submit"])){
    //Validar que los campos se hayan llenado de la manera correcta.
    if(isset($_POST["name"]) && isset($_POST["description"] )){
        $description = process($_POST["description"]);
        $name = process($_POST["name"]);
       
        if(strlen($description) > 0 &&
          strlen($description) <= 50 &&
          strlen($name) > 0 &&
          strlen($name) <= 50 &&
          isset($_POST["permissions"])){
            $permissions = $_POST["permissions"];

            if(createRol($name, $description, $permissions)){
                header('Location: rols.php');
            }else{
                header('Location: rolsCreate.php');
            }
            
        }else{
            $_SESSION['error_type'] = "rolConflict";
            $_SESSION['error_msg'] = "No agregaste ningun permisos al rol";
            header('Location: rolsCreate.php');
        }
    }
    echo "NOT ISSET";
}
echo "NOT SUBMIT";

function process($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>