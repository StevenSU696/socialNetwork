<?php
session_start();

//Page initié par l'envois du formulaire HomeUser

//Si il n'y a rien dans le champ Utilisateur de $_SESSION, on redirige vers la page index.php
if (empty($_SESSION['username'])) {
    header("location: /index.php");
}


//Si le formulaire a été rempli, on se connecte à la base de données
//Sinon on redirige vers l'espace homeUser.php
if (isset($_POST)) {
    $conn = new mysqli("localhost", "root", "", "firstdb");
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }
} else {
    header("location: /homeUser.php");
}


//Requete MYSQL
//Récupération de la date actuelle
$date = date("Y-m-d");
//Requete s'enclenche si le formulaire HomeUser a bien été rempli.
if (!empty($_POST['user_message'])) {
    $sql = "insert into post (utilisateur_id,contenu,date_publication) values('$_SESSION[id]', '$_POST[user_message]', '$date')";
    $result = $conn->query($sql);
    echo "<meta http-equiv='refresh' content='3;url=/homeUser.php'>Le poste a bien été publié";
}
//Si le formulaire n'a pas été rempli, on redirige l'utilisateur vers la page homeUser.php
else {
    echo "<meta http-equiv='refresh' content='3;url=/homeUser.php'>Il y a eu une erreur, votre publication n'a pas été enregistré";
}
