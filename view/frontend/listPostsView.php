<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<p> <a href="lastChapter.php">Voir mon dernier chapitre</a>
</p>


<?php
while ($data = $posts->fetch())
{
?>
    <div class="post">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
        </h3>
        <p>
            <img src="<?php echo $data['image'];?>" />
        </p>

        <p>
            <?= nl2br(htmlspecialchars($data['resum'])) ?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Lire la suite</a></em>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>