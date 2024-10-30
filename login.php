<?php
//Debut/Reprise de la session
session_start();
//Définie INCLUDE_ALLOWED et autorise la page à accéder à dbFunctions.php
define('INCLUDE_ALLOWED', true);
include_once "dbFunctions.php";

//Si il n'y a pas d'utilisateur dans $_SESSION
//Se connecter à la base de donnée pour vérifier le login.
if (checkUserLogged() == false) {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        dbConnect();
        $user = dbLogin($_POST["username"], $_POST["password"]);
        if ($user) {
            header("location: /homeUser.php");
        }
    }
} else header("location: /homeUser.php");


if (!isset($_SESSION["username"])) {
    echo "<meta http-equiv='refresh' content='5;url=/homeUser.php'>Erreur, les informations saises sont incorrectes, vous allez etre redirigés à l'index";
    $_SESSION = [];
    session_destroy();
}
