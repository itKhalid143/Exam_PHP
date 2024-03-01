<?php

require_once 'Modele/Modele.php';

class AuthController {
    
    // Method to handle login
    public function login() {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        $modele = new Modele();
        
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Retrieve username and password from form
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            // Authenticate user
            $user = $modele->authenticate($username, $password);
            
            if ($user) {
                // Authentication successful
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                
                // Redirect to homepage or any other page
                header('Location: index.php');
                exit;
            } else {
                // Authentication failed
                echo "Invalid username or password.";
            }
        }
        
        // Display login form
        include 'Vue/VueAuthentification.php';
    }

    // Method to handle logout
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        
        // Redirect to homepage or any other page
        header('Location: index.php');
        exit;
    }
}

?>