<?php

//Controle que la personne n'accede pas à la page dbFunctions.php directement
//Si la constante INCLUDE_ALLOWED n'est pas définie, on redirige l'utilisateur vers la page index.php
if (!defined('INCLUDE_ALLOWED')) {
    die("Accès direct interdit.");
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
    $sql = "SELECT prenom, id,mot_de_passe FROM utilisateur  where prenom=?";
    $stmt = dbConnect()->prepare($sql);
    $stmt->execute([$userName]);
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
        $sql = "insert into post (utilisateur_id,contenu,date_publication) values(?, ?, ?)";
        $stmt = dbConnect()->prepare($sql);
        $result = $stmt->execute([$_SESSION['id'], $_POST['user_post'], $date]);
        if ($result) {
            $dbh = null;
            return true;
        } else {
            $dbh = null;
            return  false;
        }
    }
}


//Récupére les posts de l'utilisateur
//Fonction à finir
function userPost($userId)
{
    $sql = "select contenu,date_publication from post where utilisateur_id=?";
}


//Création d'un nouvel utilisateur via formulaire newUser.php
function newUser($POST)
{
    if ($POST['lastname'] && $POST['firstname'] && $POST['password1on2'] && $POST['password2on2'] && $POST['email']) {
        if ($POST['password1on2'] == $POST['password2on2']) {
            $password = password_hash($POST['password1on2'], PASSWORD_DEFAULT);
            $date = date("Y-m-d");
            $sql = "insert into utilisateur (nom,prenom,mot_de_passe,email,date_inscription) values(?,?,?,?,?)";

            try {
                $stmt = dbConnect()->prepare($sql);
                $result = $stmt->execute([$POST['lastname'], $POST['firstname'], $password, $POST['email'], $date]);
                $dbh = null;
                return true;
            } catch (PDOException $e) {
                $dbh = null;
                return false;
            }
        }
    }
}
