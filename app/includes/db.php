<?php

    require 'local.env.php';

    $db_string = 'mysql:dbname='.DBNAME.';host='.HOST;


    try {
        $db = new PDO($db_string, USER, PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Erreur : '.$e->getMessage();
    }