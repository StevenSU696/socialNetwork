<?php
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
            return true;
        }
    } else {
        return  false;
    }
}
