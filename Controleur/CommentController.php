<?php

require_once 'Modele/Modele.php';

class CommentController
{

    public function addComment()
    {
        $modele = new Modele();
        $post = $modele->getPostById($_POST['id']);

        // Redirect to homepage if post not found
        if (!$post) {
            header("Location: index.php?action=vueAccueil");
            exit;
        }

        // Add comment to the post
        $modele->addComment($_POST['id'], $_POST['contenu'], $_SESSION['username']); // Assuming username is stored in session

        // Redirect to viewComments.php after adding comment
        header("Location: index.php?action=viewPost&id=" . $_POST['id']);

    }
}
?>
