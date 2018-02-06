<?php
namespace model;
require_once("DbConnect.php");
/**
 * Class CommentManager
 * @package model
 * Class qui permet la gestion des commentaires : la modification, la lecture et l'écriture dans la table comments
 */
class CommentManager extends DbConnect
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        return $comments;
    }

    public function getComment($commentId) // fonction qui est utilisée pour la modification d'un commentaire sélectionné. La valeur ModComm a été envoyée
    {
        $pdo = $this->dbConnect();
        $PDOStatement = $pdo->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ? ORDER BY comment_date DESC');
        $PDOStatement->execute(array($commentId));
        $comment = $PDOStatement->fetch(\PDO::FETCH_ASSOC);
        return $comment;
    }
    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));
        return $affectedLines;
    }


    public function ModifComment()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET author=:author, comment=:comment WHERE id=:num LIMIT 1');
        $comments->bindValue(':num',$_POST['numComm'], \PDO::PARAM_INT);
        $comments->bindValue(':author', $_POST['author'], \PDO::PARAM_STR);
        $comments->bindValue(':comment', $_POST['comment'], \PDO::PARAM_STR);
        $modifLines = $comments->execute();
        return $modifLines;
    }


}