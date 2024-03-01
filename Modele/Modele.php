<?php

require_once 'BD/config.php';

class Modele
{

    // Method to retrieve blog posts from the database
    function getBillets()
    {
        global $pdo;
        $billets = $pdo->query('select BIL_ID as id, BIL_DATE as date,'
            . ' BIL_TITRE as titre, BIL_CONTENU as contenu, BIL_AUTEUR as auteur from T_BILLET'
            . ' order by BIL_ID desc');
        return $billets;
    }

    public function getBlogPosts()
    {
        global $pdo; // Access the PDO object defined in config.php

        try {
            // Query to retrieve blog posts from the database
            $stmt = $pdo->query('SELECT * FROM t_billet');

            // Fetch blog posts as an associative array
            $billets = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $billets;
        } catch (PDOException $e) {
            // Handle any errors during database query
            die("Error fetching blog posts: " . $e->getMessage());
        }
    }

    public function authenticate($username, $password)
    {
        global $pdo; // Access the PDO object defined in config.php

        try {
            // Prepare SQL statement to check user credentials
            $stmt = $pdo->prepare('SELECT * FROM t_auteur WHERE username = ? AND password = ?');
            $stmt->execute([$username, $password]);

            // Fetch user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            return $user; // Return user data if found, otherwise return false
        } catch (PDOException $e) {
            // Handle any errors during database query
            die("Error authenticating user: " . $e->getMessage());
        }
    }
    // Method to retrieve all blog posts
    public function getAllBillets()
    {
        global $pdo; // Access the PDO object defined in config.php

        try {
            // Query to retrieve all blog posts
            $stmt = $pdo->query('SELECT * FROM t_billet');
            $billets = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $billets;
        } catch (PDOException $e) {
            // Handle any errors during database query
            die("Error fetching blog posts: " . $e->getMessage());
        }
    }

    // Method to retrieve a single blog post by its ID
    public function getBilletById($billetId)
    {
        global $pdo;

        try {
            // Prepare SQL statement to retrieve the blog post by its ID
            $stmt = $pdo->prepare('SELECT * FROM t_billet WHERE id = ?');
            $stmt->execute([$billetId]);
            $billet = $stmt->fetch(PDO::FETCH_ASSOC);

            return $billet;
        } catch (PDOException $e) {
            // Handle any errors during database query
            die("Error fetching blog post: " . $e->getMessage());
        }
    }

    // Method to add a new comment to a blog post
    public function addComment($billetId, $contenu, $auteur )
    {
        global $pdo;

        try {
            // Prepare SQL statement to insert a new comment
            echo "   " . $billetId . "   ";
            $stmt = $pdo->prepare('INSERT INTO t_commentaire (BIL_ID, COM_AUTEUR, COM_CONTENU, COM_DATE) VALUES (?, ?, ?, NOW())');
            $stmt->execute([$billetId, $auteur, $contenu]);

            // Return true if the comment was added successfully
            return true;
        } catch (PDOException $e) {
            // Handle any errors during database query
            die("Error adding comment: " . $e->getMessage());
        }
    }

    // Method to add a new post
    public function addPost($titre, $contenu, $auteur) {
        global $pdo;
        
        try {
            // Prepare SQL statement to insert a new post
            $stmt = $pdo->prepare('INSERT INTO t_billet (BIL_TITRE, BIL_CONTENU, BIL_AUTEUR, BIL_DATE) VALUES (?, ?, ?, NOW())');
            $stmt->execute([$titre, $contenu, $auteur]);
            
            // Return true if the post was added successfully
            return true;
        } catch(PDOException $e) {
            // Handle any errors during database query
            die("Error adding post: " . $e->getMessage());
        }
    }
    
    // Method to retrieve a post by its ID
    public function getPostById($postId) {
        global $pdo;
        
        try {
            // Prepare SQL statement to retrieve the post by its ID
            $stmt = $pdo->prepare('SELECT * FROM t_billet WHERE BIL_ID = ?');
            $stmt->execute([$postId]);
            $post = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $post;
        } catch(PDOException $e) {
            // Handle any errors during database query
            die("Error fetching post: " . $e->getMessage());
        }
    }
    public function getCommentsForPost($postId) {
        global $pdo;
        
        try {
            // Prepare SQL statement to retrieve comments for a specific post
            $stmt = $pdo->prepare('SELECT * FROM t_commentaire WHERE BIL_ID = ?');
            $stmt->execute([$postId]);
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $comments;
        } catch(PDOException $e) {
            // Handle any errors during database query
            die("Error fetching comments: " . $e->getMessage());
        }
    }
    
}

?>