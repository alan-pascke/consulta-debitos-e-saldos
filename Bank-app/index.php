<?php 
require_once __DIR__.'/src/Controllers/ClientsController.php';
require_once __DIR__.'/vendor/autoload.php';

    use Controllers\ClientsController;
    $clientsController = new ClientsController();
    $route = $_GET['route'] ?? '/';
    


    switch ($route) {
        case 'login':
            $clientsController->login();
            break;
        case 'logout':
            $clientsController->logout();
            break;
        case '/':
            header("Location: ./src/Views/escolhaOBanco.php");
            break;
        default:
            header("Location: ./src/Views/escolhaOBanco.php");
            break;
    }

?>