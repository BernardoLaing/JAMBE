<?php
require_once "utils.php";
$respuesta = 'venga '.$_GET["name"] .' '. $_GET["apellidop"] .' '. $_GET["apellidom"] .' '. $_GET["title"].' '. $_GET["pagina"].' '. $_GET["categoria"] ;

//$result=buscarGeneral($_GET["name"] , $_GET["apellidop"], $_GET["apellidom"], $_GET["title"]);
$result=buscarGeneral('%'.$_GET["name"].'%' , $_GET["apellidop"], $_GET["apellidom"], '%'.$_GET["title"].'%');


if(mysqli_num_rows($result) > 0)
        {
            //echo 'hola a ajax 2 func';
            while($row = mysqli_fetch_assoc($result))
            {
                echo '<tr><td>' .$row['titulo']. '</td><td>'. $row['nombreA']. '</td><td>'. $row['year'] . '</td><td>'. $row['estante']. '</td><td>'. $row['editorial'] .'</td><td>'.$row['nombre']. '</td><td>'. $row['nombre']. '</td></tr>';
            }
        }

?>