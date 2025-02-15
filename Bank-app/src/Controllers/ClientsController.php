<?php 
    namespace Controllers;

    require_once __DIR__.'/../../config/Database.php';
    require_once __DIR__.'/../Models/Clients.php';

    use Config\Database;
    use Models\Clients;
 

    class ClientsController{
        private $accountModel;

        public function __construct(){
            $db = new Database();
            $this->accountModel = new Clients($db);
        }

        public function getAccounts(){
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return $this->accountModel->getAll();
            } else {
                return 'Erro ao buscar contas';
            }
        }

        public function login(){
            session_start();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $cpf = $_POST['cpf'];
                $password = $_POST['password'];
                
                
                $clients = $this->accountModel->checkIfClientExists($cpf, $password);
                if ($clients) {
                    print_r($clients['id']);
                    $_SESSION['id'] = $clients['id'];
                    header('Location: /src/Views/bancoCentral/home.php');
                    exit();
                } elseif (!$clients || !password_verify($password, $clients['password'])) {
                    $_SESSION['error'] = "E-mail ou senha incorretos.";
                    header('Location: /src/Views/bancoCentral/login.php/?code='.$_GET['code']);
                    exit();
                }
            }
        }
    
    }
?>