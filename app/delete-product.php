<?php

declare(strict_types=1);
require 'includes/config.php';
require '_sqlFetchSingle.php';

if (!$user) {
    header('Location:index.php?error=unauthorizedAccess');
    exit();
}

$product_id = filter_input(INPUT_POST, 'product_id');
$token = filter_input(INPUT_POST, 'csrf_token');

if ($token !== $_SESSION['token']) {
    header('Location:index.php?error=csrfAttempt');
    exit();
}

try {
    $sqlDeleteOffer = 'DELETE FROM product WHERE product_id = :product_id';
    $reqDeleteOffer = $db->prepare($sqlDeleteOffer);
    $reqDeleteOffer->bindValue(':product_id', $product_id, PDO::PARAM_STR);
    $reqDeleteOffer->execute();

    header('Location:index.php?success=deleteSuccess');
} catch (\PDOException $e) {
    echo 'Erreur :'.$e->getMessage();
}