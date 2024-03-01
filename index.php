<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Blog Post </title>
    <link rel="stylesheet" href="Contenu/test2/style.css">
</head>

<body>
    <div class="container">
        <?php
        // Start session to manage user authentication
        session_start();

        // Include necessary controllers and modele
        require_once './Controleur/AuthController.php';
        require_once './Controleur/BilletController.php';
        require_once './Controleur/CommentController.php';
        require_once './Modele/Modele.php';

        // Create an instance of AuthController
        $authController = new AuthController();

        // Check if user is already authenticated
        if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
            // Check if action is login
            if (isset($_GET['action']) && $_GET['action'] === 'login') {
                // User is not authenticated, proceed with login action
                $authController->login();
                exit;
            } else {
                // User is not authenticated, redirect to login page
                header('Location: index.php?action=login');
                exit;
            }
        }

        // User is authenticated, proceed to handle other actions
        $action = isset($_GET['action']) ? $_GET['action'] : 'vueAccueil';

        // Create an array mapping actions to their corresponding controllers
        $controllers = [
            'vueAccueil' => 'BilletController',
            'addPost' => 'BilletController',
            'viewPost' => 'BilletController',
            'vueNew' => 'BilletController',
            'addComment' => 'CommentController',
            // Add more actions and corresponding controllers as needed
        ];

        // Check if the requested action is valid
        if (array_key_exists($action, $controllers)) {
            // Create an instance of the corresponding controller
            $controllerName = $controllers[$action];
            $controller = new $controllerName();

            // Call the method corresponding to the action if it exists
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                // Handle invalid action (e.g., display error page)
                echo '404 Not Found';
            }
        } else {
            // Handle invalid action (e.g., display error page)
            echo '404 Not Found';
        }
        ?>
       

    </div>
</body>
