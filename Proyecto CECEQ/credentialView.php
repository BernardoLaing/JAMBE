<?php
include("partials/session_functions.php");

if(!$_SESSION["permisos"][27])
    header('Location: menu.php');

$title = "Consultar Credencial";
require_once("utils.php");
require_once("regexps.php");
$a = "id not valid";
if(isset($_GET["id"])&&$_GET["id"]!=null&&test($NUMBER, $_GET["id"]))
    $a = json_encode(buildAssocArray(queryCredencial($_GET["id"])));
include("partials/_header.html");
include("partials/_top_bar.html");
include("permissions.php");
include("html/credential.html");
$link="https://www.youtube.com/embed/WVF4j5VMpH4?autoplay=1";
include("html/manualUsuario.html");
include("partials/_bottom_bar.html");
include("partials/_footer.html");

?>
<script src="js/credential.js"></script>
<script>
    $(document).ready(function(){
        $.loadData(<?php echo $a ?>, <?php echo $_GET["id"] ?>);
    });
</script>

<?php
if(isset($_SESSION['credential_msg']) && $_SESSION['credential_msg']){
    echo "<script>
            $(document).ready(function (e) {
                $('#modalCredential').modal('show');
            });
        </script>";
    $_SESSION['credential_msg'] = 0;
}
?>