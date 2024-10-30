<?php

//Controle que la personne n'accede pas à la page dbFunctions.php directement
//Si la constante INCLUDE_ALLOWED n'est pas définie, on redirige l'utilisateur vers la page index.php
if (!defined('INCLUDE_ALLOWED')) {
    die("Accès direct interdit.");
    header("location: /index.php");
}

//Verifie si l'utilisateur est connecté en verifiant si $_SESSION['username'] est renseigné.
function checkUserLogged()
{
    if (!empty($_SESSION['username'])) {
        return true;
    } else {
        return false;
    }
}

//Connexion à la base de donnée
function dbConnect()
{
    $host = 'localhost';
    $dbname = 'firstdb';
    $charset = 'utf8';
    $user = 'root';
    $pass = '';
    $dbh = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset; user=$user; password=$pass");
    if (isset($dbh)) {
        return $dbh;
    } else {
        return false;
    }
}

//Récupére un nom utilisateur et un mot de passe
//Si le nom utilisateur et le mot de passe concorde, return true et créer $_SESSION['username'] et $_SESSION['id']
function dbLogin($userName, $password)
{
    //préparation de la requete
    $sql = "SELECT prenom, id,mot_de_passe FROM utilisateur  where prenom='$userName'";
    $stmt = dbConnect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $check = password_verify($_POST['password'], $result['mot_de_passe']);
        if ($check) {
            $_SESSION['username'] = $result["prenom"];
            $_SESSION['id'] = $result["id"];
            $dbh = null;
            return true;
        }
    } else {
        $dbh = null;
        return  false;
    }
}

//L'utilisateur publie un Poste
//Insert User Post dans la database
//Si la requete a bien été réalisé, return true, sinon return false
function dbUserPost()
{
    if (!empty($_POST['user_post']) && isset($_SESSION['id'])) {
        $date = date("Y-m-d");
        $sql = "insert into post (utilisateur_id,contenu,date_publication) values('$_SESSION[id]', '$_POST[user_post]', '$date')";
        $stmt = dbConnect()->prepare($sql);
        $result = $stmt->execute();
        if ($result) {
            $dbh = null;
            return true;
        } else {
            $dbh = null;
            return  false;
        }
    }
}
