<?php

require 'includes/db.php';
session_start();

    if(isset($_GET['logout'])){
        session_destroy();
        header('Location: index.php');
    }
    if(empty($_SESSION)){
        if(isset($auth)){
            header('Location:sign-in.php');
            exit();
        }
        $user = NULL;
    } else {
        $user = $_SESSION['id'];
    }