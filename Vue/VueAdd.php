<?php
ob_start();
?>

<h2 class="blog-post_title">Ajouter un nouveau billet</h2>
<form action="index.php?action=addPost" method="post">
    <div>
        <label class="blog-post_title" for="titre">Titre:</label>
        <input type="text" id="titre" name="titre" required>
    </div>
    <div>
        <label class="blog-post_title" for="contenu">Contenu:</label>
        <textarea id="contenu" name="contenu" required></textarea>
    </div>
    <div>
        <label class="blog-post_title" for="auteur">Auteur:</label>
        <!-- Automatically fill in the "auteur" field with the logged-in user's information -->
        <input type="text" id="auteur" name="auteur" value="<?php echo $_SESSION['username']; ?>" required readonly>
    </div>
    <div>
        <input class="blog-post_cta" type="submit" value="Ajouter">
    </div>
</form>


<?php
// Get the buffered content and store it in $contenu variable
$contenu = ob_get_clean();

// Include the template file
require 'gabarit.php';
?>