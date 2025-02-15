<?php 
require_once __DIR__.'/src/Controllers/ClientsController.php';
require_once __DIR__.'/vendor/autoload.php';

    use Controllers\ClientsController;
    $clientsController = new ClientsController();
    $route = $_GET['route'] ?? 'login';
    


    switch ($route) {
        case 'login':
            $clientsController->login();
            break;
        default:
            header("Location: ./src/Views/escolhaOBanco.php");
            break;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>