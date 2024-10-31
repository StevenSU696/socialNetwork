<?php
//Debut/Reprise de la session
session_start();
//Définie INCLUDE_ALLOWED et autorise la page à accéder à dbFunctions.php
define('INCLUDE_ALLOWED', true);
include_once "dbFunctions.php";

if (!empty($_POST)) {
    if (newUser($_POST)) {
        echo "Utilisateur créé";
    } else {
        echo "Erreur lors de la création de l'utilisateur";
    }
} else {
    echo "<div>Formulaire de création d'un utilisateur</div>
    <form action='newUser.php' method='post'>
        <label for='lastname'>Nom:</label>
            <input required pattern='[A-Za-zÀ-ÖØ-öø-ÿ\s]+' value='' type='text' name='lastname' id='lastname' /><br>
        <label for='firstname'>Prenom:</label>
            <input required pattern='[A-Za-zÀ-ÖØ-öø-ÿ\s]+' value='' type='text' name='firstname' id='firstname' /><br>
        <label for='password1on2'>Mot de passe:</label>
            <input required value='' type='password' name='password1on2' id='password' /><br>
        <label for='password2on2'>Veuillez confirmer et resaisir le meme mot de passe:</label>
            <input required value='' type='password' name='password2on2' id='password' /><br>
        <label for='email'>email:</label>
            <input required value='' type='email' name='email' id='email' /><br>
             <button type='submit' name='submit' id='submit' value='newUser'>Créer</button>
    </form><br>
";
}
