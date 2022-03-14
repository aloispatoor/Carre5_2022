<?php

try{
    $product_id = $_GET['id'];
    $sqlProduct = 'SELECT * FROM product';
    $reqProduct = $db->query($sqlProduct);
    $reqProduct->execute();

    $product = $reqProduct->fetch();
} catch (PDOException $e) {
    echo 'Erreur :'.$e->getMessage().$e->getCode();
}
