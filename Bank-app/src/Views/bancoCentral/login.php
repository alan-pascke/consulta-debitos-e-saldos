<?php 
    require_once __DIR__.'/../../Controllers/BankController.php';
    require_once __DIR__.'/../../Controllers/ClientsController.php';
    require_once __DIR__.'/../../../vendor/autoload.php';


    use Controllers\BankController;
    use Controllers\ClientsController;

    $bankController = new BankController();
    $bank = $bankController->getBank($_GET['code']);

    $clientsController = new ClientsController();

    session_start();
    $error = isset($_SESSION['error']) ? $_SESSION['error'] : '' ;
    unset($_SESSION['error']);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/Views/bancoCentral/loginStyle.css">
    <title>Document</title>
</head>
<body>
    <div class="login-page">
        <h1 style="text-align: center;"><?php echo $bank['name']; ?></h1>

        <div class="form">
            <?php if ($error): ?>
                <span style="color: red;"><?php echo $error; ?></span>
            <?php endif; ?>
            <form class="login-form" action="/../../../index.php?route=login&code=<?php echo $_GET['code']; ?>" method="POST">
                <input type="text" name="cpf" placeholder="cpf" required/>
                <input type="password" name="password" placeholder="password" required/>
                <button type="submit">login</button>
                <p class="message">Not registered? <a href="#">Create an account</a></p>
            </form>
        </div>
    </div>
</body>
</html>