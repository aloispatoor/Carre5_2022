<?php

declare(strict_types=1);
require 'includes/config.php';

// var_dump($_POST);

if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['price'])) {
    header("Location: edit-product.php?id={$_POST['product_id']}&error=missingInput");
} else {
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $price = floatval(htmlspecialchars(trim($_POST['price']))) ;
    $product_id = htmlspecialchars(trim($_POST['product_id']));
    $dlc = htmlspecialchars(trim($_POST['dlc']));
    $image = $_FILES['image'];
}

// var_dump($name, $description, $price, $product_id, $dlc);
// exit();

if ($price <= 0) {
    header("Location:edit-product.php?id={$product_id}&error=invalidPrice");
    exit();
}

if (strlen($name) < 3) {
    header("Location:edit-product.php?id={$product_id}&error=invalidName");
    exit();
}

if($image['size'] <= 0){
    try {
        $sqlUpdateOffer = 'UPDATE product SET name=:name, description=:description, price=:price, dlc=:dlc WHERE product_id=:product_id';
        $reqUpdateOffer = $db->prepare($sqlUpdateOffer);
        $reqUpdateOffer->execute([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'product_id' => $product_id,
            'dlc' => $dlc
        ]);
    
        header("Location:single-product.php?success=editSuccess&id={$product_id}");
    } catch (PDOException $e) {
        echo 'Erreur : '.$e->getMessage();
        echo "<meta http-equiv='refresh' content='3;URL=editOffer.php?id={$product_id}'>";
    }
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
    $sqlUpdateOffer = 'UPDATE product SET name=:name, description=:description, price=:price, dlc=:dlc, image=:image WHERE product_id=:product_id';
    $reqUpdateOffer = $db->prepare($sqlUpdateOffer);
    $reqUpdateOffer->execute([
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'product_id' => $product_id,
        'dlc' => $dlc,
        'image' => $image_path
    ]);

    header("Location:single-product.php?success=editSuccess&id={$product_id}");
} catch (PDOException $e) {
    echo 'Erreur : '.$e->getMessage();
    echo "<meta http-equiv='refresh' content='3;URL=edit-product.php?id={$product_id}'>";
}