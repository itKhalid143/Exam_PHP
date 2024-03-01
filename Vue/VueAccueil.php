<?php
// Include the Modele class
require_once 'Modele/Modele.php';

// Create an instance of Modele
$modele = new Modele();

// Call the getBlogPosts method to retrieve blog posts
$billets = $modele->getBillets();

// Start output buffering to capture content
ob_start();
?>

<!-- Add button for creating a new post -->
<div class="container">
    <a class="blog-post_text" href="index.php?action=vueNew" class="btn">Create new Post</a>
</div>
<?php foreach ($billets as $billet): ?>
    <div class="blog-post">
            <div class="blog-post_img">
                <img src="https://images.unsplash.com/photo-1562813733-b31f71025d54?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Nnx8Y29kaW5nfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                    alt="">
            </div>
            <div class="blog-post_info">
                <div class="blog-post_date">
                    <span><?= strtoupper($billet['auteur'] )?></span>
                    <span><time><?= $billet['date'] ?></time></span>
                </div>
                <h1 class="blog-post_title"> <a class="blog-post_title" href="index.php?action=viewPost&id=<?= $billet['id'] ?>"><?= $billet['titre'] ?></a></h1>
                <p class="blog-post_text">
                <?= $billet['contenu'] ?>
                </p>
                <a href="index.php?action=viewPost&id=<?= $billet['id'] ?>" class="blog-post_cta">Read More</a>
            </div>
        </div>
    
    <hr />
<?php endforeach; ?>



<?php
// Get the buffered content and store it in $contenu variable
$contenu = ob_get_clean();

// Include the template file
require 'gabarit.php';
?>
