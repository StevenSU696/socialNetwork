<?php
//Debut/Reprise de la session
session_start();
//Définie INCLUDE_ALLOWED et autorise la page à accéder à dbFunctions.php
define('INCLUDE_ALLOWED', true);
include_once "dbFunctions.php";

if (checkUserLogged()) {
    echo "Bienvenu à toi " . $_SESSION["username"];
} else {
    header("location: /index.php");
}

if (isset($_POST['logout'])) {
    $_SESSION = [];
    session_destroy();
    header('location: /index.php');
}
?>





<form action="homeUser.php" method="post">
    <button type="submit" name="logout" id="logout" value="Logout">Logout</button>
</form>


<form action="userPost.php" method="post">
    <label for="user_message">Message/Post:</label><br>
    <textarea type="text" name="user_post" id="user_post" rows="5"></textarea><br>
    <button type="submit" name="userpost" id="post" value="userpost">Publier le post</button>
</form>


<?php

foreach (userPost() as $message) {
    echo "<br><div>" . $message['prenom'] . " " . $message['nom'] . " a posté : <br>"
        . $message['contenu'] . "<br>" . $message['date_publication'] . "</div>";
    if ($message['utilisateur_id'] == $_SESSION['id']) {
        echo "<form action='deletePost.php' method='post'>
            <button type='submit' name='delete' id='delete' value='delete'>Supprimer</button><br><br>";
    }
}

?>