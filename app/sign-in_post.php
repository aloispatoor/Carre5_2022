<?php
require 'includes/config.php';

if (empty($_POST['username']) || empty($_POST['password'])) {
    echo 'Missing input in the sign up form !';
} else {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));
}

try {
    $sqlVerif = 'SELECT COUNT(*) FROM user WHERE username = :username';
    $reqVerif = $db->prepare($sqlVerif);
    $reqVerif->bindValue(':username', $username, PDO::PARAM_STR);
    $reqVerif->execute();

    $resultVerif = $reqVerif->fetchColumn();
} catch (PDOException $e) {
    echo 'Erreur :'.$e->getMessage();
}

if($reqVerif = 0){
    echo "Vous n'êtes pas inscrit";
}

try{
    $sqlCompare = 'SELECT * FROM user';
    $reqCompare = $db->prepare($sqlCompare);
    $reqCompare->bindValue(':username', $username, PDO::PARAM_STR);
    $reqCompare->bindValue(':id', $user_id, PDO::PARAM_STR);
    $reqCompare->bindValue(':password', $password, PDO::PARAM_STR);
    $reqCompare->execute();
} catch(PDOException $e){
    echo 'Erreur :' .$e->getMessage();
}
if($username && $password = $user_id){
    session_start();
}