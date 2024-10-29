<?php
session_start();
include_once "dbFunctions.php";
if (empty($_SESSION['username'])) {
    header("location: /index.php");
}

echo "Bienvenu à toi " . $_SESSION["username"];
if (isset($_POST['logout'])) {
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
    <button type="submit" name="submit" id="submit" value="user_post">Publier le post</button>
</form>