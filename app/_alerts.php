<?php

$alert = false;
    if(!empty($_GET) && (!empty($_GET['error']) || !empty($_GET['success']))){
        $alert = true;
        if(!empty($_GET['success'])){
            if($_GET['success'] == 'editSuccess'){
                $type = 'success';
                $message = 'Vous avez modifié le produit avec succès !';
            }
            if($_GET['success'] == 'deleteSuccess'){
                $type = 'success';
                $message = 'Vous avez supprimé le produit avec succès !';
            }
            if($_GET['success'] == 'insertSuccess'){
                $type = 'success';
                $message = 'Vous avez ajouté le produit avec succès !';
            }
        }
        if(!empty($_GET['error'])){

            if($_GET['error'] == 'missingInput'){
                $type = 'warning';
                $message = 'Les champs sont vides';
            }
            if($_GET['error'] == 'invalidPrice'){
                $type = 'warning';
                $message = 'Le prix est invalide. Merci d\'entrer un chiffre supérieur ou égal à zéro';
            }
            if($_GET['error'] == 'invalidName'){
                $type = 'warning';
                $message = 'Le nom du produit est invalide. Merci d\'entrer plus de caractères';
            }
            if($_GET['error'] == 'notMatching'){
                $type = 'warning';
                $message = 'Le nom d\'utilisateur et le mot de passe ne correspondent pas';
            }
            if($_GET['error'] == 'invalidTyping'){
                $type = 'warning';
                $message = 'Le nom d\'utilisateur ou le mot de passe sont invalides. Merci de taper une chaîne de caractère supérieure à 3';
            }
            if($_GET['error'] == 'alreadyExists'){
                $type = 'warning';
                $message = 'Le nom d\'utilisateur existe déjà !';
            }
            if($_GET['error'] == 'passwordsNotMatching'){
                $type = 'warning';
                $message = 'Les mots de passe ne correspondent pas';
            }
            if($_GET['error'] == 'invalidImageFile'){
                $type = 'warning';
                $message = 'L\'image est invalide';
            }
            if($_GET['error'] == 'uplaodError'){
                $type = 'warning';
                $message = 'Le téléchargement a eu un problème';
            }
            if($_GET['error'] == 'unauthorizedAccess'){
                $type = 'danger';
                $message = 'Accès non authorisé';
            }
            if($_GET['error'] == 'csrfAttempt'){
                $type = 'danger';
                $message = 'Accès non authorisé';
            }
        }
    }