<?php
namespace controler;
require_once('Autoload.php'); // Chargement des class
\Autoload::register();
Class Frontend
{
    public function listPosts() // affiche l'ensemble des posts
    {
        $postManager = new \model\PostManager();
        $posts = $postManager->getPosts(); // fonction qui affiche tous les posts
        require('view/frontend/listPostsView.php');
    }
    public function post() // action qui se réalise quand on clique sur le lien "commentaires du post". On obtient le post sélectionné et ses commentaires rattachés
    {
        $postManager = new \model\PostManager(); // lieu où se trouve la fonction getPost
        $commentManager = new \model\CommentManager(); // lieu où se trouve la fonction getComments
        $post = $postManager->getPost($_GET['id']); // affiche le post en question grâce à la fonction getPost se trouvant dans PostManager
        $comments = $commentManager->getComments($_GET['id']); // affiche les commentaires qui lui sont associés
        require('view/frontend/postView.php'); //page qui gère l'affichage associé
    }
    public function comment() // fonction utiliser lors du clic sur "modifier" le commentaire
    {
        $commentManager = new \model\CommentManager();
        $comment = $commentManager->getComment($_GET['numComm']); // c'est l'id numComm qui est envoyé
        require('view/frontend/commentView.php');
    }
    public function addComment($postId, $author, $comment)
    {
        $commentManager = new \model\CommentManager();
        $affectedLines = $commentManager->postComment($postId, $author, $comment);
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: Blog.php?action=post&id=' . $postId);
        }
    }
    public function ModifComment()
    {
        $ModifManager = new \model\CommentManager();
        $modifLines = $ModifManager->ModifComment();
        if ($modifLines === false) {
            throw new Exception('Impossible de modifier le commentaire !');
        }
        else {
            header('Location: Blog.php?action=Comment&numComm=' . $_POST['numComm'] . '&success=ok');
        }

    }
}