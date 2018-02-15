<?php ob_start(); ?>

<p> <strong><a class= info href="lastChapter.php">Voir mon dernier chapitre</a></strong>
</p>

<?php
foreach ($posts as $post)
{
?>
    <div class="post">
        <p>
        <div class="image">
            <img src="public/images/<?php echo $post->getImage();?>" HSPACE="15"  />
        </div>

        <h3>
            <?= htmlspecialchars($post->getTitle()) ?>
        </h3>

        <?= nl2br(htmlspecialchars($post->getResum())) ?>
        <br/><br/>
        <strong><a href="Blog.php?action=post&amp;id=<?= $post->getId() ?>" class="btn btn-primary btn-sm" role="button" aria-disabled="true">Lire la suite</a></strong>

        </p>
    </div>
<?php
}
?>
<?php $content = ob_get_clean(); ?>


<?php require('templateBlog.php'); ?>
