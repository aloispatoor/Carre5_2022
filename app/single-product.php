<?php
    require '_head.php';
    require '_sqlfetchSingle.php';

    
?>

<?php if(!empty($product)) :?>
    
        <div class="card m-4">
        <div class="card-body">
            <h3 class="card-title"><?php echo $product['name'];?></h3>
            <p>Prix : <?php echo $product['price'];?>€</p>
            <hr>
            <p>Description : <?php echo $product['description'];?></p>
        </div>
    </div>

<?php else : ?>
    <?php header('Location:products.php?error=notFound'); ?>
<?php endif; ?>
<?php require '_footer.php'; ?>