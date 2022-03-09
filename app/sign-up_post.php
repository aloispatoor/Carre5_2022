<?php
require 'includes/config.php';

if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password2'])) {
    echo 'Missing input in the sign up form !';
} else {

    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));
    $password2 = trim(htmlspecialchars($_POST['password2']));
}

//? Vérifier la validité des inputs de l'utilisateur
if (strlen($username) < 3 || strlen($username) > 100) {
    echo 'Username is invalid...';
}

if (strlen($password) < 3 || strlen($password) > 100) {
    echo 'Password is invalid...';
}

try {
    $sqlVerif = 'SELECT COUNT(*) FROM users WHERE username = :username';
    $reqVerif = $db->prepare($sqlVerif);
    $reqVerif->bindValue(':username', $username, PDO::PARAM_STR);
    $reqVerif->execute();

    $resultVerif = $reqVerif->fetchColumn();
} catch (PDOException $e) {
    echo 'Erreur :'.$e->getMessage();
}

if ($resultVerif > 0) {
    echo 'This username already exists';
}

//? Vérifier concordance des mdp
if ($password !== $password2) {
    echo 'The passwords are not matching';
}

//! Fin des vérifications, insertion dans la BDD
$password = password_hash($password, PASSWORD_DEFAULT);

try {
    $sqlInsert = 'INSERT INTO users (username,password) VALUES (:username,:password)';
    $reqInsert = $db->prepare($sqlInsert);
    $reqInsert->bindValue(':username', $username, PDO::PARAM_STR);
    $reqInsert->bindValue(':password', $password, PDO::PARAM_STR);

    $resultInsert = $reqInsert->execute();
} catch (PDOException $e) {
    echo 'Erreur :'.$e->getMessage();
}

if ($resultInsert) {
    echo 'Vous êtes bien inscrits';
    exit();

} else {
    echo 'Une erreur est survenue';
    exit();

}