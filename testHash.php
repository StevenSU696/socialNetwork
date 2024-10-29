<?php
$secretPass = password_hash('salut', PASSWORD_DEFAULT);
$hashPass = password_hash('salut', PASSWORD_DEFAULT);
$check = password_verify('salut', $hashPass);

echo "Hashed password" . $hashPass . "<br>";
echo "Stored password" . $secretPass;

var_dump($check);
