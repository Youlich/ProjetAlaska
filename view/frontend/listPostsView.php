<?php ob_start(); ?>

<p> <strong><a class= info href="lastChapter.php">Voir mon dernier chapitre</a></strong>
</p>


<?php
while ($data = $posts->fetch())
{
?>
    <div class="post">
        <p>
        <div class="image">
            <img src="public/images/<?php echo $data['image'];?>" HSPACE="15"  />
        </div>

        <h3>
            <?= htmlspecialchars($data['title']) ?>
        </h3>

            <?= nl2br(htmlspecialchars($data['resum'])) ?>
            <br/><br/>
            <strong><a href="Blog.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-primary btn-sm" role="button" aria-disabled="true">Lire la suite</a></strong>

        </p>
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>


<?php require('templateBlog.php'); ?>
