 <?php
    session_start();
    if (empty($_SESSION['username'])) {
        header("location: /index.php");
    } elseif (!empty($_SESSION['username'])) {
        echo '<meta http-equiv="refresh" content="3;url=/homeUser.php"><div>Vous etes déjà connecté</div>';
    } ?>