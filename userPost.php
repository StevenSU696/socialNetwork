<?php
//Debut/Reprise de la session
session_start();
//Définie INCLUDE_ALLOWED et autorise la page à accéder à dbFunctions.php
define('INCLUDE_ALLOWED', true);
include_once "dbFunctions.php";

//Vérifie si l'utilisateur est connecté, si non, envoyé le vers la page logged.php
if (!checkUserLogged()) {
    header("location: /logged.php");
}

//Si le formulaire Post a été rempli, 
//On lui affiche un message de confirmation et on le redirige vers homeUser
if (dbUserPost()) {
    echo "<meta http-equiv='refresh' content='10;url=/homeUser.php'>Le poste a bien été publié<br>
    <a href='homeUser.php'>Vous allez etre redirigé ou cliquer ici</a>";
}
//Si le formulaire n'a pas été rempli, on redirige l'utilisateur vers la page homeUser.php
else {
    echo "<meta http-equiv='refresh' content='10;url=/homeUser.php'>Il y a eu une erreur, votre publication n'a pas été enregistré<br>
    <a href='homeUser.php'>Vous allez etre redirigé ou cliquer ici</a>";
}
