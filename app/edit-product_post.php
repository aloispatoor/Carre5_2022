<?php

declare(strict_types=1);
require 'includes/config.php';

if (in_array('', $_POST)) {
    header("Location: edit-product.php?id={$_POST['product_id']}&error=missingInput");
} else {
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $price = htmlspecialchars(trim($_POST['price']));
    $product_id = htmlspecialchars(trim($_POST['product_id']));
    $dlc = htmlspecialchars(trim($_POST['dlc']));
}

if ($price <= 0) {
    header("Location:edit-product.php?id={$_POST['product_id']}&error=invalidPrice");
    exit();
}

if (strlen($name) < 3) {
    header("Location:edit-product.php?id={$_POST['product_id']}&error=invalidName");
    exit();
}

try {
    $sqlUpdateOffer = 'UPDATE product SET name=:name, description=:description, price=:price, dlc=:dlc WHERE product_id=:product_id';
    $reqUpdateOffer = $db->prepare($sqlUpdateOffer);
    $reqUpdateOffer->execute([
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'product_id' => $product_id,
        'dlc' => $dlc,
    ]);

    header("Location:single-product?success=editSuccess&id={$product_id}");
} catch (PDOException $e) {
    echo 'Erreur : '.$e->getMessage();
    echo "<meta http-equiv='refresh' content='3;URL=editOffer.php?id={$product_id}'>";
}