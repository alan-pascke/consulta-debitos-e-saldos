<?php 
    require_once __DIR__.'/../../../vendor/autoload.php';
    require_once __DIR__.'/../../Controllers/AccountsController.php';

    use Controllers\AccountsController;

    session_start();
    $id = $_SESSION['id'];

    $accountController = new AccountsController();
    $account = $accountController->getAccountInformation($id);

    $credits = $accountController->getCreditsInformation($account['id']);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco</title>
    <link rel="stylesheet" href="homeStyle.css">
</head>
<body>
    <header>
        <h1>Banco LightBlue</h1>
        <a href="/logout" class="logout-btn">Sair</a>
    </header>

    <main>
        <div class="container">
            <h2>Bem-vindo, <?php echo $account['fullname'];?>!</h2>
            
            <div class="info-card">
                <h3>Conta Corrente</h3>
                <p><strong>Número da Conta:</strong> <?php echo $account['number'];?></p>
                <p><strong>Agência:</strong> <?php echo $account['agency'];?></strong></p>
                <p><strong>Saldo Disponível:</strong> R$<?php echo $account['balance'];?></p>
            </div>

            <div class="info-card">
                <h3>Cartão de Crédito</h3>
                <p><strong>Limite Total:</strong> R$<?php echo $credits['total_limit'];?></p>
                <p><strong>Utilizado:</strong> R$ <?php echo $credits['used_limit'];?></p>
                <p><strong>Disponível:</strong> R$<?php echo $credits['total_limit'] - $credits['used_limit'];?></p>
            </div>
        </div>
    </main>
</body>
</html>