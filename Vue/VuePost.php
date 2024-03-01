<?php
ob_start();
?>

<div id="contenu">
    <article>
        <header>
            <h1 class="blog-post_title">
                <?= $post['BIL_TITRE'] ?>
            </h1>
            <time class="blog-post_text">
                <?= $post['BIL_DATE'] ?>
            </time>
        </header>
        <p class="blog-post_text">
            <?= $post['BIL_CONTENU'] ?>
        </p>
    </article>

    <hr />

    <!-- Display comments -->
    <h1 class="blog-post_title">Comments</h1>
    <?php if (!empty($comments)): ?>
        <ul>
            <?php foreach ($comments as $comment): ?>
                <li class="blog-post_text">
                    <strong class="blog-post_text">
                        <?= $comment['COM_AUTEUR'] ?>:
                    </strong>
                    <?= $comment['COM_CONTENU'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No comments yet.</p>
    <?php endif; ?>

    <!-- Add comment form -->
    <h1 class="blog-post_title">Add Comment</h1>
    <form action="index.php?action=addComment" method="post" >
        <input type="hidden" name="id" value="<?= $post['BIL_ID'] ?>">
        <div>
            <textarea class="textarea"  id="contenu" name="contenu" required></textarea>
        </div>
        <div>
            <input class="blog-post_cta" type="submit" value="Add Comment">
        </div>
    </form>
</div>
<?php
// Get the buffered content and store it in $contenu variable
$contenu = ob_get_clean();

// Include the template file
require 'gabarit.php';
?>