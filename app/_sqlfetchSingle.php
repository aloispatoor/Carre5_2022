<?php

$product_id = $_POST['product_id'] ?? $_GET['id'];

try{
    $sqlProduct = 'SELECT * FROM product WHERE product_id = :product_id';
    $reqProduct = $db->prepare($sqlProduct);
    $reqProduct->bindValue(':product_id', $product_id);
    $reqProduct->execute();

    $singleProduct = $reqProduct->fetch();
} catch (PDOException $e) {
    echo 'Erreur :'.$e->getMessage().$e->getCode();
}
