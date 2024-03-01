<?php

require_once 'Modele/Modele.php';

class BilletController
{

    public function vueAccueil()
    {

        // Create an instance of Modele
        $modele = new Modele();

        // Call the getBlogPosts method to retrieve blog posts
        $billets = $modele->getBillets();

        // Set the page title
        $titre = 'Mon Blog';

        // Start output buffering to capture content
        ob_start();

        // Load the view to display the list of blog posts
        include 'Vue/VueAccueil.php';
    }

    public function addPost()
    {
        $titre = $_POST['titre'];
        $contenu = $_POST['contenu'];
        $modele = new Modele();
        // Assuming the logged-in user's information is stored in the session
        //session_start();
        $auteur = $_SESSION['username']; // Adjust this according to your session variable storing the logged-in user's information

        // Add post to database
        $modele->addPost($titre, $contenu, $auteur);

        // Redirect to homepage after adding post
        header("Location: index.php?action=vueAccueil");
        include 'addPost.php';
    }

    public function viewPost()
    {
        $modele = new Modele();
        // Get post details from database
        $post = $modele->getPostById($_GET['id']);

        // Redirect to homepage if post not found
        if (!$post) {
            header("Location: index.php?action=vueAccueil");
            exit;
        }

        // Get comments for the post
        $comments = $modele->getCommentsForPost($_GET['id']);
        include 'Vue/VuePost.php';
    }
    public function vueNew()
    {
        include 'Vue/VueAdd.php';
    }
}

?>