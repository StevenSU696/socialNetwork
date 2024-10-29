    <?php
    //Debut de la session
    session_start();
    //
    if (!empty($_SESSION['username'])) {
        header("location: /logged.php");
    } elseif (empty($_SESSION['username'])) {
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