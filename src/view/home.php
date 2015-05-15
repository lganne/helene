<?php 
// ob_start met dans une mémoire tampon le script ci-dessous pas de echo pour l'instant 
ob_start() ?>
<div class="col-xs-6">
    <?php if ($contenu): ?>
        <article>
            <?php foreach ($contenu as $post) : ?>
                <h1><a href='<?php echo URL_SITE . '/post/' . $post->id; ?>'><?php echo $post->title; ?></a></h1>
                <p><?php echo $post->content; ?></p>
                              <p><a href='<?php echo URL_SITE . '/post/' . $post->id; ?>'>lire la suite...</a></p>
            <?php endforeach; ?>
        </article>
    <?php else: ?>
        <p>Désolé mais il n'y a pas de contenu pour l'instant...</p>
    <?php endif; ?>
</div>
<div class="col-xs-4">
    sidebar
</div>
<?php 
// vous récupérez le contenu se trouvant dans l'obstart pour l'afficher plus tard dans le layout.php

$content = ob_get_clean(); ?>

<?php include 'layout.php'; ?>