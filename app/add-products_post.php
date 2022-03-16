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
    $price = floatval(htmlspecialchars(trim($_POST['price'])));
    $image = $_FILES['image'];
}

if ($price <= 0) {
    header('Location:add-products.php?error=invalidPrice');
    exit();
}

if (strlen($name) < 3) {
    header('Location:add-products.php?error=invalidName');
    exit();
}

if ($image['size'] > 0 && $image['size'] <= 1000000) {
    $valid_ext = ['png', 'jpeg', 'jpg', 'gif'];
    $get_ext = strtolower(substr(strrchr($image['name'], '.'), 1));

    if (!in_array($get_ext, $valid_ext)) {
        echo 'image format is invalid';
        header('Location:addOffers.php?error=invalidImageFIle');
        exit();
    }

    $valid_type = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'];
    if (!in_array($image['type'], $valid_type)) {
        echo 'image type is invalid';
        header('Location:addOffers.php?error=invalidImageFile');
        exit();
    }
    $image_path = 'public/uploads/'.uniqid().'/'.$image['name'];

    mkdir(dirname($image_path));

    if (!move_uploaded_file($image['tmp_name'], $image_path)) {
        echo 'couldn\'t upload';
        header('Location:addOffers.php?error=uploadError');
        exit();
    }
}


try {
    $sqlInsertOffer = 'INSERT INTO product (name,description,image,price, dlc) VALUES (:name, :description, :image, :price, :dlc)';
    $reqInsertOffer = $db->prepare($sqlInsertOffer);
    $reqInsertOffer->execute(
        [':name' => $name, 
        ':description' => $description, 
        ':image' => $image_path, 
        ':price' => $price, 
        ':dlc' => $dlc] 
    ); # Equivalent du bindValue

    $insert = $db->lastInsertId();
    header('Location:single-product.php?id='.$insert);
} catch (PDOException $e) {
    echo 'Erreur :'.$e->getMessage().$e->getCode();
}