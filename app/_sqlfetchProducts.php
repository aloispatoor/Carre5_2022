<?php

    $sqlOffers = 'SELECT * FROM product';
    $reqOffers = $db->prepare($sqlOffers);
    $reqOffers->execute();

    $products = $reqOffers->fetchAll();