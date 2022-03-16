<?php
    require '_head.php';
    require '_sqlfetchSingle.php'; 
?>

<?php if(!empty($singleProduct)) :?>
    
    <div class="card m-4">
        <div class="card-body">
            <img src="<?php echo $singleProduct['image']; ?>" alt="<?php echo $singleProduct['description']; ?>" class="w-50">
            <h3 class="card-title"><?php echo $singleProduct['name'];?></h3>
            <p>Prix : <?php echo $singleProduct['price'];?>€</p>
            <hr>
            <p>Description : <?php echo $singleProduct['description'];?></p>
        </div>
    </div>

<?php else : ?>
    <?php header('Location:single-product.php?error=notFound'); ?>
<?php endif; ?>
<div class="card-body m-4">
    <a href="index.php" class="btn btn-primary">Retourner à l'accueil</a>
</div>
<?php require '_footer.php'; ?>