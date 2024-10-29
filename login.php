<?php
session_start();


if (!isset($_SESSION['username'])) {
    //Connexion à la base de données MySQL
    $conn = new mysqli("localhost", "root", "", "firstdb");
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    //Requete 
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $sql = "SELECT prenom, id,mot_de_passe FROM utilisateur  where prenom='$_POST[username]'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    if (isset($row)) {
        $check = password_verify($_POST['password'], $row['mot_de_passe']);
        if ($check) {
            $_SESSION['username'] = $row["prenom"];
            $_SESSION['id'] = $row["id"];
            header("location: /homeUser.php");
        }
    }
}


if (!isset($_SESSION['username'])) {
    echo "<meta http-equiv='refresh' content='5;url=/homeUser.php'>Erreur, les informations saises sont incorrectes, vous allez etre redirigés à l'index";
    $_SESSION = [];
}
