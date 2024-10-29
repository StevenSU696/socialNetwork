<?php
session_start();


if (!isset($_SESSION['username'])) {
    //Connexion à la base de données MySQL
    $conn = new mysqli("localhost", "root", "", "firstdb");
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    //Requete 
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $sql = "SELECT prenom, id FROM utilisateur  where prenom='$_POST[username]' and mot_de_passe='$_POST[password]'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    if (isset($row)) {
        $_SESSION['username'] = $row["prenom"];
        $_SESSION['id'] = $row["id"];
    }
}


if (!isset($_SESSION['username'])) {
    echo "<meta http-equiv='refresh' content='5;url=/homeUser.php'> Tu n'existe pas dans la base de données ou tu a tapé un mauvais mot de passe";
    $_SESSION = [];
}
