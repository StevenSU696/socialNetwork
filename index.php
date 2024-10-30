    <?php
    //Debut de la session
    session_start();
    //Definie la constante INCLUDE_ALLOWED pour autoriser l'accès à dbFunctions.php
    define('INCLUDE_ALLOWED', true);
    include_once 'dbFunctions.php';

    //Si l'utilisateur est déjà connecté, on le redirige vers la page homeUser.php
    //Autrement, on le laisse accéder au formulaire de login
    if (checkUserLogged()) {
        echo "<meta http-equiv='refresh' content='10;url=/homeUser.php'><div>Vous etes déjà connecté</div><br>
        <a href='homeUser.php'>Vous allez etre redirigé ou cliquer ici</a>";
    } else {
        echo "<div>Entrez vos identifiants </div>
    <form action='login.php' method='post'>
        <label for='username'>Nom d'utilisateur:</label>
        <input required value='' type='text' name='username' id='username' /><br>
        <label for='password'>Mot de passe:</label>
        <input required value='' type='password' name='password' id='password' /><br>
        <button type='submit' name='submit' id='submit' value='Login'>LOGIN</button>
    </form><br>
    <a href='newUser.php'> Créer un nouveau compte</a>";
    }
    ?>