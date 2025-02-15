<?php 
require_once __DIR__.'/../../src/Controllers/BankController.php';
require_once __DIR__.'/../../vendor/autoload.php';

use Controllers\BankController;

$controller = new BankController();

$banks = $controller->getAllBanks();

?>

<!DOCTYPE html>
<html lang="pt-br" style="height: 100dvh;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../../public/style.css">
    <title>Escolha o banco</title>
</head>
<body class="body-centralize">
    <form action="/src/Views/banco/login.php/" class="options" method="get">
        <h1 style="margin: 10px 0; text-align: center;">Escolha o banco</h1>
        <div>
            <select name="code" class="banks">
                <option value="" >Selecione</option>
                <?php foreach ($banks as $bank) { ?>
                    <option value="<?php echo $bank['code'];?>"><?php echo $bank['name'];?></option>
                <?php }?>
            </select>
            <button type="submit" style="margin-top: 20px; width: 100%;">Entrar</button>
        </div>
    </form>
</body>
</html>