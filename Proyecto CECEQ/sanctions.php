<?php
include("partials/session_functions.php");
if(!$_SESSION["permisos"][20])
    header('Location: menu.php');
include("partials/_header.html");
include("partials/_top_bar.html");
include("html/sanctions.html");
$link="https://www.youtube.com//embed/PptNXwj6kN0?autoplay=1";
include("html/manualUsuario.html"); 
include("partials/_bottom_bar.html"); 
include("partials/_footer.html");
?>
