

<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>

<p><a href="Blog.php">Retour à la liste des chapitres</a></p>

<div class="post">
    <p>
        <img src="public/images/<?php echo $post['image'];?>" />
    </p>
    <h3>
        <?= htmlspecialchars($post['title']) ?>
    </h3>
    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>

<h2>Commentaires</h2>

<form action="Blog.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> 

    (<a href="Blog.php?action=Comment&numComm=<?=$comment['id']?>">modifier</a>)


    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('templateBlog.php'); ?>
