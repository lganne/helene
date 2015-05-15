<?php 
// ob_start met dans une mémoire tampon le script ci-dessous pas de echo pour l'instant 
ob_start() ?>
<?php $title="Single page PHP"; ?>
<?php if ($post): ?>
    <article>
        <?php foreach ($post as $p) : ?>
            <h1><?php echo $p->title; ?></h1>
            <?php echo $p->content; ?>
        </article>
    <?php endforeach; ?>
<?php else: ?>
    <p>Désolé mais il n'y a pas de contenu pour l'instant...</p>
<?php endif; ?>
<?php 

// vous récupérez le contenu se trouvant dans l'obstart pour l'afficher plus tard dans le layout.php
$content = ob_get_clean(); ?>

<?php include 'layout.php'; ?>