<?php

declare(strict_types=1);
$auth = true;
require 'includes/config.php';

$author = $_SESSION['id'];


if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['price'])) {
    header('Location:add-products.php?error=missingInput');
    exit();
} else {

    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $dlc = htmlspecialchars(trim($_POST['dlc']));
    $price = htmlspecialchars(trim($_POST['price']));
}

if ($price <= 0) {
    header('Location:add-products.php?error=invalidPrice');
    exit();
}

if (strlen($name) < 3) {
    header('Location:add-products.php?error=invalidName');
    exit();
}

if (isset($_POST['image'])) {
    $image = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
    $folder = "image/".$filename;
}



try {
    $sqlInsertOffer = 'INSERT INTO product (name,description,image,price, dlc) VALUES (:name, :description, :image, :price, :dlc)';
    $reqInsertOffer = $db->prepare($sqlInsertOffer);
    $reqInsertOffer->execute(
        [':name' => $name, ':description' => $description, ':image' => $image, ':price' => $price, ':dlc' => $dlc]
    );

    $insert = $db->lastInsertId();
    header('Location:single-product.php?id='.$insert);
} catch (PDOException $e) {
    echo 'Erreur :'.$e->getMessage().$e->getCode();
}