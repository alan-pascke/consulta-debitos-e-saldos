<?php 
require_once __DIR__.'/src/Controllers/BankController.php';
require_once __DIR__.'/vendor/autoload.php';

use Controllers\BankController;

$controller = new BankController();

$bank = $controller->getBank('001');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $bank['name'];?></title>
</head>
<body>
    <h1>Info</h1>
    <p>
        <?php echo $bank['code'];?>
    </p>
</body>
</html>