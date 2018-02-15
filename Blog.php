<?php
require_once ("controler/Autoload.php");
Autoload::register(); // j'appelle la fonction register de ma class Autoload

$frontend = new \controler\Frontend();


try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') { // c'est l'action par défaut , la fonction qui affiche tous les posts et qui est détaillée dans le frontend.php
            $frontend->listPosts();
        }
        elseif ($_GET['action'] == 'post') { // action qui se réalise quand on clique sur le lien "commentaires du post"
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontend->post(); // fonction post de frontend.php
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif($_GET['action'] == 'Comment') { // si on clique sur le lien modifier du commentaire
            if (isset($_GET['numComm']) && $_GET['numComm'] > 0) {
                $frontend->comment(); // fonction comment utilisée
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
             elseif ($_GET['action'] == 'ModifComment') {
            if (isset($_GET['numComm']) && $_GET['numComm'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $frontend->ModifComment();
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    }
    else {
        $frontend->listPosts(); // fonction par défaut détaillée dans frontend.php
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}