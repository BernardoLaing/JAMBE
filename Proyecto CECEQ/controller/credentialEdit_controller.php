<?php
require_once("../regexps.php");
require_once("../utils.php");

session_start();
$hasImage = false;
if($_FILES["fileToUpload"]["tmp_name"]!=null) {
    if (getimagesize($_FILES["fileToUpload"]["tmp_name"]) != FALSE) {
        $hasImage = true;
        $target_dir = "../uploads/credenciales/" . date("Y");
        if (!is_dir($target_dir))
            mkdir($target_dir);
        $target_dir = $target_dir . "/" . date("m");
        if (!is_dir($target_dir))
            mkdir($target_dir);
        $target_dir = $target_dir . "/";
    }
}
/*
if(count($_POST)>0){
    foreach($_POST["credential"] as $key => $value) {
        echo $key . ": " . $value . "<br>";
    }
}
*/
if(count($_POST)>0){
    if(!isset($_POST["credential"]["gender"]) || !test($GENDER, $_POST["credential"]["gender"])){
        $_POST["credential"]["gender"] = null;
    }
    if(!isset($_POST["credential"]["schooling"]) || !test($SCHOOLING, $_POST["credential"]["schooling"])){
        $_POST["credential"]["schooling"] = null;
    }
}


if(count($_POST)>0
    // Visitante
    && (test($NAME, $_POST["credential"]["name"]))
    && (test($NAME, $_POST["credential"]["paternal"]))
    && (test($NAME, $_POST["credential"]["maternal"] ))
    && (test($DATE, $_POST["credential"]["birth"] ))
    && (test($GENDER, $_POST["credential"]["gender"] ))
    && (test($SCHOOLING, $_POST["credential"]["schooling"] ))
    // Credencial
    // no va --> && ((getimagesize($_FILES["fileToUpload"]["tmp_name"]) != FALSE))
    && (($_POST["credential"]["email"]  !== null))
    && (test($NAME, $_POST["credential"]["street"] ))
    && (test($NUMBER, $_POST["credential"]["number"] ))
    && (test($NAME, $_POST["credential"]["neighborhood"] ))
    && (test($NUMBER, $_POST["credential"]["postalCode"] ))
    && (test($NUMBER, $_POST["credential"]["phone"] ))
    && (test($NAME, $_POST["credential"]["workName"] ))
    && (test($NUMBER, $_POST["credential"]["workPhone"] ))
    && (test($NAME, $_POST["credential"]["workStreet"] ))
    && (test($NUMBER, $_POST["credential"]["workNumber"] ))
    && (test($NAME, $_POST["credential"]["workNeighborhood"] ))
    && (test($NUMBER, $_POST["credential"]["workPostalCode"] ))
    // Fiador
    && (test($NAME, $_POST["credential"]["nameF"]))
    && (test($NAME, $_POST["credential"]["paternalF"]))
    && (test($NAME, $_POST["credential"]["maternalF"] ))
    && (($_POST["credential"]["emailF"]  != null) )
    && (test($NUMBER, $_POST["credential"]["phoneF"] ))
    && (test($SCHOOLING, $_POST["credential"]["schoolingF"] ))
    && (test($NAME, $_POST["credential"]["streetF"] ))
    && (test($NUMBER, $_POST["credential"]["numberF"] ))
    && (test($NAME, $_POST["credential"]["neighborhoodF"] ))
    && (test($NUMBER, $_POST["credential"]["postalCodeF"] ))
    && (test($NAME, $_POST["credential"]["workNameF"] ))
    && (test($NUMBER, $_POST["credential"]["workPhoneF"] ))
    && (test($NAME, $_POST["credential"]["workStreetF"] ))
    && (test($NUMBER, $_POST["credential"]["workNumberF"] ))
    && (test($NAME, $_POST["credential"]["workNeighborhoodF"] ))
    && (test($NUMBER, $_POST["credential"]["workPostalCodeF"] ))
){
    //exit("entro");
    $nulls = 0;
    foreach($_POST["credential"] as $key => $value){

        if($value != null)
            $info[$key] = htmlspecialchars($value);
        else{
            $info[$key] = "";
            $nulls++;
        }
    }
    $info["idVisitante"] = htmlspecialchars($_POST["idVisitante"]);
    //$_FILES["fileToUpload"]["tmp_name"] = "fakepath/adf";

    if($hasImage) {
        if ($_FILES["fileToUpload"]["tmp_name"] != null) {
            $info["fileToUpload"] = $_FILES["fileToUpload"]["tmp_name"];
        } else {
            $info["fileToUpload"] = "";
            $nulls++;
        }
    }

    if(isset($info)) {
        $ftuccc = buildAssocArray(getCurrentPhoto($info["idVisitante"]))["fileToUpload"];
        $target_file = $hasImage? $target_dir . basename($_FILES["fileToUpload"]["name"]) : $ftuccc;
        if($nulls == 0){
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            if(
            updateCredential(
            // Visitante
            $info["idVisitante"],

                $info["name"], $info["paternal"], $info["maternal"], $info["birth"], $info["schooling"], $info["gender"],
                // Credencial
                $target_file, $info["neighborhood"], $info["street"], $info["number"], $info["postalCode"], $info["phone"], $info["email"], $info["workName"], $info["workPhone"], $info["workNeighborhood"], $info["workStreet"], $info["workNumber"], $info["workPostalCode"],
                //Fiador
                $info["nameF"], $info["paternalF"], $info["maternalF"], $info["emailF"], $info["phoneF"], $info["streetF"], $info["numberF"], $info["neighborhoodF"], $info["postalCodeF"], $info["workNameF"], $info["workPhoneF"], $info["workStreetF"], $info["workNumberF"], $info["workNeighborhoodF"], $info["workPostalCodeF"], $info["schoolingF"]
            )){

                $_SESSION['credential_msg'] = 1;
                $_SESSION['msg'] = "La credencial fue editada con éxito";

            }
        }
    }
}else{
    $_SESSION['credential_msg'] = 1;
    $_SESSION['msg'] = "La credencial no pudo ser modificada";
}
header("Location: ../credentialView.php?id=".$_POST["idVisitante"]);


?>
