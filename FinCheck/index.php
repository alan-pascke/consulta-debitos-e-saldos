<?php 
    require_once __DIR__.'/vendor/autoload.php';
    require_once __DIR__.'/src/Controllers/BankController.php';
    

    $route = $_GET['route'] ?? '';
    
    header("Location: ./src/Views/home/list.php");  

?>