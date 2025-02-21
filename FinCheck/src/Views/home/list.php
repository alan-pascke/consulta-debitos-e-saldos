<?php 
    require_once __DIR__.'/../../Controllers/BankController.php';
    require_once __DIR__.'/../../../vendor/autoload.php';

    use Controllers\BankController;

    $controller = new BankController();
    $banks = $controller->getAllBanks("26598453216");

    // var_dump($banks)
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>FinCheck</title>
</head>
<body>
    <nav>
        <h2 class="logo">FinCheck</h2>
        <button class="logout-btn">Logout</button>
    </nav>
    <main>
        <div class="container">
            <h2 class="main-title">Seu bancos</h2>
            
            <?php if (!$banks) { ?>
                <h2>Nenhum banco encontrado</h2>
            <?php }?>
            
            <?php foreach($banks as $bank) { ?>
                <div class='card'>
                    <h4 class="card-title"><?php echo $bank['name']; ?></h4>
                    <br\>
                    <p>Saldo: R$<?php echo $bank['balance']; ?></p>
                    <p>Limite de Crédito: R$<?php echo $bank['total_limit']; ?></p>
                    <p>Limite Utilizado: R$<?php echo $bank['used_limit']; ?></p>
                    <p>Limite Disponível: R$<?php echo $bank['total_limit'] - $bank['used_limit']; ?></p>
                </div>
            <?php } ?>

        </div>
    </main>

    
</body>
</html>