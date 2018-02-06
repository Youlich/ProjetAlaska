<?php
namespace model;
require_once("DbConnect.php");

/**
 * Class PostManager
 * @package model
 * Class qui permet la gestion des posts (des billets) : la modification, la lecture et l'écriture dans la table posts
 */
class PostManager extends DbConnect
{
    public function getPosts() // Affiche tous les billets (posts)
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, resum, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS post_date_fr FROM posts ORDER BY post_date DESC LIMIT 0, 5');
        return $req;
    }
    public function getPost($postId) // Permet de sélectionner un billet
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, resum, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS post_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        return $post;
    }
}