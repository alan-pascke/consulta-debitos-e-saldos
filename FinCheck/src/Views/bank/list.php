<?php 
    require_once __DIR__.'/../../Controllers/BankController.php';
    require_once __DIR__.'/../../../vendor/autoload.php';

    use Controllers\BankController;

    $controller = new BankController();
    $banks = $controller->getAllBanks();
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinCheck</title>
</head>
<body>
    <h2>Seu bancos</h2>
    </br>
    </br>
    <a href="./addbank.php">adicionar banco</a>
    <?php if (!$banks) { ?>
        <h2>Nenhum banco encontrado</h2>
    <?php }?>
    <table border="1">
        <tr>
            <th>Banco</th>
            <th>Saldo</th>
            <th>Crédito</th>
            <th>Débito</th>
        </tr>
        <?php foreach($banks as $bank) { ?>
            <tr>
                <td><?php echo $bank['name']?></td>
                <td><?php echo 'R$ '. $bank['balance']?></td>
                <td><?php echo 'R$ '. $bank['credit']?></td>
                <td><?php echo 'R$ '. $bank['debt']?></td>
            </tr>
        <?php } ?>
        
    </table>
    
</body>
</html>